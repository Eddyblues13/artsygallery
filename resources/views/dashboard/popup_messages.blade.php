@php
use App\Models\PopupMessage;
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$allPopups = collect();

if ($user) {
    try {
        $now = now()->toDateTimeString();
        
        // Get general popups (active and within date range)
        $generalPopups = PopupMessage::where('is_active', true)
            ->where('type', 'general')
            ->where(function($q) use ($now) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $now);
            })
            ->where(function($q) use ($now) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', $now);
            })
            ->get();
        
        // Get user-specific popups (active and within date range)
        $userPopups = PopupMessage::where('is_active', true)
            ->where('type', 'user_specific')
            ->where('user_id', $user->id)
            ->where(function($q) use ($now) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $now);
            })
            ->where(function($q) use ($now) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', $now);
            })
            ->get();
        
        // Combine all popups
        $allPopups = $generalPopups->merge($userPopups);
    } catch (\Exception $e) {
        // Silently fail if there's an error
        $allPopups = collect();
    }
}
@endphp

@if($user && $allPopups->count() > 0)
<!-- DEBUG: Popup count = {{ $allPopups->count() }} -->
<style>
	.popup-modal-custom .modal-content {
		border: none;
		border-radius: 20px;
		overflow: hidden;
		box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
		animation: modalFadeIn 0.4s ease-out;
	}

	.popup-modal-custom .modal-header {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border: none;
		padding: 1.5rem 2rem;
		position: relative;
	}

	.popup-modal-custom .modal-header::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
		opacity: 0.95;
	}

	.popup-modal-custom .modal-header > * {
		position: relative;
		z-index: 1;
	}

	.popup-modal-custom .modal-title {
		font-size: 1.5rem;
		font-weight: 700;
		margin: 0;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		color: white;
	}

	.popup-modal-custom .modal-title i {
		font-size: 1.75rem;
		animation: bellRing 2s ease-in-out infinite;
	}

	.popup-modal-custom .btn-close {
		background: rgba(255, 255, 255, 0.2);
		border-radius: 50%;
		opacity: 1;
		width: 40px;
		height: 40px;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: all 0.3s ease;
		backdrop-filter: blur(10px);
	}

	.popup-modal-custom .btn-close:hover {
		background: rgba(255, 255, 255, 0.3);
		transform: rotate(90deg) scale(1.1);
	}

	.popup-modal-custom .btn-close::before {
		content: '×';
		color: white;
		font-size: 1.5rem;
		font-weight: 300;
		line-height: 1;
	}

	.popup-modal-custom .modal-body {
		padding: 2rem;
		font-size: 1.1rem;
		line-height: 1.8;
		color: #333;
		background: #fff;
	}

	.popup-modal-custom .modal-footer {
		border: none;
		padding: 1.5rem 2rem;
		background: #f8f9fa;
		border-radius: 0 0 20px 20px;
	}

	.popup-modal-custom .btn-primary {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		border: none;
		padding: 0.75rem 2rem;
		font-weight: 600;
		border-radius: 10px;
		transition: all 0.3s ease;
		box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
	}

	.popup-modal-custom .btn-primary:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
	}

	.popup-modal-custom .modal-backdrop {
		background-color: rgba(0, 0, 0, 0.6);
		backdrop-filter: blur(5px);
	}

	@keyframes modalFadeIn {
		from {
			opacity: 0;
			transform: scale(0.9) translateY(-20px);
		}
		to {
			opacity: 1;
			transform: scale(1) translateY(0);
		}
	}

	@keyframes bellRing {
		0%, 100% {
			transform: rotate(0deg);
		}
		10%, 30% {
			transform: rotate(-10deg);
		}
		20%, 40% {
			transform: rotate(10deg);
		}
		50% {
			transform: rotate(0deg);
		}
	}

	@media (max-width: 768px) {
		.popup-modal-custom .modal-dialog {
			margin: 1rem;
		}

		.popup-modal-custom .modal-header {
			padding: 1.25rem 1.5rem;
		}

		.popup-modal-custom .modal-title {
			font-size: 1.25rem;
		}

		.popup-modal-custom .modal-body {
			padding: 1.5rem;
			font-size: 1rem;
		}

		.popup-modal-custom .modal-footer {
			padding: 1.25rem 1.5rem;
		}
	}
</style>

@foreach($allPopups as $index => $popup)
<!-- Popup Modal {{ $popup->id }} -->
<div class="modal fade popup-modal-custom" id="popupModal{{ $popup->id }}" tabindex="-1" aria-labelledby="popupModalLabel{{ $popup->id }}" aria-hidden="true" data-popup-index="{{ $index }}">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="popupModalLabel{{ $popup->id }}">
					<i class="align-middle" data-feather="bell"></i>
					{{ $popup->title }}
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="popup-message-content">
					{!! nl2br(e($popup->message)) !!}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
					<i class="align-middle" data-feather="check"></i> Got it
				</button>
			</div>
		</div>
	</div>
</div>
@endforeach

<script>
	(function() {
		// Wait for DOM and ensure scripts are loaded
		function initPopups() {
			// Initialize Feather Icons
			if (typeof feather !== 'undefined') {
				feather.replace();
			}

			// Get all popup modals
			const popupModals = document.querySelectorAll('.popup-modal-custom');
			console.log('Found popup modals:', popupModals.length);
			
			if (popupModals.length === 0) {
				console.log('No popup modals found');
				return;
			}

			let currentIndex = 0;

			// Function to show next popup
			function showNextPopup() {
				if (currentIndex < popupModals.length) {
					const modal = popupModals[currentIndex];
					console.log('Showing popup:', currentIndex, modal.id);
					
					// Check if Bootstrap is available
					if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
						console.log('Using Bootstrap Modal');
						const bsModal = new bootstrap.Modal(modal, {
							backdrop: 'static',
							keyboard: false
						});
						
						bsModal.show();

						// When modal is hidden, show next one
						modal.addEventListener('hidden.bs.modal', function() {
							currentIndex++;
							setTimeout(showNextPopup, 300);
						}, { once: true });
					} else {
						// Fallback: Show modal using vanilla JS
						console.log('Using fallback modal display');
						modal.style.display = 'block';
						modal.classList.add('show');
						document.body.classList.add('modal-open');
						
						// Create backdrop
						const backdrop = document.createElement('div');
						backdrop.className = 'modal-backdrop fade show';
						document.body.appendChild(backdrop);

						// Close button handlers
						const closeBtns = modal.querySelectorAll('.btn-close, .btn-primary');
						closeBtns.forEach(function(btn) {
							btn.addEventListener('click', function() {
								modal.style.display = 'none';
								modal.classList.remove('show');
								document.body.classList.remove('modal-open');
								if (backdrop.parentNode) {
									backdrop.remove();
								}
								currentIndex++;
								setTimeout(showNextPopup, 300);
							}, { once: true });
						});
					}
				}
			}

			// Start showing popups after a short delay
			setTimeout(showNextPopup, 500);
		}

		// Try multiple times to ensure DOM is ready
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', initPopups);
		} else {
			// DOM is already ready
			setTimeout(initPopups, 100);
		}
		
		// Also try after window load to ensure all scripts are loaded
		window.addEventListener('load', function() {
			setTimeout(initPopups, 200);
		});
	})();
</script>
@endif
