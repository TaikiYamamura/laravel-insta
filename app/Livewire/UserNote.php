<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;

class UserNote extends Component
{
    public $user;
    public $body = '';

    public function mount($user)
    {
        $this->user = $user;
        $this->body = optional($user->note)->body;
    }

    public function save()
    {
        $this->validate([
            'body' => 'required|max:100',
        ]);

        Note::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'body' => $this->body,
                'expires_at' => now()->addDay(),
            ]
        );

        $this->user->refresh();
    }

    public function getRemainingTimeProperty()
    {
        if (!$this->user->note) return null;

        return now()->diffForHumans(
            $this->user->note->expires_at,
            ['parts' => 1, 'short' => true]
        );
    }

    public function render()
    {
        return view('livewire.user-note');
    }
}

