<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fundraiser;
use App\Models\User;
use App\Models\Donation;
class FundraiserController extends Controller
{
	//view all fundraiser for admin
    public function adminIndex()
    {
    	// $drivers = Driver::all();
         $fundraisers = User::where('role', '=', 'fundraiser')->with('fundraiser')->paginate(1);
        return view('admin.fundraiser-donation.charities',compact('fundraisers'));
    }

    //view all funcdraiser for customer
    public function customerIndex()
    {
    	// $drivers = Driver::all();
         $fundraisers = User::where('role', '=', 'fundraiser')->with('fundraiser')->paginate(1);
        return view('customer.fundraiser.index',compact('fundraisers'));
    }

    //View single fundraiser details for admin
    public function adminFundraiserView($id)
    {
        $user = User::with('fundraiser')->findOrFail($id);
       $donations = Donation::with('donor.user','charity','pickup.items.itemDetails')->where('charity_id','=',$user->fundraiser->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.fundraiser-donation.view-charity', ['user' => $user,'donations'=> $donations]);
    }

    //View single fundraiser details for customer
    public function customerFundraiserView($id)
    {
        $user = User::with('fundraiser')->findOrFail($id);
       
        return view('customer.fundraiser.fundraiser-details', ['user' => $user]);
    }

    //admin search fundraiser
    public function adminFundraiserSearch(Request $request)
    {
        $search = $request->input('search');

        // Use Eloquent to retrieve drivers based on the search term

        $search = $request->input('search');

        // Use Eloquent to retrieve drivers based on the search term
        $fundraisers = User::where('role', '=', 'fundraiser')
					    ->whereHas('fundraiser', function ($query) use ($search) {
					        $query->where('company_name', 'like', "%$search%");
					    })
					    ->with('fundraiser') // Eager load the fundraiser relationship
					    ->paginate(10);

        return view('admin.fundraiser-donation.charities', compact('fundraisers'));
    }

     //customer search fundraiser
    public function customerFundraiserSearch(Request $request)
    {
        $search = $request->input('search');

        // Use Eloquent to retrieve drivers based on the search term

        $search = $request->input('search');

        // Use Eloquent to retrieve drivers based on the search term
        $fundraisers = User::where('role', '=', 'fundraiser')
					    ->whereHas('fundraiser', function ($query) use ($search) {
					        $query->where('company_name', 'like', "%$search%");
					    })
					    ->with('fundraiser') // Eager load the fundraiser relationship
					    ->paginate(10);

        return view('customer.fundraiser.index', compact('fundraisers'));
    }

    //admin fundraiser donations
    public function fundraiserDonations()
    {
        $donations = Donation::with('donor.user','charity')->paginate(10);
        return view('admin.fundraiser-donation.index',compact('donations'));
    }

        //Search Donations
    //Search fundraiser Donation for admin
    public function adminDonationSearch(Request $request){
        $search = $request->input('search');
        
        $donations = Donation::with('donor.user', 'charity')
        ->whereHas('charity', function ($query) use ($search) {
            $query->where('company_name', 'like', '%' . $search . '%');
        })
        ->orWhereHas('donor.user', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->paginate(10);

        // dd($pickups->all());
        return view('admin.fundraiser-donation.index', compact('donations'));
    }



    //Filter fundraiser Donations for admin
     public function adminSortByLatest()
    {
        $donations = Donation::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.fundraiser-donation.index', compact('donations'));
    }

    public function adminSortByHighest()
    {
        $donations = Donation::orderBy('amount', 'desc')->paginate(10);

        return view('admin.fundraiser-donation.index', compact('donations'));
    }
}
