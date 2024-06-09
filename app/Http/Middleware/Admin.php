<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// Remove the unused import statement
// use Symfony\Component\HttpFoundation\Response;

use App\Models\User; // Add the missing import statement

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && method_exists(auth()->user(), 'isAdmin') && auth()->user()->role == 'admin') {
            return $next($request);
        }

        return redirect('home')->with('error',"You don't have admin access");
    }
}
