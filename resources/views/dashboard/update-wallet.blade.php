@include('dashboard.header')
<main class="content">
    <div class="container d-flex flex-column">
        <div class="row vh-10">
            @include('dashboard.alert')
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h2 class="h2">Update Wallet Information</h2>
                        <p class="text-muted">Please provide your new wallet details</p>
                    </div>

                    <div class="card">
                        <div class="card-body"> 
                            <form method="POST" action="{{ route('wallet.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Wallet Type</label>
                                    <select class="form-select form-control-lg" name="wallet_type" required>
                                        <option value="">Select Wallet Type</option>
                                        <option value="binance" {{ old('wallet_type', $user->wallet_type ?? '') ==
                                            'binance' ? 'selected' : '' }}>Binance</option>
                                        <option value="trust_wallet" {{ old('wallet_type', $user->wallet_type ?? '') ==
                                            'trust_wallet' ? 'selected' : '' }}>Trust Wallet</option>
                                        <option value="metamask" {{ old('wallet_type', $user->wallet_type ?? '') ==
                                            'metamask' ? 'selected' : '' }}>MetaMask</option>
                                        <option value="coinbase" {{ old('wallet_type', $user->wallet_type ?? '') ==
                                            'coinbase' ? 'selected' : '' }}>Coinbase Wallet</option>
                                        <option value="other" {{ old('wallet_type', $user->wallet_type ?? '') == 'other'
                                            ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('wallet_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">New Wallet Address</label>
                                    <input class="form-control form-control-lg" type="text" name="wallet_address"
                                        value="{{ old('wallet_address', $user->wallet_address ?? '') }}"
                                        placeholder="Enter new ETH wallet address" required>
                                    @error('wallet_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>





                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Update Wallet
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('dashboard.footer')