<div class="fixed left-0 z-40 transition-all duration-300 bg-white border-r border-gray-200 top-16"
    :class="$store.menu.showMobileMenu ? 'w-64 lg:w-auto' : 'w-0 lg:w-auto'">

    <div class="transition-all duration-300 hover:w-64 group/sidebar-menu flex flex-col justify-between h-[calc(100vh-64px)]"
        :class="[
            $store.menu.isSidebarCollapse && 'w-64 lg:w-16',
            !$store.menu.isSidebarCollapse && 'w-64',
        ]">

        <div :class="$store.menu.showMobileMenu ? 'block' : 'hidden lg:block'"
            class="transition-all duration-300 h-max">
            <div class="flex items-center justify-between px-5 py-2 border-b">
                <h5 x-data class="text-sm font-semibold group-hover/sidebar-menu:block"
                    :class="$store.menu.isSidebarCollapse && 'lg:hidden'">
                    MENU
                </h5>
                <button type="button" x-data @click="$store.menu.toggleSidebarCollapse()"
                    class="items-center justify-center hidden p-1 text-sm transition duration-300 rounded-lg hover:bg-primary-50 hover:text-primary-950 lg:flex"
                    :class="[
                        $store.menu.isSidebarCollapse && 'rotate-180',
                    ]">
                    <x-heroicon-o-chevron-double-left class="w-5 h-5" />
                    <span class="sr-only">Close menu</span>
                </button>

                <button @click="$store.menu.toggleShowMobileMenu()"
                    class="flex items-center justify-center p-1 text-sm transition duration-300 rounded-lg hover:bg-primary-50 hover:text-primary-950 lg:hidden">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                    <span class="sr-only">Close menu</span>
                </button>
            </div>

            <ul class="overflow-y-auto overflow-x-hidden soft-scrollbar h-[calc(100vh-205px)]">

                <x-layouts.sidebar.menu-item menu="Dashboard" url="{{ route('dashboard') }}"
                    :active="request()->routeIs('dashboard')" />

                <x-layouts.sidebar.parent-menu-item menu="Referensi" icon="heroicon-o-circle-stack"
                    :active="request()->is('ref/*') ? true : false">
                    <x-layouts.sidebar.child-menu-item menu="Akun" url="{{ route('ref.akun.list') }}"
                        :active="request()->is('ref/akun*') ? true : false" />

                    <x-layouts.sidebar.child-menu-item menu="Bidang Urusan" url="{{ route('ref.bidang-urusan.list') }}"
                        :active="request()->is('ref/bidang-urusan*') ? true : false" />

                    <x-layouts.sidebar.child-menu-item menu="Program" url="{{ route('ref.program.list') }}"
                        :active="request()->is('ref/program*') ? true : false" />

                    <x-layouts.sidebar.child-menu-item menu="Kegiatan" url="{{ route('ref.kegiatan.list') }}"
                        :active="request()->is('ref/kegiatan*') ? true : false" />

                    <x-layouts.sidebar.child-menu-item menu="Sub Kegiatan" url="{{ route('ref.sub-kegiatan.list') }}"
                        :active="request()->is('ref/sub-kegiatan*') ? true : false" />

                    <x-layouts.sidebar.child-menu-item menu="SKPD" url="{{ route('ref.skpd.list') }}"
                        :active="request()->is('ref/skpd*') ? true : false" />

                    <x-layouts.sidebar.child-menu-item menu="Sumber Dana" url="{{ route('ref.sumber-dana.list') }}"
                        :active="request()->is('ref/sumber-dana*') ? true : false" />
                </x-layouts.sidebar.parent-menu-item>

                <x-layouts.sidebar.parent-menu-item menu="Penganggaran" icon="heroicon-o-banknotes"
                    :active="request()->is('penganggaran/*') ? true : false">
                    <x-layouts.sidebar.child-menu-item menu="Jadwal Penganggaran"
                        url="{{ route('penganggaran.jadwal.list') }}"
                        :active="request()->is('penganggaran/jadwal*') ? true : false" />

                    <x-layouts.sidebar.child-menu-item menu="Sub Kegiatan Belanja"
                        url="{{ route('penganggaran.sub-kegiatan-belanja.overview') }}"
                        :active="request()->is('penganggaran/sub-kegiatan-belanja*') ? true : false" />
                </x-layouts.sidebar.parent-menu-item>

                <x-layouts.sidebar.parent-menu-item menu="Realisasi" icon="heroicon-o-clipboard-document-check">
                    <x-layouts.sidebar.child-menu-item menu="Ermark" />

                    <x-layouts.sidebar.child-menu-item menu="Non Ermark" />
                </x-layouts.sidebar.parent-menu-item>

            </ul>
        </div>

        <div class="grid grid-cols-1 gap-2 px-4 py-2 transition-all duration-300 border-t group-hover/sidebar-menu:grid"
            :class="[
                $store.menu.showMobileMenu ? 'block' : 'hidden lg:grid',
                $store.menu.isSidebarCollapse && 'lg:hidden'
            ]">

            <div class="shrink-0 w-ful">
                <x-button primary class="w-full" href="{{ route('belanja.upload') }}">
                    <span class="whitespace-nowrap shrink-0">Import Data Belanja</span>
                </x-button>
            </div>

            <div class="shrink-0 w-ful">
                @livewire('tahun.tahun-button')
            </div>
        </div>

    </div>
</div>