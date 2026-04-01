@include('dashboard.header')

<style>
    .kyc-container {
        max-width: 560px;
        margin: 0 auto;
    }

    .kyc-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 6px 16px rgba(0, 0, 0, 0.04);
    }

    .kyc-card .card-body {
        padding: 2rem;
    }

    .kyc-drop-zone {
        border: 2px dashed #d0d5dd;
        border-radius: 16px;
        padding: 2.5rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        background: #fafbfc;
    }

    .kyc-drop-zone:hover,
    .kyc-drop-zone.dragover {
        border-color: #3b7ddd;
        background: #f0f6ff;
    }

    .kyc-drop-zone .drop-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #3b7ddd, #5a9cf5);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: #fff;
    }

    .kyc-drop-zone .browse-link {
        color: #3b7ddd;
        font-weight: 600;
        text-decoration: underline;
    }

    .kyc-preview {
        display: none;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        position: relative;
    }

    .kyc-preview img {
        width: 100%;
        max-height: 280px;
        object-fit: contain;
        display: block;
    }

    .kyc-preview .remove-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: rgba(220, 53, 69, 0.85);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .kyc-preview .file-info {
        padding: 0.6rem 1rem;
        background: #f3f4f6;
        font-size: 0.8rem;
        color: #6b7280;
        display: flex;
        justify-content: space-between;
    }

    .kyc-progress {
        display: none;
        margin-top: 1rem;
    }

    .kyc-progress .track {
        height: 8px;
        background: #e5e7eb;
        border-radius: 100px;
        overflow: hidden;
    }

    .kyc-progress .fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #3b7ddd, #5a9cf5);
        border-radius: 100px;
        transition: width 0.15s linear;
    }

    .kyc-progress .label {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }

    .btn-kyc {
        background: linear-gradient(135deg, #3b7ddd, #5a9cf5);
        border: none;
        color: #fff;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.2s;
        width: 100%;
    }

    .btn-kyc:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(59, 125, 221, 0.35);
        color: #fff;
    }

    .btn-kyc:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    @media (max-width: 575.98px) {
        .kyc-card .card-body {
            padding: 1.25rem;
        }

        .kyc-drop-zone {
            padding: 1.5rem 1rem;
        }

        .kyc-preview img {
            max-height: 200px;
        }
    }
</style>

<main class="content">
    <div class="container-fluid p-0">
        <div class="kyc-container">
            <div class="mb-4">
                <h1 class="h3 mb-1"><strong>Upload KYC</strong></h1>
                <p class="text-muted mb-0">Upload a clear photo of your government-issued ID for verification.</p>
            </div>

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @elseif (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card kyc-card">
                <div class="card-body">
                    <form id="kycForm" action="{{ route('uploadKyc') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label" style="font-weight:600; font-size:0.85rem; color:#344054;">ID
                                Document <span class="text-danger">*</span></label>

                            <div class="kyc-drop-zone" id="dropZone">
                                <div class="drop-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <rect x="3" y="4" width="18" height="16" rx="2" />
                                        <circle cx="9" cy="10" r="2" />
                                        <path d="M21 15l-3.086-3.086a2 2 0 00-2.828 0L6 21" />
                                    </svg>
                                </div>
                                <p class="mb-1"><span class="browse-link">Click to browse</span> or drag & drop</p>
                                <p class="small text-muted mb-0">JPEG, PNG, JPG, PDF — Max 50MB</p>
                                <input type="file" id="idcard" name="idcard" accept="image/*,.pdf" required
                                    class="d-none">
                            </div>

                            <div class="kyc-preview mt-3" id="previewBox">
                                <button type="button" class="remove-btn" id="removeBtn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                                <img id="previewImg" src="" alt="Preview">
                                <div class="file-info">
                                    <span id="fileName">—</span>
                                    <span id="fileSize">—</span>
                                </div>
                            </div>
                        </div>

                        <div class="kyc-progress" id="progressSection">
                            <div class="track">
                                <div class="fill" id="progressFill"></div>
                            </div>
                            <div class="label">
                                <span id="progressText">Uploading...</span>
                                <span id="progressPercent">0%</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-kyc mt-3" id="submitBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" class="me-2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            Upload Document
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('idcard');
    const previewBox = document.getElementById('previewBox');
    const previewImg = document.getElementById('previewImg');
    const removeBtn = document.getElementById('removeBtn');
    const fileNameEl = document.getElementById('fileName');
    const fileSizeEl = document.getElementById('fileSize');

    dropZone.addEventListener('click', () => fileInput.click());

    ['dragenter','dragover'].forEach(evt => {
        dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.classList.add('dragover'); });
    });
    ['dragleave','drop'].forEach(evt => {
        dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.classList.remove('dragover'); });
    });
    dropZone.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (files.length) { fileInput.files = files; showPreview(files[0]); }
    });

    fileInput.addEventListener('change', function() { if (this.files.length) showPreview(this.files[0]); });

    function showPreview(file) {
        fileNameEl.textContent = file.name;
        fileSizeEl.textContent = formatBytes(file.size);
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => { previewImg.src = e.target.result; };
            reader.readAsDataURL(file);
        } else {
            previewImg.src = 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="%236b7280" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>');
        }
        previewBox.style.display = 'block';
        dropZone.style.display = 'none';
    }

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024, sizes = ['B','KB','MB','GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    removeBtn.addEventListener('click', function() {
        fileInput.value = '';
        previewBox.style.display = 'none';
        dropZone.style.display = '';
    });

    // Form submit with XHR progress
    document.getElementById('kycForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const progressSection = document.getElementById('progressSection');
        const progressFill = document.getElementById('progressFill');
        const progressPercent = document.getElementById('progressPercent');
        const progressText = document.getElementById('progressText');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Uploading...';
        progressSection.style.display = 'block';
        progressFill.style.width = '0%';
        progressFill.style.background = 'linear-gradient(90deg, #3b7ddd, #5a9cf5)';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

        xhr.upload.onprogress = function(evt) {
            if (evt.lengthComputable) {
                const pct = Math.round((evt.loaded / evt.total) * 100);
                progressFill.style.width = pct + '%';
                progressPercent.textContent = pct + '%';
                progressText.textContent = pct < 100 ? 'Uploading... (' + formatBytes(evt.loaded) + ' / ' + formatBytes(evt.total) + ')' : 'Processing...';
            }
        };

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                progressFill.style.width = '100%';
                progressFill.style.background = 'linear-gradient(90deg, #28a745, #34d058)';
                progressText.textContent = 'Complete!';
                progressPercent.textContent = '100%';
                Swal.fire({
                    title: 'Uploaded!',
                    text: 'Your document has been submitted. Please wait for approval.',
                    icon: 'success',
                    confirmButtonColor: '#3b7ddd'
                }).then(() => location.reload());
            } else {
                progressFill.style.background = '#dc3545';
                progressText.textContent = 'Upload failed';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Upload Document';
                Swal.fire({ title: 'Error', text: 'Upload failed. Please try again.', icon: 'error' });
            }
        };

        xhr.onerror = function() {
            progressFill.style.background = '#dc3545';
            progressText.textContent = 'Connection error';
            submitBtn.disabled = false;
            submitBtn.textContent = 'Upload Document';
            Swal.fire({ title: 'Error', text: 'Connection error. Please check your internet.', icon: 'error' });
        };

        xhr.send(formData);
    });
});
</script>

@include('dashboard.footer')