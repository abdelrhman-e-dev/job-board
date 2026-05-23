@extends('company.layouts.auth')
@section('title', 'Suspended Account')
@section('content')
    <div dir="rtl" class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
        <div class="sm:mx-auto sm:w-full sm:max-w-[440px]">
            <!-- Suspended Status Card -->
            <div
                class="bg-surface-container-lowest border border-neutral-300 rounded-xl shadow-md p-2xl text-center space-y-lg ">
                <!-- Ban Icon -->
                <div class="flex justify-center">
                    <div class="w-16 h-16 rounded-full bg-neutral-100 flex items-center justify-center animate-pulse">
                        <span class="material-symbols-outlined text-neutral-500 !text-[40px]" data-icon="block">block</span>
                    </div>
                </div>
                <!-- Title & Message -->
                <div class="space-y-sm">
                    <h1 class="text-page-title font-page-title text-on-surface">Account Suspended</h1>
                    <p class="text-body-text font-body-text text-neutral-500 leading-relaxed">
                        Your account has been suspended due to a violation of our <a class="text-primary hover:underline"
                            href="#">Community Guidelines</a>. This action
                        was taken to maintain the integrity and security of our professional marketplace.
                    </p>
                </div>
                <!-- Alert Details Box -->
                <div class="bg-surface-container border border-outline-variant p-md rounded-lg text-left">
                    <div class="flex items-start gap-sm">
                        <span class="material-symbols-outlined text-warning text-[20px]" data-icon="info">info</span>
                        <div>
                            <p class="text-small-text font-small-text text-on-surface-variant font-semibold">Violation
                                Type</p>
                            <p class="text-small-text font-small-text text-neutral-700">Multiple login attempts from
                                suspicious locations</p>
                        </div>
                    </div>
                </div>
                <!-- Actions -->
                <div class="space-y-md pt-md">
                    <div class="flex flex-col items-center gap-xs">
                        <span class="text-small-text font-small-text text-neutral-500">Need to appeal this
                            decision?</span>
                        <a class="text-primary hover:text-primary-dark text-button-text font-button-text font-bold flex items-center gap-xs group"
                            href="#">
                            Contact Support
                            <span
                                class="material-symbols-outlined text-[16px] transition-transform group-hover:translate-x-1"
                                data-icon="arrow_forward">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Contextual Help Link -->
            <p class="text-center mt-xl text-small-text font-small-text text-neutral-500">
                If you believe this is a mistake, please visit our
                <a class="text-primary hover:underline" href="#">Help Center</a>
                for more information.
            </p>
        </div>
    </div>
@endsection

