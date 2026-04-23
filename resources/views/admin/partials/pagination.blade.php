@php
$labelText = $label ?? 'items';
@endphp

@once
<style>
    .admin-pagination-wrap {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.25rem;
    }

    .admin-pagination-wrap .admin-pagination-count {
        color: #6c757d;
        font-size: 0.9rem;
        text-align: center;
    }

    .admin-pagination-wrap .admin-pagination-nav .pagination {
        margin-bottom: 0;
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.35rem;
    }

    .admin-pagination-wrap .admin-pagination-nav .page-item {
        margin: 0;
    }

    .admin-pagination-wrap .admin-pagination-nav .page-link {
        min-width: 2.25rem;
        min-height: 2.25rem;
        padding: 0.45rem 0.6rem;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        color: #495057;
        background: #fff;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
    }

    .admin-pagination-wrap .admin-pagination-nav .page-link:hover {
        border-color: #3b7ddd;
        color: #3b7ddd;
        background: #f8fbff;
    }

    .admin-pagination-wrap .admin-pagination-nav .page-item.active .page-link {
        background: linear-gradient(135deg, #3b7ddd 0%, #5a8cff 100%);
        border-color: #3b7ddd;
        color: #fff;
    }

    .admin-pagination-wrap .admin-pagination-nav .page-item.disabled .page-link {
        color: #adb5bd;
        background: #f8f9fa;
        border-color: #e9ecef;
        pointer-events: none;
    }

    @media (min-width: 768px) {
        .admin-pagination-wrap {
            flex-direction: row;
        }

        .admin-pagination-wrap .admin-pagination-count {
            text-align: left;
        }
    }
</style>
@endonce

@if(isset($paginator) && $paginator->hasPages())
<div class="admin-pagination-wrap">
    <div class="admin-pagination-count">
        Showing <strong>{{ number_format($paginator->firstItem() ?? 0) }}</strong>
        to <strong>{{ number_format($paginator->lastItem() ?? 0) }}</strong>
        of <strong>{{ number_format($paginator->total()) }}</strong> {{ $labelText }}
    </div>
    <div class="admin-pagination-nav">
        {{ $paginator->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endif