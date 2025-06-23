@include('dashboard.header')

<main class="content">
    <div class="container d-flex flex-column align-items-center">
        <div class="row vh-10 w-100">
            <div class="col-12 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    @if(session('message'))
                    <div class="btn btn-success">{{session('message')}}</div>
                    @endif
                    <div class="text-center mt-4">
                        <h2>Withdrawal Confirmation</h2>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <div class="receipt-header text-center mb-4">

                                    <p>Please Confirm Your Withdrawal</p>
                                </div>
                                <div class="receipt-details">
                                    <div class="mb-3">
                                        <strong>Amount in Dollar:</strong>
                                        <span>${{number_format($amount, 2, '.', ',')}}<span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Amount in ETH:</strong>
                                        <span>{{$eth}} ETH<span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Wallet Address:</strong>
                                        <span>{{ $wallet }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Timestamp:</strong>
                                        <span>{{ now()->toDateTimeString() }}</span>
                                    </div>
                                </div>
                                <div class="text-center mt-4">

                                    <form class='form-horizontal' action="{{ route('process.withdraw')}}" method='POST'
                                        id='id_load' enctype='multipart/form-data'>
                                        @csrf
                                        <div class='col-sm-6'>
                                            <input type="hidden" name="amount" value="{{$amount}}">
                                            <input type="hidden" name="eth" value="{{$eth}}">
                                            <input type="hidden" name="wallet" value="{{$wallet}}">

                                        </div>
                                        <button type='submit' class='btn btn-primary'> Proceed to
                                            withdraw</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('dashboard.footer')