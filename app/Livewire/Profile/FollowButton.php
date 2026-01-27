<?php

namespace App\Livewire\Profile;

use App\Models\Follow;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowButton extends Component
{
    public User $user;
    public bool $isFollowed;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowed = $user->isFollowed();
    }

    public function toggle()
    {
        if ($this->isFollowed) {
            // フォロー解除
            Follow::where('following_id', $this->user->id)
                  ->where('follower_id', Auth::id())
                  ->delete();

            $this->isFollowed = false;
        } else {
            // フォロー追加
            Follow::create([
                'following_id' => $this->user->id,
                'follower_id'  => Auth::id(),
            ]);

            $this->isFollowed = true;
        }

        // 最新状態を反映
        $this->user->refresh();
    }

    public function render()
    {
        return view('livewire.profile.follow-button');
    }
}
?>