<div class="position-relative">

    {{-- ノート表示 --}}
    @if ($user->note && $user->note->expires_at->isFuture())
        <div class="note-bubble">
            {{ $user->note->body }}
            <div class="note-time">
                ⏰ {{ $this->remainingTime }}
            </div>
        </div>
    @endif

    {{-- 入力（本人のみ） --}}
    @if (auth()->id() === $user->id && (!$user->note || $user->note->expires_at->isPast()))
    <input
        type="text"
        wire:model.defer="body"
        wire:keydown.enter="save"
        class="form-control form-control-sm mt-2"
        placeholder="今なにしてる？（24時間）"
    >
@endif


</div>

