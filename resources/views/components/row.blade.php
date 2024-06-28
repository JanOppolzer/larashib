@props(['desc' => null])

<div @class([
    'even:bg-gray-50 odd:bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 px-4 py-5',
])>
    <dt class="text-sm text-gray-500">
        {{ $term }}
        <div class="text-xs text-gray-400">{{ $desc }}</div>
    </dt>
    <dd class="sm:col-span-2">
        {{ $slot }}
    </dd>
</div>
