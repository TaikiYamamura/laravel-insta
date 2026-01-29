<div class="row shadow-sm rounded-3 py-3 px-2 box_color">

    {{-- header --}}
    {{-- hello --}}
    <div class="col-auto my-2">
        <p class="fw-bold mb-0">Suggestions For You</p>
    </div>

    <div class="col text-end my-2">
        <a href="#"
           class="fw-bold text-decoration-none pe-5"
           data-bs-toggle="modal"
           data-bs-target="#suggestionsModal">
           See all
        </a>
    </div>

    {{-- users --}}
    @foreach ($this->suggestions as $user)
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
                <button
                    wire:click="follow({{ $user->id }})"
                    class="btn btn-sm default-btn">
                    <i class="fa-regular fa-plus"></i> Follow
                </button>
            </div>
        </div>
    @endforeach

    {{-- remaining count --}}
    @if ($this->suggestionsCount > 5)
        <div class="text-center small text-muted mt-2">
            他に {{ $this->suggestionsCount - 5 }} 人のユーザーがいます
        </div>
    @endif

</div>
