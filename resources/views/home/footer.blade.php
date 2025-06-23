<!-- Footer -->
<div class="bottom section-padding triangle-top-dark triangle-bottom-dark">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-7 col-sm-8">
                <div class="bottom-logo">
                    <img class="pb-3" src="images/logoh.png" alt="" />
                    <p>
                        The world's premier and largest digital marketplace for crypto collectibles and non-fungible
                        tokens (NFTs). Explore, buy, and sell unique digital items.
                    </p>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-5 col-sm-4 col-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Home</h4>
                    <ul>
                        <li><a href="{{route('homepage')}}">Homepage</a></li>
                        <li><a href="{{route('drop')}}">Drop</a></li>
                        <li><a href="{{route('about')}}">About</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Profile</h4>
                    <ul>

                        @if (auth()->check())
                        <li><a href="{{route('home')}}">Register</a></li>
                        <li><a href="{{route('home')}}">Login</a></li>
                        @else
                        <li><a href="{{route('register')}}">Register</a></li>
                        <li><a href="{{route('login')}}">Login</a></li>
                        @endif

                        <li><a href="#">Security</a></li>
                        <li><a href="#">Activity</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8">
                <div class="bottom-widget">
                    <h4 class="widget-title">Learn</h4>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <ul>
                                <li><a href="{{route('what')}}">What is an NFT?
                                    </a></li>
                                <li><a href="{{route('how')}}">How to buy an NFT</a></li>
                                <li><a href="{{route('drops')}}">What are NFT drops?</a></li>
                                <li><a href="{{route('what-is-crypto-wallet')}}">What is a crypto wallet?</a></li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <ul>
                                <li><a href="{{route('what-is-cryptocurrency')}}">What is cryptocurrency?</a></li>
                                <li><a href="{{route('nft-gas-fees')}}">What are blockchain gas fees?
                                    </a></li>
                                <li><a href="{{route('what-is-web3')}}">What is web3?</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="copyright">
                    <p>
                        © Copyright 2024 <a href="#">Artsygalley</a>
                        All Rights Reserved
                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="footer-social">
                    <ul>
                        <li>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- End Main Wrapper -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>

</html>