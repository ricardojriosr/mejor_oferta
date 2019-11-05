<?php

namespace App\Http\Controllers;

use App\Article;
use App\Acceptedoffer;
use App\Offer;
use App\ImageArticle;
use App\Offerimage;
use App\Category;
use App\Condition;
use Cocur\Slugify\Slugify;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Storage;
use File;

class PublicController extends Controller
{
    public function index() 
    {
        $articles = ArticleController::getArticles();
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('frontend.home', [
            'articles'              => $articles, 
            'categories'            => $categories
        ]);
    }

    // ATICLE FUNCTIONS
    public function newArticleForm() 
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        $selectedCategories   = Category::orderBy('name','ASC')->pluck('name','id');
        return view('frontend.article.create', [
            'categories'            => $categories,
            'selectedCategories'    => $selectedCategories
        ]);
    }

    public function storeArticle(Request $request)
    {
        $article = new Article($request->all());
        $response = $request->all();
        $slugify = new Slugify();
        $article->slug = $slugify->slugify($response['name'], '_');
        $article->user_id = \Auth::user()->id;
        if (!isset($response->highlight)) {
            $article->highlight = false;
        } else {
            $article->highlight = true;
        }
        $article->save();

        //Manipulacion de imagenes
        $i = 0;
        $files = $request->file('image');
        foreach($files as $file)
        {
            $name = 'article_' . time() . '_' . $i . '.' . $file->getClientOriginalName();
            $path = public_path() . '/img/articles/';
            $file->move($path, $name);
            $image = new ImageArticle();
            $image->url_image = $name;
            $image->name = $response['name'] . "-" . $i;
            if ($i == 0) {
                $image->default = 1;
            } else {
                $image->default = 0;
            }
            $image->article()->associate($article);
            $image->save();
            $i++;
        }
        return redirect('article/'.$article->slug);
    }

    // OFFER FUNCTIONS
    public function category($categorySlug) 
    {
        $categoryID = Category::where('slug', $categorySlug)->first();
        if (!$categoryID) {
            $categoryFindID         = 0;
            $categoryDisplayName    = '';
        } else {
            $categoryFindID         = $categoryID->id;
            $categoryDisplayName    = $categoryID->display_name;
        }
        $articles = Article::where('category_id', $categoryFindID)
            ->orderBy('id', 'DESC')
            ->paginate(8);
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('frontend.home', [
            'articles' => $articles, 
            'categories' => $categories,
            'display_name' => $categoryDisplayName
        ]);
    }

    public function showArticle($article_slug) 
    {
        $existOffer         = false;
        $userId             = 0;
        $user               = auth()->user();
        if ($user) {
            $userId         = $user->id;
        }
        $offerId            = null;
        $acceptedOfferID    = null;
        $categories         = Category::orderBy('id', 'DESC')->get();
        $article            = Article::where('slug', $article_slug)->first();
        $selectCategories   = Category::orderBy('name','ASC')->pluck('name','id');
        $conditions         = Condition::orderBy('condition','ASC')->pluck('condition','id');
        $countUserOffer     = Offer::where('user_id',$userId)->where('article_id', $article->id)->first();
        $acceptedOffer      = Acceptedoffer::where('article_id',$article->id)->first();
        $sameUserArticle    = false;
        $articleOffers      = Offer::where('article_id', $article->id)
            ->where('user_id', '!=', $userId)
            ->orderBy('highlight','DESC')
            ->orderBy('id', 'DESC')
            ->get();

        // If there is an accepted offer, get the ID of the offer and change the form for Selected Offer
        if ($acceptedOffer) {
            $acceptedOfferID = $acceptedOffer->offer_id;
        }

        // Check if the logged user is the same as the one who published the article
        if ($userId == $article->user_id) {
            $sameUserArticle    = true;
        }

        if ($countUserOffer) {
            $existOffer     = true;
            $offerId        = $countUserOffer->id;
            $countUserOffer->offerimage;
        }

        $isHighlighted = false;
        if ((isset($countUserOffer->highlight)) && ($countUserOffer->highlight)) {
            $isHighlighted = true;
        }


        return view('frontend.article.show', [
            'article'           => $article,
            'categories'        => $categories,
            'selectCategories'  => $selectCategories,
            'conditions'        => $conditions,
            'userId'            => $userId,
            'existOffer'        => $existOffer,
            'countUserOffer'    => $countUserOffer,
            'offerId'           => $offerId,
            'offerDetail'       => $countUserOffer,
            'sameUserArticle'   => $sameUserArticle,
            'articleOffers'     => $articleOffers,
            'isHighlighted'     => $isHighlighted,
            'acceptedOfferID'   => $acceptedOfferID,   
        ]);
    }

    public function newOffer(Request $request) 
    {
        $existOffer = false;
        $postOffer = $request->all();
        $isHighlight = false;
        if ($postOffer['highlight'] == 'Y') {
            $isHighlight = true;
        }
        $articleId = $postOffer['article_id'];
        $userId = 0;
        $user = auth()->user();
        $userId = $user->id;
        $countUserOffer = Offer::where('user_id',$userId)->where('article_id', $articleId)->first();
        if ($countUserOffer) {
            $existOffer = true;
        }
        if ($existOffer) {
            $offer = Offer::find($postOffer['offer_id']);
            $offer->fill($request->all());
            $offer->user_id = \Auth::user()->id;
            $offer->highlight = $isHighlight;
            $offer->save();
            $this->imageManipulation($request->file('image'), $offer);
            // echo "Offer Updated";
        } else {
            $offer = new Offer($postOffer);
            $offer->user_id = \Auth::user()->id;
            $offer->highlight = $isHighlight;
            $offer->save();
            $this->imageManipulation($request->file('image'), $offer);
            // echo "New Offer Saved";
        }
        $articleSlug = Article::find($articleId)->first()->slug;
        return redirect('article/'.$articleSlug);
    }

    //  Accept Offer
    public function acceptOffer(Request $request) {
        $response       = $request->all();
        $article_id     = $response->article_id;
        $offer_id       = $response->offer_id;

        // Look if the article has any offer
        $acceptedOffer  = Acceptedoffer::where('article_id', $article_id)->first();

        // If has offer, delete old ofe
        if ($acceptedOffer) {
            $acceptedOffer->delete();
        } 
        // Add new offer
        $newOffer = new Acceptedoffer();
        $newOffer->offer_id = $offer_id ;
        $newOffer->article_id = $article_id ;
        $newOffer->save();

        // Redirect to the Article View
        $articleSlug = Article::find($article_id)->first()->slug;
        return redirect('article/'.$articleSlug);

    }

    // Image Manipulation 
    public function imageManipulation($files, $offer) 
    {
        if (count($files) > 0) {
            $path = public_path() . '/img/offers/';
            $images = Offerimage::where('offer_id','=',$offer->id)->get();
            foreach ($images as $image) {
                File::delete($path.$image->url_image);
                $image->delete();
            }
            $i = 0;
            foreach($files as $file) {
                $name = 'offer_' . time() . '_' . $i . '.' . $file->getClientOriginalName();
                $file->move($path, $name);
                $image = new Offerimage();
                $image->url_image = $name;
                $image->offer()->associate($offer);
                $image->save();
                $i++;
            }
        }
    }
}

?>
