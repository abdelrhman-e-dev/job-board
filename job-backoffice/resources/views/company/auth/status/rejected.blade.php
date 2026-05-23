@extends('company.layouts.auth')
@section('title', 'Rejected Account')
@section('content')
    <div dir="rtl" class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
        <div class="sm:mx-auto sm:w-full sm:max-w-[440px]">
            <!-- Card -->
            <div class="bg-white py-10 px-6 shadow-sm sm:rounded-xl sm:px-8 border border-neutral-300 text-center relative">
                <!-- Icon Container -->
                <div class="mb-6 flex justify-center">
                    <div class="w-16 h-16 bg-danger-light rounded-full flex items-center justify-center">
                        <svg class="w-[39px] h-[39px] text-danger" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Content Header -->
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mb-4" dir="ltr">
                    Account Not Approved
                </h1>

                <!-- Message Body -->
                <p class="text-sm text-neutral-500 mb-2 leading-relaxed" dir="ltr">
                    Thank you for your interest in joining <strong> {{ config('app.name') }}</strong>. After
                    reviewing your application, our team has determined
                    that we cannot approve your registration at this time.
                </p>
                <p class="text-sm text-neutral-500 mb-4 leading-relaxed" dir="ltr">
                    This decision may be due to incomplete documentation,
                    mismatched professional criteria, or geographical
                    restrictions currently in place for our platform.
                </p>

                {{-- card footer --}}
                <div class="mt-8">
                    <p class="mt-md text-small-text font-small-text text-neutral-500">
                        Need help? <a class="text-primary hover:underline font-medium" href="#">Contact Support</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
