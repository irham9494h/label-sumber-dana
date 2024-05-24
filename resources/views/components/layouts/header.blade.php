@props(['title' => '', 'backButton' => false])

<header {{ $attributes->class(['bg-white shadow-sm h-16 flex justify-center']) }}>
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        @if ($title)
            <h4 class="text-lg font-semibold">
                {{ $title }}
            </h4>
        @endif

        {{ $slot ?? '' }}
    </div>
</header>
