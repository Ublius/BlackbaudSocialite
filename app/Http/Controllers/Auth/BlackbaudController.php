<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteServiceProvider;
use SocialiteProviders\Blackbaud\BlackbaudExtendSocialite;

class BlackbaudController extends Controller
{
    CONST BLACKBAUD_TYPE = 'blackbaud';

    public function handleBlackbaudRedirect() {
//        return Socialite::driver('blackbaud')->redirect();
        return Socialite::with('blackbaud')->redirect();
    }

    public function handleBlackbaudCallback() {

//        $user = Socialite::driver('blackbaud')->stateless()->user();
//        $userExisted = User::where('facebook_id', $user->id)->first();
//        $user = Socialite::with('blackbaud')->user();
//        $userExisted = User::with('oauth_id', $user->id)->first();
//        if($userExisted) {
//                Auth::login($userExisted);
//                return redirect('/forgot-password');
//
//            }else {
//                $newUser = User::create([
//                    'name' => $user->name,
//                    'email' => $user->email,
//                    'oauth_id'=> $user->id,
//                    'oauth_type'=> 'blackbaud',
//                    'remember_token' => $user->token,
//                ]);
//                Auth::login($newUser);
//                return redirect('/forgot-password');
//            }

        try {
            $user = Socialite::driver('blackbaud')->stateless()->user();
//            $user = Socialite::driver('blackbaud')->user();
//            $user = Socialite::with('blackbaud')->user();
//            $userExisted = User::find('name', $user->name)->first();
            $userExisted = User::with('oauth_id', $user->id)->first();

            if($userExisted) {
                Auth::login($userExisted);
                return redirect('/forgot-password');

            }else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id'=> $user->id,
                    'oauth_type'=> 'blackbaud',
                    'remember_token' => $user->token,
                ]);
                Auth::login($newUser);
                return redirect('/forgot-password');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
