@props(['title', 'url' => null, 'badge' => null])

<article {{ $attributes->merge(['class' => 'card']) }}>
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