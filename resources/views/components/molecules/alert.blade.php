@props([
    'type',
    'message',
])

<div {{ $attributes->merge(['class' => "alert alert-$type"]) }} role="alert">
    {{ $message ?? $slot }}
</div>
