<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Customer;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function customerEdit(Request $request): View
    {   
        return view('customer.setting.index', [
            'user' => $request->user() ,
        ]);

        // $role = Auth::user()->role;

        // if($role == 'admin'){
        //      return view('admin.profile.edit', [
        //     'user' => $request->user(),
        // ]);
             
        // }if($role == 'fundraiser'){

        // }else{
        //      return view('customer.setting.index', [
        //     'user' => $request->user(),
        //     ]);
        // }
    }

    /**
     * Update the user's profile information.
     */
    public function customerUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules
            'name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'nullable|numeric|digits:11',
            'e_transfer_no' => 'nullable|numeric',
            'address' => 'nullable|string',
        ]);

        // Get the authenticated user
        $user = Auth::user();


        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/avatars'), $imageName);
            $user->profile_image = $imageName;
        }

        // Update other user information
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->e_transfer_no = $request->input('e_transfer_no');
        $user->save();

        $customer =Customer::where('user_id','=',$user->id);
       
        $customer->update([
        'address' =>$request->input('address'),
         ]);


        return redirect()->back()->with('success', 'Profile updated successfully!');
        
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
