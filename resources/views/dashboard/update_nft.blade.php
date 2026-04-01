@include('dashboard.header')

<style>
    .edit-container {
        max-width: 720px;
        margin: 0 auto;
    }

    .edit-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 6px 16px rgba(0, 0, 0, 0.04);
    }

    .edit-card .card-body {
        padding: 2rem;
    }

    .form-label-styled {
        font-weight: 600;
        font-size: 0.85rem;
        color: #344054;
        margin-bottom: 0.4rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3b7ddd;
        box-shadow: 0 0 0 3px rgba(59, 125, 221, 0.15);
    }

    /* Current / new image preview */
    .image-preview-box {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        position: relative;
    }

    .image-preview-box img {
        width: 100%;
        max-height: 300px;
        object-fit: contain;
        display: block;
    }

    .image-preview-box .image-label {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(0, 0, 0, 0.55);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 100px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .image-change-zone {
        border: 2px dashed #d0d5dd;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        background: #fafbfc;
    }

    .image-change-zone:hover {
        border-color: #3b7ddd;
        background: #f0f6ff;
    }

    .image-change-zone .browse-link {
        color: #3b7ddd;
        font-weight: 600;
        text-decoration: underline;
    }

    /* Progress */
    .upload-progress {
        display: none;
        margin-top: 1rem;
    }

    .progress-track {
        height: 8px;
        background: #e5e7eb;
        border-radius: 100px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #3b7ddd, #5a9cf5);
        border-radius: 100px;
        transition: width 0.15s linear;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }

    .btn-update {
        background: linear-gradient(135deg, #3b7ddd 0%, #5a9cf5 100%);
        border: none;
        color: #fff;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.2s;
        width: 100%;
    }

    .btn-update:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(59, 125, 221, 0.35);
        color: #fff;
    }

    .btn-update:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    @media (max-width: 575.98px) {
        .edit-card .card-body {
            padding: 1.25rem;
        }

        .image-preview-box img {
            max-height: 220px;
        }
    }
</style>

<main class="content">
    <div class="container-fluid p-0">
        @include('dashboard.alert')

        <div class="edit-container">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('my.nft') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                    Back
                </a>
                <h1 class="h3 mb-0">Edit NFT</h1>
            </div>

            <div class="card edit-card">
                <div class="card-body">
                    <form id="updateForm" action="{{ url('nft/update/' . $nft->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Current Image -->
                        <div class="mb-4">
                            <label class="form-label-styled">Artwork Image</label>
                            <div class="image-preview-box mb-3" id="currentImageBox">
                                <span class="image-label" id="imageLabel">Current</span>
                                @php
                                $imgSrc = $nft->ntf_image;
                                if ($imgSrc && !str_starts_with($imgSrc, 'http')) {
                                $imgSrc = asset('user/uploads/nfts/' . $imgSrc);
                                }
                                @endphp
                                <img id="previewImg" src="{{ $imgSrc }}" alt="{{ $nft->ntf_name }}">
                            </div>

                            <div class="image-change-zone" id="changeZone"
                                onclick="document.getElementById('imageInput').click()">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3b7ddd"
                                    stroke-width="2" class="mb-1">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="17 8 12 3 7 8" />
                                    <line x1="12" y1="3" x2="12" y2="15" />
                                </svg>
                                <p class="mb-0 small text-muted"><span class="browse-link">Choose new image</span> or
                                    drag & drop</p>
                            </div>
                            <input type="file" id="imageInput" name="image" accept="image/*" class="d-none">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-styled">NFT Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="ntf_name" value="{{ $nft->ntf_name }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-styled">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="ntf_description" rows="3"
                                required>{{ $nft->ntf_description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-styled">Price ({{ $activeCurrency->currency_code ?? 'USD' }}) <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">{{ $activeCurrency->currency_symbol ?? '$' }}</span>
                                <input type="number" class="form-control" name="ntf_price_usd"
                                    value="{{ $nft->nft_price }}" step="0.01" min="0" required>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="upload-progress" id="uploadProgress">
                            <div class="progress-track">
                                <div class="progress-fill" id="progressFill"></div>
                            </div>
                            <div class="progress-label">
                                <span id="progressText">Uploading...</span>
                                <span id="progressPercent">0%</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-update mt-3" id="submitBtn">Update NFT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const previewImg = document.getElementById('previewImg');
    const imageLabel = document.getElementById('imageLabel');
    const changeZone = document.getElementById('changeZone');

    // Drag & drop on change zone
    ['dragenter','dragover'].forEach(evt => {
        changeZone.addEventListener(evt, e => { e.preventDefault(); changeZone.style.borderColor = '#3b7ddd'; changeZone.style.background = '#f0f6ff'; });
    });
    ['dragleave','drop'].forEach(evt => {
        changeZone.addEventListener(evt, e => { e.preventDefault(); changeZone.style.borderColor = '#d0d5dd'; changeZone.style.background = '#fafbfc'; });
    });
    changeZone.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (files.length && files[0].type.startsWith('image/')) {
            imageInput.files = files;
            showNewPreview(files[0]);
        }
    });

    imageInput.addEventListener('change', function() {
        if (this.files.length) showNewPreview(this.files[0]);
    });

    function showNewPreview(file) {
        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            imageLabel.textContent = 'New';
            imageLabel.style.background = 'rgba(59,125,221,0.85)';
        };
        reader.readAsDataURL(file);
    }

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024, sizes = ['B','KB','MB','GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    // AJAX submit with two-phase progress
    $('#updateForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const progressEl = document.getElementById('uploadProgress');
        const progressFill = document.getElementById('progressFill');
        const progressPercent = document.getElementById('progressPercent');
        const progressText = document.getElementById('progressText');
        const submitBtn = document.getElementById('submitBtn');

        // Only show progress if there's a file
        const hasFile = imageInput.files.length > 0;
        var processingTimer = null;
        var currentPct = 0;

        function setProgress(pct, text) {
            currentPct = pct;
            progressFill.style.width = pct + '%';
            progressPercent.textContent = pct + '%';
            if (text) progressText.textContent = text;
        }

        function startProcessingAnimation() {
            progressFill.style.transition = 'width 0.5s ease-out';
            progressText.textContent = 'Processing on server...';
            var target = 71;
            processingTimer = setInterval(function() {
                if (target < 95) {
                    target += Math.random() * 2 + 0.5;
                    if (target > 95) target = 95;
                    setProgress(Math.round(target));
                }
            }, 800);
        }

        if (hasFile) {
            progressEl.style.display = 'block';
            progressFill.style.width = '0%';
            progressFill.style.transition = 'width 0.15s linear';
            progressFill.style.background = 'linear-gradient(90deg, #3b7ddd, #5a9cf5)';
        }
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Updating...';

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                if (hasFile) {
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var realPct = evt.loaded / evt.total;
                            var displayPct = Math.round(realPct * 70);
                            setProgress(displayPct, 'Uploading... (' + formatBytes(evt.loaded) + ' / ' + formatBytes(evt.total) + ')');
                            if (realPct >= 1) {
                                startProcessingAnimation();
                            }
                        }
                    }, false);
                }
                return xhr;
            },
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            success: function() {
                clearInterval(processingTimer);
                if (hasFile) {
                    progressFill.style.transition = 'width 0.3s ease';
                    setProgress(100, 'Complete!');
                    progressFill.style.background = 'linear-gradient(90deg, #28a745, #34d058)';
                }
                Swal.fire({
                    title: 'Updated!',
                    text: 'Your NFT has been updated successfully.',
                    icon: 'success',
                    confirmButtonColor: '#3b7ddd'
                }).then(() => location.href = "{{ route('my.nft') }}");
            },
            error: function(response) {
                clearInterval(processingTimer);
                if (hasFile) {
                    progressFill.style.background = '#dc3545';
                    progressText.textContent = 'Update failed';
                }
                submitBtn.disabled = false;
                submitBtn.textContent = 'Update NFT';
                let msg = 'There was an error updating your NFT.';
                if (response.responseJSON && response.responseJSON.message) msg = response.responseJSON.message;
                Swal.fire({ title: 'Update Failed', text: msg, icon: 'error' });
            }
        });
    });
});
</script>

@include('dashboard.footer')