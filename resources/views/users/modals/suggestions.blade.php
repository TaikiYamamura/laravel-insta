<!-- Suggestions Modal -->
<div class="modal fade" id="suggestionsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            {{-- header --}}
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Suggestions For You</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            {{-- body --}}
            <div class="modal-body">

                {{-- Livewire：全件表示用 --}}
                <livewire:suggestions-modal-list />
                {{-- hello --}}

            </div>

        </div>
    </div>
</div>
