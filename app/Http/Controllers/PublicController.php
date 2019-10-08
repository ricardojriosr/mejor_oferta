<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Offerimage;
use App\Article;
use App\Category;
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
        $categories = Category::orderBy('id', 'DESC')->get();
        $article = Article::where('slug', $article_slug)->firstOrFail();
        return view('frontend.article.show', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }
}

?>
