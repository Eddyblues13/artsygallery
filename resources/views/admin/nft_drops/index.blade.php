@extends('admin.layouts.app')

@section('content')

<!-- Main header -->
<div class="main-header d-flex align-items-center justify-content-between position-relative mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="page-icon"><i class="bi bi-collection"></i></div>
        <div class="page-title d-none d-md-block">
            <h5 class="mb-0">Manage Notable Drops</h5>
        </div>
    </div>
    <a href="{{ route('admin.nft-drops.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add Drop
    </a>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div id="admin-nft-drops-results">
    <div class="row gx-3 gy-4">
        @forelse($buy_nft as $my_nft)
        @php
        $totalDays = \Carbon\Carbon::now()->daysInMonth();
        $progress = min(100, ($my_nft->duration / $totalDays) * 100);
        $displayEth = $my_nft->is_positive
        ? $my_nft->eth_value + ($my_nft->eth_value * ($progress / 100))
        : max(0, $my_nft->eth_value - ($my_nft->eth_value * ($progress / 100)));
        @endphp

        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="adrop-card">
                {{-- Image --}}
                <div class="adrop-img-wrap">
                    <img src="{{ Illuminate\Support\Str::startsWith($my_nft->image_url, ['http','https']) ? $my_nft->image_url : asset($my_nft->image_url) }}"
                        alt="{{ $my_nft->name }}" class="adrop-img">
                    <span
                        class="adrop-direction {{ $my_nft->is_positive ? 'adrop-direction--pos' : 'adrop-direction--neg' }}">
                        {{ $my_nft->is_positive ? '▲' : '▼' }}
                        {{ number_format(abs($my_nft->change), 2) }}%
                    </span>
                </div>

                {{-- Body --}}
                <div class="adrop-body">
                    <h6 class="adrop-name" title="{{ $my_nft->name }}">{{ $my_nft->name }}</h6>

                    {{-- Assigned user --}}
                    @if($my_nft->user)
                    <div class="adrop-user">
                        <i class="bi bi-person-fill"></i>
                        <span>{{ $my_nft->user->name }}</span>
                    </div>
                    @else
                    <div class="adrop-user adrop-user--none">
                        <i class="bi bi-person-dash"></i>
                        <span>Unassigned</span>
                    </div>
                    @endif

                    {{-- ETH value --}}
                    <div class="adrop-eth">
                        <svg width="11" height="17" viewBox="0 0 14 22" fill="none">
                            <path d="M7 0L6.84 0.54V15.04L7 15.2L14 11.11L7 0Z" fill="#6366f1" />
                            <path d="M7 0L0 11.11L7 15.2V0Z" fill="#8b5cf6" />
                            <path d="M7 16.48L6.91 16.58V21.87L7 22L14.01 12.39L7 16.48Z" fill="#6366f1" />
                            <path d="M7 22V16.48L0 12.39L7 22Z" fill="#8b5cf6" />
                        </svg>
                        <strong>{{ number_format($displayEth, 4) }}</strong>
                        <span class="adrop-eth-label">ETH accumulated</span>
                    </div>

                    {{-- Progress --}}
                    <div class="adrop-progress-block">
                        <div class="adrop-progress-header">
                            <span>{{ $my_nft->duration }}d duration</span>
                            <span>{{ number_format($progress, 1) }}%</span>
                        </div>
                        <div class="adrop-progress-track">
                            <div class="adrop-progress-fill {{ $my_nft->is_positive ? 'afill-pos' : 'afill-neg' }}"
                                style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Footer actions --}}
                <div class="adrop-footer">
                    <a href="{{ route('admin.nft-drops.edit', $my_nft->id) }}"
                        class="btn btn-sm btn-outline-primary flex-fill">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <form action="{{ route('admin.nft-drops.destroy', $my_nft->id) }}" method="POST"
                        onsubmit="return confirm('Delete \u201c{{ addslashes($my_nft->name) }}\u201d?')"
                        class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5 text-muted">
                <i class="bi bi-collection fs-1 d-block mb-2"></i>
                No notable drops yet. <a href="{{ route('admin.nft-drops.create') }}">Create one</a>.
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        @include('admin.partials.pagination', ['paginator' => $buy_nft, 'label' => 'drops'])
    </div>
</div>

@endsection

@push('styles')
<style>
    .adrop-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
        border: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        transition: transform .22s ease, box-shadow .22s ease;
    }

    .adrop-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 28px rgba(99, 102, 241, 0.13);
    }

    .adrop-img-wrap {
        position: relative;
        overflow: hidden;
    }

    .adrop-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
        transition: transform .3s ease;
    }

    .adrop-card:hover .adrop-img {
        transform: scale(1.06);
    }

    .adrop-direction {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 3px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .adrop-direction--pos {
        background: rgba(34, 197, 94, .18);
        color: #15803d;
        border: 1px solid rgba(34, 197, 94, .3);
    }

    .adrop-direction--neg {
        background: rgba(239, 68, 68, .13);
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, .25);
    }

    .adrop-body {
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
    }

    .adrop-name {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .adrop-user {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #374151;
        font-weight: 500;
    }

    .adrop-user i {
        color: #6366f1;
    }

    .adrop-user--none {
        color: #9ca3af;
    }

    .adrop-user--none i {
        color: #9ca3af;
    }

    .adrop-eth {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 15px;
        color: #111827;
    }

    .adrop-eth strong {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .adrop-eth-label {
        font-size: 11px;
        color: #9ca3af;
        margin-left: 2px;
    }

    .adrop-progress-block {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .adrop-progress-header {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: #6b7280;
        font-weight: 500;
    }

    .adrop-progress-track {
        height: 6px;
        background: #f3f4f6;
        border-radius: 99px;
        overflow: hidden;
    }

    .adrop-progress-fill {
        height: 100%;
        border-radius: 99px;
        transition: width .6s ease;
    }

    .afill-pos {
        background: linear-gradient(90deg, #34d399, #10b981);
    }

    .afill-neg {
        background: linear-gradient(90deg, #f87171, #ef4444);
    }

    .adrop-footer {
        display: flex;
        gap: 8px;
        padding: 12px 16px 14px;
        border-top: 1px solid #f3f4f6;
    }
</style>
@endpush