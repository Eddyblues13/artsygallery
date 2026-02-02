@include('admin.dashboard_header')

<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle fw-bold">Edit Digital Asset</h1>
        </div>

        <div class="row">
            <!-- Left Column: Form Details -->
            <div class="col-12 col-xl-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="card-title mb-0">Asset Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update.nft', $nft->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">NFT Name</label>
                                    <input type="text" class="form-control form-control-lg" name="ntf_name" value="{{ $nft->ntf_name }}" required placeholder="Enter NFT name">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Price (USD)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" name="nft_price" value="{{ $nft->nft_price }}" step="0.01" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Availability Status</label>
                                    <select class="form-select" name="status">
                                        <option value="0" {{ $nft->status == '0' ? 'selected' : '' }}>Pending Approval</option>
                                        <option value="1" {{ $nft->status == '1' ? 'selected' : '' }}>Approved / Active</option>
                                        <option value="2" {{ $nft->status == '2' ? 'selected' : '' }}>Sold</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control" name="ntf_description" rows="5" required placeholder="Describe this artwork...">{{ $nft->ntf_description }}</textarea>
                                </div>

                                <div class="col-12 mt-4 pt-2 border-top">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary px-4 py-2">
                                            <i class="align-middle me-1" data-feather="save"></i> Save Changes
                                        </button>
                                        <a href="{{ route('users.uploaded.nft') }}" class="btn btn-outline-secondary px-4 py-2">Cancel</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Media Preview -->
            <div class="col-12 col-xl-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="card-title mb-0">Asset Preview</h5>
                    </div>
                    <div class="card-body text-center p-4">
                        <div class="image-preview-container mb-4 mx-auto">
                            <!-- Image Display Logic -->
                            @if(Str::startsWith($nft->ntf_image, ['http', 'https']))
                                <img src="{{ $nft->ntf_image }}" 
                                     class="img-fluid rounded shadow-sm nft-preview-img" 
                                     id="current-nft-img"
                                     alt="Current NFT">
                            @else
                                <img src="{{ asset('user/uploads/nfts/' . $nft->ntf_image) }}" 
                                     class="img-fluid rounded shadow-sm nft-preview-img" 
                                     id="current-nft-img"
                                     alt="Current NFT"
                                     onerror="this.src='https://via.placeholder.com/400?text=NFT+Image'">
                            @endif
                        </div>

                        <div class="text-start">
                            <label class="form-label fw-semibold">Replace Image</label>
                            <div class="input-group input-group-sm">
                                <input type="file" class="form-control" name="image" id="imageInput" accept="image/*">
                            </div>
                            <small class="text-muted mt-2 d-block">Recommended: Square format, high resolution (Max 5MB)</small>
                        </div>
                    </div>
                    </form> <!-- Form ends here -->
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .image-preview-container {
        max-width: 300px;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 10px;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .nft-preview-img {
        max-height: 280px;
        width: 100%;
        object-fit: contain;
    }
    .form-label {
        font-size: 0.875rem;
        color: #495057;
    }
    .btn-primary {
        background: #3b7ddd;
        border-color: #3b7ddd;
    }
</style>

<script>
    document.getElementById('imageInput').onchange = evt => {
        const [file] = evt.target.files;
        if (file) {
            document.getElementById('current-nft-img').src = URL.createObjectURL(file);
        }
    }
</script>

@include('dashboard.footer')
