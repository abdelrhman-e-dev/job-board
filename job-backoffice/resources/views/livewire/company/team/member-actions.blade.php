{{-- member-actions.blade.php --}}
<div>
    <x-dropdown align="right">
        <x-slot name="trigger">
            <button class="p-2 rounded-lg text-secondary hover:bg-neutral-100 disabled:opacity-50 transition-all">
                <span class="material-symbols-outlined">more_vert</span>
            </button>
        </x-slot>

        <x-slot name="content">
            @if ($member->InvitationIsPending())
                <button wire:click="confirmResend"
                    class="flex items-center gap-xs w-full px-4 py-2 text-start text-sm leading-5 text-neutral-100 hover:bg-neutral-100 hover:text-neutral-900 focus:outline-none focus:bg-neutral-100 transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined text-[18px]">outgoing_mail</span> Resend Invite
                </button>
                <button wire:click="$set('confirmingRemove', true)"
                    class="flex items-center gap-xs w-full px-4 py-2 text-start text-sm leading-5 text-danger hover:bg-danger-light focus:outline-none focus:bg-danger-light transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined text-[18px]">delete</span> Remove
                </button>
            @elseif ($member->status === 'active')
                <button wire:click="$set('confirmingDeactivate', true)"
                    class="flex items-center gap-xs w-full px-4 py-2 text-start text-sm leading-5 text-danger hover:bg-danger-light focus:outline-none focus:bg-danger-light transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined text-[18px]">block</span> Deactivate
                </button>
            @else
                <button wire:click="reactivateMember"
                    class="flex items-center gap-xs w-full px-4 py-2 text-start text-sm leading-5 text-success hover:bg-success-light focus:outline-none focus:bg-success-light transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span> Reactivate
                </button>
                <button wire:click="$set('confirmingRemove', true)"
                    class="flex items-center gap-xs w-full px-4 py-2 text-start text-sm leading-5 text-danger hover:bg-danger-light focus:outline-none focus:bg-danger-light transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined text-[18px]">delete</span> Remove
                </button>
            @endif
        </x-slot>
    </x-dropdown>

    {{-- Deactivate Confirmation Modal --}}
    @if ($confirmingDeactivate)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-md" x-cloak>
            <div @click.outside="$wire.set('confirmingDeactivate', false)"
                class="w-full max-w-[480px] bg-surface-container-lowest border border-neutral-300 rounded-xl shadow-md p-lg flex flex-col gap-lg text-left">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-headline-md font-headline-md text-neutral-900">Deactivate Member?</h2>
                        <p class="text-label-sm font-label-sm text-neutral-500 mt-xs">This will prevent
                            {{ $member->first_name }} from accessing the dashboard.</p>
                    </div>
                    <button type="button" wire:click="$set('confirmingDeactivate', false)"
                        class="material-symbols-outlined text-neutral-500 hover:bg-neutral-100 rounded-full p-1 transition-colors">close</button>
                </div>
                <div class="flex justify-end gap-sm mt-md">
                    <button type="button" wire:click="$set('confirmingDeactivate', false)"
                        class="px-lg py-sm border border-neutral-300 rounded-lg font-label-md text-label-md text-neutral-700 hover:bg-neutral-100 transition-colors">Cancel</button>
                    <button type="button" wire:click="deactivateMember" wire:loading.attr="disabled"
                        wire:target="deactivateMember"
                        class="flex items-center gap-sm bg-danger text-white px-lg py-sm rounded-lg font-label-md text-label-md hover:bg-red-700 transition-all active:scale-95 shadow-md disabled:opacity-75 disabled:pointer-events-none">
                        <span wire:loading.remove wire:target="deactivateMember">Yes, Deactivate</span>
                        <span wire:loading wire:target="deactivateMember"
                            class="material-symbols-outlined text-[20px] animate-spin">progress_activity</span>
                        <span wire:loading wire:target="deactivateMember">Deactivating...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Remove Confirmation Modal --}}
    @if ($confirmingRemove)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-md" x-cloak>
            <div @click.outside="$wire.set('confirmingRemove', false)"
                class="w-full max-w-[480px] bg-surface-container-lowest border border-neutral-300 rounded-xl shadow-md p-lg flex flex-col gap-lg text-left">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-headline-md font-headline-md text-neutral-900">Remove Member?</h2>
                        <p class="text-label-sm font-label-sm text-neutral-500 mt-xs">This will permanently remove
                            {{ $member->first_name }} from your team.</p>
                    </div>
                    <button type="button" wire:click="$set('confirmingRemove', false)"
                        class="material-symbols-outlined text-neutral-500 hover:bg-neutral-100 rounded-full p-1 transition-colors">close</button>
                </div>
                <div class="flex justify-end gap-sm mt-md">
                    <button type="button" wire:click="$set('confirmingRemove', false)"
                        class="px-lg py-sm border border-neutral-300 rounded-lg font-label-md text-label-md text-neutral-700 hover:bg-neutral-100 transition-colors">Cancel</button>
                    <button type="button" wire:click="removeMember" wire:loading.attr="disabled"
                        wire:target="removeMember"
                        class="flex items-center gap-sm bg-danger text-white px-lg py-sm rounded-lg font-label-md text-label-md hover:bg-red-700 transition-all active:scale-95 shadow-md disabled:opacity-75 disabled:pointer-events-none">
                        <span wire:loading.remove wire:target="removeMember">Yes, Remove</span>
                        <span wire:loading wire:target="removeMember"
                            class="material-symbols-outlined text-[20px] animate-spin">progress_activity</span>
                        <span wire:loading wire:target="removeMember">Removing...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Resend Invitation Modal --}}
    @if ($confirmingResend)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-md" x-cloak>
            <div @click.outside="$wire.cancelResend()"
                class="w-full max-w-[480px] bg-surface-container-lowest border border-neutral-300 rounded-xl shadow-md p-lg flex flex-col gap-lg text-left">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-headline-md font-headline-md text-neutral-900">Resend Invitation?</h2>
                        <p class="text-label-sm font-label-sm text-neutral-500 mt-xs">Are you sure you want to resend the invitation email to {{ $member->email }}?</p>
                    </div>
                    <button type="button" wire:click="cancelResend"
                        class="material-symbols-outlined text-neutral-500 hover:bg-neutral-100 rounded-full p-1 transition-colors">close</button>
                </div>
                <div class="flex justify-end gap-sm mt-md">
                    <button type="button" wire:click="cancelResend"
                        class="px-lg py-sm border border-neutral-300 rounded-lg font-label-md text-label-md text-neutral-700 hover:bg-neutral-100 transition-colors">Cancel</button>
                    <button type="button" wire:click="resendInvite" wire:loading.attr="disabled"
                        wire:target="resendInvite"
                        class="flex items-center gap-sm bg-primary text-white px-lg py-sm rounded-lg font-label-md text-label-md hover:bg-primary-dark transition-all active:scale-95 shadow-md disabled:opacity-75 disabled:pointer-events-none">
                        <span wire:loading.remove wire:target="resendInvite">Yes, Resend</span>
                        <span wire:loading wire:target="resendInvite"
                            class="material-symbols-outlined text-[20px] animate-spin">progress_activity</span>
                        <span wire:loading wire:target="resendInvite">Sending...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
