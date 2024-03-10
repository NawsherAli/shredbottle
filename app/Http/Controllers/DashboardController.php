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
use Carbon\Carbon;
class DashboardController extends Controller
{
    //Admin Dashboard
	public function adminDashboard()
	{ 
		//Total donation amount 
		$totalAmount = Donation::sum('amount');

		//Total pickup requests
		$totalRequests = Pickup::count();

		//Total Items
		$totalQuantity = PickupItem::sum('quantity');

		//this week amount
		$startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $thisweektotalAmount = Donation::whereBetween('created_at', [$startDate, $endDate])->sum('amount');

         $thisweektotalPickups = Pickup::whereBetween('created_at', [$startDate, $endDate])->count();
         $thisweektotalQuantity = PickupItem::whereBetween('created_at', [$startDate, $endDate])->sum('quantity');
        //Donation Time Calculation
         $latestDonation = Donation::latest()->first();
         // dd($latestDonation);
        if ($latestDonation) {
            $lastDonationTime = $latestDonation->created_at;
            $donationtimeElapsed = Carbon::now()->diffForHumans($lastDonationTime);
        }else{
        	$donationtimeElapsed = 0;
        }
        
        //pickups time calculation
        $latestPickup = Pickup::latest()->first();
        $pickupstimeElapsed = '';
        if ($latestPickup) {
            $latestPickupTime = $latestPickup->created_at;
            $pickupstimeElapsed = Carbon::now()->diffForHumans($latestPickupTime);
        }

	    $pickups = Pickup::with('customer.user')->orderBy('created_at', 'desc')->paginate(5);
	    $donations = Donation::with('donor.user','charity')->orderBy('created_at', 'desc')->paginate(2);

		return view('admin.dashboard',compact('pickups','donations','totalAmount','thisweektotalAmount','totalRequests','thisweektotalPickups','totalQuantity','thisweektotalQuantity','donationtimeElapsed','pickupstimeElapsed'));
	}

    //Customer Dashboard
	public function customerDashboard()
	{
	    $user = Auth::user();
	    $user_name = $user->name;
	    $customer = Customer::where('user_id',$user->id)->first();

	    $userTotalDonation = Donation::where('donor_id','=',$customer->id)->sum('amount');
	    //this week amount
		$startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $thisweektotalAmount = Pickup::where('customer_id','=',$customer->id)->where('status','=','Completed')->where('payment_option','=','Cashout')->whereBetween('created_at', [$startDate, $endDate])->sum('amount');

         $thisweekdonation = Donation::where('donor_id','=',$customer->id)->whereBetween('created_at', [$startDate, $endDate])->sum('amount');

		// Ensure the user is authenticated and the customer is found
	    if ($user && $customer) {
	        $pickups = Pickup::with('customer.user')->where('customer_id','=',$customer->id)->orderBy('created_at', 'desc')->paginate(2);
	        $donations = Donation::with('donor.user','charity')->where('donor_id','=',$customer->id)->orderBy('created_at', 'desc')->paginate(2);
	        // dd($donations->all());
	    }else{
	    	$pickups =[];
	    	$donations=[];
	    }

	    //
		return view('customer.dashboard',compact('pickups','donations','customer','thisweektotalAmount','userTotalDonation','thisweekdonation'));
	}

	//Fundraiser Dashboard
	public function fundraiserDashboard()
	{
		$user = Auth::user();
	    $fundraiser = Fundraiser::where('user_id',$user->id)->first();

	    $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        //Pending Donation

        $pending_donations = Donation::where('charity_id','=',$fundraiser->id)->where('status','=','Pending')->sum('amount');
	    //this week donation
	    $thisweekdonation = Donation::where('charity_id','=',$fundraiser->id)->whereBetween('created_at', [$startDate, $endDate])->sum('amount');

	    //latest donations
	    $donations = Donation::where('charity_id','=',$fundraiser->id)->with('donor.user','charity')->orderBy('created_at', 'desc')->paginate(5);

		return view('fundraiser.dashboard',compact('fundraiser','thisweekdonation','donations','pending_donations'));
	}
}
