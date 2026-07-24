@extends('company.layouts.app')
@section('title', 'Member')
@section('content')
    {{-- {{ dd($data['member']) }} --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-lg gap-md">
        {{-- Breadcrumb --}}
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('company.dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
                        <span class="material-symbols-outlined">
                            home
                        </span>
                        Home
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <a href="{{ route('company.team') }}"
                        class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
                        <span class="material-symbols-outlined">
                            chevron_right
                        </span>
                        Team
                    </a>
                </li>
                <li>
                    <div class="flex items-center space-x-1.5">
                        <span class="material-symbols-outlined">
                            chevron_right
                        </span>
                        <p class="inline-flex items-center text-sm font-medium text-neutral-500 hover:text-fg-brand">
                            {{ $data['member']['first_name'] }} {{ $data['member']['last_name'] }}
                        </p>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class=" rounded-xl custom-shadow   overflow-visible h-full flex flex-col w-full">
        <div class="overflow-visible flex-1 h-full">
            <!-- Profile Header Section -->
            <section
                class="bg-white rounded-xl p-lg shadow-md mb-lg flex flex-col md:flex-row md:items-center justify-between gap-lg">
                <div class="flex items-center gap-lg">
                    <div
                        class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center text-[32px] font-bold border-4 border-primary-light">
                        {{ $data['member']['first_name'][0] }} {{ $data['member']['last_name'][0] }}
                    </div>
                    <div>
                        <div class="flex items-center gap-sm mb-xs">
                            <h2 class="font-headline-lg text-headline-lg">{{ $data['member']['first_name'] }}
                                {{ $data['member']['last_name'] }}
                            </h2>
                            <span
                                class="bg-info text-white text-[11px] font-bold px-sm py-[2px] rounded-full uppercase tracking-wider">
                                {{ $data['member']['role']['role_name'] }}
                            </span>
                            <span
                                class=" {{ $data['member']['status'] == 'active' ? 'bg-success-light text-success' : 'bg-danger-light text-danger' }} text-[11px] font-bold px-sm py-[2px] rounded-full uppercase tracking-wider">
                                {{ $data['member']['status'] }}
                            </span>
                        </div>
                        <div class="flex items-center gap-md text-neutral-500">
                            <div class="flex items-center gap-xs">
                                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                <span
                                    class="font-body-md text-body-md">{{ $data['member']['joined_at']->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-xs">
                                <span class="material-symbols-outlined text-[18px]">alternate_email</span>
                                <span class="font-body-md text-body-md">{{ $data['member']['email'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-sm">
                    <button
                        class="px-lg py-[10px] border border-neutral-300 text-neutral-700 font-label-md text-label-md rounded-lg hover:bg-neutral-100 transition-colors active:scale-95">
                        Edit Permissions
                    </button>
                    <button
                        class="px-lg py-[10px] text-danger font-label-md text-label-md rounded-lg hover:bg-danger-light transition-colors active:scale-95">
                        Deactivate
                    </button>
                </div>
            </section>
            <!-- Content Grid (Bento Style) -->
            <div class="grid grid-cols-12 gap-lg">

                <!-- Left Column (Main Info) -->
                <div class="col-span-12 lg:col-span-8 space-y-lg">

                    <!-- Personal Information Card -->
                    <div class="bg-white rounded-xl p-lg shadow-md">
                        <div class="flex items-center gap-sm mb-lg border-b border-neutral-100 pb-md">
                            <span class="material-symbols-outlined text-primary">person</span>
                            <h3 class="font-title-md text-title-md">Personal Information</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-y-lg gap-x-lg">
                            <div>
                                <p class="text-label-sm text-neutral-500 mb-xs uppercase tracking-tighter font-bold">
                                    Full Name</p>
                                <p class="text-body-md font-medium text-neutral-900">{{ $data['member']['first_name'] }}
                                    {{ $data['member']['last_name'] }}</p>
                            </div>
                            <div>
                                <p class="text-label-sm text-neutral-500 mb-xs uppercase tracking-tighter font-bold">
                                    Work Email</p>
                                <p class="text-body-md font-medium text-neutral-900">{{ $data['member']['email'] }}</p>
                            </div>
                            <div>
                                <p class="text-label-sm text-neutral-500 mb-xs uppercase tracking-tighter font-bold">
                                    Phone Number</p>
                                <p class="text-body-md font-medium text-neutral-900">
                                    {{ $data['member']['phone'] ?? '---' }}</p>
                            </div>
                            <div>
                                <p class="text-label-sm text-neutral-500 mb-xs uppercase tracking-tighter font-bold">
                                    Timezone</p>
                                <p class="text-body-md font-medium text-neutral-900">
                                    {{ $data['member']['timezone'] ?? '---' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-label-sm text-neutral-500 mb-xs uppercase tracking-tighter font-bold">Bio
                                </p>
                                <p class="text-body-md text-neutral-700 leading-relaxed">
                                    {{ $data['member']['bio'] ?? '---' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Active Workload Card -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div
                            class="p-lg border-b border-neutral-100 flex justify-between items-center bg-surface-container-low">
                            <div class="flex items-center gap-sm">
                                <span class="material-symbols-outlined text-primary"
                                    style="font-variation-settings: 'FILL' 1;">assignment</span>
                                <h3 class="font-title-md text-title-md">Active Workload</h3>
                            </div>
                            <button class="text-primary font-label-md text-label-md hover:underline">View All</button>
                        </div>

                        <!-- Stats Mini Grid -->
                        <div class="grid grid-cols-3 border-b border-neutral-100">
                            <div class="p-lg text-center border-r border-neutral-100">
                                <p class="text-headline-md font-bold text-primary">{{ $data['stats']['active_jobs'] }}</p>
                                <p class="text-label-sm text-neutral-500">Active Jobs</p>
                            </div>
                            <div class="p-lg text-center border-r border-neutral-100">
                                <p class="text-headline-md font-bold text-warning">{{ $data['stats']['applications'] }}</p>
                                <p class="text-label-sm text-neutral-500">Pending Apps</p>
                            </div>
                            <div class="p-lg text-center">
                                <p class="text-headline-md font-bold text-success">{{ $data['stats']['interviews'] }}</p>
                                <p class="text-label-sm text-neutral-500">Interviews</p>
                            </div>
                        </div>

                        <!-- Jobs List -->
                        <div class="p-lg space-y-md">
                          {{-- {{ dd($data['latestJobs']) }} --}}
                          @foreach ($data['latestJobs'] as $job)
                            <div
                                class="flex items-center justify-between p-md border border-neutral-100 rounded-lg hover:bg-neutral-50 transition-colors group">
                                <div class="flex items-center gap-md">
                                    <div>
                                        <p class="font-label-md text-label-md text-neutral-900">
                                      {{ $job['title'] }}
                                        </p>
                                        <p class="text-label-sm text-neutral-500">{{ $job['level'] }} • {{ $job['type'] }}</p>
                                    </div>
                                </div>
                                <x-company.status-badge :status="$job['status']" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column (Sidebar Info) -->
                <div class="col-span-12 lg:col-span-4 space-y-lg">

                    <!-- Account Security Card -->
                    <div class="bg-white rounded-xl p-lg shadow-md">
                        <div class="flex items-center gap-sm mb-lg border-b border-neutral-100 pb-md">
                            <span class="material-symbols-outlined text-primary">security</span>
                            <h3 class="font-title-md text-title-md">Account Security</h3>
                        </div>
                        <div class="space-y-lg">
                            <div>
                                <p class="text-label-sm text-neutral-500 mb-xs uppercase tracking-tighter font-bold">
                                    Last Login</p>
                                <div class="flex items-center gap-sm">
                                    <p class="text-body-md font-medium text-neutral-900">Today, 2:14 PM</p>
                                    <span class="text-label-sm text-neutral-500">(2 hours ago)</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-label-sm text-neutral-500 mb-xs uppercase tracking-tighter font-bold">
                                    Permissions Level</p>
                                <p class="text-body-md font-medium text-neutral-900">Standard Manager</p>
                            </div>

                        </div>
                    </div>

                    <!-- Activity Log Card -->
                    <div class="bg-white rounded-xl p-lg shadow-md">
                        <div class="flex items-center justify-between mb-lg border-b border-neutral-100 pb-md">
                            <div class="flex items-center gap-sm">
                                <span class="material-symbols-outlined text-primary">history</span>
                                <h3 class="font-title-md text-title-md">Activity Log</h3>
                            </div>
                        </div>
                        <div
                            class="space-y-lg relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[2px] before:bg-neutral-100">

                            <div class="relative pl-lg">
                                <div
                                    class="absolute left-0 top-1 w-[24px] h-[24px] rounded-full bg-primary-light flex items-center justify-center z-10">
                                    <span class="material-symbols-outlined text-primary text-xs"
                                        style="font-size: 14px;">add</span>
                                </div>
                                <p class="text-body-md text-neutral-900 leading-tight">Posted a new job: <span
                                        class="font-bold">Senior Backend Engineer</span></p>
                                <p class="text-label-sm text-neutral-500">1 hour ago</p>
                            </div>

                            <div class="relative pl-lg">
                                <div
                                    class="absolute left-0 top-1 w-[24px] h-[24px] rounded-full bg-success-light flex items-center justify-center z-10">
                                    <span class="material-symbols-outlined text-success text-xs"
                                        style="font-size: 14px;">check</span>
                                </div>
                                <p class="text-body-md text-neutral-900 leading-tight">Moved candidate <span
                                        class="font-bold">Julia Roberts</span> to Interview phase</p>
                                <p class="text-label-sm text-neutral-500">3 hours ago</p>
                            </div>

                            <div class="relative pl-lg">
                                <div
                                    class="absolute left-0 top-1 w-[24px] h-[24px] rounded-full bg-neutral-100 flex items-center justify-center z-10">
                                    <span class="material-symbols-outlined text-neutral-500 text-xs"
                                        style="font-size: 14px;">chat</span>
                                </div>
                                <p class="text-body-md text-neutral-900 leading-tight">Added internal note to <span
                                        class="font-bold">Alex Smith's</span> profile</p>
                                <p class="text-label-sm text-neutral-500">Yesterday at 5:30 PM</p>
                            </div>

                            <div class="relative pl-lg">
                                <div
                                    class="absolute left-0 top-1 w-[24px] h-[24px] rounded-full bg-primary-light flex items-center justify-center z-10">
                                    <span class="material-symbols-outlined text-primary text-xs"
                                        style="font-size: 14px;">settings</span>
                                </div>
                                <p class="text-body-md text-neutral-900 leading-tight">Updated availability schedule
                                    for next week</p>
                                <p class="text-label-sm text-neutral-500">Yesterday at 11:15 AM</p>
                            </div>

                            <button
                                class="w-full text-center py-xs text-label-md font-label-md text-primary hover:underline">
                                View Full History
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
