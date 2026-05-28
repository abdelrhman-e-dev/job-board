@extends('company.layouts.auth')
@section('title', 'Forgot Password')
@section('content')
    <div dir="ltr" class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
        <div class="sm:mx-auto sm:w-full sm:max-w-[440px] flex justify-center items-center flex-col">
            <!-- Brand Identifier (Logo) -->
            <div class="mb-xl flex items-center gap-sm">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white">
                    <span class="material-symbols-outlined" data-icon="work"
                        style="font-variation-settings: 'FILL' 1;">work</span>
                </div>
                <span class="font-page-title text-page-title font-bold text-on-surface">Shaghalni</span>
            </div>
            @session('success')
                <div class="flex items-start sm:items-center  p-4 mb-4 text-sm text-success rounded-lg bg-success-light"
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
                <!-- Header Section -->
                <div class="mb-xl">
                    <h1 class="font-page-title text-page-title text-on-surface mb-sm">Forgot Password?</h1>
                    <p class="font-body-text text-body-text text-neutral-500">
                        Enter your email address and we'll send you a link to reset your password.
                    </p>
                </div>
                <!-- Form Section -->
                <form class="space-y-lg" id="resetForm" action="{{ route('company.forget-password.store') }}"
                    method="POST">
                    @csrf
                    <div class="flex flex-col gap-xs">
                        <label class="font-label-text text-label-text text-on-surface" for="email">Email address</label>
                        <input
                            class="h-[40px] px-md font-body-text text-body-text border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all-custom placeholder:text-neutral-500
                            @error('email') border-red-500 @enderror"
                            id="email" name="email" placeholder="name@example.com" type="email" required
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        class="w-full h-[40px] bg-primary hover:bg-primary-dark text-on-primary font-button-text text-button-text rounded-lg transition-all-custom active:scale-[0.98] flex items-center justify-center gap-sm"
                        id="submitBtn" type="submit">
                        <span id="btnText" class="">Send Reset Link</span>
                        <span
                            class="hidden animate-spin h-5 w-5 border-2 border-on-primary border-t-transparent rounded-full"
                            id="spinner"></span>
                    </button>
                </form>
                <!-- Success State (Hidden by default) -->
                <div class="hidden flex flex-col items-center text-center py-md animate-in fade-in duration-500"
                    id="successState">
                    <div
                        class="w-12 h-12 bg-badge-approved-bg text-success rounded-full flex items-center justify-center mb-md">
                        <span class="material-symbols-outlined text-2xl" data-icon="check_circle"
                            style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    </div>
                    <p class="font-sub-heading text-sub-heading text-on-surface mb-xs">Check your email</p>
                    <p class="font-body-text text-body-text text-neutral-500">We have sent a password reset link to your
                        inbox.</p>
                    <button class="mt-lg font-button-text text-button-text text-primary hover:underline"
                        onclick="toggleStates()">Resend email</button>
                </div>
            </div>
            <!-- Footer Navigation -->
            <div class="mt-lg">
                <a class="flex items-center gap-xs font-button-text text-button-text text-neutral-500 hover:text-primary transition-all-custom group"
                    href="{{ route('company.login') }}">
                    <span class="material-symbols-outlined text-[18px] transition-transform group-hover:-translate-x-1"
                        data-icon="arrow_back">arrow_back</span>
                    Return to Sign In
                </a>
            </div>
        </div>
    </div>



@endsection
