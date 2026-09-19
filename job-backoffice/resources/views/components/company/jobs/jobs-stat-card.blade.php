<div class="bg-white p-lg rounded-xl shadow-md border border-neutral-300 flex items-start justify-between">
    <div>
        <p class="text-label-md text-neutral-500 mb-xs"> {{ $label }}</p>
        <h3 class="text-headline-lg font-bold text-on-surface">
            {{ number_format($value) }}
        </h3>
        <p class="text-label-sm text-neutral-500 mt-sm">
        {{ $description }}
        </p>
    </div>
    <div @class([
        'w-12 h-12 rounded-lg flex items-center
                                    justify-center mb-md',
        'bg-primary-light text-primary' => $color === 'primary',
        'bg-info-light text-info' => $color === 'info',
        'bg-success-light text-success' => $color === 'success',
        'bg-warning-light text-warning' => $color === 'warning',
        'bg-danger-light text-danger' => $color === 'danger',
    ])>
        <span class="material-symbols-outlined">{{ $icon }}</span>
    </div>
</div>
