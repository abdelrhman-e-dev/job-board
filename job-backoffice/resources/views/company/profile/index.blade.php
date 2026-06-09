@extends('company.layouts.app')
@section('title', 'Profile')
@section('content')
    <!-- Profile Completion Banner -->
    <x-company.profile.completion-banner :missing="$missingData" :percentage="$missingPercentage" />
    <!-- Section 1: Logo & Banner -->
    <section class="bg-white rounded-xl shadow-md overflow-hidden mb-lg group">
        <livewire:company.profile.upload-banner />
        <div class="px-lg pb-lg relative">
            <livewire:company.profile.upload-logo />
            <div class="mt-md flex justify-between items-end">
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface">Shaghalni</h2>
                    <p class="text-body-md text-on-surface-variant">Technology &amp; Recruitment Suite</p>
                </div>
                <button
                    class="border border-neutral-300 text-on-surface-variant px-lg py-sm rounded-lg font-label-md hover:bg-neutral-100 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined">settings</span> Manage Visuals
                </button>
            </div>
        </div>
    </section>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
        <!-- Section 2: Basic Info -->
        <livewire:company.profile.basic-information />
        <!-- Sidebar Sections -->
        <div class="lg:col-span-4 space-y-lg">
            <!-- Section 3: Location -->
            <section class="bg-white rounded-xl shadow-md p-lg">
                <h3 class="font-title-md text-title-md flex items-center gap-2 mb-lg">
                    <span class="material-symbols-outlined text-primary">location_on</span> Location
                </h3>
                <div class="space-y-md">
                    <div class="space-y-2">
                        <label class="font-label-sm text-on-surface-variant">Address</label>
                        <input
                            class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                            placeholder="123 Business Way" type="text" />
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-sm text-on-surface-variant">City</label>
                        <input
                            class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                            placeholder="Dubai" type="text" />
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-sm text-on-surface-variant">Country</label>
                        <input
                            class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                            placeholder="United Arab Emirates" type="text" />
                    </div>
                    <div class="pt-2">
                        <button
                            class="w-full border border-primary text-primary px-lg py-2 rounded-lg font-label-md hover:bg-primary-light transition-colors">
                            Save Location
                        </button>
                    </div>
                </div>
            </section>
            <!-- Section 4: Contact Info -->
            <section class="bg-white rounded-xl shadow-md p-lg">
                <h3 class="font-title-md text-title-md flex items-center gap-2 mb-lg">
                    <span class="material-symbols-outlined text-primary">contact_mail</span> Contact Info
                </h3>
                <div class="space-y-md">
                    <div class="space-y-2">
                        <label class="font-label-sm text-on-surface-variant">Contact Phone</label>
                        <input
                            class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                            placeholder="+971 00 000 0000" type="tel" />
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-sm text-on-surface-variant">Contact Email</label>
                        <input
                            class="w-full rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                            placeholder="hr@shaghalni.com" type="email" />
                    </div>
                </div>
            </section>
            <!-- Section 5: Social Links -->
            <section class="bg-white rounded-xl shadow-md p-lg">
                <h3 class="font-title-md text-title-md flex items-center gap-2 mb-lg">
                    <span class="material-symbols-outlined text-primary">share</span> Social Links
                </h3>
                <div class="space-y-md">
                    <div class="space-y-2">
                        <label class="font-label-sm text-on-surface-variant">LinkedIn URL</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">link</span>
                            <input
                                class="w-full pl-10 rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                                placeholder="linkedin.com/company/..." type="url" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-sm text-on-surface-variant">Facebook URL</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">social_leaderboard</span>
                            <input
                                class="w-full pl-10 rounded-lg border-neutral-300 focus:border-primary focus:ring-1 focus:ring-primary transition-all p-2.5 font-body-md outline-none"
                                placeholder="facebook.com/shaghalni" type="url" />
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
