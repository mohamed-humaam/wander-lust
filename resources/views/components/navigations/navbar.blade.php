@php use App\Models\Category; @endphp
    <!-- navbar.blade.php -->
<nav
    class="fixed w-full z-50 py-0 px-6 h-[80px] flex items-center bg-transparent transition-all duration-300 ease-in-out top-0 {{ request()->routeIs('scrolled') ? 'shadow-sm h-[70px] bg-blue-900' : '' }}">
    <div class="flex items-center justify-between w-full max-w-[1200px] mx-auto h-full">
        <!-- Logo -->
        <div class="z-60 flex items-center justify-center h-full">
            <div class="logo-widget footer-widget">
                <div class="flex items-center justify-center h-full">
                    <a href="{{ url('/') }}">  <!-- Add this line to wrap the logo -->
                        <div class="mt-4 font-bold text-2xl bg-gradient-to-r from-[#ff5e14] to-[#8b5cf6] bg-clip-text text-transparent flex items-center py-2">
                            <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="WanderLust" class="h-12">
                        </div>
                    </a>  <!-- Close the anchor tag -->
                </div>
            </div>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex md:items-center">
            <ul class="flex list-none mr-4">
                @php
                    $navItems = [
                        ['label' => 'Home', 'path' => '/', 'hasDropdown' => false],
                        ['label' => 'Stays', 'path' => '/stays', 'hasDropdown' => true],
                        ['label' => 'Special Holiday Packages', 'path' => '/packages', 'hasDropdown' => true],
                        ['label' => 'Contact', 'path' => '/contact-us', 'hasDropdown' => false]
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <li class="relative">
                        @if (!isset($item['hasDropdown']) || !$item['hasDropdown'])
                            <a href="{{ $item['path'] }}"
                               class="relative inline-block py-2 px-4 text-white no-underline font-medium text-base transition-all duration-300 ease-in-out hover:text-[#ff5e14] {{ request()->is(trim($item['path'], '/')) ? 'text-[#ff5e14]' : '' }}">
                                {{ $item['label'] }}
                                @if(request()->is(trim($item['path'], '/')))
                                    <span
                                        class="absolute bottom-[-4px] left-1/2 transform -translate-x-1/2 w-5 h-[3px] bg-[#ff5e14] rounded-md animate-indicator"></span>
                                @endif
                            </a>
                        @else
                            <div class="dropdown-container" onmouseleave="handleDropdownLeave()">
                                <a href="{{ $item['path'] }}"
                                   class="relative inline-flex items-center gap-1 py-2 px-4 text-white no-underline font-medium text-base transition-all duration-300 ease-in-out hover:text-[#ff5e14] {{ request()->is(trim($item['path'], '/')) ? 'text-[#ff5e14]' : '' }}">
                                    {{ $item['label'] }}
                                    @if(request()->is(trim($item['path'], '/')))
                                        <span
                                            class="absolute bottom-[-4px] left-1/2 transform -translate-x-1/2 w-5 h-[3px] bg-[#ff5e14] rounded-md animate-indicator"></span>
                                    @endif
                                    <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                                <div
                                    class="dropdown-menu absolute top-full left-0 bg-white/95 dark:bg-gray-800/95 backdrop-blur-md rounded-lg shadow-md min-w-[220px] opacity-0 invisible translate-y-[10px] transition-all duration-200 ease-in-out z-40">
                                    <div class="py-2">
                                        @php
                                            $parentCategories = Category::whereNull('parent_id')->get();
                                        @endphp

                                        @foreach($parentCategories as $category)
                                            <div class="dropdown-item-container relative">
                                                <a href="/packages/category/{{ $category->slug }}"
                                                   class="dropdown-item flex items-center justify-between py-[10px] px-4 text-gray-800 dark:text-gray-200 no-underline text-sm transition-all duration-300 ease-in-out hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-[#ff5e14]"
                                                   onmouseenter="handleParentHover('{{ $category->id }}')">
                                                    {{ $category->name }}

                                                    @if(Category::where('parent_id', $category->id)->exists())
                                                        <svg
                                                            class="dropdown-submenu-icon ml-2 transition-transform duration-200 ease-in-out"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="16"
                                                            height="16"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <polyline points="9 18 15 12 9 6"></polyline>
                                                        </svg>
                                                    @endif
                                                </a>

                                                @if(Category::where('parent_id', $category->id)->exists())
                                                    <div id="submenu-{{ $category->id }}"
                                                         class="dropdown-submenu absolute left-full top-0 min-w-[200px] bg-white/95 dark:bg-gray-800/95 backdrop-blur-md rounded-lg shadow-md py-2 opacity-0 invisible translate-x-[10px] transition-all duration-200 ease-in-out z-50">
                                                        @foreach(Category::where('parent_id', $category->id)->get() as $child)
                                                            <a href="/packages/category/{{ $child->slug }}"
                                                               class="dropdown-subitem block py-[10px] px-4 text-gray-800 dark:text-gray-200 no-underline text-sm transition-all duration-300 ease-in-out hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-[#ff5e14]">
                                                                {{ $child->name }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="md:hidden z-60">
            <button id="mobile-toggle"
                    class="flex flex-col justify-between w-[30px] h-[20px] bg-transparent border-none cursor-pointer p-0">
                <span class="block w-full h-[2px] bg-white transition-all duration-300 ease-in-out rounded"></span>
                <span class="block w-full h-[2px] bg-white transition-all duration-300 ease-in-out rounded"></span>
                <span class="block w-full h-[2px] bg-white transition-all duration-300 ease-in-out rounded"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu"
         class="fixed top-0 right-0 w-[300px] h-screen bg-white dark:bg-gray-800 z-40 shadow-md overflow-y-auto translate-x-full transition-transform duration-300 ease-in-out">
        <div class="flex flex-col justify-between px-8 pt-[100px] pb-8 h-full">
            <div class="flex flex-col">
                @foreach ($navItems as $index => $item)
                    @if (!isset($item['hasDropdown']) || !$item['hasDropdown'])
                        <a href="{{ $item['path'] }}"
                           class="relative text-xl text-gray-800 dark:text-gray-200 no-underline py-4 border-b border-gray-200 dark:border-gray-700 font-medium transition-all duration-300 ease-in-out hover:text-[#ff5e14] {{ request()->is(trim($item['path'], '/')) ? 'text-[#ff5e14]' : '' }}">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <div class="mobile-dropdown">
                            <div
                                class="flex items-center justify-between relative text-xl text-gray-800 dark:text-gray-200 py-4 border-b border-gray-200 dark:border-gray-700 font-medium transition-all duration-300 ease-in-out hover:text-[#ff5e14] cursor-pointer {{ request()->is(trim($item['path'], '/')) ? 'text-[#ff5e14]' : '' }}"
                                onclick="toggleMobileDropdown({{ $index }})">
                                {{ $item['label'] }}
                                <svg class="dropdown-icon transition-transform duration-300 ease-in-out"
                                     id="dropdown-icon-{{ $index }}"
                                     xmlns="http://www.w3.org/2000/svg"
                                     width="16"
                                     height="16"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </div>
                            <div id="mobile-dropdown-{{ $index }}"
                                 class="mobile-dropdown-content hidden max-h-0 overflow-hidden transition-all duration-300 ease-out">
                                @foreach($parentCategories as $category)
                                    <div class="parent-category-container">
                                        <a href="/packages/category/{{ $category->slug }}"
                                           class="mobile-dropdown-item text-gray-600 dark:text-gray-300 no-underline py-3 px-4 text-lg border-b border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:text-[#ff5e14] relative flex items-center before:content-[''] before:w-2 before:h-2 before:rounded-full before:bg-gray-200 before:mr-3 before:transition-all before:duration-300 before:ease-in-out hover:before:bg-[#ff5e14]">
                                            {{ $category->name }}
                                        </a>

                                        @if(Category::where('parent_id', $category->id)->exists())
                                            <div
                                                class="mobile-child-categories pl-0 ml-4 border-l-2 border-[#ff5e14] mb-2">
                                                @foreach(Category::where('parent_id', $category->id)->get() as $child)
                                                    <a href="/packages/category/{{ $child->slug }}"
                                                       class="mobile-dropdown-item child text-base py-[10px] px-4 text-gray-700 dark:text-gray-300 relative opacity-80 border-b-0 hover:opacity-100 hover:bg-[rgba(255,94,20,0.05)]">
                                                        {{ $child->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="mt-8">
                <div class="flex gap-4 mb-6">
                    <a href="#"
                       class="flex items-center justify-center w-[42px] h-[42px] rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition-all duration-300 ease-in-out hover:bg-[#ff5e14] hover:text-white"
                       aria-label="Twitter">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path
                                d="M22 4.01C21.0424 4.68544 19.9821 5.19755 18.86 5.53C18.2577 4.83755 17.4573 4.34523 16.567 4.12399C15.6767 3.90275 14.7395 3.96428 13.8821 4.29842C13.0247 4.63257 12.2884 5.22447 11.773 5.98979C11.2575 6.75511 10.9877 7.65376 11 8.57V9.57C9.24257 9.61323 7.50127 9.22543 5.93101 8.44863C4.36074 7.67182 3.01032 6.53114 2 5.13C2 5.13 -2 14.13 7 18.13C4.94053 19.5282 2.48716 20.2564 0 20.13C9 25.13 20 20.13 20 8.55C19.9991 8.27638 19.9723 8.00359 19.92 7.74C20.9406 6.73899 21.6608 5.45541 22 4.01Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#"
                       class="flex items-center justify-center w-[42px] h-[42px] rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition-all duration-300 ease-in-out hover:bg-[#ff5e14] hover:text-white"
                       aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path
                                d="M17 2H7C4.23858 2 2 4.23858 2 7V17C2 19.7614 4.23858 22 7 22H17C19.7614 22 22 19.7614 22 17V7C22 4.23858 19.7614 2 17 2Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                d="M16 11.37C16.1234 12.2022 15.9813 13.0522 15.5938 13.799C15.2063 14.5458 14.5931 15.1514 13.8416 15.5297C13.0901 15.9079 12.2384 16.0396 11.4078 15.9059C10.5771 15.7723 9.80976 15.3801 9.21484 14.7852C8.61992 14.1902 8.22773 13.4229 8.09407 12.5922C7.9604 11.7616 8.09207 10.9099 8.47033 10.1584C8.84859 9.40685 9.45419 8.79374 10.201 8.40624C10.9478 8.01874 11.7978 7.87658 12.63 8C13.4789 8.12588 14.2649 8.52146 14.8717 9.12831C15.4785 9.73515 15.8741 10.5211 16 11.37Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.5 6.5H17.51" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#"
                       class="flex items-center justify-center w-[42px] h-[42px] rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 transition-all duration-300 ease-in-out hover:bg-[#ff5e14] hover:text-white"
                       aria-label="YouTube">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path
                                d="M22.54 6.42C22.4212 5.94541 22.1793 5.51057 21.8387 5.15941C21.498 4.80824 21.0708 4.55318 20.6 4.42C18.88 4 12 4 12 4C12 4 5.12 4 3.4 4.46C2.92925 4.59318 2.50198 4.84824 2.16135 5.19941C1.82072 5.55057 1.57879 5.98541 1.46 6.46C1.14521 8.20556 0.991235 9.97631 1 11.75C0.988687 13.537 1.14266 15.3213 1.46 17.08C1.59096 17.5398 1.83831 17.9581 2.17814 18.2945C2.51798 18.6308 2.93882 18.8738 3.4 19C5.12 19.46 12 19.46 12 19.46C12 19.46 18.88 19.46 20.6 19C21.0708 18.8668 21.498 18.6118 21.8387 18.2606C22.1793 17.9094 22.4212 17.4746 22.54 17C22.8524 15.2676 22.9983 13.5103 23 11.75C23.0113 9.96295 22.8573 8.1787 22.54 6.42Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.75 15.02L15.5 11.75L9.75 8.47998V15.02Z" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dark Overlay -->
    <div id="mobile-overlay"
         class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-30 backdrop-blur-sm hidden"></div>
</nav>

<script>
    // JavaScript for the interactive elements
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobile-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-overlay');
        let isOpen = false;

        function toggleMobileMenu() {
            isOpen = !isOpen;

            if (isOpen) {
                mobileMenu.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                mobileToggle.classList.add('open');
                mobileToggle.querySelector('span:nth-child(1)').style.transform = 'translateY(9px) rotate(45deg)';
                mobileToggle.querySelector('span:nth-child(2)').style.opacity = '0';
                mobileToggle.querySelector('span:nth-child(3)').style.transform = 'translateY(-9px) rotate(-45deg)';
            } else {
                mobileMenu.classList.add('translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
                mobileToggle.classList.remove('open');
                mobileToggle.querySelector('span:nth-child(1)').style.transform = '';
                mobileToggle.querySelector('span:nth-child(2)').style.opacity = '';
                mobileToggle.querySelector('span:nth-child(3)').style.transform = '';
            }
        }

        mobileToggle.addEventListener('click', toggleMobileMenu);
        overlay.addEventListener('click', toggleMobileMenu);

        // Mobile dropdown toggle
        window.toggleMobileDropdown = function (index) {
            const dropdown = document.getElementById(`mobile-dropdown-${index}`);
            const icon = document.getElementById(`dropdown-icon-${index}`);

            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
                icon.style.color = '#ff5e14';
            } else {
                dropdown.style.maxHeight = '0px';
                setTimeout(() => {
                    dropdown.classList.add('hidden');
                }, 300);
                icon.style.transform = '';
                icon.style.color = '';
            }
        };

        // Handle parent hover for desktop dropdowns
        window.handleParentHover = function (categoryId) {
            const submenu = document.getElementById(`submenu-${categoryId}`);
            if (submenu) {
                // Hide all submenus first
                document.querySelectorAll('.dropdown-submenu').forEach(el => {
                    el.classList.remove('opacity-100', 'visible');
                    el.classList.add('opacity-0', 'invisible');
                    el.style.transform = 'translateX(10px)';
                });

                // Show the current submenu
                submenu.classList.remove('opacity-0', 'invisible');
                submenu.classList.add('opacity-100', 'visible');
                submenu.style.transform = 'translateX(0)';
            }
        };

        // Handle dropdown leave for desktop
        window.handleDropdownLeave = function () {
            document.querySelectorAll('.dropdown-submenu').forEach(el => {
                el.classList.remove('opacity-100', 'visible');
                el.classList.add('opacity-0', 'invisible');
                el.style.transform = 'translateX(10px)';
            });
        };

        // Handle scroll events to change navbar appearance
        function handleScroll() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                // When scrolled down, apply dark blue background
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('shadow-sm', 'h-[70px]', 'bg-blue-950');
            } else {
                // When at top, use transparent background
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('shadow-sm', 'h-[70px]', 'bg-blue-950');
            }
        }

        window.addEventListener('scroll', handleScroll);

        // Check if user prefers dark mode
        const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (prefersDarkMode) {
            document.documentElement.classList.add('dark');
        }

        // Handle keyboard escape to close mobile menu
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen) {
                toggleMobileMenu();
            }
        });
    });
