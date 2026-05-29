        <div class="p-lg border-b border-neutral-300 flex justify-between items-center">
            <h2 class="font-headline-md text-headline-md">Recent Applications</h2>
            <button class="text-primary font-label-md text-label-md hover:underline">View all applications</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md border-b border-neutral-300">
                    <tr>
                        <th class="px-lg py-md font-semibold">Candidate</th>
                        <th class="px-lg py-md font-semibold">Job Title</th>
                        <th class="px-lg py-md font-semibold">Status</th>
                        <th class="px-lg py-md font-semibold">Date</th>
                        <th class="px-lg py-md font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100 font-body-md text-body-md">
                    @foreach ($recentApplications as $application)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="px-lg py-md">
                                <div class="flex items-center gap-sm">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                        {{ $application->jobSeeker->name[0] }}
                                    </div>
                                    <div>
                                        <p class="font-title-md text-title-md">{{ $application->jobSeeker->name }}</p>
                                        <p class="text-label-sm text-neutral-500">{{ $application->jobSeeker->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-lg py-md text-neutral-700">{{ $application->job->title }}</td>
                            <td class="px-lg py-md">
                                <x-company.status-badge :status="$application->status" />
                            </td>
                            <td class="px-lg py-md text-neutral-500">{{ $application->created_at->format('M d, Y') }}
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
