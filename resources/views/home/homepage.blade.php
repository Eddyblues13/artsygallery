@include('home.header')

<!-- Hero Section -->
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-white">
    <!-- Subtle Animated Background -->
    <div class="absolute inset-0 z-0 pointer-events-none fade-in">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center max-w-7xl mx-auto">
            <!-- Left Content -->
            <div class="text-center lg:text-left space-y-8 fade-in-up">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight tracking-tight">
                    Discover, collect, and sell extraordinary 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-purple-600">NFTs</span>
                </h1>
                <p class="text-lg sm:text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Artisttocollectors is the world's premier and largest digital marketplace for crypto collectibles and non-fungible tokens (NFTs).
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2">
                    <a href="#explore" class="px-8 py-3.5 bg-primary text-white rounded-xl font-semibold hover:bg-primary-dark transition-all duration-300 shadow-lg shadow-primary/30 flex items-center justify-center">
                        Explore
                    </a>
                    <a href="{{route('register')}}" class="px-8 py-3.5 bg-white border border-slate-200 text-primary rounded-xl font-semibold hover:shadow-md transition-all duration-300 flex items-center justify-center">
                        Create
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8 max-w-lg mx-auto lg:mx-0">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-slate-900 mb-1">5K+</div>
                        <div class="text-slate-500 text-sm font-medium">Creators</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-slate-900 mb-1">25K+</div>
                        <div class="text-slate-500 text-sm font-medium">NFTs</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-slate-900 mb-1">$1.5M+</div>
                        <div class="text-slate-500 text-sm font-medium">Volume</div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content - NFT Card -->
            <div class="relative lg:pl-12 fade-in">
                <div class="relative group cursor-pointer block">
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-white rounded-2xl overflow-hidden shadow-2xl transition-transform duration-300 group-hover:-translate-y-2">
                        <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=800&h=800&fit=crop" 
                             alt="Featured NFT" 
                             class="w-full h-[400px] sm:h-[500px] object-cover" />
                        
                        <div class="p-6 bg-white flex items-center gap-4">
                            <img src="https://i.pravatar.cc/150?img=33" alt="Creator" class="w-12 h-12 rounded-full border border-slate-200" />
                            <div class="flex-1">
                                <h3 class="text-slate-900 font-bold text-lg">Abstract Harmony #042</h3>
                                <a href="#" class="text-primary text-sm font-medium hover:underline">by SarahMartinez</a>
                            </div>
                            <div class="text-right">
                                <span class="block text-slate-500 text-xs uppercase tracking-wider mb-0.5">Floor</span>
                                <span class="bg-slate-100 text-slate-900 px-3 py-1 rounded-lg font-bold text-sm">2.5 ETH</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trending / Top Collections -->
<section class="py-16 bg-white border-t border-slate-100">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Trending in All Categories</h2>
            <div class="hidden sm:flex gap-2">
                <button class="px-4 py-2 rounded-lg bg-slate-100 text-slate-900 font-medium text-sm hover:bg-slate-200 transition">24h</button>
                <button class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 font-medium text-sm hover:bg-slate-50 transition">7d</button>
                <button class="px-4 py-2 rounded-lg bg-white border border-slate-200 text-slate-600 font-medium text-sm hover:bg-slate-50 transition">30d</button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-4">
            @for($i = 1; $i <= 9; $i++)
            <a href="#" class="flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 transition duration-200 group">
                <span class="text-slate-400 font-medium w-4">{{ $i }}</span>
                <div class="relative">
                    <img src="https://i.pravatar.cc/150?img={{ $i * 5 }}" alt="Collection" class="w-14 h-14 rounded-xl object-cover shadow-sm group-hover:shadow-md transition" />
                    @if($i <= 3)
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center">
                        <i class="bi bi-check text-white text-[10px]"></i>
                    </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-slate-900 font-bold truncate">{{ ['Bored Ape Yacht Club', 'CryptoPunks', 'Azuki', 'Doodles', 'CloneX', 'Moonbirds', 'Meebits', 'Cool Cats', 'Pudgy Penguins'][$i-1] }}</h4>
                    <div class="text-slate-500 text-sm">Floor: <span class="text-slate-900 font-medium">{{ rand(10, 99) / 10 }} ETH</span></div>
                </div>
                <div class="text-right">
                    <div class="text-green-500 font-medium text-sm">+{{ rand(10, 150) }}%</div>
                    <div class="text-slate-500 text-xs">{{ number_format(rand(100, 5000)) }} ETH</div>
                </div>
            </a>
            @endfor
        </div>
    </div>
</section>

