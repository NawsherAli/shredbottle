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

class PickupController extends Controller
{
    //Create Pickup Request
	Public function create()
    {
    	$fundraisers =Fundraiser::all(); 
    	return view('customer.pickup-request.index',compact('fundraisers'));
    }


    //Sotre Pickup Request
    public function store(Request $request)
	{


	    // Validate the form data
	    $request->validate([
	        'pickup_location' => 'required|string',
	        'pickup_date' => 'required|date',
	        'pickup_contact' => 'required|numeric',
	        'pickup_items.*.items_type' => 'required|string',
	        'pickup_items.*.no_of_bags' => 'required|numeric',
	        'pickup_items.*.no_of_boxes' => 'required|numeric',
	        // Add more validation rules for other fields
	    ]);

	   	$userWithCustomer = User::with('customer')->find(auth()->id());
	    // dd($userWithCustomer->all());

		if (!$userWithCustomer->customer->address) {
		   return redirect()->route('pickup.create')->with('error', 'Please complete your profile!');
		}  
	    
	   	// dd($pickup);
	    // Create Pickup
	    $pickup = Pickup::create([
	    	'customer_id'=>$userWithCustomer->customer->id,
	        'pickup_location' => $request->input('pickup_location'),
	        'pickup_date' => $request->input('pickup_date'),
	        'pickup_contact' => $request->input('pickup_contact'),
	        'pickup_service' => $request->input('pickup_service'),
	        'payment_option' => $request->input('payment_option'),
	        'charity_type' => $request->input('charity_type'),
	        'charity_organization' => $request->input('charity_organization'),
	     ]);

	        $totalBags = 0;
		    $totalBoxes = 0;

		    // Create Pickup Items
		    // dd( $pickup );
		    foreach ($request->input('pickup_items') as $item) {


		        PickupItem::create([
		            'pickup_id' => $pickup->id,
		            'items_type' => $item['items_type'],
		            'no_of_bags' => $item['no_of_bags'],
		            'no_of_boxes' => $item['no_of_boxes'],
		            'req_no_boxes' => $item['req_items_no_bags'],
		            // Add more fields based on your form
		        ]);

		        // Update total bags and boxes
		        $totalBags += $item['no_of_bags'];
		        $totalBoxes += $item['no_of_boxes'];
		    }

		    // Update total_items in pickups table
		    $pickup->update([
		        'total_items' => $totalBags . ' Bags ' . $totalBoxes . ' Boxes',
		    ]);

		    if($request->input('payment_option') == 'Donate'){

		    	Donation::create([
		            'donor_id' => $userWithCustomer->customer->id,
		            'charity_type' => $request->input('charity_type'),
		            'charity_id' => $request->input('charity_organization'),
		            'pickup_id' => $pickup->id,
		        ]);

		    }

	    // Redirect or return a response
	    return redirect()->route('pickup.create')->with('success', 'Pickup created successfully');
	}

	//Admin Pickup Request
	public function adminPickupIndex(){
		$pickups = Pickup::with('customer.user')->orderBy('created_at', 'desc')->paginate(10);
		return view('admin.pickup-request.index',compact('pickups'));
	}

	//Search Pickup Request
	public function pickupSearch(Request $request){
		$search = $request->input('search');
		// dd($search);
		$pickups = Pickup::whereHas('customer.user', function ($query) use ($search) {
	        $query->where('name', 'like', '%' . $search . '%');
	    })
	    ->with(['customer.user' => function ($query) use ($search) {
	        $query->where('name', 'like', '%' . $search . '%');
	    }])
	    ->orderBy('created_at', 'desc')
	    ->paginate(10);
		// dd($pickups->all());
		return view('admin.pickup-request.index',compact('pickups'));
	}

