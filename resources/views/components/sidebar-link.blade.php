@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 py-2 border-r-2 border-indigo-500 font-medium leading-5 text-indigo-500 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out w-full text-md translate-y-5'
            : 'inline-flex items-center px-1 py-2 border-transparent font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out w-full text-md translate-y-5';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
