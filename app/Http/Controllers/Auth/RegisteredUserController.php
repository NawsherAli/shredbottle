<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Fundraiser;
use App\Models\Customer;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function storePersonal(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['nullable','numeric','digits:11'],
            'e_transfer_no' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'e_transfer_no' => $request->e_transfer_no,
            'status' => 'active',
            'role' => 'customer',
            'is_online' => 'true',
            'password' => Hash::make($request->password),
        ]);

        $customer = Customer::create([
            'user_id'=>$user->id,
            ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::CUSTOMERHOME);
    }

    //Store Fundraiser 

    public function storeFundraiser(Request $request){
        // dd($request->all());
        $request->validate([
            'company_name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'contact' => 'required|string|max:20',
            'e_transfer_no' => 'required|string|max:255',
            'charity_type' => 'required|string',
            'vission_mission' => 'required|string',
            'password' => 'required|string|min:6|confirmed'
        ]);

        // Create a new User instance
        $user = new User();
        $user->name = $request->input('fullname');
        $user->email = $request->input('company_email');
        $user->password = bcrypt($request->input('password'));
        $user->e_transfer_no = $request->input('e_transfer_no');
        $user->contact = $request->input('contact');
        $user->status = 'active';
        $user->role ='fundraiser';
        $user->is_online ='true';
        // Save the user data to the database
        if ($user->save()) {
            
            // Create a new Fundraiser instance
            $fundraiser = new Fundraiser();
            $fundraiser->company_name = $request->input('company_name');
            $fundraiser->charity_type = $request->input('charity_type');
            $fundraiser->vision_mission = $request->input('vission_mission');
            
            // Associate the Fundraiser with the User
            $fundraiser->user()->associate($user);

            if( $fundraiser->save()){
              Auth::login($user); 
              return redirect(RouteServiceProvider::FUNDRAISERHOME); 
            }
        }
        
        // return redirect()->route('success.page')->with('success', 'Fundraiser registered successfully!');
    }
}
