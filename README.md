# 📚 SIAKAD – Sistem Informasi Akademik

## 🚀 Setup Project (Instalasi Lokal)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

### 1. Clone Repository

```bash
git clone https://github.com/username/siakad.git
cd siakad
```

### 2. Salin File Environment

```bash
cp .env.example .env
```

### 3. Buat Database dan Sesuaikan Konfigurasi

```bash
Edit file .env dan sesuaikan dengan pengaturan database lokal Anda:

DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Install Dependency

```bash
composer install
```

### 6. Jalankan Migrasi dan Seeder

```bash
php artisan migrate:fresh --seed
```

### 🔐 Akun Login Dummy

#### Akun Dosen
######   Username: dosen1
######   Password: dosen1

#### Akun Mahasiswa
######   Username: mahasiswa1
######   Password: mahasiswa1

### 🛠 Teknologi yang Digunakan
######   Laravel 10
######   PHP 8.1
######   Bootstrap
######   MySQL/MariaDB
######   Blade (Laravel View Engine)


Fitur dan dashboard untuk user 'Admin' belum tersedia. Oleh karena itu, pengelolaan data Dosen, Mahasiswa, dan Mata Kuliah untuk sementara dilakukan melalui seeder.