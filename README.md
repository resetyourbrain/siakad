# 📚 SIAKAD – Sistem Informasi Akademik

## 🚀 Setup Project (Instalasi Lokal)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

### 1. Clone Repository

```bash
git clone https://github.com/username/siakad.git
cd siakad

2. Salin File Environment

cp .env.example .env

3. Sesuaikan Konfigurasi Database

Edit file .env dan sesuaikan dengan pengaturan database lokal Anda:

DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

4. Generate Application Key

php artisan key:generate

5. Install Dependency

composer install

6. Jalankan Migrasi dan Seeder

php artisan migrate:fresh --seed

🔐 Akun Login Dummy
Akun Dosen

    Username: dosen1

    Password: dosen1

Akun Mahasiswa

    Username: mahasiswa1

    Password: mahasiswa1

🛠 Teknologi yang Digunakan

    Laravel

    Bootstrap

    MySQL/MariaDB

    Blade (Laravel View Engine)