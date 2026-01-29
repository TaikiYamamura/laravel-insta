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
        @php $lastDate = null; @endphp

@foreach($messages as $message)
    @if ($lastDate !== $message->created_at->toDateString())
        <div class="text-center text-muted small my-2">
            —— {{ $message->created_at->format('Y/m/d') }} ——
        </div>
        @php $lastDate = $message->created_at->toDateString(); @endphp
    @endif

    <div class="d-flex mb-3 {{ $message->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}" style="position: relative">
        <div class="text-muted xsmall" style="display:inline-block; position: absolute; top: 40px; right: 43px; font-size: 8px">
            <div>
            @if($message->read_at && $message->sender_id === auth()->id())
                既読
            @endif
            </div>
        </div>

        {{-- 相手のメッセージのときだけ左にアバター --}}
        @if ($message->sender_id !== auth()->id())
            @if ($message->sender->avatar)
                <img src="{{ $message->sender->avatar }}"
                    class="rounded-circle me-2"
                    style="width:32px; height:32px;">
            @else
                <i class="fa-solid fa-circle-user me-2"></i>
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
        <button class="btn default-btn">Send</button>
    </form>
</div>
