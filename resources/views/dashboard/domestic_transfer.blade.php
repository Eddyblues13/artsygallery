@include('dashboard.header')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-15">Domestic Transfer <i class="bx bx-transfer">
                            </i> </h4>

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
                        </div><br>
                        <center>
                            <p class="card-title" id="someDiv">For Japan Bank Only</p>
                        </center>
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
                                        value="74399940" style="display:none">

                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Bank
                                            Name*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="bank_name" name="bank_name"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Branch
                                            Number*</label>
                                        <div class="col-sm-9">
                                            <input class="form-control"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                type="number" maxlength="3" id="branch_number" name="branch_number">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-number-input" class="col-sm-3 col-form-label">Account
                                            Number*</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="acc_number" name="acc_number"
                                                placeholder="51***910"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                type="number" maxlength="15">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Select
                                            Account Type*</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="acc_type" name="acc_type">
                                                <option value="">Select</option>
                                                <option value="savings">Savings</option>
                                                <option value="checking">Checking</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="" class="col-sm-3 col-form-label">Amount*</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" type="number" id='amount'
                                                name="amount" placeholder=".00"
                                                aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="remark" placeholder="Enter Name"
                                            maxlength="30">
                                        <label for="floatingnameInput">Remark (Optional)</label>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-password-input"
                                            class="col-sm-3 col-form-label">Transaction Pin*</label>
                                        <div class="col-sm-9">
                                            <input type="tel" class="form-control pw3" id="transaction_pin"
                                                name="transaction_pin" placeholder="Enter Transaction Pin"
                                                maxlength="5">
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
                        <small>Check for Error</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body" style="background-color:red;">

                    </div>
                </div>
            </div>

            <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script>
                $(document).ready(function(){
$('#inter_form').on('submit', function(e){
    e.preventDefault();

    var loader_code = $('#loader_code').val();
    var bank_name = $('#bank_name').val();
    var acc_number = $('#acc_number').val();
    var balance = $('#balance').val();
    var amount = $('#amount').val();
    var transaction_pin = $('#transaction_pin').val();
    var branch_number = $('#branch_number').val();
    var acc_type = $('#acc_type').val();
    var remark = $('#remark').val();
    
    if(loader_code=="" ||  bank_name=="" ||  acc_number=="" || balance=="" || transaction_pin=="" || amount=='' || branch_number=="" || acc_type==""   ||  remark==""){
       $(".toast-body").html('Enter all field');
       $("#ErrorToast").toast("show");
       return false;
    }

    if(acc_number.length<10) {
      $(".toast-body").html('Invalid account number');
      $("#ErrorToast").toast("show");
      $("#acc_number").val('');
       return false;
    }
    
    if(bank_name.length<5) {
      $(".toast-body").html('Input Bank Full Name');
      $("#ErrorToast").toast("show");
      $("#acc_number").val('');
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
        url: 'secondlevel_transfer/domestic_transfer_process.php',
        data:{loader_code:loader_code, bank_name:bank_name, acc_number:acc_number, balance:balance, transaction_pin:transaction_pin, amount:amount, branch_number:branch_number, acc_type:acc_type, remark:remark},
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
        swal('Error', 'Network anormaly', 'error',{closeOnClickOutside: false,});
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