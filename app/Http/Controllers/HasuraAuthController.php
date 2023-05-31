<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;




class HasuraAuthController extends Controller
{

    public function handleRequest(Request $request)
    {

        $data = $request->input();

        // Access specific properties of the object
        $input = $request->input('input');
        $objects = $input['objects'];
        $email = $objects['email'];

        $client = new Client();
        $url = 'http://graphql-engine:8080/api/rest/getUserDataByEmail';

        $params = [
            'email' => $email,
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'x-hasura-admin-secret' => 'mysecretkey',
        ])->get($url, $params);


        $responseData = $response->json();

        // Access specific values from the response
        //$accessToken = $responseData['accessToken'];
        // Access the ID and RoleId fields
        $userId = $responseData['User'][0]['Id'];
        $roleId = $responseData['User'][0]['UserRoles'][0]['RoleId'];

        // Return a response
        return response()->json([
            'message' => 'Data received successfully',
            //'accessToken' => $accessToken,
            'RoleId' => $roleId,
            'userId' => $userId,
            'expiresIn' => 1
        ]);

    }
}