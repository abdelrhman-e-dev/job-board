@extends('company.layouts.app')
@section('title', 'Jobs')
@section('content')

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-xl gap-md">
        {{-- Breadcrumb --}}
        {{ Breadcrumbs::render('company.jobs') }}
        {{-- export button --}}
    </div>
    <!-- Analysis Cards (Stat Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg mb-xl">
        <!-- Total Jobs -->
        <x-company.jobs.jobs-stat-card label="Total Jobs" :value="$stats['total_jobs']" icon="work" color="primary"
            description="Total Pasted Jobs" />
        <!-- Active Listings -->
        <x-company.jobs.jobs-stat-card label="Active Listings" :value="$stats['active_jobs']" icon="check_circle" color="success"
            description="Currently accepting applicants" />
        <!-- Draft Listings -->
        <x-company.jobs.jobs-stat-card label="Draft Listings" :value="$stats['draft_jobs']" icon="info" color="warning"
            description="Not Published yet" />
        <!-- Closed Listings -->
        <x-company.jobs.jobs-stat-card label="Closed Listings" :value="$stats['closed_jobs']" icon="block" color="danger"
            description="Archived historical data" />
    </div>
    <!-- Main Listing Section -->
    <div class="bg-white rounded-xl shadow-md border border-neutral-300 overflow-hidden">
        <!-- Search & Filter Bar -->
        <div class="p-lg border-b border-neutral-300 flex flex-col md:flex-row gap-md items-center justify-between">
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
        </div>
        <!-- Jobs Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-neutral-100">
                    <tr>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Job Title
                        </th>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Department
                        </th>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Status
                        </th>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">
                            Applications
                        </th>
                        <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Posted
                            Date
                        </th>
                        <th
                            class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-300">
                    <!-- Row 1 -->
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-lg py-lg">
                            <div class="flex flex-col">
                                <span class="font-title-md text-title-md text-on-surface">Senior Frontend Developer</span>
                                <span class="text-label-sm text-neutral-500 mt-1">ID: #SHG-10293</span>
                            </div>
                        </td>
                        <td class="px-lg py-lg text-body-md text-on-surface">Engineering</td>
                        <td class="px-lg py-lg">
                            <span
                                class="px-3 py-1 rounded-full bg-success-light text-success text-label-sm font-medium">Active</span>
                        </td>
                        <td class="px-lg py-lg">
                            <div class="flex items-center gap-sm">
                                <span class="font-title-md text-title-md">48</span>
                                <span class="text-label-sm text-success">(+5 new)</span>
                            </div>
                        </td>
                        <td class="px-lg py-lg text-body-md text-on-surface">Oct 24, 2023</td>
                        <td class="px-lg py-lg text-right">
                            <div
                                class="flex items-center justify-end gap-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary" title="Edit"><span
                                        class="material-symbols-outlined">edit</span></button>
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-primary"
                                    title="View Applications"><span
                                        class="material-symbols-outlined">visibility</span></button>
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-danger" title="Close"><span
                                        class="material-symbols-outlined">block</span></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-lg py-lg">
                            <div class="flex flex-col">
                                <span class="font-title-md text-title-md text-on-surface">Marketing Strategist</span>
                                <span class="text-label-sm text-neutral-500 mt-1">ID: #SHG-10294</span>
                            </div>
                        </td>
                        <td class="px-lg py-lg text-body-md text-on-surface">Marketing</td>
                        <td class="px-lg py-lg">
                            <span
                                class="px-3 py-1 rounded-full bg-warning-light text-warning text-label-sm font-medium">Draft</span>
                        </td>
                        <td class="px-lg py-lg text-body-md text-neutral-500">—</td>
                        <td class="px-lg py-lg text-body-md text-on-surface">Pending</td>
                        <td class="px-lg py-lg text-right">
                            <div
                                class="flex items-center justify-end gap-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary" title="Edit"><span
                                        class="material-symbols-outlined">edit</span></button>
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-primary"
                                    title="View Applications"><span
                                        class="material-symbols-outlined">visibility</span></button>
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-danger" title="Close"><span
                                        class="material-symbols-outlined">block</span></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-lg py-lg">
                            <div class="flex flex-col">
                                <span class="font-title-md text-title-md text-on-surface">HR Specialist</span>
                                <span class="text-label-sm text-neutral-500 mt-1">ID: #SHG-10280</span>
                            </div>
                        </td>
                        <td class="px-lg py-lg text-body-md text-on-surface">Operations</td>
                        <td class="px-lg py-lg">
                            <span
                                class="px-3 py-1 rounded-full bg-neutral-100 text-neutral-500 text-label-sm font-medium">Closed</span>
                        </td>
                        <td class="px-lg py-lg text-body-md text-on-surface">122</td>
                        <td class="px-lg py-lg text-body-md text-on-surface">Sep 15, 2023</td>
                        <td class="px-lg py-lg text-right">
                            <div
                                class="flex items-center justify-end gap-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary" title="Edit"><span
                                        class="material-symbols-outlined">edit</span></button>
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-primary"
                                    title="View Applications"><span
                                        class="material-symbols-outlined">visibility</span></button>
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-success" title="Re-open"><span
                                        class="material-symbols-outlined">refresh</span></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-lg py-lg">
                            <div class="flex flex-col">
                                <span class="font-title-md text-title-md text-on-surface">UX Designer</span>
                                <span class="text-label-sm text-neutral-500 mt-1">ID: #SHG-10302</span>
                            </div>
                        </td>
                        <td class="px-lg py-lg text-body-md text-on-surface">Product</td>
                        <td class="px-lg py-lg">
                            <span
                                class="px-3 py-1 rounded-full bg-success-light text-success text-label-sm font-medium">Active</span>
                        </td>
                        <td class="px-lg py-lg text-body-md text-on-surface">12</td>
                        <td class="px-lg py-lg text-body-md text-on-surface">Oct 28, 2023</td>
                        <td class="px-lg py-lg text-right">
                            <div
                                class="flex items-center justify-end gap-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary" title="Edit"><span
                                        class="material-symbols-outlined">edit</span></button>
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-primary"
                                    title="View Applications"><span
                                        class="material-symbols-outlined">visibility</span></button>
                                <button class="p-2 hover:bg-neutral-100 rounded-full text-danger" title="Close"><span
                                        class="material-symbols-outlined">block</span></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-lg py-md border-t border-neutral-300 flex items-center justify-between">
            <p class="text-label-sm text-neutral-500">Showing 1 to 10 of 42 results</p>
            <div class="flex gap-xs">
                <button class="p-2 border border-neutral-300 rounded-lg hover:bg-neutral-100 disabled:opacity-50"
                    disabled="">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="px-4 py-2 bg-primary text-white rounded-lg text-label-md font-bold">1</button>
                <button
                    class="px-4 py-2 border border-neutral-300 rounded-lg text-label-md hover:bg-neutral-100">2</button>
                <button
                    class="px-4 py-2 border border-neutral-300 rounded-lg text-label-md hover:bg-neutral-100">3</button>
                <button class="p-2 border border-neutral-300 rounded-lg hover:bg-neutral-100">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </div>

@endsection
