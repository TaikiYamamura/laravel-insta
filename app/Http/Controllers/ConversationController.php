<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function show(User $user)
    {
        // 既存の会話を探す
        $conversation = Conversation::where(function($q) use ($user){
            $q->where('user_one_id', Auth::id())
                ->where('user_two_id', $user->id);
        })->orWhere(function($q) use ($user){
            $q->where('user_one_id', $user->id)
                ->where('user_two_id', Auth::id());
        })->first();

        // なければ作る
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => Auth::id(),
                'user_two_id' => $user->id
            ]);
        }

        return view('dm.show', compact('conversation'));
    }
}
