<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Artsygalley - NFT Marketplace</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.ico') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

        /* ===== PROFESSIONAL POPUP MODAL STYLES ===== */
        .popup-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1050;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .popup-modal-backdrop.show {
            display: block;
            opacity: 1;
        }

        .popup-modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1051;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            pointer-events: none;
        }

        .popup-modal-container.top {
            align-items: flex-start;
            padding-top: 2rem;
        }

        .popup-modal-container.bottom {
            align-items: flex-end;
            padding-bottom: 2rem;
        }

        .popup-modal-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow: hidden;
            display: none;
            pointer-events: auto;
            transform: scale(0.9) translateY(-20px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .popup-modal-card.show {
            display: block;
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .popup-modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 1.5rem 1.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }

        .popup-modal-title {
            font-weight: 600;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .popup-modal-title i {
            width: 24px;
            height: 24px;
            stroke-width: 2;
        }

        .popup-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.5rem;
            line-height: 1;
            padding: 0;
            transition: all 0.2s ease;
            font-weight: 300;
        }

        .popup-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .popup-modal-body {
            padding: 1.75rem;
            color: #333;
            line-height: 1.7;
            font-size: 1rem;
            max-height: calc(90vh - 200px);
            overflow-y: auto;
        }

        .popup-modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .popup-modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .popup-modal-body::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .popup-modal-body::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .popup-modal-footer {
            background: #f8f9fa;
            padding: 1.25rem 1.75rem;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .popup-modal-btn {
            padding: 0.625rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .popup-modal-btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }

        .popup-modal-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        @media (max-width: 768px) {
            .popup-modal-card {
                max-width: 100%;
                margin: 0.5rem;
                border-radius: 12px;
            }

            .popup-modal-header {
                padding: 1.25rem 1.5rem;
            }

            .popup-modal-body {
                padding: 1.5rem;
            }

            .popup-modal-footer {
                padding: 1rem 1.5rem;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

{{-- ================= SIDEBAR ================= --}}
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('home') }}">
            <span class="align-middle">Home</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Pages</li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{ route('home') }}">
                    <i data-feather="sliders"></i> Dashboard
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('get.deposit') }}">
                    <i data-feather="log-in"></i> Deposit
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('withdrawal') }}">
                    <i data-feather="user-plus"></i> Withdrawal
                </a>
            </li>

            <li class="sidebar-header">NFTs</li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('buy.nft') }}">
                    <i data-feather="grid"></i> Buy NFT
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('upload.nft') }}">
                    <i data-feather="upload"></i> Upload NFT
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('my.nft') }}">
                    <i data-feather="package"></i> My NFTs
                </a>
            </li>

            <li class="sidebar-header">Wallet</li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('wallet.link') }}">
                    <i data-feather="link"></i> Link Wallet
                </a>
            </li>

            <li class="sidebar-header">History</li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('transactions') }}">
                    <i data-feather="activity"></i> Transactions
                </a>
            </li>

            <li class="sidebar-header">Account</li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('profile') }}">
                    <i data-feather="user"></i> Profile
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('settings') }}">
                    <i data-feather="settings"></i> Settings
                </a>
            </li>
        </ul>

        <div class="sidebar-cta">
            <a href="{{ route('logOut') }}" class="btn btn-primary w-100">Logout</a>
        </div>
    </div>
</nav>

{{-- ================= MAIN ================= --}}
<div class="main">

{{-- ================= POPUPS ================= --}}
@php
use App\Models\PopupMessage;
use Illuminate\Support\Facades\Auth;

$popups = collect();
$user = Auth::user();

if ($user) {
    try {
        // Get all active popups created by admin
        // Conditions:
        // 1. is_active must be true
        // 2. Type must be 'general' OR 'user_specific' for this user
        // Note: Date checks are ignored - popups show if active regardless of dates
        $popups = PopupMessage::where('is_active', true)
            ->where(function ($q) use ($user) {
                $q->where('type', 'general')
                  ->orWhere(function ($s) use ($user) {
                      $s->where('type', 'user_specific')->where('user_id', $user->id);
                  });
            })
            ->orderBy('created_at', 'asc')
            ->get();
    } catch (\Exception $e) {
        // Silently fail if there's an error
        $popups = collect();
    }
}

