<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Artsygalley</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Add this in the <head> section of your layout file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="{{asset('assets/fonts/bootstrap/bootstrap-icons.css')}}" />

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}" />

    <!-- *************
			************ Vendor Css Files *************
		************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}" />





</head>

<body data-sidebar="dark" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{route('dashboard')}}" class="logo logo-dark">
                            <span class="logo-sm"> homepage/images/logo-dark.png"
                                <img src="{{asset('homepage/images/logo-dark.png')}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('homepage/images/logo-dark.png')}}" alt="" height="17">
                            </span>
                        </a>

                        <a href="{{route('dashboard')}}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{asset('homepage/images/logo-dark.png')}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('homepage/images/logo-dark.png')}}" alt="" height="19">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>


                </div>

                <div class="d-flex">




                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-bell bx-tada"></i>
                            <span class="badge bg-danger rounded-pill">1</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-4">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#!" class="small" key="t-view-all"> View All</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{asset('assets/images/new.png')}}"
                                .png" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{Auth::user()->name}} </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="{{route('profile')}}"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i> <span
                                    key="t-profile">Profile</span></a>
                            <a class="dropdown-item d-block" href="{{route('settings')}}"><span
                                    class="badge bg-success float-end"></span><i
                                    class="bx bx-wrench font-size-16 align-middle me-1"></i> <span
                                    key="t-settings">Settings</span></a>
                            <!-- <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" id='logout_account'><i
                                    class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                    key="t-logout">Logout</span></a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog bx-spin"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>
                        <li>
                            <a href="{{route('home')}}" class="has-arrow waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Homepage</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('dashboard')}}" class="has-arrow waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Dashboards</span>
                            </a>
                        </li>



                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-transfer"></i>
                                <span key="t-layouts">Upload NFT</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="{{route('upload.nft')}}" class="waves-effect" key="t-vertical">Upload
                                        NFT</a>
                                </li>

                                <li>
                                    <a href="{{route('my.nft')}}" class="waves-effect" key="t-vertical">My NFT</a>
                                </li>
                            </ul>

                        </li>
                        <li>
                            <a href="{{route('buy.nft')}}" class="waves-effect">
                                <i class="bx bx-credit-card-alt"></i>
                                <span key="t-projects">Buy NFT</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('get.deposit')}}" class=" waves-effect">
                                <i class="bx bxl-mastercard"></i>
                                <span key="t-layouts">Deposit</span>
                            </a>

                        </li>
                        <li>
                            <a href="{{route('withdrawal')}}" class=" waves-effect">
                                <i class="bx bx-transfer-alt"></i>
                                <span key="t-layouts">Withdraw</span>
                            </a>

                        </li>


                        <li class="menu-title" key="t-apps">Apps</li>

                        <li>
                            <a href="{{route('profile')}}" class="waves-effect">
                                <i class="bx bx-user"></i>
                                <span key="t-chat">My Profile</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('settings')}}" class="waves-effect">
                                <i class="bx bx-wrench"></i>
                                <span key="t-invoices">Account Settings</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-list-ol"></i>
                                <span key="t-layouts">Transactions</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="{{route('transactions')}}" class="waves-effect"
                                        key="t-vertical">Transactions</a>
                                </li>


                            </ul>
                        </li>
                        <li>
                            <a href="{{route('notification')}}" class="dropdown-item text-danger">
                                <i class="bx bx-bell bx-tada font-size-16 align-middle me-1 text-danger">
                                    <span key="t-logout">Notifications <span
                                            class="badge bg-danger rounded-pill">1</span></span> </i>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item text-danger">
                                <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"
                                    id='logout_account1'>
                                    <span key="t-logout">Logout</span> </i>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Left Sidebar End -->
        <link href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet"
            type="text/css" />
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
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
                    @elseif (session('message'))
                    <div class="alert box-bdr-green alert-dismissible fade show text-green" role="alert">
                        <b>Success!</b> {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="d-inline-flex gap-3">
                        <a href="{{route('buy.nft')}}" class="btn btn-success">Back To NFT Market</a>
                        <a href="{{route('dashboard')}}" class="btn btn-primary">Go to Dashboard</a>
                    </div>

                    <div class="row gx-3">

                        <div class="col-sm-4 col-12">
                            <div class="card">

                                <div class="card-img">
                                    <img src="{{asset('user/uploads/nfts/'.$nft->ntf_image)}}"
                                        class="card-img-top img-fluid" alt="Google Admin" />
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-2">{{$nft->ntf_name}}</h5>
                                    <p class="mb-3">
                                        {{$nft->ntf_description}}
                                    </p>
                                    <div class="d-inline-flex gap-3">
                                        <b>Owner: {{$nft->ntf_owner}}</b>

                                    </div>
                                    <br>
                                    <div class="d-inline-flex gap-3">
                                        <b>{{ number_format($nft->nft_eth_price, 2)}}ETH Floor</b>
                                        <b>{{ number_format($nft->nft_eth_price, 2) }}ETH Volume</b>
                                    </div>
                                    @if($nft->user_id == Auth::user()->id)
                                    <br>
                                    <br>
                                    <br>
                                    <h5 class="card-title mb-2">This NFT Belongs to you</h5>
                                    <br>
                                    <a href="#" class="btn btn-primary">My Nfts</a>
                                    @else
                                    <form class='form-horizontal' action="{{route('final.purchase.nft',$nft->id)}}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="login-box rounded-2 p-5">


                                            <input type="hidden" name="price" value="{{$nft->nft_price}}" />
                                            <input type="hidden" name="user" value="{{$nft->user_id}}" />


                                            <div class="d-grid py-3">
                                                <button type="submit" class="btn btn-lg btn-primary">
                                                    Purchase NFT
                                                </button>
                                            </div>



                                        </div>
                                </div>
                                </form>

                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">

                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <!-- <div class="mb-2">
                        <img src="assets/images/layouts/layout-1.jpg" class="img-thumbnail" alt="layout images">
                    </div> -->

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Use Light Mode</label>
                    </div>

                    <!-- <div class="mb-2">
                        <img src="assets/images/layouts/layout-2.jpg" class="img-thumbnail" alt="layout images">
                    </div> -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                        <label class="form-check-label" for="dark-mode-switch">Use Dark Mode</label>
                    </div>

                </div>

            </div>
            <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->

        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

        <!-- apexcharts -->
        <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- dashboard init -->
        <script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>

        <!-- Bootstrap Toasts Js -->
        <script src="{{asset('assets/js/pages/bootstrap-toastr.init.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>


        <!-- Required jQuery first, then Bootstrap Bundle JS -->

        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.js')}}"></script>
        <script src="{{asset('assets/js/moment.js')}}"></script>

        <!-- *************
			************ Vendor Js Files *************
		************* -->

        <!-- Overlay Scroll JS -->
        <script src="{{asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
        <script src="{{asset('assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

        <!-- News ticker -->
        <script src="{{asset('assets/vendor/newsticker/newsTicker.min.js')}}"></script>
        <script src="{{asset('assets/vendor/newsticker/custom-newsTicker.js')}}"></script>

        <!-- Main Js Required -->
        <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#logout_account, #logout_account1').click(function() {
        $.ajax({
            type: 'GET',
            url: '{{ route("logout") }}',
            dataType: 'json',
            success: function(data) {
                $('.logout').html(data.content);
                if (data.content == 'Logout Successful') {
                   $('.logout').html(data.content);
                  
                   window.location='../login'
                 
                } else
                if (data.content == 'Error') {
                    $('.logout').html(data.content);
                }
            },
            error: function(data, errorThrown) {
                Swal.fire('The Internet?', 'Check network connection!', 'question');
                return false;
            }
        });
    });


    $("#someDiv").hide();
    setInterval(function() {
        $("#someDiv").fadeIn(1000).fadeOut(2500);
    }, 0)
</script>