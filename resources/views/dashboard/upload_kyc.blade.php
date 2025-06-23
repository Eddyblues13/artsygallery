@include('dashboard.header')
<main class="content">
    <div class="container d-flex flex-column">
        <div class="row vh-10">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">
                        <p class="h2">Upload KYC</p>
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
                                
                                <!-- Upload KYC Form -->
 <form id="kycForm" action="{{ url('/upload-kyc') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="idcard">Upload ID Card</label>
        <input type="file" name="idcard" id="idcard" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>

<!-- Progress Bar -->
<div class="progress mt-3" style="display: none;">
    <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>

<!-- Success Message -->
<div id="statusMessage" class="mt-3"></div>
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
    document.getElementById('kycForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = document.getElementById('kycForm');
        const formData = new FormData(form);
        const progressBar = document.getElementById('progressBar');
        const progressDiv = document.querySelector('.progress');
        const statusMessage = document.getElementById('statusMessage');

        // Reset the progress bar
        progressBar.style.width = '0%';
        progressBar.setAttribute('aria-valuenow', '0');
        progressDiv.style.display = 'block';

        // Create an AJAX request
        const xhr = new XMLHttpRequest();
        
        xhr.open('POST', '{{ route('uploadKyc') }}', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        // Monitor upload progress
        xhr.upload.onprogress = function(event) {
            if (event.lengthComputable) {
                const percentComplete = (event.loaded / event.total) * 100;
                progressBar.style.width = percentComplete + '%';
                progressBar.setAttribute('aria-valuenow', percentComplete);
            }
        };

        // When the request is complete
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Upload success
                statusMessage.innerHTML = '<div class="alert alert-success">Document uploaded successfully. Please wait for approval.</div>';
            } else {
                // Handle error
                statusMessage.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
            }
            // Hide the progress bar after completion
            progressDiv.style.display = 'none';
        };

        // Send the form data
        xhr.send(formData);
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