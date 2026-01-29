<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Story;

class StoryBar extends Component
{
    protected $listeners = ['story-updated' => '$refresh'];

    public function render()
    {
        $stories = Story::where('expires_at', '>', now())
            ->whereIn('user_id', [
                auth()->id(),
                ...auth()->user()->following->pluck('id')
            ])
            ->with('user')
            ->latest()
            ->get()
            ->groupBy('user_id');

        return view('livewire.story-bar', compact('stories'));
    }
}
