@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'nav-link  active font-weight-bold'
                : 'nav-link';
@endphp

<li class="nav-item link-underline link-underline-opacity-0" style="padding-left: 5px; padding-right: 5px;">
    <a {{ $attributes->class([$classes]) }}>
        {{ $slot }}
    </a>
</li>
