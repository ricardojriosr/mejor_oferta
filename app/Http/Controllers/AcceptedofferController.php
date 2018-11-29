<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Offer;
use App\Acceptedoffer;

class AcceptedofferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acceptedoffers = Acceptedoffer::orderBy('id','DESC')->paginate(8);
        $acceptedoffers->each(function($acceptedoffers) {
            $acceptedoffers->article;
            $acceptedoffers->offer;
        });
        return view('backend.acceptedoffers.index', ['acceptedoffers' => $acceptedoffers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articlesExcept = Acceptedoffer::select('article_id')->get();
        $offersExcept   = Acceptedoffer::select('offer_id')->get();
        $articles = Article::orderBy('name','ASC')->whereNotIn('id', $articlesExcept)->pluck('name','id');
        $offers = Offer::orderBy('price','DESC')->whereNotIn('id', $offersExcept)->pluck('id','id');
        return view('backend.acceptedoffers.create', ['articles' => $articles, 'offers' => $offers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $request->all();
        $acceptedoffers = new Acceptedoffer($response);
        $acceptedoffers->save();
        return redirect()->route('acceptedoffers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acceptedoffer = Acceptedoffer::Find($id);
        $acceptedoffer->article;
        $acceptedoffer->offer;
        $acceptedoffer->offer->condition;
        return view('backend.acceptedoffers.detail', ['acceptedoffer' => $acceptedoffer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $acceptedoffer = Acceptedoffer::Find($id);
        $acceptedoffer->delete();
        return redirect()->route('acceptedoffers.index');
    }
}
