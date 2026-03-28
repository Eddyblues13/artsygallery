@include('home.header')

<section class="py-24 bg-slate-50 min-h-[calc(100vh-80px)] flex flex-col justify-center">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="p-8 md:p-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Create an Account</h2>
                    <p class="text-slate-500">Join Artisttocollectors in just a few steps.</p>
                </div>
                
                <p class="response text-center text-red-500 mb-4 font-medium"></p>
                
                <form id="regester" method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <!-- Honeypot field -->
                    <input type="text" name="honeypot" style="display:none;">
                    <!-- Timestamp field -->
                    <input type="hidden" name="timestamp" value="{{ now()->timestamp }}">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="fullname" class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                            <input type="text" id="fullname" name="name" required class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="John Doe">
                            @if ($errors->has('name'))
                                <span class="text-red-500 text-sm mt-1 block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="john@example.com">
                            @if ($errors->has('email'))
                                <span class="text-red-500 text-sm mt-1 block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">Mobile Number</label>
                            <input type="tel" id="phone" name="phone" required class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="+1 (555) 000-0000">
                        </div>
                        
                        <div>
                            <label for="country" class="block text-sm font-bold text-slate-700 mb-2">Country</label>
                            <select id="country" name="country" required class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors">
                                <option value="">Select Country</option>
                                <option value="United States">United States</option>
                                <option value="Canada">Canada</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Australia">Australia</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                                <option value="India">India</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Japan">Japan</option>
                                <option value="China">China</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="address" class="block text-sm font-bold text-slate-700 mb-2">Address</label>
                        <input type="text" id="address" name="address" required class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="123 Main St, City, State">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                            <input type="password" id="password" name="password" required class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="••••••••">
                            @if ($errors->has('password'))
                                <span class="text-red-500 text-sm mt-1 block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Confirm Password</label>
                            <input type="password" id="password2" name="password_confirmation" required class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="••••••••">
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <button type="submit" id="div" class="w-full py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                            Create Account
                        </button>
                    </div>
                    
                    <div class="text-center mt-6">
                        <p class="text-slate-500 text-sm mb-4">By registering you agree to the Artisttocollectors <a href="#" class="text-primary hover:underline font-medium">Terms of Use</a></p>
                        <p class="text-slate-600">Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Log in</a></p>
                    </div>
                </form>
            </div>
            <div class="bg-slate-50 border-t border-slate-100 p-4 text-center text-sm font-medium text-slate-500">
                &copy; <script>document.write(new Date().getFullYear())</script> Artisttocollectors.
            </div>
        </div>
    </div>
</section>

@include('home.footer')

<!-- JAVASCRIPT -->
<script src="auth/libs/jquery/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#regester').on('submit', function(e) {
            e.preventDefault();
            var fullname = $('#fullname').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var password2 = $('#password2').val();

            if (fullname == "" || email == "" || password == "") {
                Swal.fire('Error', 'Please enter all required fields.', 'error');
                return false;
            }

            if (password.length < 5 || password2.length < 5) {
                Swal.fire('Weak Password', 'Please enter a stronger password!', 'warning');
                $("#password, #password2").val('');
                return false;
            }

            if (password != password2) {
                Swal.fire('Error', 'Passwords do not match. Please try again.', 'error');
                $("#password2").val('');
                return false;
            }

            var btn = $("#div");
            var originalText = btn.html();
            btn.html("Submitting request...");
            
            $.ajax({
                type: "POST",
                url: "{{ route('register.custom') }}",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.content == 'successful') {
                        $(".response").html(data.content);
                        window.location = data.redirect;
                    } else if (data.content == 'Error') {
                        Swal.fire('Registration Failed', data.message || 'An error occurred.', 'error');
                        btn.html(originalText);
                    } else {
                        $(".response").html(data.content);
                        btn.html(originalText);
                    }
                },
                error: function() {
                    Swal.fire('Connection Error', 'Please check your internet connection!', 'error');
                    btn.html(originalText);
                }
            });
        });
    });
</script>