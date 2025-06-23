@include('home.header')
<!--  Create Section -->


<div class="intro section-padding" id="home">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-content my-5">
                    <h1 class="mb-3">
                        What is <span>blockchain?</span>
                    </h1>
                    <p>A blockchain is a digitally distributed ledger that records transactions and information across a
                        decentralized network. There are different types of blockchains. OpenSea is compatible with the
                        Ethereum, Polygon, Klaytn, Arbitrum, Optimism, Avalanche, and BNB Chain blockchains.</p>
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
                        <img src="images/items/block.png" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro section-padding" id="home">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-content my-5">
                    <h1 class="mb-3">
                        <span>What is a blockchain? </span>
                    </h1>
                    <p>A blockchain is a decentralized record that gets its name from how it stores its data. Once a set
                        of transaction data reaches a certain size, it forms a "block.” This is where every transaction
                        on a blockchain is validated and then permanently stored. The “chain” part of a blockchain is a
                        series of consecutive blocks linked together, forming the immutable ledger. </p>

                </div>

                <div class="intro-content my-5">
                    <h1 class="mb-3">
                        <span>What is a blockchain? </span>
                    </h1>
                    <p>A blockchain is a decentralized record that gets its name from how it stores its data. Once a set
                        of transaction data reaches a certain size, it forms a "block.” This is where every transaction
                        on a blockchain is validated and then permanently stored. The “chain” part of a blockchain is a
                        series of consecutive blocks linked together, forming the immutable ledger. </p>

                </div>
            </div>
        </div>
    </div>
</div>
<!--  End Create Section --
@include('home.footer')