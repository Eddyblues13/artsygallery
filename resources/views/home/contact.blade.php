@include('home.header')

<!-- Hero Section -->
<section class="py-24 md:py-32 bg-slate-50 border-b border-slate-200">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-slate-900 mb-6 tracking-tight">
            Get in Touch
        </h1>
        <p class="text-xl text-slate-600 leading-relaxed">
            Have questions about Artisttocollectors? We'd love to hear from you. Send us a message and our team will respond promptly.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
            <!-- Contact Info -->
            <div class="lg:col-span-1">
                <div class="sticky top-32">
                    <h2 class="text-3xl font-bold mb-8 text-slate-900">Contact Info</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 p-6 bg-slate-50 border border-slate-100 rounded-2xl hover:border-primary transition-colors">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                                <i class="bi bi-geo-alt text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">Address</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">
                                    C/54 Northwest Freeway, Suite 558,<br>
                                    Houston, USA 485
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-6 bg-slate-50 border border-slate-100 rounded-2xl hover:border-primary transition-colors">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                                <i class="bi bi-telephone text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">Phone</h3>
                                <p class="text-slate-600 text-sm">
                                    <a href="tel:+13397939208" class="hover:text-primary transition-colors">+1 (339) 793-9208</a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4 p-6 bg-slate-50 border border-slate-100 rounded-2xl hover:border-primary transition-colors">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                                <i class="bi bi-envelope text-primary text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">Email</h3>
                                <p class="text-slate-600 text-sm">
                                    <a href="mailto:support@artisttocollectors.com" class="hover:text-primary transition-colors">support@artisttocollectors.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 md:p-12">
                    <h2 class="text-3xl font-bold mb-8 text-slate-900">Send us a Message</h2>
                    
                    @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl font-medium" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    @if($message = Session::get('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl font-medium">
                        <p>{{$message}}</p>
                    </div>
                    @endif
                    
                    <form action="{{url('/support-email')}}" method="post" id="contactForm" name="contactForm" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                                    Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       required
                                       class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-colors"
                                       placeholder="Your name" />
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-bold text-slate-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       required
                                       class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-colors"
                                       placeholder="your.email@example.com" />
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">
                                    Phone
                                </label>
                                <input type="tel" 
                                       name="phone" 
                                       id="phone"
                                       class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-colors"
                                       placeholder="+1 (555) 000-0000" />
                            </div>
                            
                            <div>
                                <label for="company" class="block text-sm font-bold text-slate-700 mb-2">
                                    Company
                                </label>
                                <input type="text" 
                                       name="company" 
                                       id="company"
                                       class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-colors"
                                       placeholder="Company name" />
                            </div>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-bold text-slate-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" 
                                      id="message" 
                                      rows="6" 
                                      required
                                      class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary focus:bg-white transition-colors resize-y"
                                      placeholder="Tell us how we can help you..."></textarea>
                        </div>
                        
                        <div>
                            <button type="submit" 
                                    class="w-full md:w-auto px-8 py-3.5 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark shadow-sm hover:shadow hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2">
                                <span>Send Message</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden p-2">
            <div class="aspect-w-16 aspect-h-9 h-96 rounded-2xl overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464.6!2d-95.3698!3d29.7604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjnCsDQ1JzM3LjQiTiA5NcKwMjInMTEuMyJX!5e0!3m2!1sen!2sus!4v1234567890"
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-full">
                </iframe>
            </div>
        </div>
    </div>
</section>

@include('home.footer')
