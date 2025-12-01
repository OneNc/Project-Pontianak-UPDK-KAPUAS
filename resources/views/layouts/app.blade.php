<!DOCTYPE html>
<html lang="{{ session()->get('locale') ?? app()->getLocale() }}" class="layout-compact layout-menu-fixed"
    dir="ltr" data-skin="default" data-assets-path="{{ asset('/assets') . '/' }}"
    data-base-url="{{ url('/') }}" data-framework="laravel" data-template="horizontal-menu-template"
    data-bs-theme="light" data-semidark-menu="true">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>
        {{ $title ?? config('app.name', 'Teras Itech Solusindo') }}
    </title>
    <meta name="description"
        content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords"
        content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}" />
    <meta property="og:title" content="{{ config('variables.ogTitle') ? config('variables.ogTitle') : '' }}" />
    <meta property="og:type" content="{{ config('variables.ogType') ? config('variables.ogType') : '' }}" />
    <meta property="og:url" content="{{ config('variables.productPage') ? config('variables.productPage') : '' }}" />
    <meta property="og:image" content="{{ config('variables.ogImage') ? config('variables.ogImage') : '' }}" />
    <meta property="og:description"
        content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta property="og:site_name"
        content="{{ config('variables.creatorName') ? config('variables.creatorName') : '' }}" />
    <meta name="robots" content="noindex, nofollow" />
    {{-- laravel CRUD token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- Canonical SEO --}}
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}" />
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    {{-- BEGIN: Theme CSS --}}
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />
    {{-- Fonts Icons --}}
    @vite(['resources/assets/vendor/fonts/iconify/iconify.css'])
    {{-- BEGIN: Vendor CSS --}}
    @vite(['resources/assets/vendor/libs/node-waves/node-waves.scss'])
    {{-- Core CSS --}}
    @vite(['resources/assets/vendor/scss/core.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss'])
    {{-- Vendor Styles --}}
    @vite(['resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss', 'resources/assets/vendor/libs/typeahead-js/typeahead.scss'])
    {{ $vendorStyle ?? '' }}
    {{-- Page Styles --}}
    {{ $pageStyle ?? '' }}
    @vite(['resources/css/app.css'])
    @vite(['resources/assets/vendor/js/helpers.js'])
    @vite(['resources/assets/js/config.js'])
</head>

