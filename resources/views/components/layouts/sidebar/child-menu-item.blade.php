@props(['menu' => 'Menu Item', 'url' => '#', 'active' => false])

<li>
    <a x-data href="{{ $url }}" wire:navigate
        class="flex items-center pl-7 pr-4 py-2 group border-r-4 border-r-transparent text-sm transition-all duration-300 {{ $active ? 'bg-primary-50 hover:border-primary-600 font-medium' : 'hover:bg-primary-50 hover:border-primary-600' }}"
        x-on:click="$nextTick(() => { $store.menu.toggleShowMobileMenu() })">
        <x-bi-dot class="flex-shrink-0" />
        <p class="ml-2 shrink-0">
            {!! $menu !!}
        </p>
    </a>
</li>
