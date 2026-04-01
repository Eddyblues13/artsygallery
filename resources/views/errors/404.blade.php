<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Artisttocollectors</title>
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
                <a href="/" class="text-slate-600 hover:text-primary font-bold transition-colors">
                    <i class="bi bi-house-door mr-1"></i> Home
                </a>
            </nav>
        </div>
    </header>

    <!-- Error Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-16">
        <div class="text-center max-w-lg">
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 rounded-full mb-6">
                    <i class="bi bi-search text-primary text-5xl"></i>
                </div>
                <h1 class="text-7xl font-bold text-slate-900 mb-2">404</h1>
                <h2 class="text-2xl font-bold text-slate-700 mb-4">Page Not Found</h2>
                <p class="text-slate-500 text-lg leading-relaxed">
                    {{ $exception->getMessage() ?: "The page you're looking for doesn't exist or has been moved. Let's
                    get you back on track." }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/"
                    class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm hover:shadow hover:-translate-y-0.5">
                    <i class="bi bi-house-door mr-2"></i> Go Home
                </a>
                <a href="javascript:history.back()"
                    class="inline-flex items-center justify-center px-6 py-3 bg-white text-slate-700 border border-slate-200 rounded-xl font-bold hover:bg-slate-50 transition-all duration-300 shadow-sm">
                    <i class="bi bi-arrow-left mr-2"></i> Go Back
                </a>
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
</body>

</html>