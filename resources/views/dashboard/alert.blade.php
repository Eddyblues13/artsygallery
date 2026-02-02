{{-- Professional Alert Component for Dashboard --}}

<style>
.dashboard-alert {
    position: relative;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    border-radius: 12px;
    border-left: 4px solid;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    animation: slideInDown 0.4s ease-out;
    backdrop-filter: blur(10px);
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dashboard-alert .alert-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.dashboard-alert .alert-content {
    flex: 1;
}

.dashboard-alert .alert-title {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.25rem;
    line-height: 1.4;
}

.dashboard-alert .alert-message {
    font-size: 0.9rem;
    line-height: 1.5;
    opacity: 0.95;
}

.dashboard-alert .alert-list {
    margin: 0.5rem 0 0 0;
    padding-left: 1.25rem;
    font-size: 0.875rem;
}

.dashboard-alert .alert-list li {
    margin-bottom: 0.25rem;
}

.dashboard-alert .btn-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: transparent;
    border: none;
    font-size: 1.5rem;
    line-height: 1;
    opacity: 0.5;
    cursor: pointer;
    transition: opacity 0.2s;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dashboard-alert .btn-close:hover {
    opacity: 1;
}

/* Success Alert */
.dashboard-alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-left-color: #28a745;
    color: #155724;
}

.dashboard-alert-success .alert-icon {
    background: rgba(40, 167, 69, 0.15);
    color: #28a745;
}

.dashboard-alert-success .btn-close {
    color: #155724;
}

/* Error/Danger Alert */
.dashboard-alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    border-left-color: #dc3545;
    color: #721c24;
}

.dashboard-alert-danger .alert-icon {
    background: rgba(220, 53, 69, 0.15);
    color: #dc3545;
}

.dashboard-alert-danger .btn-close {
    color: #721c24;
}

/* Warning Alert */
.dashboard-alert-warning {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    border-left-color: #ffc107;
    color: #856404;
}

.dashboard-alert-warning .alert-icon {
    background: rgba(255, 193, 7, 0.15);
    color: #ffc107;
}

.dashboard-alert-warning .btn-close {
    color: #856404;
}

/* Info Alert */
.dashboard-alert-info {
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    border-left-color: #17a2b8;
    color: #0c5460;
}

.dashboard-alert-info .alert-icon {
    background: rgba(23, 162, 184, 0.15);
    color: #17a2b8;
}

.dashboard-alert-info .btn-close {
    color: #0c5460;
}

/* Responsive Design */
@media (max-width: 576px) {
    .dashboard-alert {
        padding: 0.875rem 1rem;
        gap: 0.75rem;
    }
    
    .dashboard-alert .alert-icon {
        width: 32px;
        height: 32px;
    }
    
    .dashboard-alert .alert-icon i {
        width: 18px !important;
        height: 18px !important;
    }
    
    .dashboard-alert .alert-title {
        font-size: 0.9rem;
    }
    
    .dashboard-alert .alert-message {
        font-size: 0.85rem;
    }
}

/* Auto-dismiss animation */
.dashboard-alert.fade {
    transition: opacity 0.3s ease-out;
}

.dashboard-alert.fade:not(.show) {
    opacity: 0;
}
</style>

@if(session('success'))
<div class="dashboard-alert dashboard-alert-success alert-dismissible fade show" role="alert">
	<div class="alert-icon">
		<i class="align-middle" data-feather="check-circle" style="width: 24px; height: 24px;"></i>
	</div>
	<div class="alert-content">
		<div class="alert-title">
			Success!
		</div>
		<div class="alert-message">
			{{ session('success') }}
		</div>
	</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if(session('message'))
<div class="dashboard-alert dashboard-alert-success alert-dismissible fade show" role="alert">
	<div class="alert-icon">
		<i class="align-middle" data-feather="check-circle" style="width: 24px; height: 24px;"></i>
	</div>
	<div class="alert-content">
		<div class="alert-title">
			Success!
		</div>
		<div class="alert-message">
			{{ session('message') }}
		</div>
	</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if(session('status'))
<div class="dashboard-alert dashboard-alert-success alert-dismissible fade show" role="alert">
	<div class="alert-icon">
		<i class="align-middle" data-feather="check-circle" style="width: 24px; height: 24px;"></i>
	</div>
	<div class="alert-content">
		<div class="alert-title">
			Success!
		</div>
		<div class="alert-message">
			{{ session('status') }}
		</div>
	</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if(session('error'))
<div class="dashboard-alert dashboard-alert-danger alert-dismissible fade show" role="alert">
	<div class="alert-icon">
		<i class="align-middle" data-feather="alert-circle" style="width: 24px; height: 24px;"></i>
	</div>
	<div class="alert-content">
		<div class="alert-title">
			Error!
		</div>
		<div class="alert-message">
			{{ session('error') }}
		</div>
	</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if(session('warning'))
<div class="dashboard-alert dashboard-alert-warning alert-dismissible fade show" role="alert">
	<div class="alert-icon">
		<i class="align-middle" data-feather="alert-triangle" style="width: 24px; height: 24px;"></i>
	</div>
	<div class="alert-content">
		<div class="alert-title">
			Warning!
		</div>
		<div class="alert-message">
			{{ session('warning') }}
		</div>
	</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if(session('info'))
<div class="dashboard-alert dashboard-alert-info alert-dismissible fade show" role="alert">
	<div class="alert-icon">
		<i class="align-middle" data-feather="info" style="width: 24px; height: 24px;"></i>
	</div>
	<div class="alert-content">
		<div class="alert-title">
			Information
		</div>
		<div class="alert-message">
			{{ session('info') }}
		</div>
	</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

@if($errors->any())
<div class="dashboard-alert dashboard-alert-danger alert-dismissible fade show" role="alert">
	<div class="alert-icon">
		<i class="align-middle" data-feather="alert-circle" style="width: 24px; height: 24px;"></i>
	</div>
	<div class="alert-content">
		<div class="alert-title">
			Validation Error!
		</div>
		<div class="alert-message">
			Please correct the following errors:
		</div>
		<ul class="alert-list">
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Feather Icons for alerts
		if (typeof feather !== 'undefined') {
			feather.replace();
		}
		
		// Auto-dismiss alerts after 5 seconds
		const alerts = document.querySelectorAll('.dashboard-alert');
		alerts.forEach(alert => {
			setTimeout(() => {
				const bsAlert = new bootstrap.Alert(alert);
				bsAlert.close();
			}, 5000);
		});
	});
</script>
