<div x-data="{ show: false }" 
     x-show="show" 
     x-on:open-invite-modal.window="show = true" 
     x-on:close-invite-modal.window="show = false"
     x-transition.opacity
     style="display: none;"
     class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-md"
     x-cloak>
    <form wire:submit="inviteMember" @click.outside="show = false"
        class="w-full max-w-[480px] bg-surface-container-lowest border border-neutral-300 rounded-xl shadow-md p-lg flex flex-col gap-lg">
        <!-- Modal Header -->
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-headline-md font-headline-md text-neutral-900">Invite Team Member</h2>
                <p class="text-label-sm font-label-sm text-neutral-500 mt-xs">They'll receive an email with a link to set
                    their password.</p>
            </div>
            <button type="button" @click="show = false"
                class="material-symbols-outlined text-neutral-500 hover:bg-neutral-100 rounded-full p-1 transition-colors">close</button>
        </div>
        <!-- Form Fields -->
        <div class="flex flex-col gap-md">
            <div class="grid grid-cols-2 gap-sm">
                <div class="flex flex-col gap-xs">
                    <label class="text-label-md font-label-md text-neutral-700">First Name</label>
                    <input wire:model="first_name"
                        class="w-full px-md py-sm border border-neutral-300 rounded-lg text-body-md focus:outline-none focus:border-primary"
                        placeholder="e.g. Sarah" type="text" />
                    @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col gap-xs">
                    <label class="text-label-md font-label-md text-neutral-700">Last Name</label>
                    <input wire:model="last_name"
                        class="w-full px-md py-sm border border-neutral-300 rounded-lg text-body-md focus:outline-none focus:border-primary"
                        placeholder="e.g. Johnson" type="text" />
                    @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-col gap-xs">
                <label class="text-label-md font-label-md text-neutral-700">Work Email</label>
                <input wire:model="email"
                    class="w-full px-md py-sm border border-neutral-300 rounded-lg text-body-md focus:outline-none focus:border-primary"
                    placeholder="colleague@yourcompany.com" type="email" />
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <!-- Info Note -->
        <div class="flex gap-sm p-md bg-primary-light border border-info rounded-lg">
            <span class="material-symbols-outlined text-info text-[20px]">info</span>
            <p class="text-label-sm font-label-sm text-neutral-700">The invitation link expires in 48 hours. The invited
                member will be assigned the Hiring Manager role.</p>
        </div>
        <!-- Modal Actions -->
        <div class="flex justify-end gap-sm">
            <button type="button" @click="show = false"
                class="px-lg py-sm border border-neutral-300 rounded-lg font-label-md text-label-md text-neutral-700 hover:bg-neutral-100 transition-colors">Cancel</button>
            <button type="submit"
                wire:loading.attr="disabled"
                wire:target="inviteMember"
                class="flex items-center gap-sm bg-primary text-on-primary px-lg py-sm rounded-lg font-label-md text-label-md hover:bg-primary-dark transition-all active:scale-95 shadow-md disabled:opacity-75 disabled:pointer-events-none">
                <span wire:loading.remove wire:target="inviteMember" class="material-symbols-outlined text-[20px]">send</span>
                <span wire:loading wire:target="inviteMember" class="material-symbols-outlined text-[20px] animate-spin">progress_activity</span>
                <span wire:loading.remove wire:target="inviteMember">Send Invitation</span>
                <span wire:loading wire:target="inviteMember">Sending...</span>
            </button>
        </div>
    </form>
</div>
