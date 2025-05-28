<div>


    {{-- In work, do what you enjoy. --}}


    <div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Add Candidate') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage Candidates') }}</flux:subheading>
    
    <flux:separator variant="subtle" />
</div>


    
    {{-- Include the modal trigger and modal component --}}
    <flux:modal.trigger name="add-candidate">
        <flux:button>Add Candidate</flux:button>
    </flux:modal.trigger>

    @include('partials.messages')



    <livewire:edit-candidate />



    <flux:modal name="add-candidate" class="w-full md:max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Candidate</flux:heading>
                <flux:separator variant="subtle" class="mt-6" />
            </div>


            
                


            <flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="w-100%">Select Position</flux:button>
    <flux:menu>

        @forelse ($positions as $position)
        <flux:menu.radio.group wire:model="position_id">
            <flux:menu.radio value="{{ $position->id }}">{{ $position->name }}</flux:menu.radio>
        </flux:menu.radio.group>
        @empty
              <flux:dropdown>
                <flux:button icon:trailing="chevron-down" class="w-100%">No Position</flux:button>
            </flux:dropdown>
              @endforelse

    </flux:menu>
</flux:dropdown>
            
            

            <flux:input wire:model="first_name" label="First Name" placeholder="First Name" />

            <flux:input wire:model="last_name" label="Last Name" placeholder="Last Name" />

            <flux:input wire:model="other_name" label="Other Name  (Optional)" placeholder="Other Name (Optional)" />

            <flux:input wire:model="username" label="User Name" placeholder="User Name" />

            <flux:input wire:model="email" label="Email" placeholder="Email" />

            <flux:radio.group wire:model="gender" label="Gender" variant="segmented">
                <flux:radio label="Male" value="Male" />
                <flux:radio label="Female" value="Female" />
            </flux:radio.group>

            <flux:input wire:model="phone_number" label="Phone Number" placeholder="Phone Number" />

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="register">Add Candidate</flux:button>
            </div>
            
            
        </div>
    </flux:modal>
    
    {{-- If you want to display existing posts, you can add them here --}}


    

<livewire:export-candidates />

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
                      Vote Count
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Position
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
                    Created By
                </th>
                  <th scope="col" class="px-6 py-3">
                      Image
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
              @forelse ($candidates as $candidate)
              <tr class=" border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                  {{ $loop->iteration }}
              </td>
              <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $candidate->votes_count }}
                </td>
                <td class="px-6 py-4">
                    {{ $candidate->position->name }}
                </td>
                  <td class="px-6 py-4">
                    {{ $candidate->username }}
                </td>
                  <td class="px-6 py-4">
                      {{ $candidate->first_name }}, {{ $candidate->last_name }}

                      @if ( $candidate->other_name != Null)
                      ( {{ $candidate->other_name }} )
                      @endif 
                      
                  </td>
                  <td class="px-6 py-4">
                    {{ $candidate->gender }}
                </td>
                  <td class="px-6 py-4">
                    {{ $candidate->email }}
                </td>
                <td class="px-6 py-4">
                    {{ $candidate->phone_number }}
                </td>
                <td class="px-6 py-4">
                    {{ $candidate->created_by }}
                </td>
                  <td class="px-6 py-4">
                    <img class="w-50 border-r-violet-300" src="{{ asset('storage/' . $candidate->image) }}" alt="{{ $candidate->username }}" title="{{ $candidate->username }}">
                  </td>
                  <td class="px-6 py-4">
                      {{ $candidate->created_at->diffForHumans() }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $candidate->updated_at->diffForHumans() }}
                </td>
                  <td class="px-6 py-4 flex gap-2">
                      <flux:button wire:click="edit({{ $candidate->id }})">Edit</flux:button>
                      <flux:button variant="danger" wire:click="delete({{ $candidate->id }})">Delete</flux:button>
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
          {{ $candidates->links() }}
      </div>



      <flux:modal name="delete-candidate" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Candidate?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this Candidate.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="deleteCandidate()">Delete Candidate</flux:button>
            </div>
        </div>
    </flux:modal>

    </div>


    
</div>
