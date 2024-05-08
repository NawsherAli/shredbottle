<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        // $drivers = Driver::all();
         $materials = Material::paginate(10);
        return view('admin.materials.index',compact('materials'));
    }

    public function create()
    {
        return view('admin.materials.create-material');
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
            $image->move(public_path('assets/images/materials'), $imageName);
        }
        $material = Material::create([
            'name' => $request->name,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'image' => $imageName,
        ]);

        return redirect()->route('materials.index')->with('success', 'Material added successfully');
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('admin.materials.edit-material', compact('material'));
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
        $material = Material::findOrFail($id);

        // Update the driver details
        $material->update([
            'name' => $validatedData['name'],
            'short_desc' => $validatedData['short_desc'],
            'long_desc' => $validatedData['long_desc'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/materials'), $imageName);
            $material->update(['image' => $imageName]);
        }

        // Redirect to the driver details page or any other appropriate page
        return redirect()->route('materials.index', ['id' => $material->id])->with('success', 'Material details updated successfully');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Material deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        // Use Eloquent to retrieve charity based on the search term
        $materials = Material::where('name', 'like', "%$search%")->paginate(10);

        return view('admin.materials.index', compact('materials'));
    }

        public function uploadImage(Request $request){
        // dd($request);
        if ($request->hasFile('upload')) {
                try {
                    $originName = $request->file('upload')->getClientOriginalName();
                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
                    $extension = $request->file('upload')->getClientOriginalExtension();
                    $fileName = $fileName.'_'.time().'.'.$extension;

                    $request->file('upload')->move(public_path('assets/images/materials/'), $fileName);

                    $url = asset('assets/images/materials/'.$fileName); // Add a slash after 'blogs'

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
