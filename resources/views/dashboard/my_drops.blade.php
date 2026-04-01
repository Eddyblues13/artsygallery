@include('dashboard.header')

<style>
    .proof-drop-zone {
        border: 2px dashed #d0d5dd;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        background: #fafbfc;
    }

    .proof-drop-zone:hover {
        border-color: #3b7ddd;
        background: #f0f6ff;
    }

    .proof-drop-zone .browse-link {
        color: #3b7ddd;
        font-weight: 600;
        text-decoration: underline;
    }

    .proof-preview {
        display: none;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        position: relative;
        margin-top: 0.75rem;
    }

    .proof-preview img {
        width: 100%;
        max-height: 220px;
        object-fit: contain;
        display: block;
    }

    .proof-preview .remove-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: none;
        background: rgba(220, 53, 69, 0.85);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .proof-preview .file-info {
        padding: 0.5rem 0.75rem;
        background: #f3f4f6;
        font-size: 0.75rem;
        color: #6b7280;
        display: flex;
        justify-content: space-between;
    }

    .proof-progress {
        display: none;
        margin-top: 0.75rem;
    }

    .proof-progress .track {
        height: 6px;
        background: #e5e7eb;
        border-radius: 100px;
        overflow: hidden;
    }

    .proof-progress .fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #28a745, #34d058);
        border-radius: 100px;
        transition: width 0.15s linear;
    }

    .proof-progress .label {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.35rem;
    }
</style>

