<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class HasuraAuthController extends Controller
{

    public function handleRequest(Request $request)
    {
        // Get request input
        $email = $request->input('login_inp.email');
        $password = $request->input('login_inp.password');
        $getUserByEmailUrl = 'localhost:8000/api/rest/GetUserByEmail';
        $client = new Client();
    
        $getUserByEmailData = ['email' => $email];

        return response()->json([
                        'accessToken' => '<value>',
                        'userId' => 1,
                        'RoleId' => 1,
                        'expiresIn' => '<value>' // Modify this as per your response data
                    ]);

        // $options = [
        //     'method' => 'GET',
        //     'headers' => [
        //         'Accept' => 'application/json',
        //         'x-hasura-admin-secret' => 'mysecretkey',
        //     ],
        // ];

        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'x-hasura-admin-secret' => 'mysecretkey',
        // ])->get($getUserByEmailUrl, $getUserByEmailData);

        // $data = $response->json(); // Get the response as an associative array
        // // Process the data as needed
        // $UserEmail = $data['email'];
        // $UserId = $data['id'];


        // if ($email==$UserEmail){
        //     return response()->json([
        //             'accessToken' => '<value>',
        //             'userId' => $UserId,
        //             'RoleId' => 1,
        //             'expiresIn' => '<value>' // Modify this as per your response data
        //         ]);
        // }
        
    }
}