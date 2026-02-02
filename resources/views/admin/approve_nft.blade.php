@include('admin.dashboard_header')

<style>
    .pagination .page-link {
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
    }

    .page-item.disabled .page-link {
        cursor: not-allowed;
    }

    .btn-processing {
        cursor: not-allowed;
    }
</style>

<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main header starts -->
    <div class="main-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div class="page-icon">
                <i class="bi bi-house"></i>
            </div>
            <div class="page-title ms-2">
                <h5>Welcome back, {{ Auth::user()->name }}</h5>
            </div>
        </div>
    </div>
    <!-- Main header ends -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4">Manage NFTs</h4>

                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="card-title mb-0">NFT List</div>
                        <form method="GET" action="{{ url('search-nft') }}" class="d-flex w-100 w-md-auto">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search..." value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S/N</th>
                                        <th style="width: 100px;">Image</th>
                                        <th>Name</th>
                                        <th>Owner</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users_nfts as $index => $nft)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if(Str::startsWith($nft->ntf_image, ['http', 'https']))
                                                    <img src="{{ $nft->ntf_image }}" class="img-thumbnail" style="max-height: 80px;" alt="NFT" />
                                                @else
                                                    <img src="{{ asset('user/uploads/nfts/'.$nft->ntf_image) }}" class="img-thumbnail" style="max-height: 80px;" alt="NFT" />
                                                @endif
                                            </td>
                                            <td>{{ $nft->ntf_name }}</td>
                                            <td>{{ $nft->ntf_owner }}</td>
                                            <td>${{ number_format($nft->nft_price, 2) }}</td>
                                            <td>
                                                @if($nft->status == '1')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($nft->status == '2')
                                                    <span class="badge bg-info">Sold</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @if($nft->status == '0')
                                                    <form class="approve-nft-form m-0" data-id="{{ $nft->id }}" data-url="{{ url('approve-nft/'.$nft->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="status" value="1">
                                                        <input type="hidden" name="email" value="{{ $nft->email }}">
                                                        <input type="hidden" name="nft_price" value="{{ $nft->nft_price }}">
                                                        <input type="hidden" name="name" value="{{ $nft->ntf_name }}">
                                                        <input type="hidden" name="full_name" value="{{ $nft->ntf_owner }}">
                                                        <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                            <i class="bi bi-check-lg"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                    
                                                    <a href="{{ route('admin.edit.nft', $nft->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    
                                                    <a href="{{ route('admin.delete.nft', $nft->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this NFT?')" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="d-md-none">
                            @foreach($users_nfts as $nft)
                                <div class="card mb-3 border shadow-sm">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center mb-3">
                                            @if(Str::startsWith($nft->ntf_image, ['http', 'https']))
                                                <img src="{{ $nft->ntf_image }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="NFT">
                                            @else
                                                <img src="{{ asset('user/uploads/nfts/'.$nft->ntf_image) }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;" alt="NFT">
                                            @endif
                                            <div>
                                                <h6 class="mb-1 fw-bold">{{ $nft->ntf_name }}</h6>
                                                <small class="text-muted">{{ $nft->ntf_owner }}</small>
                                            </div>
                                            <div class="ms-auto text-end">
                                                <div class="fw-bold text-primary">${{ number_format($nft->nft_price, 2) }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($nft->created_at)->format('M d, Y') }}
                                            </small>
                                            @if($nft->status == '1')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($nft->status == '2')
                                                <span class="badge bg-info">Sold</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        </div>

                                        <div class="d-grid gap-2 d-flex justify-content-end">
                                            @if($nft->status == '0')
                                                <form class="approve-nft-form m-0 flex-fill" data-id="{{ $nft->id }}" data-url="{{ url('approve-nft/'.$nft->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="email" value="{{ $nft->email }}">
                                                    <input type="hidden" name="nft_price" value="{{ $nft->nft_price }}">
                                                    <input type="hidden" name="name" value="{{ $nft->ntf_name }}">
                                                    <input type="hidden" name="full_name" value="{{ $nft->ntf_owner }}">
                                                    <button type="submit" class="btn btn-success btn-sm w-100">Approve</button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.edit.nft', $nft->id) }}" class="btn btn-primary btn-sm flex-fill">Edit</a>
                                            <a href="{{ route('admin.delete.nft', $nft->id) }}" class="btn btn-danger btn-sm flex-fill" onclick="return confirm('Delete NFT?')">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $users_nfts->links('pagination::bootstrap-4') }}
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.5.8/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.5.8/sweetalert2.min.css"/>

<script>
$(document).ready(function() {
    $('.approve-nft-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.data('url');
        var button = form.find('button');
        
        button.text('Approved...').addClass('btn-processing').prop('disabled', true);
        
        $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Approved',
                        text: 'NFT has been approved successfully.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        form.replaceWith('<span class="badge bg-primary">Approved</span>');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                    button.text('Approve').removeClass('btn-processing').prop('disabled', false);
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing the request.',
                    confirmButtonText: 'OK'
                });
                button.text('Approve').removeClass('btn-processing').prop('disabled', false);
            }
        });
    });
});
</script>

@include('dashboard.footer')
