<header id="header"
    class="fixed top-0 right-0 w-[calc(100%-240px)] h-[64px] bg-surface-container-lowest flex justify-between items-center px-lg border-b border-neutral-300 z-40 transition-all duration-200 ease-in-out">
    <div class="flex items-center gap-md flex-grow">
        <button class="material-symbols-outlined text-secondary hover:bg-neutral-100 rounded-full p-2 transition-all"
            id="sidebar-toggle">menu</button>
    </div>
    <div class="flex items-center gap-md">
        <button
            class="material-symbols-outlined text-secondary hover:bg-neutral-100 rounded-full p-2 transition-all">notifications</button>
        <div class="h-8 w-[1px] bg-neutral-300 mx-2"></div>
        <div class="relative flex items-center gap-sm">
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-label-md cursor-pointer active:scale-95 transition-all"
                id="user-menu-trigger">
                SJ
            </div>
            <div class="hidden absolute top-full right-0 mt-xs w-48 bg-surface-container-lowest border border-neutral-300 rounded-lg shadow-md py-1 z-[100]"
                id="user-dropdown">
                <a href="#"
                    class="flex items-center gap-sm px-md py-2 text-label-md text-on-surface hover:bg-neutral-100 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                    Profile
                </a>
                <div class="h-[1px] bg-neutral-100 my-1"></div>
                <form action="{{ route('company.logout') }}" method="POST" class="w-full">
                  @csrf
                  <button type="submit"
                      class="flex items-center gap-sm px-md py-2 text-label-md text-danger hover:bg-danger-light transition-colors w-full">
                      <span class="material-symbols-outlined text-[20px]">logout</span>
                      Logout
                  </button>
                </form>
            </div>
        </div>
    </div>
</header>
