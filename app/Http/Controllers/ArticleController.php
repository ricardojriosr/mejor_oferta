<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cocur\Slugify\Slugify;
use App\Category;
use App\Subcategory;
use App\Article;
use App\ImageArticle;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('id','DESC')->paginate(8);
        $articles->each(function($articles) {
            $articles->category;
            $articles->subcategory;
            $articles->images;
        });
        return view('backend.articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        return view('backend.articles.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::Find($id);
        $article->category;
        $article->subcategory;
        $article->images;
        return view('backend.articles.detail', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::Find($id);
        $images = ImageArticle::where('article_id','=',$article->id)->get();
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        return view('backend.articles.edit', ['categories' => $categories, 'article' => $article, 'images' => $images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->fill($request->all());
        $article->save();
        $images = ImageArticle::where('article_id','=',$id)->get();
        foreach ($images as $image) {
            $image->default = 0;
            if ($image->article_images_id == $request->default) {
                $image->default = 1;
            }
            $image->save();
        }
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
