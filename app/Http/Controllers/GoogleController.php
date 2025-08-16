<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->scopes(['openid', 'profile', 'email'])->redirect();
    }

    public function handle()
    {
        try 
        {
            $googleUser = Socialite::driver('google')->user();
        } catch(\Exception $err) {
            return redirect('/login')->with('error', 'Google authentication failed');
        }

        if (!$googleUser->getEmail()) 
        {
            abort(400, 'No email address returned from Google.');
        }

        $user = User::updateOrCreate($googleUser);

        Auth::login($user, true);
        return redirect('/dashboard');

    }
}