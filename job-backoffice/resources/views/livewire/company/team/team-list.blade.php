<div class="bg-surface-container-lowest rounded-xl custom-shadow border border-neutral-300 overflow-hidden"
    id="limit-banner">
    <div class="overflow-x-auto">
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
            <tbody class="divide-y divide-neutral-100">
                @foreach ($members as $member)
                    @if (Auth::guard('company')->user()->user_id == $member->user_id)
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
                                        <span class="ml-xs text-primary font-label-sm text-label-sm">(You)</span>
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
                                    <span
                                        class="bg-success-light text-success text-xs font-medium px-1.5 py-0.5 rounded">{{ $member->status }}</span>
                                </div>
                            </td>
                            <td class="px-md py-md text-secondary text-sm">{{ $member->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-md py-md text-right text-secondary">
                                <button
                                    class="p-2 rounded-lg text-secondary hover:bg-neutral-100 disabled:opacity-50 transition-all">
                                    <span class="material-symbols-outlined">drag_indicator</span>
                                </button>
                            </td>
                        </tr>
                    @else
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
                                    <span
                                        class="bg-success-light text-success text-xs font-medium px-1.5 py-0.5 rounded">{{ $member->status }}</span>
                                </div>
                            </td>
                            <td class="px-md py-md text-secondary text-sm">{{ $member->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-md py-md text-right text-secondary">
                                <button
                                    class="p-2 rounded-lg text-secondary hover:bg-neutral-100 disabled:opacity-50 transition-all">
                                    <button
                                        class="p-2 rounded-lg text-secondary hover:bg-neutral-100 disabled:opacity-50 transition-all">
                                        <span class="material-symbols-outlined">drag_indicator</span>
                                    </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination Footer -->
    <div class="px-lg py-md bg-surface-container-low border-t border-neutral-300 flex items-center justify-between">
        <span class="text-label-sm font-label-md text-neutral-700">Showing 1 to 4 of 4 results</span>
        <div class="flex items-center gap-xs"><button
                class="p-2 rounded-lg text-secondary hover:bg-neutral-100 disabled:opacity-50 transition-all"
                disabled=""><span class="material-symbols-outlined">chevron_left</span></button><button
                class="w-10 h-10 rounded bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center">1</button><button
                class="p-2 rounded-lg text-secondary hover:bg-neutral-100 disabled:opacity-50 transition-all"
                disabled=""><span class="material-symbols-outlined">chevron_right</span></button></div>
    </div>
</div>
