<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}


    <div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('User Permission') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage User Permissions') }}</flux:subheading>
    
    <flux:separator variant="subtle" />
</div>


    
    {{-- Include the modal trigger and modal component --}}

    {{-- <flux:modal.trigger name="user-permission">
        <flux:button>User Permission</flux:button>
    </flux:modal.trigger> --}}

    @include('partials.messages')



    {{-- <livewire:user-permission /> --}}



    <flux:modal name="user-permission" class="w-full md:max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Grant User Permission</flux:heading>
                <flux:separator variant="subtle" class="mt-6" />
            </div> 

             
            
            
            
<flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="w-100%">Select Permission</flux:button>
    <flux:menu>

        @forelse ($permissions as $permission)
        <flux:menu.radio.group wire:model="name">
            <flux:menu.radio value="{{ $permission->name }}">{{ $permission->name }}</flux:menu.radio>
        </flux:menu.radio.group>
        @empty
              <flux:dropdown>
                <flux:button icon:trailing="chevron-down" class="w-100%">No Psermission</flux:button>
            </flux:dropdown>
              @endforelse

    </flux:menu>
</flux:dropdown>



<flux:spacer />


             
<flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="w-100%">Select Role</flux:button>
    <flux:menu>

        @forelse ($roles as $role)
        <flux:menu.radio.group wire:model="role_name">
            <flux:menu.radio value="{{ $role->name }}">{{ $role->name }}</flux:menu.radio>
        </flux:menu.radio.group>
        @empty
              <flux:dropdown>
                <flux:button icon:trailing="chevron-down" class="w-100%">No Role</flux:button>
            </flux:dropdown>
              @endforelse

    </flux:menu>
</flux:dropdown>



<flux:spacer />

            
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="assignPermission">Assign User Permission</flux:button>
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
              @forelse ($userpermissions as $user)
              <tr class=" border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                  {{ $loop->iteration }}
              </td>
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
                      {{ $user->created_at->diffForHumans() }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $user->updated_at->diffForHumans() }}
                </td>
                  <td class="px-6 py-4 flex gap-2">
                      <flux:button wire:click="assign({{ $user->id }})">Grant</flux:button>
                      <flux:button variant="danger" wire:click="revoke({{ $user->id }})">Revoke</flux:button>
                  </td>
              </tr>
              @empty
              <tr>
                                     <td colspan="7">
                                        <h5 style="color:red; text-align: center;">No record found</h5>
                                     </td>
                                  </tr>
              @endforelse
          </tbody>
        </table>
        <div class="mt-4">
          {{ $userpermissions->links() }}
      </div>



      <flux:modal name="revoke-user" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Revoke User?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to revoke this User.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="w-100%">Select Permission</flux:button>
    <flux:menu>

        @forelse ($permissions as $permission)
        <flux:menu.radio.group wire:model="name">
            <flux:menu.radio value="{{ $permission->name }}">{{ $permission->name }}</flux:menu.radio>
        </flux:menu.radio.group>
        @empty
              <flux:dropdown>
                <flux:button icon:trailing="chevron-down" class="w-100%">No Permission</flux:button>
            </flux:dropdown>
              @endforelse

    </flux:menu>
</flux:dropdown>



<flux:spacer />


             
<flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="w-100%">Select Role</flux:button>
    <flux:menu>

        @forelse ($roles as $role)
        <flux:menu.radio.group wire:model="role_name">
            <flux:menu.radio value="{{ $role->name }}">{{ $role->name }}</flux:menu.radio>
        </flux:menu.radio.group>
        @empty
              <flux:dropdown>
                <flux:button icon:trailing="chevron-down" class="w-100%">No Role</flux:button>
            </flux:dropdown>
              @endforelse

    </flux:menu>
</flux:dropdown>


<flux:spacer />


            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="revokeUser()">Revoke User</flux:button>
            </div>
        </div>
    </flux:modal>

    </div>




</div>
