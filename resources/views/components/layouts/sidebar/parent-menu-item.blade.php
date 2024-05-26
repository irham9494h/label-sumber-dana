@props(['menu' => 'Menu Item', 'icon' => 'heroicon-o-home', 'active' => false])

@if ($active)
    <li x-data="{ expanded: {{ $active }}, active: {{ $active }} }">
    @else
    <li x-data="{ expanded: false, active: false }">
@endif

<button type="button" @click="expanded = ! expanded"
    :class="[
        !expanded && !$store.menu.isSidebarCollapse && !active && 'hover:bg-primary-50 hover:border-primary-600',
        expanded && !$store.menu.isSidebarCollapse && !active && 'bg-primary-50 hover:border-primary-600',
    
        expanded && $store.menu.isSidebarCollapse && !active &&
        'lg:group-hover/sidebar-menu:bg-primary-50 hover:border-primary-600 lg:bg-transparent bg-primary-50',
        !expanded && $store.menu.isSidebarCollapse && !active && 'hover:bg-primary-50 hover:border-primary-600',
    
        active && 'text-white bg-primary-600 font-medium'
    ]"
    class="flex items-center justify-between px-5 py-2 group border-r-4 w-full border-r-transparent text-sm transition duration-300
        {{ $active && 'text-white bg-primary-600 font-medium' }}">
    <div class="flex items-center">
        @svg($icon, ['class' => 'flex-shrink-0 h-6 w-6'])
        <p class="ml-2 whitespace-nowrap"
            :class="[
                $store.menu.isSidebarCollapse && 'lg:hidden group-hover/sidebar-menu:block',
            ]">
            {{ $menu }}
        </p>
    </div>

    <span class="transition duration-300"
        :class="[expanded && '-rotate-90 ', $store.menu.isSidebarCollapse && 'lg:hidden group-hover/sidebar-menu:block']">
        <x-heroicon-o-chevron-left class="h-5 w-5" />
    </span>
</button>


<ul x-show="expanded" x-collapse class="transition-all duration-300"
    :class="[
        $store.menu.isSidebarCollapse && 'lg:hidden group-hover/sidebar-menu:block',
    ]">
    {{ $slot }}
</ul>
</li>
