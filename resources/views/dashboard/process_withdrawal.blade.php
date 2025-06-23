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
                                    <b>Please Confirm Your Withdrawal</b>

                                    <hr>


                                </div>
                                <div class="receipt-details">
                                    <div class="mb-3">
                                        <b>Details:</b>
                                        <br>
                                        <p><b>${{number_format( $data['amount'], 2, '.', ',')}}</b> amounting
                                            <b>{{$data['amount']/$eth}} ETH</b> is about to be withdrawn to the wallet
                                            address
                                            <b>{{$data['wallet']}}</b>
                                        </p>
                                    </div>
                                </div>
                                <div class="text-center mt-4">

                                    <form class='form-horizontal' action="{{ route('process.withdraw')}}" method='POST'
                                        id='id_load' enctype='multipart/form-data'>
                                        @csrf
                                        <div class='col-sm-6'>
                                            <input type="hidden" name="amount" value="{{$data['amount']}}">
                                            <input type="hidden" name="eth" value="{{$data['amount']/$eth}}">
                                            <input type="hidden" name="wallet" value="{{$data['wallet']}}">

                                        </div>
                                        <button type='submit' class='btn btn-success btn-sm btn-rounded shadow'>
                                            confirm</button>
                                        <a href="{{route('cancelled')}}"
                                            class='btn btn-danger btn-sm btn-rounded shadow float-right'> decline</a>
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