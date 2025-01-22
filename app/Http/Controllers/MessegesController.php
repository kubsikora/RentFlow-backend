<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessegesController extends Controller
{
    public function add(string $messege, string $to, string $level, int $idPlace, int $from)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        Message::create(['from_id' => $from, 'to' => $to, 'place_id' => $idPlace, 'importance_level' => $level, 'content' => $messege]);

        return 1;
    }
}
