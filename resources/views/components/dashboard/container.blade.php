@props([
    'header',
    'body',
])

<div {{ $attributes->merge(['class' => 'container']) }}>
    @if(!empty($header))
        <div {{ $header->attributes->merge(['class' => 'container__header']) }}>
            {{ $header }}
        </div>
    @endif


    <div {{ $body->attributes->merge(['class' => 'container__body']) }}>
        {{ $body }}
    </div>
</div>
