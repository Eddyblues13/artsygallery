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
                        <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y" alt="Christina Mason" class="img-fluid rounded-circle mb-2"
                            width="128" height="128" />
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

@include('dashboard.footer')