<main class="content">
    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="container d-flex flex-column">
        <div class="row vh-10">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <div class="payment-title" style="margin:10px">
                            <b>you are to send ETH to the wallet address below or simply contact support for barcode for
                                fast payment</b>

                            <hr>
                            <p>Amount in Dollar: <b>${{ number_format($amount, 2, '.', ',') }}</b></p>
                            <p>Amount in ETH: <b>{{ $eth }} ETH</b></P>
                        </div>
                    </div>

                    <div class="text-center mt-4" id="paymentDetails">
                        <div class="payment-title" style="margin:10px">
                            <div>
                                @foreach($payment as $payments)
                                <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $payments->wallet_address }}"
                                    style="width:300px; max-width:100%;">
                                @endforeach
                                @foreach($payment as $payments)
                                <input class='form-control my-3' value="{{ $payments->wallet_address }}" id="myInput1"
                                    name='image' type='text'>
                                @endforeach
                                <button type='submit' onclick="copyAdr1()"
                                    class='btn btn-primary btn-sm btn-rounded shadow'> Copy Address</button>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button id="paymentButton" class="btn btn-lg btn-success btn-rounded shadow mt-4"
                            style="width: 100%; max-width: 300px; margin: auto; font-weight: bold;">
                            I Have Made Payment
                        </button>
                    </div>

                    <div class="card mt-4" id="uploadForm"
                        style="display: none; border:none; border-radius:16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 6px 16px rgba(0,0,0,0.04);">
                        <div class="card-body" style="padding:1.5rem;">
                            <h6 class="mb-3" style="font-weight:600; color:#344054;">Upload Proof of Payment</h6>
                            <form id="proofForm" action="{{ route('make.payment') }}" method='POST'
                                enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="eth" value="{{ $eth }}">

                                <div class="proof-drop-zone" id="proofDropZone">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b7ddd"
                                        stroke-width="2" class="mb-2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="17 8 12 3 7 8" />
                                        <line x1="12" y1="3" x2="12" y2="15" />
                                    </svg>
                                    <p class="mb-0 small"><span class="browse-link">Click to browse</span> or drag &
                                        drop</p>
                                    <p class="small text-muted mb-0">Screenshot or photo of your payment</p>
                                    <input type="file" id="proofInput" name="image" accept="image/*" required
                                        class="d-none">
                                </div>

                                <div class="proof-preview" id="proofPreview">
                                    <button type="button" class="remove-btn" id="proofRemove">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <line x1="18" y1="6" x2="6" y2="18" />
                                            <line x1="6" y1="6" x2="18" y2="18" />
                                        </svg>
                                    </button>
                                    <img id="proofImg" src="" alt="Proof preview">
                                    <div class="file-info">
                                        <span id="proofFileName">—</span>
                                        <span id="proofFileSize">—</span>
                                    </div>
                                </div>

                                <div class="proof-progress" id="proofProgress">
                                    <div class="track">
                                        <div class="fill" id="proofFill"></div>
                                    </div>
                                    <div class="label">
                                        <span id="proofProgressText">Uploading...</span>
                                        <span id="proofProgressPct">0%</span>
                                    </div>
                                </div>

                                <button type='submit' id="proofSubmit" class='btn btn-success w-100 mt-3'
                                    style="border-radius:10px; font-weight:600; padding:0.7rem;">
                                    Upload Proof
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Payment button
    document.getElementById('paymentButton').addEventListener('click', function () {
        document.getElementById('paymentDetails').style.display = 'none';
        document.getElementById('uploadForm').style.display = 'block';
        this.disabled = true;
        this.style.cursor = 'not-allowed';
        this.textContent = "Processing...";
    });

    // Copy address
    window.copyAdr1 = function() {
        var copyText = document.getElementById("myInput1");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
    };

    // Proof upload preview
    const dropZone = document.getElementById('proofDropZone');
    const fileInput = document.getElementById('proofInput');
    const previewBox = document.getElementById('proofPreview');
    const previewImg = document.getElementById('proofImg');

    dropZone.addEventListener('click', () => fileInput.click());
    ['dragenter','dragover'].forEach(evt => {
        dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.style.borderColor = '#3b7ddd'; });
    });
    ['dragleave','drop'].forEach(evt => {
        dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.style.borderColor = '#d0d5dd'; });
    });
    dropZone.addEventListener('drop', e => {
        if (e.dataTransfer.files.length) { fileInput.files = e.dataTransfer.files; showProofPreview(e.dataTransfer.files[0]); }
    });
    fileInput.addEventListener('change', function() { if (this.files.length) showProofPreview(this.files[0]); });

    function showProofPreview(file) {
        document.getElementById('proofFileName').textContent = file.name;
        document.getElementById('proofFileSize').textContent = formatBytes(file.size);
        const reader = new FileReader();
        reader.onload = e => { previewImg.src = e.target.result; };
        reader.readAsDataURL(file);
        previewBox.style.display = 'block';
        dropZone.style.display = 'none';
    }

    document.getElementById('proofRemove').addEventListener('click', function() {
        fileInput.value = '';
        previewBox.style.display = 'none';
        dropZone.style.display = '';
    });

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024, sizes = ['B','KB','MB','GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }

    // AJAX submit with progress
    document.getElementById('proofForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const fill = document.getElementById('proofFill');
        const pctEl = document.getElementById('proofProgressPct');
        const textEl = document.getElementById('proofProgressText');
        const progressEl = document.getElementById('proofProgress');
        const btn = document.getElementById('proofSubmit');

        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Uploading...';
        progressEl.style.display = 'block';
        fill.style.width = '0%';
        fill.style.background = 'linear-gradient(90deg, #28a745, #34d058)';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

        xhr.upload.onprogress = function(evt) {
            if (evt.lengthComputable) {
                const pct = Math.round((evt.loaded / evt.total) * 100);
                fill.style.width = pct + '%';
                pctEl.textContent = pct + '%';
                textEl.textContent = pct < 100 ? 'Uploading... (' + formatBytes(evt.loaded) + ' / ' + formatBytes(evt.total) + ')' : 'Processing...';
            }
        };

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                fill.style.width = '100%';
                textEl.textContent = 'Complete!';
                pctEl.textContent = '100%';
                Swal.fire({ title: 'Submitted!', text: 'Your payment proof has been uploaded.', icon: 'success', confirmButtonColor: '#28a745' })
                    .then(() => location.reload());
            } else {
                fill.style.background = '#dc3545';
                textEl.textContent = 'Failed';
                btn.disabled = false;
                btn.textContent = 'Upload Proof';
                Swal.fire({ title: 'Error', text: 'Upload failed. Please try again.', icon: 'error' });
            }
        };

        xhr.onerror = function() {
            fill.style.background = '#dc3545';
            textEl.textContent = 'Connection error';
            btn.disabled = false;
            btn.textContent = 'Upload Proof';
        };

        xhr.send(formData);
    });
});
</script>

@include('dashboard.footer')