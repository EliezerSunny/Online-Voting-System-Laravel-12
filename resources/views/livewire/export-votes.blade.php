<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}


    <div class="flex gap-2">
    <flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="" size="sm">Sort by</flux:button>
    <flux:menu>
        <flux:menu.radio.group wire:model="sortBy">
            <flux:menu.radio value="Voted">Voted</flux:menu.radio>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>

<flux:button icon="arrow-up-tray" wire:click="export" size="sm">Export Vote</flux:button>
</div>

</div>
