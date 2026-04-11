@include('home.header')

<section class="py-12 sm:py-16 md:py-24 bg-slate-50 min-h-[calc(100vh-80px)] flex flex-col justify-center">
    <div class="container mx-auto px-4 sm:px-6">
        <div
            class="max-w-3xl mx-auto bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="p-5 sm:p-8 md:p-10">
                <!-- Header -->
                <div class="text-center mb-6 sm:mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary/10 mb-4">
                        <i class="bi bi-person-plus text-2xl text-primary"></i>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">Create an Account</h2>
                    <p class="text-slate-500 text-sm sm:text-base">Join Artisttocollectors in just a few steps.</p>
                </div>

                <p class="response text-center text-red-500 mb-4 font-medium"></p>

                @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="regester" method="POST" action="{{ route('register.custom') }}" class="space-y-5">
                    @csrf
                    <!-- Honeypot field -->
                    <input type="text" name="honeypot" style="display:none;">
                    <!-- Timestamp field -->
                    <input type="hidden" name="timestamp" value="{{ now()->timestamp }}">

                    <!-- Section: Personal Information -->
                    <div>
                        <h3
                            class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="bi bi-person text-primary"></i> Personal Information
                        </h3>
                        <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-4 sm:p-5 space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label for="first_name" class="block text-sm font-bold text-slate-700 mb-1.5">First
                                        Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="first_name" name="first_name" required
                                        value="{{ old('first_name') }}"
                                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                        placeholder="John">
                                    @if ($errors->has('first_name'))
                                    <span class="text-red-500 text-xs mt-1 block">{{ $errors->first('first_name')
                                        }}</span>
                                    @endif
                                </div>

                                <div>
                                    <label for="middle_name"
                                        class="block text-sm font-bold text-slate-700 mb-1.5">Middle Name</label>
                                    <input type="text" id="middle_name" name="middle_name"
                                        value="{{ old('middle_name') }}"
                                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                        placeholder="Michael">
                                </div>

                                <div class="sm:col-span-2 lg:col-span-1">
                                    <label for="last_name" class="block text-sm font-bold text-slate-700 mb-1.5">Last
                                        Name <span class="text-red-500">*</span></label>
                                    <input type="text" id="last_name" name="last_name" required
                                        value="{{ old('last_name') }}"
                                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                        placeholder="Doe">
                                    @if ($errors->has('last_name'))
                                    <span class="text-red-500 text-xs mt-1 block">{{ $errors->first('last_name')
                                        }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="email" class="block text-sm font-bold text-slate-700 mb-1.5">Email
                                        Address <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                            class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                            placeholder="john@example.com">
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="text-red-500 text-xs mt-1 block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-bold text-slate-700 mb-1.5">Phone
                                        Number <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                            <i class="bi bi-telephone"></i>
                                        </span>
                                        <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}"
                                            class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                            placeholder="+1 (555) 000-0000">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="date_of_birth" class="block text-sm font-bold text-slate-700 mb-1.5">Date of
                                    Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth"
                                    value="{{ old('date_of_birth') }}"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base sm:max-w-xs">
                            </div>
                        </div>
                    </div>

                    <!-- Section: Location -->
                    <div>
                        <h3
                            class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="bi bi-geo-alt text-primary"></i> Location
                        </h3>
                        <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-4 sm:p-5 space-y-4">
                            <div>
                                <label for="address" class="block text-sm font-bold text-slate-700 mb-1.5">Street
                                    Address <span class="text-red-500">*</span></label>
                                <input type="text" id="address" name="address" required value="{{ old('address') }}"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                    placeholder="123 Main Street, Apt 4B">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="city" class="block text-sm font-bold text-slate-700 mb-1.5">City</label>
                                    <input type="text" id="city" name="city" value="{{ old('city') }}"
                                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                        placeholder="New York">
                                </div>

                                <div>
                                    <label for="state" class="block text-sm font-bold text-slate-700 mb-1.5">State /
                                        Province</label>
                                    <input type="text" id="state" name="state" value="{{ old('state') }}"
                                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                        placeholder="NY">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="zip_code" class="block text-sm font-bold text-slate-700 mb-1.5">ZIP /
                                        Postal Code</label>
                                    <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code') }}"
                                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                        placeholder="10001">
                                </div>

                                <div>
                                    <label for="country" class="block text-sm font-bold text-slate-700 mb-1.5">Country
                                        <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                            <i class="bi bi-globe"></i>
                                        </span>
                                        <select id="country" name="country" required
                                            class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors appearance-none text-sm sm:text-base">
                                            <option value="">Select Country</option>
                                            <option value="United States" {{ old('country')=='United States'
                                                ? 'selected' : '' }}>United States</option>
                                            <option value="Canada" {{ old('country')=='Canada' ? 'selected' : '' }}>
                                                Canada</option>
                                            <option value="United Kingdom" {{ old('country')=='United Kingdom'
                                                ? 'selected' : '' }}>United Kingdom</option>
                                            <option value="Australia" {{ old('country')=='Australia' ? 'selected' : ''
                                                }}>Australia</option>
                                            <option value="Germany" {{ old('country')=='Germany' ? 'selected' : '' }}>
                                                Germany</option>
                                            <option value="France" {{ old('country')=='France' ? 'selected' : '' }}>
                                                France</option>
                                            <option value="India" {{ old('country')=='India' ? 'selected' : '' }}>India
                                            </option>
                                            <option value="Nigeria" {{ old('country')=='Nigeria' ? 'selected' : '' }}>
                                                Nigeria</option>
                                            <option value="South Africa" {{ old('country')=='South Africa' ? 'selected'
                                                : '' }}>South Africa</option>
                                            <option value="Brazil" {{ old('country')=='Brazil' ? 'selected' : '' }}>
                                                Brazil</option>
                                            <option value="Japan" {{ old('country')=='Japan' ? 'selected' : '' }}>Japan
                                            </option>
                                            <option value="China" {{ old('country')=='China' ? 'selected' : '' }}>China
                                            </option>
                                            <option value="Mexico" {{ old('country')=='Mexico' ? 'selected' : '' }}>
                                                Mexico</option>
                                            <option value="Italy" {{ old('country')=='Italy' ? 'selected' : '' }}>Italy
                                            </option>
                                            <option value="Spain" {{ old('country')=='Spain' ? 'selected' : '' }}>Spain
                                            </option>
                                            <option value="Netherlands" {{ old('country')=='Netherlands' ? 'selected'
                                                : '' }}>Netherlands</option>
                                            <option value="Switzerland" {{ old('country')=='Switzerland' ? 'selected'
                                                : '' }}>Switzerland</option>
                                            <option value="Sweden" {{ old('country')=='Sweden' ? 'selected' : '' }}>
                                                Sweden</option>
                                            <option value="Norway" {{ old('country')=='Norway' ? 'selected' : '' }}>
                                                Norway</option>
                                            <option value="Singapore" {{ old('country')=='Singapore' ? 'selected' : ''
                                                }}>Singapore</option>
                                            <option value="South Korea" {{ old('country')=='South Korea' ? 'selected'
                                                : '' }}>South Korea</option>
                                            <option value="UAE" {{ old('country')=='UAE' ? 'selected' : '' }}>United
                                                Arab Emirates</option>
                                            <option value="Saudi Arabia" {{ old('country')=='Saudi Arabia' ? 'selected'
                                                : '' }}>Saudi Arabia</option>
                                            <option value="Kenya" {{ old('country')=='Kenya' ? 'selected' : '' }}>Kenya
                                            </option>
                                            <option value="Ghana" {{ old('country')=='Ghana' ? 'selected' : '' }}>Ghana
                                            </option>
                                            <option value="Egypt" {{ old('country')=='Egypt' ? 'selected' : '' }}>Egypt
                                            </option>
                                            <option value="Argentina" {{ old('country')=='Argentina' ? 'selected' : ''
                                                }}>Argentina</option>
                                            <option value="Colombia" {{ old('country')=='Colombia' ? 'selected' : '' }}>
                                                Colombia</option>
                                            <option value="Philippines" {{ old('country')=='Philippines' ? 'selected'
                                                : '' }}>Philippines</option>
                                            <option value="Indonesia" {{ old('country')=='Indonesia' ? 'selected' : ''
                                                }}>Indonesia</option>
                                            <option value="Thailand" {{ old('country')=='Thailand' ? 'selected' : '' }}>
                                                Thailand</option>
                                            <option value="Malaysia" {{ old('country')=='Malaysia' ? 'selected' : '' }}>
                                                Malaysia</option>
                                            <option value="New Zealand" {{ old('country')=='New Zealand' ? 'selected'
                                                : '' }}>New Zealand</option>
                                            <option value="Ireland" {{ old('country')=='Ireland' ? 'selected' : '' }}>
                                                Ireland</option>
                                            <option value="Poland" {{ old('country')=='Poland' ? 'selected' : '' }}>
                                                Poland</option>
                                            <option value="Portugal" {{ old('country')=='Portugal' ? 'selected' : '' }}>
                                                Portugal</option>
                                            <option value="Other" {{ old('country')=='Other' ? 'selected' : '' }}>Other
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Security -->
                    <div>
                        <h3
                            class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="bi bi-shield-lock text-primary"></i> Security
                        </h3>
                        <div class="bg-slate-50/50 border border-slate-100 rounded-xl p-4 sm:p-5 space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="password" class="block text-sm font-bold text-slate-700 mb-1.5">Password
                                        <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" id="password" name="password" required
                                            class="w-full pl-10 pr-12 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                            placeholder="••••••••">
                                        <button type="button" onclick="togglePassword('password', this)"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition-colors">
                                            <i class="bi bi-eye-slash text-lg"></i>
                                        </button>
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="text-red-500 text-xs mt-1 block">{{ $errors->first('password')
                                        }}</span>
                                    @endif
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-bold text-slate-700 mb-1.5">Confirm Password <span
                                            class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                            <i class="bi bi-lock-fill"></i>
                                        </span>
                                        <input type="password" id="password2" name="password_confirmation" required
                                            class="w-full pl-10 pr-12 py-3 border border-slate-200 rounded-xl bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors text-sm sm:text-base"
                                            placeholder="••••••••">
                                        <button type="button" onclick="togglePassword('password2', this)"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition-colors">
                                            <i class="bi bi-eye-slash text-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p class="text-xs text-slate-400"><i class="bi bi-info-circle me-1"></i>Password must be at
                                least 5 characters long.</p>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <button type="submit" id="div"
                            class="w-full py-3.5 sm:py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5 text-sm sm:text-base">
                            <i class="bi bi-arrow-right-circle me-2"></i>Create Account
                        </button>
                    </div>

                    <div class="text-center mt-4 sm:mt-6 space-y-3">
                        <p class="text-slate-500 text-xs sm:text-sm">By registering you agree to the Artisttocollectors
                            <a href="#" class="text-primary hover:underline font-medium">Terms of Use</a></p>
                        <p class="text-slate-600 text-sm">Already have an account? <a href="{{ route('login') }}"
                                class="text-primary font-bold hover:underline">Log in</a></p>
                    </div>
                </form>
            </div>
            <div
                class="bg-slate-50 border-t border-slate-100 p-3 sm:p-4 text-center text-xs sm:text-sm font-medium text-slate-500">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> Artisttocollectors.
            </div>
        </div>
    </div>
</section>

@include('home.footer')

<!-- JAVASCRIPT -->
<script>
    function togglePassword(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    }
</script>
<script src="auth/libs/jquery/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#regester').on('submit', function (e) {
            var firstName = $('#first_name').val().trim();
            var lastName = $('#last_name').val().trim();
            var email = $('#email').val().trim();
            var password = $('#password').val();
            var password2 = $('#password2').val();

            if (firstName === "" || lastName === "" || email === "" || password === "") {
                e.preventDefault();
                Swal.fire('Error', 'Please enter all required fields.', 'error');
                return false;
            }

            if (password.length < 5 || password2.length < 5) {
                e.preventDefault();
                Swal.fire('Weak Password', 'Please enter a stronger password!', 'warning');
                $("#password, #password2").val('');
                return false;
            }

            if (password != password2) {
                e.preventDefault();
                Swal.fire('Error', 'Passwords do not match. Please try again.', 'error');
                $("#password2").val('');
                return false;
            }

            var btn = $("#div");
            btn.html("Submitting request...");
            btn.prop('disabled', true);
            // Allow normal form submission
        });
    });
</script>