# Laravel 12 Starter Project

Repository ini adalah project berbasis **Laravel 12** dengan manajemen package menggunakan **Composer** (PHP) dan **Yarn** (JavaScript).

Silakan sesuaikan nama project, deskripsi, dan contoh perintah di bawah ini dengan kebutuhanmu.

---

## 🚀 Fitur Utama

- Framework backend: **Laravel 12**
- Manajemen dependency PHP: **Composer**
- Manajemen dependency frontend: **Yarn**
- Struktur siap pakai untuk pengembangan aplikasi web modern

---

## 🧩 Tech Stack

- **PHP** (Laravel 12)
- **Composer**
- **Node.js** & **Yarn**
- **MySQL / PostgreSQL / database lain** (sesuaikan)
- **Vite** / Laravel Mix (sesuaikan dengan project-mu)

---

## ✅ Prasyarat

Pastikan sudah terpasang di mesin kamu:

- **PHP** (minimal versi yang didukung Laravel 12, contoh: `>= 8.2`)
- **Composer**
- **Node.js** dan **Yarn**
- **Git**
- Database server (MySQL/PostgreSQL/dll)
- Ekstensi PHP umum:
  - `openssl`
  - `pdo`
  - `mbstring`
  - `tokenizer`
  - `xml`
  - `ctype`
  - `json`
  - `bcmath` (jika dibutuhkan)

Cek versi dengan:

```bash
php -v
composer -V
node -v
yarn -v
```

## 📦 Instalasi Dependency

### 1. Dependency PHP (Composer)

Pastikan kamu berada di root folder project, lalu jalankan:

```bash
composer install
```

Perintah ini akan meng-install semua package PHP yang didefinisikan di file `composer.json`.

### 2. Dependency Frontend (Yarn)

Masih di root folder project, jalankan:

```bash
yarn install
```

Perintah ini akan meng-install semua package JavaScript yang didefinisikan di file `package.json`.

---

## ⚙️ Konfigurasi Environment

1. Duplikasi file `.env.example` menjadi `.env`:

   ```bash
   cp .env.example .env
   ```

2. Atur konfigurasi database dan lainnya di file `.env`:

   ```env
   APP_NAME="Nama Project"
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Generate application key Laravel:

   ```bash
   php artisan key:generate
   ```

---

## 🗄️ Migrasi Database & Seeder (opsional)

Jika project menggunakan migration dan seeder:

```bash
# Hanya migration
php artisan migrate

# Migration + seeder
php artisan migrate --seed
```

---

## ▶️ Menjalankan Aplikasi

### 1. Jalankan server PHP (Laravel)

```bash
php artisan serve
```

Biasanya akan berjalan di:

```text
http://127.0.0.1:8000
```

### 2. Jalankan frontend (Vite / asset bundler) dengan Yarn

Jika menggunakan Vite:

```bash
yarn dev
```

Untuk build production:

```bash
yarn build
```

---

## 🧪 Testing (opsional)

Jika project sudah ada test:

```bash
php artisan test
# atau
phpunit
```

---

## 🛠️ Jika Composer / Yarn Tidak Ada atau Tidak Bisa Digunakan

Bagian ini membantu jika kamu mendapatkan error seperti:

- `composer: command not found`
- `yarn: command not found`
- atau perintah tidak berjalan sebagaimana mestinya.

### 1. Composer Tidak Terinstall / Error

#### a. Cek apakah Composer terinstall

```bash
composer -V
```

Jika muncul error `command not found`, berarti Composer belum terinstall atau tidak ada di `PATH`.

#### b. Install Composer (secara umum)

**Windows**

- Download installer dari situs resmi Composer (Composer-Setup.exe).
- Jalankan installer, pilih lokasi PHP, ikuti wizard sampai selesai.
- Setelah selesai, buka terminal baru (Command Prompt / PowerShell) dan coba:

  ```bash
  composer -V
  ```

**macOS / Linux (via CLI)**

- Pastikan `php` sudah terinstall.
- Jalankan:

  ```bash
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
  ```

- Pindahkan file `composer.phar` agar bisa diakses global:

  ```bash
  sudo mv composer.phar /usr/local/bin/composer
  ```

- Cek:

  ```bash
  composer -V
  ```

#### c. Composer ada tapi error

Beberapa solusi umum:

- Jalankan:

  ```bash
  composer clear-cache
  composer install
  ```

- Jika error permission, coba dengan:

  ```bash
  sudo composer install
  ```

  (Tidak selalu disarankan, lebih baik perbaiki permission folder project.)

- Pastikan versi PHP sesuai dengan requirement di `composer.json`.

---

### 2. Yarn Tidak Terinstall / Error

#### a. Cek apakah Yarn terinstall

```bash
yarn -v
```

Jika `command not found`, berarti Yarn belum terinstall.

#### b. Install Yarn lewat npm (umum, lintas OS)

Pastikan Node.js sudah terinstall dan `npm` tersedia:

```bash
node -v
npm -v
```

Install Yarn secara global:

```bash
npm install --global yarn
```

Setelah selesai, cek:

```bash
yarn -v
```

#### c. Menggunakan corepack (Node.js versi baru)

Pada Node.js versi terbaru, kamu bisa menggunakan:

```bash
corepack enable
corepack prepare yarn@stable --activate
```

#### d. Yarn error saat install

Beberapa solusi umum:

- Hapus folder `node_modules` dan file lock (`yarn.lock`):

  ```bash
  rm -rf node_modules
  rm yarn.lock
  yarn install
  ```

- Pastikan versi Node.js tidak terlalu lama atau terlalu baru untuk package di project (bisa coba upgrade/downgrade Node.js).
- Jika permission error, di Linux bisa saja butuh perbaikan permission folder project (hindari `sudo yarn` bila tidak perlu).

---

## 📦 Build & Optimasi untuk Production (opsional)

Beberapa perintah berguna saat deploy:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Untuk menghapus cache:

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📝 Catatan

- Pastikan versi **PHP**, **Composer**, **Node.js**, dan **Yarn** sesuai dan saling kompatibel.
- Di sistem Unix-like (Linux/macOS), cek permission folder `storage` dan `bootstrap/cache`:

  ```bash
  chmod -R 775 storage bootstrap/cache
  ```

- Sesuaikan semua contoh perintah dengan struktur dan kebutuhan project kamu.
