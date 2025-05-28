<div>
    {{-- In work, do what you enjoy. --}}



    <div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Add Role') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage Roles') }}</flux:subheading>
    
    <flux:separator variant="subtle" />
</div>


    
    {{-- Include the modal trigger and modal component --}}
    <flux:modal.trigger name="add-role">
        <flux:button>Add Role</flux:button>
    </flux:modal.trigger>

    @include('partials.messages')



    <livewire:edit-role />



    <flux:modal name="add-role" class="w-full md:max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Role</flux:heading>
                <flux:separator variant="subtle" class="mt-6" />
            </div> 

            <flux:input wire:model="name" autocomplete="name" label="Role Name" placeholder="Role Name" />

            <flux:input wire:model="guard_name" label="Guard Name" placeholder="Guard Name" />

            
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="register">Add Role</flux:button>
            </div>
            
            
        </div>
    </flux:modal>
    
    {{-- If you want to display existing posts, you can add them here --}}


    

{{-- <livewire:export-roles /> --}}

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
                      Role Name
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
              @forelse ($roles as $role)
              <tr class=" border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                  {{ $loop->iteration }}
              </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ $role->name }}
                  </th>
                  <td class="px-6 py-4">
                    {{ $role->guard_name }}
                </td>
                
                  <td class="px-6 py-4">
                      {{ $role->created_at->diffForHumans() }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $role->updated_at->diffForHumans() }}
                </td>
                  <td class="px-6 py-4 flex gap-2">
                      <flux:button wire:click="edit({{ $role->id }})">Edit</flux:button>
                      <flux:button variant="danger" wire:click="delete({{ $role->id }})">Delete</flux:button>
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
          {{ $roles->links() }}
      </div>



      <flux:modal name="delete-role" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Role?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this Role.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="deleteRole()">Delete Role</flux:button>
            </div>
        </div>
    </flux:modal>

    </div>




</div>
