<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Meta -->
    <meta name="description" content="Best Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.svg')}}" />

    <!-- Title -->
    <title>Admin Dashboards</title>

    <!-- *************
      ************ Common Css Files *************
    ************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="{{asset('admin/assets/fonts/bootstrap/bootstrap-icons.css')}}" />

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/main.min.css')}}" />

    <!-- *************
      ************ Vendor Css Files *************
    ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}" />
  </head>

  <body>

    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- Page header starts -->
      <div class="page-header">

        <div class="toggle-sidebar" id="toggle-sidebar">
          <i class="bi bi-list"></i>
        </div>

        <!-- Header actions ccontainer start -->
        <div class="header-actions-container">

          <!-- Search container start -->
          <div class="search-container me-4 d-xl-block d-lg-none">

            <!-- Search input group start -->
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" />
              <button class="btn btn-outline-secondary" type="button">
                <i class="bi bi-search"></i>
              </button>
            </div>
            <!-- Search input group end -->

          </div>
          <!-- Search container end -->

          <!-- Header actions start -->
         
          <!-- Header actions start -->

          <!-- Header profile start -->
          <div class="header-profile d-flex align-items-center">
            <div class="dropdown">
              <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                <span class="user-name d-none d-md-block">Admin</span>
                <span class="avatar">
                  <img src="{{asset('admin/assets/images/user7.png')}}" alt="Admin Templates" />
                  <span class="status online"></span>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                <div class="header-profile-actions">
                  <a href="#">Profile</a>
                  <a href="#">Settings</a>
                  <a href="{{route('logOut')}}">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Header profile end -->

        </div>
        <!-- Header actions ccontainer end -->

      </div>
      <!-- Page header ends -->