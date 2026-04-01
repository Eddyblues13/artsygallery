<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Artisttocollectors - NFT Marketplace</title>
    <meta name="description"
        content="The world's premier and largest digital marketplace for crypto collectibles and non-fungible tokens (NFTs). Explore, buy, and sell unique digital items" />

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
        <header
            class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-100 transition-all duration-300">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
                <nav class="flex items-center justify-between py-3 sm:py-4">
                    <!-- Logo -->
                    <div class="flex-shrink-0 mr-4">
                        <a href="{{route('homepage')}}" class="block">
                            <img src="images/logo.png" alt="Artisttocollectors Logo" class="h-10 sm:h-12 w-auto" />
                        </a>
                    </div>

                    <!-- Search Bar -->
                    <div class="hidden lg:flex flex-1 max-w-2xl mx-6 relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i
                                class="bi bi-search text-slate-400 group-focus-within:text-primary transition-colors"></i>
                        </div>
                        <input type="text"
                            class="block w-full pl-11 pr-4 py-2.5 border border-slate-200 rounded-xl leading-5 bg-slate-50/50 text-slate-900 placeholder-slate-500 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300 sm:text-sm shadow-inner"
                            placeholder="Search items, collections, and accounts">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <div
                                class="hidden sm:flex items-center text-slate-400 text-xs font-semibold bg-white border border-slate-200 rounded-md px-2 py-1 shadow-sm">
                                /</div>
                        </div>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                        <a href="{{route('homepage')}}"
                            class="text-slate-600 hover:text-slate-900 font-bold transition-colors">Explore</a>
                        <a href="{{route('about')}}"
                            class="text-slate-600 hover:text-slate-900 font-bold transition-colors">About</a>
                        @if (auth()->check())
                        <a href="{{route('home')}}"
                            class="text-slate-600 hover:text-slate-900 font-bold transition-colors">Dashboard</a>
                        <a href="{{route('home')}}"
                            class="px-5 py-2.5 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm hover:shadow hover:-translate-y-0.5 whitespace-nowrap">Create</a>
                        @else
                        <a href="{{route('login')}}"
                            class="text-slate-600 hover:text-slate-900 font-bold transition-colors">Login</a>
                        <a href="{{route('register')}}"
                            class="px-5 py-2.5 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm hover:shadow hover:-translate-y-0.5 whitespace-nowrap">Sign
                            Up</a>
                        @endif
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="flex items-center space-x-4">
                        <button id="mobile-menu-button"
                            class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
                            onclick="toggleMobileMenu()">
                            <i class="bi bi-list text-2xl"></i>
                        </button>
                    </div>
                </nav>

                <!-- Mobile Navigation -->
                <div id="mobile-menu" class="hidden lg:hidden pb-6 pt-2 border-t border-slate-100 mt-2">
                    <!-- Mobile Search -->
                    <div class="mb-6 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-search text-slate-400"></i>
                        </div>
                        <input type="text"
                            class="block w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/20"
                            placeholder="Search items, collections...">
                    </div>

                    <div class="flex flex-col space-y-3">
                        <a href="{{route('homepage')}}"
                            class="text-slate-700 hover:text-primary font-bold py-2 px-4 rounded-lg hover:bg-slate-50 transition-colors">Explore</a>
                        <a href="{{route('about')}}"
                            class="text-slate-700 hover:text-primary font-bold py-2 px-4 rounded-lg hover:bg-slate-50 transition-colors">About</a>
                        @if (auth()->check())
                        <a href="{{route('home')}}"
                            class="text-slate-700 hover:text-primary font-bold py-2 px-4 rounded-lg hover:bg-slate-50 transition-colors">Dashboard</a>
                        <a href="{{route('home')}}"
                            class="mt-4 text-center px-5 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-colors">Create</a>
                        @else
                        <a href="{{route('login')}}"
                            class="text-slate-700 hover:text-primary font-bold py-2 px-4 rounded-lg hover:bg-slate-50 transition-colors">Login</a>
                        <a href="{{route('register')}}"
                            class="mt-4 text-center px-5 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-colors">Sign
                            Up</a>
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
                    whatsapp: "{{$phone->phone ?? ''}}",
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