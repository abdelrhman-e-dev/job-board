<section class="bg-white rounded-xl shadow-md p-lg">
    <form wire:submit="save">
        <h3 class="font-title-md text-title-md flex items-center gap-2 mb-lg">
            <span class="material-symbols-outlined text-primary">contact_mail</span> Contact Info
        </h3>
        <div class="space-y-md">
            <div class="space-y-2">
                <label class="font-label-sm text-on-surface-variant">Contact Phone</label>
                <input wire:model.live="contact_phone"
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    placeholder="+971 00 000 0000" type="tel" />
                @error('contact_phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-2">
                <label class="font-label-sm text-on-surface-variant">Contact Email</label>
                <input wire:model.live="contact_email"
                    class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                    placeholder="[EMAIL_ADDRESS]" type="email" />
                @error('contact_email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="pt-2">
                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                    :disabled="!$wire.isDirty"
                    class="w-full px-xl py-2.5 bg-transparent border border-neutral-300 rounded-lg font-label-md transition-colors"
                    :class="$wire.isDirty ?
                        ' border-primary text-primary hover:bg-primary hover:text-white' :
                        'border-neutral-300 text-neutral-500 cursor-not-allowed'">
                    <span wire:loading.remove wire:target="save">Save</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>
        </div>
    </form>
</section>
