    <!-- Hero Banner Section - Styled similarly to main page -->
    <div class="relative h-[24rem] sm:h-96 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-purple-900/80 z-10"></div>
        <img
            src="https://images.unsplash.com/photo-1486299267070-83823f5448dd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80"
            alt="Contact Us"
            class="absolute w-full h-full object-cover object-center">
        <div class="container mx-auto pt-32 sm-pt-24 pb-20 sm:pb-6 px-4 relative z-20 h-full flex flex-col justify-center">
            <div class="mb-8 max-w-2xl bg-black/30 p-4 sm:p-6 md:p-8 rounded-lg backdrop-blur-sm">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-2 md:mb-4">Get in Touch</h1>
                <p class="text-lg sm:text-xl text-white">We'd love to hear from you! Reach out for inquiries, support, or just to say hello.</p>
            </div>
        </div>
    </div>

    <!-- Contact Cards Section - Grid layout consistent with main page -->
    <div class="bg-gray-50 dark:bg-gray-900 py-8 sm:py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                <!-- Call Us Card -->
                <div class="bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 flex flex-col items-center">
                    <div class="w-14 h-14 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-300 mb-5">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Call Us</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-1">(+960) 726-3030</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">24 Hours</p>
                </div>

                <!-- Email Us Card -->
                <div class="bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 flex flex-col items-center">
                    <div class="w-14 h-14 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-300 mb-5">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Email Us</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-1">reservations@wanderlustadventuresmv.com</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">www.wanderlustadventuresmv.com</p>
                </div>

                <!-- Visit Us Card -->
                <div class="bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300 flex flex-col items-center">
                    <div class="w-14 h-14 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-300 mb-5">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Visit Us</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-1">Addu City</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Mendhurah Folheymaage, S. Hithadhoo</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form and Map Section -->
    <div class="py-10 sm:py-16 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12">
                <!-- Contact Form -->
                <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-6">Send Us a Message</h2>
                    <form id="contactForm" class="space-y-5" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <input type="text" id="firstName" name="first_name" required placeholder="First Name"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                            </div>
                            <div>
                                <input type="text" id="lastName" name="last_name" required placeholder="Last Name"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <input type="email" id="email" name="email" required placeholder="Email Address"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                            </div>
                            <div>
                                <input type="tel" id="phone" name="phone" placeholder="Phone Number"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                            </div>
                        </div>

                        <div>
                            <textarea id="message" name="message" rows="5" required placeholder="Write your message here..."
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"></textarea>
                        </div>

                        <button type="submit"
                                class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 w-full sm:w-auto">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Map -->
                <div class="rounded-lg overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 h-full min-h-[400px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.594096442738!2d73.08469777551021!3d-0.6074409352620724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x24b5a10028897a43%3A0x85822b2cb614430a!2sWanderlust%20adventures%20pvt%20ltd!5e0!3m2!1sen!2smv!4v1744229017832!5m2!1sen!2smv"
                        class="w-full h-full"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section - Similar to main page -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-10 sm:py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3 sm:mb-4">Join Our Newsletter</h2>
            <p class="text-white/90 mb-6 sm:mb-8 max-w-2xl mx-auto">Subscribe to receive updates about our newest properties and exclusive offers</p>
            <form class="max-w-md mx-auto">
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-0">
                    <input type="email" placeholder="Your email address"
                           class="w-full sm:flex-grow px-4 py-3 rounded-lg sm:rounded-r-none focus:outline-none">
                    <button
                        class="w-full sm:w-auto bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg sm:rounded-l-none font-medium transition duration-300">
                        Subscribe
                    </button>
                </div>
            </form>
        </div>
    </div>
