<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
            // return redirect()->route('login');
                    if($request->user()->role === 'admin'){
                        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
                        // return redirect()->intended(RouteServiceProvider::HOME);
                    }
                    
                    if($request->user()->role === 'fundraiser'){
                        
                        // return redirect()->intended(RouteServiceProvider::FUNDRAISERHOME);
                        //  dd($request->user()->role);
                        return redirect()->intended(RouteServiceProvider::FUNDRAISERHOME.'?verified=1');
                    }
                    
                    if($request->user()->role === 'customer'){
                        
                        // return redirect()->intended(RouteServiceProvider::CUSTOMERHOME);
                        return redirect()->intended(RouteServiceProvider::CUSTOMERHOME.'?verified=1');
                    }
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        // return redirect()->route('login');
         if($request->user()->role === 'admin'){
                return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
                // return redirect()->intended(RouteServiceProvider::HOME);
            }
            
            if($request->user()->role === 'fundraiser'){
                
                // return redirect()->intended(RouteServiceProvider::FUNDRAISERHOME);
                //  dd($request->user()->role);
                return redirect()->intended(RouteServiceProvider::FUNDRAISERHOME.'?verified=1');
            }
            
            if($request->user()->role === 'customer'){
                
                // return redirect()->intended(RouteServiceProvider::CUSTOMERHOME);
                return redirect()->intended(RouteServiceProvider::CUSTOMERHOME.'?verified=1');
            }
    }
}
