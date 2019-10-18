<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Offer;
use Cocur\Slugify\Slugify;
use App\ImageArticle;
use App\Offerimage;
use App\Category;
use App\Condition;
use App\Http\Controllers\ArticleController;


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
    public function newArticleForm() {
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
        $articles = Article::where('category_id', $categoryFindID)->orderBy('id', 'DESC')->paginate(8);
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
        $userId             = $user->id;
        $offerId            = null;
        $categories         = Category::orderBy('id', 'DESC')->get();
        $article            = Article::where('slug', $article_slug)->first();
        $selectCategories   = Category::orderBy('name','ASC')->pluck('name','id');
        $conditions         = Condition::orderBy('condition','ASC')->pluck('condition','id');
        $countUserOffer     = Offer::where('user_id',$userId)->where('article_id', $article->id)->first();
        $sameUserArticle    = false;
        $articleOffers      = Offer::where('article_id', $article->id)->get();

        // Check if the logged user is the same as the one who published the article
        if ($userId == $article->user_id) {
            $sameUserArticle    = true;
        }

        if ($countUserOffer) {
            $existOffer     = true;
            $offerId        = $countUserOffer->id;
            $countUserOffer->offerimage;
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
            'articleOffers'     => $articleOffers      
        ]);
    }

    public function newOffer(Request $request) 
    {
        $existOffer = false;
        $postOffer = $request->all();
        // dd($postOffer['article_id']); exit();
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
            $offer->save();
            $this->imageManipulation($request->file('image'), $offer);
            // echo "Offer Updated";
        } else {
            $offer = new Offer($postOffer);
            $offer->user_id = \Auth::user()->id;
            $offer->save();
            $this->imageManipulation($request->file('image'), $offer);
            // echo "New Offer Saved";
        }
        $articleSlug = Article::find($articleId)->first()->slug;
        return redirect('article/'.$articleSlug);
    }

    public function imageManipulation($files, $offer) {
        if (count($files) > 0) {
            $path = public_path() . '/img/offers/';
            $images = Offerimage::where('offer_id','=',$offer->id)->get();
            foreach ($images as $image) {
                File::delete($path.$image->url_image);
                $image->delete();
            }
            $i = 0;
            foreach($files as $file)
            {
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
