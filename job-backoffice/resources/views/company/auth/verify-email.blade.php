@extends('company.layouts.auth')
@section('title' , 'Verify Your Email')
@section('content')
<div dir="rtl" class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
    <div class="sm:mx-auto sm:w-full sm:max-w-[440px]">
        <!-- Card -->
        <div class="bg-white py-10 px-6 shadow-sm sm:rounded-xl sm:px-8 border border-neutral-300 text-center relative">
            
            @if (session('success-resend'))
                <x-toast-success :message="session('success-resend')" />
            @endif

            <!-- Icon Container -->
            <div class="mb-6 flex justify-center">
                <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </div>
            </div>

            <!-- Content Header -->
            <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mb-4" dir="ltr">
                Verify your email
            </h1>
            
            <!-- Message Body -->
            <p class="text-sm text-neutral-500 mb-8 leading-relaxed" dir="ltr">
                We've sent a verification link to your email address. Please check your inbox and click the link to verify your account and access your dashboard.
            </p>

            <!-- Actions Container -->
            <div class="space-y-4" dir="ltr">
                <!-- Primary Action (Resend) -->
                <form action="{{ route('company.verification.resend') }}" method="POST">
                    @csrf
                    <button  type="submit" class="w-full flex justify-center items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Resend link
                    </button>
                </form>

                <!-- Secondary Context Link -->
                <div class="pt-4 border-t border-neutral-100 pb-2">
                    <p class="text-xs text-neutral-500">
                        Didn't receive the email? Check your spam folder or 
                        <a href="{{ route('company.register') }}" class="font-medium text-primary hover:underline">try another email</a>.
                    </p>
                </div>
            </div>
            
            <!-- Footer Return Link -->
            <div class="mt-8">
                <a href="{{ route('company.login') }}" class="inline-flex items-center gap-1 text-sm font-medium text-neutral-500 hover:text-primary transition-colors" dir="ltr">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Return to Sign In
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
