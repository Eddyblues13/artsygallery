@php
$labelText = $label ?? 'items';
@endphp

@once
<style>
    .user-pagination-wrap {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        align-items: center;
        justify-content: space-between;
    }

    .user-pagination-wrap .user-pagination-count {
        color: #6c757d;
        font-size: 0.9rem;
        text-align: center;
    }

    .user-pagination-wrap .user-pagination-nav .pagination {
        margin-bottom: 0;
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.35rem;
    }

    .user-pagination-wrap .user-pagination-nav .page-item {
        margin: 0;
    }

    .user-pagination-wrap .user-pagination-nav .page-link {
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
        transition: all 0.2s ease;
    }

    .user-pagination-wrap .user-pagination-nav .page-link:hover {
        border-color: #667eea;
        color: #667eea;
        background: #f8fbff;
    }

    .user-pagination-wrap .user-pagination-nav .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        color: #fff;
    }

    .user-pagination-wrap .user-pagination-nav .page-item.disabled .page-link {
        color: #adb5bd;
        background: #f8f9fa;
        border-color: #e9ecef;
        pointer-events: none;
    }

    @media (min-width: 768px) {
        .user-pagination-wrap {
            flex-direction: row;
        }

        .user-pagination-wrap .user-pagination-count {
            text-align: left;
        }
    }
</style>
@endonce

@if(isset($paginator) && $paginator->hasPages())
<div class="user-pagination-wrap">
    <div class="user-pagination-count">
        Showing <strong>{{ number_format($paginator->firstItem() ?? 0) }}</strong>
        to <strong>{{ number_format($paginator->lastItem() ?? 0) }}</strong>
        of <strong>{{ number_format($paginator->total()) }}</strong> {{ $labelText }}
    </div>
    <div class="user-pagination-nav">
        {{ $paginator->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>
@endif