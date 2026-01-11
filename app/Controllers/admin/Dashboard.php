<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // 1. Cek Login
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth'))->with('error', 'Silahkan login.');
        }

        $db = \Config\Database::connect();

        // --- LOGIKA HITUNGAN ---

        // A. Hitung Pinjaman Berjalan (Sisa Hutang)
        // 1. Ambil total nominal pinjaman yang statusnya masih 'disetujui' (belum lunas)
        $modal_dipinjam = $db->table('pinjaman')
                             ->where('status', 'disetujui')
                             ->selectSum('jumlah_pinjaman')
                             ->get()->getRow()->jumlah_pinjaman ?? 0;

        // 2. Ambil total angsuran yang SUDAH dibayar untuk pinjaman yang 'disetujui' tadi
        // Kita perlu JOIN ke tabel pinjaman untuk filter statusnya
        $sudah_dibayar = $db->table('angsuran')
                            ->join('pinjaman', 'pinjaman.id_pinjaman = angsuran.id_pinjaman')
                            ->where('pinjaman.status', 'disetujui')
                            ->selectSum('angsuran.jumlah_bayar')
                            ->get()->getRow()->jumlah_bayar ?? 0;

        // 3. Sisa hutang = Modal dipinjam - Sudah dibayar
        $pinjaman_berjalan = $modal_dipinjam - $sudah_dibayar;


        // --- MENYIAPKAN DATA UNTUK VIEW ---
        $data = [
            'title' => 'Dashboard Koperasi',
            
            // 1. Total Anggota (Dari tabel users)
            'total_anggota' => $db->table('users')
                                  ->where('role', 'anggota')
                                  ->where('status_aktif', 1)
                                  ->countAllResults(),

            // 2. Total Simpanan (Dari tabel simpanan)
            'total_simpanan' => $db->table('simpanan')
                                   ->selectSum('jumlah')
                                   ->get()->getRow()->jumlah ?? 0,

            // 3. Total Pinjaman Cair (Semua uang yang pernah keluar: status disetujui & lunas)
            'total_pinjaman' => $db->table('pinjaman')
                                   ->whereIn('status', ['disetujui', 'lunas'])
                                   ->selectSum('jumlah_pinjaman')
                                   ->get()->getRow()->jumlah_pinjaman ?? 0,
            
            // 4. Pinjaman Berjalan (Hasil hitungan di atas)
            'pinjaman_berjalan' => $pinjaman_berjalan
        ];

        // Pastikan nama view ini sesuai dengan file HTML dashboard kamu
        return view('dashboard/index', $data);
    }
}