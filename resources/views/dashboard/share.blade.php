<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
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
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">AdminKit</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{route('dashboard')}}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>



                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('get.deposit')}}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Deposit</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('withdrawal')}}">
                            <i class="align-middle" data-feather="user-plus"></i> <span
                                class="align-middle">Withdrawal</span>
                        </a>
                    </li>


                    <li class="sidebar-header">
                        NFTS
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
                            <a id='logout_account' class="btn btn-primary">Logout</a>
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
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                @if (Auth::check())
                                <span class="text-dark">{{Auth::user()->name}}</span>
                                @endif
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

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">{{ $nft->ntf_name }}</h1>
                        <a class="badge bg-dark text-white ms-2" href="{{ url('/') }}">
                            Back to Home
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-12">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('user/uploads/nfts/' . $nft->ntf_image) }}"
                                    alt="{{ $nft->ntf_name }}" style="height: 500px; object-fit: cover;">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ $nft->ntf_name }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex gap-3 align-items-center mb-3">
                                        <img src="https://img.icons8.com/ios-filled/24/000000/ethereum.png"
                                            alt="Ethereum Icon">
                                        <b>{{ number_format($nft->nft_eth_price, 2) }} ETH</b>
                                        <img src="https://img.icons8.com/ios-filled/24/000000/us-dollar.png"
                                            alt="Dollar Icon">
                                        <b>${{ number_format($nft->nft_price, 2) }}</b>
                                    </div>
                                    <div class="views mb-3">
                                        <img src="https://img.icons8.com/ios-filled/24/000000/visible.png"
                                            alt="Eye Icon">
                                        <span class="viewCount"></span> Views
                                    </div>

                                    <a href="{{ route('login') }}" class="btn btn-success">
                                        Buy NFT
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <script>
                // Function to generate random views between a specified range
                function getRandomViews(min, max) {
                    return Math.floor(Math.random() * (max - min + 1)) + min;
                }
            
                // Assign random views to the single NFT view
                document.addEventListener('DOMContentLoaded', function() {
                    const viewCount = document.querySelector('.viewCount');
                    viewCount.innerText = getRandomViews(100, 1000);
                });
            </script>

            @include('dashboard.footer')