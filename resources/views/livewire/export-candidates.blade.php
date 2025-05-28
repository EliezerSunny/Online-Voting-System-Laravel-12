<div>


    {{-- The Master doesn't talk, he acts. --}}



<div class="flex gap-2 mt-10">
<flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="" size="sm">Sort by</flux:button>
    <flux:menu>

        @forelse ($positions as $position)
        <flux:menu.radio.group wire:model="sortBy">
            <flux:menu.radio value="{{ $position->name }}">{{ $position->name }}</flux:menu.radio>
        </flux:menu.radio.group>
        @empty
        
              @endforelse

    </flux:menu>
</flux:dropdown>

<flux:button icon="arrow-up-tray" wire:click="export" size="sm">Export</flux:button>
</div>



    
</div>
