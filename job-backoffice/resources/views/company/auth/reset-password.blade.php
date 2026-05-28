@extends('company.layouts.auth')
@section('title', 'Reset Password')
@section('content')
    <div dir="ltr" class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
        <div class="sm:mx-auto sm:w-full sm:max-w-[440px] flex justify-center items-center flex-col">
            <!-- Brand Identity (Optional but suggested for context) -->
            <div class="flex flex-row items-center justify-center gap-md ">
                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center shadow-lg mb-md">
                    <span class="material-symbols-outlined text-white text-[28px]" data-icon="lock_reset">lock_reset</span>
                </div>
                <h1 class="font-page-title text-page-title text-on-surface">Shaghalni</h1>
            </div>
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
            <!-- Auth Card -->
            <div class="bg-surface-container-lowest w-full border border-neutral-300 rounded-xl shadow-md p-xl">
                <div class="mb-lg">
                    <h2 class="font-section-heading text-section-heading text-on-surface mb-xs">Set New Password</h2>
                    <p class="font-body-text text-body-text text-neutral-500">Please enter your new password below.</p>
                </div>
                <form class="space-y-lg" id="resetForm" method="POST" action="{{ route('company.password.reset.store') }}">
                    @csrf
                    {{-- token & email hidden inputs --}}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <!-- New Password Field -->
                    <div class="space-y-xs">
                        <label class="block font-label-text text-label-text text-on-surface-variant" for="password">New
                            Password</label>
                        <div class="relative">
                            <input
                                class="w-full h-10 px-md pr-10 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-light focus:border-primary outline-none transition-all font-body-text text-body-text placeholder:text-neutral-500 bg-surface-bright"
                                id="password" name="password" placeholder="••••••••" type="password">
                            <button
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-500 hover:text-primary transition-colors cursor-pointer flex items-center"
                                onclick="togglePasswordVisibility('password', 'toggleIcon1')" type="button">
                                <span class="material-symbols-outlined text-[20px]" data-icon="visibility"
                                    id="toggleIcon1">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        <div class="h-1 w-full bg-neutral-100 rounded-full mt-sm overflow-hidden" id="passwordStrength">
                            <div class="h-full w-0 transition-all duration-300" id="strengthBar"></div>
                        </div>
                    </div>
                    <!-- Confirm Password Field -->
                    <div class="space-y-xs">
                        <label class="block font-label-text text-label-text text-on-surface-variant"
                            for="password_confirmation">Confirm New Password</label>
                        <div class="relative">
                            <input
                                class="w-full h-10 px-md pr-10 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-light focus:border-primary outline-none transition-all font-body-text text-body-text placeholder:text-neutral-500 bg-surface-bright"
                                id="password_confirmation" name="password_confirmation" placeholder="••••••••"
                                type="password">
                            <button
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-500 hover:text-primary transition-colors cursor-pointer flex items-center"
                                onclick="togglePasswordVisibility('password_confirmation', 'toggleIcon2')" type="button">
                                <span class="material-symbols-outlined text-[20px]" data-icon="visibility"
                                    id="toggleIcon2">visibility</span>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Action Button -->
                    <button
                        class="w-full h-10 bg-primary hover:bg-primary-dark active:scale-[0.98] text-white font-button-text text-button-text rounded-lg shadow-sm transition-all flex items-center justify-center gap-sm"
                        type="submit">
                        Reset Password
                        <span class="material-symbols-outlined text-[18px]" data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </form>
                <div class="mt-xl pt-lg border-t border-neutral-300 flex justify-center">
                    <a class="font-button-text text-button-text text-primary hover:underline flex items-center gap-xs"
                        href="{{ route('company.login') }}">
                        <span class="material-symbols-outlined text-[18px]"
                            data-icon="keyboard_backspace">keyboard_backspace</span>
                        Back to login
                    </a>
                </div>
            </div>
            <!-- Footer Help -->
            <p class="text-center mt-lg font-small-text text-small-text text-neutral-500">
                Secure password reset for the <span class="text-on-surface font-semibold">Shaghalni</span> Recruiter Portal.
            </p>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');

        passwordInput.addEventListener('input', (e) => {
            const val = e.target.value;
            let strength = 0;

            if (val.length > 5) strength += 25;
            if (val.match(/[A-Z]/)) strength += 25;
            if (val.match(/[0-9]/)) strength += 25;
            if (val.match(/[^A-Za-z0-9]/)) strength += 25;

            strengthBar.style.width = strength + '%';

            if (strength <= 25) strengthBar.className = 'h-full w-0 transition-all duration-300 bg-danger';
            else if (strength <= 50) strengthBar.className = 'h-full w-0 transition-all duration-300 bg-warning';
            else if (strength <= 75) strengthBar.className = 'h-full w-0 transition-all duration-300 bg-info';
            else strengthBar.className = 'h-full w-0 transition-all duration-300 bg-success';
        });
    </script>
@endsection
