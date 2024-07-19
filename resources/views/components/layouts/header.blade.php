@props(['title' => '', 'backButton' => false])

<header {{ $attributes->class(['w-full bg-white border-b border-b-gray-200']) }} >
    <div class="flex justify-between w-full px-4 py-5 sm:px-6 lg:px-8 ">
        @if ($title)
        <h4 class="text-lg font-semibold whitespace-nowrap text-left">
            {{ $title }}
        </h4>
        @endif

        @if (!$slot->isEmpty())
        {{ $slot }}
        @endif
    </div>
</header>