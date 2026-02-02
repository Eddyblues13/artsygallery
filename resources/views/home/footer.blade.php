<!-- Footer -->
<footer class="bg-gray-900 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div class="lg:col-span-1">
                <img class="mb-4 h-12 w-auto" src="images/logoh.png" alt="Artsygalley Logo" />
                <p class="text-gray-400 leading-relaxed">
                    The world's premier and largest digital marketplace for crypto collectibles and non-fungible
                    tokens (NFTs). Explore, buy, and sell unique digital items.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Home</h4>
                <ul class="space-y-2">
                    <li><a href="{{route('homepage')}}" class="text-gray-400 hover:text-white transition-colors">Homepage</a></li>
                    <li><a href="{{route('about')}}" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                    <li><a href="{{route('contact')}}" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Profile</h4>
                <ul class="space-y-2">
                    @if (auth()->check())
                        <li><a href="{{route('home')}}" class="text-gray-400 hover:text-white transition-colors">Register</a></li>
                        <li><a href="{{route('home')}}" class="text-gray-400 hover:text-white transition-colors">Login</a></li>
                    @else
                        <li><a href="{{route('register')}}" class="text-gray-400 hover:text-white transition-colors">Register</a></li>
                        <li><a href="{{route('login')}}" class="text-gray-400 hover:text-white transition-colors">Login</a></li>
                    @endif
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Security</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Activity</a></li>
                </ul>
            </div>
            <div class="lg:col-span-1">
                <h4 class="font-bold text-lg mb-4">Learn</h4>
                <div class="grid grid-cols-2 gap-4">
                    <ul class="space-y-2">
                        <li><a href="{{route('what')}}" class="text-gray-400 hover:text-white transition-colors text-sm">What is an NFT?</a></li>
                        <li><a href="{{route('how')}}" class="text-gray-400 hover:text-white transition-colors text-sm">How to buy an NFT</a></li>
                        <li><a href="{{route('drops')}}" class="text-gray-400 hover:text-white transition-colors text-sm">What are NFT drops?</a></li>
                        <li><a href="{{route('what-is-crypto-wallet')}}" class="text-gray-400 hover:text-white transition-colors text-sm">What is a crypto wallet?</a></li>
                    </ul>
                    <ul class="space-y-2">
                        <li><a href="{{route('what-is-cryptocurrency')}}" class="text-gray-400 hover:text-white transition-colors text-sm">What is cryptocurrency?</a></li>
                        <li><a href="{{route('nft-gas-fees')}}" class="text-gray-400 hover:text-white transition-colors text-sm">What are blockchain gas fees?</a></li>
                        <li><a href="{{route('what-is-web3')}}" class="text-gray-400 hover:text-white transition-colors text-sm">What is web3?</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-gray-400 text-sm">
                        © Copyright 2024 <a href="#" class="text-white hover:text-primary transition-colors">Artsygalley</a>
                        All Rights Reserved
                    </p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
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
