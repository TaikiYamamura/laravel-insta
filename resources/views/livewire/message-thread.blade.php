<div>
    <div
        class="dm-box"
        wire:poll.3s
        x-data
        x-init="
            $nextTick(() => {
                const box = $el;
                box.scrollTop = box.scrollHeight;
            });

            window.addEventListener('message-sent', () => {
                const box = $el;
                box.scrollTop = box.scrollHeight;
            });
        "
        style="max-height:400px; overflow-y:auto;"
    >
        @foreach($messages as $message)
    <div class="d-flex mb-2 {{ $message->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
        <span class="text-muted xsmall me-1">
            @if($message->read_at && $message->sender_id === auth()->id())
                既読
            @endif
        </span>

        
        {{-- 相手のメッセージのときだけ左にアバター --}}
        @if ($message->sender_id !== auth()->id())
            @if ($message->sender->avatar)
                <img src="{{ $message->sender->avatar }}"
                    class="rounded-circle me-2"
                    style="width:32px; height:32px;">
            @else
                <i class="fa-solid fa-circle-user text-secondary me-2"></i>
            @endif
        @endif

        <span class="d-inline-block p-2 rounded
            {{ $message->sender_id === auth()->id() ? 'bg-info text-white' : 'bg-light' }}">
            {{ $message->body }}
        </span>

        {{-- 自分のメッセージのときだけ右にアバター --}}
        @if ($message->sender_id === auth()->id())
            @if (auth()->user()->avatar)
                <img src="{{ auth()->user()->avatar }}"
                    class="rounded-circle ms-2"
                    style="width:32px; height:32px;">
            @else
                <i class="fa-solid fa-circle-user text-secondary ms-2"></i>
            @endif
        @endif
    </div>
@endforeach

    </div>

    <form wire:submit.prevent="sendMessage" class="mt-2 d-flex">
        <input
            type="text"
            wire:model.defer="newMessage"
            class="form-control me-2"
            placeholder="Type a message..."
        >
        <button class="btn btn-primary">Send</button>
    </form>
</div>
