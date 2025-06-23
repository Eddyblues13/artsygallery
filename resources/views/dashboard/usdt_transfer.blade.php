@include('dashboard.header')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-15">USDT Transfer <iconify-icon inline
                                icon='cryptocurrency-color:usdt' class='' width='20px'></iconify-icon>
                        </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="card" style="border-top-left-radius:30px; border-top-right-radius: 30px; ">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Account Balance</h4>

                        <div class="text-center text-muted">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-4">
                                        <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-danger me-1"></i>
                                            Main Balance</p>
                                        <h5></h5>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mt-4">
                                        <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-danger me-1"></i>
                                            Over Draft</p>
                                        <h5></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4"></h4>
                                <form id="inter_form" action="{{route('reflection')}}" method="POST">
                                    @csrf
                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Select
                                            Account</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="balance" name="balance">
                                                <option value="">Select</option>
                                                <option value="account_balance">Balance (0:00)
                                                </option>
                                                <option value="overdraft_balance">Over Draft Balance (0:00)
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <input type="text" class="form-control" id="loader_code" name="loader_code"
                                        value="80436258" style="display:none">

                                    <input type="text" class="form-control" id="currency" name="currency" value="¥"
                                        style="display:none">


                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Wallet
                                            Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="wallet_address"
                                                name="wallet_address" value="">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Select
                                            Account</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="network" name="network">
                                                <option>Select Network</option>
                                                <option value="ERC20">ERC20</option>
                                                <option value="TRC20">TRC20</option>
                                                <option value="BEP20">BEP20</option>
                                                <option value="EOS">EOS</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label for="horizontal-number-input"
                                            class="col-sm-3 col-form-label">Amount</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="amount" name="amount" placeholder="Amount"
                                                onkeyup="showHint(this.value)"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                type="number" maxlength="15">
                                            <p id="txtHint"> &nbsp; .</p>
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label for="horizontal-password-input"
                                            class="col-sm-3 col-form-label">Transaction Pin</label>
                                        <div class="col-sm-9">
                                            <input type="tel" class="form-control pw3" id="transaction_pin"
                                                name="transaction_pin" placeholder="Enter Transaction Pin"
                                                maxlength="4">
                                        </div>
                                    </div>

                                    <div class="row justify-content-end">
                                        <div class="col-sm-9">
                                            <div>
                                                <button id="send_pin" onclick='send(this)'
                                                    class="btn btn-primary btn-rounded waves-effect waves-light"
                                                    type="submit">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <p class="response"></p>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>


            <script src="assets/js/jquery-3.4.1.min.js"></script>
            <script>
                function send(id){
// $("#myModal").modal('show');
id.innerHTML = "Please wait..<div class='spinner-border spinner-border-sm' role='status'><span class='sr-only'>Loading...</span></div>";
setTimeout(function(){
id.innerHTML = "Send";
// $("#myModal").modal('hide');
//window.scrollTo(0, 50);
}, 3000);
}
            </script>

            <center>
                <div id="myModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog" style="margin-top:180px; padding:-73px;">
                        <div class="modal-content"
                            style="background-color:#31202000; border: 1px solid rgba(0, 0, 0, 0);">
                            <div class="modal-body">
                                <img src="loader1.gif" width="50px">
                            </div>
                        </div>
                    </div>
                </div>
            </center>

            <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
            <div class="position-fixed top-0 end-0 p-2" style="z-index: 1005">
                <div id="ErrorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <img src="https://artsygalley.com.com/swift.png" alt="" class="me-2" height="18">
                        <strong class="me-auto">Error</strong>
                        <small>Now..</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body" style="background-color:red;">

                    </div>
                </div>
            </div>

            <script>
                function showHint(str) {
if(str.length == 0) {
document.getElementById("txtHint").innerHTML = "Calculating..<div class='spinner-border spinner-border-sm' role='status'><span class='sr-only'>Loading...</span></div>";
return;
} else {
var xmlhttp = new XMLHttpRequest();
var currency = $('#currency').val();
// alert(currency)
xmlhttp.onreadystatechange = function() {
if(this.readyState == 4 && this.status == 200) {
document.getElementById("txtHint").innerHTML = this.responseText;
}
}
xmlhttp.open("GET", "usdt_transfer/get_value.php?q="+str+'&k='+currency, true);
xmlhttp.send();
}
}
            </script>

            <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
                $(document).ready(function(){
$('#inter_form').on('submit', function(e){
    e.preventDefault();
    var loader_code = $('#loader_code').val();
    var currency = $('#currency').val();
    var wallet_address = $('#wallet_address').val();
    var balance = $('#balance').val();
    var amount = $('#amount').val();
    var transaction_pin = $('#transaction_pin').val();
    var network = $('#network').val();

    
    if(loader_code=="" ||  currency=="" ||  wallet_address=="" || balance=="" || transaction_pin=="" || amount=='' || network==''){
       $(".toast-body").html('Enter all field');
       $("#ErrorToast").toast("show");
       return false;
    }

    if(wallet_address.length<10) {
      $(".toast-body").html('Invalid Wallet Address');
      $("#ErrorToast").toast("show");
      $("#wallet_address").val('');
       return false;
    }
  
    
    if(transaction_pin.length<4){
     $(".toast-body").html('Transaction Pin Error');
     $("#ErrorToast").toast("show");
     $("#transaction_pin").val('');
       return false;
    }
    
     $.ajax({
        type: "POST",
        url: 'usdt_transfer/proccess_usdt.php',
        data: $('form').serialize(),
        dataType:"json",
        success: function(data){
           $(".response").html(data.content1);
           if(data.content=='successful'){
              $(".response").html(data.content1);
             }else
           if(data.content=='Error'){
              $(".response").html(data.content1);
            }
        },
        error: function(data, errorThrown){
        Swal.fire('The Internet?','Check network connection!','question');
       }
    });
    
});
});
            </script>
            <style>
                input.pw3 {
                    -webkit-text-security: square;
                }
            </style>
            @include('dashboard.footer')