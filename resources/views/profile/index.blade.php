<x-layouts.app>
    <x-slot:title>
        Profile
    </x-slot>
    {{-- <x-slot:vendorStyle></x-slot> --}}
    <x-slot:vendorScript>
        @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
    </x-slot>
    <x-slot:pageStyle>
        <style>
            .avatar-square {
                aspect-ratio: 1 / 1;
                object-fit: cover;
                object-position: center;
            }
        </style>
    </x-slot>
    <x-slot:pageScript>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const inputFile = document.getElementById('upload');
                const previewImg = document.getElementById('uploadedAvatar');
                const formProfile = document.getElementById('formAccountSettings');

                if (inputFile && previewImg) {
                    inputFile.addEventListener('change', function(e) {
                        const file = this.files[0];
                        if (!file) return;

                        // optional: validasi tipe file
                        if (!file.type.startsWith('image/')) {
                            this.value = '';
                            alert('File harus berupa gambar (jpg / jpeg / png).');
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImg.src = e.target.result; // tampilkan preview
                        };
                        reader.readAsDataURL(file);
                    });
                }

                // kalau tombol reset di form diklik, kembalikan ke foto awal
                if (formProfile && previewImg) {
                    formProfile.addEventListener('reset', function() {
                        const defaultSrc = previewImg.getAttribute('data-default-src');
                        if (defaultSrc) {
                            // delay sedikit supaya reset selesai dulu
                            setTimeout(() => {
                                previewImg.src = defaultSrc;
                            }, 0);
                        }
                    });
                }
            });
        </script>
    </x-slot>
    <div class="row g-6">
        <div class="col-md-6 mb-5">
            <div class="card">
                <h5 class="card-header">My Profile</h5>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-solid-success d-flex align-items-center flex-wrap row-gap-2" role="alert">
                            <span class="alert-icon rounded">
                                <i class="icon-base ri ri-checkbox-circle-line icon-md"></i>
                            </span>
                            {{ session('success') }}
                        </div>
                    @endif
                    <form id="formAccountSettings"
                        method="POST"
                        action="{{ route('profile.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-2 p-0 px-2">
                                <img src="{{ $user->image_profile != 'default.png' ? asset('storage/' . $user->image_profile) : asset('assets/img/avatars/1.png') }}"
                                    alt="user-avatar"
                                    class="d-block w-100 rounded-4 mb-3 avatar-square"
                                    id="uploadedAvatar" />

                                <label for="upload" class="btn btn-primary w-100" tabindex="0">
                                    <i class="icon-base ri ri-upload-2-line"></i>
                                    <input type="file"
                                        id="upload"
                                        class="account-file-input"
                                        name="image_profile"
                                        hidden
                                        accept="image/png, image/jpeg" />
                                </label>

                                @error('image_profile')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-10">
                                <div class="mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="fieldName" name="name"
                                            value="{{ old('name', $user->name) }}" autofocus />
                                        <label for="fieldName">Name</label>
                                        <div class="invalid-feedback d-block">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control text-lowercase" type="text" name="username" id="fieldUsername"
                                            value="{{ old('username', $user->username) }}" />
                                        <label for="fieldUsername">Username</label>
                                        <div class="invalid-feedback d-block">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control text-lowercase" type="text" id="fieldEmail" name="email"
                                            value="{{ old('email', $user->email) }}"
                                            placeholder="{{ $user->email }}" />
                                        <label for="fieldEmail">E-mail</label>
                                        <div class="invalid-feedback d-block">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 text-end">
                                    <button type="submit" class="btn btn-primary me-3">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
            <div class="card  h-100">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 form-password-toggle form-control-validation">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="password" name="currentPassword" id="currentPassword"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <label for="currentPassword">Current Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer">
                                    <i class="icon-base ri ri-eye-off-line icon-20px"></i>
                                </span>
                            </div>
                            <div class="invalid-feedback d-block">
                                @error('currentPassword')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggle form-control-validation">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="password" id="newPassword" name="newPassword"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <label for="newPassword">New Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer">
                                    <i class="icon-base ri ri-eye-off-line icon-20px"></i>
                                </span>
                            </div>
                            <div class="invalid-feedback d-block">
                                @error('newPassword')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggle form-control-validation">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <label for="confirmPassword">Confirm New Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer">
                                    <i class="icon-base ri ri-eye-off-line icon-20px"></i>
                                </span>
                            </div>
                            <div class="invalid-feedback d-block">
                                @error('confirmPassword')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 text-end">
                            <button type="submit" class="btn btn-primary me-3">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row g-6">
        <div class="col-12">
            <div class="card">
                <h6 class="card-header">Recent Devices</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-truncate">Browser</th>
                                <th class="text-truncate">Device</th>
                                <th class="text-truncate">Location</th>
                                <th class="text-truncate">Recent Activities</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-truncate text-heading"><i
                                        class="icon-base ri ri-macbook-line icon-20px text-warning me-3"></i>Chrome on Windows</td>
                                <td class="text-truncate">HP Spectre 360</td>
                                <td class="text-truncate">Switzerland</td>
                                <td class="text-truncate">10, July 2021 20:07</td>
                            </tr>
                            <tr>
                                <td class="text-truncate text-heading"><i
                                        class="icon-base ri ri-android-line icon-20px text-success me-3"></i>Chrome on iPhone</td>
                                <td class="text-truncate">iPhone 12x</td>
                                <td class="text-truncate">Australia</td>
                                <td class="text-truncate">13, July 2021 10:10</td>
                            </tr>
                            <tr>
                                <td class="text-truncate text-heading"><i
                                        class="icon-base ri ri-smartphone-line icon-20px text-danger me-3"></i>Chrome on Android</td>
                                <td class="text-truncate">Oneplus 9 Pro</td>
                                <td class="text-truncate">Dubai</td>
                                <td class="text-truncate">14, July 2021 15:15</td>
                            </tr>
                            <tr>
                                <td class="text-truncate text-heading"><i
                                        class="icon-base ri ri-mac-line icon-20px text-info me-3"></i>Chrome on MacOS</td>
                                <td class="text-truncate">Apple iMac</td>
                                <td class="text-truncate">India</td>
                                <td class="text-truncate">16, July 2021 16:17</td>
                            </tr>
                            <tr>
                                <td class="text-truncate text-heading"><i
                                        class="icon-base ri ri-macbook-line icon-20px text-warning me-3"></i>Chrome on Windows</td>
                                <td class="text-truncate">HP Spectre 360</td>
                                <td class="text-truncate">Switzerland</td>
                                <td class="text-truncate">20, July 2021 21:01</td>
                            </tr>
                            <tr class="border-transparent">
                                <td class="text-truncate text-heading"><i
                                        class="icon-base ri ri-android-line icon-20px text-success me-3"></i>Chrome on Android</td>
                                <td class="text-truncate">Oneplus 9 Pro</td>
                                <td class="text-truncate">Dubai</td>
                                <td class="text-truncate">21, July 2021 12:22</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
