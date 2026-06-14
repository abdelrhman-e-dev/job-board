@extends('company.layouts.app')
@section('title', 'Team')
@section('content')
    <div class="max-w-[1152px] mx-auto">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-lg gap-md">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
                            <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center space-x-1.5">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m9 5 7 7-7 7" />
                            </svg>
                            <p class="inline-flex items-center text-sm font-medium text-neutral-500 hover:text-fg-brand">
                                Team</co>
                        </div>
                    </li>
                </ol>
            </nav>
            <button
                class="flex items-center justify-center gap-sm bg-primary text-on-primary px-[20px] py-[10px] rounded-lg font-label-md text-label-md hover:bg-primary-dark transition-all active:scale-95 shadow-md">
                <span class="material-symbols-outlined">person_add</span>
                Invite Member
            </button>
        </div>
        <!-- Members Table Card -->
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
                        <!-- Row 1: Sarah Jenkins (Owner) -->
                        <tr class="hover:bg-surface-bright transition-colors">
                            <td class="px-md py-md">
                                <div class="flex items-center gap-md">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary font-title-md">
                                        SJ</div>
                                    <div>
                                        <span class="text-body-md font-semibold text-on-surface">Sarah
                                            Jenkins</span>
                                        <span class="ml-xs text-primary font-label-sm text-label-sm">(You)</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-md py-md text-body-md text-secondary">s.jenkins@shaghalni.com</td>
                            <td class="px-md py-md">
                                <span
                                    class=" bg-primary-light text-primary-container text-xs font-medium px-1.5 py-0.5 rounded">Owner</span>

                            </td>
                            <td class="px-md py-md">
                                <div class="flex items-center gap-xs">
                                    <span
                                        class="bg-success-light text-success text-xs font-medium px-1.5 py-0.5 rounded">Active</span>
                                </div>
                            </td>
                            <td class="px-md py-md text-secondary text-sm">Jan 12, 2024</td>
                            <td class="px-md py-md text-right text-secondary">
                                <button
                                    class="p-2 rounded-lg text-secondary hover:bg-neutral-100 disabled:opacity-50 transition-all">
                                    <span class="material-symbols-outlined">
                                        drag_indicator
                                    </span>
                                </button>
                            </td>
                        </tr>
                        <!-- Row 2: Marcus Aurelius -->

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
        <!-- Bento Info Section -->
    </div>
@endsection
