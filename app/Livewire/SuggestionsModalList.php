<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class SuggestionsModalList extends Component
{
    public function follow($userId)
    {
        Follow::firstOrCreate([
            'follower_id'  => Auth::id(),
            'following_id' => $userId,
        ]);
    }

    public function getUsersProperty()
    {
        // ★ ここが変更点
        $followingIds = Auth::user()
            ->following()
            ->pluck('following_id');

        return User::where('id', '!=', Auth::id())
            ->whereNotIn('id', $followingIds)
            ->get();
    }

    public function render()
    {
        return view('livewire.suggestions-modal-list');
    }
}


