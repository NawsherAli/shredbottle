<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Charity;

class CharityApiController extends Controller
{
    public function index()
    {
        // Retrieve all blogs from the database
        $blogs = Charity::all();

        // Base URL for the images
        $baseUrl = 'https://shredbottle.iotaiy.com/assets/images/charities/';

        // Customize your response as needed
        $response = [
            'data' => $blogs->map(function ($blog) use ($baseUrl) {
                return [
                    'id' => $blog->id,
                    'name' => $blog->name,
                    'short_desc' => $blog->short_desc,
                    'long_desc' => $blog->long_desc,
                    'image' => $baseUrl . $blog->image,  // Generate the full URL for the image
                    'created_at' => $blog->created_at->toDateString(),
                ];
            })
        ];

        // Return the blogs in JSON format
        return response()->json($response);
    }
}