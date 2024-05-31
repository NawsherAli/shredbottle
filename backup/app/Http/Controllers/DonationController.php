<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Pickup;
use App\Models\PickupItem;
use App\Models\Fundraiser;
use App\Models\Donation;

class DonationController extends Controller
{
    
	//Show Donations on admin side
	public function adminIndex(){
		
	        // $donations = Donation::with('donor.user','charity')->orderBy('created_at', 'desc')->paginate(10);
	     $donations = Donation::with('donor.user','charity','pickup.items.itemDetails')->paginate(10);
    	return view('admin.donations.index', compact('donations'));
    }


    //Show Donations on customer side
    public function customerIndex(){

    	$user = Auth::user();
	    $user_name = $user->name;
	    $customer = Customer::where('user_id',$user->id)->first();
	     
	    // Ensure the user is authenticated and the customer is found
	    if ($user && $customer) {
	        $donations = Donation::with('donor.user','charity')->where('donor_id','=',$customer->id)->orderBy('created_at', 'desc')->paginate(2);
	        // dd($donations->all());
	    }else{
	    	$donations = [];
	    }
    	return view('customer.donations.index', compact('donations'));
    }
    //Show Donations on Fundraiser Side
    public function fundraiserIndex(){

        $user = Auth::user();
        $fundraiser = Fundraiser::where('user_id',$user->id)->first();
         
        // Ensure the user is authenticated and the customer is found
        if ($user && $fundraiser) {
            $donations = Donation::with('donor.user','charity')->where('charity_id','=',$fundraiser->id)->paginate(10);
            // dd($donations->all());
        }else{
            $donations = [];
        }
        return view('fundraiser.donations.index', compact('donations'));
    }
    //Search Donations
    //Search Donation for admin
	public function adminDonationSearch(Request $request){
		$search = $request->input('search');
		
		$donations = Donation::with('donor.user', 'charity')
        ->whereHas('charity', function ($query) use ($search) {
            $query->where('company_name', 'like', '%' . $search . '%');
        })
        ->orWhereHas('donor.user', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->paginate(2);

		// dd($pickups->all());
		return view('admin.donations.index', compact('donations'));
	}
    //Search Donation for customer
	public function customerDonationSearch(Request $request){
		$search = $request->input('search');
		 
        $user = Auth::user();
	    $customer = Customer::where('user_id',$user->id)->first();

		$donations = Donation::with('donor.user', 'charity')
	    ->whereHas('charity', function ($query) use ($search) {
	        $query->where('company_name', 'like', '%' . $search . '%');
	    })
	    ->where('donor_id', '=', $customer->id)
	    ->paginate(10);

		// dd($pickups->all());
		return view('customer.donations.index', compact('donations'));
	}

    //Search Donation for fundraiser
    public function fundraiserDonationSearch(Request $request){
        $search = $request->input('search');
        // dd($search);
        $user = Auth::user();
        $fundraiser = Fundraiser::where('user_id',$user->id)->first();

        $donations = Donation::with('donor.user', 'charity')
        ->whereHas('charity', function ($query) use ($search) {
            $query->where('company_name', 'like', '%' . $search . '%');
        })
        ->orWhereHas('donor.user', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->where('charity_id', '=', $fundraiser->id)
        ->paginate(2);

        // dd($pickups->all());
        return view('fundraiser.donations.index', compact('donations'));
    }



	//Filter Donations for admin
	 public function adminSortByLatest()
    {
        $donations = Donation::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.donations.index', compact('donations'));
    }

    public function adminSortByHighest()
    {
        $donations = Donation::orderBy('amount', 'desc')->paginate(10);

        return view('admin.donations.index', compact('donations'));
    }

    //Filter Donations for Customer
	 public function customerSortByLatest()
    {
        $user = Auth::user();
        $customer = Customer::where('user_id',$user->id)->first();
        $donations = Donation::orderBy('created_at', 'desc')
        ->where('donor_id', '=', $customer->id)->paginate(10);

        return view('customer.donations.index', compact('donations'));
    }

    public function customerSortByHighest()
    {
        $user = Auth::user();
        $customer = Customer::where('user_id',$user->id)->first();

        $donations = Donation::orderBy('amount', 'desc')
        ->where('donor_id', '=', $customer->id)->paginate(10);
        
         return view('customer.donations.index', compact('donations'));
    }

     //Filter Donations for fundraiser
     public function fundraiserSortByLatest()
    {
        $user = Auth::user();
        $fundraiser = Fundraiser::where('user_id',$user->id)->first();

        $donations = Donation::where('charity_id','=',$fundraiser->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('fundraiser.donations.index', compact('donations'));
    }

    public function fundraiserSortByHighest()
    {
        $user = Auth::user();
        $fundraiser = Fundraiser::where('user_id',$user->id)->first();

        $donations = Donation::where('charity_id','=',$fundraiser->id)->orderBy('amount', 'desc')->paginate(10);

        return view('fundraiser.donations.index', compact('donations'));
    }


    public function adminDonorView($id)
    {
    	$donor_user = User::with('customer')->where('id','=',$id)->first();
    	// dd($donor_user);
    	return view('admin.donations.donar-details', compact('donor_user'));
    }

    //customer money donation
    public function donateNow()
    {
        $fundraisers  = Fundraiser::all();
        return view('customer.fundraiser.donate-now',compact('fundraisers'));
    }

    //Donate Money
    //customer money donation
    public function donateMoney(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $customer = Customer::where('user_id',$user->id)->first();

        if($customer->current_balance >= $request->amount){

            // Validate the form data
            $validatedData = $request->validate([
                'charity_type' => 'required',
                'charity_name' => 'required',
                'amount' => 'required|numeric|min:0',
            ]);

            // Create a new Donation instance
            $donation = new Donation();
            $donation->donor_id = $customer->id;
            $donation->charity_type = $validatedData['charity_type'];
            $donation->charity_id = $validatedData['charity_name'];
            $donation->amount = $validatedData['amount'];
            $donation->status = 'Completed';
            // Save the Donation instance
            // $donation->save();
            if($donation->save()){
                $customer->current_balance = $customer->current_balance - $donation->amount;

                if($customer->save()){

                    $fundraiser = Fundraiser::findOrFail($validatedData['charity_name']);

                    $fundraiser->total_balance = $fundraiser->total_balance + $donation->amount;
                    $fundraiser->current_balance = $fundraiser->current_balance + $donation->amount;

                    if($fundraiser->save()){
                        return redirect()->route('customer.donations')->with('success', 'Donation submitted successfully!');
                    }
                }
            }
        }else{
            return redirect()->route('donate.now')->with('error', 'You have not enough money to  donate');
        }
        // $fundraisers  = Fundraiser::all();
        
    }
}
