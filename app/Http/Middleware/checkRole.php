<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Roles;


class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = \Auth::user()->id;
        $roles = User::find($userId)->roles;
        foreach($roles as $index => $value) {
            if ($value->name == 'admin') {
                return $next($request);
                break;
            }
        }
        return redirect('home')->with('error','You have not admin access');
    }
}
