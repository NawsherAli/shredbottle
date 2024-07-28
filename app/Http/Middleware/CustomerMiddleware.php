<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role !== 'customer') {
            // abort(403, 'Unauthorized action.');
            // return redirect()->route('customer.dashboard');
            if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
            }
            
            if (Auth::user()->role == 'fundraiser') {
            return redirect()->route('fundraiser.dashboard');
            }
        }
          return $next($request);  
        
        
    }
}
