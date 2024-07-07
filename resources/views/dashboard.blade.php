<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- COLOR AND STYLE --}}
                    <x-button label="Hi!" class="btn-outline" />
                    <x-button label="How" class="btn-warning" />
                    <x-button label="Are" class="btn-success" />
                    <x-button label="You?" class="btn-error btn-sm" />

                    {{-- SLOT--}}
                    <x-button class="btn-primary">
                        With default slot 😃
                    </x-button>

                    {{-- CIRCLE --}}
                    <x-button icon="o-user" class="btn-circle" />
                    <x-button icon="o-user" class="btn-circle btn-outline" />

                    {{-- SQUARE --}}
                    <x-button icon="o-user" class="btn-circle btn-ghost" />
                    <x-button icon="o-user" class="btn-square" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>