<body>
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            {{-- BEGIN: Navbar --}}
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center" id="layout-navbar">
                <div class="container-xxl">
                    <div class="navbar-brand app-brand d-none d-xl-flex py-0 me-6">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2 d-none d-xl-block">
                            <span class="app-brand-logo ">
                                <span class="text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="40mm" height="18mm" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 10028 3500" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <style type="text/css">
                                                .fil4 {
                                                    fill: #FEFEFE
                                                }

                                                .fil0 {
                                                    fill: #004883
                                                }

                                                .fil1 {
                                                    fill: #44C2F4
                                                }

                                                .fil3 {
                                                    fill: #FEFEFE;
                                                    fill-rule: nonzero
                                                }

                                                .fil2 {
                                                    fill: #004883;
                                                    fill-rule: nonzero
                                                }
                                            </style>
                                        </defs>
                                        <g id="Layer_x0020_1">
                                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                            <polygon class="fil0" points="2333,1820 1820,1820 1820,2489 1462,2489 1462,2800 1820,2800 1820,3500 3468,3500 3468,1820 2955,1820 2955,2162 2333,2162 "></polygon>
                                            <polygon class="fil1" points="1649,2333 1649,1820 980,1820 980,1462 669,1462 669,1820 0,1820 0,3500 1649,3500 1649,2986 1306,2986 1306,2333 "></polygon>
                                            <polygon class="fil0" points="2006,980 2006,669 1649,669 1649,0 0,0 0,1649 513,1649 513,1306 1135,1306 1135,1649 1649,1649 1649,980 "></polygon>
                                            <polygon class="fil1" points="3468,1649 3468,0 1820,0 1820,513 2162,513 2162,1135 1820,1135 1820,1649 2489,1649 2489,2006 2800,2006 2800,1649 "></polygon>
                                            <path class="fil2" d="M3615 2650m297 0l0 -2022 -297 0 0 -480 1095 0 0 480 -297 0 0 2022 -501 0z"></path>
                                            <path class="fil2" d="M4849 2650m0 0l0 -2502 1002 0 0 483 -492 0 0 487 472 0 0 472 -472 0 0 571 524 0 0 489 -1034 0z"></path>
                                            <path class="fil2" d="M6048 2650m0 0l0 -2502 769 0c129,0 225,29 289,87 67,58 111,140 134,245 20,105 32,227 32,367 0,137 -18,247 -53,329 -35,82 -99,137 -195,169 79,15 134,55 166,117 32,61 47,142 47,241l0 947 -492 0 0 -982c0,-72 -15,-116 -44,-134 -32,-17 -79,-26 -146,-26l0 1142 -507 0zm510 -1576l120 0c69,0 104,-76 104,-227 0,-96 -5,-160 -23,-192 -14,-30 -44,-44 -84,-44l-117 0 0 463z"></path>
                                            <path class="fil2" d="M7370 2650m0 0l241 -2502 848 0 239 2502 -475 0 -35 -405 -303 0 -29 405 -486 0zm553 -804l227 0 -110 -1273 -24 0 -93 1273z"></path>
                                            <path class="fil2" d="M8801 2650m644 24c-227,0 -393,-59 -492,-172 -102,-114 -152,-295 -152,-542l0 -245 495 0 0 312c0,58 9,102 27,137 17,32 46,49 90,49 47,0 76,-14 96,-40 18,-27 26,-70 26,-132 0,-75 -8,-139 -23,-192 -15,-52 -44,-102 -79,-148 -38,-47 -90,-102 -157,-164l-224 -215c-169,-158 -251,-338 -251,-542 0,-213 50,-376 149,-490 99,-110 241,-166 428,-166 230,0 393,61 489,184 97,122 146,309 146,556l-510 0 0 -172c0,-35 -11,-61 -29,-78 -20,-21 -47,-29 -79,-29 -40,0 -69,11 -87,32 -20,23 -29,52 -29,87 0,35 9,73 29,114 18,40 55,87 111,140l291 279c55,53 111,111 157,172 50,61 88,134 117,216 29,78 44,178 44,294 0,236 -41,420 -128,554 -88,134 -239,201 -455,201z"></path>
                                            <polygon class="fil1" points="3614,3384 9990,3384 9990,2858 3614,2858 "></polygon>
                                            <path class="fil3" d="M4876 3311m49 0l-45 0 0 -271 45 0 0 271zm-49 -345c0,-10 3,-16 8,-21 5,-4 11,-6 19,-6 7,0 13,2 18,6 5,5 8,11 8,21 0,9 -3,16 -8,20 -5,5 -11,7 -18,7 -8,0 -14,-2 -19,-7 -5,-4 -8,-11 -8,-20zm101 345m170 0l-46 0 0 -325 -124 0 0 -37 295 0 0 37 -125 0 0 325z"></path>
                                            <path class="fil3" d="M5269 3311m141 5c-43,0 -77,-12 -103,-36 -25,-25 -38,-59 -38,-102 0,-45 12,-79 35,-105 24,-26 55,-39 95,-39 37,0 66,12 87,34 22,22 33,52 33,89l0 26 -204 0c2,32 10,55 27,72 16,17 40,25 70,25 32,0 63,-6 94,-18l0 36c-16,7 -31,11 -45,14 -14,3 -31,4 -51,4zm-12 -247c-24,0 -42,7 -57,21 -13,14 -22,34 -24,59l154 0c0,-26 -6,-46 -19,-59 -13,-14 -31,-21 -54,-21zm180 242m135 5c-43,0 -76,-12 -100,-36 -23,-24 -35,-59 -35,-103 0,-46 12,-81 36,-106 24,-24 57,-37 101,-37 15,0 29,2 43,5 14,3 25,6 33,10l-13 35c-10,-4 -21,-7 -33,-9 -11,-3 -21,-4 -31,-4 -59,0 -89,35 -89,106 0,33 7,58 22,76 14,18 36,27 65,27 24,0 49,-5 75,-15l0 37c-20,10 -45,14 -74,14zm144 -5m202 0l0 -176c0,-22 -5,-38 -16,-49 -11,-11 -28,-17 -52,-17 -31,0 -54,8 -68,24 -14,15 -21,41 -21,76l0 142 -45 0 0 -386 45 0 0 117c0,14 -1,26 -3,35l3 0c9,-13 22,-23 38,-31 16,-7 34,-11 55,-11 37,0 64,8 81,24 18,16 27,40 27,75l0 177 -44 0zm261 0m247 -96c0,32 -13,56 -37,74 -26,18 -60,27 -103,27 -46,0 -82,-5 -107,-17l0 -40c16,6 33,11 53,14 18,4 37,6 56,6 31,0 53,-6 69,-16 15,-10 23,-26 23,-44 0,-13 -3,-23 -8,-31 -6,-8 -15,-16 -27,-23 -14,-6 -33,-14 -59,-22 -37,-13 -63,-27 -79,-43 -16,-17 -23,-38 -23,-65 0,-28 11,-50 34,-67 23,-16 53,-24 90,-24 39,0 76,6 108,19l-14 37c-33,-13 -64,-19 -95,-19 -24,0 -43,5 -57,14 -13,10 -20,23 -20,40 0,13 3,23 8,31 5,9 13,16 25,22 12,7 30,14 55,23 41,13 70,27 85,43 15,16 23,36 23,61zm57 96m272 -136c0,44 -13,79 -37,104 -24,24 -58,37 -100,37 -27,0 -50,-5 -71,-17 -20,-11 -35,-28 -46,-49 -12,-22 -18,-47 -18,-75 0,-44 13,-79 37,-104 24,-24 57,-37 100,-37 41,0 74,13 98,39 24,24 37,59 37,102zm-225 0c0,35 7,61 22,79 16,18 38,28 67,28 29,0 51,-10 67,-28 15,-18 22,-44 22,-79 0,-34 -7,-61 -22,-79 -16,-17 -38,-27 -68,-27 -29,0 -51,9 -66,27 -15,18 -22,44 -22,79zm303 136m44 0l-44 0 0 -386 44 0 0 386zm92 0m45 -271l0 176c0,22 6,38 17,49 11,11 28,17 51,17 31,0 53,-8 68,-24 14,-15 21,-41 21,-76l0 -142 45 0 0 271 -37 0 -6 -36 -3 0c-9,13 -22,23 -38,30 -16,8 -35,11 -56,11 -36,0 -63,-8 -80,-23 -18,-16 -27,-41 -27,-76l0 -177 45 0zm278 271m208 -74c0,25 -9,45 -30,58 -21,14 -49,21 -86,21 -39,0 -70,-5 -92,-17l0 -38c15,6 30,11 46,16 17,3 32,5 47,5 23,0 41,-3 54,-10 12,-7 19,-17 19,-32 0,-10 -5,-19 -15,-27 -10,-7 -30,-16 -59,-26 -27,-10 -47,-18 -58,-25 -12,-7 -21,-15 -26,-24 -6,-9 -8,-19 -8,-32 0,-22 10,-40 29,-52 20,-13 46,-20 80,-20 32,0 63,7 93,18l-16 34c-29,-11 -56,-17 -80,-17 -21,0 -37,3 -48,9 -10,6 -16,15 -16,25 0,8 2,14 6,19 4,5 11,10 19,14 10,5 27,12 52,21 36,11 59,23 71,35 12,12 18,27 18,45zm69 74m49 0l-45 0 0 -271 45 0 0 271zm-49 -345c0,-10 3,-16 8,-21 5,-4 11,-6 19,-6 7,0 13,2 19,6 5,5 7,11 7,21 0,9 -2,16 -7,20 -6,5 -12,7 -19,7 -8,0 -14,-2 -19,-7 -5,-4 -8,-11 -8,-20zm144 345m201 0l0 -176c0,-22 -5,-38 -16,-49 -11,-11 -28,-17 -52,-17 -30,0 -53,8 -67,23 -15,16 -22,41 -22,76l0 143 -44 0 0 -271 36 0 7 37 2 0c10,-14 22,-24 39,-31 16,-8 35,-12 55,-12 36,0 62,8 80,24 18,16 27,41 27,76l0 177 -45 0zm120 0m217 -36l-2 0c-20,27 -51,41 -92,41 -39,0 -69,-12 -90,-36 -22,-25 -33,-59 -33,-104 0,-45 11,-80 33,-105 21,-24 51,-37 90,-37 40,0 70,14 92,41l3 0 -2 -20 -1 -19 0 -111 45 0 0 386 -37 0 -6 -36zm-89 7c31,0 53,-8 67,-23 14,-15 20,-40 20,-74l0 -9c0,-39 -7,-66 -21,-82 -13,-17 -36,-25 -66,-25 -26,0 -47,9 -60,28 -14,19 -21,45 -21,80 0,34 7,60 21,78 13,17 34,27 60,27zm210 29m271 -136c0,44 -12,79 -36,104 -24,24 -58,37 -100,37 -27,0 -50,-5 -71,-17 -20,-11 -36,-28 -47,-49 -11,-22 -17,-47 -17,-75 0,-44 12,-79 36,-104 24,-24 58,-37 100,-37 41,0 75,13 99,39 24,24 36,59 36,102zm-225 0c0,35 8,61 23,79 15,18 37,28 67,28 29,0 51,-10 66,-28 15,-18 23,-44 23,-79 0,-34 -8,-61 -23,-79 -15,-17 -37,-27 -67,-27 -29,0 -51,9 -66,27 -15,18 -23,44 -23,79z"></path>
                                            <path class="fil4" d="M8918 3103l968 0c7,0 13,5 13,12l0 11c0,7 -6,12 -13,12l-968 0c-7,0 -13,-5 -13,-12l0 -11c0,-7 6,-12 13,-12z"></path>
                                            <path class="fil4" d="M3762 3104l971 0c6,0 11,5 11,12l0 10c0,6 -5,11 -11,11l-971 0c-6,0 -11,-5 -11,-11l0 -10c0,-7 5,-12 11,-12z"></path>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="app-brand-text menu-text fw-semibold ms-1">{{ config('app.name', 'Teras Itech Solusindo') }}</span>
                        </a>
                        {{-- Display menu close icon only for horizontal-menu with navbar-full --}}
                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none p-2 bg-white">
                            <i class="icon-base ri ri-close-line icon-sm"></i>
                        </a>
                    </div>
                    <div
                        class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none w-100">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base ri ri-menu-line icon-md"></i> {{ config('app.name', 'Teras Itech Solusindo') }}
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                            {{-- Notification --}}
                            {{-- <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-4 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="icon-base ri ri-notification-2-line icon-22px"></i>
                                    <span class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end py-0">
                                    <li class="dropdown-menu-header border-bottom py-50">
                                        <div class="dropdown-header d-flex align-items-center py-2">
                                            <h6 class="mb-0 me-auto">Notification</h6>
                                            <div class="d-flex align-items-center h6 mb-0">
                                                <span class="badge rounded-pill bg-label-primary fs-xsmall me-2">8 New</span>
                                                <a href="javascript:void(0)" class="dropdown-notifications-all p-2" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Mark all as read"><i
                                                        class="icon-base ri ri-mail-open-line text-heading"></i> </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-notifications-list scrollable-container">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="avatar" class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">Congratulation Lettie 🎉</h6>
                                                        <small class="mb-1 d-block text-body">Won the monthly best seller gold
                                                            badge</small>
                                                        <small class="text-body-secondary">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">Charles Franklin</h6>
                                                        <small class="mb-1 d-block text-body">Accepted your connection</small>
                                                        <small class="text-body-secondary">12hr ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('assets/img/avatars/2.png') }}" alt="avatar" class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">New Message ✉️</h6>
                                                        <small class="mb-1 d-block text-body">You have new message from Natalie</small>
                                                        <small class="text-body-secondary">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="icon-base ri ri-shopping-cart-2-line icon-18px"></i> </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">Whoo! You have new order 🛒</h6>
                                                        <small class="mb-1 d-block text-body">ACME Inc. made new order $1,154</small>
                                                        <small class="text-body-secondary">1 day ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('assets/img/avatars/9.png') }}" alt="avatar" class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">Application has been approved 🚀</h6>
                                                        <small class="mb-1 d-block text-body">Your ABC project application has been
                                                            approved.</small>
                                                        <small class="text-body-secondary">2 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="icon-base ri ri-pie-chart-2-line icon-18px"></i> </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">Monthly report is generated</h6>
                                                        <small class="mb-1 d-block text-body">July monthly financial report is generated
                                                        </small>
                                                        <small class="text-body-secondary">3 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('assets/img/avatars/5.png') }}" alt="avatar" class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">Send connection request</h6>
                                                        <small class="mb-1 d-block text-body">Peter sent you connection request</small>
                                                        <small class="text-body-secondary">4 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('assets/img/avatars/6.png') }}" alt="avatar" class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">New message from Jane</h6>
                                                        <small class="mb-1 d-block text-body">Your have new message from Jane</small>
                                                        <small class="text-body-secondary">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span class="avatar-initial rounded-circle bg-label-warning"><i
                                                                    class="icon-base ri ri-error-warning-line icon-18px"></i> </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">CPU is running high</h6>
                                                        <small class="mb-1 d-block text-body">CPU Utilization Percent is currently at
                                                            88.63%,</small>
                                                        <small class="text-body-secondary">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                                                                class="icon-base ri ri-close-line"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="border-top">
                                        <div class="d-grid p-4">
                                            <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                                                <small class="align-middle">View all notifications</small>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li> --}}
                            {{-- Notification --}}
                            {{-- User --}}
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        {{-- <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/avatars/1.png') }}"
                                            alt="avatar" class="rounded-circle" /> --}}
                                        <img src="{{ asset('assets/img/avatars/1.png') }}"
                                            alt="avatar" class="rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ Route::has('profile.show') ? route('profile.show') : url('pages/profile-user') }}">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                            alt="alt" class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 small">
                                                        {{ Auth::user()->name }}
                                                    </h6>
                                                    <small class="text-body-secondary">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href=""> <i class="icon-base ri ri-settings-4-line icon-22px me-3"></i><span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    @if (Auth::check())
                                        <li>
                                            <div class="d-grid px-4 pt-2 pb-1">
                                                <a class="btn btn-danger d-flex" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <small class=" align-middle">Logout</small>
                                                    <i class="icon-base ri ri-logout-box-r-line ms-2 icon-16px"></i>
                                                </a>
                                            </div>
                                        </li>
                                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                            @csrf
                                        </form>
                                    @else
                                        <li>
                                            <div class="d-grid px-4 pt-2 pb-1">
                                                <a class="btn btn-danger d-flex"
                                                    href="{{ route('login') }}">
                                                    <small class="align-middle">Login</small>
                                                    <i class="icon-base ri ri-logout-box-r-line ms-2 icon-16px"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            {{-- User --}}
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- END: Navbar --}}
            {{-- Layout page --}}
            <div class="layout-page">
                {{-- Content wrapper --}}
                <div class="content-wrapper">
                    {{-- Horizontal Menu --}}
                    <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu flex-grow-0" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <div class="container-xxl d-flex h-100">
                            <a href="#" class="menu-horizontal-prev d-none"></a>
                            <div class="menu-horizontal-wrapper">
                                <ul class="menu-inner" style="margin-left: 0px;">
                                    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                        <a href="{{ route('dashboard') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-bar-chart-box-ai-fill"></i>
                                            <div>Dashboards</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('gateway') ? 'active' : '' }}">
                                        <a href="{{ route('gateway') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-radar-fill"></i>
                                            <div>Gateway</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('group', 'meter', 'group.*', 'meter.*') ? 'active open' : '' }}">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-dashboard-fill"></i>
                                            <div>Management</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item {{ request()->routeIs('group') ? 'active' : '' }}">
                                                <a href="{{ route('group') }}" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-git-fork-fill"></i>
                                                    <div>Management Group</div>
                                                </a>
                                            </li>
                                            <li class="menu-item {{ request()->routeIs('meter', 'meter.*') ? 'active' : '' }}">
                                                <a href="{{ route('meter') }}" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-hard-drive-2-line"></i>
                                                    <div>Management Meter</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item {{ request()->routeIs('report.*') ? 'active open' : '' }}">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-file-chart-line"></i>
                                            <div>Reports</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item {{ request()->routeIs('report.instantaneous') ? 'active' : '' }}">
                                                <a href="{{ route('report.instantaneous') }}" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-draft-fill"></i>
                                                    <div>Reports Instantaneous</div>
                                                </a>
                                            </li>
                                            <li class="menu-item {{ request()->routeIs('report.loadprofile') ? 'active' : '' }}">
                                                <a href="{{ route('report.loadprofile') }}" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-file-list-3-fill"></i>
                                                    <div>Reports Load Profile</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/layouts/vertical" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-calendar-check-fill"></i>
                                                    <div>Reports End of Billing</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div><a href="#" class="menu-horizontal-next d-none"></a>
                        </div>
                    </aside>
                    {{-- Horizontal Menu --}}
                    {{-- Content --}}
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{ $slot }}
                    </div>
                    {{-- Content --}}
                    {{-- Footer --}}
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0">
                                    &#169; {{ date('Y') }}&nbsp;&nbsp;<a href="https://teras-itech.com/"
                                        target="_blank"
                                        class="footer-link fw-medium">Teras Itech Solusindo</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://teras-itech.com/support" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    {{-- Footer --}}
                    <div class="content-backdrop fade"></div>
                </div>
                {{-- Content wrapper --}}
            </div>
            {{-- Layout page --}}
        </div>
        {{-- Layout Container --}}
        {{-- Overlay --}}
        <div class="layout-overlay layout-menu-toggle"></div>
        {{-- Drag Target Area To SlideIn Menu On Small Screens --}}
        <div class="drag-target"></div>
    </div>
    {{-- Layout wrapper --}}
    {{-- BEGIN: Vendor JS --}}
    @vite(['resources/assets/vendor/libs/jquery/jquery.js', 'resources/assets/vendor/libs/popper/popper.js', 'resources/assets/vendor/js/bootstrap.js', 'resources/assets/vendor/libs/node-waves/node-waves.js', 'resources/assets/vendor/libs/@algolia/autocomplete-js.js'])
    @vite(['resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', 'resources/assets/vendor/libs/hammer/hammer.js', 'resources/assets/vendor/js/menu.js'])
    {{ $vendorScript ?? '' }}
    {{-- END: Page Vendor JS --}}
    {{-- BEGIN: Theme JS --}}
    @vite(['resources/assets/js/main.js'])
    {{-- END: Theme JS --}}
    {{-- BEGIN: Page JS --}}
    {{ $pageScript ?? '' }}
    {{-- END: Page JS --}}
    {{-- app JS --}}
    @vite(['resources/js/app.js'])
    {{-- END: app JS --}}
</body>

</html>
