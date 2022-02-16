<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{
    /**
     * Redirects the user to the  socialite provider.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handles the login flow for the socialite driver.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        // TODO Check rootstack account

        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            $user->update([
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        } else {
            $user = User::create([
                'name' => $googleUser->name,
                'password' => Hash::make(Str::random(10)),
                'email' => $googleUser->email,
                'avatar' => $googleUser->avatar,
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }
}
