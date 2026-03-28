@include('home.header')

<main class="min-h-screen bg-gray-50">
    <!-- Profile Header -->
    <section class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center text-center">
                <!-- Avatar -->
                <div class="relative mb-6">
                    @if($user->profile_picture)
                    <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}"
                        class="w-32 h-32 rounded-full border-4 border-white shadow-2xl object-cover">
                    @else
                    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?d=mp&s=200"
                        alt="{{ $user->name }}"
                        class="w-32 h-32 rounded-full border-4 border-white shadow-2xl object-cover">
                    @endif
                    @if($user->id_card_status === '1')
                    <div class="absolute -bottom-2 -right-2 bg-green-500 text-white p-2 rounded-full shadow-lg"
                        title="Verified">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- User Info -->
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $user->name }}</h1>

                @if($user->country)
                <p class="text-blue-100 flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $user->country }}
                </p>
                @endif

                <p class="text-blue-200 text-sm">
                    Member since {{ $user->created_at->format('F Y') }}
                </p>
            </div>
        </div>
    </section>

    <!-- NFT Gallery -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">
                @if($nfts->count() > 0)
                NFT Collection
                @else
                No NFTs Yet
                @endif
            </h2>

            @if($nfts->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($nfts as $nft)
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="aspect-square overflow-hidden">
                        @if(Str::startsWith($nft->ntf_image, 'http'))
                        <img src="{{ $nft->ntf_image }}" alt="{{ $nft->ntf_name }}" class="w-full h-full object-cover">
                        @else
                        <img src="{{ asset($nft->ntf_image) }}" alt="{{ $nft->ntf_name }}"
                            class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 truncate">{{ $nft->ntf_name }}</h3>
                        <p class="text-primary font-bold mt-2">
                            {{ \App\Helpers\CurrencyHelper::format($nft->nft_price) }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-gray-500 text-lg">This user hasn't uploaded any NFTs yet.</p>
            </div>
            @endif
        </div>
    </section>
</main>

@include('home.footer')