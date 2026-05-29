@if ($percentage < 100)
    <section class="mb-lg mt-6">
        <div
            class="bg-primary-light p-lg rounded-xl flex flex-col md:flex-row items-center justify-between gap-lg border border-primary/10">
            <div class="flex-1 w-full">
                <div class="flex items-center justify-between mb-sm">
                    <h2 class="font-title-md text-title-md text-primary-dark">Complete your company profile</h2>
                    <span class="font-label-md text-label-md text-primary-dark">{{ $percentage }}% Done</span>
                </div>
                <div class="w-full bg-white/50 h-3 rounded-full overflow-hidden">
                    <div class="bg-primary h-full rounded-full transition-all duration-1000"
                        style="width: {{ $percentage }}%;"></div>
                </div>
                <p class="mt-sm font-body-md text-body-md text-secondary">
                    Missing fields:
                    @foreach ($missing as $item)
                        <span class="font-semibold text-primary">
                            {{ ucwords(str_replace('_', ' ', $item)) }}</span> -
                    @endforeach
                    <br>
                    Complete these to attract more talent.
                </p>
            </div>
            <button
                class="bg-primary text-on-primary font-label-md text-label-md px-lg py-[10px] rounded-lg hover:bg-primary-dark transition-all shadow-md shrink-0">
                Complete Profile
            </button>
        </div>
    </section>
@endif
