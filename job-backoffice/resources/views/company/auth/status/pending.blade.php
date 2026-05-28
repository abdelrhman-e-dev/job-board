@extends('company.layouts.auth')
@section('title', 'Account Under Review')
@section('content')
    <div dir="ltr" class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
        <div class="sm:mx-auto sm:w-full sm:max-w-[440px]">
            <!-- Card -->
            <div class="bg-white py-10 px-6 shadow-sm sm:rounded-xl sm:px-8 border border-neutral-300 text-center relative">
                <!-- Icon Container -->
                <div class="mb-6 flex justify-center">
                    <div class="w-16 h-16 bg-warning-light rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                            viewBox="0,0,256,256">
                            <g fill="#d97706" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                style="mix-blend-mode: normal">
                                <g transform="scale(10.66667,10.66667)">
                                    <path
                                        d="M12,2c-5.514,0 -10,4.486 -10,10c0,5.514 4.486,10 10,10c5.514,0 10,-4.486 10,-10c0,-5.514 -4.486,-10 -10,-10zM16.314,15.081c-0.195,0.273 -0.503,0.419 -0.815,0.419c-0.201,0 -0.404,-0.061 -0.58,-0.186l-3.5,-2.5c-0.287,-0.205 -0.445,-0.546 -0.416,-0.897l0.5,-6c0.046,-0.55 0.53,-0.958 1.08,-0.914c0.55,0.046 0.959,0.529 0.914,1.08l-0.453,5.434l3.037,2.169c0.45,0.321 0.554,0.946 0.233,1.395z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>

                <!-- Content Header -->
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mb-4" dir="ltr">
                    Your Company Account Under Review
                </h1>

                <!-- Message Body -->
                <p class="text-sm text-neutral-500 mb-8 leading-relaxed" dir="ltr">
                    Thank you for joining <strong>{{ config('app.name') }}</strong> . Our security
                    team is currently verifying your company
                    credentials to ensure a safe professional
                    environment. This process typically takes 24-48
                    business hours.
                </p>
                <!-- Info Box -->
                <div
                    class="bg-surface-container-low rounded-lg p-md text-left flex gap-md items-start border border-outline-variant">
                    <span class="material-symbols-outlined text-info text-[20px]" data-icon="info">info</span>
                    <div class="space-y-xs">
                        <p class="text-label-text font-label-text text-on-surface">Next Steps</p>
                        <p class="text-small-text font-small-text text-neutral-500">
                            We will send a confirmation email to your registered address once the review is complete.
                            You can then access your dashboard and post jobs.
                        </p>
                    </div>
                </div>
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
