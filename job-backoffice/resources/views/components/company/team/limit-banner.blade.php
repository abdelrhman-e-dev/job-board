@if ($reachLimit)
    <div
        class="bg-warning-light border border-warning rounded-xl px-lg py-md mb-lg flex items-center justify-between gap-md">
        <div class="flex items-center gap-md">
            <span class="material-symbols-outlined text-warning">info</span>
            <div>
                <p class="text-label-md font-semibold text-warning">Team member limit reached</p>
                <p class="text-label-sm text-neutral-700">You've reached the limit of 5 hiring managers on your
                    current plan. Upgrade your plan to add more members.</p>
            </div>
        </div>
        <button
            class="text-warning font-label-md text-label-md hover:underline px-md py-sm rounded transition-colors">View
            Plans
        </button>
    </div>
@endif
@if ($current == 4)
    <div class="bg-warning-light border border-warning rounded-xl p-lg mb-lg flex items-center justify-between gap-md">
        <div class="flex items-center gap-md">
            <span class="material-symbols-outlined text-warning">warning</span>
            <div>
                <p class="text-label-md font-semibold text-warning">Approaching team limit</p>
                <p class="text-label-sm text-neutral-700">You have 1 slot left for a hiring manager on your current
                    plan.
                    Upgrade to add more members.</p>
            </div>
        </div>
        <button
            class="text-warning font-label-md text-label-md px-md py-sm rounded-lg hover:bg-warning/10 transition-colors">View
            Plans</button>
    </div>
@endif