    <div class="bg-white rounded-xl shadow-md border border-neutral-300 overflow-hidden">
        <!-- Search & Filter Bar -->
        {{-- <div class="p-lg border-b border-neutral-300 flex flex-col md:flex-row gap-md items-center justify-between">
            <div class="flex flex-1 gap-md w-full">
                <div class="relative flex-1">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-neutral-500">search</span>
                    <input
                        class="w-full pl-10 pr-4 py-2 border border-neutral-300 rounded-lg text-body-md focus:ring-2 focus:ring-primary focus:border-primary"
                        placeholder="Search by job title, ID, or keywords..." type="text" />
                </div>
                <select
                    class="border border-neutral-300 rounded-lg text-body-md py-2 px-md focus:ring-2 focus:ring-primary focus:border-primary">
                    <option>All Statuses</option>
                    <option>Active</option>
                    <option>Draft</option>
                    <option>Closed</option>
                </select>
            </div>
            <button
                class="w-full md:w-auto bg-primary text-white py-2 px-lg rounded-lg font-label-md text-label-md hover:bg-primary-dark transition-all flex items-center justify-center gap-sm">
                <span class="material-symbols-outlined">add</span>
                Post a Job
            </button>
        </div> --}}
        <!-- Jobs Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-neutral-100">
                    <tr>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Job
                            Title
                        </th>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">
                            Department
                        </th>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Status
                        </th>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">
                            Applications
                        </th>
                        @if (Auth::guard('company')->user()->isOwner())
                            <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">
                                Posted
                                By
                            </th>
                        @endif
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Posted
                            Date
                        </th>
                        <th
                            class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-300">
                    <!-- Row 1 -->
                    @foreach ($jobs as $job)
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-lg py-lg">
                                <div class="flex flex-col">
                                    <span class="font-title-md text-title-md text-on-surface">{{ $job->title }}</span>
                                </div>
                            </td>
                            <td class="px-lg py-lg text-body-md text-on-surface">{{ $job->jobCategory->name }}</td>
                            <td class="px-lg py-lg"> <x-company.status-badge :status="$job['status']" /> </td>
                            <td class="px-lg py-lg">
                                <div class="flex items-center gap-sm">
                                    <span class="font-title-md text-title-md">{{ $job->applications_count }}</span>
                                </div>
                            </td>
                            @if (Auth::guard('company')->user()->isOwner())
                                <td class="px-lg py-lg text-body-md text-on-surface">
                                    {{ $job->creator->first_name }} {{ $job->creator->last_name }}</td>
                                </td>
                            @endif
                            <td class="px-lg py-lg text-body-md text-on-surface">
                                {{ \Carbon\Carbon::parse($job->published_at)->format('M, D y') }}</td>
                            <td class="px-lg py-lg text-body-md text-on-surface">
                                <div class="flex items-center justify-end gap-xs  transition-opacity">
                                    <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary"
                                        title="Edit"><span class="material-symbols-outlined">edit</span></button>
                                    <button class="p-2 hover:bg-neutral-100 rounded-full text-primary"
                                        title="View Applications"><span
                                            class="material-symbols-outlined">visibility</span></button>
                                    <button class="p-2 hover:bg-neutral-100 rounded-full text-danger"
                                        title="Close"><span class="material-symbols-outlined">block</span></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        {{ $jobs->links('vendor.livewire.custom-pagination') }}
    </div>
