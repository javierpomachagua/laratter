<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SocialProfile;
use Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * 
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * 
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        session()->flash('facebookUser', $user);

        return view('users.facebook', [
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $data = session('facebookUser');

        $username = $request->input('username');

        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'avatar' => $data->avatar,
            'username' => str_random(16)
        ]);

        $profile = SocialProfile::create([
            'social_id' => $data->id,
            'user_id' => $user->id
        ]);

        auth()->login($user);

        return redirect('/');
    }
}
