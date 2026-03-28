@include('home.header')

<!-- Hero Section -->
<section class="py-24 md:py-32 bg-slate-50 border-b border-slate-200">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-slate-900 mb-6 tracking-tight">
            About Artisttocollectors
        </h1>
        <p class="text-xl text-slate-600 leading-relaxed">
            Empowering creators and connecting collectors through the world's most trusted digital asset marketplace.
        </p>
    </div>
</section>

<!-- Mission Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <div class="inline-block px-4 py-1.5 bg-primary/10 text-primary rounded-full font-bold text-sm mb-6 uppercase tracking-wider">
                    Our Mission
                </div>
                <h2 class="text-4xl font-bold mb-6 text-slate-900">
                    Pioneering the <span class="text-primary">Creator Economy</span>
                </h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-6">
                    At Artisttocollectors, we believe that digital creation should be accessible, verifiable, and rewarding. We're building the premier platform where creators can mint their digital assets, reach global audiences, and earn fair compensation for their work.
                </p>
                <div class="grid grid-cols-2 gap-6 mt-8">
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <i class="bi bi-shield-check text-primary text-3xl mb-4 block"></i>
                        <h3 class="font-bold text-slate-900 mb-2">Authentic Assets</h3>
                        <p class="text-sm text-slate-500">Blockchain-verified ownership.</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <i class="bi bi-globe text-primary text-3xl mb-4 block"></i>
                        <h3 class="font-bold text-slate-900 mb-2">Global Reach</h3>
                        <p class="text-sm text-slate-500">Connect with collectors worldwide.</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=2564&auto=format&fit=crop" 
                     alt="Digital Art" 
                     class="rounded-3xl shadow-xl w-full object-cover aspect-[4/5]" />
            </div>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 bg-slate-50 border-y border-slate-200">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-6 text-slate-900">
                The Journey of Artisttocollectors
            </h2>
        </div>
        
        <div class="space-y-8">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200 hover:border-primary transition-colors">
                <h3 class="text-2xl font-bold mb-3 text-slate-900">The Vision</h3>
                <p class="text-slate-600 leading-relaxed">
                    Artisttocollectors was born from a simple idea: to create a secure, seamless environment where digital assets could be appreciated, traded, and owned securely. We recognized that the Web3 ecosystem needed a marketplace that truly understood both the creative and technical needs of the next generation of digital natives.
                </p>
            </div>
            
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200 hover:border-primary transition-colors">
                <h3 class="text-2xl font-bold mb-3 text-slate-900">Building Community</h3>
                <p class="text-slate-600 leading-relaxed">
                    From day one, we've focused on building a vibrant community of creators, collectors, and NFT enthusiasts. We've developed advanced minting tools and gas-optimized contracts that make it easy to showcase and trade digital assets safely.
                </p>
            </div>
            
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200 hover:border-primary transition-colors">
                <h3 class="text-2xl font-bold mb-3 text-slate-900">Today & Tomorrow</h3>
                <p class="text-slate-600 leading-relaxed">
                    Today, Artisttocollectors stands as one of the leading Web3 marketplaces, facilitating thousands of successful trades. Looking ahead, we're continuously innovating to improve scalability, support new blockchains, and make digital ownership accessible to the entire world.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-slate-100">
            <div>
                <div class="text-5xl font-extrabold text-slate-900 mb-2">5K+</div>
                <div class="text-slate-500 font-medium tracking-wide uppercase text-sm">Active Creators</div>
            </div>
            <div>
                <div class="text-5xl font-extrabold text-slate-900 mb-2">25K+</div>
                <div class="text-slate-500 font-medium tracking-wide uppercase text-sm">NFTs Minted</div>
            </div>
            <div>
                <div class="text-5xl font-extrabold text-slate-900 mb-2">$1.5M</div>
                <div class="text-slate-500 font-medium tracking-wide uppercase text-sm">Trading Volume</div>
            </div>
            <div>
                <div class="text-5xl font-extrabold text-slate-900 mb-2">50+</div>
                <div class="text-slate-500 font-medium tracking-wide uppercase text-sm">Countries</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-slate-900">
    <div class="container mx-auto px-4 text-center max-w-3xl">
        <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">
            Join the Web3 Revolution
        </h2>
        <p class="text-xl text-slate-400 mb-10">
            Whether you're a creator launching your next collection or a collector seeking rare digital drops, Artisttocollectors is your home.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{route('register')}}" class="px-8 py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-primary/30">
                Create Account
            </a>
            <a href="{{route('homepage')}}" class="px-8 py-4 bg-slate-800 border border-slate-700 text-white rounded-xl font-bold hover:bg-slate-700 transition-all duration-300">
                Explore Marketplace
            </a>
        </div>
    </div>
</section>

@include('home.footer')
