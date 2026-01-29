<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Story;

class StoryUpload extends Component
{
    use WithFileUploads;

    public $media;

    public function upload()
    {
        $this->validate([
            'media' => 'required|image|max:2048',
        ]);

        $path = $this->media->store('stories', 'public');

        Story::create([
            'user_id' => auth()->id(),
            'media_path' => $path,
            'media_type' => 'image',
            'expires_at' => now()->addDay(),
        ]);

        $this->reset('media');
        $this->dispatch('story-updated');
    }

    public function render()
    {
        return view('livewire.story-upload');
    }
}
