@include('dashboard.header')

<style>
    @media (max-width: 767.98px) {
        .profile-about ul li a {
            word-break: break-all;
        }

        .profile-share .input-group {
            flex-wrap: nowrap;
        }

        .profile-share .input-group .form-control {
            font-size: 0.8rem;
            min-width: 0;
        }
    }

    /* Profile Picture Upload */
    .profile-pic-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-pic-wrapper .pic-progress {
        display: none;
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: #e5e7eb;
        border-radius: 100px;
        overflow: hidden;
    }

    .profile-pic-wrapper .pic-progress .pic-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #3b7ddd, #5a9cf5);
        border-radius: 100px;
        transition: width 0.15s linear;
    }

    /* KYC upload drop zone in profile */
    .kyc-inline-drop {
        border: 2px dashed #d0d5dd;
        border-radius: 12px;
        padding: 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        background: #fafbfc;
    }

    .kyc-inline-drop:hover {
        border-color: #3b7ddd;
        background: #f0f6ff;
    }

    .kyc-inline-drop .browse-link {
        color: #3b7ddd;
        font-weight: 600;
        text-decoration: underline;
    }

    .kyc-inline-preview {
        display: none;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        margin-top: 0.75rem;
        position: relative;
    }

    .kyc-inline-preview img {
        width: 100%;
        max-height: 180px;
        object-fit: contain;
        display: block;
    }

    .kyc-inline-preview .remove-btn {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: none;
        background: rgba(220, 53, 69, 0.85);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
    }

    .kyc-inline-preview .file-meta {
        padding: 0.4rem 0.75rem;
        background: #f3f4f6;
        font-size: 0.75rem;
        color: #6b7280;
    }

    .kyc-inline-progress {
        display: none;
        margin-top: 0.5rem;
    }

    .kyc-inline-progress .track {
        height: 6px;
        background: #e5e7eb;
        border-radius: 100px;
        overflow: hidden;
    }

    .kyc-inline-progress .fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #3b7ddd, #5a9cf5);
        border-radius: 100px;
        transition: width 0.15s linear;
    }

    .kyc-inline-progress .label {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.3rem;
    }
</style>

