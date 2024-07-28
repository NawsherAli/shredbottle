<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialApiController extends Controller
{
        public function index()
    {
        // Retrieve all materials from the database
        $materials = Material::all();

        // Base URL for the images
        $baseUrl = 'https://shredbottle.iotaiy.com/assets/images/materials/';

        // Customize your response as needed
        $response = [
            'data' => $materials->map(function ($material) use ($baseUrl) {
                return [
                    'id' => $material->id,
                    'name' => $material->name,
                    'short_desc' => $material->short_desc,
                    'long_desc' => $material->long_desc,
                    'image' => $baseUrl . $material->image,  // Generate the full URL for the image
                    'created_at' => $material->created_at->toDateString(),
                ];
            })
        ];

        // Return the materials in JSON format
        return response()->json($response);
    }
}
