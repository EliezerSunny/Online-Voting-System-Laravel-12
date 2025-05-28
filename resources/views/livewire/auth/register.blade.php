

<div>


<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Add User') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage Users') }}</flux:subheading>
    
    <flux:separator variant="subtle" />
</div>


    
    {{-- Include the modal trigger and modal component --}}
    <flux:modal.trigger name="add-user">
        <flux:button>Add User</flux:button>
    </flux:modal.trigger>

    @include('partials.messages')

    <livewire:edit-user />

    <flux:modal name="add-user" class="w-full md:max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create User Account</flux:heading>
                <flux:separator variant="subtle" class="mt-6" />
            </div>

            <flux:input wire:model="username" autocomplete="username" label="UserName" placeholder="UserName" />

            <flux:input wire:model="first_name" label="First Name" placeholder="First Name" />

            <flux:input wire:model="last_name" label="Last Name" placeholder="Last Name" />

            <flux:input wire:model="other_name" label="Other Name  (Optional)" placeholder="Other Name (Optional)" />

            <flux:input wire:model="email" label="Email" placeholder="Email" />

            <flux:radio.group wire:model="gender" label="Gender" variant="segmented">
                <flux:radio label="Male" value="Male" />
                <flux:radio label="Female" value="Female" />
            </flux:radio.group>

            <flux:input wire:model="phone_number" label="Phone Number" placeholder="Phone Number" />

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="register">Add User</flux:button>
            </div>
            
            
        </div>
    </flux:modal>
    
    {{-- If you want to display existing posts, you can add them here --}}


    

<livewire:export-users />

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
                      Unique Id
                  </th>
                  <th scope="col" class="px-6 py-3">
                      UserName
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Names
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Gender
                </th>
                  <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Role
                </th>
                <th scope="col" class="px-6 py-3">
                    Permission
                </th>
                <th scope="col" class="px-6 py-3">
                    Vote
                </th>
                <th scope="col" class="px-6 py-3">
                    Created By
                </th>
                  <th scope="col" class="px-6 py-3">
                      Image
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Last Seen
                </th>
                  <th scope="col" class="px-6 py-3 rounded-e-lg" >
                      Action
                  </th>
              </tr>
          </thead>
          <tbody>
              @forelse ($users as $user)
              <tr class=" border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                  {{ $loop->iteration }}
              </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ $user->unique_id }}
                  </th>
                  <td class="px-6 py-4">
                    {{ $user->username }}
                </td>
                  <td class="px-6 py-4">
                      {{ $user->first_name }}, {{ $user->last_name }}

                      @if ( $user->other_name != Null)
                      ( {{ $user->other_name }} )
                      @endif 
                      
                  </td>
                  <td class="px-6 py-4">
                    {{ $user->gender }}
                </td>
                  <td class="px-6 py-4">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->phone_number }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->status }}
                </td>
                <td class="px-6 py-4">
                    <flux:dropdown>
                        <flux:button icon:trailing="chevron-down">Role</flux:button>
                            <flux:menu>

                            @if (count($user->getRoleNames()) == 0)
                                <flux:badge color="red" icon="trash" checked>No Role</flux:badge>
                            @else

                                @foreach ($user->getRoleNames() as $role)
                                <flux:badge variant="danger" color="lime" icon="bolt" wire:model="create" checked>{{ $role }}</flux:badge>
                                @endforeach
                                @endif
{{--                                 
                                <flux:menu.checkbox wire:model="edit" checked>Edit</flux:menu.checkbox>
                                <flux:menu.checkbox wire:model="delete" checked>Delete</flux:menu.checkbox> --}}
                                {{-- <flux:menu.checkbox wire:model="delete">$role->updated_at->diffForHumans() </flux:menu.checkbox> --}}
                            </flux:menu>
                    </flux:dropdown>
                    
                </td>


                <td class="px-6 py-4">
                    <flux:dropdown>
                        <flux:button icon:trailing="chevron-down">Permissions</flux:button>
                            <flux:menu>

                            @if (count($user->getPermissionNames()) == 0)
                                <flux:badge color="red" icon="trash">No Permission</flux:badge>
                            @else
                                
                            
                                @foreach ($user->getPermissionNames() as $permission)
                                <flux:badge variant="danger" color="lime" icon="bolt" wire:model="create" checked>{{ $permission }}</flux:badge>
                                @endforeach

                                @endif
{{--                                 
                                <flux:menu.checkbox wire:model="edit" checked>Edit</flux:menu.checkbox>
                                <flux:menu.checkbox wire:model="delete" checked>Delete</flux:menu.checkbox> --}}
                                {{-- <flux:menu.checkbox wire:model="delete">$permission->updated_at->diffForHumans() </flux:menu.checkbox> --}}
                            </flux:menu>
                    </flux:dropdown>
                    
                </td>
                <td class="px-6 py-4">
                    @if ( $user->vote == 0)
                        Unvote
                    @elseif ( $user->vote == 1)
                        Voted
                    @endif
                </td>
                <td class="px-6 py-4">
                    {{ $user->created_by }}
                </td>
                  <td class="px-6 py-4">
                    <img class="w-50 border-r-violet-300" src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->image }}" title="{{ $user->image }}">
                  </td>
                  <td class="px-6 py-4">
                      {{ $user->created_at->diffForHumans() }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $user->updated_at->diffForHumans() }}
                </td>
                  <td class="px-6 py-4 flex gap-2">
                      <flux:button wire:click="edit({{ $user->id }})">Edit</flux:button>
                      <flux:button variant="danger" wire:click="delete({{ $user->id }})">Delete</flux:button>
                  </td>
              </tr>
              @empty
              <tr>
                                     <td colspan="15">
                                        <h5 style="color:red; text-align: center;">No record found</h5>
                                     </td>
                                  </tr>
              @endforelse
          </tbody>
        </table>
        <div class="mt-4">
          {{ $users->links() }}
      </div>



      <flux:modal name="delete-user" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete User?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this User.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="deleteUser()">Delete User</flux:button>
            </div>
        </div>
    </flux:modal>

    </div>

</div>