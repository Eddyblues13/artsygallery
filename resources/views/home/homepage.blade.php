@include('home.header')

<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <!-- Elegant Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>
    
    <!-- Subtle Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-transparent to-transparent"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center max-w-7xl mx-auto">
            <!-- Left Content -->
            <div class="text-center lg:text-left space-y-8">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-sm rounded-full border border-white/10">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-white/90 text-sm font-medium">Live Marketplace</span>
                </div>
                
                <!-- Main Heading -->
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white leading-tight">
                        Discover Extraordinary
                        <span class="block bg-gradient-to-r from-purple-400 via-pink-400 to-purple-400 bg-clip-text text-transparent bg-[length:200%_auto] animate-gradient">
                            Digital Art
                        </span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-300 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Explore a curated collection of stunning digital artworks from talented artists worldwide. Buy, sell, and collect unique pieces that inspire.
                    </p>
                </div>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                    <a href="#explore" class="group relative px-8 py-4 bg-white text-slate-900 rounded-lg font-semibold hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center">
                        <span class="relative z-10 flex items-center">
                            Explore Gallery
                            <i class="bi bi-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </a>
                    <a href="{{route('login')}}" class="px-8 py-4 bg-transparent border-2 border-white/30 text-white rounded-lg font-semibold hover:bg-white/10 hover:border-white/50 transition-all duration-300 backdrop-blur-sm">
                        Sell Your Art
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/10">
                    <div class="text-center lg:text-left">
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-1">5K+</div>
                        <div class="text-gray-400 text-sm font-medium">Artists</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-1">25K+</div>
                        <div class="text-gray-400 text-sm font-medium">Artworks</div>
                    </div>
                    <div class="text-center lg:text-left">
                        <div class="text-3xl sm:text-4xl font-bold text-white mb-1">$1.5M+</div>
                        <div class="text-gray-400 text-sm font-medium">Art Sold</div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content - Art Showcase -->
            <div class="relative lg:pl-8">
                <div class="relative">
                    <!-- Main Artwork Image -->
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent z-10"></div>
                        <img src="https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&h=1000&fit=crop" 
                             alt="Digital Artwork" 
                             class="w-full h-[500px] sm:h-[600px] object-cover group-hover:scale-105 transition-transform duration-700" />
                        
                        <!-- Featured Badge -->
                        <div class="absolute top-6 right-6 z-20">
                            <span class="px-4 py-2 bg-white/95 backdrop-blur-sm rounded-lg text-xs font-bold text-slate-900 shadow-lg">
                                FEATURED
                            </span>
                        </div>
                        
                        <!-- Artist Info Card -->
                        <div class="absolute bottom-6 left-6 right-6 z-20">
                            <div class="bg-white/95 backdrop-blur-md rounded-xl p-4 shadow-xl border border-white/20">
                                <div class="flex items-center gap-4">
                                    <img src="https://i.pravatar.cc/150?img=12" 
                                         alt="Artist" 
                                         class="w-14 h-14 rounded-full border-2 border-white shadow-lg object-cover" />
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h3 class="text-white font-bold text-lg truncate">Sarah Martinez</h3>
                                            <span class="w-5 h-5 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                                <i class="bi bi-check text-white text-xs"></i>
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm font-medium">Abstract Artist</p>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span class="text-purple-600 font-bold">2.5 ETH</span>
                                            <span class="text-gray-400 text-xs">•</span>
                                            <span class="text-gray-600 text-xs">Featured Collection</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Decorative Elements -->
                    <div class="absolute -z-10 -top-6 -right-6 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute -z-10 -bottom-6 -left-6 w-64 h-64 bg-pink-500/20 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#explore" class="flex flex-col items-center gap-2 text-white/60 hover:text-white transition-colors">
            <span class="text-xs font-medium">Scroll</span>
            <i class="bi bi-chevron-down text-2xl"></i>
        </a>
    </div>
</section>

