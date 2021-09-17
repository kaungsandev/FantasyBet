@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full text-theme-color bg-white text-center  hover:border-purple-700 hover:text-purple-700 inline-flex items-center px-1 pt-1 border-l-2 border-indigo-400 text-sm font-medium leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'w-full bg-white text-center  hover:border-purple-700 hover:text-purple-700 inline-flex items-center px-1 pt-1 border-l-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-white hover:border-blue-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
