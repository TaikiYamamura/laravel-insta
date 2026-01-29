<div>
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <input type="file" wire:model="media">

        <button type="submit" class="btn default-btn btn-sm">
            Add Story
        </button>
    </form>
</div>

