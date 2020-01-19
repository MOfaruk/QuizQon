<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createOrGetUser($getInfo,$provider); 
        auth()->login($user,true); 
        return redirect()->route('home');
    }

    function createOrGetUser($getInfo,$provider)
    {
        $user = User::where('provider_user_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_user_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
