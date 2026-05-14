@extends('company.layouts.auth')

@section('content')
    <div dir="rtl" class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Card -->
            <div class="bg-white py-10 px-6 shadow-sm sm:rounded-xl sm:px-12 border border-neutral-300/40">

                <!-- Logo -->
                <div class="flex justify-center">
                    <div class="w-14 h-14 bg-primary-light rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                </div>

                <!-- Title & Subtitle -->
                <div class="mt-6 text-center">
                    <h2 class="text-2xl font-bold tracking-tight text-neutral-900">Welcome back</h2>
                    <p class="mt-2 text-sm text-neutral-500">Sign in to manage your posted jobs</p>
                </div>

                <!-- Error message -->
                @if ($errors->any())
                    <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-sm font-medium text-center text-red-800">{{ $errors->first() }}</p>
                    </div>
                @endif
                <!-- Form -->
                <form class="mt-8 space-y-5" action="{{ route('company.login.store') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-neutral-700">Email</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email"
                                required placeholder="name@company.com" class="block w-full rounded-md border-0 py-2.5
                                 text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 
                                 placeholder:text-neutral-500 focus:ring-2 focus:ring-inset 
                                 focus:ring-primary sm:text-sm sm:leading-6 text-left" dir="ltr">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-neutral-700">Password</label>
                            <div class="text-sm">
                                <a href="#"
                                    class="font-medium text-primary hover:text-primary-dark transition-colors">Forgot
                                    password?</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                placeholder="••••••••"
                                class="block w-full rounded-md border-0 py-2.5 text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 placeholder:text-neutral-500 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 text-left tracking-widest"
                                dir="ltr">
                        </div>
                    </div>

                    <!-- Remember me -->
                    <div class="flex items-center gap-2">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="h-4 w-4 rounded-sm border-neutral-300 text-primary focus:ring-primary cursor-pointer">
                        <label for="remember-me" class="block text-sm text-neutral-700 cursor-pointer">Remember me on
                            this device</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                            class="flex w-full justify-center rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors">
                            Sign in
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                {{-- google login will be available soon FEATURE --}}
                {{-- <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-neutral-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="bg-white px-4 text-neutral-500">أو المتابعة باستخدام</span>
                        </div>
                    </div>
                </div> --}}

                <!-- Google Login -->
                {{-- <div class="mt-6">
                <a href="#" class="flex w-full items-center justify-center gap-3 rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-neutral-700 shadow-sm ring-1 ring-inset ring-neutral-300 hover:bg-neutral-100 transition-colors">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    الدخول عبر جوجل
                </a>
            </div> --}}

            </div>

            <!-- Footer below card -->
            <p class="mt-8 text-center text-sm text-neutral-700">
                Don't have an account?
                <a href="#" class="font-semibold text-primary hover:text-primary-dark transition-colors">
                  Create new account
                </a>
            </p>

            <!-- Bottom Links -->
            <div class="mt-10 flex justify-center gap-6 text-xs text-neutral-500">
                <a href="#" class="hover:text-neutral-700 transition-colors">Terms of service</a>
                <a href="#" class="hover:text-neutral-700 transition-colors">Privacy policy</a>
                <a href="#" class="hover:text-neutral-700 transition-colors">Help center</a>
            </div>
        </div>
    </div>
@endsection
