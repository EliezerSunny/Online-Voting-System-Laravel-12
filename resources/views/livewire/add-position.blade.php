<div>
    {{-- Be like water. --}}



    <div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Add Position') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage Positions') }}</flux:subheading>
    
    <flux:separator variant="subtle" />
</div>


    
    {{-- Include the modal trigger and modal component --}}
    <flux:modal.trigger name="add-position">
        <flux:button>Add Position</flux:button>
    </flux:modal.trigger>

    @include('partials.messages')



    <livewire:edit-position />



    <flux:modal name="add-position" class="w-full md:max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Position</flux:heading>
                <flux:separator variant="subtle" class="mt-6" />
            </div>


            


            <flux:input wire:model="code" label="Code" placeholder="Code" />

            <flux:input wire:model="name" label="Position Name" placeholder="Position Name" />

            <flux:input wire:model="party" label="Party" placeholder="Party" />

            
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="register">Add Position</flux:button>
            </div>
            
            
        </div>
    </flux:modal>
    
    {{-- If you want to display existing posts, you can add them here --}}


    

{{-- <livewire:export-candidates /> --}}

    <div class="relative overflow-x-auto mt-5">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption class="caption-top mb-5">
            The whole world belongs to you.
        </caption>
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3 rounded-s-lg">
                  S/N
              </th>
                  <th scope="col" class="px-6 py-3">
                      Code
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Position Name
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Party
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Created By
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Updated
                </th>
                  <th scope="col" class="px-6 py-3 rounded-e-lg" >
                      Action
                  </th>
              </tr>
          </thead>
          <tbody>
              @forelse ($positions as $position)
              <tr class=" border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                  {{ $loop->iteration }}
              </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ $position->code }}
                  </th>
                  <td class="px-6 py-4">
                    {{ $position->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $position->party }}
                </td>
                <td class="px-6 py-4">
                    {{ $position->created_by }}
                </td>
                
                  <td class="px-6 py-4">
                      {{ $position->created_at->diffForHumans() }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $position->updated_at->diffForHumans() }}
                </td>
                  <td class="px-6 py-4">
                      <flux:button wire:click="edit({{ $position->id }})">Edit</flux:button>
                      <flux:button variant="danger" wire:click="delete({{ $position->id }})">Delete</flux:button>
                  </td>
              </tr>
              @empty
              <tr>
                                     <td colspan="8">
                                        <h5 style="color:red; text-align: center;">No record found</h5>
                                     </td>
                                  </tr>
              @endforelse
          </tbody>
        </table>
        <div class="mt-4">
          {{ $positions->links() }}
      </div>



      <flux:modal name="delete-position" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Position?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this Position.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="deletePosition()">Delete Position</flux:button>
            </div>
        </div>
    </flux:modal>

    </div>





</div>
