<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class FundraiserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role !== 'fundraiser') {
            // abort(403, 'Unauthorized action.');
            // return redirect()->route('error-403');
            if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
            }
            
            if (Auth::user()->role == 'customer') {
            return redirect()->route('customer.dashboard');
            }
        }

        return $next($request);
    }
}
