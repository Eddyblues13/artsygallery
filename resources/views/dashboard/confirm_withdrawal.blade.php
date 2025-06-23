@include('dashboard.header')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
            <div class="btn btn-success">{{session('message')}}</div>
            @endif

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-15">Withdrawal<i class="bx bx-transfer">
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

                    <!----------Card Starts HERE------------>
                    <div class="payment-title" style="margin:10px">
                        <b>Please Confirm Your Withdrawal</b>

                        <hr>
                        <b>Details:</b>
                        <br>
                        <p><b>${{number_format( $data['amount'], 2, '.', ',')}}</b> amounting
                            <b>{{$data['amount']/$eth}} ETH</b> is about to be withdrawn to the wallet address
                            <b>{{$data['wallet']}}</b>
                        </p>

                        <form class='form-horizontal' action="{{ route('process.withdraw')}}" method='POST' id='id_load'
                            enctype='multipart/form-data'>
                            @csrf
                            <div class='col-sm-6'>
                                <input type="hidden" name="amount" value="{{$data['amount']}}">
                                <input type="hidden" name="eth" value="{{$data['amount']/$eth}}">
                                <input type="hidden" name="wallet" value="{{$data['wallet']}}">

                            </div>
                            <button type='submit' class='btn btn-success btn-sm btn-rounded shadow'> confirm</button>
                            <a href="" class='btn btn-danger btn-sm btn-rounded shadow float-right'> decline</a>
                        </form>

                    </div>



                </div>


            </div> <!-- container-fluid -->
        </div>

    </div>
</div>
</div>
<script>
    function fileValidation() {
            var fileInput = document.getElementById('imgInp');
            var filePath = fileInput.value;
            
            var img = document.getElementById("imgInp");
            // Allowing file type
            
            // var allowedExtensions = /(\.jpg)$/i;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(filePath)){
                 $(".response").html("<div class='alert alert-warning alert-dismissible fade show' role='alert'><i class='mdi mdi-alert-outline me-2'></i>Unsupported image format (JPG / JPEG format only) <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                fileInput.value = '';
                return false;
            } 
            
            if(img.files[0].size > 1509155){
            $(".response").html("<div class='alert alert-warning alert-dismissible fade show' role='alert'><i class='mdi mdi-alert-outline me-2'></i>Image size too large maximum, allowed.. 1.24mb <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
            fileInput.value = '';
                return false;
            }
            
    }


    function copyAdr1(){
        var copyText = document.getElementById("myInput1");
         copyText.select();


        /* Copy the text inside the text field */
        document.execCommand("copy");
         copyText.setSelectionRange(0, 99999);
         navigator.clipboard.writeText(copyText.value);
    }
</script>
@include('dashboard.footer')