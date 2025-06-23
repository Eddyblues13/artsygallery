@include('dashboard.header')
<main class="content">
    <div class="container d-flex flex-column">
        <div class="row vh-10">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <p class="h2">Upload Your NFT</p>
                    </div>
                    @if (session('error'))
                    <div class="alert box-bdr-red alert-dismissible fade show text-red" role="alert">
                        <b>Error!</b>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif (session('status'))
                    <div class="alert box-bdr-green alert-dismissible fade show text-green" role="alert">
                        <b>Success!</b> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <form id="uploadForm" action="{{ route('save.nft') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="nft_name" required>
                                        <label for="floatingnameInput">NFT NAME</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="charges" name="nft_price"
                                            required>
                                        <label for="floatingnameInput">BID(PRICE) In USD</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="month" name="gas_fee"
                                            aria-label="Floating label select example" required>
                                            <option selected>select</option>
                                            <option value="1">with gas fee</option>
                                            <option value="0">without gas fee</option>
                                        </select>
                                        <label for="floatingSelectGrid">Gas Fee</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="new_password2"
                                            name="ntf_description" required>
                                        <label for="floatingnameInput">DESCRIPTION</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-lg" id="imgInp" accept="image/*"
                                            name="image" type="file" required>
                                        <label for="floatingnameInput">IMAGE</label>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%;"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <div>
                                        <button type="submit" id="otp" class="btn btn-primary w-md">SAVE</button>
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

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            $('#progressBar').css('width', percentComplete + '%');
                            $('#progressBar').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#progressBar').css('width', '0%');
                    $('#progressBar').text('0%');
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your image has been uploaded successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error uploading your image.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>

<style>
    input.pw2 {
        -webkit-text-security: square;
    }

    input.pw3 {
        -webkit-text-security: square;
    }
</style>

@include('dashboard.footer')