# INSTRUKSI CODING: REVISI HALAMAN MANAJEMEN MENU & INTEGRASI RBAC (CMS AHBABURROOL)

## KELOMPOK CONTEXT & RUANG LINGKUP

Sistem saat ini memiliki halaman bernama "Sistem / Manajemen Menu (SMC)" yang menampilkan tabel data menu bawaan (Urutan, Nama Menu, Link/Slug, Status, Tampil di Navbar, Aksi).
Saya ingin mengubah halaman ini agar berfungsi penuh sebagai **Halaman Manajemen Fitur & Hak Akses (Otorisasi)** berbasis RBAC (Role-Based Access Control) sekaligus menambahkan dependensi struktur barunya.

---

## TASK 1: REVISI TAMPILAN TABEL "MANAJEMEN MENU (SMC)"

Ubah komponen tata letak dan struktur kolom tabel pada file tampilan manajemen menu yang sudah ada dengan panduan berikut:

1. **Tambahkan Filter Peran (Role Dropdown) di Atas Tabel:**
   - Sediakan komponen `<select>` dropdown untuk memuat data Role (Kategori User).
   - Opsi default memuat list Role yang dinamis dari database (Contoh: Super Admin, Admin Konten, Penulis, Approver).
   - Ketika opsi dropdown berubah, isi checkbox di dalam tabel di bawahnya harus memetakan ulang hak akses milik role tersebut secara realtime/reactive.

2. **Revisi Struktur Header dan Kolom Tabel:**
   - Kolom **URUTAN** diubah menjadi **NAMA FITUR / MODUL** (Menampilkan list nama fitur yang ada, contoh: _Dashboard, Manajemen Artikel, Kategori Artikel, Slider Beranda_).
   - Kolom **LINK / SLUG** diubah menjadi kolom Checkbox: **BACA (Read)**.
   - Kolom **STATUS** diubah menjadi kolom Checkbox: **TAMBAH (Create)**.
   - Kolom **TAMPIL DI NAVBAR** diubah menjadi kolom Checkbox: **UBAH (Update)**.
   - Kolom **AKSI** diubah menjadi kolom Checkbox: **HAPUS (Delete)**.

3. **Tombol Aksi Utama:**
   - Ubah tombol utama "Tambah Menu" di pojok kanan atas menjadi tombol **"Simpan Hak Akses"** (untuk men-submit form/state array matriks checkbox yang dicentang ke database).
   - Tambahkan fitur checkbox "Check All" pada tiap header kolom hak akses (Read, Create, Update, Delete) untuk efisiensi centang massal.

---

## TASK 2: BUAT HALAMAN BARU "MASTER KATEGORI USER (ROLES)"

Buat sebuah halaman baru (View, Controller, dan Model/Migration terkait) untuk mengelola entitas Role.

- **Nama Menu/Sidebar:** "Master Kategori User" (Letakkan di bawah navigasi PENGATURAN).
- **Fungsi CRUD Dasar:** Memiliki fitur Tambah, Edit, dan Hapus tingkatan kategori user.
- **Kolom Tabel Data:** No, Nama Kategori User (Contoh: Super Admin, Admin Konten, Penulis), Deskripsi Singkat, Aksi.

---

## TASK 3: BUAT HALAMAN BARU "USER MANAGEMENT"

Buat sebuah halaman baru untuk mengelola akun operator riil yang masuk ke dalam CMS.

- **Nama Menu/Sidebar:** "User Management" atau "Manajemen Pengguna" (Letakkan di bawah navigasi PENGATURAN).
- **Fungsi Utama:** Mendaftarkan akun, menonaktifkan akun, reset password, dan melakukan assignment Role.
- **Struktur Kolom Tabel:**
  1. No / Urutan
  2. Nama Lengkap
  3. Username / Email (Kredensial Login)
  4. Kategori User (Dropdown berelasi langsung dengan data dari _Master Kategori User_)
  5. Status Akun (Toggle Aktif / Nonaktif)
  6. Aksi (Tombol Edit, Reset Password, Hapus)

---

## TASK 4: ARSITEKTUR RELASI DATABASE (MIGRATION SCHEMA)

Pastikan model atau query database yang dibangun menyokong relasi multi-to-multi berikut:

- **Tabel `users`:** Menyimpan data akun + foreign key `role_id`.
- **Tabel `roles`:** Menyimpan daftar kategori user (id, role_name).
- **Tabel `permissions` / `features`:** Menyimpan daftar fitur (id, feature_name/slug).
- **Tabel `role_permissions` (Pivot):** Menyimpan matriks hak akses hasil simpanan Task 1 dengan kolom `role_id`, `feature_id`, `can_read` (boolean), `can_create` (boolean), `can_update` (boolean), `can_delete` (boolean).

---

_Hasilkan kode program yang rapi, modular, aman (termasuk validasi request), serta gunakan framework CSS/Bootstrap yang selaras dengan tema UI CMS Ahbaburrool saat ini._
