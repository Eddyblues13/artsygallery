@include('admin.header')
@include('admin.navbar')

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
                <h4 class="mb-4">Approve NFTs</h4>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">NFT Approval</div>
                        <form method="GET" action="{{ url('search-nft') }}" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search by name, description, date" value="{{ request()->get('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Owner</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Approve</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users_nfts as $index => $nft)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><img src="{{ asset('user/uploads/nfts/'.$nft->ntf_image) }}" class="img-thumbnail" alt="NFT Image" /></td>
                                            <td>{{ $nft->ntf_name }}</td>
                                            <td>{{ $nft->ntf_owner }}</td>
                                            <td>{{ $nft->ntf_description }}</td>
                                            <td>{{ \Carbon\Carbon::parse($nft->created_at)->format('D, M j, Y g:i A') }}</td>
                                            <td>
                                                @if($nft->status == '0')
                                                    <form class="approve-nft-form" data-id="{{ $nft->id }}" data-url="{{ url('approve-nft/'.$nft->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="status" value="1">
                                                        <input type="hidden" name="email" value="{{ $nft->email }}">
                                                        <input type="hidden" name="nft_price" value="{{ $nft->nft_price }}">
                                                        <input type="hidden" name="name" value="{{ $nft->name }}">
                                                          <input type="hidden" name="full_name" value="{{ $nft->ntf_owner }}">
                                                        <button type="submit" class="btn btn-success">Approve</button>
                                                    </form>
                                                @elseif($nft->status == '1')
                                                    <span class="badge bg-primary">Approved</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $users_nfts->links('admin.custom') }} <!-- Add pagination links with custom view -->
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

@include('admin.footer')
