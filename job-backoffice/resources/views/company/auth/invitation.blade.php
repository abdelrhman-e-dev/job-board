@extends('company.layouts.auth')
@section('title', 'Invitation')
@section('content')
    <div dir="ltr" class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
        <div class="sm:mx-auto sm:w-full sm:max-w-[440px] flex justify-center items-center flex-col">
            <!-- Brand Identifier (Logo) -->
            <div class="mb-xl flex flex-col items-center gap-1">
                <div class="flex items-center gap-sm">
                    <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">work</span>
                    </div>
                    <span class="font-page-title text-[22px] font-bold text-on-surface">Shaghalni</span>
                </div>
                <span class="text-[11px] tracking-[0.15em] font-medium text-neutral-500 uppercase">Recruitment Suite</span>
            </div>
            @session('success')
                <div class="flex items-start sm:items-center p-4 mb-4 text-sm text-success rounded-lg bg-success-light"
                    role="alert">
                    <svg class="w-4 h-4 me-2 shrink-0 mt-0.5 sm:mt-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            @endsession
            @session('error')
                <div class="flex items-start sm:items-center p-4 mb-4 text-sm text-danger rounded-lg bg-danger-light"
                    role="alert">
                    <svg class="w-4 h-4 me-2 shrink-0 mt-0.5 sm:mt-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p>{{ session('error') }}</p>
                </div>
            @endsession
            <!-- Auth Card Container -->
            <div class="auth-card w-full bg-surface-container-lowest border border-neutral-300 rounded-xl p-lg md:p-xl">
                @if(isset($exceptionError))
                    <!-- Error State -->
                    <div class="text-center flex flex-col items-center py-md">
                        <div class="w-16 h-16 bg-danger-light text-danger rounded-full flex items-center justify-center mb-md">
                            <span class="material-symbols-outlined text-[32px]">error</span>
                        </div>
                        <h1 class="font-page-title text-[20px] font-bold text-on-surface mb-xs">Invalid Link</h1>
                        <p class="font-body-text text-[14px] text-danger mb-lg">
                            {{ $exceptionError }}
                        </p>
                        <a href="{{ route('company.login') }}" class="w-full h-[40px] bg-primary hover:bg-primary-dark text-on-primary font-button-text text-[14px] font-medium rounded-lg transition-all-custom active:scale-[0.98] flex items-center justify-center gap-sm">
                            Return to Login
                        </a>
                    </div>
                @else
                    <!-- Header Section -->
                    <div class="mb-xl text-center flex flex-col items-center">
                        <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-md">
                            <span class="material-symbols-outlined text-[32px]">person_add</span>
                        </div>
                        <h1 class="font-page-title text-[20px] font-bold text-on-surface mb-xs">You've been invited</h1>
                        <p class="font-body-text text-[14px] text-neutral-500">
                            Set your password to join Shaghalni
                        </p>
                    </div>
                    <!-- Form Section -->
                    <form class="space-y-md" action="{{ route('company.invitation.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-md">
                            <div class="flex flex-col gap-xs">
                                <label class="font-label-text text-[13px] font-medium text-on-surface" for="first_name">First Name</label>
                                <input class="h-[40px] px-md font-body-text text-body-text border border-neutral-200 bg-neutral-50 rounded-lg outline-none cursor-not-allowed text-neutral-500"
                                    id="first_name" name="first_name" type="text" value="{{ $user->first_name ?? '' }}" readonly>
                            </div>
                            <div class="flex flex-col gap-xs">
                                <label class="font-label-text text-[13px] font-medium text-on-surface" for="last_name">Last Name</label>
                                <input class="h-[40px] px-md font-body-text text-body-text border border-neutral-200 bg-neutral-50 rounded-lg outline-none cursor-not-allowed text-neutral-500"
                                    id="last_name" name="last_name" type="text" value="{{ $user->last_name ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="flex flex-col gap-xs">
                            <label class="font-label-text text-[13px] font-medium text-on-surface" for="email">Email Address</label>
                            <input class="h-[40px] px-md font-body-text text-body-text border border-neutral-200 bg-neutral-50 rounded-lg outline-none cursor-not-allowed text-neutral-500"
                                id="email" name="email" type="email" value="{{ $user->email ?? '' }}" readonly>
                        </div>

                        <div class="flex flex-col gap-xs">
                            <label class="font-label-text text-[13px] font-medium text-on-surface" for="password">New Password</label>
                            <input class="h-[40px] px-md font-body-text text-body-text border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all-custom placeholder:text-neutral-400 @error('password') border-red-500 @enderror"
                                id="password" name="password" type="password" placeholder="Min. 8 characters" required>
                            @error('password')
                                <p class="text-red-500 text-[12px]">{{ $message }}</p>
                            @else
                                <p class="text-[12px] text-neutral-400">At least 8 characters</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-xs">
                            <label class="font-label-text text-[13px] font-medium text-on-surface" for="password_confirmation">Confirm Password</label>
                            <input class="h-[40px] px-md font-body-text text-body-text border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all-custom placeholder:text-neutral-400"
                                id="password_confirmation" name="password_confirmation" type="password" placeholder="Re-enter your password" required>
                        </div>

                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        <input type="hidden" name="user_id" value="{{ request()->route('id') }}">

                        <button class="w-full h-[40px] mt-md bg-primary hover:bg-primary-dark text-on-primary font-button-text text-[14px] font-medium rounded-lg transition-all-custom active:scale-[0.98] flex items-center justify-center gap-sm"
                            type="submit">
                            Set Password & Join
                        </button>
                    </form>
                @endif
            </div>
            
            <!-- Footer Navigation -->
            <div class="mt-lg">
                <p class="font-body-text text-[14px] text-neutral-500">Need help? <a href="#" class="font-button-text text-primary hover:underline font-medium">Contact Support</a></p>
            </div>
        </div>
    </div>
@endsection
