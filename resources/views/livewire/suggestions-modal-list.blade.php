<div>
    @foreach ($this->users as $user)
        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" class="rounded-circle avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user icon-sm"></i>
                    @endif
                </a>
            </div>

            <div class="col ps-0">
                <a href="{{ route('profile.show', $user->id) }}"
                   class="fw-bold text-decoration-none">
                   {{ $user->name }}
                </a>
            </div>

            <div class="col-auto">
                <button wire:click="follow({{ $user->id }})"
                        class="btn btn-sm default-btn">
                    Follow
                </button>
            </div>
        </div>
    @endforeach
</div>
