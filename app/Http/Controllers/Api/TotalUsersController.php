<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TotalUsersController extends Controller
{
    public function countTotalUsers()
    {
        $totalUsers = User::count();

        $response = [
            'data' => [
                [
                    'total_users' => $totalUsers,
                ]
            ]
        ];
        return response()->json($response);
    }
}
