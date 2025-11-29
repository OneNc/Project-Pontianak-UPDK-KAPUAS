<x-layouts.guest>
    <x-slot:title>
        LOGIN PAGE
    </x-slot>
    <x-slot:vendorStyle>
        @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
    </x-slot>

    <x-slot:pageStyle>
        @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
    </x-slot>

    <x-slot:pageScript>
        @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
    </x-slot>
    <x-slot:vendorScript>
        @vite(['resources/assets/js/pages-auth.js'])
    </x-slot>
    <div class="authentication-wrapper authentication-cover">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="auth-cover-brand d-flex align-items-center gap-2">
            <span class="app-brand-logo demo">
                <span class="text-primary">
                    <img
                        src="{{ asset('assets/img/branding/logo.png') }}"
                        alt="Logo"
                        class="w-px-40 h-auto" />
                </span>
            </span>
            <span class="app-brand-text demo text-heading fw-semibold">Teras Itech Solusindo</span>
        </a>
        {{-- /Logo --}}
        <div class="authentication-inner row m-0">
            {{-- /Left Section --}}
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-0">
                <img
                    src="{{ asset('assets/img/backgrounds/background.png') }}"
                    class="w-100 h-100 object-fit-cover"
                    alt="auth-illustration"
                    data-app-light-img="backgrounds/background.png"
                    data-app-dark-img="backgrounds/background.png" />
            </div>
            {{-- /Left Section --}}

            {{-- Login --}}
            <div
                class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-12 px-12 py-6">
                <div class="w-px-400 mx-auto pt-12 pt-lg-0">
                    <h4 class="mb-1">Welcome to Teras AMR! 👋</h4>
                    <p class="mb-5">Please sign-in to your account</p>
                    @error('login')
                        <div class="alert alert-solid-danger d-flex align-items-center flex-wrap row-gap-2" role="alert">
                            <span class="alert-icon rounded">
                                <i class="icon-base ri ri-error-warning-line icon-md"></i>
                            </span>
                            {{ $message }}
                        </div>
                    @enderror
                    <form id="formAuthentication" class="mb-5" action="{{ route('login.store') }}" method="POST">
                        @csrf
                        <div class="form-floating form-floating-outline mb-5 form-control-validation">
                            <input type="text" class="form-control" id="email" name="login"
                                placeholder="Enter your email or username" autofocus />
                            <label for="email">Email or Username</label>
                        </div>
                        <div class="mb-5">
                            <div class="form-password-toggle form-control-validation">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base ri ri-eye-off-line icon-20px"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 d-flex justify-content-between mt-5">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Sign in</button>
                    </form>
                </div>
            </div>
            {{-- /Login --}}
        </div>
    </div>
    {{-- / Card layout --}}
    </x-layouts.app>
