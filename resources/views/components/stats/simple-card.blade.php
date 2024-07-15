@props(['label', 'value'])

<div class="px-4 py-3 bg-white shadow rounded-lg overflow-hidden sm:p-6">
    <dt class="text-sm font-medium text-gray-500 truncate">{{ $label }}</dt>
    <dd class="mt-1 text-xl font-semibold text-gray-900">{{ $value }}</dd>
</div>