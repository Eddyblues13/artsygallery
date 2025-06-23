@include('dashboard.header')
<main class="content">
    <div class="container d-flex flex-column">
        <div class="row vh-10">
            @if(session('message'))
            <div class="btn btn-success">{{session('message')}}</div>
            @endif
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">

                        <p class="h2">
                            Enter amount in Dollar
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <form method="post" action="{{route('make.withdrawal')}}">
                                    {{csrf_field()}}
                                    <div class="mb-3">
                                        <label class="form-label">Amount</label>
                                        <input class="form-control form-control-lg" type="number" name="amount"
                                            placeholder="Enter Amount" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Wallet Address</label>
                                        <input class="form-control form-control-lg" type="text" name="wallet"
                                            placeholder="Eth Wallet Address" />
                                    </div>
                                    <div>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button id="send_pin"
                                            class="btn btn-primary btn-rounded waves-effect waves-light"
                                            type="submit">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('dashboard.footer')