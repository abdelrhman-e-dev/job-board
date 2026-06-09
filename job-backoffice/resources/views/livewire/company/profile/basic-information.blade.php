<section class="lg:col-span-8 bg-white rounded-xl h-fit shadow-md p-lg">
    <form wire:submit.prevent="save">
        <div class="flex items-center justify-between mb-lg">
            <h3 class="font-title-md text-title-md flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">info</span> Basic Information
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
            <div class="md:col-span-2 space-y-2">
                <label class="font-label-md text-on-surface-variant">Company Name</label>
                <input
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    type="text" wire:model.live="name" />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="md:col-span-2 space-y-2">
                <label class="font-label-md text-on-surface-variant">Description</label>
                <textarea
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    placeholder="Enter company bio..." rows="4" wire:model.live="description"></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-2">
                <label class="font-label-md text-on-surface-variant">Industry</label>
                <input
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    type="text" wire:model.live="industry" />
                @error('industry')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-2">
                <label class="font-label-md text-on-surface-variant">Specialization</label>
                <input
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    type="text" placeholder="e.g. AI, Fintech" wire:model.live="specialization" />
                @error('specialization')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-2">
                <label class="font-label-md text-on-surface-variant">Company Size</label>
                <select
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    wire:model.live="size">
                    <option value="">Select company size</option>
                    @foreach ($companySizes as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('size')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-2">
                <label class="font-label-md text-on-surface-variant">Founded Year</label>
                <input
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    type="text" placeholder="e.g. 2022" wire:model.live="founded_year" />
                @error('founded_year')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="md:col-span-2 space-y-2">
                <label class="font-label-md text-on-surface-variant">Website URL</label>
                <input
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    type="url" wire:model.live="website" />
                @error('website')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mt-xl flex justify-end">
            <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                :disabled="!$wire.isDirty" class="px-xl py-2.5 rounded-lg font-label-md shadow-md transition-colors"
                :class="$wire.isDirty ?
                    'bg-primary text-white hover:bg-primary-dark' :
                    'bg-neutral-300 text-neutral-500 cursor-not-allowed'">
                <span wire:loading.remove wire:target="save">Save Changes</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </form>
</section>
