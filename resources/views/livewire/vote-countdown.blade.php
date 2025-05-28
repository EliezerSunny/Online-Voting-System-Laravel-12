<div>
    {{-- Be like water. --}}



    <div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Add Vote Countdown') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage Vote Countdowns') }}</flux:subheading>
    
    <flux:separator variant="subtle" />
</div>


    
    {{-- Include the modal trigger and modal component --}}
    <flux:modal.trigger name="add-votesession">
        <flux:button>Add Vote Countdown</flux:button>
    </flux:modal.trigger>

    @include('partials.messages')



    <livewire:edit-vote-countdown />



    <flux:modal name="add-votesession" class="w-full md:max-w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Vote Countdown</flux:heading>
                <flux:separator variant="subtle" class="mt-6" />
            </div>



            <flux:input wire:model="vote_ends_at" label="Date" placeholder="Date" />

            
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="create">Add Vote Countdown</flux:button>
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
                      Date
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Vote Period
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
              @forelse ($voteSessions as $voteSession)
              <tr class=" border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <td class="px-6 py-4">
                  {{ $loop->iteration }}
              </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      {{ $voteSession->vote_ends_at }}
                  </th>
                  <td class="px-6 py-4">
                    @if ( $voteSession->active )
                        Vote Ongoing
                    @else
                        Vote Ended
                    @endif
                    
                </td>
                <td class="px-6 py-4">
                    {{ $voteSession->created_by }}
                </td>
                
                  <td class="px-6 py-4">
                      {{ $voteSession->created_at->diffForHumans() }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $voteSession->updated_at->diffForHumans() }}
                </td>
                  <td class="px-6 py-4">
                      <flux:button wire:click="edit({{ $voteSession->id }})">Edit</flux:button>
                      {{-- <flux:button variant="danger" wire:click="delete({{ $voteSession->id }})">Delete</flux:button> --}}
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
          {{ $voteSessions->links() }}
      </div>



      <flux:modal name="delete-votesession" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Vote Session?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this Vote Session.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="deleteVoteSession()">Delete Vote Session</flux:button>
            </div>
        </div>
    </flux:modal>

    </div>





</div>
