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
            <h5>Add New NFT Drop</h5>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.nft-drops.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to NFT Drops
        </a>
    </div>
</div>
<!-- Main header ends -->

<!-- Form Start -->
<div class="row">
    <div class="col-lg-8 mx-auto">
        <form action="{{ route('admin.nft-drops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- NFT Name -->
            <div class="mb-3">
                <label for="name" class="form-label">NFT Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
                
                
                                                   <!-- User Search -->
            <div class="mb-3">
                <label for="user_search" class="form-label">Search for Owner</label>
                <input type="text" class="form-control" id="user_search" placeholder="Search by name or email">
                <input type="hidden" name="user_id" id="user_id">

                <div id="user_results" class="dropdown-menu show" style="display: none; width: 100%; max-height: 200px; overflow-y: auto;">
                    <!-- Search results will be inserted here -->
                </div>

                @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- NFT Image -->
            <div class="mb-3">
                <label for="image_url" class="form-label">NFT Image</label>
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
                <input type="number" step="0.01" class="form-control @error('change') is-invalid @enderror"
                    id="change" name="change" value="{{ old('change') }}" required>
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
                    <option value="1" {{ old('is_positive') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_positive') == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('is_positive')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Create NFT Drop</button>
        </form>
    </div>
</div>
<!-- Form End -->


<script>
// JavaScript for handling the search input and results
document.getElementById('user_search').addEventListener('input', function () {
    const query = this.value;
    if (query.length < 2) return; // Start search after 2 characters

    fetch(`{{ route('admin.user.search') }}?query=${query}`, {
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        const resultsContainer = document.getElementById('user_results');
        resultsContainer.innerHTML = ''; // Clear previous results

        data.forEach(user => {
            const userOption = document.createElement('a');
            userOption.classList.add('dropdown-item');
            userOption.href = '#';
            userOption.textContent = `${user.name} (${user.email})`;
            userOption.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('user_search').value = `${user.name} (${user.email})`;
                document.getElementById('user_id').value = user.id;
                resultsContainer.style.display = 'none'; // Hide the dropdown
            });
            resultsContainer.appendChild(userOption);
        });

        resultsContainer.style.display = data.length ? 'block' : 'none';
    })
    .catch(error => console.error('Error fetching user search:', error));
});
</script>

@endsection

