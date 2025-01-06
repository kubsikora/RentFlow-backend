<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\UserPlaces;
use App\Models\Users;
use App\Models\Counters;
use App\Models\CountersData;

class CountersController extends Controller
{
    public function getPlaceLastCountersRead(string $place_id, string $counter_type)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        return CountersData::where('place_id', $place_id)
            ->selectRaw('counter_id, value, MAX(created_at)')
            ->groupBy('counter_id')
            ->get();

    }
}
