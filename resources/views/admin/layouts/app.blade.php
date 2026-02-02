<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - NFT Marketplace</title>
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <!-- Add other CSS files as needed -->
    @stack('styles')
</head>

<body>
    @include('admin.dashboard_header')
    

    <!-- Content Wrapper -->
    <div class="content-wrapper-scroll">
        <div class="content-wrapper">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    @include('dashboard.footer')

    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Add other JS files as needed -->
    @stack('scripts')
</body>

</html>
