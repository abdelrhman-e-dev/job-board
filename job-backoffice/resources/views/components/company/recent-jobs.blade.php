        <div class="p-lg border-b border-neutral-300 flex justify-between items-center">
            <h2 class="font-headline-md text-headline-md">Recent Jobs</h2>
            <button class="text-primary font-label-md text-label-md hover:underline">View all jobs</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md border-b border-neutral-300">
                    <tr>
                        <th class="px-lg py-md font-semibold">Job Title</th>
                        <th class="px-lg py-md font-semibold">Posted By</th>
                        <th class="px-lg py-md font-semibold">Status</th>
                        <th class="px-lg py-md font-semibold">Views</th>
                        <th class="px-lg py-md font-semibold">Applications</th>
                        <th class="px-lg py-md font-semibold">Date</th>
                        <th class="px-lg py-md font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100 font-body-md text-body-md">
                    @foreach ($recentJobs as $job)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="px-lg py-md">
                                <div class="flex items-center gap-sm">
                                    <div>
                                        <p class="font-title-md text-title-md">{{ $job->title }}</p>
                                        <p class="text-label-sm text-neutral-500">{{ $job->location }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-lg py-md">
                                <div>
                                    <p class="font-title-md text-title-md">{{ $job->creator->name }}</p>
                                    <p class="text-label-sm text-neutral-500">{{ $job->creator->role->role_name }}</p>
                                </div>
                            </td>
                            <td class="px-lg py-md">
                                <x-company.status-badge :status="$job->status" />
                            </td>
                            <td class="px-lg py-md">
                                {{ $job->views_count }}
                            </td>
                            <td class="px-lg py-md">
                                {{ $job->applications_count }}
                            </td>
                            <td class="px-lg py-md text-neutral-500">{{ $job->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-lg py-md text-right">
                                <a href="#"
                                    class="border border-neutral-300 px-md py-sm rounded-lg hover:bg-surface-container-low transition-all font-label-md text-label-md">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
