<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The world's premier and largest digital marketplace for crypto collectibles and non-fungible
                        tokens (NFTs). Explore, buy, and sell unique digital items" />
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="The world's premier and largest digital marketplace for crypto collectibles and non-fungible
                        tokens (NFTs). Explore, buy, and sell unique digital items">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.ico" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Artsygalley - NFT Marketplace</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <style>
        /* Disable text selection */
        body {
            -webkit-user-select: none;
            /* Chrome, Safari, Opera */
            -moz-user-select: none;
            /* Firefox */
            -ms-user-select: none;
            /* Internet Explorer/Edge */
            user-select: none;
            /* Non-prefixed version */
        }
    </style>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{route('home')}}">
                    <span class="align-middle">Home</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ route('home') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('get.deposit') }}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Deposit</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('withdrawal') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span
                                class="align-middle">Withdrawal</span>
                        </a>
                    </li>

                    @auth
                    @if(auth()->user()->wallet_verify)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('wallet.edit') }}">
                            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Update
                                Wallet Address</span>
                        </a>
                    </li>
                    @endif
                    @endauth


                    <li class="sidebar-header">
                        NFTS
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('user.nft.drops')}}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">NFT
                                Drops</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('buy.nft')}}">
                            <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buy NFT</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('upload.nft')}}">
                            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Upload
                                NFT</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('my.nft')}}">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">My NFT</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('approved.nft')}}">
                            <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">My
                                Approved NFT</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('unapproved.nft')}}">
                            <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">My
                                Unapproved NFT</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('account.functionality')}}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Account
                                Functionality</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('approved.nft')}}">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">My sold
                                NFTs</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Account
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('buy.nft')}}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Buy NFT</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('profile')}}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Update
                                KYC</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('settings')}}">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span
                                class="align-middle">Settings</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('transactions')}}">
                            <i class="align-middle" data-feather="map"></i> <span
                                class="align-middle">Transactions</span>
                        </a>
                    </li>

                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">

                        <div class="d-grid">
                            <a href="{{route('logOut')}}" class="btn btn-primary">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="gtranslate_wrapper"></div>
                            <script>
                                window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"right","switcher_vertical_position":"top","alt_flags":{"en":"usa","pt":"brazil","es":"colombia","fr":"quebec"}}
                            </script>
                            <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <span class="text-dark">{{Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{route('profile')}}"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="pie-chart"></i>
                                    KYC</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('settings')}}"><i class="align-middle me-1"
                                        data-feather="settings"></i> Settings</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('logOut')}}">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <script type="text/javascript">
                (function () {
        var options = {
            whatsapp: "{{$phone->phone}}", // WhatsApp number
            call_to_action: "Message us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
            </script>
            <script>
                // Disable right-click
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        });

        // Disable specific keyboard shortcuts
        document.onkeydown = function(e) {
            if (e.keyCode == 123) { // F12
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) { // Ctrl+Shift+I
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) { // Ctrl+U
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) { // Ctrl+Shift+C
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) { // Ctrl+Shift+J
                return false;
            }
        };
            </script>
            <!-- Smartsupp Live Chat script -->
            <script type="text/javascript">
                var _smartsupp = _smartsupp || {};
_smartsupp.key = '76f98c411b5f56db3f5477a933f568ebdda0446a';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
            </script>
            <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>