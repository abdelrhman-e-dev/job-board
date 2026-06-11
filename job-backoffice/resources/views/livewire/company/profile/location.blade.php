            <section class="bg-white rounded-xl shadow-md p-lg">
                <form wire:submit="save">
                    <h3 class="font-title-md text-title-md flex items-center gap-2 mb-lg">
                        <span class="material-symbols-outlined text-primary">location_on</span> Location
                    </h3>
                    <div class="space-y-md">
                        <div class="space-y-2">
                            <label class="font-label-sm text-on-surface-variant">Address</label>
                            <input wire:model.live="address"
                                class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                                placeholder="123 Business Way" type="text" />
                            @error('address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-on-surface-variant">City</label>
                            <input wire:model.live="city"
                                class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                                placeholder="Dubai" type="text" />
                            @error('city')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-on-surface-variant">Country</label>
                            <input wire:model.live="country"
                                class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                                placeholder="United Arab Emirates" type="text" />
                            @error('country')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>  
                        <div class="pt-2">
                            <button type="submit" wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed" :disabled="!$wire.isDirty"
                                class="w-full px-xl py-2.5 bg-transparent border border-neutral-300 rounded-lg font-label-md transition-colors"
                                :class="$wire.isDirty ?
                                    ' border-primary text-primary hover:bg-primary hover:text-white' :
                                    'border-neutral-300 text-neutral-500 cursor-not-allowed'">
                                <span wire:loading.remove wire:target="save">Save Location</span>
                                <span wire:loading wire:target="save">Saving...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </section>
