<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charity;
class CharityController extends Controller
{
    public function index()
    {
    	// $drivers = Driver::all();
         $charities = Charity::paginate(10);
        return view('admin.charities.index',compact('charities'));
    }

    public function create()
    {
        return view('admin.charities.create-charity');
    }

    public function store(Request $request)
    {
    	// dd($request->all());
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/charities'), $imageName);
        }
        $charity = Charity::create([
            'name' => $request->name,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
			'image' => $imageName,
        ]);

        return redirect()->route('charities.index')->with('success', 'Charity added successfully');
    }

    public function edit($id)
    {
        $charity = Charity::findOrFail($id);
        return view('admin.charities.edit-charity', compact('charity'));
    }

    public function update(Request $request, $id)
    {
            // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the driver by ID
        $charity = Charity::findOrFail($id);

        // Update the driver details
        $charity->update([
            'name' => $validatedData['name'],
            'short_desc' => $validatedData['short_desc'],
            'long_desc' => $validatedData['long_desc'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/charities'), $imageName);
            $charity->update(['image' => $imageName]);
        }

        // Redirect to the driver details page or any other appropriate page
        return redirect()->route('charities.index', ['id' => $charity->id])->with('success', 'Charity details updated successfully');
    }

    public function destroy($id)
    {
        $charity = Charity::findOrFail($id);
        $charity->delete();

        return redirect()->route('charities.index')->with('success', 'Charity deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        // Use Eloquent to retrieve charity based on the search term
        $charities = Charity::where('name', 'like', "%$search%")->paginate(10);

        return view('admin.charities.index', compact('charities'));
    }

        public function uploadImage(Request $request){
        // dd($request);
        if ($request->hasFile('upload')) {
                try {
                    $originName = $request->file('upload')->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $request->file('upload')->getClientOriginalExtension();
                    $fileName = $fileName.'_'.time().'.'.$extension;

                    $request->file('upload')->move(public_path('assets/images/charities/'), $fileName);

                    $url = asset('assets/images/charities/'.$fileName); // Add a slash after 'blogs'

                    return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
                
                } catch (\Exception $e) {
                    // Log the error
                    \Log::error('Error uploading file: '.$e->getMessage());

                    // Return an error response
                    return response()->json(['error' => 'Failed to upload image'], 500);
                }
        }

    }
}
