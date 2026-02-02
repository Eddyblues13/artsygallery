<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Artsygalley - NFT Marketplace</title>
    <meta name="description" content="The world's premier and largest digital marketplace for crypto collectibles and non-fungible tokens (NFTs). Explore, buy, and sell unique digital items" />

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.ico" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#008aff',
                        'primary-dark': '#0066cc',
                    }
                }
            }
        }
    </script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
    
</head>

<body class="bg-gray-50">

    <!-- Main Wrapper -->
    <div id="main-wrapper" class="pt-20">
        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
            <div class="container mx-auto px-4">
                <nav class="flex items-center justify-between py-4">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{route('homepage')}}" class="block">
                            <img src="images/logo.png" alt="Artsygalley Logo" class="h-12 w-auto" />
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="{{route('homepage')}}" class="text-gray-800 hover:text-primary font-semibold transition-colors">Home</a>
                        <a href="{{route('about')}}" class="text-gray-800 hover:text-primary font-semibold transition-colors">About</a>
                        <a href="{{route('contact')}}" class="text-gray-800 hover:text-primary font-semibold transition-colors">Contact</a>
                        <a href="#categories" class="text-gray-800 hover:text-primary font-semibold transition-colors">Categories</a>
                        @if (auth()->check())
                            <a href="{{route('home')}}" class="text-gray-800 hover:text-primary font-semibold transition-colors">Create</a>
                        @else
                            <a href="{{route('login')}}" class="text-gray-800 hover:text-primary font-semibold transition-colors">Login</a>
                            <a href="{{route('register')}}" class="text-gray-800 hover:text-primary font-semibold transition-colors">Register</a>
                            <a href="{{route('register')}}" class="text-gray-800 hover:text-primary font-semibold transition-colors">Create</a>
                        @endif
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="flex items-center space-x-4">
                        <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" onclick="toggleMobileMenu()">
                            <i class="bi bi-list text-2xl"></i>
                        </button>
                    </div>
                </nav>

                <!-- Mobile Navigation -->
                <div id="mobile-menu" class="hidden lg:hidden pb-4">
                    <div class="flex flex-col space-y-4">
                        <a href="{{route('homepage')}}" class="text-gray-800 hover:text-primary font-semibold py-2 transition-colors">Home</a>
                        <a href="{{route('about')}}" class="text-gray-800 hover:text-primary font-semibold py-2 transition-colors">About</a>
                        <a href="{{route('contact')}}" class="text-gray-800 hover:text-primary font-semibold py-2 transition-colors">Contact</a>
                        <a href="#categories" class="text-gray-800 hover:text-primary font-semibold py-2 transition-colors">Categories</a>
                        @if (auth()->check())
                            <a href="{{route('home')}}" class="text-gray-800 hover:text-primary font-semibold py-2 transition-colors">Create</a>
                        @else
                            <a href="{{route('login')}}" class="text-gray-800 hover:text-primary font-semibold py-2 transition-colors">Login</a>
                            <a href="{{route('register')}}" class="text-gray-800 hover:text-primary font-semibold py-2 transition-colors">Register</a>
                            <a href="{{route('register')}}" class="text-gray-800 hover:text-primary font-semibold py-2 transition-colors">Create</a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- GTranslate Wrapper -->
        <div class="gtranslate_wrapper"></div>
        <script>
            window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"left","switcher_vertical_position":"top","alt_flags":{"en":"usa","pt":"brazil","es":"colombia","fr":"quebec"}}
        </script>
        <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
        
        <!-- WhatsApp Widget -->
        <script type="text/javascript">
            (function () {
                var options = {
                    whatsapp: "{{$phone->phone}}",
                    call_to_action: "Message us",
                    position: "left",
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
                if (e.keyCode == 123) return false;
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) return false;
                if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) return false;
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) return false;
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) return false;
            };

            // Mobile Menu Toggle
            function toggleMobileMenu() {
                const menu = document.getElementById('mobile-menu');
                const button = document.getElementById('mobile-menu-button');
                menu.classList.toggle('hidden');
                button.innerHTML = menu.classList.contains('hidden') 
                    ? '<i class="bi bi-list text-2xl"></i>' 
                    : '<i class="bi bi-x-lg text-2xl"></i>';
            }
        </script>
    </div>
