@include('dashboard.header')
<main class="content">
    @if(session('message'))
    <div class="btn btn-success">{{ session('message') }}</div>
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
                                    style="width:300px;">
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

                    <div class="card mt-4" id="uploadForm" style="display: none;">
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <form class='form-horizontal' action="{{ route('make.payment') }}" method='POST'
                                    id='id_load' enctype='multipart/form-data'>
                                    @csrf
                                    <div class='col-sm-6 mx-auto'>
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" name="eth" value="{{ $eth }}">
                                        <div class="mb-3">
                                            <label class="form-label">Upload Proof of Payment</label>
                                            <input class="form-control form-control-lg" accept="image" type="file"
                                                name="image" />
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type='submit' class='btn btn-primary btn-lg btn-rounded shadow'>
                                                <ion-icon class='fa fa-camera'></ion-icon> Upload Proof
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('paymentButton').addEventListener('click', function () {
        // Hide the payment details (wallet address and QR code)
        document.getElementById('paymentDetails').style.display = 'none';
        // Show the upload form
        document.getElementById('uploadForm').style.display = 'block';
        // Disable the "I Have Made Payment" button
        this.disabled = true;
        this.style.cursor = 'not-allowed';
        this.textContent = "Processing...";
    });

    function copyAdr1() {
        var copyText = document.getElementById("myInput1");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        navigator.clipboard.writeText(copyText.value);
    }
</script>

<script src="js/app.js"></script>
</body>

</html>