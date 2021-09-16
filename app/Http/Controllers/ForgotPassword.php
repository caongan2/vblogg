<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPassword extends Controller
{
    public function forgotPass()
    {
        return view('shop.mail');
    }

    public function sendMailResetPass(Request $request)
    {
        $user = User::where('email', $request->email)->get()->first();

        $timestamp = Carbon::now()->toDateTimeString();
        $token = Hash::make($timestamp);
        $user->remember_token = $token;
        $user->save();
        $users = User::all();
        $message = [
            'type' => 'Success',
            'task' => $user->name,
            'content' => 'Has been created',
            'reset_link' => 'http://127.0.0.1:8000/resetPass?token='.$token
        ];

        SendMail::dispatch($message, $users)->delay(now()->addMinute(1));
        return redirect()->back();
    }

    public function formResetPass(Request $request)
    {
        $token = $request->token;
        return view('shop.reset_pass', compact('token'));
    }

    public function resetPass(Request $request)
    {
        $token = $request->token;
//        dd($token);
        $password = Hash::make($request->password);
        $user = User::where('remember_token', $token)->get()->first();
//        dd($user->name);
        $user->password = $password;
//        dd($user->password);
        $user->save();
        return redirect()->route('login');
    }
}