$topPopups = $popups->where('position', 'top');
$bottomPopups = $popups->where('position', 'bottom');

// Debug: Uncomment to see popup counts in browser console
// \Log::info('Popup Debug', [
//     'total_popups' => $popups->count(),
//     'top_popups' => $topPopups->count(),
//     'bottom_popups' => $bottomPopups->count(),
//     'user_id' => $user ? $user->id : null
// ]);
@endphp

@if($popups->count() > 0)
<!-- Popup Modal Backdrop -->
<div class="popup-modal-backdrop" id="popupBackdrop"></div>

<!-- Popup Modals Container -->
<div class="popup-modal-container" id="popupContainer">
@foreach($popups as $popup)
    <div class="popup-modal-card" data-popup data-position="{{ $popup->position }}">
        <div class="popup-modal-header">
            <h5 class="popup-modal-title">
                <i data-feather="bell"></i> {{ $popup->title }}
            </h5>
            <button class="popup-modal-close" data-close type="button" aria-label="Close">×</button>
        </div>
        <div class="popup-modal-body">
            {!! nl2br(e($popup->message)) !!}
        </div>
        <div class="popup-modal-footer">
            <button class="popup-modal-btn popup-modal-btn-primary" data-close type="button">Got it</button>
        </div>
    </div>
@endforeach
</div>
@endif

<script>
(function () {
    if (window.__POPUPS_LOADED__) return;
    window.__POPUPS_LOADED__ = true;

    const backdrop = document.getElementById('popupBackdrop');
    const container = document.getElementById('popupContainer');
    const popups = container ? container.querySelectorAll('[data-popup]') : [];
    
    if (popups.length === 0) return;

    let currentIndex = 0;
    let currentPopup = null;

    function showPopup(index) {
        if (index >= popups.length) {
            // All popups shown, hide backdrop
            if (backdrop) {
                backdrop.classList.remove('show');
            }
            if (container) {
                container.style.pointerEvents = 'none';
            }
            return;
        }

        currentPopup = popups[index];
        const position = currentPopup.getAttribute('data-position') || 'center';
        
        // Set container position
        if (container) {
            container.className = 'popup-modal-container ' + position;
        }

        // Show backdrop
        if (backdrop) {
            backdrop.classList.add('show');
        }

        // Hide previous popup
        popups.forEach(p => {
            p.classList.remove('show');
        });

        // Show current popup with animation
        setTimeout(() => {
            currentPopup.classList.add('show');
            if (window.feather) {
                feather.replace();
            }
        }, 50);

        // Setup close handlers
        setupCloseHandlers(currentPopup, index);
    }

    function setupCloseHandlers(popup, index) {
        const closeButtons = popup.querySelectorAll('[data-close]');
        
        function closePopup() {
            popup.classList.remove('show');
            setTimeout(() => {
                currentIndex = index + 1;
                showPopup(currentIndex);
            }, 300);
        }

        // Remove old listeners and add new ones
        closeButtons.forEach(btn => {
            btn.replaceWith(btn.cloneNode(true));
        });

        // Add event listeners to new buttons
        popup.querySelectorAll('[data-close]').forEach(btn => {
            btn.addEventListener('click', closePopup, { once: true });
        });

        // Close on backdrop click
        if (backdrop) {
            backdrop.onclick = function(e) {
                if (e.target === backdrop) {
                    closePopup();
                }
            };
        }

        // Close on Escape key
        document.addEventListener('keydown', function escHandler(e) {
            if (e.key === 'Escape' && currentPopup && currentPopup.classList.contains('show')) {
                closePopup();
                document.removeEventListener('keydown', escHandler);
            }
        }, { once: true });
    }

    function initPopups() {
        if (popups.length > 0) {
            showPopup(0);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPopups);
    } else {
        initPopups();
    }
})();
</script>

{{-- ================= NAVBAR ================= --}}
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('settings') }}"><i class="align-middle me-1" data-feather="settings"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('my.nft') }}"><i class="align-middle me-1" data-feather="grid"></i> My NFTs</a>
                    <a class="dropdown-item" href="{{ route('wallet.link') }}"><i class="align-middle me-1" data-feather="link"></i> Link Wallet</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('transactions') }}"><i class="align-middle me-1" data-feather="activity"></i> Transaction History</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logOut') }}"><i class="align-middle me-1" data-feather="log-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
