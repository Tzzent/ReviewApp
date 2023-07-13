<?php

namespace App\Http\Controllers\Auth\Social;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function callback()
    {
        $google_user = Socialite::driver('google')->user();

        $user = User::where('email', $google_user->email)->first();

        if (!$user) {
            $avatar = Image::create([
                'name' => $google_user->getName(),
                'secure_url' => $google_user->getAvatar(),
            ]);

            $user = User::create([
                'name' => $google_user->getName(),
                'email' => $google_user->getEmail(),
                'image_id' => $avatar->id,
                'provider' => 'google',
                'provider_id' => $google_user->getId(),
            ]);
        }

        Auth::login($user->load('image'));

        return redirect()->route('welcome');
    }
}
