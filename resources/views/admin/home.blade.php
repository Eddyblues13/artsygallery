

@include('admin.header')
@include('admin.navbar')
				<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">
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
                                  @endif

					<!-- Main header starts -->
					<div class="main-header d-flex align-items-center justify-content-between position-relative">
						<div class="d-flex align-items-center justify-content-center">
							<div class="page-icon">
								<i class="bi bi-house"></i>
							</div>
							<div class="page-title d-none d-md-block">
								<h5>Welcome back, {{Auth::user()->name}}</h5>
							</div>
						</div>
						<!-- Live updates start -->
						
						<!-- Live updates end -->
					</div>
					<!-- Main header ends -->

					<!-- Content wrapper start -->
					<div class="content-wrapper">

						<!-- Row start -->
						
											<div class="col-sm-12 col-12">
												<h4>Users</h4>
							
								
										<div class="card">
					<div class="card-header">
						<div class="card-title">Transaction History</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="highlightRowColumn" class="table custom-table">
								<thead>
									<tr>
									   <th>S/N</th>
										<th>Full Name</th>
										<th>Email</th> 
										<th>View User</th>
										<th>Delete User</th>



									</tr>
								</thead>
								<tbody>
                                 @foreach($result as $users)
													<tr>
												      <th>{{$users->id}}</t>
														<th>{{$users->name}}</t>
														<th>{{$users->email}}</t>
														<td><a href="{{url('profile/'.$users->id)}}"><span class="badge shade-blue">View User</span></a></td>
														<td><a href="{{url('delete/'.$users->id)}}" onclick="confirm('Are you sure you want to delete this user?')"><span class="badge shade-red">Delete User</span></a></td>

														
													</tr>
													@endforeach

								</tbody>
							</table>
						</div>
					</div>
				</div>
							</div>
						</div>
						<!-- Row end -->

					</div>
					<!-- Content wrapper end -->

				</div>
				<!-- Content wrapper scroll end -->
				    <script>
        function confirmAction() {
            // Display a confirmation dialog
            var userResponse = window.confirm("Are you sure you want to delete this user?");

            // If the user clicks "OK," perform the action
            if (userResponse) {
                alert("Performing the action...");
                // Add your additional code here
            } else {
                alert("Action canceled.");
                // Add your additional code here if the action is canceled
            }

            // Return false to prevent the default link behavior (navigation)
            return false;
        }
    
    </script>
@include('admin.footer')