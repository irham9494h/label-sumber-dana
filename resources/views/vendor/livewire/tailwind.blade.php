<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 bg-white border rounded-md cursor-default select-none text-slate-500 border-slate-300">
                            Sebelumnya
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border rounded-md text-slate-700 border-slate-300 hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700">
                            Sebelumnya
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            wire:loading.attr="disabled"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border rounded-md text-slate-700 border-slate-300 hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700">
                            Selanjutnya
                        </button>
                    @else
                        <span
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 bg-white border rounded-md cursor-default select-none text-slate-500 border-slate-300">
                            Selanjutnya
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm leading-5 text-slate-700">
                        <span>{!! __('Menampilkan') !!}</span>
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('-') !!}</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('dari') !!}</span>
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        <span>{!! __('data') !!}</span>
                    </p>
                </div>

                <div>
                    <span class="relative z-0 inline-flex rounded-md shadow-sm">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="Sebelumnya">
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 bg-white border cursor-default text-slate-500 border-slate-300 rounded-l-md"
                                        aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @else
                                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                    rel="prev"
                                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border text-slate-500 border-slate-300 rounded-l-md hover:text-slate-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-slate-100 active:text-slate-500"
                                    aria-label="Sebelumnya">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 bg-white border cursor-default select-none text-slate-700 border-slate-300">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span
                                        wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-bold leading-5 border cursor-default select-none text-primary-500 bg-slate-100 border-slate-300">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button type="button"
                                                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border text-slate-700 border-slate-300 hover:text-slate-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-slate-100 active:text-slate-700"
                                                aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                    rel="next"
                                    class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border text-slate-500 border-slate-300 rounded-r-md hover:text-slate-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-slate-100 active:text-slate-500"
                                    aria-label="Selanjutnya">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="Selanjutnya">
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 bg-white border cursor-default text-slate-500 border-slate-300 rounded-r-md"
                                        aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    @endif
</div>
