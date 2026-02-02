@include('dashboard.header')
<main class="content">
    <div class="container d-flex flex-column">
        <div class="row vh-10">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">

                        <p class="h2">
                            Enter amount in {{ $activeCurrency->currency_name ?? 'USD' }}
                        </p>
                        @if($activeCurrency ?? null)
                        <p class="text-muted small mb-0">Display currency: {{ $activeCurrency->currency_code }} ({{ $activeCurrency->currency_symbol }})</p>
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <form method="post" action="{{route('make.deposit')}}">
                                    {{csrf_field()}}
                                    <div class="mb-3">
                                        <label class="form-label">Amount ({{ $activeCurrency->currency_code ?? 'USD' }})</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">{{ $activeCurrency->currency_symbol ?? '$' }}</span>
                                            <input class="form-control" type="number" name="amount"
                                                placeholder="Enter Amount" step="0.01" min="0" />
                                        </div>
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

<script src="js/app.js"></script>

</body>

</html>