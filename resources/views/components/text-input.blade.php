@props(['disabled' => false])
<input {{ $attributes->merge([
'class' => '
border-gray-300 dark:border-gray-600
bg-white dark:bg-gray-800
text-gray-800 dark:text-gray-100
focus:border-indigo-500 focus:ring-indigo-500
rounded-md shadow-sm'
]) }}>

{{-- <input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}> --}}
