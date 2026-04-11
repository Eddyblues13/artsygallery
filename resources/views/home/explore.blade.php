@include('home.header')

<section class="pt-28 pb-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-7xl">

        <!-- Page Header -->
        <div class="mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Explore NFTs</h1>
            <p class="text-slate-500 text-lg">Browse {{ number_format($totalNfts) }} items across the marketplace</p>
        </div>

        <!-- Filters Bar -->
        <form method="GET" action="{{ route('explore') }}" id="filterForm">
            <div class="flex flex-col md:flex-row gap-4 mb-8">
                <!-- Search -->
                <div class="flex-1 relative">
                    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name, description, or creator..."
                        class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors placeholder-slate-400">
                </div>

                <!-- Sort -->
                <select name="sort" onchange="document.getElementById('filterForm').submit()"
                    class="px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-700 font-medium focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary cursor-pointer min-w-[180px]">
                    <option value="latest" {{ request('sort')=='latest' ? 'selected' : '' }}>Recently Listed</option>
                    <option value="price_low" {{ request('sort')=='price_low' ? 'selected' : '' }}>Price: Low to High
                    </option>
                    <option value="price_high" {{ request('sort')=='price_high' ? 'selected' : '' }}>Price: High to Low
                    </option>
                </select>

                <!-- Search Button -->
                <button type="submit"
                    class="px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary-dark transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2">
                    <i class="bi bi-search"></i>
                    Search
                </button>
            </div>

            <!-- Category Pills -->
            <div class="flex flex-wrap gap-2 mb-8">
                <a href="{{ route('explore', array_merge(request()->except('category', 'page'))) }}"
                    class="px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 border {{ !request('category') ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-primary hover:text-primary' }}">
                    All
                </a>
                @foreach([
                ['slug' => 'art', 'name' => 'Art', 'icon' => 'palette'],
                ['slug' => 'gaming', 'name' => 'Gaming', 'icon' => 'controller'],
                ['slug' => 'memberships', 'name' => 'Memberships', 'icon' => 'stars'],
                ['slug' => 'pfps', 'name' => 'PFPs', 'icon' => 'person-circle'],
                ['slug' => 'photography', 'name' => 'Photography', 'icon' => 'camera'],
                ['slug' => 'music', 'name' => 'Music', 'icon' => 'music-note-beamed'],
                ['slug' => 'sports', 'name' => 'Sports', 'icon' => 'trophy'],
                ['slug' => 'virtual-worlds', 'name' => 'Virtual Worlds', 'icon' => 'globe'],
                ] as $cat)
                <a href="{{ route('explore', array_merge(request()->except('category', 'page'), ['category' => $cat['slug']])) }}"
                    class="px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200 border flex items-center gap-1.5 {{ request('category') == $cat['slug'] ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-primary hover:text-primary' }}">
                    <i class="bi bi-{{ $cat['icon'] }}"></i>
                    {{ $cat['name'] }}
                </a>
                @endforeach
            </div>
        </form>

        <!-- Results Count -->
        <div class="flex items-center justify-between mb-6">
            <p class="text-slate-500 text-sm font-medium">
                Showing {{ $nfts->firstItem() ?? 0 }}–{{ $nfts->lastItem() ?? 0 }} of {{ $nfts->total() }} results
                @if(request('category'))
                in <span class="text-primary font-semibold capitalize">{{ str_replace('-', ' ', request('category'))
                    }}</span>
                @endif
                @if(request('search'))
                for "<span class="text-slate-900 font-semibold">{{ request('search') }}</span>"
                @endif
            </p>
            @if(request('category') || request('search'))
            <a href="{{ route('explore') }}"
                class="text-sm text-primary font-semibold hover:underline flex items-center gap-1">
                <i class="bi bi-x-circle"></i> Clear Filters
            </a>
            @endif
        </div>

        <!-- NFT Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($nfts as $nft)
            <a href="{{ route('nft.public', $nft->id) }}"
                class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 flex flex-col h-full">
                <div class="relative w-full aspect-square overflow-hidden bg-slate-100">
                    @if(Str::startsWith($nft->ntf_image, ['http', 'https']))
                    <img src="{{ $nft->ntf_image }}" alt="{{ $nft->ntf_name }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy" />
                    @else
                    <img src="{{ asset($nft->ntf_image) }}" alt="{{ $nft->ntf_name }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy" />
                    @endif
                    <!-- Hover overlay -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
                        <span
                            class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-lg text-sm font-semibold text-primary">
                            View Details
                        </span>
                    </div>
                </div>

                <div class="p-4 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-primary to-purple-500 flex-shrink-0">
                        </div>
                        <p class="text-xs font-medium text-slate-500 truncate">{{ $nft->ntf_owner }}</p>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm truncate leading-tight mb-1">{{ $nft->ntf_name }}</h3>
                    @if($nft->ntf_description)
                    <p class="text-xs text-slate-400 truncate mb-2">{{ Str::limit($nft->ntf_description, 60) }}</p>
                    @endif

                    <div class="mt-auto pt-3 border-t border-slate-50 flex justify-between items-end">
                        <div class="flex flex-col">
                            <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Price</span>
                            <span class="font-bold text-slate-900 text-sm">${{ number_format($nft->nft_price, 2)
                                }}</span>
                        </div>
                        <span
                            class="text-primary text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-2 group-hover:translate-x-0">
                            Buy Now &rarr;
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-block p-6 bg-white rounded-full shadow-sm mb-4">
                    <i class="bi bi-search text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No NFTs found</h3>
                <p class="text-slate-500 mb-6">
                    @if(request('search') || request('category'))
                    Try adjusting your filters or search terms
                    @else
                    Check back later for new drops and collections
                    @endif
                </p>
                @if(request('search') || request('category'))
                <a href="{{ route('explore') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary-dark transition-all">
                    <i class="bi bi-arrow-left"></i> View All NFTs
                </a>
                @endif
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($nfts->hasPages())
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center gap-1">
                {{-- Previous --}}
                @if($nfts->onFirstPage())
                <span class="px-4 py-2 rounded-lg bg-slate-100 text-slate-400 font-medium text-sm cursor-not-allowed">
                    <i class="bi bi-chevron-left"></i> Prev
                </span>
                @else
                <a href="{{ $nfts->previousPageUrl() }}"
                    class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-700 font-medium text-sm hover:bg-slate-50 transition">
                    <i class="bi bi-chevron-left"></i> Prev
                </a>
                @endif

                {{-- Pages --}}
                @foreach($nfts->getUrlRange(max(1, $nfts->currentPage() - 2), min($nfts->lastPage(),
                $nfts->currentPage() + 2)) as $page => $url)
                @if($page == $nfts->currentPage())
                <span class="px-4 py-2 rounded-lg bg-primary text-white font-bold text-sm shadow-sm">{{ $page }}</span>
                @else
                <a href="{{ $url }}"
                    class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-700 font-medium text-sm hover:bg-slate-50 transition">
                    {{ $page }}
                </a>
                @endif
                @endforeach

                {{-- Next --}}
                @if($nfts->hasMorePages())
                <a href="{{ $nfts->nextPageUrl() }}"
                    class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-700 font-medium text-sm hover:bg-slate-50 transition">
                    Next <i class="bi bi-chevron-right"></i>
                </a>
                @else
                <span class="px-4 py-2 rounded-lg bg-slate-100 text-slate-400 font-medium text-sm cursor-not-allowed">
                    Next <i class="bi bi-chevron-right"></i>
                </span>
                @endif
            </nav>
        </div>
        @endif

    </div>
</section>

@include('home.footer')