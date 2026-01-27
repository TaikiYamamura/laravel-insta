<button wire:click="toggle"
        class="follow-btn {{ $isFollowed ? 'following' : 'follow' }}">
    {{ $isFollowed ? 'Following' : 'Follow' }}
</button>
