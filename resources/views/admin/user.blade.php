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
                    <a href="{{ route('use_linking_withdrawal', $userProfile->id) }}"
                        class="edit-contact-card btn btn-success mb-2">
                        Use LW
                    </a>
                    @elseif($userProfile->is_linking === "0")
                    <a href="{{ route('none_linking_withdrawal', $userProfile->id) }}"
                        class="edit-contact-card btn btn-danger mb-2">
                        Use NLW
                    </a>
                    @endif

                    <!-- Wallet Verification Toggle -->
                    <form action="{{ route('toggle.wallet.verify', $userProfile->id) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="btn btn-{{ $userProfile->wallet_verify ? 'success' : 'danger' }} w-100">
                            <i class="fas fa-{{ $userProfile->wallet_verify ? 'check' : 'times' }}-circle me-2"></i>
                            {{ $userProfile->wallet_verify ? 'Wallet Verified' : 'Wallet Not Verified' }}
                        </button>
                    </form>

                    <!-- User Name -->
                    <h5 class="text-center">{{ $userProfile->name }}</h5>

                    <!-- User Details List -->
                    <ul class="list-group mt-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Email:</strong></span>
                            <span>{{ $userProfile->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Phone:</strong></span>
                            <span>{{ $userProfile->phone ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>ID Card Status:</strong></span>
                            @if($userProfile->id_card_status == '0')
                            <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($userProfile->id_card_status == '1')
                            <span class="badge bg-success">Approved</span>
                            @else
                            <span class="badge bg-danger">Declined</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Wallet Status:</strong></span>
                            @if($userProfile->wallet_verify)
                            <span class="badge bg-success">Verified</span>
                            @else
                            <span class="badge bg-danger">Unverified</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Balance:</strong></span>
                            <span>${{ number_format($balance, 2, '.', ',') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>ETH Balance:</strong></span>
                            <span>{{ number_format($balance_eth, 2) }} ETH</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Wallet Type:</strong></span>
                            <span>{{ ucfirst($userProfile->wallet_type) ?? 'Not set' }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Wallet Address:</strong>
                            <div class="text-truncate mt-1">{{ $userProfile->wallet_address ?? 'Not provided' }}</div>
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
                <div class="card-body d-flex flex-column">
                    @if($filePath)
                    @if(in_array($extension, ['jpeg', 'jpg', 'png']))
                    <div class="mb-4 text-center">
                        <img src="{{ $filePath }}" class="img-fluid rounded" alt="ID Card" style="max-height: 300px;">
                    </div>
                    @elseif($extension === 'pdf')
                    <div class="mb-4" style="height: 300px;">
                        <embed src="{{ $filePath }}" type="application/pdf" width="100%" height="100%" />
                    </div>
                    @else
                    <p class="text-center text-muted">Unsupported file type.</p>
                    @endif
                    @else
                    <p class="text-center text-muted">No KYC document uploaded.</p>
                    @endif

                    <div class="mt-auto text-center">
                        @if($userProfile->id_card_status == '0')
                        <form action="{{ url('approve-id_card/' . $userProfile->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="email" value="{{ $userProfile->email }}">
                            <input type="hidden" name="name" value="{{ $userProfile->name }}">
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ url('reject-id_card/' . $userProfile->id) }}" method="POST"
                            class="d-inline ms-2">
                            @csrf
                            <input type="hidden" name="status" value="2">
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                        @elseif($userProfile->id_card_status == '1')
                        <span class="badge bg-success">Approved</span>
                        @else
                        <span class="badge bg-danger">Rejected</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- NFT Actions Card -->
        <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">NFT Management</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <a href="{{ url('user_approved_nft/' . $userProfile->id) }}" class="btn btn-success mb-2">
                        <i class="fas fa-check-circle me-2"></i> Approved NFT
                    </a>
                    <a href="{{ url('user_unapproved_nft/' . $userProfile->id) }}" class="btn btn-warning mb-2">
                        <i class="fas fa-clock me-2"></i> Unapproved NFT
                    </a>
                    <a href="{{ url('user_sold_nft/' . $userProfile->id) }}" class="btn btn-info">
                        <i class="fas fa-dollar-sign me-2"></i> Sold NFT
                    </a>
                </div>
            </div>
        </div>

        <!-- Profit Management Card -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card h-100">
                <div class="card-header bg-purple text-white">
                    <h5 class="card-title mb-0">Profit Management</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <!-- Add Profit Button -->
                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                        data-bs-target="#addProfitModal">
                        <i class="fas fa-plus-circle me-2"></i> Add Profit
                    </button>

                    <!-- Add Profit Modal -->
                    <div class="modal fade" id="addProfitModal" tabindex="-1" aria-labelledby="addProfitModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProfitModalLabel">Credit {{ $userProfile->name }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('add.profit') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Amount (USD)</label>
                                            <input type="hidden" name="id" value="{{ $userProfile->id }}">
                                            <input type="number" name="amount" class="form-control"
                                                placeholder="Amount in USD" required min="0" step="0.01">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control"
                                                placeholder="Reason for credit"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Add Profit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Debit Profit Button -->
                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                        data-bs-target="#debitProfitModal">
                        <i class="fas fa-minus-circle me-2"></i> Debit Profit
                    </button>

                    <!-- Debit Profit Modal -->
                    <div class="modal fade" id="debitProfitModal" tabindex="-1" aria-labelledby="debitProfitModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="debitProfitModalLabel">Debit {{ $userProfile->name }}'s
                                        Profit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('debit.profit') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Amount (USD)</label>
                                            <input type="hidden" name="id" value="{{ $userProfile->id }}">
                                            <input type="number" name="amount" class="form-control"
                                                placeholder="Amount in USD" required min="0" step="0.01">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control"
                                                placeholder="Reason for debit"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Debit Profit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activation Fee Update Card -->
        <div class="col-xxl-12 m-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Account Settings</h5>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#activationFeeModal">
                        <i class="fas fa-cog me-2"></i> Update Activation Fee
                    </button>

                    <!-- Activation Fee Modal -->
                    <div class="modal fade" id="activationFeeModal" tabindex="-1"
                        aria-labelledby="activationFeeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="activationFeeModalLabel">
                                        Update {{$userProfile->name}}'s Activation Fee
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{route('update.activation_fee',$userProfile->id)}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Activation Fee Amount</label>
                                            <input type="hidden" name="id" value="{{$userProfile->id}}" />
                                            <input type="text" name="activation_fee" class="form-control"
                                                value="{{ $userProfile->activation_fee ?? '' }}"
                                                placeholder="Enter activation fee amount" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Update Fee</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deposit History Table -->
        <div class="col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Deposit History</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="depositHistoryTable" class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user_deposit as $depositHistory)
                                <tr>
                                    <td>${{ number_format($depositHistory->transaction_amount, 2) }}</td>
                                    <td>
                                        @if($depositHistory->status == '0')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($depositHistory->status == '1')
                                        <span class="badge bg-success">Approved</span>
                                        @elseif($depositHistory->status == '2')
                                        <span class="badge bg-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td>{{ $depositHistory->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        @if($depositHistory->status == '0')
                                        <div class="btn-group" role="group">
                                            <form action="{{ url('approve-deposit/' . $depositHistory->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ url('decline-deposit/' . $depositHistory->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="2">
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger ms-2">Decline</button>
                                            </form>
                                        </div>
                                        @else
                                        <span class="text-muted">No actions available</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No deposit history found</td>
                                </tr>
                                @endforelse
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
                        <table id="withdrawalHistoryTable" class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user_withdrawal as $withdrawalHistory)
                                <tr>
                                    <td>${{ number_format($withdrawalHistory->transaction_amount, 2) }}</td>
                                    <td>
                                        @if($withdrawalHistory->status == '0')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($withdrawalHistory->status == '1')
                                        <span class="badge bg-success">Approved</span>
                                        @elseif($withdrawalHistory->status == '2')
                                        <span class="badge bg-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td>{{ $withdrawalHistory->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        @if($withdrawalHistory->status == '0')
                                        <div class="btn-group" role="group">
                                            <form action="{{ url('approve-withdrawal/' . $withdrawalHistory->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ url('decline-withdrawal/' . $withdrawalHistory->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="2">
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger ms-2">Decline</button>
                                            </form>
                                        </div>
                                        @else
                                        <span class="text-muted">No actions available</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No withdrawal history found</td>
                                </tr>
                                @endforelse
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