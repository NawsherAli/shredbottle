<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fundraiser;
use App\Models\ProfileRequest;
class ProfileRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $requests = ProfileRequest::with('user')->orderBy('created_at', 'desc')->paginate(10);
        // dd($requests->all());
        return view('admin.profile-requests.index',compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'company_name' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'charity_type' => 'required|string',
            'e_transfer_no' => 'required|string',
            'address' => 'required|string',
            'vission_mission' => 'nullable|string',
        ]);
        // dd($request->all());
        // Create a new profile request
        $profileRequest = ProfileRequest::create($validatedData + ['user_id' => auth()->id()]);

        return redirect()->back()->with('success', 'Profile request sent successfully.');
    }

    //Search Profile Request by Company Name
    public function requestSearch(Request $request)
    {
        $search = $request->input('search');
        
        // Use Eloquent to retrieve drivers based on the search term
        $requests = ProfileRequest::where('company_name', 'like', "%$search%")              ->with('user')
                    ->paginate(10);

        return view('admin.profile-requests.index',compact('requests'));
    }

    //Profile Request Filter
    //Filter Pickup Requests
    public function requestFilter(Request $request)
    {
        $query = ProfileRequest::with('user');

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

        $requests = $query->paginate(10);

        return view('admin.profile-requests.index',compact('requests'));
    }

    //View Profile Request
    public function profileRequestView($id){

        $request_data = ProfileRequest::findOrFail($id);
        $request_data->update(['is_read' => 'yes']);
        $old_data = User::with('fundraiser')->findOrFail($request_data->user_id);

        // dd($old_data);
        return view('admin.profile-requests.view-request',compact('request_data','old_data'));
    }

    //Update Profile Request 
    public function requestUpdate(Request $request, $id)
    {
        $request_data = ProfileRequest::findOrFail($id);
        $user = User::findOrFail($request_data->user_id);

        $user->update([
        'name' =>$request_data->name,
        'email'=>$request_data->email,
        'contact'=>$request_data->contact,
        'e_transfer_no'=>$request_data->e_transfer_no,
         ]);


        $fundraiser =Fundraiser::where('user_id','=',$user->id)->first();
        $fundraiser->update([
        'company_name' =>$request_data->company_name,
        'vision_mission'=>$request_data->vission_mission,
        'charity_type'=>$request_data->charity_type,
        'address'=>$request_data->address,
         ]);

        // dd($fundraiser);
        return redirect()->back()->with('success', 'Profile updated successfully!');
        
    }
}
