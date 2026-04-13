<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Artisttocollectors</title>
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
                @if(session('message'))
                <div class="btn btn-success">{{session('message')}}</div>
                @endif

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-15">Make Deposit <iconify-icon inline
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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"></h4>
                            @include('dashboard.alert')
                            <form method="post" action="{{route('make.deposit')}}">
                                {{csrf_field()}}
                                <div class="row mb-4">
                                    <label for="horizontal-number-input" class="col-sm-3 col-form-label">Amount</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" style="color:blue" id="amount" name="amount"
                                            placeholder="Amount in USD" onkeyup="showHint(this.value)"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            type="number" maxlength="15" required>
                                        <p id="txtHint"> &nbsp; .</p>
                                        <div id="eth-conversion" class="text-muted small" style="display:none;">
                                            ≈ <span id="eth-value">0</span> ETH
                                            <span class="text-muted" style="font-size:0.75rem;">(live rate)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button id="send_pin"
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
        <!-- END layout-wrapper -->



        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="https://artisttocollectors.com/assets/libs/jquery/jquery.min.js"></script>
        <script src="https://artisttocollectors.com/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://artisttocollectors.com/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="https://artisttocollectors.com/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="https://artisttocollectors.com/assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="https://artisttocollectors.com/assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- dashboard init -->
        <script src="https://artisttocollectors.com/assets/js/pages/dashboard.init.js"></script>

        <!-- Bootstrap Toasts Js -->
        <script src="https://artisttocollectors.com/assets/js/pages/bootstrap-toastr.init.js"></script>

        <!-- App js -->
        <script src="https://artisttocollectors.com/assets/js/app.js"></script>


        <!-- Required jQuery first, then Bootstrap Bundle JS -->
        <script src="https://artisttocollectors.com/assets/js/jquery.min.js"></script>
        <script src="https://artisttocollectors.com/assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://artisttocollectors.com/assets/js/modernizr.js"></script>
        <script src="https://artisttocollectors.com/assets/js/moment.js"></script>

        <!-- *************
			************ Vendor Js Files *************
		************* -->

        <!-- Overlay Scroll JS -->
        <script src="https://artisttocollectors.com/assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js">
        </script>
        <script src="https://artisttocollectors.com/assets/vendor/overlay-scroll/custom-scrollbar.js"></script>

        <!-- News ticker -->
        <script src="https://artisttocollectors.com/assets/vendor/newsticker/newsTicker.min.js"></script>
        <script src="https://artisttocollectors.com/assets/vendor/newsticker/custom-newsTicker.js"></script>

        <!-- Main Js Required -->
        <script src="https://artisttocollectors.com/assets/js/main.js"></script>
</body>

</html>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#logout_account, #logout_account1').click(function() {
        $.ajax({
            type: 'GET',
            url: 'https://artisttocollectors.com/log_out',
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

<script>
    (function() {
    let ethPrice = null;
    const amountInput = document.getElementById('amount');
    const ethDiv = document.getElementById('eth-conversion');
    const ethSpan = document.getElementById('eth-value');

    fetch("/api/eth-price")
        .then(r => r.json())
        .then(d => { ethPrice = d.eth_price_usd; updateEth(); })
        .catch(() => {});

    function updateEth() {
        const val = parseFloat(amountInput.value);
        if (!ethPrice || !val || val <= 0) { ethDiv.style.display = 'none'; return; }
        const eth = val / ethPrice;
        ethSpan.textContent = eth < 0.000001 ? eth.toExponential(2) : parseFloat(eth.toFixed(6));
        ethDiv.style.display = 'block';
    }

    amountInput.addEventListener('input', updateEth);
    amountInput.addEventListener('keyup', updateEth);
})();
</script>