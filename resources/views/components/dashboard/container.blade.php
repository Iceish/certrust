@props([
    'header',
    'body',
])

<div {{ $attributes->merge(['class' => 'container']) }}>
    @if(!empty($header))
        <div {{ $header->attributes->merge(['class' => 'container__header']) }}>
            <h2>{{ $header }}</h2>
        </div>
    @endif


    <div {{ $body->attributes->merge(['class' => 'container__body']) }}>
        {{ $body }}
    </div>
</div>
