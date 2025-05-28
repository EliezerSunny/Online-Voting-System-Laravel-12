<div>
    {{-- The Master doesn't talk, he acts. --}}


    
    <flux:modal name="edit-position" class="md:w-800">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Position</flux:heading>
                <flux:text class="mt-2">Update Position.</flux:text>
            </div>
 

            <flux:input wire:model="code" label="Code" placeholder="Code" />

            <flux:input wire:model="name" label="Position Name" placeholder="Position Name" />

            <flux:input wire:model="party" label="Party" placeholder="Party" />
 
            <div class="flex">
                <flux:spacer />
 
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>






</div>
