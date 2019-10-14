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
        $existOffer = false;
        $userId = 0;
        $user = auth()->user();
        $userId = $user->id;
        $categories = Category::orderBy('id', 'DESC')->get();
        $article = Article::where('slug', $article_slug)->firstOrFail();
        $selectCategories = Category::orderBy('name','ASC')->pluck('name','id');
        $conditions = Condition::orderBy('condition','ASC')->pluck('condition','id');
        $countUserOffer = Offer::where('user_id',$userId)->where('article_id', $article->id)->first();
        if ($countUserOffer) {
            $existOffer = true;
        }
        return view('frontend.article.show', [
            'article'           => $article,
            'categories'        => $categories,
            'selectCategories'  => $selectCategories,
            'conditions'        => $conditions,
            'userId'            => $userId,
            'existOffer'        => $existOffer,
            'countUserOffer'    => $countUserOffer
        ]);
    }

    public function newOffer(Request $request) 
    {
        $postOffer = $request->all();
        $offer = new Offer($response);
        $offer->user_id = \Auth::user()->id;
        $offer->save();
        exit();
    }
}

?>
