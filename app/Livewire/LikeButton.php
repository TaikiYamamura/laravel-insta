<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeButton extends Component
{
    public $post;
    public $liked;

    public function mount($post)
    {
        $this->post = $post;
        $this->liked = $post->isLiked();
    }

    public function toggleLike()
    {
        if($this->liked) {
            Like::where('post_id', $this->post->id)
                ->where('user_id', Auth::id())
                ->delete();
            $this->liked = false;
        } else {
            Like::create([
                'post_id' => $this->post->id,
                'user_id' => Auth::id(),
            ]);
            $this->liked = true;
        }

        $this->post->refresh();
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}

