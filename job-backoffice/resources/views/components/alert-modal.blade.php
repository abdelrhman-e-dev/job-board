@props(['alert'])

@if ($alert)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl transform transition-all">

            @php
                $colors =
                    [
                        'success' => 'text-green-600 bg-green-50',
                        'danger' => 'text-red-600 bg-red-50',
                        'warning' => 'text-amber-600 bg-amber-50',
                        'info' => 'text-blue-600 bg-blue-50',
                    ][$alert['type']] ?? 'text-gray-600 bg-gray-50';
            @endphp

            <div class="flex items-center space-x-4 rtl:space-x-reverse mb-4">
                <div class="w-10 h-10 rounded-lg flex items-center
        justify-center mb-md {{ $colors }}">
                    <span class="material-symbols-outlined text-xl">
                        {{ $alert['icon'] }}
                    </span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">{{ $alert['title'] }}</h3>
            </div>

            <p class="text-gray-800 mb-6 text-sm leading-relaxed">
                {{ $alert['message'] }}
            </p>

            <div class="flex space-x-3 rtl:space-x-reverse justify-end">
                @if (!empty($alert['secondaryButton']))
                    <a href="{{ $alert['secondaryButton']['link'] ?? '#' }}" wire:click="dismissAlert"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        {{ $alert['secondaryButton']['text'] }}
                    </a>
                @endif

                @if (!empty($alert['primaryButton']))
                    <a href="{{ $alert['primaryButton']['link'] ?? '#' }}"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        {{ $alert['primaryButton']['text'] }}
                    </a>
                @endif
            </div>

        </div>
    </div>
@endif
