<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServicesApiController extends Controller
{
        public function index()
    {
        // Retrieve all services from the database
        $services = Service::all();

        // Base URL for the images
        $baseUrl = 'https://shredbottle.iotaiy.com/assets/images/services/';

        // Customize your response as needed
        $response = [
            'data' => $services->map(function ($service) use ($baseUrl) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'short_desc' => $service->short_desc,
                    'long_desc' => $service->long_desc,
                    'image' => $baseUrl . $service->image,  // Generate the full URL for the image
                    'created_at' => $service->created_at->toDateString(),
                ];
            })
        ];

        // Return the services in JSON format
        return response()->json($response);
    }
}
