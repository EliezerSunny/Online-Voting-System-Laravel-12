<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}


    <flux:modal name="edit-permission" class="md:w-800">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Permission</flux:heading>
                <flux:text class="mt-2">Update Permission.</flux:text>
            </div>
 

            <flux:input wire:model="name" label="Permission Name" placeholder="Permission Name" />

            <flux:input wire:model="guard_name" label="Guard Nmae" placeholder="Guard Nmae" />
 
            <div class="flex">
                <flux:spacer />
 
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>




</div>
