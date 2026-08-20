@extends('company.layouts.app')
@section('title', 'Jobs')
@section('content')

  <!-- Page Header -->
  <div class="flex flex-col md:flex-row md:items-end justify-between mb-xl gap-md">
    {{-- Breadcrumb --}}
    <nav class="flex" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
          <a href="{{ route('company.dashboard') }}"
            class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
            <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
            </svg>
            Home
          </a>
        </li>
        <li>
          <div class="flex items-center space-x-1.5">
            <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m9 5 7 7-7 7" />
            </svg>
            <p class="inline-flex items-center text-sm font-medium text-neutral-500 hover:text-fg-brand">
              Jobs
            </p>
          </div>
        </li>
      </ol>
    </nav>
    {{-- export button --}}
    <div class="flex gap-sm">
      <button
        class="flex items-center gap-xs px-md py-sm border border-neutral-300 rounded-lg font-label-md text-label-md text-on-surface hover:bg-neutral-100 transition-all">
        <span class="material-symbols-outlined text-[20px]">download</span>
        Export PDF
      </button>
    </div>
  </div>
  <!-- Analysis Cards (Stat Cards) -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg mb-xl">
    <!-- Total Jobs -->
    <div class="bg-white p-lg rounded-xl shadow-md border border-neutral-300 flex items-start justify-between">
      <div>
        <p class="text-label-md text-neutral-500 mb-xs">Total Jobs Posted</p>
        <h3 class="text-headline-lg font-bold text-on-surface">42</h3>
        <p class="text-label-sm text-success mt-sm flex items-center gap-xs">
          <span class="material-symbols-outlined text-[16px]">trending_up</span>
          +12% vs last month
        </p>
      </div>
      <div class="w-12 h-12 rounded-lg bg-primary-light flex items-center justify-center text-primary">
        <span class="material-symbols-outlined">work</span>
      </div>
    </div>
    <!-- Active Listings -->
    <div class="bg-white p-lg rounded-xl shadow-md border border-neutral-300 flex items-start justify-between">
      <div>
        <p class="text-label-md text-neutral-500 mb-xs">Active Listings</p>
        <h3 class="text-headline-lg font-bold text-on-surface">18</h3>
        <p class="text-label-sm text-neutral-500 mt-sm">Currently accepting applicants</p>
      </div>
      <div class="w-12 h-12 rounded-lg bg-success-light flex items-center justify-center text-success">
        <span class="material-symbols-outlined">check_circle</span>
      </div>
    </div>
    <!-- Draft Listings -->
    <div class="bg-white p-lg rounded-xl shadow-md border border-neutral-300 flex items-start justify-between">
      <div>
        <p class="text-label-md text-neutral-500 mb-xs">Draft Listings</p>
        <h3 class="text-headline-lg font-bold text-on-surface">5</h3>
        <p class="text-label-sm text-warning mt-sm flex items-center gap-xs">
          <span class="material-symbols-outlined text-[16px]">info</span>
          Pending review
        </p>
      </div>
      <div class="w-12 h-12 rounded-lg bg-warning-light flex items-center justify-center text-warning">
        <span class="material-symbols-outlined">edit_note</span>
      </div>
    </div>
    <!-- Closed Listings -->
    <div class="bg-white p-lg rounded-xl shadow-md border border-neutral-300 flex items-start justify-between">
      <div>
        <p class="text-label-md text-neutral-500 mb-xs">Closed Listings</p>
        <h3 class="text-headline-lg font-bold text-on-surface">19</h3>
        <p class="text-label-sm text-neutral-500 mt-sm">Archived historical data</p>
      </div>
      <div class="w-12 h-12 rounded-lg bg-danger-light flex items-center justify-center text-danger">
        <span class="material-symbols-outlined">block</span>
      </div>
    </div>
  </div>
  <!-- Main Listing Section -->
  <div class="bg-white rounded-xl shadow-md border border-neutral-300 overflow-hidden">
    <!-- Search & Filter Bar -->
    <div class="p-lg border-b border-neutral-300 flex flex-col md:flex-row gap-md items-center justify-between">
      <div class="flex flex-1 gap-md w-full">
        <div class="relative flex-1">
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-neutral-500">search</span>
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
            <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Job Title</th>
            <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Department
            </th>
            <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Status</th>
            <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Applications
            </th>
            <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider">Posted Date
            </th>
            <th class="px-lg py-md text-label-sm font-bold text-neutral-700 uppercase tracking-wider text-right">
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
              <span class="px-3 py-1 rounded-full bg-success-light text-success text-label-sm font-medium">Active</span>
            </td>
            <td class="px-lg py-lg">
              <div class="flex items-center gap-sm">
                <span class="font-title-md text-title-md">48</span>
                <span class="text-label-sm text-success">(+5 new)</span>
              </div>
            </td>
            <td class="px-lg py-lg text-body-md text-on-surface">Oct 24, 2023</td>
            <td class="px-lg py-lg text-right">
              <div class="flex items-center justify-end gap-xs opacity-0 group-hover:opacity-100 transition-opacity">
                <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary" title="Edit"><span
                    class="material-symbols-outlined">edit</span></button>
                <button class="p-2 hover:bg-neutral-100 rounded-full text-primary" title="View Applications"><span
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
              <span class="px-3 py-1 rounded-full bg-warning-light text-warning text-label-sm font-medium">Draft</span>
            </td>
            <td class="px-lg py-lg text-body-md text-neutral-500">—</td>
            <td class="px-lg py-lg text-body-md text-on-surface">Pending</td>
            <td class="px-lg py-lg text-right">
              <div class="flex items-center justify-end gap-xs opacity-0 group-hover:opacity-100 transition-opacity">
                <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary" title="Edit"><span
                    class="material-symbols-outlined">edit</span></button>
                <button class="p-2 hover:bg-neutral-100 rounded-full text-primary" title="View Applications"><span
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
              <span class="px-3 py-1 rounded-full bg-neutral-100 text-neutral-500 text-label-sm font-medium">Closed</span>
            </td>
            <td class="px-lg py-lg text-body-md text-on-surface">122</td>
            <td class="px-lg py-lg text-body-md text-on-surface">Sep 15, 2023</td>
            <td class="px-lg py-lg text-right">
              <div class="flex items-center justify-end gap-xs opacity-0 group-hover:opacity-100 transition-opacity">
                <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary" title="Edit"><span
                    class="material-symbols-outlined">edit</span></button>
                <button class="p-2 hover:bg-neutral-100 rounded-full text-primary" title="View Applications"><span
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
              <span class="px-3 py-1 rounded-full bg-success-light text-success text-label-sm font-medium">Active</span>
            </td>
            <td class="px-lg py-lg text-body-md text-on-surface">12</td>
            <td class="px-lg py-lg text-body-md text-on-surface">Oct 28, 2023</td>
            <td class="px-lg py-lg text-right">
              <div class="flex items-center justify-end gap-xs opacity-0 group-hover:opacity-100 transition-opacity">
                <button class="p-2 hover:bg-neutral-100 rounded-full text-secondary" title="Edit"><span
                    class="material-symbols-outlined">edit</span></button>
                <button class="p-2 hover:bg-neutral-100 rounded-full text-primary" title="View Applications"><span
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
        <button class="p-2 border border-neutral-300 rounded-lg hover:bg-neutral-100 disabled:opacity-50" disabled="">
          <span class="material-symbols-outlined">chevron_left</span>
        </button>
        <button class="px-4 py-2 bg-primary text-white rounded-lg text-label-md font-bold">1</button>
        <button class="px-4 py-2 border border-neutral-300 rounded-lg text-label-md hover:bg-neutral-100">2</button>
        <button class="px-4 py-2 border border-neutral-300 rounded-lg text-label-md hover:bg-neutral-100">3</button>
        <button class="p-2 border border-neutral-300 rounded-lg hover:bg-neutral-100">
          <span class="material-symbols-outlined">chevron_right</span>
        </button>
      </div>
    </div>
  </div>

@endsection