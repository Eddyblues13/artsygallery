@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Send Email</strong></h1>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Send Email to User</h5>
					</div>
					<div class="card-body">
						@if (session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Error!</strong> {{ session('error') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif

						@if (session('status'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Success!</strong> {{ session('status') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif

						@if ($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<ul class="mb-0">
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif

						<form action="{{ route('send.mail') }}" method="POST">
							@csrf

							<div class="mb-3">
								<label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
								<input type="email" 
									class="form-control @error('email') is-invalid @enderror" 
									id="email" 
									name="email" 
									value="{{ old('email') }}" 
									placeholder="user@example.com" 
									required>
								@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
								<input type="text" 
									class="form-control @error('subject') is-invalid @enderror" 
									id="subject" 
									name="subject" 
									value="{{ old('subject') }}" 
									placeholder="Email Subject" 
									required>
								@error('subject')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label for="message" class="form-label">Message <span class="text-danger">*</span></label>
								<textarea class="form-control @error('message') is-invalid @enderror" 
									id="message" 
									name="message" 
									rows="6" 
									placeholder="Enter your message here..." 
									required>{{ old('message') }}</textarea>
								@error('message')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-primary">
									<i class="align-middle" data-feather="send"></i> Send Email
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

@include('dashboard.footer')
