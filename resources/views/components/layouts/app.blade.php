<!DOCTYPE html>
<html lang="{{ session()->get('locale') ?? app()->getLocale() }}" class="layout-compact layout-menu-fixed"
    dir="ltr" data-skin="default" data-assets-path="{{ asset('/assets') . '/' }}"
    data-base-url="{{ url('/') }}" data-framework="laravel" data-template="horizontal-menu-template"
    data-bs-theme="light">

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
            <!-- BEGIN: Navbar-->
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center" id="layout-navbar">
                <div class="container-xxl">
                    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <span class="text-primary">
                                    <svg width="38" height="20" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z" fill="currentColor"></path>
                                        <path d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z" fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4"></path>
                                        <path d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z" fill="currentColor"></path>
                                        <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="currentColor"></path>
                                        <path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4"></path>
                                        <path d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z" fill="currentColor"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-opacity="1"></stop>
                                                <stop offset="1" stop-opacity="0"></stop>
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-opacity="1"></stop>
                                                <stop offset="1" stop-opacity="0"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </span>
                            </span>
                            <span class="app-brand-text demo menu-text fw-semibold ms-1">Materizlize</span>
                        </a>
                        <!-- Display menu close icon only for horizontal-menu with navbar-full -->
                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                            <i class="icon-base ri ri-close-line icon-sm"></i>
                        </a>
                    </div>
                    <div
                        class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base ri ri-menu-line icon-md"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item navbar-search-wrapper mb-0">
                                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                                    <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>
                                </a>
                            </div>
                        </div>
                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">

                            <!-- Language -->
                            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="icon-base ri ri-translate-2 icon-22px"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ url('lang/en') }}"
                                            data-language="en" data-text-direction="ltr">
                                            <span>English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}" href="{{ url('lang/fr') }}"
                                            data-language="fr" data-text-direction="ltr">
                                            <span>French</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}" href="{{ url('lang/ar') }}"
                                            data-language="ar" data-text-direction="rtl">
                                            <span>Arabic</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() === 'de' ? 'active' : '' }}" href="{{ url('lang/de') }}"
                                            data-language="de" data-text-direction="ltr">
                                            <span>German</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ Language --><!-- Quick links  -->
                            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-sm-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="icon-base ri ri-star-smile-line icon-22px"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-0">
                                    <div class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h6 class="mb-0 me-auto">Shortcuts</h6>
                                            <a href="javascript:void(0)"
                                                class="btn btn-text-secondary rounded-pill btn-icon dropdown-shortcuts-add text-heading"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"> <i
                                                    class="icon-base ri ri-add-line text-heading"></i> </a>
                                        </div>
                                    </div>
                                    <div class="dropdown-shortcuts-list scrollable-container">
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                    <i class="icon-base ri ri-calendar-line icon-26px text-heading"></i>
                                                </span>
                                                <a href="{{ url('app/calendar') }}" class="stretched-link">Calendar</a>
                                                <small>Appointments</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                    <i class="icon-base ri ri-file-text-line icon-26px text-heading"></i>
                                                </span>
                                                <a href="{{ url('app/invoice/list') }}" class="stretched-link">Invoice App</a>
                                                <small>Manage Accounts</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                    <i class="icon-base ri ri-user-line icon-26px text-heading"></i>
                                                </span>
                                                <a href="{{ url('app/user/list') }}" class="stretched-link">User App</a>
                                                <small>Manage Users</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                    <i class="icon-base ri ri-computer-line icon-26px text-heading"></i>
                                                </span>
                                                <a href="{{ url('app/access-roles') }}" class="stretched-link">Role Management</a>
                                                <small>Permission</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                    <i class="icon-base ri ri-pie-chart-2-line icon-26px text-heading"></i>
                                                </span>
                                                <a href="{{ url('/') }}" class="stretched-link">Dashboard</a>
                                                <small>User Dashboard</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                    <i class="icon-base ri ri-settings-4-line icon-26px text-heading"></i>
                                                </span>
                                                <a href="{{ url('pages/account-settings-account') }}" class="stretched-link">Setting</a>
                                                <small>Account Settings</small>
                                            </div>
                                        </div>
                                        <div class="row row-bordered overflow-visible g-0">
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                    <i class="icon-base ri ri-question-line icon-26px text-heading"></i>
                                                </span>
                                                <a href="{{ url('pages/faq') }}" class="stretched-link">FAQs</a>
                                                <small>FAQs & Articles</small>
                                            </div>
                                            <div class="dropdown-shortcuts-item col">
                                                <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                                    <i class="icon-base ri ri-tv-2-line icon-26px text-heading"></i>
                                                </span>
                                                <a href="{{ url('modal-examples') }}" class="stretched-link">Modals</a>
                                                <small>Useful Popups</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- Quick links -->

                            <!-- Notification -->
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-4 me-xl-1">
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
                            </li>
                            <!--/ Notification -->
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/avatars/1.png') }}"
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
                                                        <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/avatars/1.png') }}"
                                                            alt="alt" class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 small">
                                                        @if (Auth::check())
                                                            {{ Auth::user()->name }}
                                                        @else
                                                            John Doe
                                                        @endif
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
                                        <a class="dropdown-item"
                                            href="{{ Route::has('profile.show') ? route('profile.show') : url('pages/profile-user') }}">
                                            <i class="icon-base ri ri-user-3-line icon-22px me-2"></i> <span class="align-middle">My
                                                Profile</span> </a>
                                    </li>
                                    @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <li>
                                            <a class="dropdown-item" href="{{ route('api-tokens.index') }}"> <i
                                                    class="icon-base ri ri-settings-4-line icon-22px me-3"></i><span class="align-middle">Settings</span>
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{ url('pages/account-settings-billing') }}">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 icon-base ri ri-file-text-line icon-22px me-3"></i>
                                                <span class="flex-grow-1 align-middle">Billing Plan</span>
                                                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                        <li>
                                            <div class="dropdown-divider"></div>
                                        </li>
                                        <li>
                                            <h6 class="dropdown-header">Manage Team</h6>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider my-1"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
                                                <i class="icon-base ri ri-settings-3-line icon-md me-3"></i><span>Team Settings</span>
                                            </a>
                                        </li>
                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <li>
                                                <a class="dropdown-item" href="{{ route('teams.create') }}">
                                                    <i class="icon-base ri ri-group-line icon-md me-3"></i><span>Create New Team</span>
                                                </a>
                                            </li>
                                        @endcan
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <li>
                                                <div class="dropdown-divider my-1"></div>
                                            </li>
                                            <li>
                                                <h6 class="dropdown-header">Switch Teams</h6>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider my-1"></div>
                                            </li>
                                        @endif
                                        @if (Auth::user())
                                            @foreach (Auth::user()->allTeams() as $team)
                                                {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}

                                                {{-- <x-switchable-team :team="$team" /> --}}
                                            @endforeach
                                        @endif
                                    @endif
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
                                                    href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
                                                    <small class="align-middle">Login</small>
                                                    <i class="icon-base ri ri-logout-box-r-line ms-2 icon-16px"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- END: Navbar-->
            <!-- Layout page -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Horizontal Menu -->
                    <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu flex-grow-0" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <div class="container-xxl d-flex h-100">
                            <a href="#" class="menu-horizontal-prev d-none"></a>
                            <div class="menu-horizontal-wrapper">
                                <ul class="menu-inner" style="margin-left: 0px;">
                                    <li class="menu-item active">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-home-smile-line"></i>
                                            <div>Dashboards</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item active">
                                                <a href="http://127.0.0.1:8003" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-bar-chart-line"></i>
                                                    <div>Analytics</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/dashboard/crm" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-computer-line"></i>
                                                    <div>CRM</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/app/ecommerce/dashboard" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-shopping-cart-2-line"></i>
                                                    <div>eCommerce</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/app/logistics/dashboard" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-truck-line"></i>
                                                    <div>Logistics</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/app/academy/dashboard" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-book-open-line"></i>
                                                    <div>Academy</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-layout-2-line"></i>
                                            <div>Layouts</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/layouts/without-menu" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-layout-4-line"></i>
                                                    <div>Without menu</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/layouts/vertical" class="menu-link" target="_blank">
                                                    <i class="menu-icon icon-base ri ri-layout-left-line"></i>
                                                    <div>Vertical</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/layouts/fluid" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-layout-top-line"></i>
                                                    <div>Fluid</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/layouts/container" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-layout-top-2-line"></i>
                                                    <div>Container</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/layouts/blank" class="menu-link" target="_blank">
                                                    <i class="menu-icon icon-base ri ri-square-line"></i>
                                                    <div>Blank</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-mail-open-line"></i>
                                            <div>Apps</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/app/email" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-mail-line"></i>
                                                    <div>Email</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/app/chat" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-message-line"></i>
                                                    <div>Chat</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/app/calendar" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-calendar-line"></i>
                                                    <div>Calendar</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/app/kanban" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-drag-drop-line"></i>
                                                    <div>Kanban</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-shopping-cart-2-line"></i>
                                                    <div>eCommerce</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/ecommerce/dashboard" class="menu-link">
                                                            <div>Dashboard</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Products</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/product/list" class="menu-link">
                                                                    <div>Product List</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/product/add" class="menu-link">
                                                                    <div>Add Product</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/product/category" class="menu-link">
                                                                    <div>Category List</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Order</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/order/list" class="menu-link">
                                                                    <div>Order List</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/order/details" class="menu-link">
                                                                    <div>Order Details</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Customer</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/customer/all" class="menu-link">
                                                                    <div>All Customers</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                                    <div>Customer Details</div>
                                                                </a>
                                                                <ul class="menu-sub">
                                                                    <li class="menu-item">
                                                                        <a href="http://127.0.0.1:8003/app/ecommerce/customer/details/overview" class="menu-link">
                                                                            <div>Overview</div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="menu-item">
                                                                        <a href="http://127.0.0.1:8003/app/ecommerce/customer/details/security" class="menu-link">
                                                                            <div>Security</div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="menu-item">
                                                                        <a href="http://127.0.0.1:8003/app/ecommerce/customer/details/billing" class="menu-link">
                                                                            <div>Address &amp; Billing</div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="menu-item">
                                                                        <a href="http://127.0.0.1:8003/app/ecommerce/customer/details/notifications" class="menu-link">
                                                                            <div>Notifications</div>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/ecommerce/manage/reviews" class="menu-link">
                                                            <div>Manage Reviews</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/ecommerce/referrals" class="menu-link">
                                                            <div>Referrals</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Settings</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/settings/details" class="menu-link">
                                                                    <div>Store Details</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/settings/payments" class="menu-link">
                                                                    <div>Payments</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/settings/checkout" class="menu-link">
                                                                    <div>Checkout</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/settings/shipping" class="menu-link">
                                                                    <div>Shipping &amp; Delivery</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/settings/locations" class="menu-link">
                                                                    <div>Locations</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/ecommerce/settings/notifications" class="menu-link">
                                                                    <div>Notifications</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-book-open-line"></i>
                                                    <div>Academy</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/academy/dashboard" class="menu-link">
                                                            <div>Dashboard</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/academy/course" class="menu-link">
                                                            <div>My Course</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/academy/course-details" class="menu-link">
                                                            <div>Course Details</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-truck-line"></i>
                                                    <div>Logistics</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/logistics/dashboard" class="menu-link">
                                                            <div>Dashboard</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/logistics/fleet" class="menu-link">
                                                            <div>Fleet</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-article-line"></i>
                                                    <div>Invoice</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/invoice/list" class="menu-link">
                                                            <div>List</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/invoice/preview" class="menu-link">
                                                            <div>Preview</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/invoice/edit" class="menu-link">
                                                            <div>Edit</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/invoice/add" class="menu-link">
                                                            <div>Add</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-user-line"></i>
                                                    <div>Users</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/user/list" class="menu-link">
                                                            <div>List</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>View</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/user/view/account" class="menu-link">
                                                                    <div>Account</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/user/view/security" class="menu-link">
                                                                    <div>Security</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/user/view/billing" class="menu-link">
                                                                    <div>Billing &amp; Plans</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/user/view/notifications" class="menu-link">
                                                                    <div>Notifications</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/app/user/view/connections" class="menu-link">
                                                                    <div>Connections</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-shield-user-line"></i>
                                                    <div>Roles &amp; Permissions</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/access-roles" class="menu-link">
                                                            <div>Roles</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/app/access-permission" class="menu-link">
                                                            <div>Permission</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-database-2-line"></i>
                                                    <div>Laravel Example</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/laravel/user-management" class="menu-link">
                                                            <div>User Management</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-article-line"></i>
                                            <div>Pages</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-checkbox-multiple-blank-line"></i>
                                                    <div>Front Pages</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/front-pages/landing" class="menu-link" target="_blank">
                                                            <div>Landing</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/front-pages/pricing" class="menu-link" target="_blank">
                                                            <div>Pricing</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/front-pages/payment" class="menu-link" target="_blank">
                                                            <div>Payment</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/front-pages/checkout" class="menu-link" target="_blank">
                                                            <div>Checkout</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/front-pages/help-center" class="menu-link" target="_blank">
                                                            <div>Help Center</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-account-circle-line"></i>
                                                    <div>User Profile</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/profile-user" class="menu-link">
                                                            <div>Profile</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/profile-teams" class="menu-link">
                                                            <div>Teams</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/profile-projects" class="menu-link">
                                                            <div>Projects</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/profile-connections" class="menu-link">
                                                            <div>Connections</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-settings-2-line"></i>
                                                    <div>Account Settings</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/account-settings-account" class="menu-link">
                                                            <div>Account</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/account-settings-security" class="menu-link">
                                                            <div>Security</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/account-settings-billing" class="menu-link">
                                                            <div>Billing &amp; Plans</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/account-settings-notifications" class="menu-link">
                                                            <div>Notifications</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/account-settings-connections" class="menu-link">
                                                            <div>Connections</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/pages/faq" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-question-line"></i>
                                                    <div>FAQ</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/pages/pricing" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-money-dollar-circle-line"></i>
                                                    <div>Pricing</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-file-line"></i>
                                                    <div>Misc</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/misc-error" class="menu-link" target="_blank">
                                                            <div>Error</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/misc-under-maintenance" class="menu-link" target="_blank">
                                                            <div>Under Maintenance</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/misc-comingsoon" class="menu-link" target="_blank">
                                                            <div>Coming Soon</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/misc-not-authorized" class="menu-link" target="_blank">
                                                            <div>Not Authorized</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/pages/misc-server-error" class="menu-link" target="_blank">
                                                            <div>Server Error</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-lock-line"></i>
                                                    <div>Authentications</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Login</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/login-basic" class="menu-link" target="_blank">
                                                                    <div>Basic</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/login-cover" class="menu-link" target="_blank">
                                                                    <div>Cover</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Register</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/register-basic" class="menu-link" target="_blank">
                                                                    <div>Basic</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/register-cover" class="menu-link" target="_blank">
                                                                    <div>Cover</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/register-multisteps" class="menu-link" target="_blank">
                                                                    <div>Multi-steps</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Verify Email</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/verify-email-basic" class="menu-link" target="_blank">
                                                                    <div>Basic</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/verify-email-cover" class="menu-link" target="_blank">
                                                                    <div>Cover</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Reset Password</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/reset-password-basic" class="menu-link" target="_blank">
                                                                    <div>Basic</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/reset-password-cover" class="menu-link" target="_blank">
                                                                    <div>Cover</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Forgot Password</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/forgot-password-basic" class="menu-link" target="_blank">
                                                                    <div>Basic</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/forgot-password-cover" class="menu-link" target="_blank">
                                                                    <div>Cover</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Two Steps</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/two-steps-basic" class="menu-link" target="_blank">
                                                                    <div>Basic</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/auth/two-steps-cover" class="menu-link" target="_blank">
                                                                    <div>Cover</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-git-commit-line"></i>
                                                    <div>Wizard Examples</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/wizard/ex-checkout" class="menu-link">
                                                            <div>Checkout</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/wizard/ex-property-listing" class="menu-link">
                                                            <div>Property Listing</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/wizard/ex-create-deal" class="menu-link">
                                                            <div>Create Deal</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/modal-examples" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                                    <div>Modal Examples</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-archive-line"></i>
                                            <div>Components</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                                                    <div>Cards</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/cards/basic" class="menu-link">
                                                            <div>Basic</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/cards/advance" class="menu-link">
                                                            <div>Advance</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/cards/statistics" class="menu-link">
                                                            <div>Statistics</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/cards/analytics" class="menu-link">
                                                            <div>Analytics</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/cards/gamifications" class="menu-link">
                                                            <div>Gamifications</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/cards/actions" class="menu-link">
                                                            <div>Actions</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-pantone-line"></i>
                                                    <div>User interface</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/accordion" class="menu-link">
                                                            <div>Accordion</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/alerts" class="menu-link">
                                                            <div>Alerts</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/badges" class="menu-link">
                                                            <div>Badges</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/buttons" class="menu-link">
                                                            <div>Buttons</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/carousel" class="menu-link">
                                                            <div>Carousel</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/collapse" class="menu-link">
                                                            <div>Collapse</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/dropdowns" class="menu-link">
                                                            <div>Dropdowns</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/footer" class="menu-link">
                                                            <div>Footer</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/list-groups" class="menu-link">
                                                            <div>List Groups</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/modals" class="menu-link">
                                                            <div>Modals</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/navbar" class="menu-link">
                                                            <div>Navbar</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/offcanvas" class="menu-link">
                                                            <div>Offcanvas</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/pagination-breadcrumbs" class="menu-link">
                                                            <div>Pagination &amp; Breadcrumbs</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/progress" class="menu-link">
                                                            <div>Progress</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/spinners" class="menu-link">
                                                            <div>Spinners</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/tabs-pills" class="menu-link">
                                                            <div>Tabs &amp; Pills</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/toasts" class="menu-link">
                                                            <div>Toasts</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/tooltips-popovers" class="menu-link">
                                                            <div>Tooltips &amp; Popovers</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/ui/typography" class="menu-link">
                                                            <div>Typography</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-box-3-line"></i>
                                                    <div>Extended UI</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-avatar" class="menu-link">
                                                            <div>Avatar</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-blockui" class="menu-link">
                                                            <div>BlockUI</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-drag-and-drop" class="menu-link">
                                                            <div>Drag &amp; Drop</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-media-player" class="menu-link">
                                                            <div>Media Player</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-perfect-scrollbar" class="menu-link">
                                                            <div>Perfect scrollbar</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-star-ratings" class="menu-link">
                                                            <div>Star Ratings</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-sweetalert2" class="menu-link">
                                                            <div>SweetAlert2</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-text-divider" class="menu-link">
                                                            <div>Text Divider</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                            <div>Timeline</div>
                                                        </a>
                                                        <ul class="menu-sub">
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/extended/ui-timeline-basic" class="menu-link">
                                                                    <div>Basic</div>
                                                                </a>
                                                            </li>
                                                            <li class="menu-item">
                                                                <a href="http://127.0.0.1:8003/extended/ui-timeline-fullscreen" class="menu-link">
                                                                    <div>Fullscreen</div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-tour" class="menu-link">
                                                            <div>Tour</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-treeview" class="menu-link">
                                                            <div>Treeview</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/extended/ui-misc" class="menu-link">
                                                            <div>Miscellaneous</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/icons/icons-ri" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-remixicon-line"></i>
                                                    <div>Icons</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-pages-line"></i>
                                            <div>Forms</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-file-copy-line"></i>
                                                    <div>Form Elements</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/basic-inputs" class="menu-link">
                                                            <div>Basic Inputs</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/input-groups" class="menu-link">
                                                            <div>Input groups</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/custom-options" class="menu-link">
                                                            <div>Custom Options</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/editors" class="menu-link">
                                                            <div>Editors</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/file-upload" class="menu-link">
                                                            <div>File Upload</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/pickers" class="menu-link">
                                                            <div>Pickers</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/selects" class="menu-link">
                                                            <div>Select &amp; Tags</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/sliders" class="menu-link">
                                                            <div>Sliders</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/switches" class="menu-link">
                                                            <div>Switches</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/forms/extras" class="menu-link">
                                                            <div>Extras</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-box-3-line"></i>
                                                    <div>Form Layouts</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/form/layouts-vertical" class="menu-link">
                                                            <div>Vertical Form</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/form/layouts-horizontal" class="menu-link">
                                                            <div>Horizontal Form</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/form/layouts-sticky" class="menu-link">
                                                            <div>Sticky Actions</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-git-commit-line"></i>
                                                    <div>Form Wizard</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/form/wizard-numbered" class="menu-link">
                                                            <div>Numbered</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/form/wizard-icons" class="menu-link">
                                                            <div>Icons</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/form/validation" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-checkbox-circle-line"></i>
                                                    <div>Form Validation</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-table-line"></i>
                                            <div>Tables</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/tables/basic" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-layout-grid-line"></i>
                                                    <div>Tables</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-grid-line"></i>
                                                    <div>Datatables</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/tables/datatables-basic" class="menu-link">
                                                            <div>Basic</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/tables/datatables-advanced" class="menu-link">
                                                            <div>Advanced</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/tables/datatables-extensions" class="menu-link">
                                                            <div>Extensions</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-computer-line"></i>
                                            <div>Charts</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <i class="menu-icon icon-base ri ri-bar-chart-2-line"></i>
                                                    <div>Charts</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/charts/apex" class="menu-link">
                                                            <div>Apex Charts</div>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a href="http://127.0.0.1:8003/charts/chartjs" class="menu-link">
                                                            <div>ChartJS</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="http://127.0.0.1:8003/maps/leaflet" class="menu-link">
                                                    <i class="menu-icon icon-base ri ri-map-2-line"></i>
                                                    <div>Leaflet Maps</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <i class="menu-icon icon-base ri ri-drag-drop-line"></i>
                                            <div>Multi Level</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                                    <div>Level 2</div>
                                                </a>
                                                <ul class="menu-sub">
                                                    <li class="menu-item">
                                                        <a href="javascript:void(0)" class="menu-link">
                                                            <div>Level 3</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div><a href="#" class="menu-horizontal-next d-none"></a>
                        </div>
                    </aside>
                    <!--/ Horizontal Menu -->
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{ $slot }}
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
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
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- / Layout Container -->
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    {{-- BEGIN: Vendor JS --}}
    @vite(['resources/assets/vendor/libs/jquery/jquery.js', 'resources/assets/vendor/libs/popper/popper.js', 'resources/assets/vendor/js/bootstrap.js', 'resources/assets/vendor/libs/node-waves/node-waves.js', 'resources/assets/vendor/libs/@algolia/autocomplete-js.js'])
    @vite(['resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', 'resources/assets/vendor/libs/hammer/hammer.js', 'resources/assets/vendor/js/menu.js'])
    {{ $vendorScript ?? '' }}
    {{-- END: Page Vendor JS --}}
    {{-- BEGIN: Theme JS --}}
    @vite(['resources/assets/js/main.js'])
    {{-- END: Theme JS --}}
    {{-- Pricing Modal JS --}}
    @stack('pricing-script')
    {{-- END: Pricing Modal JS --}}
    {{-- BEGIN: Page JS --}}
    {{ $pageScript ?? '' }}
    {{-- END: Page JS --}}
    {{-- app JS --}}
    @vite(['resources/js/app.js'])
    {{-- END: app JS --}}
</body>

</html>
