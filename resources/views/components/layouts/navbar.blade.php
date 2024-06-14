<header class="fixed top-0 z-50 w-full bg-white shadow shadow-primary-300/25">
    <div class="flex items-center justify-between h-16 p-2 border-b md:px-6">

        <button @click="$store.menu.toggleShowMobileMenu()"
            class="p-2 transition-colors duration-200 rounded lg:hidden hover:text-primary-950 hover:bg-primary-50 focus:outline-none focus:bg-primary-100 ">
            <span class="sr-only">Open Main Menu</span>
            <x-heroicon-o-bars-3-bottom-left class="w-6 h-6" />
        </button>

        <a href="index.html" class="inline-block text-4xl">
            <x-application-logo />
        </a>

        <!-- Mobile sub menu button -->
        <button @click="$store.menu.toggleShowSubMobileMenu()"
            class="p-2 transition-colors duration-200 rounded hover:text-primary-950 hover:bg-primary-50 focus:outline-none focus:bg-primary-100 ">
            <span class="sr-only">Open Mobile Sub Menu</span>
            <x-heroicon-o-user class="w-6 h-6" />
        </button>

        <!-- Mobile sub menu -->
        <nav x-data x-transition:enter="transition duration-200 ease-in-out transform sm:duration-500"
            x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
            x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="-translate-y-full opacity-0"
            x-show="$store.menu.showSubMobileMenu" @click.away="$store.menu.showSubMobileMenu = false"
            class="absolute flex items-center p-4 bg-white rounded-md shadow-lg top-16 inset-x-4 md:hidden"
            aria-label="Secondary">
            <div class="space-x-2">
                Navbar Mobile Menu
            </div>

        </nav>
    </div>

</header>
