@include('dashboard.header')

<style>
    .deposit-page {
        max-width: 540px;
        margin: 0 auto;
        padding: 1.5rem 1rem 3rem;
    }

    .deposit-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 8px 24px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .deposit-card-header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        color: #fff;
        padding: 1.75rem 1.5rem 1.5rem;
        text-align: center;
    }

    .deposit-card-header h5 {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
        letter-spacing: 0.2px;
    }

    .deposit-card-header p {
        color: rgba(255, 255, 255, 0.65);
        font-size: 0.82rem;
        margin-bottom: 0;
    }

    .deposit-card-body {
        padding: 1.5rem;
    }

    /* Amount summary row */
    .amount-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8f9fc;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        margin-bottom: 0.65rem;
        cursor: pointer;
        transition: border-color 0.15s;
    }

    .amount-row:hover {
        border-color: #3b7ddd;
    }

    .amount-row .label {
        font-size: 0.78rem;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .amount-row .value {
        font-weight: 700;
        font-size: 1rem;
        color: #1a1a2e;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .copy-btn {
        background: none;
        border: 1px solid #d0d5dd;
        border-radius: 6px;
        padding: 3px 8px;
        font-size: 0.7rem;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .copy-btn:hover {
        background: #f0f6ff;
        border-color: #3b7ddd;
        color: #3b7ddd;
    }

    .copy-btn.copied {
        background: #d1fae5;
        border-color: #34d399;
        color: #059669;
    }

    /* QR code */
    .qr-wrapper {
        text-align: center;
        margin: 1.25rem 0;
    }

    .qr-wrapper img {
        width: 180px;
        height: 180px;
        border-radius: 12px;
        border: 4px solid #f0f2f5;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    /* Wallet address */
    .wallet-box {
        background: #f8f9fc;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
    }

    .wallet-box .addr {
        flex: 1;
        font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
        font-size: 0.78rem;
        color: #374151;
        word-break: break-all;
        line-height: 1.45;
    }

    .divider {
        height: 1px;
        background: #eee;
        margin: 1.25rem 0;
    }

    /* Steps */
    .steps-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .steps-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        margin-bottom: 0.65rem;
        font-size: 0.82rem;
        color: #4b5563;
        line-height: 1.45;
    }

    .step-num {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #3b7ddd;
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* CTA Button */
    .btn-payment {
        width: 100%;
        padding: 0.85rem;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-payment-confirm {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #fff;
    }

    .btn-payment-confirm:hover {
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
        transform: translateY(-1px);
    }

    /* Upload area */
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

    .upload-card {
        display: none;
        border: none;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 6px 16px rgba(0, 0, 0, 0.04);
        margin-top: 1rem;
    }

    .badge-network {
        display: inline-block;
        background: rgba(59, 125, 221, 0.1);
        color: #3b7ddd;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 4px;
        margin-top: 0.5rem;
    }
</style>

<main class="content">
    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="deposit-page">
        <div class="deposit-card" id="paymentDetails">
            <div class="deposit-card-header">
                <h5>Complete Your Deposit</h5>
                <p>Send the exact amount to the wallet address below</p>
            </div>

            <div class="deposit-card-body">
                <!-- Amount Summary -->
                <div class="amount-row" onclick="copyValue('{{ number_format($amount, 2, '.', '') }}', this)">
                    <div>
                        <div class="label">Amount (USD)</div>
                        <div class="value">${{ number_format($amount, 2, '.', ',') }}</div>
                    </div>
                    <button class="copy-btn" data-copy="{{ number_format($amount, 2, '.', '') }}">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" style="vertical-align:-1px;margin-right:3px;">
                            <rect x="9" y="9" width="13" height="13" rx="2" />
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                        </svg>
                        Copy
                    </button>
                </div>

                <div class="amount-row" onclick="copyValue('{{ $eth }}', this)">
                    <div>
                        <div class="label">Amount (ETH)</div>
                        <div class="value">{{ $eth }} ETH</div>
                    </div>
                    <button class="copy-btn" data-copy="{{ $eth }}">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" style="vertical-align:-1px;margin-right:3px;">
                            <rect x="9" y="9" width="13" height="13" rx="2" />
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                        </svg>
                        Copy
                    </button>
                </div>

                <div class="divider"></div>

                <!-- QR Code -->
                <div class="qr-wrapper">
                    @foreach($payment as $payments)
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $payments->wallet_address }}"
                        alt="Wallet QR Code">
                    <div class="badge-network mt-2">ERC-20 Network</div>
                    @break
                    @endforeach
                </div>

                <!-- Wallet Address -->
                @foreach($payment as $payments)
                <label
                    style="font-size:0.75rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.35rem; display:block;">Wallet
                    Address</label>
                <div class="wallet-box" onclick="copyValue('{{ $payments->wallet_address }}', this)">
                    <span class="addr" id="walletAddr">{{ $payments->wallet_address }}</span>
                    <button class="copy-btn" data-copy="{{ $payments->wallet_address }}">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" style="vertical-align:-1px;margin-right:3px;">
                            <rect x="9" y="9" width="13" height="13" rx="2" />
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                        </svg>
                        Copy
                    </button>
                </div>
                @break
                @endforeach

                <div class="divider"></div>

                <!-- Instructions -->
                <ul class="steps-list">
                    <li><span class="step-num">1</span> Copy the wallet address or scan the QR code above</li>
                    <li><span class="step-num">2</span> Send the exact ETH amount from your wallet</li>
                    <li><span class="step-num">3</span> Click "I Have Made Payment" and upload proof</li>
                </ul>

                <!-- CTA -->
                <button id="paymentButton" class="btn-payment btn-payment-confirm mt-2">
                    I Have Made Payment
                </button>
            </div>
        </div>

        <!-- Upload Proof Card -->
        <div class="card upload-card" id="uploadForm">
            <div class="card-body" style="padding:1.5rem;">
                <h6 class="mb-3" style="font-weight:700; color:#344054;">Upload Proof of Payment</h6>
                <form id="proofForm" action="{{ route('make.payment') }}" method='POST' enctype='multipart/form-data'>
                    @csrf
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <input type="hidden" name="eth" value="{{ $eth }}">

                    <div class="proof-drop-zone" id="proofDropZone">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b7ddd" stroke-width="2"
                            class="mb-2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="17 8 12 3 7 8" />
                            <line x1="12" y1="3" x2="12" y2="15" />
                        </svg>
                        <p class="mb-0 small"><span class="browse-link">Click to browse</span> or drag & drop</p>
                        <p class="small text-muted mb-0">Screenshot or photo of your payment</p>
                        <input type="file" id="proofInput" name="image" accept="image/*" required class="d-none">
                    </div>

                    <div class="proof-preview" id="proofPreview">
                        <button type="button" class="remove-btn" id="proofRemove">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
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
</main>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Copy helper
    function copyValue(text, el) {
        navigator.clipboard.writeText(text).then(function() {
            var btn = el.querySelector('.copy-btn') || el;
            var orig = btn.innerHTML;
            btn.classList.add('copied');
            btn.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-1px;margin-right:3px;"><polyline points="20 6 9 17 4 12"/></svg> Copied!';
            setTimeout(function() { btn.classList.remove('copied'); btn.innerHTML = orig; }, 1800);
        });
    }

    // Make all copy buttons work independently too
    document.querySelectorAll('.copy-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            copyValue(this.dataset.copy, this.parentElement);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    // Payment button → show upload form
    document.getElementById('paymentButton').addEventListener('click', function () {
        document.getElementById('paymentDetails').style.display = 'none';
        document.getElementById('uploadForm').style.display = 'block';
        this.style.display = 'none';
    });

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
        fill.style.transition = 'width 0.15s linear';
        fill.style.background = 'linear-gradient(90deg, #28a745, #34d058)';

        var processingTimer = null;
        var currentPct = 0;

        function setProgress(pct, text) {
            currentPct = pct;
            fill.style.width = pct + '%';
            pctEl.textContent = pct + '%';
            if (text) textEl.textContent = text;
        }

        function startProcessingAnimation() {
            fill.style.transition = 'width 0.5s ease-out';
            textEl.textContent = 'Processing on server...';
            var target = 71;
            processingTimer = setInterval(function() {
                if (target < 95) {
                    target += Math.random() * 2 + 0.5;
                    if (target > 95) target = 95;
                    setProgress(Math.round(target));
                }
            }, 800);
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

        xhr.upload.onprogress = function(evt) {
            if (evt.lengthComputable) {
                var realPct = evt.loaded / evt.total;
                var displayPct = Math.round(realPct * 70);
                setProgress(displayPct, 'Uploading... (' + formatBytes(evt.loaded) + ' / ' + formatBytes(evt.total) + ')');
                if (realPct >= 1) {
                    startProcessingAnimation();
                }
            }
        };

        xhr.onload = function() {
            clearInterval(processingTimer);
            if (xhr.status >= 200 && xhr.status < 300) {
                fill.style.transition = 'width 0.3s ease';
                setProgress(100, 'Complete!');
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
            clearInterval(processingTimer);
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