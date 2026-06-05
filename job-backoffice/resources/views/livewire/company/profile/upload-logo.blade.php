<div class="relative -mt-12 group/logo w-28 h-28" x-data="{ showToast: false, toastMessage: '', toastType: 'success' }"
    x-on:notify.window="showToast = true; toastMessage = $event.detail.title; toastType = $event.detail.type; setTimeout(() => showToast = false, 4000)">

    <div
        class="w-28 h-28 rounded-full border-4 border-white bg-neutral-50 shadow-md overflow-hidden flex items-center justify-center relative">
        @if ($logo && !$errors->has('logo'))
            <img src="{{ $logo->temporaryUrl() }}" alt="New Logo Preview" class="w-full h-full object-cover">
        @elseif ($currentLogo)
            <img src="{{ $currentLogo }}" alt="Current Logo" class="w-full h-full object-cover">
        @else
            <span class="material-symbols-outlined text-neutral-300 text-5xl select-none">corporate_fare</span>
        @endif

        <div wire:loading wire:target="logo"
            class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center text-white text-center p-2">
            <svg class="animate-spin h-5 w-5 text-white mb-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <span class="text-[10px] font-medium tracking-wider uppercase">Uploading</span>
        </div>
    </div>

    <form wire:submit.prevent="save">
        <input type="file" id="logo-input" wire:model="logo" class="hidden" accept="image/*">

        <label for="logo-input"
            class="absolute bottom-1 right-1 w-8 h-8 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg border-2 border-white transition-all cursor-pointer transform hover:scale-110 active:scale-95">
            <span class="material-symbols-outlined text-[16px]">add_a_photo</span>
        </label>

        @if ($logo && !$errors->has('logo'))
            <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 whitespace-nowrap z-10 animate-fade-in">
                <button type="submit"
                    class="inline-flex items-center gap-1 px-3 py-1 bg-green-600 hover:bg-green-700 text-white font-medium text-xs rounded-full shadow-md transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined text-[14px]">check</span>
                    Save Logo
                </button>
            </div>
        @endif
    </form>

    @error('logo')
        <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 whitespace-nowrap z-10">
            <span
                class="text-[11px] text-red-600 font-semibold bg-red-50 border border-red-200 px-2 py-0.5 rounded shadow-sm">{{ $message }}</span>
        </div>
    @enderror

    <div x-show="showToast" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-5 right-5 z-50 flex items-center p-4 rounded-lg shadow-xl text-white max-w-xs"
        :class="toastType === 'success' ? 'bg-emerald-600' : 'bg-red-600'" style="display: none;">
        <span class="material-symbols-outlined mr-2" x-text="toastType === 'success' ? 'check_circle' : 'error'"></span>
        <span class="text-sm font-medium" x-text="toastMessage"></span>
    </div>
</div>