<!-- Notable Drops / Featured NFTs (Using original $nfts variable) -->
<section class="py-20 bg-slate-50" id="explore">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 border-b-2 border-primary pb-2 inline-block">Notable Drops</h2>
            <a href="{{route('register')}}" class="text-primary font-medium hover:text-primary-dark transition-colors flex items-center gap-1">
                View All <i class="bi bi-chevron-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($nfts as $nft)
            <!-- NFT Card OpenSea Style -->
            <a href="{{route('register')}}" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 flex flex-col h-full">
                <div class="relative w-full aspect-square overflow-hidden bg-slate-100">
                    @if(Str::startsWith($nft->ntf_image, ['http', 'https']))
                        <img src="{{ $nft->ntf_image }}" 
                             alt="{{ $nft->ntf_name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    @else
                        <img src="{{ asset('user/uploads/nfts/' . $nft->ntf_image) }}" 
                             alt="{{ $nft->ntf_name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    @endif
                    <!-- Likes -->
                    <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm rounded-lg px-2 py-1 flex items-center gap-1 shadow-sm opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="bi bi-heart text-slate-400 text-xs"></i>
                        <span class="text-xs font-medium text-slate-600">{{ rand(10, 999) }}</span>
                    </div>
                </div>
                
                <div class="p-4 flex flex-col flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-full overflow-hidden">
                            <p class="text-xs font-medium text-slate-500 mb-1 truncate">{{ $nft->ntf_owner }}</p>
                            <h3 class="font-bold text-slate-900 text-sm truncate leading-tight w-full">{{ $nft->ntf_name }}</h3>
                        </div>
                    </div>
                    
                    <div class="mt-auto pt-3 border-t border-slate-50 flex justify-between items-end">
                        <div class="flex flex-col">
                            <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Price</span>
                            <span class="font-bold text-slate-900 text-sm">${{ number_format($nft->nft_price, 2) }}</span>
                        </div>
                        <span class="text-primary text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-2 group-hover:translate-x-0">
                            Buy Now
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-block p-6 bg-white rounded-full shadow-sm mb-4">
                    <i class="bi bi-image text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No NFTs available</h3>
                <p class="text-slate-500">Check back later for new drops and collections.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Categories Modern Grid -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-10 border-b-2 border-primary pb-2 inline-block">Explore Categories</h2>
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach([
                ['name' => 'Art', 'icon' => 'palette', 'image' => 'https://images.unsplash.com/photo-1547891654-e66ed7ebb968?w=500&h=500&fit=crop'],
                ['name' => 'Gaming', 'icon' => 'controller', 'image' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=500&h=500&fit=crop'],
                ['name' => 'Memberships', 'icon' => 'stars', 'image' => 'https://images.unsplash.com/photo-1620641788421-a11a852eb316?w=500&h=500&fit=crop'],
                ['name' => 'PFPs', 'icon' => 'person-circle', 'image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=500&h=500&fit=crop'],
                ['name' => 'Photography', 'icon' => 'camera', 'image' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=500&h=500&fit=crop'],
                ['name' => 'Music', 'icon' => 'music-note-beamed', 'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&h=500&fit=crop'],
                ['name' => 'Sports', 'icon' => 'trophy', 'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=500&h=500&fit=crop'],
                ['name' => 'Virtual Worlds', 'icon' => 'globe', 'image' => 'https://images.unsplash.com/photo-1614729939124-032f0b56c9ce?w=500&h=500&fit=crop']
            ] as $category)
            <a href="#" class="group relative rounded-2xl overflow-hidden bg-slate-100 aspect-video md:aspect-[4/3] shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center justify-center p-6 text-center border border-slate-100">
                <!-- Using subtle gradient + icon approach instead of heavy images for categories -->
                <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-slate-100 group-hover:from-primary/5 group-hover:to-primary/10 transition-colors"></div>
                <div class="relative z-10 w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-4 group-hover:-translate-y-2 group-hover:shadow-md transition-all duration-300">
                    <i class="bi bi-{{ $category['icon'] }} text-primary text-2xl"></i>
                </div>
                <h3 class="relative z-10 text-slate-900 font-bold text-lg">{{ $category['name'] }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Create and Sell NFTs Steps -->
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Create and sell your NFTs</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <div class="text-center group">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="bi bi-wallet2 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Set up your wallet</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Once you've set up your wallet of choice, connect it to Artisttocollectors by clicking the wallet icon in the top right corner.
                </p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="bi bi-collection text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Create your collection</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Click My Collections and set up your collection. Add social links, a description, profile & banner images, and set a secondary sales fee.
                </p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="bi bi-images text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Add your NFTs</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Upload your work (image, video, audio, or 3D art), add a title and description, and customize your NFTs with properties, stats, and unlockable content.
                </p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 bg-pink-100 text-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="bi bi-tag text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">List them for sale</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Choose between auctions, fixed-price listings, and declining-price listings. You choose how you want to sell your NFTs, and we help you sell them!
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Pre-Footer CTA -->
<section class="py-24 relative overflow-hidden bg-primary">
    <!-- Abstract Shapes -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full border-[20px] border-white"></div>
        <div class="absolute top-1/2 right-0 w-64 h-64 rounded-full border-[15px] border-white"></div>
    </div>
    
    <div class="container mx-auto px-4 max-w-4xl text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">
            Meet the next generation of creators
        </h2>
        <p class="text-xl text-primary-100 mb-10 text-white/90">
            Join millions of creators and collectors trading digital assets on the world's most trusted NFT platform.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{route('register')}}" class="px-8 py-4 bg-white text-primary rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all duration-300">
                Create Account
            </a>
            <a href="#explore" class="px-8 py-4 bg-primary-dark border border-white/20 text-white rounded-xl font-bold hover:bg-white/10 transition-all duration-300">
                Explore Marketplace
            </a>
        </div>
    </div>
</section>

<style>
    /* Custom utility classes for animations */
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    .fade-in {
        animation: fadeIn 1s ease-out forwards;
    }
</style>

@include('home.footer')
