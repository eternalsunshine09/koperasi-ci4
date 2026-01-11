<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. HALAMAN UTAMA & AUTH
// --------------------------------------------------------------------
$routes->get('/', 'Auth::index');                  // Halaman awal buka aplikasi
$routes->get('/auth', 'Auth::index');              // Halaman login
$routes->post('/auth/loginProcess', 'Auth::loginProcess'); // Proses cek login
$routes->get('/logout', 'Auth::logout');           // Proses logout

// Registrasi Routes (BARU)
$routes->get('register', 'Auth::register');             // Menampilkan form daftar
$routes->post('auth/registerProcess', 'Auth::registerProcess'); // Proses simpan user baru


// 2. DASHBOARD ADMIN
// --------------------------------------------------------------------
// Mengarah ke folder app/Controllers/Admin/Dashboard.php
$routes->get('dashboard', 'Admin\Dashboard::index');


// 3. MANAJEMEN ANGGOTA (CRUD LENGKAP)
// --------------------------------------------------------------------
$routes->get('anggota', 'Admin\Anggota::index');           // Tampilkan tabel
$routes->get('anggota/create', 'Admin\Anggota::create');   // Form tambah
$routes->post('anggota/save', 'Admin\Anggota::save');      // Proses simpan
$routes->get('anggota/delete/(:num)', 'Admin\Anggota::delete/$1'); // Hapus berdasarkan ID


// 4. MANAJEMEN KARYAWAN (Persiapan)
// --------------------------------------------------------------------
// Nanti kamu perlu buat Controller: app/Controllers/Admin/Karyawan.php
$routes->get('karyawan', 'Admin\Karyawan::index');
$routes->get('karyawan/create', 'Admin\Karyawan::create');
$routes->post('karyawan/save', 'Admin\Karyawan::save');
$routes->get('karyawan/delete/(:num)', 'Admin\Karyawan::delete/$1');


// 5. TRANSAKSI (Persiapan)
// --------------------------------------------------------------------
// Nanti kamu perlu buat Controller: app/Controllers/Admin/Transaksi.php
// Simpanan
$routes->group('simpanan', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('/', 'Simpanan::index');           // Ke halaman list
    $routes->get('create', 'Simpanan::create');     // Ke form input
    $routes->post('store', 'Simpanan::store');      // Proses simpan
    $routes->get('edit/(:num)', 'Simpanan::edit/$1'); // Ke form edit
    $routes->post('update/(:num)', 'Simpanan::update/$1'); // Proses update
    $routes->get('delete/(:num)', 'Simpanan::delete/$1'); // Proses hapus
});

// Pinjaman
$routes->get('pinjaman', 'Admin\Pinjaman::index');           // Halaman Index
$routes->get('pinjaman/create', 'Admin\Pinjaman::create');   // Form Buat Pengajuan
$routes->post('pinjaman/save', 'Admin\Pinjaman::save');      // Proses Simpan
$routes->get('pinjaman/approve/(:num)', 'Admin\Pinjaman::approve/$1');
$routes->get('pinjaman/detail/(:num)', 'Admin\Pinjaman::detail/$1'); // Detail & Bayar
$routes->post('pinjaman/bayarAngsuran', 'Admin\Pinjaman::bayarAngsuran'); // Proses Bayar


// Proses Bayar Angsuran
$routes->post('pinjaman/bayarAngsuran', 'Admin\Pinjaman::bayarAngsuran');


// 6. LAPORAN (Persiapan)
// --------------------------------------------------------------------
// Nanti kamu perlu buat Controller: app/Controllers/Admin/Laporan.php
$routes->get('laporan', 'Admin\Laporan::index');