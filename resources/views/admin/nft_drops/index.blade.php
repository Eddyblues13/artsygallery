@extends('admin.layouts.app')

@section('content')
<!-- Content wrapper scroll start -->

<!-- Main header starts -->
<div class="main-header d-flex align-items-center justify-content-between position-relative mb-4">
    <div class="d-flex align-items-center justify-content-center">
        <div class="page-icon">
            <i class="bi bi-collection"></i>
        </div>
        <div class="page-title d-none d-md-block">
            <h5>NFT Drops Management</h5>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.nft-drops.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add New NFT Drop
        </a>
    </div>
</div>
<!-- Main header ends -->

<!-- Row start -->
<div class="row gx-3">
    @foreach($buy_nft as $my_nft)
    
        @php
            $currentDay = $my_nft->duration; // Get the current day or duration from the NFT
            $totalDays = \Carbon\Carbon::now()->daysInMonth(); // Get total days in the current month
            $progress = ($currentDay / $totalDays) * 100; // Calculate the progress percentage

            // Adjust the eth_value based on the is_positive flag
            if ($my_nft->is_positive) {
                $my_nft->eth_value += ($my_nft->eth_value * ($progress / 100)); // Increase eth_value
            } else {
                $my_nft->eth_value -= ($my_nft->eth_value * ($progress / 100)); // Decrease eth_value
            }
        @endphp
        
        <div class="col-lg-3 col-md-4 col-6 mb-4">
            <div class="card h-100">
                <img src="{{ asset($my_nft->image_url) }}" class="img-fluid card-img-top" alt="NFT Image"
                    style="height: 200px; width: 100%; object-fit: cover;">
                <div class="card-body position-relative pt-4">
                    <a href="{{ route('admin.nft-drops.edit', $my_nft->id) }}" class="btn btn-primary card-btn-floating">
                        <i class="bi bi-pencil-square m-0"> Edit</i>
                    </a>
                    <b>{{ $my_nft->name }}</b>
                    
                    <p class="mt-2">Owned by: @if($my_nft->name && $my_nft->email)
                        {{ $my_nft->name }} ({{ $my_nft->email }})
@else
    No owner
@endif
</p>

                </div>
                <div class="card-footer">
                    <div class="d-inline-flex gap-3">
                        <b>{{ number_format($my_nft->eth_value, 2) }} ETH Price</b>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="progress mt-3" style="height: 10px; border-radius: 5px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                         style="width: {{ $progress }}%; background: linear-gradient(45deg, #32cd32, #2e8b57);"
                         aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                        {{ number_format($progress, 2) }}%
                    </div>
                </div>

                <div class="card-footer">
                    <form action="{{ route('admin.nft-drops.destroy', $my_nft->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this NFT Drop?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- Row end -->


<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $buy_nft->links('admin.custom') }}
    <!-- Add pagination links with custom view -->
</div>
@endsection

@push('styles')
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
@endpush