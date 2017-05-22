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
            $image->default = $i;
            $image->name = $response['name'] . "-" . $i;
            if ($i == 0)
            {
                $image->default = 1;
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
        //
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
        $images = $article->images();
        dd($images);
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
        //
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
