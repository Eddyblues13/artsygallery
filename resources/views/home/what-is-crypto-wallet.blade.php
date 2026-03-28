@include('home.header')

<!-- Hero Section -->
<section class="py-24 md:py-32 bg-slate-50 border-b border-slate-200">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6 tracking-tight">What is a Crypto Wallet?</h1>
        <p class="text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto">A crypto wallet is a software program or physical device that allows you to store your digital assets and cryptocurrencies securely.</p>
    </div>
</section>

<!-- Content Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <div>
                <p class="text-lg text-slate-600 leading-relaxed mb-6">Your wallet is your key to the Web3 ecosystem. It acts as your personal account, giving you the ability to buy, sell, and interact with decentralized applications, all while ensuring that you possess sovereign control over your funds and assets.</p>
                <div class="flex flex-col sm:flex-row gap-4 mt-8">
                    <a href="{{route('homepage')}}#explore" class="px-8 py-3.5 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm text-center">Explore Marketplace</a>
                    <a href="{{route('register')}}" class="px-8 py-3.5 bg-slate-50 border border-slate-200 text-slate-700 rounded-xl font-bold hover:bg-slate-100 transition-all duration-300 text-center">Start Creating</a>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="bg-gradient-to-tr from-primary/10 to-transparent p-6 rounded-[2.5rem]">
                    <img src="images/items/wallet.png" alt="Crypto Wallets" class="rounded-3xl shadow-lg w-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

@include('home.footer')