<!-- Curated Art Experiences (Static & Premium) -->
<section class="py-24 bg-slate-50" id="explore">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div class="max-w-2xl">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6 text-slate-900 leading-tight">
                    World-Class <span class="text-purple-600">Featured</span> Artworks
                </h2>
                <p class="text-slate-600 text-lg">
                    Discover recently approved digital masterpieces available for collection. Explore unique pieces that define the future of modern creativity.
                </p>
            </div>
            <div class="hidden md:block">
                <a href="{{route('register')}}" class="text-purple-600 font-bold hover:text-purple-700 transition-colors flex items-center gap-2">
                    View All Categories <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            @forelse($nfts as $nft)
            <!-- NFT Card -->
            <div class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 h-[300px] md:h-[450px]">
                @if(Str::startsWith($nft->ntf_image, ['http', 'https']))
                    <img src="{{ $nft->ntf_image }}" 
                         alt="{{ $nft->ntf_name }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                @else
                    <img src="{{ asset('user/uploads/nfts/' . $nft->ntf_image) }}" 
                         alt="{{ $nft->ntf_name }}" 
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4 md:p-8">
                    <div class="mb-2 md:mb-4">
                        <span class="px-2 py-1 md:px-3 md:py-1 bg-purple-500/20 backdrop-blur-md rounded-full text-[10px] md:text-xs font-bold text-purple-200 border border-purple-500/30">
                            FEATURED
                        </span>
                    </div>
                    <h3 class="text-lg md:text-2xl font-bold text-white mb-1 md:mb-2 truncate">{{ $nft->ntf_name }}</h3>
                    <p class="text-slate-300 mb-2 md:mb-4 text-xs md:text-base line-clamp-1">
                        By {{ $nft->ntf_owner }}
                    </p>
                    <div class="flex justify-between items-end">
                        <div class="flex flex-col">
                            <span class="text-slate-400 text-[10px] md:text-xs uppercase tracking-wider">Price</span>
                            <span class="text-base md:text-xl font-bold text-white">${{ number_format($nft->nft_price, 2) }}</span>
                        </div>
                        <a href="{{route('register')}}" class="inline-flex items-center text-white font-semibold hover:gap-3 transition-all bg-white/10 hover:bg-white/20 px-3 py-1.5 md:px-4 md:py-2 rounded-lg backdrop-blur-sm text-xs md:text-base">
                            Buy <i class="bi bi-arrow-right ml-1 md:ml-2 transition-all"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-slate-500 text-lg">No artworks currently on display. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Artists -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Featured Artists</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Meet the talented creators behind our most popular artworks
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @for($i = 0; $i < 4; $i++)
            <div class="group text-center">
                <div class="relative mb-6">
                    <img src="https://i.pravatar.cc/300?img={{ $i + 20 }}" 
                         alt="Artist" 
                         class="w-32 h-32 rounded-full mx-auto border-4 border-white shadow-xl group-hover:scale-110 transition-transform duration-300" />
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2">
                        <div class="w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                            <i class="bi bi-check text-white text-sm"></i>
                        </div>
                    </div>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ ['Emma Thompson', 'James Chen', 'Sofia Rodriguez', 'Michael Park'][$i] }}</h3>
                <p class="text-gray-600 mb-4">{{ ['Abstract Art', 'Digital Illustration', '3D Art', 'Photography'][$i] }}</p>
                <div class="flex justify-center space-x-2">
                    <a href="#" class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center hover:bg-purple-600 hover:text-white transition-colors">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors">
                        <i class="bi bi-twitter"></i>
                    </a>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">How It Works</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Start your art journey in three simple steps
            </p>
</div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="bi bi-palette text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Browse Artworks</h3>
                <p class="text-gray-600 leading-relaxed">
                    Explore thousands of unique digital artworks from talented artists around the world. Filter by style, artist, or collection.
                </p>
            </div>
            
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="bi bi-heart text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Collect & Own</h3>
                <p class="text-gray-600 leading-relaxed">
                    Purchase your favorite artworks and own them securely on the blockchain. Each piece is unique and verifiably yours.
                </p>
            </div>
            
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <i class="bi bi-brush text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Sell Your Art</h3>
                <p class="text-gray-600 leading-relaxed">
                    Artists can easily list their creations, set prices, and reach a global audience of art collectors and enthusiasts.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Art Categories -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Explore Art Categories</h2>
            <p class="text-gray-600 text-lg">Discover art across different styles and mediums</p>
