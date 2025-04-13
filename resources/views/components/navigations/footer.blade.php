@php use App\Models\Category; @endphp

<!-- main-footer -->
<footer class="main-footer">
    <div class="container">
        <div class="footer-content">
            <div class="row justify-content-between">
                <!-- Company Info Column -->
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="logo-widget footer-widget">
                        <div class="logo-container">
                            <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="WanderLust" class="h-20">
                        </div>
                        <div class="text">
                            <p>Wanderlust Adventures, based in Addu, offers personalized inbound and outbound travel experiences. We specialize in creating unforgettable journeys to the Maldives and global destinations, turning your wanderlust into lasting memories.</p>
                        </div>
                        <ul class="footer-social">
                            <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" aria-label="Vimeo"><i class="fab fa-vimeo-v"></i></a></li>
                            <li><a href="#" aria-label="Google Plus"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="row">
                        <!-- Categories Column -->
                        <div class="col-lg-6 col-md-6 col-sm-12 footer-column">
                            <div class="service-widget footer-widget">
                                <div class="footer-title">Categories</div>
                                <ul class="list">
                                    @php
                                        $parentCategories = Category::whereNull('parent_id')->with('children')->get();
                                    @endphp

                                    @foreach($parentCategories as $category)
                                        <li>
                                            <a href="/packages/category/{{ $category->slug }}" class="font-medium">
                                                {{ $category->name }}
                                            </a>
                                            @if($category->children->isNotEmpty())
                                                <ul class="ml-4 mt-2 space-y-2">
                                                    @foreach($category->children as $child)
                                                        <li>
                                                            <a href="/packages/category/{{ $child->slug }}" class="text-sm opacity-80 hover:opacity-100">
                                                                {{ $child->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Contact Info Column -->
                        <div class="col-lg-6 col-md-6 col-sm-12 footer-column">
                            <div class="contact-widget footer-widget">
                                <div class="footer-title">Contacts</div>
                                <div class="text">
                                    <p class="address"><i class="fas fa-map-marker-alt"></i> <span>Mendhurah Folheymaage, Ground Floor, Elha Didi Magu, S.Hithadhoo, Maldives</span></p>
                                    <p class="phone"><i class="fas fa-phone-alt"></i> <span><a href="tel:+9603339796">+960 333-9796</a></span></p>
                                    <p class="email"><i class="fas fa-envelope"></i> <span><a href="mailto:reservations@wanderlustadventuresmv.com">reservations@wanderlustadventuresmv.com</a></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->

<div class="footer-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12 column">
                <div class="copyright"><a href="#">WanderLust Adventures</a> &copy; {{ date('Y') }} All Rights Reserved</div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 column">
                <ul class="footer-nav">
                    <li><a href="tel:+9603339796">+960 333-9796</a></li>
                    <li><a href="mailto:reservations@wanderlustadventuresmv.com">reservations@wanderlustadventuresmv.com</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    /* Base styles */
    :root {
        --primary-color: #ff5e14;
        --background-dark: #1e2129;
        --background-darker: #13151a;
        --text-light: #9ea0a9;
        --text-white: #ffffff;
        --spacing-xs: 10px;
        --spacing-sm: 15px;
        --spacing-md: 25px;
        --spacing-lg: 40px;
        --spacing-xl: 60px;
        --transition: all 0.3s ease;
        --navbar-z-index: 50;
    }

    h1, h2, h3, h4, h5, h6 {
        margin: 0;
        font-family: 'Playfair Display', serif;
    }

    section {
        padding: 60px 0;
        min-height: 100vh;
    }

    a, a:hover, a:focus, a:active {
        text-decoration: none;
        outline: none;
        transition: var(--transition);
    }

    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    /* Grid System */
    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 576px) {
        .container {
            max-width: 540px;
        }
    }

    @media (min-width: 768px) {
        .container {
            max-width: 720px;
        }
    }

    @media (min-width: 992px) {
        .container {
            max-width: 960px;
        }
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 1140px;
        }
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .align-items-center {
        align-items: center;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    [class*="col-"] {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }

    .col-sm-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    @media (min-width: 768px) {
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (min-width: 992px) {
        .col-lg-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .col-lg-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-lg-7 {
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }
    }

    /* Main footer styles */
    .main-footer {
        position: relative;
        background: var(--background-dark);
        color: var(--text-light);
        z-index: 10;
    }

    .footer-content {
        position: relative;
        padding: 70px 0;
    }

    /* Animated world map background */
    .footer-content:before {
        position: absolute;
        content: '';
        background: url(https://i.ibb.co/jyRLrBZ/world-map.png);
        width: 744px;
        height: 365px;
        top: 50px;
        right: 0px;
        background-size: cover;
        background-repeat: no-repeat;
        opacity: 0.1;
        animation: float-bob 30s linear infinite;
        pointer-events: none;
        z-index: -1;
    }

    @keyframes float-bob {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
        100% {
            transform: translateY(0);
        }
    }

    /* Logo and company info section */
    .footer-column {
        margin-bottom: 0;
        position: relative;
        z-index: 10;
    }

    .footer-widget {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .logo-widget {
        position: relative;
    }

    .logo-container {
        margin-bottom: 20px;
        position: relative;
        z-index: 10;
    }

    .logo-box {
        margin-bottom: 25px;
        transition: var(--transition);
    }

    .logo-box img {
        max-width: 180px;
        height: auto;
    }

    .logo-box a:hover {
        opacity: 0.8;
    }

    .logo-widget .text p {
        color: var(--text-light);
        margin-bottom: 25px;
        line-height: 1.7;
    }

    /* Social Media Icons */
    .footer-social {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: auto;
        position: relative;
        z-index: 10;
    }

    .footer-social li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #2e3138;
        color: var(--text-light);
        border-radius: 50%;
        transition: var(--transition);
    }

    .footer-social li a:hover {
        color: var(--text-white);
        background: var(--primary-color);
        transform: translateY(-3px);
    }

    /* Footer Section Titles */
    .footer-title {
        position: relative;
        font-size: 22px;
        line-height: 1.4;
        color: var(--text-white);
        font-weight: 700;
        margin-bottom: 30px;
        padding-left: 15px;
        padding-bottom: 10px;
    }

    .footer-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 2px;
        width: 40px;
        margin-left: 15px;
        background: var(--primary-color);
    }

    /* Services List */
    .service-widget .list {
        position: relative;
        z-index: 10;
    }

    .service-widget .list li {
        margin-bottom: 15px;
    }

    .service-widget .list li a {
        color: var(--text-light);
        position: relative;
        padding-left: 15px;
        transition: var(--transition);
        display: inline-block;
    }

    .service-widget .list li a:before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--primary-color);
        opacity: 0;
        transition: var(--transition);
    }

    .service-widget .list li a:hover {
        color: var(--primary-color);
        padding-left: 20px;
    }

    .service-widget .list li a:hover:before {
        opacity: 1;
    }

    /* Contact Information */
    .contact-widget .text {
        padding-left: 15px;
        position: relative;
        z-index: 10;
    }

    .contact-widget p {
        position: relative;
        color: var(--text-light);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .contact-widget p i {
        position: absolute;
        left: 0;
        top: 5px;
        color: var(--primary-color);
        font-size: 18px;
    }

    .contact-widget p a {
        color: var(--text-light);
        transition: var(--transition);
    }

    .contact-widget p a:hover {
        color: var(--primary-color);
    }

    .contact-widget .address span {
        display: inline-block;
    }

    /* Footer Bottom */
    .footer-bottom {
        position: relative;
        background: var(--background-darker);
        padding: 20px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        z-index: 10;
    }

    .footer-bottom .copyright {
        color: var(--text-light);
    }

    .footer-bottom .copyright a {
        color: var(--text-light);
        font-weight: 600;
        transition: var(--transition);
    }

    .footer-bottom .copyright a:hover {
        color: var(--primary-color);
    }

    .footer-bottom .footer-nav {
        display: flex;
        justify-content: flex-end;
        gap: 20px;
    }

    .footer-bottom .footer-nav li a {
        color: var(--text-light);
        position: relative;
        transition: var(--transition);
    }

    .footer-bottom .footer-nav li a:hover {
        color: var(--primary-color);
    }

    /* Enhanced Responsive Design */
    @media (max-width: 1199px) {
        .footer-content {
            padding: 60px 0;
        }

        .footer-content:before {
            opacity: 0.05;
        }
    }

    @media (max-width: 991px) {
        .footer-content {
            padding: 50px 0 30px;
        }

        .footer-column {
            margin-bottom: 30px;
        }

        .footer-content:before {
            width: 100%;
            background-position: center;
        }

        /* Start of mobile/tablet centering styles */
        .service-widget, .contact-widget {
            text-align: center;
        }

        .service-widget .list {
            padding-left: 0;
            display: inline-block;
        }

        .service-widget .list li {
            text-align: center;
        }

        .service-widget .list li a {
            padding-left: 0;
        }

        .service-widget .list li a:before {
            display: none;
        }

        .service-widget .list li a:hover {
            padding-left: 0;
        }

        .contact-widget .text {
            padding-left: 0;
            text-align: center;
        }

        .contact-widget p {
            padding-left: 0;
            text-align: center;
            display: block;
        }

        .contact-widget p i {
            position: static;
            display: block;
            margin: 0 auto 8px;
        }

        .contact-widget p span {
            display: block;
        }

        .footer-title {
            text-align: center;
            padding-left: 0;
        }

        .footer-title:after {
            left: 50%;
            margin-left: 0;
            transform: translateX(-50%);
        }
        /* End of mobile/tablet centering styles */
    }

    @media (max-width: 767px) {
        .footer-content {
            padding: 40px 0 20px;
            text-align: center;
        }

        .footer-column {
            margin-bottom: 40px;
        }

        .footer-social {
            justify-content: center;
        }

        .footer-bottom {
            text-align: center;
        }

        .footer-bottom .footer-nav {
            justify-content: center;
            margin-top: 10px;
            flex-wrap: wrap;
        }
    }

    /* Touch-friendly improvements */
    @media (max-width: 767px) {
        .footer-social li a,
        .service-widget .list li a,
        .contact-widget p a,
        .footer-bottom .footer-nav li a {
            display: inline-block;
            padding: 5px;
        }

        .service-widget .list li {
            margin-bottom: 15px;
        }

        .footer-bottom .footer-nav {
            gap: 5px;
        }

        .footer-bottom .footer-nav li {
            margin: 5px 10px;
        }
    }

    /* Tablet-specific improvements */
    @media (min-width: 768px) and (max-width: 991px) {
        .footer-column {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .logo-widget .text p {
            margin-bottom: 20px;
        }
    }

    /* Prevent footer content from going over navbar */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    .main-footer,
    .footer-bottom {
        position: relative;
        z-index: 10;
    }

    /* Ensure all footer elements respect stacking context */
    .main-footer *,
    .footer-bottom * {
        position: relative;
        z-index: inherit;
    }
</style>
