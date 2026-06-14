<aside id="sidebar" class="fixed left-0 top-0 h-screen w-[240px] bg-neutral-900 flex flex-col p-md z-50">
    <div class="mb-xl px-sm logo-container flex flex-col">
        <span class="text-headline-md font-headline-md font-bold text-white logo-text">Shaghalni</span>
        <p class="text-neutral-500 font-label-sm text-label-sm mt-xs logo-text">Recruitment Suite</p>
        <div
            class="hidden sidebar-collapsed:block w-8 h-8 rounded bg-primary flex items-center justify-center text-white font-bold mx-auto">
            S</div>
    </div>
    <nav class="flex-grow space-y-sm">
        <!-- Dashboard -->
        <a class="flex items-center gap-md py-sm px-sm {{ Route::is('company.dashboard') ? 'bg-primary-container text-on-primary-container' : 'text-neutral-300 hover:text-white hover:bg-neutral-700' }} rounded-lg mx-2 transition-all duration-200"
            href="{{ route('company.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-label-md text-label-md nav-text">Dashboard</span>
        </a>
        <!-- Job Listings -->
        <a class="flex items-center gap-md py-sm px-sm text-neutral-300 hover:text-white hover:bg-neutral-700 rounded-lg mx-2 transition-all duration-200"
            href="#">
            <span class="material-symbols-outlined">work</span>
            <span class="font-label-md text-label-md nav-text">Job Listings</span>
        </a>
        <!-- Applications -->
        <a class="flex items-center gap-md py-sm px-sm text-neutral-300 hover:text-white hover:bg-neutral-700 rounded-lg mx-2 transition-all duration-200"
            href="#">
            <span class="material-symbols-outlined">group_add</span>
            <span class="font-label-md text-label-md nav-text">Applications</span>
        </a>
        <!-- Team Management (ACTIVE) -->
        <a class="flex items-center gap-md py-sm px-sm {{ Route::is('company.team') ? 'bg-primary-container text-on-primary-container' : 'text-neutral-300 hover:text-white hover:bg-neutral-700' }} rounded-lg mx-2 transition-all duration-200"
            href="{{ route('company.team') }}">
            <span class="material-symbols-outlined">groups</span>
            <span class="font-label-md text-label-md nav-text">Team Management</span>
        </a>
        <!-- Company Profile -->
        <a class="flex items-center gap-md py-sm px-sm {{ Route::is('company.profile') ? 'bg-primary-container text-on-primary-container' : 'text-neutral-300 hover:text-white hover:bg-neutral-700' }} rounded-lg mx-2 transition-all duration-200"
            href="{{ route('company.profile') }}">
            <span class="material-symbols-outlined">business</span>
            <span class="font-label-md text-label-md nav-text">Company Profile</span>
        </a>
    </nav>
    <!-- User Section in Sidebar -->
    <div class="mt-auto border-t border-neutral-700 pt-md pb-xs">
        <div class="flex items-center gap-md px-md nav-item">
            <div
                class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-label-md shrink-0">
                SJ</div>
            <div class="nav-text overflow-hidden">
                <p class="text-white text-label-md font-semibold truncate">Sarah Jenkins</p>
                <p class="text-neutral-500 text-label-sm truncate">Admin</p>
            </div>
        </div>
    </div>
</aside>
