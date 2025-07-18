@props([
    'padding' => 'p-6',
    'shadow' => 'shadow-lg',
    'rounded' => 'rounded-xl',
    'background' => 'bg-white',
    'hover' => false,
])

@php
$classes = collect([
    $background,
    $rounded,
    $shadow,
    $padding,
    'overflow-hidden',
    'border border-gray-100',
])
->when($hover, function ($collection) {
    return $collection->push('transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1');
})
->merge($attributes->get('class', []))
->join(' ');
@endphp

<div {{ $attributes->except('class')->merge(['class' => $classes]) }}>
    {{ $slot }}
</div> 