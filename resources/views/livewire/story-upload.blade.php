<div>
    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <input type="file" wire:model="media">

        <button type="submit" class="btn btn-primary btn-sm">
            ストーリー追加
        </button>
    </form>
</div>

