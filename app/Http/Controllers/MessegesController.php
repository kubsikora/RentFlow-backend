<?php

namespace App\Http\Controllers;

use App\Models\Messege;
use App\Models\Places;
use App\Models\UserMessage;
use App\Models\UserPlaces;
use Illuminate\Http\Request;

class MessegesController extends Controller
{
    public function add(string $messege, string $to, string $level, int $idPlace, int $from)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        $messege = Messege::create(['from_id' => $from, 'to' => $to, 'place_id' => $idPlace, 'importance_level' => $level, 'content' => $messege]);

        if($to == 'roommates')
        {
            $userIdList = UserPlaces::where('place_id', $idPlace)->get()->pluck('resident_id');
            foreach ($userIdList as $userId) {
                UserMessage::create([
                    'from_user_id' => $from,
                    'to_user_id' => $userId,
                    'message_id' => $messege->id
                ]);
            }
            
        } else if ($to == 'owner')
        {
            $userIdList = UserPlaces::where('place_id', $idPlace)->get()->pluck('owner_id');
            foreach ($userIdList as $userId) {
                UserMessage::create([
                    'from_user_id' => $from,
                    'to_user_id' => $userId,
                    'message_id' => $messege->id
                ]);
            }
        } else if ($to == 'all')
        {
            $userIdList = UserPlaces::where('place_id', $idPlace)->get()->pluck('resident_id');
            foreach ($userIdList as $userId) {
                UserMessage::create([
                    'from_user_id' => $from,
                    'to_user_id' => $userId,
                    'message_id' => $messege->id
                ]);
            }

            $userIdList2 = UserPlaces::where('place_id', $idPlace)->get()->pluck('owner_id');
            foreach ($userIdList2 as $userId) {
                UserMessage::create([
                    'from_user_id' => $from,
                    'to_user_id' => $userId,
                    'message_id' => $messege->id
                ]);
            }
        }

        return 1;
    }

    public function getMessage(int $id, string $owner)
    {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        $messages = [];
        if($owner == 'false'){
            $placeid = Places::where('owner_id', $id)->pluck('id');
            foreach ($placeid as $idp) {
                $messages[] = Messege::where('to', 'owner')->where('place_id', $idp)->get();
                $messages[] = Messege::where('to', 'all')->where('place_id', $idp)->get();
            }
        } else {       
            $placeid = UserPlaces::where('resident_id', $id)->pluck('place_id');
            foreach ($placeid as $idp) {
                $messages[] = Messege::where('to', 'roommates')->where('place_id', $idp)->get();
                $messages[] = Messege::where('to', 'all')->where('place_id', $idp)->get();
            }
        }

        return $messages;
    }
}
