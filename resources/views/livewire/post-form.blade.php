<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

{{-- <x-layouts.app :title="__('PostForm')"> --}}
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('PostForm') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage your posts') }}</flux:subheading>
        
        <flux:separator variant="subtle" />
    </div>

    
        
        {{-- Include the modal trigger and modal component --}}
        <flux:modal.trigger name="add-post">
            <flux:button>Add Post</flux:button>
        </flux:modal.trigger>

        @include('partials.messages')

        <livewire:edit-post />

        <flux:modal name="add-post" class="w-full md:max-w-md">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Post</flux:heading>
                    <flux:separator variant="subtle" class="mt-6" />
                </div>

                <flux:input wire:model="title" autocomplete="title" label="Title" placeholder="Title" />

                <flux:textarea wire:model="content" label="Content" placeholder="Content" />

                <flux:input wire:model="photo" label="Photo" type="file" />

                @if ($photo)
                <img class="w-50" src="{{ $photo->temporaryUrl() }}" alt="">
                    @endif

                <div wire:loading wire:target="photo">Uploading...</div>

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary" wire:click="save">Save</flux:button>
                </div>
                
                
            </div>
        </flux:modal>
        
        {{-- If you want to display existing posts, you can add them here --}}


        



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
                          Title
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Content
                      </th>
                      <th scope="col" class="px-6 py-3">
                          image
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modify
                    </th>
                      <th scope="col" class="px-6 py-3 rounded-e-lg" >
                          Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($postform as $rs)
                  <tr class=" border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4">
                      {{ $loop->iteration }}
                  </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                          {{ $rs->title }}
                      </th>
                      <td class="px-6 py-4">
                          {{ $rs->content }}
                      </td>
                      <td class="px-6 py-4">
                        <img class="w-50" src="{{ asset('storage/' . $rs->photo) }}" alt="{{ $rs->title }}" title="{{ $rs->title }}">
                      </td>
                      <td class="px-6 py-4">
                          {{ $rs->created_at->diffForHumans() }}
                      </td>
                      <td class="px-6 py-4">
                        {{ $rs->updated_at->diffForHumans() }}
                    </td>
                      <td class="px-6 py-4">
                          <flux:button wire:click="edit({{ $rs->id }})">Edit</flux:button>
                          <flux:button variant="danger" wire:click="delete({{ $rs->id }})">Delete</flux:button>
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
              {{ $postform->links() }}
          </div>



          <flux:modal name="delete-post" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete Post?</flux:heading>
 
                    <flux:text class="mt-2">
                        <p>You're about to delete this Post.</p>
                        <p>This action cannot be reversed.</p>
                    </flux:text>
                </div>
 
                <div class="flex gap-2">
                    <flux:spacer />
 
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
 
                    <flux:button type="submit" variant="danger" wire:click="deletePost()">Delete product</flux:button>
                </div>
            </div>
        </flux:modal>

        </div>



{{-- </x-layouts.app> --}}


</div>
