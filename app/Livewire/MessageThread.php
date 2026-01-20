<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageThread extends Component
{
    public $conversation;
    public $newMessage = '';

    // 3秒ごとに自動更新
    protected $listeners = ['refreshThread' => '$refresh'];

    public function mount(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'required|string|max:1000'
        ]);

        $message = $this->conversation->messages()->create([
            'sender_id' => Auth::id(),
            'body' => $this->newMessage,
        ]);

        $this->newMessage = '';

        // フロント側に「送信されたよ」と通知
        $this->dispatch('message-sent');
    }

    public function markAllAsRead()
    {
        $this->conversation->messages()
            ->whereNull('read_at')
            ->where('sender_id', '!=', Auth::id())
            ->update(['read_at' => now()]);
    }

    public function render()
    {
        $messages = $this->conversation
            ->messages()
            ->latest()
            ->take(50)
            ->get()
            ->reverse();

        // 表示時に既読処理
        foreach ($this->conversation->messages as $message) {
            $this->markAsRead($message->id);
        }


        return view('livewire.message-thread', [
            'messages' => $messages
        ]);
    }

    public function markAsRead($messageId)
    {
        $message = Message::find($messageId);
        if ($message && $message->sender_id !== Auth::id() && !$message->read_at) {
            $message->update(['read_at' => now()]);
        }
    }

}
