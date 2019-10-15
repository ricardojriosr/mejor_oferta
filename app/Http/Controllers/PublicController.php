<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Offerimage;
use App\Article;
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
            'articles' => $articles, 
            'categories' => $categories
        ]);
    }

    public function category($categorySlug) 
    {
        $categoryID = Category::where('slug', $categorySlug)->firstOrFail();
        $articles = Article::where('category_id', $categoryID->id)->orderBy('id', 'DESC')->paginate(8);
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('frontend.home', [
            'articles' => $articles, 
            'categories' => $categories,
            'display_name' => $categoryID->display_name
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
        $article            = Article::where('slug', $article_slug)->firstOrFail();
        $selectCategories   = Category::orderBy('name','ASC')->pluck('name','id');
        $conditions         = Condition::orderBy('condition','ASC')->pluck('condition','id');
        $countUserOffer     = Offer::where('user_id',$userId)->where('article_id', $article->id)->first();
        if ($countUserOffer) {
            $existOffer     = true;
            $offerId        = $countUserOffer->id;
        }
        return view('frontend.article.show', [
            'article'           => $article,
            'categories'        => $categories,
            'selectCategories'  => $selectCategories,
            'conditions'        => $conditions,
            'userId'            => $userId,
            'existOffer'        => $existOffer,
            'countUserOffer'    => $countUserOffer,
            'offerId'           => $offerId
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
            echo "Offer Updated";
        } else {
            $offer = new Offer($postOffer);
            $offer->user_id = \Auth::user()->id;
            $offer->save();
            echo "New Offer Saved";
        }
        // Set the action here, it's working the new and the update
        exit();
    }
}

?>
