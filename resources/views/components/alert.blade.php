<div {{ $attributes->merge(['class' => "alert alert-{$type}"]) }}>
    <span class="alert-icon">{{ $icon() }}</span>
    <div>{{ $slot }}</div>
</div>