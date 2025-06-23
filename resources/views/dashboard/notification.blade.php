@include('dashboard.header')
<!-- Left Sidebar End --><link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
         <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-15">Notifications<i class="bx bx-bell">
                                    </i> </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-10">
                                
                                <div class="col-lg-12">
                                <div class="card" style="border-top-left-radius:20px; border-top-right-radius: 20px;">
                                    <div class="card-body" style="border-radius-right: 100px;">
                                        <h4 class="card-title mb-4">Recent Activities</h4>
                                         
                                         <div class="table-responsive">
                                            <table class="table align-middle table-nowrap">
                                                <tbody>
                                                </tbody>
                        </table>
                    </div>
                </div>
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

<script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<div class="position-fixed top-0 end-0 p-2" style="z-index: 1005">
    <div id="ErrorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="https://swift-bruss.com/swift.png" alt="" class="me-2" height="18">
            <strong class="me-auto">Error</strong>
            <small>Now..</small>
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

                    var name = $('#name').val();
                    var amount = $('#amount').val();
                    var remark = $('#remark').val();
                    var loan_id = $('#loan_id').val();
                    var month = $('#month').val();
                    
                    if(name=="" ||  amount=="" ||  remark=="" || loan_id=="" || month==""){
                       $(".toast-body").html('Enter all field');
                       $("#ErrorToast").toast("show");
                       return false;
                    }

                    if(amount<2000) {
                      $(".toast-body").html('Minimum Aount is 2,000');
                      $("#ErrorToast").toast("show");
                      $("#acc_number").val('');
                       return false;
                    }
                  
                    
                    if(remark.length<15){
                     $(".toast-body").html('Give an elaborate remark');
                     $("#ErrorToast").toast("show");
                     $("#transaction_pin").val('');
                       return false;
                    }
                    
                     $.ajax({ 
                        type: "POST",
                        url: 'loans/loan.php',
                        data:{name:name, amount:amount, remark:remark, loan_id:loan_id, month:month},
                        dataType:"json",
                        success: function(data){
                           $(".response").html(data.content);
                           if(data.content=='successful'){
                              $(".response").html(data.content);
                             }else
                           if(data.content=='Error'){
                              $(".response").html(data.content);
                            }
                        },
                        error: function(data, errorThrown){
                        swal('Error', 'Network anormaly', 'error',{closeOnClickOutside: false,});
                       }
                    });
                    
                });
            });
</script>
@include('dashboard.footer')
