<div>
    {{-- The whole world belongs to you. --}}



    <div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Add Permission') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage Permissions') }}</flux:subheading>
    
    <flux:separator variant="subtle" />
</div>


    
    {{-- Include the modal trigger and modal component --}}
    <flux:modal.trigger name="add-permission">
        <flux:button>Add Permission</flux:button>
    </flux:modal.trigger>

    @include('partials.messages')



    <livewire:edit-permission />



    <flux:modal name="add-permission" class="w-full md:max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Permission</flux:heading>
                <flux:separator variant="subtle" class="mt-6" />
            </div> 

            <flux:input wire:model="name" autocomplete="name" label="Permission Name" placeholder="Permission Name" />

            <flux:input wire:model="guard_name" label="Guard Name" placeholder="Guard Name" />

            
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="register">Add Permission</flux:button>
            </div>
            
            
        </div>
    </flux:modal>
    
    {{-- If you want to display existing posts, you can add them here --}}


    

{{-- <livewire:export-permissions /> --}}

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
                      Permission Name
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Guard Name
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
              @forelse ($permissions as $permission)
              <tr class=" border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                  {{ $loop->iteration }}
              </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ $permission->name }}
                  </th>
                  <td class="px-6 py-4">
                    {{ $permission->guard_name }}
                </td>
                
                  <td class="px-6 py-4">
                      {{ $permission->created_at->diffForHumans() }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $permission->updated_at->diffForHumans() }}
                </td>
                  <td class="px-6 py-4 flex gap-2">
                      <flux:button wire:click="edit({{ $permission->id }})">Edit</flux:button>
                      <flux:button variant="danger" wire:click="delete({{ $permission->id }})">Delete</flux:button>
                  </td>
              </tr>
              @empty
              <tr>
                                     <td colspan="6">
                                        <h5 style="color:red; text-align: center;">No record found</h5>
                                     </td>
                                  </tr>
              @endforelse
          </tbody>
        </table>
        <div class="mt-4">
          {{ $permissions->links() }}
      </div>



      <flux:modal name="delete-permission" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Permission?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this Permission.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="deletePermission()">Delete Role</flux:button>
            </div>
        </div>
    </flux:modal>

    </div>






</div>
