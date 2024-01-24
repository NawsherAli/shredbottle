<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fundraiser;
use App\Models\User;
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
       
        return view('admin.fundraiser-donation.view-charity', ['user' => $user]);
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
}
