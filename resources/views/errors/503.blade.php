<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Service Unavailable | Artisttocollectors</title>
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.ico">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Simple Header -->
    <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <nav class="flex items-center justify-between py-3 sm:py-4">
                <a href="/" class="block">
                    <img src="/images/logo.png" alt="Artisttocollectors Logo" class="h-10 sm:h-12 w-auto">
                </a>
            </nav>
        </div>
    </header>

    <!-- Error Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-16">
        <div class="text-center max-w-lg">
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-purple-50 rounded-full mb-6">
                    <i class="bi bi-wrench-adjustable text-purple-500 text-5xl"></i>
                </div>
                <h1 class="text-7xl font-bold text-slate-900 mb-2">503</h1>
                <h2 class="text-2xl font-bold text-slate-700 mb-4">Service Unavailable</h2>
                <p class="text-slate-500 text-lg leading-relaxed">
                    {{ $exception->getMessage() ?: "We're currently performing maintenance. We'll be back shortly. Thank
                    you for your patience." }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="javascript:location.reload()"
                    class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm hover:shadow hover:-translate-y-0.5">
                    <i class="bi bi-arrow-clockwise mr-2"></i> Refresh Page
                </a>
            </div>
            <div class="mt-8 p-4 bg-white rounded-xl border border-slate-200 shadow-sm">
                <p class="text-slate-600 text-sm">
                    <i class="bi bi-info-circle text-primary mr-1"></i>
                    This page will automatically retry in <span id="countdown" class="font-bold text-primary">30</span>
                    seconds.
                </p>
            </div>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="bg-slate-50 border-t border-slate-200 py-6">
        <div class="container mx-auto px-4 text-center text-slate-500 text-sm">
            &copy; {{ date('Y') }} <a href="/"
                class="text-primary hover:text-primary-dark font-bold">Artisttocollectors</a>. All Rights Reserved.
        </div>
    </footer>

    <script>
        let seconds = 30;
        const countdownEl = document.getElementById('countdown');
        const timer = setInterval(function() {
            seconds--;
            countdownEl.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(timer);
                location.reload();
            }
        }, 1000);
    </script>
</body>

</html>