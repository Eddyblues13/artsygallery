@extends('home.header') <!-- Assuming you have a layout -->

<!-- Create Section -->
<div class="intro section-padding" id="home">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-content my-5">
                    <h1 class="mb-3">
                        What are<span> NFT drops?</span>
                    </h1>
                    <p>An NFT drop happens when a new NFT collection is released. NFT drops can vary in both how the
                        NFTs are sold
                        (listed for sale or auction), and in who they’re released to (the public, or a specific list
                        called an
                        “allowlist”).
                    </p>
                    <p>
                        Often, NFT drops coincide with when the NFTs in the collection are minted, that is, written to
                        the
                        blockchain. You might hear these terms used interchangeably— a drop might be referred to as the
                        project’s
                        mint.
                    </p>
                    <div class="intro-btn mt-5">
                        <a class="btn btn-primary" href="#explore">Explore<i class="bi bi-arrow-right"></i></a>
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">Create</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-slider">
                    <div class="slider-item">
                        <img src="{{ asset('images/items/drops.png') }}" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Create Section -->

<!-- Collections -->
<div class="top-collection section-padding" id="collection">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center">
                    <h2>NFT Drops</h2>
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
                                    <img class="img-fluid" src="{{ asset($drop->image_url) }}" alt="{{ $drop->name }}" width="70" />
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

@include('home.footer')

