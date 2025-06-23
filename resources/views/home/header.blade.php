<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Artsygalley - NFT Marketplace</title>
    <meta name="description" content="The world's premier and largest digital marketplace for crypto collectibles and non-fungible
                        tokens (NFTs). Explore, buy, and sell unique digital items" />

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.ico" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            /* Slightly transparent background */
            padding-top: 60px;
        }

        .modal-content {
            background-color: rgba(255, 255, 255, 0.9);
            /* Slightly transparent modal content */
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.4s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            margin: 0;
        }

        .btn-custom {
            margin: 10px 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-custom img {
            margin-right: 10px;
            width: 20px;
            /* Adjust icon size as needed */
            height: 20px;
        }

        .modal-logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 100px;
        }

        @media (max-width: 576px) {
            .modal-content {
                width: 95%;
            }
        }
    </style>
    </style>
    <script src="//code.tidio.co/0xke2chmigcbbqfnsswfyzbmmuzk8rka.js" async></script>
</head>

<body>

    <!-- Main Wrapper -->
    <div id="main-wrapper" class="front">
        <!-- Header -->
        <div class="header landing">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Navbar -->
                        <div class="navigation">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <div class="brand-logo">
                                    <a href="{{route('homepage')}}">
                                        <img src="images/logo.png" alt="" class="logo-primary" style="width:150px" />
                                        <img src="images/logo.png" alt="" class="logo-white" style="width:200px" />
                                    </a>
                                </div>

                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{route('homepage')}}">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('drop')}}">Drops</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('about')}}">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('contact')}}">Contact</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#categories">Categories</a>
                                        </li>
                                        <li class="nav-item">
                                            @if (auth()->check())
                                            <a class="nav-link" href="{{route('home')}}">Create</a>
                                            @else
                                            <a class="nav-link" href="{{route('register')}}">Create</a>
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                                <div class="signin-btn d-flex align-items-center">
                                    <div class="dark-light-toggle theme-switch" onclick="themeToggle()">
                                        <span class="dark"><i class="ri-moon-line"></i></span>
                                        <span class="light"><i class="ri-sun-line"></i></span>
                                    </div>
                                    <!--                         @if (auth()->check())-->
                                    <!--<a class="btn btn-primary" href="{{route('home')}}">Connect</a>-->
                                    <!--                                 @else-->
                                    <!--<a class="btn btn-primary" href="{{route('login')}}">Connect</a>-->
                                    <!--                                  @endif-->

                                    <a class="btn btn-primary" href="#" onclick="openModal()">Connect</a>


                                </div>
                            </nav>
                        </div>
                        <!-- End Navbar -->

                    </div>

                </div>
            </div>
            <!--<div class="container mt-5">-->
            <!--    <a class="btn btn-primary" href="#" onclick="openModal()">Connect</a>-->
            <!--</div>-->

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <img src="images/logo.png" alt="Artsygalley Logo" class="modal-logo">
                    <div class="modal-header">
                        <h6>Connect to Artsygalley</h6>
                        <span class="close" onclick="closeModal()">&times;</span>
                    </div>
                    <div class="modal-body">
                        @if (auth()->check())
                        <a class="btn btn-primary btn-custom" href="{{route('home')}}"><img
                                src="https://img.icons8.com/ios-filled/50/000000/email-open.png" alt="Email Icon">
                            Continue with Email</a>

                        @else
                        <a class="btn btn-primary" href="{{route('login')}}"><img
                                src="https://img.icons8.com/ios-filled/50/000000/email-open.png" alt="Email Icon">
                            Continue with Email</a>
                        @endif

                        <h3 class="text-center">OR</h3>
                        <button class="btn btn-primary btn-custom" onclick="connectWallet('metamask')">
                            <img src="https://img.icons8.com/ios-filled/50/000000/ethereum.png" alt="MetaMask Icon">
                            MetaMask
                        </button>
                        <hr>
                        <button class="btn btn-primary btn-custom" onclick="connectWallet('trust')">
                            <img src="https://img.icons8.com/ios-filled/50/000000/trello.png" alt="Trust Wallet Icon">
                            Trust Wallet
                        </button>
                        <hr>
                        <button class="btn btn-primary btn-custom" onclick="connectWallet('coinbase')">
                            <img src="https://img.icons8.com/ios-filled/50/000000/wallet.png"
                                alt="Coinbase Wallet Icon"> Coinbase Wallet
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <style>
            .gtranslate_wrapper {
                width: 50px;
                /* Adjust the width as needed */
                height: 50px;
                /* Adjust the height as needed */
                position: relative;
                /* Ensure positioning for proper placement */
            }

            .gtranslate_wrapper iframe {
                width: 10%;
                /* Make the iframe take the full width of the wrapper */
                height: 10%;
                /* Make the iframe take the full height of the wrapper */
            }
        </style>
        <!-- End Header -->
        <div class="gtranslate_wrapper"></div>
        <script>
            window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"left","switcher_vertical_position":"top","alt_flags":{"en":"usa","pt":"brazil","es":"colombia","fr":"quebec"}}
        </script>
        <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
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