<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\FundraisersResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fundraiser;
use App\Models\User;
use App\Models\Donation;

class FundraiserApiController extends Controller
{
        //View single fundraiser details for admin
        public function fundraisersList()
        {

            $fundraisers = User::with('fundraiser')->where('role', 'fundraiser')->get();
            return FundraisersResource::collection($fundraisers);

        }
}
