<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

{{-- <x-layouts.app :title="__('PostForm')"> --}}

    <flux:modal name="edit-post" class="md:w-800">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Post</flux:heading>
                <flux:text class="mt-2">Update your Post.</flux:text>
            </div>
 
            <flux:input label="Title" wire:model="title" placeholder="Post Title" />
            <flux:input label="Content" wire:model="content" placeholder="Post Content" />
            <flux:input wire:model="photo" label="Photo" type="file" />

                {{-- @if ($photo)
                <img class="w-50" src="{{ $photo->temporaryUrl() }}" alt="">
                    @endif --}}

                    <div wire:loading wire:target="photo">Uploading...</div>
 
            <div class="flex">
                <flux:spacer />
 
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>

{{-- </x-layouts.app> --}}


</div>
