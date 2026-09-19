<nav aria-label="Breadcrumb" class="flex">
  <ol class="inline-flex items-center gap-2 text-sm">
    @foreach ($breadcrumbs as $breadcrumb)
      @if (! $loop->last)
        <li class="inline-flex items-center">
          <a href="{{ $breadcrumb->url }}" class="text-neutral-500 hover:text-primary transition">
            {{ $breadcrumb->title }}
          </a>
          <span class="mx-2 text-neutral-400">/</span>
        </li>
      @else
        <li class="font-medium text-neutral-700">
          {{ $breadcrumb->title }}
        </li>
      @endif
    @endforeach
  </ol>
</nav>