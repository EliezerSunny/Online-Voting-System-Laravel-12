<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}


    <flux:modal name="edit-role" class="md:w-800">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Role</flux:heading>
                <flux:text class="mt-2">Update Role.</flux:text>
            </div>
 

            <flux:input wire:model="name" label="Role Name" placeholder="Role Name" />

            <flux:input wire:model="guard_name" label="Guard Nmae" placeholder="Guard Nmae" />
 
            <div class="flex">
                <flux:spacer />
 
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>




</div>
