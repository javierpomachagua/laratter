<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\CreateMessageRequest;

class MessagesController extends Controller
{

    public function create(CreateMessageRequest $request)
    {
        $user = $request->user();

        $message = Message::create([
            'user_id' => $user->id,
            'content' => $request->input('message'),
            'image' => 'https://picsum.photos/420/320?image=' . mt_rand(0, 1000)
        ]);

        return redirect('/messages/' . $message->id);
    }

    public function show($id)
    {
        try {
            $message = Message::findOrFail($id);

            return view('messages.show', compact('message'));

        } catch (\Exception $e) {
            return view('messages.show', [
                'error' => $e
            ]);
        }
    }
}
