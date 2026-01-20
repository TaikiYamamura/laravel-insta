<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentSection extends Component
{
    public $post;
    public $newComment;

    public function mount($post)
    {
        $this->post = $post;
        $this->newComment = '';
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|string|max:500',
        ]);

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'body' => $this->newComment,
        ]);

        $this->newComment = '';
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Auth::id() === $comment->user_id) {
            $comment->delete();
        }
    }

    public function render()
    {
        // Blade 側で最新のコメントを直接取得
        $comments = $this->post->comments()->latest()->get();

        return view('livewire.comment-section', [
            'comments' => $comments,
        ]);
    }
}
