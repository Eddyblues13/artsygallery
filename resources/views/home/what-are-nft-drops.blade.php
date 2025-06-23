@include('home.header')
<!--  Create Section -->


<div class="intro section-padding" id="home">
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-xl-5 col-lg-6 col-12">
        <div class="intro-content my-5">
          <h1 class="mb-3">
            What are<span> NFT drops?</span>
          </h1>
          <p>An NFT drop happens when a new NFT collection is released. NFT drops can vary in both how the NFTs are sold
            (listed for sale or auction), and in who they’re released to (the public, or a specific list called an
            “allowlist”).
          </p>
          <p>

            Often, NFT drops coincide with when the NFTs in the collection are minted, that is, written to the
            blockchain. You might hear these terms used interchangeably— a drop might be referred to as the project’s
            mint.</p>
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
            <img src="images/items/drops.png" alt="" class="img-fluid" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--  End Create Section --
@include('home.footer')