<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Str;
class AccountsController extends Controller
{
     //Customer Accounts Index
     public function customerIndex(){

     	$customers = User::where('role', '=', 'customer')->with('customer')->paginate(10);
     	return view('admin.accounts.customerIndex',compact('customers'));
     }

     //Fundraiser Accounts Index
     public function fundraiserIndex(){

     	$fundraisers = User::where('role', '=', 'fundraiser')->with('fundraiser')->paginate(10);
     	return view('admin.accounts.fundraiserIndex',compact('fundraisers'));
     }

     //Customer Accounts Search
     public function customerAccountSearch(Request $request)
    {
        $search = $request->input('search');

        // Use Eloquent to retrieve drivers based on the search term
        $customers = User::where('name', 'like', "%$search%")->where('role', '=', 'customer')->paginate(10);

        return view('admin.accounts.customerIndex', compact('customers'));
    }

    //Fundraiser Accounts Search
     public function fundraiserAccountSearch(Request $request)
    {
        $search = $request->input('search');

        // Use Eloquent to retrieve drivers based on the search term
        // $fundraisers = User::where('name', 'like', "%$search%")->where('role', '=', 'fundraiser')->paginate(10);
        
        $fundraisers = User::with('fundraiser')
	    ->whereHas('fundraiser', function ($query) use ($search) {
	        $query->where('company_name', 'like', '%' . $search . '%');
	    })
	    ->where('role', '=', 'fundraiser')
	    ->paginate(10);


        return view('admin.accounts.fundraiserIndex', compact('fundraisers'));
    }

    //Customers Accounts Filters
    public function customerAccountsSortByHighest()
    {
        // $customers = User::where('role', 'customer')
				    // ->with('customer')
				    // ->orderByDesc('customer.current_balance')
				    // ->paginate(10);
    	$customers = User::with('customer')
				    ->where('role', '=', 'customer') // 'customer' instead of 'customers'
				    ->whereHas('customer') // Ensure users have associated customers
				    ->orderByDesc('customers.current_balance') // Order by current balance of associated customers
				    ->paginate(10);
	    dd($customers->all());
        return view('admin.accounts.customerIndex', compact('customers'));
    }

    public function customerAccountsSortByLowest()
    {
        $customers = User::where('role', 'customer')
				    ->with('customer')
				    ->join('customers', 'users.id', '=', 'customers.user_id')
				    ->orderBy('customers.current_balance', 'asc')
				    ->paginate(10);
		// dd($customers);
        return view('admin.accounts.customerIndex', compact('customers'));
    }


    //Admin Customer Claim Balance Request
    public function adminClaimBalance(Request $request, $id)
    {
    	
        // dd($request->all());
        // $role = Auth::user()->role;

        // if($role == 'customer' OR $role == 'fundraiser'){

        // }

    	$user = User::find($request->user_id);

        $date= date('d-m-y');
    	$uuid = Str::uuid();
    	// dd($user);
        if($user->role == 'customer'){
           $customer_create_balance_request = Transaction::create([
            'request_id'=>$uuid,
            'customer_id'=> $id,
            'type'=> $user->role,
            'request_date' => $date,
            'e_transfer_no' => $user->e_transfer_no,
            'status' => 'Pending',
          ]); 
       }else{
          $fundraiser_create_balance_request = Transaction::create([
            'request_id'=>$uuid,
            'fundraiser_id'=> $id,
            'type'=> $user->role,
            'request_date' => $date,
            'e_transfer_no' => $user->e_transfer_no,
            'status' => 'Pending',
          ]);  
       }
    	

    	return redirect()->back()->with('success', 'Claim balance request generated successfully!');
    }

}
