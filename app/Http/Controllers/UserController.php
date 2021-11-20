<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function createInfo(Request $parameters)
    {
        $token = UserInfo::where('access_token', $parameters['access_token'])->pluck('access_token')->first();
        if ($token == null) {
            $user = new UserInfo([
                'name' => $parameters['name'],
                'job' => $parameters['job'],
                'address' => $parameters['address'],
                'year_of_birth' => $parameters['year_of_birth'],
                'access_token' => $parameters['access_token']
            ]);
            $user->save();
            $response = UserInfo::where('access_token', $parameters['access_token'])->pluck('access_token')->first();
            Log::debug(response($response));
            return response($response);
        }   
        return response("null");
    }
    public function checkNewUser(Request $request)
    {
        $response = UserInfo::where('access_token', $request->token)->pluck('access_token');
        Log::debug(count($response));
        if (count($response) == 0) {
            return "false";
        } return "true";
    }

    public function getUserInfo(Request $request)
    {
        $response = UserInfo::where('access_token', $request->token)->first();
        return response($response);
    }

    public function getRule(Request $request)
    {
        Log::debug($request->access_token);
        $response = UserInfo::where('access_token', $request->access_token)->select('is_writable')->first();
        Log::debug($response['is_writable']);
        if ($response['is_writable'] == TRUE) {
            
            return "true";
        }
        return "false";
    }
}
