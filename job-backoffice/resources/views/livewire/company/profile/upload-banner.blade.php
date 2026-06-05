<div class="h-[300px] relative w-full bg-neutral-100 overflow-hidden group">

    <img alt="Banner Image" class="w-full h-full object-cover"
        src="{{ $currentBanner ? $currentBanner : asset('images/defaults/company-banner.webp') }}" />

    <div
        class="absolute inset-0 bg-black/40 transition-opacity duration-300 opacity-0 group-hover:opacity-100 flex items-center justify-center">

        <form wire:submit.prevent="save" class="flex flex-col items-center gap-2">

            <input type="file" id="banner-input" wire:model="banner" class="hidden">
            <label for="banner-input"
                class="cursor-pointer inline-flex items-center justify-center px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white font-medium text-sm rounded-md shadow-sm transition">
                Change Photo
            </label>
            @if ($banner && !$errors->has('banner'))
                <button type="submit"
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-md shadow-sm transition">
                    Save New Banner
                </button>
            @endif

            <div wire:loading wire:target="banner" class="text-sm text-white font-semibold animate-pulse">
                Uploading to server...
            </div>
            @error('banner')
                <span
                    class="text-sm text-red-500 font-bold mt-1 bg-white px-2 py-0.5 rounded shadow">{{ $message }}</span>
            @enderror
        </form>
    </div>
</div>