</script>

<style>
    /* Custom animations not available in default Tailwind */
    @keyframes indicator-enter {
        0% {
            transform: translateX(-50%) scaleX(0);
            opacity: 0;
        }
        100% {
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }
    }

    .animate-indicator {
        animation: indicator-enter 0.4s cubic-bezier(0.25, 1, 0.5, 1);
    }

    /* Dropdown hover effects */
    .dropdown-container:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item:hover .dropdown-submenu-icon {
        transform: translateX(3px);
    }

    /* Mobile menu transition */
    #mobile-toggle.open span:nth-child(1) {
        transform: translateY(9px) rotate(45deg);
    }

    #mobile-toggle.open span:nth-child(2) {
        opacity: 0;
    }

    #mobile-toggle.open span:nth-child(3) {
        transform: translateY(-9px) rotate(-45deg);
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: rgb(31, 41, 55);
        }

        .dark\:bg-gray-700 {
            background-color: rgb(55, 65, 81);
        }

        .dark\:border-gray-700 {
            border-color: rgb(55, 65, 81);
        }

        .dark\:text-gray-200 {
            color: rgb(229, 231, 235);
        }

        .dark\:text-gray-300 {
            color: rgb(209, 213, 219);
        }

        .dark\:bg-gray-800\/95 {
            background-color: rgba(31, 41, 55, 0.95);
        }
    }

    /* Dropdown styling */
    .dropdown-menu, .dropdown-submenu {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
</style>
