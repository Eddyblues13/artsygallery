@include('home.header')
<!-- Home Section -->

<div class="intro section-padding" id="home">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-content my-5">
                    <h1 class="mb-3">
                        Discover, collect, and sell<span> extraordinary NFTs</span>
                    </h1>
                    <p>on the world's first &amp; largest NFT marketplace</p>
                    <div class="intro-btn mt-5">
                        <a class="btn btn-primary" href="#explore">Explore<i class="bi bi-arrow-right"></i>
                        </a>
                        <a class="btn btn-outline-primary" href="{{route('login')}}">Create</a>
                    </div>
                    <a class="more c-pointer d-inline-flex" href="{{route('about')}}">
                        <span><i class="bi bi-play-fill"></i></span>
                        Learn more about Artsygalley</a>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-slider">
                    <div class="slider-item">
                        <img src="images/items/9.jpg" alt="" class="img-fluid" />
                        <div class="slider-item-avatar">
                            <a href="#categories"><img src="images/avatar/1.jpg" alt="" /></a>
                            <div>
                                <h5>The Sandbox</h5>
                                <p>Sound Box</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Home Section -->

<!-- Explore Section -->
<div class="notable-drops section-padding bg-light triangle-top-light triangle-bottom-light" id="explore">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-title text-center d-flex justify-content-between mb-3">
                    <h2>Notable Drops</h2>
                </div>
            </div>
        </div>
        <!--<div class="row">-->
        <!--    @foreach($nftDrops as $index => $drop)-->
        <!--        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">-->
        <!--            <div class="card h-100">-->
        <!-- Add a class to ensure all images have consistent dimensions -->
        <!--                <img class="img-fluid card-img-top" style="height: 200px; object-fit: cover;" src="{{ asset($drop->image_url) }}" alt="{{ $drop->name }}" />-->
        <!--                <div class="card-body">-->
        <!--                    <h4 class="card-title">{{ $drop->name }}</h4>-->
        <!--                    <p class="text-muted">-->
        <!--                        <img src="{{ asset('images/svg/eth.svg') }}" alt="" width="10" class="me-2" />-->
        <!--                        {{ number_format($drop->eth_value, 2) }} ETH-->
        <!--                    </p>-->
        <!--                    <h5 class="{{ $drop->is_positive ? 'text-success' : 'text-danger' }}">-->
        <!--                        {{ $drop->is_positive ? '+' : '-' }}{{ number_format(abs($drop->change), 2) }}%-->
        <!--                    </h5>-->
        <!--                    <a href="#explore">Explore<i class="bi bi-arrow-right-short"></i></a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    @endforeach-->
        <!--</div>-->


        <div class="row">
            @foreach($nftDrops as $index => $drop)
            @php
            $currentDay = \Carbon\Carbon::now()->day; // Get the current day
            $totalDays = \Carbon\Carbon::now()->daysInMonth; // Get total days in the current month
            $progress = ($currentDay / $totalDays) * 100; // Calculate the progress percentage

            // Adjust the eth_value based on the is_positive flag
            if ($drop->is_positive) {
            $drop->eth_value += ($drop->eth_value * ($progress / 100)); // Increase eth_value
            } else {
            $drop->eth_value -= ($drop->eth_value * ($progress / 100)); // Decrease eth_value
            }
            @endphp
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                <!-- Adjusted grid classes -->
                <div class="card h-100">
                    <img class="img-fluid card-img-top" style="height: 200px; object-fit: cover;"
                        src="{{ asset($drop->image_url) }}" alt="{{ $drop->name }}" />
                    <div class="card-body">
                        <h4 class="card-title">{{ $drop->name }}</h4>
                        <p class="text-muted">
                            <img src="{{ asset('images/svg/eth.svg') }}" alt="" width="10" class="me-2" />
                            {{ number_format($drop->eth_value, 2) }} ETH
                        </p>
                        <h5 class="{{ $drop->is_positive ? 'text-success' : 'text-danger' }}">
                            {{ $drop->is_positive ? '+' : '-' }}{{ number_format(abs($drop->change), 2) }}%
                        </h5>

                        <!-- Progress Bar -->
                        <div class="progress mt-3" style="height: 10px; border-radius: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: {{ $progress }}%; background: linear-gradient(45deg, #32cd32, #2e8b57);"
                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                {{ number_format($progress, 2) }}%
                            </div>
                        </div>
                        <a href="#explore" class="btn btn-primary mt-3">Explore <i
                                class="bi bi-arrow-right-short"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </div>



