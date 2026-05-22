    <div class="min-h-screen bg-neutral-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8"
        style="background: radial-gradient(circle at center, #F1F5F9 0%, #E2E8F0 100%);">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-lg sm:rounded-xl sm:px-10 border border-neutral-200">
                <div class="flex justify-between items-center mb-8">
                    <div class="text-xs font-semibold text-neutral-500 tracking-wider uppercase">
                        STEP {{ $step }} OF 2
                    </div>
                    <div class="flex gap-2">
                        <div class="h-1.5 w-10 rounded-full {{ $step >= 1 ? 'bg-primary' : 'bg-neutral-200' }}"></div>
                        <div class="h-1.5 w-10 rounded-full {{ $step >= 2 ? 'bg-primary' : 'bg-neutral-200' }}"></div>
                    </div>
                </div>

                <div class="sm:mx-auto sm:w-full text-center mb-10">
                    <div
                        class="mx-auto bg-primary-light text-primary h-14 w-14 rounded-xl flex items-center justify-center mb-4 shadow-sm border border-primary-light/50">
                        @if ($step === 1)
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @else
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        @endif
                    </div>
                    <h2 class="text-3xl font-extrabold text-neutral-900 tracking-tight">
                        {{ $step === 1 ? 'Create an account' : 'Company Information' }}
                    </h2>
                    <p class="mt-2 text-sm text-neutral-500 font-medium">
                        {{ $step === 1 ? 'Join ' . config('app.name') . ' to manage your hiring process' : 'Tell us about your organization' }}
                    </p>
                </div>

                @if ($step === 1)
                    <form class="space-y-5" wire:submit="nextStep">
                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label for="first_name" class="block text-sm font-medium text-neutral-700">First
                                    Name</label>
                                <div class="mt-1">
                                    <input id="first_name" wire:model="first_name" type="text" required
                                        autocomplete="given-name" placeholder="John"
                                        class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm placeholder-neutral-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                    @error('first_name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-1/2">
                                <label for="last_name" class="block text-sm font-medium text-neutral-700">Last
                                    Name</label>
                                <div class="mt-1">
                                    <input id="last_name" wire:model="last_name" type="text" required
                                        autocomplete="family-name" placeholder="Doe"
                                        class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm placeholder-neutral-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                    @error('last_name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-neutral-700">Email</label>
                            <div class="mt-1">
                                <input id="email" wire:model="email" type="email" required autocomplete="email"
                                    placeholder="john.doe@example.com"
                                    class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm placeholder-neutral-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-neutral-700">Password</label>
                            <div class="mt-1">
                                <input id="password" wire:model="password" type="password" required
                                    autocomplete="new-password" placeholder="••••••••"
                                    class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm placeholder-neutral-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-neutral-700">Confirm
                                Password</label>
                            <div class="mt-1">
                                <input id="password_confirmation" wire:model="password_confirmation" type="password"
                                    required autocomplete="new-password" placeholder="••••••••"
                                    class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm placeholder-neutral-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                @error('password_confirmation')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <button type="submit" wire:loading.attr="disabled"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                <span wire:loading.remove>Next: Company Info →</span>
                                <span wire:loading>Processing...</span>
                            </button>
                        </div>
                    </form>
                @elseif($step === 2)
                    <form class="space-y-5" wire:submit="submit">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-neutral-700">Company
                                Name</label>
                            <div class="mt-1">
                                <input id="company_name" wire:model="company_name" type="text" required
                                    placeholder="Acme Corp"
                                    class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm placeholder-neutral-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                @error('company_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="industry" class="block text-sm font-medium text-neutral-700">Industry</label>
                            <div class="mt-1 relative">
                                <select id="industry" wire:model.live="industry" required
                                    class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                    <option value="">Select Industry</option>
                                    <option value="Technology">Technology & Software</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Education">Education</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Retail">Retail</option>
                                    <option value="other">Other</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-neutral-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" />
                                    </svg>
                                </div>
                                @error('industry')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="size" class="block text-sm font-medium text-neutral-700">Company
                                Size</label>
                            <div class="mt-1 relative">
                                <select id="size" wire:model="size" required
                                    class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                    <option value="">Select Size</option>
                                    <option value="1-10">1-10 employees</option>
                                    <option value="11-50">11-50 employees</option>
                                    <option value="51-200">51-200 employees</option>
                                    <option value="201-500">201-500 employees</option>
                                    <option value="500+">500+ employees</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-neutral-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" />
                                    </svg>
                                </div>
                                @error('size')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label for="city" class="block text-sm font-medium text-neutral-700">City</label>
                                <div class="mt-1">
                                    <input id="city" wire:model="city" type="text" required
                                        placeholder="San Francisco"
                                        class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm placeholder-neutral-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                    @error('city')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-1/2">
                                <label for="country"
                                    class="block text-sm font-medium text-neutral-700">Country</label>
                                <div class="mt-1">
                                    <input id="country" wire:model="country" type="text" required
                                        placeholder="United States"
                                        class="appearance-none block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm placeholder-neutral-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                    @error('country')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" wire:loading.attr="disabled"
                                class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-semibold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all">
                                <span wire:loading.remove>Complete Registration</span>
                                <span wire:loading>Creating account...</span>
                            </button>
                        </div>

                        <div class="text-center">
                            <button type="button" wire:click="previousStep"
                                class="inline-flex items-center text-sm font-medium text-primary hover:text-primary-dark transition-colors">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" />
                                </svg>
                                Back to Personal Info
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            <p class="mt-6 text-center text-sm text-neutral-500">
                Already have an account?
                <a href="{{ route('company.login') ?? '#' }}"
                    class="font-medium text-primary hover:text-primary-dark transition-colors">
                    Sign in
                </a>
            </p>
        </div>
    </div>
