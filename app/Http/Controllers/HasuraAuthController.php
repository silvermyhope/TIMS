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
        $url = 'http://localhost:8080/api/rest/GetUserByEmail';

        $params = [
            'email' => $email,
        ];

        $options = [
            'method' => 'GET',
            'headers' => [
                'Accept' => 'application/json',
                'x-hasura-admin-secret' => 'mysecretkey',
            ],
            'query' => $params,
        ];

        //$response = $client->request('GET', $url, $options);
        $response = Http::get($url, $params);

        // Get the response body as a string
        //$responseBody = $response->getBody()->getContents();
        $responseData = $response->json();

        // Decode the JSON response body into an array
       // $responseData = json_decode($responseBody, true);

        // Access the required data from the response
        $accessToken = $responseData['accessToken'];
        $roleId = $responseData['RoleId'];
        $userId = $responseData['userId'];

        // Return a response
        return response()->json([
            'message' => 'Data received successfully',
            'accessToken' => $accessToken,
            'RoleId' => $roleId,
            'userId' => $userId,
            'expiresIn' => 1
        ]);

    }
}