</div>
</div>
<!-- End Explore Section -->

<!-- Collections -->

<div class="top-collection section-padding" id="collection">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center">
                    <h2>Top collections over last 7 days</h2>
                    <p>Here are a few reasons why you should choose Artsygalley</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            @foreach($nftDrops as $index => $drop)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <a class="top-collection-content d-block" href="#collection">
                    <div class="d-flex align-items-center">
                        <span class="serial">{{ $index + 1 }}.</span>
                        <div class="flex-shrink-0">
                            <span class="top-img">
                                <img class="img-fluid" src="{{ asset($drop->image_url) }}" alt="{{ $drop->name }}"
                                    width="70" />
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>{{ $drop->name }}</h5>
                            <p class="text-muted">
                                <img src="{{ asset('images/svg/eth.svg') }}" alt="" width="10" class="me-2" />
                                {{ number_format($drop->eth_value, 2) }}
                            </p>
                        </div>
                        <h5 class="{{ $drop->is_positive ? 'text-success' : 'text-danger' }}">
                            {{ $drop->is_positive ? '+' : '-' }}
                            {{ number_format(abs($drop->change), 2) }}
                        </h5>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- End Collections -->

<!-- Trending -->

<div class="trending-category section-padding bg-light triangle-top-light triangle-bottom-light" id="trending">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-title text-center d-flex justify-content-between mb-3">
                    <h2>Trending Items</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card items">
                    <div class="card-body">
                        <div class="items-img position-relative">
                            <img src="images/items/5.jpg" class="img-fluid rounded mb-3" alt="" />
                            <a href="#categories"><img src="images/avatar/1.jpg" class="creator" width="50"
                                    alt="" /></a>
                        </div>
                        <a href="#">
                            <h4 class="card-title">Liguid Wave</h4>
                        </a>
                        <p></p>
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="mb-2">Auction</p>
                                <h5 class="text-muted">3h 1m 50s</h5>
                            </div>
                            <div class="text-end">
                                <p class="mb-2">
                                    Bid :<strong class="text-primary">0.55 ETH</strong>
                                </p>
                                <h5 class="text-muted">0.55 ETH</h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a class="btn btn-primary" href="#">Place a Bid</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card items">
                    <div class="card-body">
                        <div class="items-img position-relative">
                            <img src="images/items/6.jpg" class="img-fluid rounded mb-3" alt="" />
                            <a href="#categories"><img src="images/avatar/2.jpg" class="creator" width="50"
                                    alt="" /></a>
                        </div>
                        <a href="#">
                            <h4 class="card-title">Liguid Wave</h4>
                        </a>
                        <p></p>
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="mb-2">Auction</p>
                                <h5 class="text-muted">3h 1m 50s</h5>
                            </div>
                            <div class="text-end">
                                <p class="mb-2">
                                    Bid :<strong class="text-primary">0.55 ETH</strong>
                                </p>
                                <h5 class="text-muted">0.55 ETH</h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a class="btn btn-primary" href="#">Place a Bid</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card items">
                    <div class="card-body">
                        <div class="items-img position-relative">
                            <img src="images/items/7.jpg" class="img-fluid rounded mb-3" alt="" />
                            <a href="#categories"><img src="images/avatar/3.jpg" class="creator" width="50"
                                    alt="" /></a>
                        </div>
                        <a href="#">
                            <h4 class="card-title">Liguid Wave</h4>
                        </a>
                        <p></p>
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="mb-2">Auction</p>
                                <h5 class="text-muted">3h 1m 50s</h5>
                            </div>
                            <div class="text-end">
                                <p class="mb-2">
                                    Bid :<strong class="text-primary">0.55 ETH</strong>
                                </p>
                                <h5 class="text-muted">0.55 ETH</h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a class="btn btn-primary" href="#">Place a Bid</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card items">
                    <div class="card-body">
                        <div class="items-img position-relative">
                            <img src="images/items/8.jpg" class="img-fluid rounded mb-3" alt="" />
                            <a href="#categories"><img src="images/avatar/4.jpg" class="creator" width="50"
                                    alt="" /></a>
                        </div>
                        <a href="#">
                            <h4 class="card-title">Liguid Wave</h4>
                        </a>
                        <p></p>
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <p class="mb-2">Auction</p>
                                <h5 class="text-muted">3h 1m 50s</h5>
                            </div>
                            <div class="text-end">
                                <p class="mb-2">
                                    Bid :<strong class="text-primary">0.55 ETH</strong>
                                </p>
                                <h5 class="text-muted">0.55 ETH</h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a class="btn btn-primary" href="#">Place a Bid</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Trending -->

