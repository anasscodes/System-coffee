@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium
       text-gray-900 dark:text-white'
    : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium
       text-gray-500 dark:text-gray-300
       hover:text-gray-900 dark:hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
