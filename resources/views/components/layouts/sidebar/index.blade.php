<div class="h-[calc(100vh-64px)] fixed left-0 top-16 border-r border-gray-200 bg-white z-40 transition-all duration-300"
    :class="$store.menu.showMobileMenu ? 'w-64 lg:w-auto' : 'w-0 lg:w-auto'">

    <div class="h-full transition-all duration-300 hover:w-64 group/sidebar-menu flex flex-col justify-between"
        :class="[
            $store.menu.isSidebarCollapse && 'w-64 lg:w-16',
            !$store.menu.isSidebarCollapse && 'w-64',
        ]">

        <div :class="$store.menu.showMobileMenu ? 'block' : 'hidden lg:block'" class="transition-all duration-300">
            <div class="flex justify-between items-center border-b px-5 py-2">
                <h5 x-data class="text-sm font-semibold group-hover/sidebar-menu:block"
                    :class="$store.menu.isSidebarCollapse && 'lg:hidden'">
                    MENU
                </h5>
                <button type="button" x-data @click="$store.menu.toggleSidebarCollapse()"
                    class="hover:bg-primary-50 hover:text-primary-950 rounded-lg text-sm p-1 lg:flex items-center justify-center transition duration-300 hidden"
                    :class="[
                        $store.menu.isSidebarCollapse && 'rotate-180',
                    ]">
                    <x-heroicon-o-chevron-double-left class="h-5 w-5" />
                    <span class="sr-only">Close menu</span>
                </button>

                <button @click="$store.menu.toggleShowMobileMenu()"
                    class="hover:bg-primary-50 hover:text-primary-950 rounded-lg text-sm p-1 flex items-center justify-center transition duration-300 lg:hidden">
                    <x-heroicon-o-x-mark class="h-5 w-5" />
                    <span class="sr-only">Close menu</span>
                </button>
            </div>

            <div class="overflow-y-auto overflow-x-hidden h-full">
                <ul class="">
                    <x-layouts.sidebar.menu-item menu="Dashboard" url="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" />

                    <x-layouts.sidebar.menu-item menu="Tahapan APBD" icon="heroicon-o-calendar-days"
                        url="{{ route('tahapan-apbd.index') }}" :active="request()->routeIs('tahapan-apbd.index')" />

                    <x-layouts.sidebar.parent-menu-item menu="Referensi" icon="heroicon-o-circle-stack"
                        :active="request()->routeIs('profile')">
                        <x-layouts.sidebar.child-menu-item menu="Akun" url="{{ route('ref.akun.index') }}" />
                        <x-layouts.sidebar.child-menu-item menu="Bidang Urusan" />
                        <x-layouts.sidebar.child-menu-item menu="Program Kegiatan" />
                    </x-layouts.sidebar.parent-menu-item>

                    <x-layouts.sidebar.menu-item menu="Sumber Dana" icon="heroicon-o-banknotes" />

                    <x-layouts.sidebar.parent-menu-item menu="Realisasi" icon="heroicon-o-clipboard-document-check">
                        <x-layouts.sidebar.child-menu-item menu="Ermark" />
                        <x-layouts.sidebar.child-menu-item menu="Non Ermark" />
                    </x-layouts.sidebar.parent-menu-item>

                </ul>
            </div>
        </div>

        <div class="py-2 px-4 grid grid-cols-1 gap-2 border-t transition-all duration-300 group-hover/sidebar-menu:grid"
            :class="[
                $store.menu.showMobileMenu ? 'block' : 'hidden lg:grid',
                $store.menu.isSidebarCollapse && 'lg:hidden'
            ]">

            <div class="shrink-0 w-ful">
                <x-button primary class="w-full">
                    <span class="whitespace-nowrap shrink-0"> Upload Data</span>
                </x-button>
            </div>

            <div class="shrink-0 w-ful">
                <x-button outline secondary class="w-full">
                    <span class="whitespace-nowrap shrink-0"> Tahun: 2024</span>
                </x-button>
            </div>
        </div>

    </div>
</div>
