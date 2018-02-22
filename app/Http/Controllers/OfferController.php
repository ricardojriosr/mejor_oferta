<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Condition;
use App\Offer;
use Cocur\Slugify\Slugify;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::orderBy('id', 'DESC')->paginate(8);
        $offers->each(function($offers) {
            $offers->condition;
            $offers->article;
        });
        $articles = Article::orderBy('name','ASC')->pluck('name','id');
        return view('backend.offers.index', ['offers' => $offers, 'articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conditions = Condition::orderBy('condition','ASC')->pluck('condition','id');
        $articles = Article::orderBy('name','ASC')->pluck('name','id');
        return view('backend.offers.create', ['conditions' => $conditions, 'articles' => $articles]);
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
        $offer = new Offer($response);
        $offer->user_id = \Auth::user()->id;
        $offer->save();
        return redirect()->route('offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Offer::Find($id);
        return view('backend.offers.detail', ['offer' => $offer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conditions = Condition::orderBy('condition','ASC')->pluck('condition','id');
        $articles = Article::orderBy('name','ASC')->pluck('name','id');
        $offer = Offer::Find($id);
        $offer->condition;
        $offer->article;
        return view('backend.offers.edit', ['offer' => $offer, 'conditions' => $conditions, 'articles' => $articles]);
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
        $response = $request->all();
        $offer = Offer::Find($id);
        $offer->fill($response);
        $offer->save();
        return redirect()->route('offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::Find($id);
        $offer->delete();
        return redirect()->route('offers.index');
    }
}
