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
use App\Models\ItemDetail;
use App\Models\Transaction;
class DashboardController extends Controller
{
    //Admin Dashboard
	public function adminDashboard()
	{ 
		//////////////////Donation Card Data & Shred Items Card //////////////////
		
		//total donation & donated items
		$total_donations = Donation::where('status','=','Completed')->sum('amount');
		$donated_items_quantity =PickupItem::sum('quantity');
		
		//this week donation & donated items
		$startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        
        $this_week_donation = Donation::where('status','=','Completed')
        					  ->whereBetween('created_at', [$startDate, $endDate])
        					  ->sum('amount');

        $this_week_donated_items_quantity =PickupItem::whereBetween('created_at', 								[$startDate, $endDate])
        					  			  ->sum('quantity');
		
		//Donation Time Calculation
         $latestDonation = Donation::latest()->first();
         // dd($latestDonation);
        if ($latestDonation) {
            $lastDonationTime = $latestDonation->created_at;
            $donationtimeElapsed = Carbon::now()->diffForHumans($lastDonationTime);
        }else{
        	$donationtimeElapsed = 0;
        }

	       
        ////////////////////////Donation Card End/////////////////////////////////
        //////////////////////// Pickup Card /////////////////////////////////////

        //Total pickup requests
		$totalRequests = Pickup::count();

		$thisweektotalPickups = Pickup::whereBetween('created_at', [$startDate, $endDate])->count();

		//pickups time calculation
        $latestPickup = Pickup::latest()->first();
        $pickupstimeElapsed = '';
        if ($latestPickup) {
            $latestPickupTime = $latestPickup->created_at;
            $pickupstimeElapsed = Carbon::now()->diffForHumans($latestPickupTime);
        }
        //////////////////////// Pickup Card End ///////////////////////////////
       
        
        /////////////////////// Latest pickup and donations ///////////////////
	    $pickups = Pickup::with('customer.user')->orderBy('created_at', 'desc')->paginate(5);
	    $donations = Donation::with('donor.user','charity','pickup.items.itemDetails')->orderBy('created_at', 'desc')->paginate(5);

	    // dd($donations->all());
	    /////////////////////// End Latest pickup and donations //////////////////
		
		return view('admin.dashboard',compact('pickups','donations','totalRequests','thisweektotalPickups','donationtimeElapsed','pickupstimeElapsed','donated_items_quantity','total_donations','this_week_donation','this_week_donated_items_quantity' ));
	}

    //Customer Dashboard
	public function customerDashboard()
	{
	    $user = Auth::user();
	    // $user_name = $user->name;
	    $customer = Customer::where('user_id',$user->id)->first();

	    //calculate user donated amount
	    $user_donated_amount = Donation::where('donor_id','=',$customer->id)->sum('amount');
		$user_cashout_amount = Transaction::where('customer_id','=',$customer->id)->where('status','Completed')->sum('amount');
		 

	    //this week amounts
		$startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $this_week_donation = Donation::where('donor_id','=',$customer->id)->whereBetween('created_at', [$startDate, $endDate])->sum('amount');

        $this_week_total_cashout_amount  = Pickup::where('customer_id','=',$customer->id)
        ->where('payment_option','=','Cashout')
        ->whereBetween('created_at', [$startDate, $endDate])->sum('amount');


        $this_week_total_cashout = Transaction::where('customer_id','=',$customer->id) ->whereBetween('created_at', [$startDate, $endDate])->where('status','Completed')->sum('amount');

		// Ensure the user is authenticated and the customer is found
	    if ($user && $customer) {
	        $pickups = Pickup::with('customer.user','items.itemDetails')->where('customer_id','=',$customer->id)->orderBy('created_at', 'desc')->paginate(5);


	        $donations = Donation::with('donor.user','charity','pickup.items.itemDetails')->where('donor_id','=',$customer->id)->orderBy('created_at', 'desc')->paginate(5);
	   
	   }else{
	    	$pickups =[];
	    	$donations=[];
	    }

	    //
		return view('customer.dashboard',compact('pickups','donations','customer','user_donated_amount','this_week_total_cashout','this_week_donation','user_cashout_amount','this_week_total_cashout_amount'));
	}

	//Fundraiser Dashboard
	public function fundraiserDashboard()
	{
		$user = Auth::user();
	    $fundraiser = Fundraiser::where('user_id',$user->id)->first();


	    $user_cashout_amount = Transaction::where('fundraiser_id','=',$fundraiser->id)->where('status','Completed')->sum('amount');

	    $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        //Pending Donation

        $pending_donations = Donation::where('charity_id','=',$fundraiser->id)->where('status','=','Pending')->sum('amount');
	    //this week donation
	    $thisweekdonation = Donation::where('charity_id','=',$fundraiser->id)->whereBetween('created_at', [$startDate, $endDate])->where('status','=','Completed')->sum('amount');
	    $thisweekpendingdonation = Donation::where('charity_id','=',$fundraiser->id)->whereBetween('created_at', [$startDate, $endDate])->where('status','=','Pending')->sum('amount');

	    //latest donations
	    $donations = Donation::where('charity_id','=',$fundraiser->id)->with('donor.user','charity')->orderBy('created_at', 'desc')->paginate(5);

		return view('fundraiser.dashboard',compact('fundraiser','thisweekdonation','donations','pending_donations','thisweekpendingdonation','user_cashout_amount'));
	}
}
