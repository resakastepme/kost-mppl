@props(['overrideClass' => false])

<div {{ $attributes->merge(['class' => $overrideClass ?  '' : 'col-12']) }} >
    {{ $slot }}
</div>