<div>
    {{-- Success is as dangerous as failure. --}}



    <flux:modal name="edit-candidate" class="md:w-800" >
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Candidate</flux:heading>
                <flux:text class="mt-2">Update Candidate.</flux:text>
            </div>
 


            
            <flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="w-50%">Select Position {{ $position_id }}</flux:button>
    <flux:menu>

        @forelse ($positions as $position)
        <flux:menu.radio.group wire:model="position_id">
            <flux:menu.radio value="{{ $position->id }}">{{ $position->name }}</flux:menu.radio>
        </flux:menu.radio.group>
        @empty
              <flux:dropdown>
                <flux:button icon:trailing="chevron-down" class="w-50">No Position</flux:button>
            </flux:dropdown>
              @endforelse

    </flux:menu>
</flux:dropdown>




            <flux:input wire:model="first_name" label="First Name" placeholder="First Name" />

            <flux:input wire:model="last_name" label="Last Name" placeholder="Last Name" />

            <flux:input wire:model="other_name" label="Other Name  (Optional)" placeholder="Other Name (Optional)" />

            <flux:input wire:model="username" label="User Name" placeholder="User Name" />

            <flux:input wire:model="email" label="Email" placeholder="Email" />
            <flux:input wire:model="image" label="Image" type="file" />

                {{-- @if ($image)
                <img class="w-50" src="{{ $image->temporaryUrl() }}" alt="">
                    @endif --}}

                    <div wire:loading wire:target="image">Uploading...</div>
 
            <div class="flex">
                <flux:spacer />
 
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>




    
</div>
