@props(['active'])

@php
$classes = $active ?? false ? 'bg-gray-800 text-gray-200 inline-flex items-center font-medium p-2 text-md leading-5 text-gray-500 shadow-sm shadow-blue-800 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out' : 'inline-flex items-center p-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border hover:border-blue-200 hover:shadow-lg hover:shadow-blue-200 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="pl-4 text-2xl">
        {{ $icon ?? '' }}
    </span>
    <div class="p-2 pl-4 font-bold text-md lg:text-md">
        {{ $slot }}
    </div>
</a>