<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Profile</h1>
            <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
                upload KYC
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Details</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="profile-pic-wrapper mb-3">
                            @if(Auth::user()->profile_picture)
                            <img src="{{ Auth::user()->profile_picture }}" alt="{{ Auth::user()->name }}"
                                class="img-fluid rounded-circle mb-2" width="128" height="128"
                                style="object-fit: cover;" id="profileAvatar" />
                            @else
                            <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y"
                                alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle mb-2" width="128"
                                height="128" id="profileAvatar" />
                            @endif
                            <label for="profilePicInput"
                                class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items: center; justify-content: center;"
                                style="width: 36px; height: 36px; cursor: pointer; border: 3px solid #fff; bottom: 8px; right: 0; align-items: center; justify-content: center;"
                                title="Change Profile Picture">
                                <span data-feather="camera" style="width: 16px; height: 16px;"></span>
                            </label>
                            <div class="pic-progress" id="picProgress">
                                <div class="pic-fill" id="picFill"></div>
                            </div>
                        </div>
                        <form action="{{ route('upload.profile.picture') }}" method="POST" enctype="multipart/form-data"
                            id="profilePicForm">
                            @csrf
                            <input type="file" name="profile_picture" id="profilePicInput" accept="image/*"
                                class="d-none">
                        </form>
                        <h5 class="card-title mb-0">{{Auth::user()->name}}</h5>
                        <div class="text-muted mb-2">Kyc</div>

                        <div>

                            @if(Auth::user()->id_card_status ==='1')
                            <div class='cols-6'>
                                <a href='javascript: void(0);'
                                    class='btn btn-success waves-effect waves-light btn-sm'>Verified<i
                                        class='mdi mdi-check ms-1'></i></a>
                            </div>
                            @elseif(Auth::user()->id_card_status==='0')
                            <div class='cols-6'>
                                <a href='javascript: void(0);'
                                    class='btn btn-danger waves-effect waves-light btn-sm'>Not Verified<i
                                        class='mdi mdi-check ms-1'></i></a>
                            </div>
                            @else
                            <div class='cols-6'>
                                <a href='javascript: void(0);'
                                    class='btn btn-danger waves-effect waves-light btn-sm'>Not Verified<i
                                        class='mdi mdi-check ms-1'></i></a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profile Link Share Section -->
                    <div class="card-body border-top">
                        <h5 class="h6 card-title"><span data-feather="share-2" class="feather-sm me-1"></span>Share Your
                            Profile</h5>
                        <p class="text-muted small mb-3">Share your public profile link with others to showcase your NFT
                            collection.</p>

                        <!-- Profile URL Input -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="profileUrl"
                                value="{{ route('public.profile', Auth::user()->id) }}" readonly
                                style="background: #f8f9fa;">
                            <button class="btn btn-primary" type="button" id="copyBtn" onclick="copyProfileLink()">
                                <span data-feather="clipboard" class="feather-sm me-1"></span> Copy
                            </button>
                        </div>

                        <!-- Social Share Buttons -->
                        <div class="d-flex flex-wrap gap-2">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('public.profile', Auth::user()->id)) }}&text={{ urlencode('Check out my NFT collection!') }}"
                                target="_blank" class="btn btn-dark btn-sm">
                                <i class="fab fa-x-twitter me-1"></i> X
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('public.profile', Auth::user()->id)) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-facebook me-1"></i> Facebook
                            </a>
                            <a href="https://wa.me/?text={{ urlencode('Check out my NFT collection: ' . route('public.profile', Auth::user()->id)) }}"
                                target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp
                            </a>
                            <a href="{{ route('public.profile', Auth::user()->id) }}" target="_blank"
                                class="btn btn-outline-secondary btn-sm">
                                <span data-feather="external-link" class="feather-sm me-1"></span> View Profile
                            </a>
                        </div>
                    </div>
                    @include('dashboard.alert')
                    <div class="card" style="border:none; border-radius:12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                        <div class="card-body">
                            <h6 style="font-weight:600; color:#344054; margin-bottom:1rem;">Upload KYC Document</h6>
                            <form id="kycProfileForm" action="{{ url('/upload-kyc') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="kyc-inline-drop" id="kycDrop"
                                    onclick="document.getElementById('kycFileInput').click()">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3b7ddd"
                                        stroke-width="2" class="mb-1">
                                        <rect x="3" y="4" width="18" height="16" rx="2" />
                                        <circle cx="9" cy="10" r="2" />
                                        <path d="M21 15l-3.086-3.086a2 2 0 00-2.828 0L6 21" />
                                    </svg>
                                    <p class="mb-0 small"><span class="browse-link">Choose file</span> or drag & drop
                                    </p>
                                    <input type="file" id="kycFileInput" name="idcard" accept="image/*,.pdf" required
                                        class="d-none">
                                </div>
                                <div class="kyc-inline-preview" id="kycPreview">
                                    <button type="button" class="remove-btn" id="kycRemoveBtn">&times;</button>
                                    <img id="kycPreviewImg" src="" alt="KYC Preview">
                                    <div class="file-meta" id="kycFileMeta">—</div>
                                </div>
                                <div class="kyc-inline-progress" id="kycProgress">
                                    <div class="track">
                                        <div class="fill" id="kycFill"></div>
                                    </div>
                                    <div class="label">
                                        <span id="kycProgressText">Uploading...</span>
                                        <span id="kycProgressPct">0%</span>
                                    </div>
                                </div>
                                <button type="submit" id="kycSubmitBtn" class="btn btn-primary w-100 mt-3"
                                    style="border-radius:10px; font-weight:600;">Upload KYC</button>
                            </form>
                        </div>
                    </div>
                    <hr class="my-0" />

                    <div class="card-body">
                        <h5 class="h6 card-title">About</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span>Full Name: <a
                                    href="#">{{Auth::user()->name}}</a></li>
                            <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span>Email: <a
                                    href="#">{{Auth::user()->email}}</a></li>

                            <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>Mobile <a
                                    href="#">{{Auth::user()->phone}}</a></li>
                            <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Country <a
                                    href="#">{{Auth::user()->country}}</a></li>
                        </ul>
                    </div>
                    <hr class="my-0" />

                </div>
            </div>


        </div>

    </div>
</main>

<script>
    function copyProfileLink() {
    const profileUrl = document.getElementById('profileUrl');
    const copyBtn = document.getElementById('copyBtn');
    
    // Copy to clipboard
    navigator.clipboard.writeText(profileUrl.value).then(function() {
        // Success feedback
        const originalContent = copyBtn.innerHTML;
        copyBtn.innerHTML = '<span data-feather="check" class="feather-sm me-1"></span> Copied!';
        copyBtn.classList.remove('btn-primary');
        copyBtn.classList.add('btn-success');
        
        // Re-initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        // Reset after 2 seconds
        setTimeout(function() {
            copyBtn.innerHTML = originalContent;
            copyBtn.classList.remove('btn-success');
            copyBtn.classList.add('btn-primary');
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }, 2000);
    }).catch(function(err) {
        // Fallback for older browsers
        profileUrl.select();
        document.execCommand('copy');
        
        // Show feedback
        const originalContent = copyBtn.innerHTML;
        copyBtn.innerHTML = '<span data-feather="check" class="feather-sm me-1"></span> Copied!';
        copyBtn.classList.remove('btn-primary');
        copyBtn.classList.add('btn-success');
        
        setTimeout(function() {
            copyBtn.innerHTML = originalContent;
            copyBtn.classList.remove('btn-success');
            copyBtn.classList.add('btn-primary');
        }, 2000);
    });
}

