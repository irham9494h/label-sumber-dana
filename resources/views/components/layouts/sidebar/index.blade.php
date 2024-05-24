<div x-cloak x-show="showSidebar" x-transition:enter="transition ease-out duration-300"
    x-transition:leave="transition ease-in duration-300"
    class="bg-gray-700/30 w-full fixed top-0 left-0 h-screen z-[100]">
    <div x-cloak x-show="showSidebar" @click.away="toggleSidebar" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-72" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-72"
        class="fixed top-0 left-0 z-50 h-screen p-4 overflow-y-auto bg-white w-64 shadow-lg">
        <h5 class="text-base font-semibold">
            MENU
        </h5>
        <button type="button" x-on:click="toggleSidebar"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center">
            <x-heroicon-o-x-mark />
            <span class="sr-only">Close menu</span>
        </button>

        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <x-layouts.sidebar.menu-item menu="Dashboard" url="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" />

                <x-layouts.sidebar.menu-item menu="PACS" icon="heroicon-o-document-text"
                    url="{{ route('pacs.list') }}" :active="request()->is('pacs*') ? true : false" />
            </ul>

            @if (auth()->user()->role == App\Models\User::AS_ADMIN)
                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                    <x-layouts.sidebar.menu-item menu="User" icon="heroicon-o-users"
                        url="{{ route('manage.user.list') }}" :active="request()->is('user*') ? true : false" />

                    <x-layouts.sidebar.menu-item menu="Dokter" icon="heroicon-o-user-group"
                        url="{{ route('manage.doctor.list') }}" :active="request()->is('doctor*') ? true : false" />

                    <x-layouts.sidebar.menu-item menu="Checkup Template" icon="heroicon-o-user-group"
                        url="{{ route('checkup-template.create') }}" :active="request()->is('checkup-template/*') ? true : false" />
                </ul>
            @endif
        </div>
    </div>
</div
