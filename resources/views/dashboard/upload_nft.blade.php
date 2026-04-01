@include('dashboard.header')

<style>
    .upload-container {
        max-width: 720px;
        margin: 0 auto;
    }

    /* Drop zone */
    .upload-drop-zone {
        border: 2px dashed #d0d5dd;
        border-radius: 16px;
        padding: 2.5rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        background: #fafbfc;
        position: relative;
    }

    .upload-drop-zone:hover,
    .upload-drop-zone.dragover {
        border-color: #3b7ddd;
        background: #f0f6ff;
    }

    .upload-drop-zone .drop-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #3b7ddd 0%, #5a9cf5 100%);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: #fff;
    }

    .upload-drop-zone .drop-icon svg {
        width: 24px;
        height: 24px;
    }

    .upload-drop-zone p {
        color: #667085;
        margin: 0;
    }

    .upload-drop-zone .browse-link {
        color: #3b7ddd;
        font-weight: 600;
        text-decoration: underline;
        cursor: pointer;
    }

    /* Preview */
    .preview-wrapper {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        display: none;
    }

    .preview-wrapper img {
        width: 100%;
        max-height: 360px;
        object-fit: contain;
        display: block;
    }

    .preview-overlay {
        position: absolute;
        top: 12px;
        right: 12px;
        display: flex;
        gap: 8px;
    }

    .preview-overlay .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        backdrop-filter: blur(8px);
        transition: transform 0.15s;
    }

    .preview-overlay .btn-icon:hover {
        transform: scale(1.1);
    }

    .btn-icon-remove {
        background: rgba(220, 53, 69, 0.85);
        color: #fff;
    }

    .preview-file-info {
        padding: 0.75rem 1rem;
        background: #f3f4f6;
        font-size: 0.8rem;
        color: #6b7280;
        display: flex;
        justify-content: space-between;
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

    /* Form polish */
    .upload-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 6px 16px rgba(0, 0, 0, 0.04);
    }

    .upload-card .card-body {
        padding: 2rem;
    }

    .form-label-styled {
        font-weight: 600;
        font-size: 0.85rem;
        color: #344054;
        margin-bottom: 0.4rem;
    }

    .form-control:focus {
        border-color: #3b7ddd;
        box-shadow: 0 0 0 3px rgba(59, 125, 221, 0.15);
    }

    .btn-upload {
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

    .btn-upload:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(59, 125, 221, 0.35);
        color: #fff;
    }

    .btn-upload:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    @media (max-width: 575.98px) {
        .upload-card .card-body {
            padding: 1.25rem;
        }

        .upload-drop-zone {
            padding: 1.5rem 1rem;
        }

        .preview-wrapper img {
            max-height: 240px;
        }
    }
</style>

