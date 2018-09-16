<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($username)
    {
        $user = $this->findByUsername($username);

        return view('users.show', compact('user'));
    }

    public function follows($username)
    {
        $user = $this->findByUsername($username);
        $follows = $user->follows;

        return view('users.follows', compact('user', 'follows'));
    }

    public function followers($username)
    {
        $user = $this->findByUsername($username);
        $follows = $user->followers;

        return view('users.follows', compact('user', 'follows'));
    }

    public function follow($username, Request $request)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();

        $me->follows()->attach($user);

        return redirect('/'.$username)->withSuccess('Usuario seguido');
    }

    public function unfollow($username, Request $request)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();

        $me->follows()->detach($user);

        return redirect('/'.$username)->withSuccess('Usuario no seguido');
    }

    private function findByUsername($username)
    {
        return User::where('username', '=', $username)->first();
    }
}
