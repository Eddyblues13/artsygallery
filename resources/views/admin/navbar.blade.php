    <!-- partial -->
    <!-- Main container start -->
      <div class="main-container">

        <!-- Sidebar wrapper start -->
        <nav class="sidebar-wrapper">

          <!-- Sidebar brand starts -->
          <div class="brand">
            <a href="{{url('home')}}" class="logo">
              <img src="{{asset('images/logo.png')}}" class="d-none d-md-block me-4" alt="Rapid Admin Dashboard" />
              <img src="{{asset('images/logo.png')}}" class="d-block d-md-none me-4" alt="Rapid Admin Dashboard" />
            </a>
          </div>
          <!-- Sidebar brand ends -->

          <!-- Sidebar menu starts -->
          <div class="sidebar-menu">
            <div class="sidebarMenuScroll">
              <ul>
                <li class="active-page-link">
                  <a href="{{route('home')}}">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Dashboard</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('home')}}">
                    <i class="bi bi-box"></i>
                    <span class="menu-text">Users</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('update.wallet')}}">
                    <i class="bi bi-collection"></i>
                    <span class="menu-text">Update Wallet</span>
                    
                  </a>
                
                </li>
                    <li>
                  <a href="{{route('update.whatsapp')}}">
                    <i class="bi bi-collection"></i>
                    <span class="menu-text">Update Whatsapp API</span>
                    
                  </a>
                
                </li>
                <li>
                  <a href="{{route('admin.approve.nft')}}">
                    <i class="bi bi-collection"></i>
                    <span class="menu-text">Approve NFTS</span>
                    
                  </a>
                
                </li>

                <li>
                  <a href="{{route('admin.upload.nft')}}">
                    <i class="bi bi-box"></i>
                    <span class="menu-text">Upload NFTs</span>
                  </a>
                </li>

                <li>
                  <a href="{{route('admin.buy.nft')}}">
                    <i class="bi bi-box"></i>
                    <span class="menu-text"> NFT Market</span>
                  </a>
                </li>
                
                <li>
                  <a href="{{ route('admin.nft-drops.index') }}">
                    <i class="bi bi-box"></i>
                    <span class="menu-text">Manage NFT Drops</span>
                  </a>
                </li>
                

                <li>
                  <a href="{{route('user.transaction')}}">
                    <i class="bi bi-calendar4"></i>
                    <span class="menu-text">Transactions</span>
                  </a>
                </li>
                
                <li>
                  <a href="{{route('admin.change.password')}}">
                    <i class="bi bi-emoji-expressionless"></i>
                    <span class="menu-text">Change Password</span>
                  </a>
                </li>
                
                <li>
                  <a href="{{route('send.user.email')}}">
                    <i class="bi bi-code-square"></i>
                    <span class="menu-text">Send Email</span>
                  </a>
                </li>

                <li>
                  <a href="{{route('logOut')}}">
                    <i class="bi bi-emoji-expressionless"></i>
                    <span class="menu-text">Logout</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- Sidebar menu ends -->

        </nav>
        <!-- Sidebar wrapper end -->
                @if (session('error'))
                              <div class="alert box-bdr-red alert-dismissible fade show text-red" role="alert">
															<b>Error!</b>{{ session('error') }}
											<button type="button" class="btn-close" data-bs-dismiss="alert"
																aria-label="Close"></button>
									</div>
                                    @elseif (session('status'))
									<div class="alert box-bdr-green alert-dismissible fade show text-green" role="alert">
															<b>Success!</b> {{ session('status') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
									    @elseif (session('message'))
									<div class="alert box-bdr-green alert-dismissible fade show text-green" role="alert">
															<b>Success!</b> {{ session('message') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
                                  @endif
