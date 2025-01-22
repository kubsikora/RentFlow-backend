<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessegesController extends Controller
{
    public function add(string $messege, string $to, string $level)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        return $messege;
    }
}
