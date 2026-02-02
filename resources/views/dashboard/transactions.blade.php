@include('dashboard.header')

<style>
/* Modern Transaction Styles */
.transaction-card {
    border: none;
    box-shadow: 0 0 0.875rem 0 rgba(33, 37, 41, 0.05);
    border-radius: 12px;
    overflow: hidden;
}

.transaction-header {
    background-color: #fff;
    border-bottom: 1px solid #f0f2f5;
    padding: 1.5rem;
}

/* Status Badges */
.badge-soft-success {
    color: #28a745;
    background-color: rgba(40, 167, 69, 0.1);
    padding: 0.35em 0.65em;
    border-radius: 0.25rem;
    font-weight: 600;
}

.badge-soft-danger {
    color: #dc3545;
    background-color: rgba(220, 53, 69, 0.1);
    padding: 0.35em 0.65em;
    border-radius: 0.25rem;
    font-weight: 600;
}

.badge-soft-warning {
    color: #fd7e14;
    background-color: rgba(253, 126, 20, 0.1);
    padding: 0.35em 0.65em;
    border-radius: 0.25rem;
    font-weight: 600;
}

/* Type Icons */
.transaction-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
}

.icon-deposit {
    background-color: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.icon-withdrawal {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.icon-other {
    background-color: rgba(108, 117, 125, 0.1);
    color: #6c757d;
}

/* Table Enhancements */
.table th {
    font-weight: 600;
    color: #495057;
    background-color: #f8f9fa;
    border-bottom-width: 1px;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    padding: 0.75rem 1rem;
}

.table td {
    vertical-align: middle;
    padding: 1rem;
    color: #495057;
    border-bottom: 1px solid #f0f2f5;
}

.table tr:last-child td {
    border-bottom: none;
}

/* Mobile View Styles */
@media (max-width: 767.98px) {
    .desktop-table {
        display: none;
    }
    
    .mobile-list {
        display: block;
    }
    
    .mobile-item {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        padding: 1rem;
        margin-bottom: 1rem;
        border: 1px solid #f0f2f5;
    }
    
    .mobile-item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }
    
    .mobile-amount {
        font-weight: 700;
        font-size: 1.1rem;
    }
    
    .mobile-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.875rem;
        color: #6c757d;
    }
}

@media (min-width: 768px) {
    .desktop-table {
        display: block;
    }
    
    .mobile-list {
        display: none;
    }
}

/* Pagination */
.pagination {
    margin-bottom: 0;
    justify-content: center;
    gap: 0.25rem;
}

.page-item .page-link {
    color: #495057;
    border: none;
    border-radius: 8px;
    padding: 0.5rem 0.85rem;
    font-weight: 500;
    font-size: 0.9rem;
    background-color: transparent;
    transition: all 0.2s ease;
}

.page-item .page-link:hover {
    background-color: #f8f9fa;
    color: #3b7ddd;
    transform: translateY(-1px);
}

.page-item.active .page-link {
    background-color: #3b7ddd;
    border-color: #3b7ddd;
    color: #fff;
    box-shadow: 0 3px 6px rgba(59, 125, 221, 0.3);
}

.page-item.disabled .page-link {
    background-color: transparent;
    color: #adb5bd;
}
</style>

<main class="content">
    <div class="container-fluid p-0">
        @include('dashboard.alert')
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Transaction History</h1>
            <div class="text-muted">
                {{ \App\Models\CurrencySetting::getActive()->currency_symbol ?? '$' }} Balance: {{ \App\Helpers\CurrencyHelper::format(Auth::user()->balance ?? 0) }}
            </div>
        </div>

        <div class="card transaction-card">
            
            @if($transaction->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i data-feather="list" class="text-muted" style="width: 48px; height: 48px;"></i>
                    </div>
                    <h5 class="text-muted">No transactions found</h5>
                    <p class="text-muted">Your recent financial activity will appear here.</p>
                </div>
            @else
                <!-- Desktop Table View -->
                <div class="table-responsive desktop-table">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Transaction ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($transaction->currentPage() - 1) * $transaction->perPage() }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="transaction-icon {{ stripos($item->transaction_type, 'deposit') !== false ? 'icon-deposit' : (stripos($item->transaction_type, 'withdrawal') !== false ? 'icon-withdrawal' : 'icon-other') }}">
                                            <i data-feather="{{ stripos($item->transaction_type, 'deposit') !== false ? 'log-in' : (stripos($item->transaction_type, 'withdrawal') !== false ? 'log-out' : 'activity') }}" style="width: 18px; height: 18px;"></i>
                                        </div>
                                        <span class="fw-semibold">{{ ucfirst($item->transaction_type) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold {{ stripos($item->transaction_type, 'deposit') !== false || stripos($item->transaction_type, 'profit') !== false ? 'text-success' : 'text-danger' }}">
                                        {{ stripos($item->transaction_type, 'deposit') !== false || stripos($item->transaction_type, 'profit') !== false ? '+' : '-' }}
                                        {{ \App\Helpers\CurrencyHelper::format($item->transaction_amount, 2) }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->status == '1')
                                        <span class="badge-soft-success">Approved</span>
                                    @elseif($item->status == '2')
                                        <span class="badge-soft-danger">Declined</span>
                                    @else
                                        <span class="badge-soft-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y h:i A') }}</td>
                                <td class="text-muted small">#{{ $item->transaction_id ?? $item->id }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile List View -->
                <div class="mobile-list p-3">
                    @foreach($transaction as $item)
                    <div class="mobile-item">
                        <div class="mobile-item-header">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon {{ stripos($item->transaction_type, 'deposit') !== false ? 'icon-deposit' : (stripos($item->transaction_type, 'withdrawal') !== false ? 'icon-withdrawal' : 'icon-other') }}">
                                    <i data-feather="{{ stripos($item->transaction_type, 'deposit') !== false ? 'log-in' : (stripos($item->transaction_type, 'withdrawal') !== false ? 'log-out' : 'activity') }}" style="width: 18px; height: 18px;"></i>
                                </div>
                                <span class="fw-bold">{{ ucfirst($item->transaction_type) }}</span>
                            </div>
                            <span class="fw-bold {{ stripos($item->transaction_type, 'deposit') !== false || stripos($item->transaction_type, 'profit') !== false ? 'text-success' : 'text-danger' }} mobile-amount">
                                {{ stripos($item->transaction_type, 'deposit') !== false || stripos($item->transaction_type, 'profit') !== false ? '+' : '-' }}
                                {{ \App\Helpers\CurrencyHelper::format($item->transaction_amount, 2) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div>
                                @if($item->status == '1')
                                    <span class="badge-soft-success">Approved</span>
                                @elseif($item->status == '2')
                                    <span class="badge-soft-danger">Declined</span>
                                @else
                                    <span class="badge-soft-warning">Pending</span>
                                @endif
                            </div>
                            <div class="text-muted small">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}
                            </div>
                        </div>
                        <div class="mt-2 pt-2 border-top text-muted small">
                            ID: #{{ $item->transaction_id ?? $item->id }}
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="p-3 border-top">
                    {{ $transaction->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.feather) {
            feather.replace();
        }
    });
</script>

@include('dashboard.footer')