@include('admin.header')
@include('admin.navbar')

<!-- Content wrapper start -->
<div class="content-wrapper">
    <!-- Row start -->
    <div class="row gx-3">
        <!-- User Profile Card -->
        <div class="col-sm-4 col-12">
            <div class="card card-cover rounded-2">
                <div class="contact-card">
                    <!-- Linking Withdrawal Button -->
                    @if($userProfile->is_linking === "1")
                        <a href="{{ route('use_linking_withdrawal', $userProfile->id) }}" class="edit-contact-card btn btn-success">
                            Use LW
                        </a>
                    @elseif($userProfile->is_linking === "0")
                        <a href="{{ route('none_linking_withdrawal', $userProfile->id) }}" class="edit-contact-card btn btn-danger">
                            Use NLW
                        </a>
                    @endif

                    <!-- User Name -->
                    <h5>{{ $userProfile->name }}</h5>

                    <!-- User Details List -->
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Email:</strong> {{ $userProfile->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Phone:</strong> {{ $userProfile->phone }}
                        </li>
                        <li class="list-group-item">
                            <strong>ID Card Status:</strong>
                            @if($userProfile->id_card_status == '0')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($userProfile->id_card_status == '1')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Declined</span>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Balance:</strong> ${{ number_format($balance, 2, '.', ',') }}
                        </li>
                        <li class="list-group-item">
                            <strong>ETH Balance:</strong> {{ number_format($balance_eth, 2) }} ETH
                        </li>
                    </ul>
                </div>
            </div>
        </div>

<!-- Approve KYC Card -->
<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
    <div class="card h-100 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Approve KYC</h5>
        </div>
        <div class="card-body d-flex align-items-center">
            @if($filePath)
                <!-- Show document based on the file extension -->
                @if(in_array($extension, ['jpeg', 'jpg', 'png']))
                    <div class="mb-4">
                        <img src="{{ $filePath }}" class="img-fluid" alt="ID Card" style="max-width: 100%; height: auto;">
                    </div>
                @elseif($extension === 'pdf')
                    <div class="mb-4">
                        <embed src="{{ $filePath }}" type="application/pdf" width="100%" height="600px" />
                    </div>
                @else
                    <p>Unsupported file type.</p>
                @endif
            @else
                <p>No KYC document uploaded.</p>
            @endif

            <div>
                <!-- Show approval options based on id_card_status -->
                @if($userProfile->id_card_status == '0')
                    <form action="{{ url('approve-id_card/' . $userProfile->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status" value="1">
                        <input type="hidden" name="email" value="{{ $userProfile->email }}">
                        <input type="hidden" name="name" value="{{ $userProfile->name }}">
                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                    </form>
                @elseif($userProfile->id_card_status == '1')
                    <span class="badge bg-success">Approved</span>
                @endif
            </div>
        </div>
    </div>
</div>


        <!-- NFT Actions Card -->
        <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <a href="{{ url('user_approved_nft/' . $userProfile->id) }}" class="btn btn-success mb-2">
                        Approved NFT
                    </a>
                    <a href="{{ url('user_unapproved_nft/' . $userProfile->id) }}" class="btn btn-warning mb-2">
                        Unapproved NFT
                    </a>
                    <a href="{{ url('user_sold_nft/' . $userProfile->id) }}" class="btn btn-info">
                        Sold NFT
                    </a>
                </div>
            </div>
        </div>

        <!-- Profit Management Card -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <!-- Add Profit Button -->
                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addProfitModal">
                        Add Profit
                    </button>

                    <!-- Add Profit Modal -->
                    <div class="modal fade" id="addProfitModal" tabindex="-1" aria-labelledby="addProfitModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProfitModalLabel">Credit {{ $userProfile->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('add.profit') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <label class="form-label">Amount (USD)</label>
                                        <input type="hidden" name="id" value="{{ $userProfile->id }}">
                                        <input type="number" name="amount" class="form-control" style="color:blue" placeholder="Amount in USD" required min="0">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Top Up Profit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Debit Profit Button -->
                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#debitProfitModal">
                        Debit Profit
                    </button>

                    <!-- Debit Profit Modal -->
                    <div class="modal fade" id="debitProfitModal" tabindex="-1" aria-labelledby="debitProfitModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="debitProfitModalLabel">Debit {{ $userProfile->name }}'s Profit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('debit.profit') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <label class="form-label">Amount (USD)</label>
                                        <input type="hidden" name="id" value="{{ $userProfile->id }}">
                                        <input type="number" name="amount" class="form-control" style="color:blue" placeholder="Amount in USD" required min="0">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Debit Profit</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xxl-12 m-2">
		<!-- Card start -->
		<div class="card m-5">
			<div class="card-body">
				<!-- Modal XL -->
				<button type="button" class="btn btn-success" data-bs-toggle="modal"
					data-bs-target="#exampleModalCenter3">
					Update Activation Fee
				</button>
				<!-- Modal -->
				<div class="modal fade" id="exampleModalCenter3" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
					aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalCenterTitle">
									Update {{$userProfile->name}}  activation_fee Number
								</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<form action="{{route('update.activation_fee',$userProfile->id)}}" method="POST">
								@csrf
								<div class="modal-body">
									<label class="form-label">activation_fee</label>
									<input type="hidden" name="id" value="{{$userProfile->id}}" />
									<input 
    type="text" 
    name="activation_fee" 
    class="form-control" 
    style="color:blue" 
    placeholder="Update {{$userProfile->activation_fee}}" 
    
/>



								</div>
								<div class="modal-footer">

									<button type="submit" class="btn btn-success">
										Update Activation Fee
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>






			</div>
		</div>
		<!-- Card end -->
	</div>


        <!-- Deposit History Table -->
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Deposit History</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="highlightRowColumn" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th> <!-- Added Actions Header -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_deposit as $depositHistory)
                                    <tr>
                                        <td>${{ number_format($depositHistory->transaction_amount, 2, '.', ',') }}</td>
                                        <td>
                                            @if($depositHistory->status == '0')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($depositHistory->status == '1')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($depositHistory->status == '2')
                                                <span class="badge bg-danger">Declined</span>
                                            @endif
                                        </td>
                                        <td>{{ $depositHistory->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            @if($depositHistory->status == '0')
                                                <!-- Approve Deposit Form -->
                                                <form action="{{ url('approve-deposit/' . $depositHistory->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                </form>

                                                <!-- Decline Deposit Form -->
                                                <form action="{{ url('decline-deposit/' . $depositHistory->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="2">
                                                    <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                                </form>
                                            @else
                                                <!-- No actions for approved/declined deposits -->
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdrawal History Table -->
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Withdrawal History</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="highlightRowColumn2" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th> <!-- Added Actions Header -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_withdrawal as $withdrawalHistory)
                                    <tr>
                                        <td>${{ number_format($withdrawalHistory->transaction_amount, 2, '.', ',') }}</td>
                                        <td>
                                            @if($withdrawalHistory->status == '0')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif($withdrawalHistory->status == '1')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($withdrawalHistory->status == '2')
                                                <span class="badge bg-danger">Declined</span>
                                            @endif
                                        </td>
                                        <td>{{ $withdrawalHistory->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            @if($withdrawalHistory->status == '0')
                                                <!-- Approve Withdrawal Form -->
                                                <form action="{{ url('approve-withdrawal/' . $withdrawalHistory->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                </form>

                                                <!-- Decline Withdrawal Form -->
                                                <form action="{{ url('decline-withdrawal/' . $withdrawalHistory->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="2">
                                                    <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                                </form>
                                            @else
                                                <!-- No actions for approved/declined withdrawals -->
                                                N/A
                                            @endif
                                        </td>
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

@include('admin.footer')
