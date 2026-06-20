<!-- Invite Member Modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true"
    class=" hidden fixed inset-0 z-[99] flex items-center justify-center bg-black/50 p-md">
    <form wire:submit.prevent="inviteMember"
        class="w-full max-w-[580px] bg-surface-container-lowest border border-neutral-300 rounded-xl shadow-md p-lg flex flex-col gap-lg">

        <!-- Modal Header -->
        @if (session()->has('error'))
            <div class="bg-danger-light text-danger p-4 rounded-lg w-full flex items-center gap-sm">
                <span class="material-symbols-outlined">
                    error
                </span>
                {{ session('error') }}
            </div>
        @endif
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-headline-md font-headline-md text-neutral-900">
                    Invite Team Member
                </h2>
                <p class="text-label-sm font-label-sm text-neutral-500 mt-xs">
                    They'll receive an email with a link to set their password.
                </p>
            </div>
            <button type="button" data-modal-hide="default-modal"
                class="material-symbols-outlined text-neutral-500 hover:bg-neutral-100 rounded-full p-1 transition-colors">
                close
            </button>
        </div>

        <!-- Form Fields -->
        <div class="flex flex-col gap-md">
            <div class="grid grid-cols-2 gap-sm">
                <div class="flex flex-col gap-xs">
                    <label class="text-label-md font-label-md text-neutral-700">
                        First Name
                    </label>
                    <input type="text" placeholder="e.g. Sarah" wire:model="first_name" autocomplete="on"
                        class="w-full px-md py-sm border border-neutral-300 rounded-lg text-body-md focus:outline-none focus:border-primary" />
                    @error('first_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-xs">
                    <label class="text-label-md font-label-md text-neutral-700">
                        Last Name
                    </label>
                    <input type="text" placeholder="e.g. Johnson" wire:model="last_name" autocomplete="on"
                        class="w-full px-md py-sm border border-neutral-300 rounded-lg text-body-md focus:outline-none focus:border-primary" />
                    @error('last_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col gap-xs">
                <label class="text-label-md font-label-md text-neutral-700">
                    Work Email
                </label>
                <input type="email" placeholder="colleague@yourcompany.com" wire:model="email" autocomplete="on"
                    class="w-full px-md py-sm border border-neutral-300 rounded-lg text-body-md focus:outline-none focus:border-primary" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Info Note -->
        <div class="flex gap-sm p-md bg-primary-light border border-info rounded-lg">
            <span class="material-symbols-outlined text-info text-[20px]">
                info
            </span>
            <p class="text-label-sm font-label-sm text-neutral-700">
                The invitation link expires in 48 hours. The invited member will be assigned the Hiring Manager role.
            </p>
        </div>

        <!-- Modal Actions -->
        <div class="flex justify-end gap-sm">
            <button type="button" data-modal-hide="default-modal"
                class="px-lg py-sm border border-neutral-300 rounded-lg font-label-md text-label-md text-neutral-700 hover:bg-neutral-100 transition-colors">
                Cancel
            </button>

            <button type="submit"
                class="flex items-center gap-sm bg-primary text-on-primary px-lg py-sm rounded-lg font-label-md text-label-md hover:bg-primary-dark transition-all active:scale-95 shadow-md">
                <p wire:loading.remove class="flex items-center gap-sm">
                    <span class="material-symbols-outlined text-[20px]">
                        send
                    </span>
                    Send Invitation
                </p>
                <p wire:loading class="flex items-center gap-sm">
                    <span class="material-symbols-outlined animate-spin">
                        rotate_right
                    </span>
                    Sending...
                </p>
            </button>
        </div>

        </from>
</div>
