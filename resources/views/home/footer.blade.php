<!-- Footer -->
<footer class="bg-slate-50 border-t border-slate-200 text-slate-600 py-16 md:py-20 mt-auto">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 mb-16">
            <div class="lg:col-span-4 pr-0 lg:pr-12">
                <a href="{{route('homepage')}}" class="block mb-6">
                    <img class="h-10 sm:h-12 w-auto" src="images/logo.png" alt="Artisttocollectors Logo" />
                </a>
                <p class="text-slate-500 leading-relaxed text-sm md:text-base">
                    The world's first and largest digital marketplace for crypto collectibles and non-fungible
                    tokens (NFTs). Buy, sell, and discover exclusive digital items.
                </p>
            </div>
            
            <div class="lg:col-span-2">
                <h4 class="font-bold text-slate-900 text-lg mb-6">Marketplace</h4>
                <ul class="space-y-4">
                    <li><a href="{{route('homepage')}}" class="text-slate-500 hover:text-primary font-medium transition-colors">All NFTs</a></li>
                    <li><a href="{{route('homepage')}}#explore" class="text-slate-500 hover:text-primary font-medium transition-colors">New Drops</a></li>
                    <li><a href="{{route('about')}}" class="text-slate-500 hover:text-primary font-medium transition-colors">About Us</a></li>
                    <li><a href="{{route('contact')}}" class="text-slate-500 hover:text-primary font-medium transition-colors">Contact</a></li>
                </ul>
            </div>
            
            <div class="lg:col-span-2">
                <h4 class="font-bold text-slate-900 text-lg mb-6">My Account</h4>
                <ul class="space-y-4">
                    @if (auth()->check())
                        <li><a href="{{route('home')}}" class="text-slate-500 hover:text-primary font-medium transition-colors">Profile</a></li>
                        <li><a href="{{route('home')}}" class="text-slate-500 hover:text-primary font-medium transition-colors">Favorites</a></li>
                        <li><a href="{{route('home')}}" class="text-slate-500 hover:text-primary font-medium transition-colors">Watchlist</a></li>
                    @else
                        <li><a href="{{route('register')}}" class="text-slate-500 hover:text-primary font-medium transition-colors">Sign Up</a></li>
                        <li><a href="{{route('login')}}" class="text-slate-500 hover:text-primary font-medium transition-colors">Login</a></li>
                    @endif
                </ul>
            </div>
            
            <div class="lg:col-span-4">
                <h4 class="font-bold text-slate-900 text-lg mb-6">Resources</h4>
                <div class="grid grid-cols-2 gap-4">
                    <ul class="space-y-4">
                        <li><a href="{{route('what')}}" class="text-slate-500 hover:text-primary font-medium transition-colors text-sm">What is an NFT?</a></li>
                        <li><a href="{{route('how')}}" class="text-slate-500 hover:text-primary font-medium transition-colors text-sm">How to buy an NFT</a></li>
                        <li><a href="{{route('drops')}}" class="text-slate-500 hover:text-primary font-medium transition-colors text-sm">What are drops?</a></li>
                        <li><a href="{{route('what-is-crypto-wallet')}}" class="text-slate-500 hover:text-primary font-medium transition-colors text-sm">Crypto wallets</a></li>
                    </ul>
                    <ul class="space-y-4">
                        <li><a href="{{route('what-is-cryptocurrency')}}" class="text-slate-500 hover:text-primary font-medium transition-colors text-sm">Cryptocurrency</a></li>
                        <li><a href="{{route('nft-gas-fees')}}" class="text-slate-500 hover:text-primary font-medium transition-colors text-sm">Gas fees</a></li>
                        <li><a href="{{route('what-is-web3')}}" class="text-slate-500 hover:text-primary font-medium transition-colors text-sm">What is Web3?</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="pt-8 border-t border-slate-200 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-slate-500 text-sm font-medium">
                © Copyright 2024 <a href="#" class="text-primary hover:text-primary-dark font-bold transition-colors">Artisttocollectors</a>
                All Rights Reserved
            </div>
            
            <div class="flex space-x-3">
                <a href="#" class="w-10 h-10 bg-white border border-slate-200 text-slate-600 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm hover:shadow hover:-translate-y-1">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-white border border-slate-200 text-slate-600 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm hover:shadow hover:-translate-y-1">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-white border border-slate-200 text-slate-600 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm hover:shadow hover:-translate-y-1">
                    <i class="bi bi-discord"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-white border border-slate-200 text-slate-600 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 shadow-sm hover:shadow hover:-translate-y-1">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
</div>

<script>
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    function connectWithEmail() {
        window.location.href = "https://opensea.io/login";
    }

    function connectWallet(wallet) {
        const userAgent = navigator.userAgent || navigator.vendor || window.opera;
        let walletUrls = "";

        if (/android/i.test(userAgent)) {
            switch(wallet) {
                case 'metamask':
                    walletUrls = "intent://walletconnect#Intent;package=io.metamask;scheme=ethereum;end";
                    break;
                case 'trust':
                    walletUrls = "intent://open#Intent;package=com.wallet.crypto.trustapp;end";
                    break;
                case 'coinbase':
                    walletUrls = "intent://open#Intent;package=org.toshi;end";
                    break;
            }
        } else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
            switch(wallet) {
                case 'metamask':
                    walletUrls = "https://apps.apple.com/app/metamask/id1438144202";
                    break;
                case 'trust':
                    walletUrls = "https://apps.apple.com/app/trust-ethereum-wallet/id1288339409";
                    break;
                case 'coinbase':
                    walletUrls = "https://apps.apple.com/app/coinbase-wallet/id1278383455";
                    break;
            }
        } else {
            switch(wallet) {
                case 'metamask':
                    walletUrls = "https://metamask.io/download.html";
                    break;
                case 'trust':
                    walletUrls = "https://trustwallet.com/";
                    break;
                case 'coinbase':
                    walletUrls = "https://www.coinbase.com/wallet";
                    break;
            }
        }

        if (walletUrls) {
            window.location.href = walletUrls;
        }
    }

    window.onclick = function(event) {
        const modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script src="js/scripts.js"></script>

</body>

</html>
