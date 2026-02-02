<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Dashboard - Artsygalley" />
    <meta name="author" content="AdminKit">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.ico" />

    <title>Admin Dashboard - Artsygalley</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <style>
        /* Disable text selection */
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Make buttons larger by default */
        .btn:not(.btn-lg):not(.btn-sm) {
            padding: 0.6rem 1.2rem;
            font-size: 0.95rem;
        }

        .btn-group .btn {
            margin: 0 4px;
            padding: 0.6rem 1.2rem;
            font-size: 0.95rem;
        }

        /* Ensure table action buttons are visible */
        .table .btn {
            min-width: 80px;
        }
    </style>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{route('admin.dashboard')}}">
                    <span class="align-middle">Admin Panel</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Dashboard
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Users Management
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('view.users') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">All Users</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Artworks Management
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.approve.nft') }}">
                            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Approve Artworks</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('users.uploaded.nft') }}">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">All Artworks</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.upload.nft') }}">
                            <i class="align-middle" data-feather="upload"></i> <span class="align-middle">Upload Artwork</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.buy.nft') }}">
                            <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Artwork Market</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Transactions
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('user.transaction') }}">
                            <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">All Transactions</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Settings
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('update.wallet') }}">
                            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Wallet Settings</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('update.whatsapp') }}">
                            <i class="align-middle" data-feather="phone"></i> <span class="align-middle">WhatsApp API</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.change.password') }}">
                            <i class="align-middle" data-feather="lock"></i> <span class="align-middle">Change Password</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('send.user.email') }}">
                            <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Send Email</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.popup.messages') }}">
                            <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Popup Messages</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.withdrawal.modal') }}">
                            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Withdrawal Success Modal</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.currency.settings') }}">
                            <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Currency Settings</span>
                        </a>
                    </li>

                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">
                        <div class="d-grid">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
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
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
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
                                                <div class="text-dark">Pending Approvals</div>
                                                <div class="text-muted small mt-1">You have pending artwork approvals.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
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
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark">{{Auth::guard('admin')->user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{route('admin.change.password')}}"><i class="align-middle me-1" data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <script type="text/javascript">
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
