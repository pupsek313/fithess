@props(['title', 'url' => null, 'badge' => null, 'image' => null, 'alt' => null])

<article {{ $attributes->merge(['class' => 'card']) }}>
    @if ($image)
        <div class="card-media">
            @if ($url)<a href="{{ $url }}">@endif
                <img src="{{ $image }}" alt="{{ $alt ?? $title }}" loading="lazy">
            @if ($url)</a>@endif
        </div>
    @endif

    <h3 class="card-title">
        @if ($url)
            <a href="{{ $url }}">{{ $title }}</a>
        @else
            {{ $title }}
        @endif

        @if ($badge)
            <x-badge>{{ $badge }}</x-badge>
        @endif
    </h3>

    <div class="card-body">
        {{ $slot }}
    </div>
</article>