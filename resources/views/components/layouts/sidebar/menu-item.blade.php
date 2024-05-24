@props(['menu' => 'Menu Item', 'icon' => 'heroicon-o-home', 'url' => '#', 'active' => false])

<li>
    <a href="{{ $url }}" wire:navigate
        class="flex items-center p-2 {{ $active ? 'text-white bg-primary-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
        @svg($icon, ['class' => 'h-6 w-6'])
        <span class="ml-3">{{ $menu }}</span>
    </a>
</li>
