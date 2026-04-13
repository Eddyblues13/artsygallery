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
                                        <p>
                                            <small class="text-muted">${{number_format( $data['amount'], 2, '.',
                                                ',')}}</small>
                                            <br>
                                            <b style="color: #6f42c1; font-size: 1.1rem;" class="eth-conversion"
                                                data-usd="{{ \App\Helpers\CurrencyHelper::convert($data['amount']) }}">≈
                                                {{ \App\Helpers\CurrencyHelper::formatEth($data['amount']) }}</b>
                                            is about to be withdrawn to the wallet address
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

<script>
    function refreshEthPrices() {
        fetch('{{ route("api.eth.price") }}')
            .then(r => r.json())
            .then(data => {
                if (data.eth_price_usd) {
                    document.querySelectorAll('.eth-conversion').forEach(el => {
                        const usd = parseFloat(el.dataset.usd);
                        if (usd && data.eth_price_usd > 0) {
                            const eth = (usd / data.eth_price_usd).toFixed(6);
                            el.textContent = '≈ ' + eth + ' ETH';
                        }
                    });
                }
            }).catch(() => {});
    }
    setInterval(refreshEthPrices, 60000);
</script>

@include('dashboard.footer')