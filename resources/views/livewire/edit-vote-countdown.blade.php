<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <flux:modal name="edit-votesession" class="md:w-800">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Vote Session</flux:heading>
                <flux:text class="mt-2">Update Vote Session.</flux:text>
            </div>
 

            <flux:input wire:model="vote_ends_at" label="Date" placeholder="Date" />
 
            <div class="flex">
                <flux:spacer />
 
                <flux:button type="submit" variant="primary" wire:click="update">Update</flux:button>
            </div>
        </div>
    </flux:modal>


</div>
