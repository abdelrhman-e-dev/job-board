<div class="bg-white rounded-lg border border-neutral-300
            shadow p-lg">

    {{-- Icon --}}
    <div @class([
        'w-10 h-10 rounded-lg flex items-center
                 justify-center mb-md',
        'bg-primary-light text-primary' => $color === 'primary',
        'bg-info-light text-info' => $color === 'info',
        'bg-success-light text-success' => $color === 'success',
        'bg-warning-light text-warning' => $color === 'warning',
    ])>
        <span class="material-symbols-outlined text-xl">
            {{ $icon }}
        </span>
    </div>

    {{-- Label --}}
    <p class="text-small-text text-neutral-500 mb-xs">
        {{ $label }}
    </p>

    {{-- Value --}}
    <p class="text-page-title text-neutral-900">
        {{ number_format($value) }}
    </p>
</div>
