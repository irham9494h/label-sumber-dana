<header class="bg-white dark:bg-darker fixed top-0 w-full shadow shadow-primary-300/25 z-50">
    <div class="h-16 flex items-center justify-between p-2 md:px-6 border-b dark:border-primary-950">

        <button @click="$store.menu.toggleShowMobileMenu()"
            class="lg:hidden p-2 transition-colors duration-200 rounded hover:text-primary-950 hover:bg-primary-50 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-950">
            <span class="sr-only">Open Main Menu</span>
            <x-heroicon-o-bars-3-bottom-left class="w-6 h-6" />
        </button>

        <a href="index.html"
            class="inline-block text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
            LABEL
        </a>

        <!-- Mobile sub menu button -->
        <button @click="$store.menu.toggleShowSubMobileMenu()"
            class="p-2 transition-colors duration-200 rounded hover:text-primary-950 hover:bg-primary-50 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark focus:outline-none focus:bg-primary-100 dark:focus:bg-primary-dark focus:ring-primary-950">
            <span class="sr-only">Open Mobile Sub Menu</span>
            <x-heroicon-o-user class="w-6 h-6" />
        </button>

        <!-- Desktop Right buttons -->
        {{-- <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
            HALO
        </nav> --}}

        <!-- Mobile sub menu -->
        <nav x-data x-transition:enter="transition duration-200 ease-in-out transform sm:duration-500"
            x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
            x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="-translate-y-full opacity-0"
            x-show="$store.menu.showSubMobileMenu" @click.away="$store.menu.showSubMobileMenu = false"
            class="absolute flex items-center p-4 bg-white rounded-md shadow-lg dark:bg-darker top-16 inset-x-4 md:hidden"
            aria-label="Secondary">
            <div class="space-x-2">
                MUCUL GENG
            </div>

        </nav>
    </div>

</header>
