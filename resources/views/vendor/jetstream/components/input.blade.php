@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-turquesa-300 focus:ring focus:ring-turquesa-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
