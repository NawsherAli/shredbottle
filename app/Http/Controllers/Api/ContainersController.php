<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupItem;

class ContainersController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Display a listing of the resource.
     */
    public function containers()
    {
        
        // Retrieve totals from the database
        $totals = PickupItem::select(
            \DB::raw('SUM(no_of_bags) as total_bags'),
            \DB::raw('SUM(no_of_boxes) as total_boxes'),
            \DB::raw('SUM(req_no_boxes) as total_req_boxes')
        )->first();

        // Extract the totals
        $totalBags = $totals->total_bags ?? 0;
        $totalBoxes = $totals->total_boxes ?? 0;
        $totalReqBoxes = $totals->total_req_boxes ?? 0;
        $total_containers= $totalBags+$totalBoxes+ $totalReqBoxes; 

        $response = [
            'data' => [
                [
                    'totalBags' => $totalBags,
                    'totalBoxes' => $totalBoxes,
                    'totalReqBoxes' => $totalReqBoxes,
                    'total_containers' => $total_containers,
                ]
            ]
        ];
        return response()->json($response);
    }
}
