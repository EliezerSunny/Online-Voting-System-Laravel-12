<div>

    

    {{-- <input type="date" wire:model="fromDate">
    <input type="date" wire:model="toDate"> --}}

    <div class="flex gap-2 mt-10">
    <flux:dropdown>
    <flux:button icon:trailing="chevron-down" class="" size="sm">Sort by</flux:button>
    <flux:menu>
        <flux:menu.radio.group wire:model="sortBy">
            <flux:menu.radio value="All users">All users</flux:menu.radio>
            <flux:menu.radio value="Unvote user">Unvote user</flux:menu.radio>
            <flux:menu.radio value="Voted user">Voted user</flux:menu.radio>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>

<flux:button icon="arrow-up-tray" wire:click="export" size="sm">Export</flux:button>
    </div>


</div>