// === Profile Picture AJAX Upload with Preview ===
document.getElementById('profilePicInput').addEventListener('change', function() {
    if (!this.files.length) return;
    const file = this.files[0];
    const avatar = document.getElementById('profileAvatar');
    const progress = document.getElementById('picProgress');
    const fill = document.getElementById('picFill');

    // Instant preview
    const reader = new FileReader();
    reader.onload = function(e) { avatar.src = e.target.result; };
    reader.readAsDataURL(file);

    // Upload with progress
    const formData = new FormData(document.getElementById('profilePicForm'));
    progress.style.display = 'block';
    fill.style.width = '0%';
    fill.style.background = 'linear-gradient(90deg, #3b7ddd, #5a9cf5)';

    const xhr = new XMLHttpRequest();
    xhr.open('POST', document.getElementById('profilePicForm').action, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

    xhr.upload.onprogress = function(evt) {
        if (evt.lengthComputable) {
            fill.style.width = Math.round((evt.loaded / evt.total) * 100) + '%';
        }
    };
    xhr.onload = function() {
        fill.style.width = '100%';
        fill.style.background = 'linear-gradient(90deg, #28a745, #34d058)';
        setTimeout(() => { progress.style.display = 'none'; }, 1500);
        if (xhr.status < 200 || xhr.status >= 300) {
            avatar.src = avatar.dataset.original || avatar.src;
        }
    };
    xhr.onerror = function() {
        fill.style.background = '#dc3545';
        setTimeout(() => { progress.style.display = 'none'; }, 2000);
    };
    xhr.send(formData);
});

// === KYC Drop Zone in Profile ===
(function() {
    const drop = document.getElementById('kycDrop');
    const input = document.getElementById('kycFileInput');
    const preview = document.getElementById('kycPreview');
    const previewImg = document.getElementById('kycPreviewImg');
    const meta = document.getElementById('kycFileMeta');

    if (!drop) return;

    ['dragenter','dragover'].forEach(evt => {
        drop.addEventListener(evt, e => { e.preventDefault(); drop.style.borderColor = '#3b7ddd'; });
    });
    ['dragleave','drop'].forEach(evt => {
        drop.addEventListener(evt, e => { e.preventDefault(); drop.style.borderColor = '#d0d5dd'; });
    });
    drop.addEventListener('drop', e => {
        if (e.dataTransfer.files.length) { input.files = e.dataTransfer.files; showKycPreview(e.dataTransfer.files[0]); }
    });
    input.addEventListener('change', function() { if (this.files.length) showKycPreview(this.files[0]); });

    function showKycPreview(file) {
        meta.textContent = file.name + ' (' + formatBytes(file.size) + ')';
        if (file.type.startsWith('image/')) {
            const r = new FileReader();
            r.onload = e => { previewImg.src = e.target.result; };
            r.readAsDataURL(file);
        } else {
            previewImg.src = 'data:image/svg+xml,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="%236b7280" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>');
        }
        preview.style.display = 'block';
        drop.style.display = 'none';
    }

    document.getElementById('kycRemoveBtn').addEventListener('click', function() {
        input.value = '';
        preview.style.display = 'none';
        drop.style.display = '';
    });

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024, sizes = ['B','KB','MB','GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    // AJAX upload for KYC in profile
    document.getElementById('kycProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const fill = document.getElementById('kycFill');
        const pct = document.getElementById('kycProgressPct');
        const text = document.getElementById('kycProgressText');
        const progressEl = document.getElementById('kycProgress');
        const btn = document.getElementById('kycSubmitBtn');

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Uploading...';
        progressEl.style.display = 'block';
        fill.style.width = '0%';
        fill.style.background = 'linear-gradient(90deg, #3b7ddd, #5a9cf5)';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
        xhr.upload.onprogress = function(evt) {
            if (evt.lengthComputable) {
                const p = Math.round((evt.loaded / evt.total) * 100);
                fill.style.width = p + '%';
                pct.textContent = p + '%';
                text.textContent = p < 100 ? 'Uploading... (' + formatBytes(evt.loaded) + ' / ' + formatBytes(evt.total) + ')' : 'Processing...';
            }
        };
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                fill.style.width = '100%';
                fill.style.background = 'linear-gradient(90deg, #28a745, #34d058)';
                text.textContent = 'Complete!';
                pct.textContent = '100%';
                btn.innerHTML = 'Uploaded!';
                setTimeout(() => location.reload(), 1500);
            } else {
                fill.style.background = '#dc3545';
                text.textContent = 'Failed';
                btn.disabled = false;
                btn.textContent = 'Upload KYC';
            }
        };
        xhr.onerror = function() {
            fill.style.background = '#dc3545';
            text.textContent = 'Error';
            btn.disabled = false;
            btn.textContent = 'Upload KYC';
        };
        xhr.send(formData);
    });
})();
</script>

@include('dashboard.footer')