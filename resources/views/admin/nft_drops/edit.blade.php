@extends('admin.layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif
@if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div>@endif
@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div>@endif

<!-- Main header -->
<div class="main-header d-flex align-items-center justify-content-between position-relative mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="page-icon"><i class="bi bi-pencil-square"></i></div>
        <div class="page-title d-none d-md-block">
            <h5 class="mb-0">Edit Notable Drop</h5>
        </div>
    </div>
    <a href="{{ route('admin.nft-drops.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form id="dropEditForm" action="{{ route('admin.nft-drops.update', $nftDrop->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Drop Name --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="name">Drop Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $nftDrop->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Image Upload with progress --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Drop Image</label>

                        {{-- Current image preview --}}
                        @if($nftDrop->image_url)
                        <div class="mb-2" id="currentImageWrap">
                            <p class="small text-muted mb-1">Current image:</p>
                            <img src="{{ Illuminate\Support\Str::startsWith($nftDrop->image_url, ['http','https']) ? $nftDrop->image_url : asset($nftDrop->image_url) }}"
                                alt="Current" class="img-thumbnail" style="max-height:120px; object-fit:cover;">
                        </div>
                        @endif

                        <div class="upload-zone @error('image_url') border-danger @enderror" id="uploadZone">
                            <div class="upload-zone-inner" id="uploadPrompt">
                                <i class="bi bi-cloud-arrow-up fs-2 text-muted"></i>
                                <p class="mb-1 mt-2 fw-semibold">Drag &amp; drop or click to replace</p>
                                <p class="text-muted small mb-0">Leave empty to keep current image</p>
                            </div>
                            <div id="uploadPreviewWrap" class="d-none text-center p-3">
                                <img id="uploadPreview" src="#" alt="Preview" class="upload-preview-img">
                                <p class="mt-2 mb-0 small text-muted" id="uploadFileName"></p>
                                <button type="button" class="btn btn-link btn-sm text-danger p-0 mt-1"
                                    id="clearUpload">Remove</button>
                            </div>
                            <input type="file" id="image_url" name="image_url" accept="image/*"
                                class="upload-file-input">
                        </div>
                        @error('image_url')<div class="text-danger small mt-1">{{ $message }}</div>@enderror

                        <div id="uploadProgressWrap" class="mt-2 d-none">
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="text-muted" id="uploadProgressLabel">Uploading to server…</span>
                                <span class="fw-bold" id="uploadProgressPct">0%</span>
                            </div>
                            <div class="upload-progress-track">
                                <div class="upload-progress-fill" id="uploadProgressFill" style="width:0%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- ETH Value & Change --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="eth_value">ETH Value</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg width="14" height="14" viewBox="0 0 14 22"
                                        fill="none">
                                        <path
                                            d="M6.99984 0L6.84375 0.537V15.042L6.99984 15.198L13.9997 11.11L6.99984 0Z"
                                            fill="#6366f1" />
                                        <path d="M6.99984 0L0 11.11L6.99984 15.198V0Z" fill="#8b5cf6" />
                                    </svg></span>
                                <input type="number" step="0.0001" min="0"
                                    class="form-control @error('eth_value') is-invalid @enderror" id="eth_value"
                                    name="eth_value" value="{{ old('eth_value', $nftDrop->eth_value) }}" required>
                                @error('eth_value')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="change">Change %</label>
                            <div class="input-group">
                                <span class="input-group-text">%</span>
                                <input type="number" step="0.01"
                                    class="form-control @error('change') is-invalid @enderror" id="change" name="change"
                                    value="{{ old('change', $nftDrop->change) }}" required>
                                @error('change')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Duration & Direction --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="duration">Duration (days)</label>
                            <input type="number" min="1" class="form-control @error('duration') is-invalid @enderror"
                                id="duration" name="duration" value="{{ old('duration', $nftDrop->duration) }}"
                                required>
                            @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="is_positive">Price Direction</label>
                            <select class="form-select @error('is_positive') is-invalid @enderror" id="is_positive"
                                name="is_positive" required>
                                <option value="1" {{ old('is_positive', $nftDrop->is_positive ? '1' : '0') == '1' ?
                                    'selected':'' }}>&#8593; Positive (gain)</option>
                                <option value="0" {{ old('is_positive', $nftDrop->is_positive ? '1' : '0') == '0' ?
                                    'selected':'' }}>&#8595; Negative (loss)</option>
                            </select>
                            @error('is_positive')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Assign User --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Assign to User <span
                                class="text-muted fw-normal">(optional)</span></label>
                        <div class="user-search-wrap">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-search"></i></span>
                                <input type="text" id="userSearchInput" class="form-control"
                                    placeholder="Search by name or email…" autocomplete="off">
                            </div>
                            <div id="userSearchResults" class="user-search-dropdown d-none"></div>
                        </div>
                        <input type="hidden" name="user_id" id="user_id"
                            value="{{ old('user_id', $nftDrop->user_id) }}">

                        {{-- Show currently assigned user --}}
                        <div id="selectedUserBadge" class="{{ $nftDrop->user ? '' : 'd-none' }} mt-2">
                            <span class="badge py-2 px-3 d-inline-flex align-items-center gap-2"
                                style="background:#6366f1 !important; color:#fff; border-radius:8px;">
                                <i class="bi bi-person-check"></i>
                                <span id="selectedUserLabel">{{ $nftDrop->user ? $nftDrop->user->name . ' — ' .
                                    $nftDrop->user->email : '' }}</span>
                                <button type="button" class="btn-close btn-close-white ms-1" id="clearUser"
                                    style="font-size:10px;"></button>
                            </span>
                        </div>
                        @error('user_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                            <span id="submitBtnText"><i class="bi bi-save me-1"></i>Update Drop</span>
                            <span id="submitBtnSpinner" class="d-none">
                                <span class="spinner-border spinner-border-sm me-1"></span>Saving…
                            </span>
                        </button>
                        <a href="{{ route('admin.nft-drops.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .upload-zone {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        cursor: pointer;
        position: relative;
        background: #fafafa;
        transition: border-color .2s, background .2s;
        min-height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .upload-zone:hover,
    .upload-zone.drag-over {
        border-color: #6366f1;
        background: #f5f3ff;
    }

    .upload-zone-inner {
        text-align: center;
        padding: 20px;
        pointer-events: none;
    }

    .upload-file-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-preview-img {
        max-height: 160px;
        max-width: 100%;
        border-radius: 8px;
        object-fit: contain;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
    }

    .upload-progress-track {
        height: 8px;
        background: #e5e7eb;
        border-radius: 99px;
        overflow: hidden;
    }

    .upload-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        border-radius: 99px;
        transition: width .3s ease;
    }

    .user-search-wrap {
        position: relative;
    }

    .user-search-dropdown {
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        z-index: 500;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .1);
        max-height: 220px;
        overflow-y: auto;
    }

    .user-search-item {
        padding: 10px 14px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        gap: 1px;
    }

    .user-search-item:hover {
        background: #f5f3ff;
    }

    .user-search-item .user-name {
        font-weight: 600;
        font-size: 13.5px;
        color: #111827;
    }

    .user-search-item .user-email {
        font-size: 12px;
        color: #6b7280;
    }
</style>
@endpush

@push('scripts')
<script>
    (function () {
    // ── Image upload zone ──────────────────────────────────────────────
    const zone       = document.getElementById('uploadZone');
    const fileInput  = document.getElementById('image_url');
    const prompt     = document.getElementById('uploadPrompt');
    const previewWrap= document.getElementById('uploadPreviewWrap');
    const previewImg = document.getElementById('uploadPreview');
    const fileLabel  = document.getElementById('uploadFileName');
    const clearBtn   = document.getElementById('clearUpload');

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = e => { previewImg.src = e.target.result; };
        reader.readAsDataURL(file);
        fileLabel.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
        prompt.classList.add('d-none');
        previewWrap.classList.remove('d-none');
    }

    fileInput.addEventListener('change', () => { if (fileInput.files[0]) showPreview(fileInput.files[0]); });

    clearBtn.addEventListener('click', e => {
        e.stopPropagation();
        fileInput.value = '';
        previewImg.src = '#';
        prompt.classList.remove('d-none');
        previewWrap.classList.add('d-none');
    });

    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', ()=> zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault(); zone.classList.remove('drag-over');
        const f = e.dataTransfer.files[0];
        if (f && f.type.startsWith('image/')) {
            const dt = new DataTransfer(); dt.items.add(f); fileInput.files = dt.files;
            showPreview(f);
        }
    });

    // ── XHR form submit with upload progress ──────────────────────────
    const form        = document.getElementById('dropEditForm');
    const progressWrap= document.getElementById('uploadProgressWrap');
    const progressFill= document.getElementById('uploadProgressFill');
    const progressPct = document.getElementById('uploadProgressPct');
    const progressLbl = document.getElementById('uploadProgressLabel');
    const submitBtn   = document.getElementById('submitBtn');
    const btnText     = document.getElementById('submitBtnText');
    const btnSpinner  = document.getElementById('submitBtnSpinner');

    form.addEventListener('submit', function (e) {
        // Only intercept if a new file was chosen
        if (!fileInput.files || !fileInput.files.length) return; // let browser submit normally
        e.preventDefault();
        const fd = new FormData(form);
        const xhr = new XMLHttpRequest();

        progressWrap.classList.remove('d-none');
        btnText.classList.add('d-none');
        btnSpinner.classList.remove('d-none');
        submitBtn.disabled = true;

        xhr.upload.addEventListener('progress', ev => {
            if (ev.lengthComputable) {
                const pct = Math.round((ev.loaded / ev.total) * 100);
                progressFill.style.width = pct + '%';
                progressPct.textContent  = pct + '%';
                if (pct === 100) {
                    progressLbl.textContent = 'Processing on server…';
                    progressFill.style.background = 'linear-gradient(90deg,#10b981,#34d399)';
                }
            }
        });

        xhr.addEventListener('load', () => {
            if (xhr.responseURL) window.location.href = xhr.responseURL;
            else window.location.reload();
        });

        xhr.addEventListener('error', () => {
            submitBtn.disabled = false;
            btnText.classList.remove('d-none');
            btnSpinner.classList.add('d-none');
            progressWrap.classList.add('d-none');
            alert('Upload failed. Please try again.');
        });

        xhr.open('POST', form.action);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send(fd);
    });

    // ── User search ────────────────────────────────────────────────────
    const searchInput    = document.getElementById('userSearchInput');
    const resultsBox     = document.getElementById('userSearchResults');
    const hiddenUserId   = document.getElementById('user_id');
    const selectedBadge  = document.getElementById('selectedUserBadge');
    const selectedLabel  = document.getElementById('selectedUserLabel');
    const clearUserBtn   = document.getElementById('clearUser');
    let searchTimer;

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimer);
        const q = this.value.trim();
        if (q.length < 2) { resultsBox.classList.add('d-none'); return; }
        searchTimer = setTimeout(() => {
            fetch('{{ route('user.search') }}?query=' + encodeURIComponent(q), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(users => {
                resultsBox.innerHTML = '';
                if (!users.length) {
                    resultsBox.innerHTML = '<div class="p-3 text-muted small">No users found.</div>';
                } else {
                    users.forEach(u => {
                        const el = document.createElement('div');
                        el.className = 'user-search-item';
                        el.innerHTML = '<span class="user-name">' + u.name + '</span><span class="user-email">' + u.email + '</span>';
                        el.addEventListener('click', () => {
                            hiddenUserId.value   = u.id;
                            selectedLabel.textContent = u.name + ' — ' + u.email;
                            selectedBadge.classList.remove('d-none');
                            searchInput.value = '';
                            resultsBox.classList.add('d-none');
                        });
                        resultsBox.appendChild(el);
                    });
                }
                resultsBox.classList.remove('d-none');
            });
        }, 300);
    });

    clearUserBtn.addEventListener('click', () => {
        hiddenUserId.value = '';
        selectedLabel.textContent = '';
        selectedBadge.classList.add('d-none');
    });

    document.addEventListener('click', e => {
        if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
            resultsBox.classList.add('d-none');
        }
    });
})();
</script>
@endpush