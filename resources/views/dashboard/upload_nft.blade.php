@include('dashboard.header')
<main class="content">
    <div class="container d-flex flex-column">
        <div class="row vh-10">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <p class="h2">Upload Your NFT</p>
                        @if($activeCurrency ?? null)
                        <p class="text-muted small mb-0">Display currency: {{ $activeCurrency->currency_name }} ({{ $activeCurrency->currency_symbol }})</p>
                        @endif
                    </div>
                    @include('dashboard.alert')
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
                                    <div class="mb-3">
                                        <label class="form-label">BID (Price) in {{ $activeCurrency->currency_code ?? 'USD' }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{ $activeCurrency->currency_symbol ?? '$' }}</span>
                                            <input type="number" class="form-control" id="charges" name="nft_price"
                                                placeholder="0.00" step="0.01" min="0" required>
                                        </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            
            // Show loading alert immediately
            Swal.fire({
                title: 'Uploading NFT...',
                html: `
                    <p class="mb-3">Please wait while we publish your NFT.</p>
                    <div class="progress" style="height: 25px; background-color: #f0f0f0; border-radius: 5px; overflow: hidden;">
                        <div id="swal-progress-bar" 
                             class="progress-bar progress-bar-striped progress-bar-animated" 
                             role="progressbar" 
                             style="width: 0%; height: 100%; background-color: #3b7ddd; color: white; display: flex; align-items: center; justify-content: center; transition: width 0.3s ease;">
                             0%
                        </div>
                    </div>
                `,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    // We don't call Swal.showLoading() because it hides the custom HTML's structure in some versions
                    // Instead we just keep the modal open without buttons
                }
            });

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            console.log('Upload Progress: ' + percentComplete + '%');
                            
                            // Update the bar inside SweetAlert
                            const progressBar = document.getElementById('swal-progress-bar');
                            if (progressBar) {
                                progressBar.style.width = percentComplete + '%';
                                progressBar.textContent = percentComplete + '%';
                            }
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
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your NFT has been uploaded successfully.',
                        icon: 'success',
                        confirmButtonText: 'Great!',
                        confirmButtonColor: '#3b7ddd'
                    }).then(function() {
                        location.href = "{{ route('my.nft') }}";
                    });
                },
                error: function(response) {
                    let errorMessage = 'There was an error uploading your NFT.';
                    if(response.responseJSON && response.responseJSON.message) {
                        errorMessage = response.responseJSON.message;
                    } else if (response.responseText) {
                        errorMessage = 'Server error. Please check file size and connection.';
                    }
                    
                    Swal.fire({
                        title: 'Upload Failed',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            });
        });
    });
</script>

<style>
    .progress {
        box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
    }
    .progress-bar {
        font-weight: bold;
        text-shadow: 1px 1px 1px rgba(0,0,0,0.2);
    }
    input.pw2 {
        -webkit-text-security: square;
    }

    input.pw3 {
        -webkit-text-security: square;
    }
</style>

@include('dashboard.footer')