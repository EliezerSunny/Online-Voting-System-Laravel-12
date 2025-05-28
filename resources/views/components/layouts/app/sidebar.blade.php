<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('cast-vote') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                {{-- <x-app-logo />  --}}
                Sunny - Online Voting
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    
                    @if (auth()->check() && auth()->user()->hasPermissionTo('Dashboard'))
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                   

                    <flux:navlist.item icon="user" :href="route('register')" :current="request()->routeIs('Register')" wire:navigate>{{ __('Register') }}</flux:navlist.item>
                
                <flux:navlist.group expandable heading="Permissions" class="hidden lg:grid">
                <flux:navlist.item icon="book-open-text" :href="route('add-role')" :current="request()->routeIs('add-role')" wire:navigate>{{ __('Add Role') }}</flux:navlist.item>
                <flux:navlist.item icon="book-open-text" :href="route('add-permission')" :current="request()->routeIs('add-permission')" wire:navigate>{{ __('Add Permission') }}</flux:navlist.item>
                <flux:navlist.item icon="book-open-text" :href="route('user-permission')" :current="request()->routeIs('user-permission')" wire:navigate>{{ __('User Permission') }}</flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.item icon="book-open-text" :href="route('add-position')" :current="request()->routeIs('add-position')" wire:navigate>{{ __('Add Position') }}</flux:navlist.item>
                <flux:navlist.item icon="users" :href="route('add-candidate')" :current="request()->routeIs('add-candidate')" wire:navigate>{{ __('Add Candidate') }}</flux:navlist.item>
                <flux:navlist.item icon="book-open-text" :href="route('post-form')" :current="request()->routeIs('post-form')" wire:navigate>{{ __('Post Form') }}</flux:navlist.item>
                <flux:navlist.item icon="book-open-text" :href="route('vote-countdown')" :current="request()->routeIs('vote-countdown')" wire:navigate>{{ __('Vote Countdown') }}</flux:navlist.item>
                @endif

                
                <flux:navlist.item icon="user" :href="route('cast-vote')" :current="request()->routeIs('cast-vote')" wire:navigate>{{ __('Cast Vote') }}</flux:navlist.item>
                   

                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            {{-- <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist> --}}

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->first_name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->first_name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    @if (auth()->check() && auth()->user()->hasPermissionTo('Read'))
                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->first_name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    @if (auth()->check() && auth()->user()->hasPermissionTo('Read'))
                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />
                    @endif

                    

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
