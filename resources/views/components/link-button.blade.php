@props(['color' => 'gray', 'href' => '/', 'text' => 'OK'])

<a href="{{ $href }}" @class([
    'inline-block px-4 py-2 rounded shadow',
    'hover:bg-gray-200 text-gray-600 bg-gray-300' => $color === 'gray',
    'hover:bg-yellow-200 text-yellow-600 bg-yellow-300' => $color === 'yellow',
])>
    {{ $text }}</a>
