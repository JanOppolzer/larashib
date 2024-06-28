@props(['color' => 'blue'])

<button type="submit" @class([
    'px-4 py-2 rounded shadow',
    'hover:bg-indigo-700 text-indigo-50 bg-indigo-600' => $color === 'indigo',
    'hover:bg-green-700 text-green-50 bg-green-600' => $color === 'green',
    'hover:bg-blue-700 text-blue-50 bg-blue-600' => $color === 'blue',
    'hover:bg-red-700 text-red-50 bg-red-600' => $color === 'red',
])>
    {{ $slot }}
</button>
