@include('dashboard.header')
<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Profile</h1>
            <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
                upload KYC
            </a>
        </div>
        <div class="row">
            <div class="col-md-4 col-xl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Details</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="position-relative d-inline-block mb-3">
                            @if(Auth::user()->profile_picture)
                            <img src="{{ Auth::user()->profile_picture }}" alt="{{ Auth::user()->name }}"
                                class="img-fluid rounded-circle mb-2" width="128" height="128"
                                style="object-fit: cover;" />
                            @else
                            <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y"
                                alt="{{ Auth::user()->name }}" class="img-fluid rounded-circle mb-2" width="128"
                                height="128" />
                            @endif
                            <label for="profilePicInput"
                                class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; cursor: pointer; border: 3px solid #fff;"
                                title="Change Profile Picture">
                                <span data-feather="camera" style="width: 16px; height: 16px;"></span>
                            </label>
                        </div>
                        <form action="{{ route('upload.profile.picture') }}" method="POST" enctype="multipart/form-data"
                            id="profilePicForm">
                            @csrf
                            <input type="file" name="profile_picture" id="profilePicInput" accept="image/*"
                                class="d-none" onchange="document.getElementById('profilePicForm').submit();">
                        </form>
                        <h5 class="card-title mb-0">{{Auth::user()->name}}</h5>
                        <div class="text-muted mb-2">Kyc</div>

                        <div>

                            @if(Auth::user()->id_card_status ==='1')
                            <div class='cols-6'>
                                <a href='javascript: void(0);'
                                    class='btn btn-success waves-effect waves-light btn-sm'>Verified<i
                                        class='mdi mdi-check ms-1'></i></a>
                            </div>
                            @elseif(Auth::user()->id_card_status==='0')
                            <div class='cols-6'>
                                <a href='javascript: void(0);'
                                    class='btn btn-danger waves-effect waves-light btn-sm'>Not Verified<i
                                        class='mdi mdi-check ms-1'></i></a>
                            </div>
                            @else
                            <div class='cols-6'>
                                <a href='javascript: void(0);'
                                    class='btn btn-danger waves-effect waves-light btn-sm'>Not Verified<i
                                        class='mdi mdi-check ms-1'></i></a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profile Link Share Section -->
                    <div class="card-body border-top">
                        <h5 class="h6 card-title"><span data-feather="share-2" class="feather-sm me-1"></span>Share Your
                            Profile</h5>
                        <p class="text-muted small mb-3">Share your public profile link with others to showcase your NFT
                            collection.</p>

                        <!-- Profile URL Input -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="profileUrl"
                                value="{{ route('public.profile', Auth::user()->id) }}" readonly
                                style="background: #f8f9fa;">
                            <button class="btn btn-primary" type="button" id="copyBtn" onclick="copyProfileLink()">
                                <span data-feather="clipboard" class="feather-sm me-1"></span> Copy
                            </button>
                        </div>

                        <!-- Social Share Buttons -->
                        <div class="d-flex flex-wrap gap-2">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('public.profile', Auth::user()->id)) }}&text={{ urlencode('Check out my NFT collection!') }}"
                                target="_blank" class="btn btn-dark btn-sm">
                                <i class="fab fa-x-twitter me-1"></i> X
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('public.profile', Auth::user()->id)) }}"
                                target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-facebook me-1"></i> Facebook
                            </a>
                            <a href="https://wa.me/?text={{ urlencode('Check out my NFT collection: ' . route('public.profile', Auth::user()->id)) }}"
                                target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp
                            </a>
                            <a href="{{ route('public.profile', Auth::user()->id) }}" target="_blank"
                                class="btn btn-outline-secondary btn-sm">
                                <span data-feather="external-link" class="feather-sm me-1"></span> View Profile
                            </a>
                        </div>
                    </div>
                    @include('dashboard.alert')
                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <form id="uploadForm" action="{{ url('/upload-kyc') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-lg" id="imgInp" accept="image/*"
                                            name="idcard" type="file" required>
                                        <label for="floatingnameInput">IMAGE</label>
                                    </div>
                                    <div>
                                        <button type="submit" id="otp" class="btn btn-primary w-md">Upload KYC</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />

                    <div class="card-body">
                        <h5 class="h6 card-title">About</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span>Full Name: <a
                                    href="#">{{Auth::user()->name}}</a></li>
                            <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span>Email: <a
                                    href="#">{{Auth::user()->email}}</a></li>

                            <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>Mobile <a
                                    href="#">{{Auth::user()->phone}}</a></li>
                            <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> Country <a
                                    href="#">{{Auth::user()->country}}</a></li>
                        </ul>
                    </div>
                    <hr class="my-0" />

                </div>
            </div>


        </div>

    </div>
</main>

<script>
    function copyProfileLink() {
    const profileUrl = document.getElementById('profileUrl');
    const copyBtn = document.getElementById('copyBtn');
    
    // Copy to clipboard
    navigator.clipboard.writeText(profileUrl.value).then(function() {
        // Success feedback
        const originalContent = copyBtn.innerHTML;
        copyBtn.innerHTML = '<span data-feather="check" class="feather-sm me-1"></span> Copied!';
        copyBtn.classList.remove('btn-primary');
        copyBtn.classList.add('btn-success');
        
        // Re-initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        // Reset after 2 seconds
        setTimeout(function() {
            copyBtn.innerHTML = originalContent;
            copyBtn.classList.remove('btn-success');
            copyBtn.classList.add('btn-primary');
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }, 2000);
    }).catch(function(err) {
        // Fallback for older browsers
        profileUrl.select();
        document.execCommand('copy');
        
        // Show feedback
        const originalContent = copyBtn.innerHTML;
        copyBtn.innerHTML = '<span data-feather="check" class="feather-sm me-1"></span> Copied!';
        copyBtn.classList.remove('btn-primary');
        copyBtn.classList.add('btn-success');
        
        setTimeout(function() {
            copyBtn.innerHTML = originalContent;
            copyBtn.classList.remove('btn-success');
            copyBtn.classList.add('btn-primary');
        }, 2000);
    });
}
</script>

@include('dashboard.footer')