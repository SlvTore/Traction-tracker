@props(['active' => false])

@php
$classes = $active
    ? 'nav-link active fw-bold'
    : 'nav-link link-underline-opacity-75-hover link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0';
@endphp

<li class="nav-item">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