<!--  Create Section -->

<div class="create-sell section-padding" id="create">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center">
                    <h2>Create and sell your NFTs</h2>
                    <p>Here are a few reasons why you should choose Artsygalley</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="create-sell-content">
                    <div class="create-sell-content-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <h4>Set up your wallet</h4>
                        <p>
                            Once you’ve set up your wallet of choice, connect it to
                            Artsygalley by clicking the wallet icon in the top right corner.
                            Learn about the wallets we support.
                        </p>
                        <a href="#explore">Explore<i class="bi bi-arrow-right-short"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="create-sell-content">
                    <div class="create-sell-content-icon">
                        <i class="bi bi-x-diamond"></i>
                    </div>
                    <div>
                        <h4>Create your collection</h4>
                        <p>
                            Click My Collections and set up your collection. Add social
                            links, a description, profile &amp; banner images, and set a
                            secondary sales fee.
                        </p>
                        <a href="#explore">Explore<i class="bi bi-arrow-right-short"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="create-sell-content">
                    <div class="create-sell-content-icon">
                        <i class="bi bi-circle-half"></i>
                    </div>
                    <div>
                        <h4>Add your NFTs</h4>
                        <p>
                            Upload your work (image, video, audio, or 3D art), add a
                            title and description, and customize your NFTs with
                            properties, stats, and unlockable content.
                        </p>
                        <a href="#explore">Explore<i class="bi bi-arrow-right-short"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="create-sell-content">
                    <div class="create-sell-content-icon">
                        <i class="bi bi-circle-half"></i>
                    </div>
                    <div>
                        <h4>List them for sale</h4>
                        <p>
                            Choose between auctions, fixed-price listings, and
                            declining-price listings. You choose how you want to sell
                            your NFTs, and we help you sell them!
                        </p>
                        <a href="#explore">Explore<i class="bi bi-arrow-right-short"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End Create Section -->

<!-- Categories Section -->
<div class="browse-category section-padding border-top" id="categories">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center">
                    <h2>Browse by category</h2>
                    <p>Here are a few reasons why you should choose Artsygalley</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="card browse-cat">
                    <img class="img-fluid card-img-top" src="images/items/9.jpg" alt="" />
                    <div class="card-body">
                        <h4>Art</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="card browse-cat">
                    <img class="img-fluid card-img-top" src="images/items/10.jpg" alt="" />
                    <div class="card-body">
                        <h4>Collectibles</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="card browse-cat">
                    <img class="img-fluid card-img-top" src="images/items/11.jpg" alt="" />
                    <div class="card-body">
                        <h4>Domain Names</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="card browse-cat">
                    <img class="img-fluid card-img-top" src="images/items/12.jpg" alt="" />
                    <div class="card-body">
                        <h4>Music</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="card browse-cat">
                    <img class="img-fluid card-img-top" src="images/items/13.jpg" alt="" />
                    <div class="card-body">
                        <h4>Photography</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="card browse-cat">
                    <img class="img-fluid card-img-top" src="images/items/14.jpg" alt="" />
                    <div class="card-body">
                        <h4>Sports</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="card browse-cat">
                    <img class="img-fluid card-img-top" src="images/items/15.jpg" alt="" />
                    <div class="card-body">
                        <h4>Trading Cards</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="card browse-cat">
                    <img class="img-fluid card-img-top" src="images/items/16.jpg" alt="" />
                    <div class="card-body">
                        <h4>Utility</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--End Categories Section -->

@include('home.footer')