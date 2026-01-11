<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SimpananModel;
use App\Models\PinjamanModel;

class Laporan extends BaseController
{
    public function index()
    {
        $simpananModel = new SimpananModel();
        $pinjamanModel = new PinjamanModel();

        // 1. Ambil Data Simpanan (Join User)
        // Urutkan dari yang terbaru
        $dataSimpanan = $simpananModel
            ->select('simpanan.*, users.nama_lengkap, users.nik')
            ->join('users', 'users.id_user = simpanan.id_user')
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();

        // 2. Ambil Data Pinjaman (Join User)
        $dataPinjaman = $pinjamanModel
            ->select('pinjaman.*, users.nama_lengkap, users.nik')
            ->join('users', 'users.id_user = pinjaman.id_user')
            ->orderBy('tanggal_pengajuan', 'DESC')
            ->findAll();

        $data = [
            'title'    => 'Laporan Keuangan',
            'simpanan' => $dataSimpanan,
            'pinjaman' => $dataPinjaman
        ];

        return view('admin/laporan/index', $data);
    }
}