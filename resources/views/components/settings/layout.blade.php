<div class="me-10 w-full pb-4 md:w-[50%]">
    <flux:navlist class="grid grid-cols-3 gap-5 ">
        <flux:navlist.item class="border border-indigo-200 border-y-indigo-500" :href="route('settings.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
        <flux:navlist.item class="border border-indigo-200 border-y-indigo-500" :href="route('settings.password')" wire:navigate>{{ __('Password') }}</flux:navlist.item>
        <flux:navlist.item class="border border-indigo-200 border-y-indigo-500" :href="route('settings.appearance')" wire:navigate>{{ __('Appearance') }}</flux:navlist.item>
    </flux:navlist>
</div>


<div class="flex items-start max-md:flex-col">
    


    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
