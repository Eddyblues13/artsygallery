@include('home.header')

<section class="py-24 bg-slate-50 min-h-[calc(100vh-80px)] flex flex-col justify-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="p-8 md:p-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Welcome Back</h2>
                    <p class="text-slate-500">Sign in to continue to Artisttocollectors</p>
                </div>

                <p class="response text-center text-red-500 mb-4 font-medium"></p>
                @if (session('status'))
                <div
                    class="mb-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded-xl text-center text-sm font-medium">
                    {{ session('status') }}</div>
                @elseif (session('error'))
                <div
                    class="mb-4 p-3 bg-red-50 text-red-700 border border-red-200 rounded-xl text-center text-sm font-medium">
                    {{ session('error') }}</div>
                @endif

                <form id="login_form" action="{{ route('login.custom') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors placeholder-slate-400"
                            placeholder="your@email.com">
                        @if ($errors->has('email'))
                        <span class="text-red-500 text-sm mt-1 block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-primary font-semibold hover:text-primary-dark transition-colors">Forgot
                                password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="w-full px-4 py-3 pr-12 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors placeholder-slate-400"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password', this)"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600 transition-colors">
                                <i class="bi bi-eye-slash text-lg"></i>
                            </button>
                        </div>
                        @if ($errors->has('password'))
                        <span class="text-red-500 text-sm mt-1 block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember-check" name="remember" {{ old('remember') ? 'checked' : ''
                            }}
                            class="w-4 h-4 text-primary bg-slate-100 border-slate-300 rounded focus:ring-primary cursor-pointer">
                        <label for="remember-check"
                            class="ml-3 text-sm font-medium text-slate-600 cursor-pointer">Remember me</label>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                        Log In
                    </button>

                    <div class="text-center mt-6">
                        <p class="text-slate-600">Don't have an account? <a href="{{ route('register') }}"
                                class="text-primary font-bold hover:underline">Sign up now</a></p>
                    </div>
                </form>
            </div>
            <div class="bg-slate-50 border-t border-slate-100 p-4 text-center text-sm font-medium text-slate-500">
                &copy; <script>
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
    $(document).ready(function() {
        $('#login_form').on('submit', function(e) {
            e.preventDefault();
            $(".response").html("Authenticating...");
            var email = $('#email').val();
            var password = $('#password').val();

            if (email == '' || password == '') {
                Swal.fire('Error', 'Please enter all fields.', 'error');
                $(".response").html("");
                return false;
            }
            $.ajax({
                type: "POST",
                url: '{{ route("login.custom") }}',
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.content == 'Successful') {
                        $(".response").html(data.message);
                        window.location = data.redirect;
                    } else if (data.content == 'Error') {
                        $(".response").html("");
                        Swal.fire('Login Failed', data.message, 'error');
                    }
                },
                error: function(xhr) {
                    $(".response").html("");
                    var msg = 'Please check your internet connection!';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', msg, 'error');
                }
            });
        });
    });
</script>