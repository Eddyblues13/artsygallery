@include('dashboard.header')

<main class="content">
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transaction History</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Transaction Type</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaction as $transaction)
                                    <tr>
                                        <th scope="row">{{ $transaction->id }}</th>
                                        <td>{{ $transaction->transaction_type }}</td>
                                        <th scope="row">${{number_format($transaction->transaction_amount, 2, '.',
                                            ',')}}</th>
                                        <td>
                                            @if($transaction->status==='1')
                                            <button type="button" class="btn btn-success">Approved</button>
                                            @elseif($transaction->status==='2')
                                            <button type="button" class="btn btn-danger">Declined</button>
                                            @elseif($transaction->status==='0')
                                            <button type="button" class="btn btn-danger">Pending..</button>
                                            @endif
                                        </td>
                                        <td> {{ \Carbon\Carbon::parse($transaction->created_at)->format('D, M j, Y g:i
                                            A') }}</td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2"> No Record Found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('dashboard.footer')