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

    {{ $slot }}

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