</div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
                ['name' => 'Abstract', 'image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=400&h=400&fit=crop', 'count' => '1.2K'],
                ['name' => 'Portrait', 'image' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=400&h=400&fit=crop', 'count' => '850'],
                ['name' => 'Landscape', 'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=400&fit=crop', 'count' => '2.1K'],
                ['name' => 'Digital', 'image' => 'https://images.unsplash.com/photo-1638913662252-70efce1e50a7?w=400&h=400&fit=crop', 'count' => '3.5K'],
                ['name' => 'Minimalist', 'image' => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?w=400&h=400&fit=crop', 'count' => '680'],
                ['name' => '3D Art', 'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=400&fit=crop', 'count' => '920'],
                ['name' => 'Photography', 'image' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=400&h=400&fit=crop', 'count' => '1.8K'],
                ['name' => 'Surreal', 'image' => 'https://images.unsplash.com/photo-1611532736597-de2d4265fba3?w=400&h=400&fit=crop', 'count' => '450']
            ] as $category)
            <a href="#" class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{ $category['image'] }}" 
                     alt="{{ $category['name'] }}" 
                     class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <h3 class="text-white font-bold text-xl mb-1">{{ $category['name'] }}</h3>
                    <p class="text-white/80 text-sm">{{ $category['count'] }} Artworks</p>
                </div>
            </a>
            @endforeach
        </div>
                    </div>
</section>

<!-- Institutional Services & Global Impact -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Institutional <span class="text-purple-600">Services</span></h2>
            <p class="text-slate-600 text-lg max-w-3xl mx-auto">
                ArtsyGallery provides world-class infrastructure for private collectors, institutions, and digital-native estates to manage high-value digital assets.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Service 1 -->
            <div class="p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-2xl transition-all duration-300 border border-slate-100 group">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <i class="bi bi-shield-check text-3xl transition-colors"></i>
                </div>
                <h4 class="text-2xl font-bold mb-4">Private Curation</h4>
                <p class="text-slate-600 leading-relaxed">
                    Exclusive access to master-class curators who help build tailored portfolios based on market analytics.
                </p>
            </div>

            <!-- Service 2 -->
            <div class="p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-2xl transition-all duration-300 border border-slate-100 group">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i class="bi bi-bank text-3xl transition-colors"></i>
                </div>
                <h4 class="text-2xl font-bold mb-4">Asset Lending</h4>
                <p class="text-slate-600 leading-relaxed">
                    Leverage your digital collection for short-term institutional liquidity without liquidation.
                </p>
            </div>

            <!-- Service 3 -->
            <div class="p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-2xl transition-all duration-300 border border-slate-100 group">
                <div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-pink-600 group-hover:text-white transition-colors">
                    <i class="bi bi-safe text-3xl transition-colors"></i>
                </div>
                <h4 class="text-2xl font-bold mb-4">Estate Concierge</h4>
                <p class="text-slate-600 leading-relaxed">
                    Securing digital heritage through multi-generational blockchain keys and legal-tech frameworks.
                </p>
            </div>

            <!-- Service 4 -->
            <div class="p-8 rounded-3xl bg-slate-50 hover:bg-white hover:shadow-2xl transition-all duration-300 border border-slate-100 group">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <i class="bi bi-graph-up-arrow text-3xl transition-colors"></i>
                </div>
                <h4 class="text-2xl font-bold mb-4">Market Analytics</h4>
                <p class="text-slate-600 leading-relaxed">
                    Real-time valuation and provenance tracking across major global blockchain networks.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-purple-600 via-pink-600 to-purple-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
            Ready to Start Your Art Collection?
        </h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
            Join thousands of art lovers and collectors in discovering extraordinary digital art
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{route('register')}}" class="px-8 py-4 bg-white text-purple-600 rounded-xl font-bold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-2xl">
                Start Collecting
            </a>
            <a href="{{route('about')}}" class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-xl font-bold hover:bg-white/10 transition-all duration-300">
                Learn More
            </a>
        </div>
    </div>
</section>

<style>
    @keyframes gradient {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }
    .animate-gradient {
        animation: gradient 3s ease infinite;
        background-size: 200% auto;
    }
</style>

@include('home.footer')