	//Filter Pickup Requests
	public function pickupFilter(Request $request)
    {
        $query = Pickup::with('customer.user');

        if ($request->has('sort')) {
            $sort = $request->input('sort');

            switch ($sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'completed':
                    $query->where('status', 'Completed');
                    break;
                case 'pending':
                    $query->where('status', 'Pending');
                    break;
                default:
                    // handle any other cases or defaults
                    break;
            }
        }

        $pickups = $query->paginate(10);

        return view('admin.pickup-request.index', compact('pickups'));
    }

    //Admin View Pickup
    public function adminViewPickup($id){

    	$pickup = Pickup::with('customer.user', 'fundraiser','items')->findOrFail($id);


    	// dd($pickup->items);
    	return view('admin.pickup-request.view-pickup',compact('pickup'));
    }

    //Customer View Pickup
    public function customerViewPickup($id){

    	$pickup = Pickup::with('customer.user', 'fundraiser','items')->findOrFail($id);


    	// dd($pickup->items);
    	return view('customer.pickup-request.view-pickup',compact('pickup'));
    }


    //Admin Pickup update
    public function pickupUpdate(Request $request, $id)
    {
    	$pickup=Pickup::find($id);
    	$total_amount  = $request->input('amount_of_bottles') + $request->input('amount_of_electronics') + $request->input('amount_of_clothes') ;
    		$total_items = $request->input('quantity_of_bottels') + $request->input('quantity_of_electronics') + $request->input('quantity_of_clothes') ;
		 
    	
    	$pickup_bottles_items = PickupItem::where('pickup_id',$id)->where('items_type','=','bottles')->first();
    	$pickup_bottles_items->amount = $request->input('amount_of_bottles');
    	$pickup_bottles_items->quantity = $request->input('quantity_of_bottels');
    	

    	$pickup_electronics_items = PickupItem::where('pickup_id',$id)->where('items_type','=','Electronics')->first();
    	$pickup_electronics_items->amount = $request->input('amount_of_electronics');
    	$pickup_electronics_items->quantity = $request->input('quantity_of_electronics');
    	

    	$pickup_clothes_items = PickupItem::where('pickup_id',$id)->where('items_type','=','Clothes')->first();
    	$pickup_clothes_items->amount = $request->input('amount_of_clothes');
    	$pickup_clothes_items->quantity = $request->input('quantity_of_clothes');

    	if($pickup_bottles_items->save() && $pickup_electronics_items->save() && $pickup_clothes_items->save())
    	{
    		
    		$pickup=Pickup::find($id);
    		$total_amount  = $request->input('amount_of_bottles') + $request->input('amount_of_electronics') + $request->input('amount_of_clothes') ;
    		$total_items = $request->input('quantity_of_bottels') + $request->input('quantity_of_electronics') + $request->input('quantity_of_clothes');
    		
    		$pickup->amount = $total_amount;
    		$pickup->status = 'Completed';
    		
    		if ($pickup->save()) {
    			
                if ($pickup->payment_option == 'Donate') {
                    
                    $donation = Donation::where('pickup_id','=',$pickup->id)->first();
                    $donation->amount = $total_amount;
        			$donation->no_of_items = $total_items;
        			$donation->status = 'Completed';

        			if ($donation->save()) {

        				$fundraiser = Fundraiser::find($donation->charity_id);
        				$fundraiser->total_balance = $fundraiser->total_balance + $total_amount;
        				$fundraiser->current_balance = $fundraiser->current_balance + $total_amount;

        				if ($fundraiser->save()) {
        					return redirect()->route('admin.pickup')->with('success', 'Pickup details updated successfully');
        				}
        			}
                }else{
                    
                    $customer = Customer::find($pickup->customer_id);
                    // dd($customer);
                    $customer->total_balance = $customer->total_balance + $total_amount;
                    $customer->current_balance = $customer->current_balance + $total_amount;

                    if ($customer->save()) {
                            return redirect()->route('admin.pickup')->with('success', 'Pickup details updated successfully');
                    }
                }
    		}

    	}

    	

    	// foreach ($picup_items as $picup_item) {
    	// 	dd($picup_item->amount);
    	// }
    }
}
