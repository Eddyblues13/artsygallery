@include('home.header')
<!--  Create Section -->


<div class="intro section-padding" id="home">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="intro-content my-5">
                    <h1 class="mb-3">
                        What is <span>web3?</span>
                    </h1>
                    <p>Web3 is the name given to the concept of a decentralized internet built on blockchain technology.
                        If web 1.0 was the creation of the internet and web 2.0 saw us move to a social platform-centric
                        internet, web3 signifies a shift into a decentralized, public internet centered on the concept
                        of ownership.</p>
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
                        <img src="images/items/web3.png" alt="" class="img-fluid" />
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
                    <p>
                        A blockchain is a decentralized record that gets its name from how it stores its data. Once a
                        set
                        of transaction data reaches a certain size, it forms a "block.” This is where every transaction
                        on a blockchain is validated and then permanently stored. The “chain” part of a blockchain is a
                        series of consecutive blocks linked together, forming the immutable ledger.
                    </p>

                    <p>
                        Web3, in essence, puts control and ownership back in the hands of the people using it, ideally
                        creating a more equal playing field for users with less outside control from third parties. The
                        term web3 has become shorthand for all of the elements that make up this ecosystem, including
                        cryptocurrency, blockchain technology, decentralized finance (known as “DeFi”), NFTs, the
                        metaverse, and decentralized apps (“dApps”).
                    </p>

                </div>

                <div class="intro-content my-5">
                    <h1 class="mb-3">
                        <span>What is web3?</span>
                    </h1>
                    <b>In 2014, Gavin Wood, co-founder of the Ethereum blockchain and the Web3 Foundation, coined the
                        term in a blog post. He wrote:

                        Web 3.0, or as might be termed the “post-Snowden” web, is a re-imagination of the sorts of
                        things we already use the web for, but with a fundamentally different model for the interactions
                        between parties. Information that we assume to be public, we publish. Information we assume to
                        be agreed upon, we place on a consensus ledger. Information that we assume to be private, we
                        keep secret and never reveal. </b>

                </div>
            </div>
        </div>
    </div>
</div>
<!--  End Create Section --
@include('home.footer')