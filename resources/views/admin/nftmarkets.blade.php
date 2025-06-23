@include('admin.header')
@include('admin.navbar')

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

    <!-- Main header starts -->
    <div class="main-header d-flex align-items-center justify-content-between position-relative">
        <div class="d-flex align-items-center justify-content-center">
            <div class="page-icon">
                <i class="bi bi-collection"></i>
            </div>
            <div class="page-title d-none d-md-block">
                <h5>NFT Market Place</h5>
            </div>
        </div>
    </div>
    <!-- Main header ends -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row gx-3">
            @foreach($buy_nft as $my_nft)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <img src="{{asset('user/uploads/nfts/'.$my_nft->ntf_image)}}" class="img-fluid card-img-top" alt="NFT Image" style="height: 200px; width: 100%; object-fit: cover;">
                        <div class="card-body position-relative pt-4">
                            <a href="{{'purchase_nft/'.$my_nft->id}}" class="btn btn-primary card-btn-floating">
                                <i class="bi bi-plus-lg m-0">Buy NFT</i>
                            </a>
                            <b>{{ $my_nft->ntf_name }}</b>
                        </div>
                        <div class="card-footer">
                            <div class="d-inline-flex gap-3">
                                <b>{{ number_format($my_nft->nft_eth_price, 2) }} ETH Floor</b>
                                <b>{{ number_format($my_nft->nft_eth_price, 2) }} ETH Volume</b>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Row end -->

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $buy_nft->links('admin.custom') }} <!-- Add pagination links with custom view -->
        </div>

    </div>
    <!-- Content wrapper end -->

</div>
<!-- Content wrapper scroll end -->

@include('admin.footer')

<style>
    .card {
        overflow: hidden;
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .pagination .page-link {
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
    }

    .page-item.disabled .page-link {
        cursor: not-allowed;
    }
</style>
