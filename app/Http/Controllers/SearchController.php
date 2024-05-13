<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Obtain an access token
        $tokenResponse = Http::asForm()->post(env('OAUTH_ENDPOINT_URL'), [
            'grant_type' => 'client_credentials',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'resource' => env('RESOURCE_ID'), 
        ]);
    
        if ($tokenResponse->successful()) {
            // Extract the access token
            $accessToken = $tokenResponse->json()['access_token'];
    
            // Make the API request with the access token
            $apiResponse = Http::withToken($accessToken)->get(env('OAUTH_ENDPOINT_URL'));
    
            if ($apiResponse->successful()) {
                // decode
                $data = $apiResponse->json();
                
                // Pass the data
                return view('pages.apt', ['data' => $data]);
            }
            
            else {
                
                $error = $apiResponse->status();
                return redirect()->back()->with('error', 'Failed to fetch data from the API.');
            }
        } else {

            $error = $tokenResponse->status();
            return redirect()->back()->with('error', 'Failed to obtain access token.');
        }
    }
    }




