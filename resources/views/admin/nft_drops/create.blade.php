@extends('admin.layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Main header starts -->
<div class="main-header d-flex align-items-center justify-content-between position-relative mb-4">
    <div class="d-flex align-items-center justify-content-center">
        <div class="page-icon">
            <i class="bi bi-plus-lg"></i>
        </div>
        <div class="page-title d-none d-md-block">
            <h5>Add New Notable Drop</h5>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.nft-drops.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Notable Drops
        </a>
    </div>
</div>
<!-- Main header ends -->

<!-- Form Start -->
<div class="row">
    <div class="col-lg-8 mx-auto">
        <form action="{{ route('admin.nft-drops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Drop Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Drop Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Drop Image -->
            <div class="mb-3">
                <label for="image_url" class="form-label">Drop Image</label>
                <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url"
                    name="image_url" required>
                @error('image_url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- ETH Value -->
            <div class="mb-3">
                <label for="eth_value" class="form-label">ETH Value</label>
                <input type="number" step="0.01" class="form-control @error('eth_value') is-invalid @enderror"
                    id="eth_value" name="eth_value" value="{{ old('eth_value') }}" required>
                @error('eth_value')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price Change -->
            <div class="mb-3">
                <label for="change" class="form-label">Price Change (ETH)</label>
                <input type="number" step="0.01" class="form-control @error('change') is-invalid @enderror" id="change"
                    name="change" value="{{ old('change') }}" required>
                @error('change')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Duration -->
            <div class="mb-3">
                <label for="duration" class="form-label">Duration (Number of Days)</label>
                <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration"
                    name="duration" value="{{ old('duration') }}" required>
                @error('duration')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Is Price Change Positive -->
            <div class="mb-3">
                <label for="is_positive" class="form-label">Is Price Change Positive?</label>
                <select class="form-control @error('is_positive') is-invalid @enderror" id="is_positive"
                    name="is_positive" required>
                    <option value="1" {{ old('is_positive')=='1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_positive')=='0' ? 'selected' : '' }}>No</option>
                </select>
                @error('is_positive')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Create Notable Drop</button>
        </form>
    </div>
</div>
<!-- Form End -->

@endsection