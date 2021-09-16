<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $getInfor = Socialite::driver('google')->user();
        $user = $this->createUser($getInfor, 'google');
        auth()->login($user);
        return redirect()->to('/home');
    }

    public function createUser($getInfor, $provider)
    {
        $user = User::where('provider_id', $getInfor->id)->first();
        if (!$user) {
            $user = User::create([
               'name' => $getInfor->name,
               'email' => $getInfor->email,
               'provider' => $provider,
               'provider_id' => $getInfor->id
            ]);
        }
        return $user;
    }
}
