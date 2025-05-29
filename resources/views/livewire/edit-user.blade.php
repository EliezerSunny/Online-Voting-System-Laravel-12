<div>
    {{-- The Master doesn't talk, he acts. --}}

    <flux:modal name="edit-user" class="md:w-800">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update User</flux:heading>
                <flux:text class="mt-2">Update User.</flux:text>
            </div>
 
            <flux:input label="Assign as Admin (True Or False)" wire:model="is_admin" placeholder="Assign as Admin" />
            <flux:input label="User Name" wire:model="username" placeholder="User Name" />
            <flux:input label="Email" wire:model="email" placeholder="User Emai" />
            {{-- <flux:input wire:model="image" label="Profile Picture" type="file" /> --}}

                {{-- @if ($photo)
                <img class="w-50" src="{{ $photo->temporaryUrl() }}" alt="">
                    @endif --}}

                    {{-- <div wire:loading wire:target="image">Uploading...</div> --}}
 
            <div class="flex">
                <flux:spacer />
 
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>


</div>
