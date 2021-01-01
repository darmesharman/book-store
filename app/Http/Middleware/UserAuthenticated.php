<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if( Auth::check() )
        {
            // if user admin take him to his dashboard
            if ( Auth::user()->isAdmin() ) {
                return redirect()->route('admin.index_book_admin');
            }

            // allow user to proceed with request
            else if ( Auth::user()->isUser() ) {
                return $next($request);
            }
        }

        abort(404);
    }
}