<main class="content">
    <div class="container-fluid p-0">
        @include('dashboard.alert')

        <div class="upload-container">
            <div class="mb-4">
                <h1 class="h3 mb-1"><strong>Upload NFT</strong></h1>
                @if($activeCurrency ?? null)
                <p class="text-muted mb-0">Currency: {{ $activeCurrency->currency_name }} ({{
                    $activeCurrency->currency_symbol }})</p>
                @endif
            </div>

            <div class="card upload-card">
                <div class="card-body">
                    <form id="uploadForm" action="{{ route('save.nft') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Upload Area -->
                        <div class="mb-4">
                            <label class="form-label-styled">Artwork Image <span class="text-danger">*</span></label>

                            <div class="upload-drop-zone" id="dropZone">
                                <div class="drop-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="17 8 12 3 7 8" />
                                        <line x1="12" y1="3" x2="12" y2="15" />
                                    </svg>
                                </div>
                                <p class="mb-1"><span class="browse-link">Click to browse</span> or drag & drop</p>
                                <p class="small text-muted">PNG, JPG, GIF, SVG — Max 2MB</p>
                                <input type="file" id="imageInput" name="image" accept="image/*" required
                                    class="d-none">
                            </div>

                            <div class="preview-wrapper mt-3" id="previewWrapper">
                                <img id="previewImage" src="" alt="Preview">
                                <div class="preview-overlay">
                                    <button type="button" class="btn-icon btn-icon-remove" id="removeImage"
                                        title="Remove">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <line x1="18" y1="6" x2="6" y2="18" />
                                            <line x1="6" y1="6" x2="18" y2="18" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="preview-file-info">
                                    <span id="fileName">—</span>
                                    <span id="fileSize">—</span>
                                </div>
                            </div>
                        </div>

                        <!-- NFT Details -->
                        <div class="mb-3">
                            <label class="form-label-styled">NFT Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nft_name" placeholder="e.g. Cyber Ape #421"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-styled">Price ({{ $activeCurrency->currency_code ?? 'USD' }}) <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">{{ $activeCurrency->currency_symbol ?? '$' }}</span>
                                <input type="number" class="form-control" name="nft_price" placeholder="0.00"
                                    step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-styled">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="ntf_description" rows="3"
                                placeholder="Describe your artwork..." required></textarea>
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

                        <button type="submit" class="btn btn-upload mt-3" id="submitBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            Publish NFT
                        </button>
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
    const dropZone = document.getElementById('dropZone');
    const imageInput = document.getElementById('imageInput');
    const previewWrapper = document.getElementById('previewWrapper');
    const previewImage = document.getElementById('previewImage');
    const removeBtn = document.getElementById('removeImage');
    const fileNameEl = document.getElementById('fileName');
    const fileSizeEl = document.getElementById('fileSize');

    // Click to browse
    dropZone.addEventListener('click', () => imageInput.click());

    // Drag & drop
    ['dragenter','dragover'].forEach(evt => {
        dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.classList.add('dragover'); });
    });
    ['dragleave','drop'].forEach(evt => {
        dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.classList.remove('dragover'); });
    });
    dropZone.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (files.length && files[0].type.startsWith('image/')) {
            imageInput.files = files;
            showPreview(files[0]);
        }
    });

    // File input change
    imageInput.addEventListener('change', function() {
        if (this.files.length) showPreview(this.files[0]);
    });

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewWrapper.style.display = 'block';
            dropZone.style.display = 'none';
            fileNameEl.textContent = file.name;
            fileSizeEl.textContent = formatBytes(file.size);
        };
        reader.readAsDataURL(file);
    }

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024, sizes = ['B','KB','MB','GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    // Remove image
    removeBtn.addEventListener('click', function() {
        imageInput.value = '';
        previewWrapper.style.display = 'none';
        dropZone.style.display = '';
        previewImage.src = '';
    });

    // Form submit with real progress
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const progressEl = document.getElementById('uploadProgress');
        const progressFill = document.getElementById('progressFill');
        const progressPercent = document.getElementById('progressPercent');
        const progressText = document.getElementById('progressText');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Publishing...';
        progressEl.style.display = 'block';
        progressFill.style.width = '0%';
        progressPercent.textContent = '0%';
        progressText.textContent = 'Uploading...';

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(evt) {
                    if (evt.lengthComputable) {
                        var pct = Math.round((evt.loaded / evt.total) * 100);
                        progressFill.style.width = pct + '%';
                        progressPercent.textContent = pct + '%';
                        if (pct < 100) {
                            progressText.textContent = 'Uploading... (' + formatBytes(evt.loaded) + ' / ' + formatBytes(evt.total) + ')';
                        } else {
                            progressText.textContent = 'Processing on server...';
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                progressFill.style.width = '100%';
                progressPercent.textContent = '100%';
                progressText.textContent = 'Complete!';
                progressFill.style.background = 'linear-gradient(90deg, #28a745, #34d058)';

                Swal.fire({
                    title: 'Published!',
                    text: 'Your NFT has been uploaded successfully.',
                    icon: 'success',
                    confirmButtonText: 'View My NFTs',
                    confirmButtonColor: '#3b7ddd'
                }).then(function() {
                    location.href = "{{ route('my.nft') }}";
                });
            },
            error: function(response) {
                progressFill.style.background = '#dc3545';
                progressText.textContent = 'Upload failed';
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg> Publish NFT';

                let msg = 'There was an error uploading your NFT.';
                if (response.responseJSON && response.responseJSON.message) {
                    msg = response.responseJSON.message;
                }
                Swal.fire({ title: 'Upload Failed', text: msg, icon: 'error', confirmButtonText: 'Try Again' });
            }
        });
    });
});
</script>

@include('dashboard.footer')