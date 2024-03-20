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
use App\Models\ItemDetail;
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
		$pickups = Pickup::with('customer.user')->paginate(10);

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

    	$pickup = Pickup::with('customer.user', 'fundraiser','items.itemDetails')->findOrFail($id);


    	// dd($pickup->items);
    	return view('admin.pickup-request.view-pickup',compact('pickup'));
    }

    //Customer View Pickup
    public function customerViewPickup($id){

    	$pickup = Pickup::with('customer.user', 'fundraiser','items.itemDetails')->findOrFail($id);


    	// dd($pickup->items);
    	return view('customer.pickup-request.view-pickup',compact('pickup'));
    }


    //Admin Pickup update
    public function pickupUpdate(Request $request, $id)
    {

        $itemId = $request->input('item_id');

        // Retrieve the arrays of data from the request
        $itemTypes = $request->input('item_type');
        $itemSizes = $request->input('item_size');
        $itemQuantities = $request->input('item_quantity');
        $itemAmounts = $request->input('item_amount');

        // Validate arrays are of equal length
        if (count($itemTypes) != count($itemSizes) || count($itemTypes) != count($itemQuantities) || count($itemTypes) != count($itemAmounts)) {
            return response()->json(['error' => 'Arrays must have the same length'], 400);
        }

        for ($i = 0; $i < count($itemTypes); $i++) {
            $itemDetail = new ItemDetail();
            $itemDetail->pickup_item_id = $itemId;
            $itemDetail->item_type = $itemTypes[$i];
            $itemDetail->item_size = $itemSizes[$i];
            $itemDetail->item_quantity = $itemQuantities[$i];
            $itemDetail->item_amount = $itemAmounts[$i];
            
            $itemDetail->save(); 
        }  

        if ($itemDetail->save()) {

            $items_amount = itemDetail::where('pickup_item_id','=',$itemId)->sum('item_amount');
            $items_quantity = itemDetail::where('pickup_item_id','=',$itemId)->sum('item_quantity');

            $pickup_items = PickupItem::findOrFail($itemId);

            $pickup_items->quantity = $items_quantity;
            $pickup_items->amount = $items_amount;
            // dd($pickup_items);
            if($pickup_items->save()){
               $pickup=Pickup::find($pickup_items->pickup_id);
               $pickup->amount =  $pickup_items->amount;

               if($pickup->save()){
                    if ($pickup->payment_option == 'Donate') {
                            $donation = Donation::where('pickup_id','=',$pickup->id)->first();
                            $donation->amount = $pickup->amount;
                            $donation->no_of_items = $pickup_items->quantity;
                            if ($donation->save()) {
                                return redirect()->route('admin.pickup.view',['id'=>$id])->with('success', 'Pickup details updated successfully');
                            }
                    }else{
                    return redirect()->route('admin.pickup.view',['id'=>$id])->with('success', 'Pickup details updated successfully');
                }


               }
            }
            // dd($items_quantity);
            // $pickup=Pickup::find($id);
            // $pickup->status = 'Completed';

            // if ($pickup->save()){

            //     if ($pickup->payment_option == 'Donate') {

            //         $donation = Donation::where('pickup_id','=',$pickup->id)->first();
            //         $donation->status = 'Completed';
            //         if ($donation->save()) {
            //             return redirect()->route('admin.pickup.view',['id'=>$id])->with('success', 'Pickup details updated successfully');
            //         }
            //     }else{
            //         return redirect()->route('admin.pickup.view')->with('success', 'Pickup details updated successfully');
            //     }
            // }
        }
           
                                
    }

    //Delete Picktup Items Details
    public function itemDetailsDestroy($id)
    {
        try {
                $ItemDetail = ItemDetail::findOrFail($id);

                
              if ($ItemDetail) {
                $ItemDetail->delete();

                $items_amount = itemDetail::where('pickup_item_id','=',$ItemDetail->pickup_item_id)->sum('item_amount');
                $items_quantity = itemDetail::where('pickup_item_id','=',$ItemDetail->pickup_item_id)->sum('item_quantity');
                
                $pickup_items = PickupItem::findOrFail($ItemDetail->pickup_item_id);

                $pickup_items->quantity = $items_quantity;
                $pickup_items->amount = $items_amount;
                
                if($pickup_items->save()){
               $pickup=Pickup::find($pickup_items->pickup_id);
               $pickup->amount =  $pickup_items->amount;

               if($pickup->save()){
                    if ($pickup->payment_option == 'Donate') {
                            $donation = Donation::where('pickup_id','=',$pickup->id)->first();
                            $donation->amount = $pickup->amount;
                            $donation->no_of_items = $pickup_items->quantity;
                            if ($donation->save()) {
                                return redirect()->back()->with('success', 'Items record deleted successfully!');
                            }
                    }else{
                    return redirect()->back()->with('success', 'Items record deleted successfully!');
                }


               }
            }


                dd($items_amount);
            }

            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user and associated customer.');
        }
    }

    //Edit Pickup items Details
    public function itemDetailsEdit($id)
    {
        $itemDetail = ItemDetail::findOrFail($id);
        return view('admin.pickup-request.edit-pickup-item-details', compact('itemDetail'));
    }

    //Pickup status updated
    public function pickupStatusUpdate(Request $request, $id) {
    // dd($id);
        if ($request->pickup_status == 'Completed') {
            $pickup = Pickup::findOrFail($id);
            $pickup->status = $request->pickup_status;
            if ($pickup->save()) {
                if ($pickup->payment_option == 'Donate') {
                    
                    $fundraiser = Fundraiser::findOrFail($pickup->charity_organization);
                    // dd($pickup->payment_option);
                    
                    $fundraiser->total_balance += $pickup->amount;
                    $fundraiser->current_balance += $pickup->amount;
                    if ($fundraiser->save()) {
                        $donation = Donation::where('pickup_id', '=', $id)->first();
                        $donation->status = 'Completed';
                        if ($donation->save()) {
                            return redirect()->route('admin.pickup.view', ['id' => $id])->with('success', 'Pickup status updated, and the amount sent to the charity account!');
                        }
                    }
                } else {
                    $customer = Customer::findOrFail($pickup->customer_id);
                    $customer->total_balance += $pickup->amount;
                    $customer->current_balance += $pickup->amount;
                    if ($customer->save()) {
                        return redirect()->route('admin.pickup.view', ['id' => $id])->with('success', 'Pickup status updated, and the amount sent to the customer account!');
                    }
                }
            }
        } else {
            return redirect()->back()->with('error', 'Pickup status not changed. Already in "Pending" state');
        }
    }

}
