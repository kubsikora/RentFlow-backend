<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends Controller
{
    public function check(string $login){
        $list = Users::where('login', $login)->get();
        if(count($list) == 0){
            return 0;
        } else {
            return 1;
        }
    }

    public function storeOwner(string $data)
    {
        $decodedData = urldecode($data);
    
        $dataArray = json_decode($decodedData, true);
    
        $response = [
            'login' => $dataArray['logs']['login'],
            'hash_password' => Hash::make($dataArray['logs']['password']),
            'name' => $dataArray['name'],
            'surname' => $dataArray['surname'],
            'email' => $dataArray['mail'],
            'tel' => $dataArray['tel'],
            'flat_owner' => 0, 
            'birthday' => sprintf('%04d-%02d-%02d', $dataArray['birth']['year'], $dataArray['birth']['month'], $dataArray['birth']['day']),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    
        return Users::create($response);
    }    

    public function login(string $login, string $password)
    {
        $user = Users::where('login', $login)->first();
        if ($user && Hash::check($password, $user->hash_password)) { 
            return response()->json(1, 200);
        } else {
            return response()->json(['message' => 'wrong password or login'], 401);
        }
    }
}
