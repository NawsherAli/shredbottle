<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Customer;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the admin's profile form.
     */
    public function adminEdit(Request $request): View
    {   
            return view('admin.setting.index', [
            'user' => $request->user(),
            ]);
    }
    /**
     * Display the customer's profile form.
     */
    public function customerEdit(Request $request): View
    {   

        $userWithCustomer = User::with('customer')->find(auth()->id());
        return view('customer.setting.index', [
            'user' => $userWithCustomer,
        ]);
    }

    /**
     * Display the customer's profile form.
     */
    public function fundraiserEdit(Request $request): View
    {   

        $userWithFundraiser = User::with('fundraiser')->find(auth()->id());
        return view('fundraiser.setting.index', [
            'user' => $userWithFundraiser,
        ]);
    }
    /**
     * Update the admin's profile information.
     */
    public function adminUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the image validation rules
            'name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'nullable|numeric|digits:11',
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
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');
        
    }
    /**
     * Update the user's profile information.
     */
    public function customerUpdate(ProfileUpdateRequest $request): RedirectResponse
    {
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

    //funcdraiser profile image update code
    public function updateProfilePicture(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust the validation rules as needed
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Delete old profile picture if exists
        if ($user->profile_image != 'no-profile.png') {
            // Delete the old profile picture
            $oldImagePath = public_path('assets/images/avatars/' . $user->profile_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Store the new profile picture
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/images/avatars'), $imageName);
        // dd($imageName);
        // Update the user's profile picture path in the database
        $user->update(['profile_image' => $imageName]);

        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }
}
