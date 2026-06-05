    <aside class="fixed left-0 top-0 h-screen w-[240px] bg-neutral-900 flex flex-col py-lg z-50">
        <div class="px-md mb-xl flex items-center gap-sm">
            <span class="text-headline-md font-headline-md text-white">Shaghalni</span>
        </div>
        <nav class="flex-1 space-y-sm">
            <a class="flex items-center gap-md py-sm px-md {{ Route::is('company.dashboard') ? 'bg-primary-container text-on-primary-container' : 'text-neutral-300 hover:text-white hover:bg-neutral-700' }} rounded-lg mx-2 transition-all duration-200"
                href="{{ route('company.dashboard') }}">
                <span class="material-symbols-outlined fill-icon" data-icon="dashboard">dashboard</span>
                <span class="font-label-md text-label-md">Dashboard</span>
            </a>
            <a class="flex items-center gap-md py-sm px-md text-neutral-300 hover:text-white mx-2 hover:bg-neutral-700 transition-colors duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="work">work</span>
                <span class="font-label-md text-label-md">Jobs</span>
            </a>
            <a class="flex items-center gap-md py-sm px-md text-neutral-300 hover:text-white mx-2 hover:bg-neutral-700 transition-colors duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="description">description</span>
                <span class="font-label-md text-label-md">Applications</span>
            </a>
            <a class="flex items-center gap-md py-sm px-md text-neutral-300 hover:text-white mx-2 hover:bg-neutral-700 transition-colors duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                <span class="font-label-md text-label-md">Notifications</span>
            </a>
            <a class="flex items-center gap-md py-sm px-md text-neutral-300 hover:text-white mx-2 hover:bg-neutral-700 transition-colors duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="group">group</span>
                <span class="font-label-md text-label-md">Team</span>
            </a>
            <a class="flex items-center gap-md py-sm px-md {{ Route::is('company.profile') ? 'bg-primary-container text-on-primary-container' : 'text-neutral-300 hover:text-white hover:bg-neutral-700' }} rounded-lg mx-2 transition-all duration-200"
                href="{{ route('company.profile') }}">
                <span class="material-symbols-outlined fill-icon" data-icon="person">person</span>
                <span class="font-label-md text-label-md">Profile</span>
            </a>
        </nav>
        <div class="mt-auto px-md pt-md border-t border-neutral-700">
            <div class="flex items-center gap-sm">
                <img alt="User Avatar"
                    class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-xs"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqknVCYdEp9YHGwkUUnvhYFHIQXk-Pzgf5NOccyxTLXBlTXaSYCmZNo-_tacoz1sofIS7RH5wz7veAEgGT0muwriFO8_mrS9RoXvXF4KWdmV2D7CmgZ4XhIAC0na5rl60JuGqGfrZd5YjGTP1880_K_9s36L1MH4eYcm6f5kEPcylcvFFmEEoNjfICAzxPnsW8dR0JTAy_kNwzveS5-g7q_s7sm5V_jOlWGxYY7BQbqJrIGBIj7Hrx1q66hLDNA7f5vJ01d7hc1sM" />
                <div>
                    <p class="text-white font-label-md text-label-md">Recruiter Name</p>
                    <p class="text-neutral-500 text-label-sm font-label-sm">Admin Access</p>
                </div>
            </div>
        </div>
    </aside>
