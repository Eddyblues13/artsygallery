@include('home.header')
<!--  Create Section -->


<div class="intro section-padding" id="home">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-content my-5">
                    <h1 class="mb-3">
                        How to buy an<span> NFT?</span>
                    </h1>
                    <p>In order to buy an NFT, you'll need a crypto wallet and cryptocurrency (or, in some cases, just a
                        credit or debit card). Using OpenSea, you can buy items listed for sale instantly, bid in
                        auctions, or make offers on any NFTs.</p>
                    <div class="intro-btn mt-5">
                        <a class="btn btn-primary" href="#explore">Explore<i class="bi bi-arrow-right"></i>
                        </a>
                        <a class="btn btn-outline-primary" href="{{route('login')}}">Create</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-slider">
                    <div class="slider-item">
                        <img src="images/items/how.png" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End Create Section --
@include('home.footer')