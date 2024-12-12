<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\UserPlaces;
use App\Models\Users;
use Carbon\Carbon;

class PlacesController extends Controller
{
    public function getOwnerFlat(string $id)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        
        return Places::where('owner_id', $id)
    ->selectRaw("CONCAT(city, ' ', zipcode, ' ', street, ' ', house_nr, ' ', flat_nr) as name, id")
    ->get();

    }

    public function getFlatData(string $id)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        $place = Places::where('id', $id)->first();
        $today = Carbon::now()->format('Y-m-d');

        $residents_id = UserPlaces::where('place_id', $id)
            ->where(function ($query) use ($today) {
                $query->whereNull('end_living')
                    ->orWhere('end_living', '<', $today);
            })
            ->pluck('resident_id');
        $residents = Users::select('users.*', 'users_places.start_living', 'users_places.rooms', 'users_places.end_living')
        ->join('users_places', 'users.id', '=', 'users_places.resident_id')
        ->where('users_places.place_id', $id)
        ->get();

        return ['flat' => $place, 'residents' => $residents];
    }

    public function addToFlat(string $id, string $login, string $data, string $rooms)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        $date = Carbon::createFromFormat('d-m-Y', $data);

        $user_id = Users::where('login', $login)->value('id');
        $owner_id = Places::where('id', $id)->value('owner_id');
        
        UserPlaces::create([
            'resident_id' => $user_id,
            'owner_id' => $owner_id,
            'place_id' => $id,
            'start_living' => $date,
            'rooms' => $rooms,
        ]);

        return 'OK';
    }

    public function editResident(string $room, string $to, string $id)
    {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        if($to !== 'undefined'){
            $date = Carbon::createFromFormat('d-m-Y', $to);
            UserPlaces::where('resident_id', $id)->update(['rooms'=> $room, 'end_living' => $date]);
        }
        else {
            UserPlaces::where('resident_id', $id)->update(['rooms'=> $room]);
        }
    }
}
