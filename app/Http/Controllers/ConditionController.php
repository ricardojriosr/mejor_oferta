<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Condition;
use Cocur\Slugify\Slugify;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = Condition::orderBy('id', 'DESC')->paginate(8);
        return view('backend.conditions.index', ['conditions' => $conditions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.conditions.create');
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
        $condition = new Condition($response);
        $condition->save();
        return redirect()->route('backend.conditions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condition = Condition::Find($id);
        return view('backend.conditions.detail', ['condition' => $condition]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $condition = Condition::Find($id);
        return view('backend.conditions.detail', ['condition' => $condition]);
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
        $condition = Condition::Find($id);
        $condition->fill($response);
        $condition->save();
        return redirect()->route('conditions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $condition = Condition::Find($id);
        $condition->delete();
        return redirect()->route('conditions.index');
    }
}
