@props(['menu' => 'Menu Item', 'icon' => 'heroicon-o-home', 'url' => '#', 'active' => false])

<li>
    <a x-data href="{{ $url }}" wire:navigate
        class="flex items-center px-5 py-2 group border-r-4 border-r-transparent text-sm transition duration-300 {{ $active ? 'text-white bg-primary-600 font-medium' : 'hover:bg-primary-50 hover:border-primary-600' }}"
        x-on:click="$nextTick(() => { $store.menu.toggleShowMobileMenu() })">
        @svg($icon, ['class' => 'flex-shrink-0 h-6 w-6'])
        <p class="ml-2"
            :class="[
                $store.menu.isSidebarCollapse && 'lg:hidden group-hover/sidebar-menu:block',
            ]">
            {{ $menu }}
        </p>
    </a>
</li>
