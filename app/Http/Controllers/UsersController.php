<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Places;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //             header('Access-Control-Allow-Origin: *');
    //             header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    //             header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    //         return $next($request);
    //     });
    // }
    
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
            'flat_owner' => $dataArray['flat_owner'], 
            'birthday' => sprintf('%04d-%02d-%02d', $dataArray['birth']['year'], $dataArray['birth']['month'], $dataArray['birth']['day']),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'token' => Str::random(10),
        ];

        if ($dataArray['flat_owner'] == 1){

            $user = Users::create($response);

            $addressres = [
                'owner_id' => $user['id'], 
                'rooms' => $dataArray['rooms'], 
                'city' => $dataArray['address']['city'], 
                'zipcode' => $dataArray['address']['zipcode'], 
                'street' => $dataArray['address']['street'], 
                'house_nr' => $dataArray['address']['house_number'], 
                'flat_nr' => $dataArray['address']['flat_number'],
                'place_area' => $dataArray['address']['place_area'],
            ];

            return Places::create($addressres);

        } else {

            return Users::create($response);
            
        }
    }   
    public function AccountDataChange(string $data)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        $decodedData = urldecode($data);
    
        $dataArray = json_decode($decodedData, true);

        $user = Users::where('id', $dataArray['id'])->first();
        if(strlen($dataArray['passwordold']) > 0 && strlen($dataArray['passwordnew']) > 0){

            if ($user && Hash::check($dataArray['passwordold'], $user->hash_password)) { 
                $response = [
                    'hash_password' => Hash::make($dataArray['passwordnew']),
                    'email' => $dataArray['email'],
                    'tel' => $dataArray['phone'],
                ];
                Users::where('id', $dataArray['id'])->update($response);
                return 'OK';
            } else {
                return 'wrong password';
            }
                        
        } else {
            if($dataArray['email'] !== $user->email || $dataArray['phone'] !== $user->tel){
                $response = [
                    'email' => $dataArray['email'],
                    'tel' => $dataArray['phone'],
                ];
                Users::where('id', $dataArray['id'])->update($response);

                return 'OK';
            }
        }

        return $dataArray;
    }   

    public function DeleteAccount(string $id, string $password)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        $user = Users::where('id', $id)->first();
        if ($user && Hash::check(substr($password, 1, -1), $user->hash_password)) { 
            Users::where('id', $id)->delete();
            return 'OK';
        } else {
            return 'wrong password';
        }
    }

    public function GetAccountData(string $id)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        $user = Users::where('id', $id)->get(['email', 'tel'])->first();
        return $user;
    }

    public function login(string $login, string $password)
    {
        $user = Users::where('login', $login)->first();
        unset($user['tel']);
        unset($user['deleted_at']);
        unset($user['created_at']);
        unset($user['birthday']);
        unset($user['email']);
        unset($user['updated_at']);
        if ($user && Hash::check($password, $user->hash_password)) { 
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'wrong password or login'], 401);
        }
    }

}
