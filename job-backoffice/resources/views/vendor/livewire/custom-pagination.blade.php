@if ($paginator->hasPages())
    <div class="flex items-center justify-between px-4 py-3 border-t border-gray-200 sm:px-6">
        
        <!-- Showing Results Text -->
        <div>
            <p class="text-sm text-gray-600">
                Showing <span class="font-medium text-gray-900">{{ $paginator->firstItem() }}</span> to 
                <span class="font-medium text-gray-900">{{ $paginator->lastItem() }}</span> of 
                <span class="font-medium text-gray-900">{{ $paginator->total() }}</span> results
            </p>
        </div>

        <!-- Pagination Buttons -->
        <div>
            <nav class="inline-flex space-x-1 rounded-md shadow-sm" aria-label="Pagination">
                
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                        &lsaquo;
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        &lsaquo;
                    </button>
                @endif

                {{-- Pagination Elements (Page Numbers) --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-500 bg-white">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="relative z-10 inline-flex items-center px-3 py-1.5 text-sm font-semibold text-white bg-blue-600 rounded-md">
                                    {{ $page }}
                                </span>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        &rsaquo;
                    </button>
                @else
                    <span class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                        &rsaquo;
                    </span>
                @endif

            </nav>
        </div>
    </div>
@endif