<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(8);
        $users->each(function($user) {
            $user->roles;
        });
        return view('backend.roles.index', [
            'users' => $users, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userInfo = User::find($id);
        $userInfo->Roles;
        return view('backend.roles.show', [
            'userInfo' => $userInfo, 
        ]);
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
        $user = User::find($id);
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('roles.index');
    }

    // Function to Update User Role
    public function updateRole(Request $request) 
    {
        $resp = $request->all();
        $user = User::find($resp['user_id']);
        $role_admin = Role::where('name', 'admin')->first();
        $role_user  = Role::where('name', 'user')->first();
        $user->roles()->detach();
        if ((isset($resp['user_admin'])) && ($resp['user_admin'] == 'on')) {
            $user->roles()->attach($role_admin);
        } else {
            $user->roles()->attach($role_user);
        }
        return redirect()->route('roles.show', $resp['user_id']);
    }
}
