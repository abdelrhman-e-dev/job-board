  @if ($percentage < 100)
      <div
          class="mb-lg bg-primary-light border border-primary-container rounded-lg p-lg shadow-md flex flex-col md:flex-row md:items-center justify-between gap-md">
          <div class="flex items-start gap-md">
              <div
                  class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-white shrink-0">
                  <span class="material-symbols-outlined">trending_up</span>
              </div>
              <div>
                  <h3 class="font-title-md text-title-md text-primary">Your profile is almost complete!</h3>
                  <p class="text-body-md text-on-surface-variant mt-1">Completion: <span
                          class="font-bold text-primary">{{ $percentage }}%</span>.
                      Missing:
                  <p class="mt-sm font-body-md text-body-md text-secondary">
                      Missing fields:
                      @foreach ($missing as $item)
                          <span class="font-semibold text-primary">
                              {{ ucwords(str_replace('_', ' ', $item)) }}</span> -
                      @endforeach
                  </p>
                  </p>
              </div>
          </div>
          <div class="w-full md:w-64 h-3 bg-white rounded-full overflow-hidden border border-neutral-300">
              <div class="h-full bg-primary-dark transition-all duration-500 ease-out"
                  style="width: {{ $percentage }}%;"></div>
          </div>
      </div>
  @endif
