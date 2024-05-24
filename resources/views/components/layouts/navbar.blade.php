<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="px-4 sm:px-6 lg:px-8 relative">
        <div class="flex justify-between h-14 items-center gap-2">
            <button x-on:click="toggleSidebar"
                class="text-gray-600 cursor-pointer hover:text-gray-900 focus:outline-none">
                <x-heroicon-o-bars-3-bottom-left class="w-6 h-6" />
            </button>

            <div class="w-full flex justify-center sm:justify-start">
                <a href="{{ route('dashboard') }}" wire:navigate>
                    <span class="font-semibold text-xl">PACS BIOMEDIKA</span>
                </a>
            </div>

            <div class="relative">
                <x-dropdown>
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <div
                                class="text-white bg-gradient-to-r from-blue-500 to-violet-600 p-2 rounded-full hover:bg-primary-600 flex text-center justify-center">
                                <x-icon name="user" class="w-5 h-5" />
                            </div>
                        @endif
                    </x-slot>

                    <x-dropdown.header label="{{ auth()->user()->name }}">
                        <x-dropdown.item label="Profil" href="{{ route('profile.show') }}" />
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown.item separator href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                <span>Logout</span>
                            </x-dropdown.item>
                        </form>
                    </x-dropdown.header>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
