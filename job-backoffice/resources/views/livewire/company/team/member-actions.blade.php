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
                        <p class="text-label-sm font-label-sm text-neutral-500 mt-xs">Are you sure you want to resend
                            the invitation email to {{ $member->email }}?</p>
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
    {{-- Reassign Modal --}}
    @if ($reassign)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-md" x-cloak>
            <div @click.outside="$wire.cancelReassign()"
                class="w-full max-w-[480px] bg-surface-container-lowest rounded-xl shadow-xl flex flex-col text-left overflow-hidden">
                
                {{-- Header --}}
                <div class="px-6 pt-6 pb-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-danger-light flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-danger text-[26px]">warning</span>
                        </div>
                        <div class="flex flex-col pt-1">
                            <h2 class="text-[18px] font-bold text-neutral-900 leading-tight">Reassign & Deactivate Member</h2>
                            <p class="text-[14px] text-neutral-500 mt-1">Member: {{ $member->first_name }} {{ $member->last_name }}</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 pb-6 flex flex-col gap-5">
                    {{-- Pending Workload Summary --}}
                    <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-lg p-4">
                        <h3 class="text-[14px] font-bold text-neutral-800 mb-3">Pending Workload Summary</h3>
                        <div class="grid grid-cols-2 gap-y-3 gap-x-4">
                            <div class="flex items-center gap-2 text-neutral-600">
                                <span class="material-symbols-outlined text-neutral-500 text-[18px]">description</span>
                                <span class="text-[13px]"><strong>3</strong> Job Postings</span>
                            </div>
                            <div class="flex items-center gap-2 text-neutral-600">
                                <span class="material-symbols-outlined text-neutral-500 text-[18px]">task</span>
                                <span class="text-[13px]"><strong>12</strong> Reviewed Applications</span>
                            </div>
                            <div class="flex items-center gap-2 text-neutral-600">
                                <span class="material-symbols-outlined text-neutral-500 text-[18px]">event_note</span>
                                <span class="text-[13px]"><strong>4</strong> Active Interviews</span>
                            </div>
                            <div class="flex items-center gap-2 text-neutral-600">
                                <span class="material-symbols-outlined text-neutral-500 text-[18px]">assignment_late</span>
                                <span class="text-[13px]"><strong>1</strong> Pending Offer</span>
                            </div>
                        </div>
                    </div>

                    {{-- Reassign work to --}}
                    <div>
                        <label class="block text-[13px] font-medium text-neutral-600 mb-2">Reassign work to</label>
                        <div class="relative">
                            <select class="w-full appearance-none bg-white border border-neutral-300 text-neutral-900 text-sm rounded-md px-3 py-2 pr-8 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
                                <option>Sarah Jenkins (Company Owner)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-neutral-500">
                                <span class="material-symbols-outlined text-[20px]">expand_more</span>
                            </div>
                        </div>
                    </div>

                    {{-- Info box --}}
                    <div class="bg-[#F0F9FF] border border-[#B9E6FE] p-3 rounded-md flex items-start gap-3">
                        <span class="material-symbols-outlined text-[#0284C7] text-[18px] shrink-0 mt-[1px]">info</span>
                        <p class="text-[13px] text-neutral-700 leading-relaxed">
                            Deactivating this member will revoke their access immediately. All historical data, notes, and the workload listed above will be transferred to <strong class="font-semibold text-neutral-900">Sarah Jenkins</strong>.
                        </p>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="flex items-center justify-end gap-6 mt-2">
                        <button type="button" wire:click="cancelReassign"
                            class="text-[14px] font-medium text-neutral-600 hover:text-neutral-900 transition-colors">Cancel</button>
                        <button type="button" wire:click="reassignAssets" wire:loading.attr="disabled"
                            wire:target="reassignAssets"
                            class="flex justify-center items-center gap-2 bg-danger text-white px-5 py-2.5 rounded-md text-[14px] font-medium hover:bg-danger-dark transition-all active:scale-95 shadow-sm disabled:opacity-75 disabled:pointer-events-none">
                            <span wire:loading.remove wire:target="reassignAssets">Reassign & Deactivate</span>
                            <span wire:loading wire:target="reassignAssets"
                                class="material-symbols-outlined text-[20px] animate-spin">progress_activity</span>
                            <span wire:loading wire:target="reassignAssets">Processing...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
