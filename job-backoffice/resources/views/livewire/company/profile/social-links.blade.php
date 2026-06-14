<section class="bg-white rounded-xl shadow-md p-lg">
    <form wire:submit="save">
        <h3 class="font-title-md text-title-md flex items-center gap-2 mb-lg">
            <span class="material-symbols-outlined text-primary">share</span> Social Links
        </h3>
        <div class="space-y-4">
            @foreach ($socialLinks as $index => $link)
                <div class="space-y-2 group/row relative" wire:key="social-link-{{ $index }}">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">edit</span>
                            <input type="text" wire:model.live="socialLinks.{{ $index }}.platform"
                                placeholder="Platform name (e.g. LinkedIn)"
                                class="w-full rounded-sm border-none focus:ring-1 focus:ring-neutral-300 p-2.5 outline-none" />
                        </div>
                        @error("socialLinks.$index.platform")
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <button type="button" wire:click="removeLink({{ $index }})"
                            class="text-on-surface-variant opacity-0 group-hover/row:opacity-100 hover:text-danger transition-all">
                            <span class="material-symbols-outlined text-xl">delete</span>
                        </button>
                    </div>

                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">link</span>
                        <input type="url" wire:model.live="socialLinks.{{ $index }}.url"
                            placeholder="https://..."
                            class="w-full pl-10 rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary p-2.5 outline-none" />
                    </div>
                    @error("socialLinks.$index.url")
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
        </div>
        <button type="button" wire:click="addLink"
            class="flex items-center gap-2 text-primary font-label-sm mt-2 hover:bg-primary-light p-2 rounded-lg transition-colors">
            <span class="material-symbols-outlined">add_circle</span> Add Link
        </button>
        <div class="mt-4 pt-2 border-t border-neutral-100 flex flex-col gap-4">
            <div class="flex justify-end">
                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                    :disabled="!$wire.isDirty"
                    class="w-full px-xl py-2.5 bg-transparent border border-neutral-300 rounded-lg font-label-md transition-colors"
                    :class="$wire.isDirty ?
                        ' border-primary text-primary hover:bg-primary hover:text-white' :
                        'border-neutral-300 text-neutral-500 cursor-not-allowed'">
                    <span wire:loading.remove wire:target="save">Save Changes</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>
        </div>
    </form>
</section>
