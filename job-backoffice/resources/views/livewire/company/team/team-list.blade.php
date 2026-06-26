<div class="bg-surface-container-lowest rounded-xl custom-shadow border border-neutral-300 overflow-visible h-full flex flex-col w-full"
    id="limit-banner">
    <div class="overflow-visible flex-1 h-full">
        {{-- empty state when no hiring managers exist --}}
        @if (!isset($members))
            <div class="bg-surface-container-lowest rounded-xl custom-shadow border border-neutral-300 overflow-hidden"
                id="limit-banner">
                <div class="flex flex-col items-center justify-center py-3xl text-center px-lg">
                    <div class="w-[80px] h-[80px] rounded-full bg-neutral-100 flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined text-neutral-300" style="font-size: 40px;">group</span>
                    </div>
                    <h3 class="text-headline-md font-headline-md text-neutral-900 mb-xs">No team members yet</h3>
                    <p class="text-body-md text-neutral-500 max-w-[320px] mb-lg">Invite hiring managers to
                        collaborate
                        on job postings and review applications together.</p>
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="flex items-center justify-center gap-sm bg-primary text-on-primary px-[20px] py-[10px] rounded-lg font-label-md text-label-md hover:bg-primary-dark transition-all active:scale-95 shadow-md"
                        type="button">
                        <span class="material-symbols-outlined">add</span>
                        Invite Your First Member
                    </button>
                </div>
            </div>
        @else
            <table class="w-full text-left border-collapse">
                <thead class="border-b border-neutral-300 bg-neutral-100">
                    <tr class="bg-neutral-100">
                        <th class="px-md py-md text-sm font-semibold text-neutral-700">MEMBER</th>
                        <th class="px-md py-md text-sm font-semibold text-neutral-700">EMAIL</th>
                        <th class="px-md py-md text-sm font-semibold text-neutral-700">ROLE</th>
                        <th class="px-md py-md text-sm font-semibold text-neutral-700">STATUS</th>
                        <th class="px-md py-md text-sm font-semibold text-neutral-700">JOINED DATE</th>
                        <th class="px-md py-md text-sm font-semibold text-neutral-700 text-right">ACTIONS
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr class="hover:bg-surface-bright transition-colors">
                            <td class="px-md py-md">
                                <div class="flex items-center gap-md">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary font-title-md">
                                        {{ $member->first_name[0] . $member->last_name[0] }}
                                    </div>
                                    <div>
                                        <span
                                            class="text-body-md font-semibold text-on-surface">{{ $member->first_name . ' ' . $member->last_name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-md py-md text-body-md text-secondary">{{ $member->email }}</td>
                            <td class="px-md py-md">
                                <span
                                    class="bg-primary-light text-primary-container text-xs font-medium px-1.5 py-0.5 rounded">{{ $member->role->role_name }}</span>
                            </td>
                            <td class="px-md py-md">
                                <div class="flex items-center gap-xs">
                                    @if ($member->status == 'active')
                                        <span
                                            class="bg-success-light text-success text-xs font-medium px-1.5 py-0.5 rounded">
                                            {{ $member->status }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-danger-light text-danger text-xs font-medium px-1.5 py-0.5 rounded">
                                            {{ $member->status }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-md py-md text-secondary text-sm">
                                {{ $member->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-md py-md text-right text-secondary">
                                {{-- هنا بنستدعي MemberActions ونديه بيانات العضو --}}
                                <livewire:company.team.member-actions :member="$member" :key="'member-actions-' . $member->user_id" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
