<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\PrivateMessage;

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

        return redirect('/' . $username)->withSuccess('Usuario seguido');
    }

    public function unfollow($username, Request $request)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();

        $me->follows()->detach($user);

        return redirect('/' . $username)->withSuccess('Usuario no seguido');
    }

    private function findByUsername($username)
    {
        return User::where('username', '=', $username)->firstOrFail();
    }

    public function sendPrivateMessage(Request $request, $username)
    {
        $user = $this->findByUsername($username);

        $me = $request->user();
        $message = $request->input('message');

        $conversation = Conversation::between($me, $user);

        $privateMessage = PrivateMessage::create([
            'user_id' => $me->id,
            'conversation_id' => $conversation->id,
            'message' => $message
        ]);

        return redirect('/conversations/' . $conversation->id);
    }

    public function showConversation(Conversation $conversation)
    {
        $conversation->load('users', 'privateMessages');

        return view('users.conversation', [
            'conversation' => $conversation,
            'user' => auth()->user()
        ]);
    }

}
