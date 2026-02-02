@include('home.header')

<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIvPjwvZz48L2c+PC9zdmc+')] opacity-20"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6">
                About <span class="bg-gradient-to-r from-yellow-400 via-pink-400 to-purple-400 bg-clip-text text-transparent">Artsygalley</span>
            </h1>
            <p class="text-xl text-white/90 leading-relaxed">
                Empowering artists and connecting art lovers through the world's premier digital art marketplace
            </p>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block px-4 py-2 bg-purple-100 text-purple-700 rounded-full font-semibold mb-6">
                    Our Mission
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900">
                    Celebrating Art in the <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Digital Age</span>
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    At Artsygalley, we believe that art should be accessible to everyone. We're building a platform where artists can showcase their creativity, reach global audiences, and earn fair compensation for their work.
                </p>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    Our mission is to democratize art ownership and create new opportunities for artists worldwide. Through blockchain technology, we ensure that every piece of art is authentic, verifiable, and truly owned by its collector.
                </p>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                            <i class="bi bi-palette text-white text-xl"></i>
                        </div>
                        <span class="font-semibold text-gray-900">Artist-Focused</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
                            <i class="bi bi-shield-check text-white text-xl"></i>
                        </div>
                        <span class="font-semibold text-gray-900">Authentic Art</span>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&h=800&fit=crop" 
                     alt="Art Studio" 
                     class="rounded-3xl shadow-2xl" />
                <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl p-6 shadow-2xl hidden lg:block">
                    <div class="text-3xl font-bold text-purple-600 mb-2">5K+</div>
                    <div class="text-gray-600">Active Artists</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-2 bg-purple-100 text-purple-700 rounded-full font-semibold mb-6">
                    Our Story
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900">
                    The Journey of Artsygalley
                </h2>
            </div>
            
            <div class="space-y-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <i class="bi bi-lightbulb text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-900">The Vision</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Artsygalley was born from a simple idea: to create a space where digital art could be appreciated, collected, and valued just like traditional art. We recognized that the digital art world needed a platform that truly understood both the artistic and technological aspects of this new medium.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                            <i class="bi bi-people text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-900">Building Community</h3>
                            <p class="text-gray-600 leading-relaxed">
                                From day one, we've focused on building a vibrant community of artists, collectors, and art enthusiasts. We've worked closely with creators to understand their needs and have developed tools that make it easy to showcase and sell their work.
                            </p>
                            <p class="text-gray-600 leading-relaxed mt-4">
                                Our platform has become a home for emerging artists to gain recognition and for established artists to reach new audiences.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                            <i class="bi bi-globe text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-900">Today & Tomorrow</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Today, Artsygalley stands as one of the leading digital art marketplaces, featuring thousands of artworks from artists around the globe. We're continuously innovating to provide the best experience for both artists and collectors.
                            </p>
                            <p class="text-gray-600 leading-relaxed mt-4">
                                Looking ahead, we're committed to expanding our platform, supporting more artists, and making digital art accessible to everyone. We believe in the power of art to inspire, connect, and transform lives.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Our Core Values</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                The principles that guide everything we do
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="bi bi-palette text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Art First</h3>
                <p class="text-gray-600 leading-relaxed">
                    We prioritize the art and the artists. Every decision we make is centered around supporting creativity and artistic expression.
                </p>
            </div>
            
            <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="bi bi-shield-check text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Authenticity</h3>
                <p class="text-gray-600 leading-relaxed">
                    We ensure every artwork is authentic and verifiable. Collectors can trust that they're purchasing genuine, original pieces.
                </p>
            </div>
            
            <div class="text-center p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="bi bi-heart text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Community</h3>
                <p class="text-gray-600 leading-relaxed">
                    We're building a supportive community where artists and collectors can connect, share, and grow together.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Meet Our Team</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Passionate individuals dedicated to supporting artists and art lovers
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach([
                ['name' => 'Sarah Johnson', 'role' => 'Founder & CEO', 'image' => 20],
                ['name' => 'Michael Chen', 'role' => 'CTO', 'image' => 21],
                ['name' => 'Emily Rodriguez', 'role' => 'Head of Curation', 'image' => 22],
                ['name' => 'David Park', 'role' => 'Community Lead', 'image' => 23]
            ] as $member)
            <div class="text-center group">
                <div class="relative mb-6">
                    <img src="https://i.pravatar.cc/300?img={{ $member['image'] }}" 
                         alt="{{ $member['name'] }}" 
                         class="w-32 h-32 rounded-full mx-auto border-4 border-white shadow-xl group-hover:scale-110 transition-transform duration-300" />
                </div>
                <h3 class="text-xl font-bold mb-2">{{ $member['name'] }}</h3>
                <p class="text-gray-600 mb-4">{{ $member['role'] }}</p>
                <div class="flex justify-center space-x-2">
                    <a href="#" class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center hover:bg-purple-600 hover:text-white transition-colors">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors">
                        <i class="bi bi-twitter"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-gradient-to-r from-purple-600 via-pink-600 to-purple-600">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-5xl font-bold text-white mb-2">5K+</div>
                <div class="text-white/90">Active Artists</div>
            </div>
            <div>
                <div class="text-5xl font-bold text-white mb-2">25K+</div>
                <div class="text-white/90">Artworks</div>
            </div>
            <div>
                <div class="text-5xl font-bold text-white mb-2">$1.5M+</div>
                <div class="text-white/90">Art Sold</div>
            </div>
            <div>
                <div class="text-5xl font-bold text-white mb-2">50+</div>
                <div class="text-white/90">Countries</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900">
            Join Our Art Community
        </h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Whether you're an artist looking to showcase your work or an art lover seeking unique pieces, we welcome you to our community.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{route('register')}}" class="px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                Get Started
            </a>
            <a href="{{route('contact')}}" class="px-8 py-4 bg-transparent border-2 border-purple-600 text-purple-600 rounded-xl font-bold hover:bg-purple-50 transition-all duration-300">
                Contact Us
            </a>
        </div>
    </div>
</section>

@include('home.footer')
