<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialApiController extends Controller
{
    public function index()
    {
        // Retrieve all blogs from the database
        $blogs = Material::all();

        // Customize your response as needed
        $response = [
            'data' => $blogs->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'name' => $blog->name,
                    'short_desc' => $blog->short_desc,
                    'long_desc' => $blog->long_desc,
                    'image' => $blog->image,
                    'created_at' => $blog->created_at->toDateString(),
                ];
            })
        ];

        // Return the blogs in JSON format
        return response()->json($response);
    }
}
