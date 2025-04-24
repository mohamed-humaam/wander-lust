<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Wanderlust Adventures</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animation-delay-100 {
            animation-delay: 0.1s;
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-300 {
            animation-delay: 0.3s;
        }

        .text-shadow-lg {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3), 0 4px 8px rgba(0, 0, 0, 0.2), 0 0 12px rgba(30, 144, 255, 0.4);
        }

        .text-shadow-md {
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3), 0 2px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="font-sans text-gray-800">
<div class="min-h-screen">
    <!-- Hero Section with Blue Gradient -->
    <div
        class="relative bg-gradient-to-br from-blue-400 via-blue-600 to-black text-white py-16 px-4 text-center overflow-hidden shadow-lg">
        <div class="absolute inset-0 bg-cover opacity-15"></div>
        <div class="relative z-10 max-w-4xl mx-auto p-8 rounded-lg backdrop-blur-sm">
            <div class="flex flex-col items-center justify-center mb-6 pt-18">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-2 text-shadow-lg animate-fade-in">
                    Get in <span class="text-blue-200">Touch</span>
                </h1>
                <div class="h-2 w-40 bg-blue-400 rounded"></div>
            </div>
            <p class="text-xl md:text-2xl max-w-2xl mx-auto leading-relaxed text-shadow-md animate-fade-in opacity-0 animation-delay-200">
                We'd love to hear from you! Reach out for inquiries, support, or just to say hello.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative">
        <!-- Background Image -->
        <img class="absolute right-0 bottom-0 w-4/5 h-full opacity-10 z-0"
             src="{{ asset('/assets/images/images/background-pattern.png') }}" alt="Background pattern">

        <!-- Contact Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 relative z-10">
            <!-- Call Us Card -->
            <div
                class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 animate-fade-in animation-delay-100">
                <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-center mb-3">Call Us</h3>
                <p class="text-center mb-1">(+960) 726-3030</p>
                <p class="text-sm text-gray-500 text-center">Saturday-Thursday (8 AM - 5 PM)</p>
            </div>

            <!-- Email Us Card -->
            <div
                class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 animate-fade-in animation-delay-200">
                <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-center mb-3">Email Us</h3>
                <p class="text-center mb-1">reservations@wanderlustadventuresmv.com</p>
                <p class="text-sm text-gray-500 text-center">Web: www.wanderlustadventuresmv.com</p>
            </div>

            <!-- Visit Us Card -->
            <div
                class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 animate-fade-in animation-delay-300">
                <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-center mb-3">Visit Us</h3>
                <p class="text-center mb-1">Addu City</p>
                <p class="text-sm text-gray-500 text-center">Mendhurah Folheymaage, S. Hithadhoo</p>
            </div>
        </div>

        <!-- Contact Form and Map Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 relative z-10">
            <!-- Contact Form - Styled like the second example -->
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold mb-8">Send Us a Message</h2>
                <form id="contactForm" class="space-y-6" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <input type="text" id="firstName" name="first_name" required placeholder="First Name"
                                   class="w-full px-4 py-3 border-2 border-gray-400 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div>
                            <input type="text" id="lastName" name="last_name" required placeholder="Last Name"
                                   class="w-full px-4 py-3 border-2 border-gray-400 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <input type="email" id="email" name="email" required placeholder="Email Address"
                                   class="w-full px-4 py-3 border-2 border-gray-400 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div>
                            <input type="tel" id="phone" name="phone" placeholder="Phone Number"
                                   class="w-full px-4 py-3 border-2 border-gray-400 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                    </div>

                    <div>
                            <textarea id="message" name="message" rows="5" required
                                      placeholder="Write your message here..."
                                      class="w-full px-4 py-3 border-2 border-gray-400 rounded-lg bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full md:w-4/5 lg:w-3/4 mx-auto block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg flex items-center justify-center space-x-2 transition duration-300 transform hover:-translate-y-1">
                        <span>Send Message</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Map - Updated with dark mode -->
            <div class="rounded-xl shadow-md overflow-hidden">
                <iframe
                    style="filter: grayscale(100%) invert(92%) contrast(83%);"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.594096442738!2d73.08469777551021!3d-0.6074409352620724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x24b5a10028897a43%3A0x85822b2cb614430a!2sWanderlust%20adventures%20pvt%20ltd!5e0!3m2!1sen!2smv!4v1744229017832!5m2!1sen!2smv&style=dark"
                    class="w-full h-full min-h-[500px]"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

<script>
    // Optional: Add any JavaScript functionality here
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('contactForm');
        if (form) {
            form.addEventListener('submit', function (e) {
                // You can add form validation or AJAX submission here
            });
        }
    });
</script>
</body>
</html>
