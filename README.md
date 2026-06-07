# HoaxChecker Indonesia

HoaxChecker Indonesia adalah platform berbasis web yang digunakan untuk membantu masyarakat dalam melakukan analisis berita, verifikasi informasi, dan meningkatkan literasi digital. Sistem ini dikembangkan menggunakan Laravel dengan penerapan RESTful API, authentication, authorization, component, dan repository pattern.

## Deskripsi Singkat

HoaxChecker Indonesia dirancang untuk membantu pengguna dalam mengecek berita yang dicurigai sebagai hoaks. Pengguna dapat memasukkan judul, isi berita, atau tautan berita, kemudian sistem akan memberikan hasil analisis berupa kemungkinan hoaks, skor validitas, indikasi clickbait, indikasi provokasi, serta rekomendasi edukasi literasi digital.

Selain fitur analisis berita, sistem ini juga menyediakan fitur edukasi literasi digital, riwayat pengecekan, laporan berita, dashboard user, dashboard admin, dan dashboard verifikator.

## Fitur Utama

- Registrasi dan login pengguna
- Authentication menggunakan token API
- Authorization berdasarkan role pengguna
- Role user, admin, dan verifikator
- Analisis berita hoaks
- Analisis berdasarkan judul, isi berita, dan link berita
- Riwayat pengecekan berita
- Laporan berita oleh pengguna
- Validasi laporan oleh verifikator
- Manajemen pengguna oleh admin
- Manajemen artikel edukasi literasi digital
- Dashboard statistik pengguna dan admin
- Dokumentasi API menggunakan Swagger
- Pengujian API menggunakan Postman

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Laravel Sanctum
- Swagger / OpenAPI
- Postman
- HTML
- CSS
- JavaScript


## Role Pengguna

### User
User dapat melakukan pengecekan berita, melihat hasil analisis, mengakses edukasi literasi digital, melihat riwayat pengecekan, dan mengirimkan laporan berita.

### Admin
Admin dapat mengelola data pengguna, mengelola artikel edukasi, melihat statistik sistem, dan menghapus data tertentu.

### Verifikator
Verifikator dapat melihat laporan berita dari pengguna dan memberikan status validasi terhadap laporan tersebut.

## Struktur Fitur API

### Authentication
- Register
- Login
- Logout
- Get user login
- Update profile
- Forgot password

### Analisis Hoaks
- Analisis berdasarkan judul berita
- Analisis berdasarkan isi berita
- Analisis berdasarkan link berita
- Integrasi analisis OpenAI
- Integrasi referensi berita NewsAPI

### Edukasi
- Menampilkan daftar edukasi
- Menampilkan detail edukasi
- Menambahkan artikel edukasi
- Mengubah artikel edukasi
- Menghapus artikel edukasi
- Menambahkan video edukasi YouTube

### Riwayat
- Menampilkan riwayat pengecekan
- Menampilkan detail riwayat
- Menghapus riwayat pengecekan

### Laporan
- Menampilkan laporan berita
- Mengirim laporan berita
- Menampilkan detail laporan
- Validasi laporan oleh verifikator

### Admin
- Menampilkan seluruh data user
- Menghapus user
- Melihat statistik sistem

## Instalasi Project

1. Clone repository

```bash
git clone https://github.com/username/hoaxchecker-indonesia.git
