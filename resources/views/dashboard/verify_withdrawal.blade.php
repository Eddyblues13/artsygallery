@include('dashboard.header')

<main class="content">
    <div class="container d-flex flex-column align-items-center">
        <div class="row vh-10 w-100">
            @if(session('message'))
            <div class="btn btn-danger">{{session('message')}}</div>
            @endif
            <div class="col-12 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h2>Enter 6-Digit Code</h2>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <form method="post" action="{{route('verify.withdrawal')}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="amount" value="{{$amount}}">
                                    <input type="hidden" name="eth" value="{{$eth}}">
                                    <input type="hidden" name="wallet" value="{{$wallet}}">

                                    <div class="mb-3">
                                        <label for="code" class="form-label">6-Digit Code</label>
                                        <input id="code" class="form-control form-control-lg" type="text" name="code"
                                            placeholder="Enter 6-digit code" maxlength="6" pattern="\d{6}" required>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-primary btn-rounded waves-effect waves-light"
                                            type="submit">Submit</button>
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