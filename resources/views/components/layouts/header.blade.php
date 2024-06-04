@props(['title' => '', 'backButton' => false])

<header {{ $attributes->class(['pt-5 flex justify-center']) }}>
    <div class="w-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        @if ($title)
            <h4 class="text-lg font-semibold">
                {{ $title }}
            </h4>
        @endif

        {{ $slot ?? '' }}
    </div>
</header>
