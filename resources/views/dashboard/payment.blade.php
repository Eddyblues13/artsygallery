<div class="text-center mt-4">
    <div class="payment-title" style="margin:10px">
        <div>
            @foreach($payment as $payments)
            <img src="https://api.qrserver.com/v1/create-qr-code/?data={{$payments->wallet_address}}" style="width:300px;">
            @endforeach
            @foreach($payment as $payments)
            <input class='form-control ' value="{{$payments->wallet_address}}" id="myInput1" name='image' type='text'>
            @endforeach
            <button type='submit' onclick="copyAdr1()"
                class='btn btn-primary btn-sm btn-rounded shadow'> Copy Address</button>
        </div>
    </div>
</div>

<!-- Add the "I have made payment" button -->
<div class="text-center mt-4">
    <button id="paymentButton" class="btn btn-success btn-rounded shadow">
        I have made payment
    </button>
</div>

<!-- Upload proof form -->
<div id="uploadProofForm" style="display: none;" class="card mt-4">
    <div class="card-body">
        <div class="container-fluid p-0">
            <form class='form-horizontal' action="{{ route('make.payment')}}" method='POST'
                id='id_load' enctype='multipart/form-data'>
                @csrf
                <div class='col-sm-6'>
                    <input type="hidden" name="amount" value="{{$amount}}">
                    <input type="hidden" name="eth" value="{{$eth}}">
                    <div class="mb-3">
                        <label class="form-label">Upload Proof of Payment</label>
                        <input class="form-control form-control-lg" accept="image" type="file"
                            name="image" placeholder="Upload Proof" />
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type='submit' class='btn btn-primary btn-sm btn-rounded shadow'>
                            <ion-icon class='fa fa-camera'> Upload </ion-icon>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Show the form after the user clicks "I have made payment"
    document.getElementById('paymentButton').addEventListener('click', function () {
        document.getElementById('uploadProofForm').style.display = 'block';
        this.style.display = 'none'; // Hide the "I have made payment" button
    });

    function copyAdr1() {
        var copyText = document.getElementById("myInput1");
        copyText.select();
        document.execCommand("copy");
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
    }
</script>
