<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{

    public function handle(Request $request, Closure $next)
    {
        if( Auth::check() )
        {
            // if user is not admin take him to his dashboard
            if ( Auth::user()->isUser() ) {
                return redirect()->route('user.index_user');
            }

            // allow admin to proceed with request
            else if ( Auth::user()->isAdmin() ) {
                return $next($request);
            }
        }

       // abort(404);
    }
}
