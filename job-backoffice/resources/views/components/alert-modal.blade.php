@props(['alert'])

@if ($alert)
    @php
        $type = $alert['type'] ?? 'info';

        $theme =
            [
                'success' => [
                    'badge' => 'bg-green-100 text-green-600 ring-green-200/60',
                    'bar' => 'bg-green-500',
                    'btn' => 'bg-green-600 hover:bg-green-700 focus-visible:ring-green-500',
                ],
                'danger' => [
                    'badge' => 'bg-red-100 text-red-600 ring-red-200/60',
                    'bar' => 'bg-red-500',
                    'btn' => 'bg-red-600 hover:bg-red-700 focus-visible:ring-red-500',
                ],
                'warning' => [
                    'badge' => 'bg-amber-100 text-amber-600 ring-amber-200/60',
                    'bar' => 'bg-amber-500',
                    'btn' => 'bg-amber-600 hover:bg-amber-700 focus-visible:ring-amber-500',
                ],
                'info' => [
                    'badge' => 'bg-blue-100 text-blue-600 ring-blue-200/60',
                    'bar' => 'bg-blue-500',
                    'btn' => 'bg-blue-600 hover:bg-blue-700 focus-visible:ring-blue-500',
                ],
            ][$type] ?? [
                'badge' => 'bg-gray-100 text-gray-600 ring-gray-200/60',
                'bar' => 'bg-gray-500',
                'btn' => 'bg-gray-800 hover:bg-gray-900 focus-visible:ring-gray-500',
            ];
    @endphp

    <div x-data="{ open: true }" x-show="open" x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keydown.escape.window="open = false; $wire.dismissAlert()"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm"
        role="alertdialog" aria-modal="true" aria-labelledby="alert-title" aria-describedby="alert-message"
        @click.self="open = false; $wire.dismissAlert()">

        <div x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5">

            {{-- Accent bar --}}
            <div class="h-1.5 w-full {{ $theme['bar'] }}"></div>

            {{-- Close button --}}
            <button type="button" @click="open = false; $wire.dismissAlert()" aria-label="Close"
                class="absolute top-4 ltr:right-4 rtl:left-4 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 transition hover:bg-gray-100 hover:text-gray-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-300">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>

            <div class="p-6 sm:p-7 ">
                <div class="flex items-start gap-4 mt-4">
                    {{-- Icon badge --}}
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl ring-4 {{ $theme['badge'] }}">
                        <span class="material-symbols-outlined text-2xl">
                            {{ $alert['icon'] ?? 'info' }}
                        </span>
                    </div>

                    {{-- Text --}}
                    <div class="min-w-0 flex-1 ltr:pr-6 rtl:pl-6">
                        <h3 id="alert-title" class="text-lg font-bold leading-snug text-gray-900">
                            {{ $alert['title'] }}
                        </h3>
                        <p id="alert-message" class="mt-2 text-sm leading-relaxed text-gray-600">
                            {{ $alert['message'] }}
                        </p>
                    </div>
                </div>

                {{-- Actions --}}
                @if (!empty($alert['secondaryButton']) || !empty($alert['primaryButton']))
                    <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        @if (!empty($alert['secondaryButton']))
                            <a href="{{ $alert['secondaryButton']['link'] ?? '#' }}" wire:click="dismissAlert"
                                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-300 focus-visible:ring-offset-2">
                                {{ $alert['secondaryButton']['text'] }}
                            </a>
                        @endif

                        @if (!empty($alert['primaryButton']))
                            <a href="{{ $alert['primaryButton']['link'] ?? '#' }}"
                                class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 {{ $theme['btn'] }}">
                                {{ $alert['primaryButton']['text'] }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif