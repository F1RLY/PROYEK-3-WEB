<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {

                $user = User::create([
                'kode' => uniqid('USR'),
                'name' => $googleUser->name,
                'username' => explode('@', $googleUser->email)[0],
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => bcrypt('123456dummy')
            ]);
            }

            Auth::login($user);

            return redirect('/');

        } catch (Exception $e) {

            dd($e->getMessage());
        }
    }
}