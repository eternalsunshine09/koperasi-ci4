<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PinjamanModel;
use App\Models\UserModel;
use App\Models\AngsuranModel; // Pastikan Model ini ada

class Pinjaman extends BaseController
{
    protected $pinjamanModel;
    protected $userModel;
    protected $angsuranModel;

    public function __construct()
    {
        $this->pinjamanModel = new PinjamanModel();
        $this->userModel = new UserModel();
        $this->angsuranModel = new AngsuranModel();
    }

    // 1. Tampilkan Daftar Pinjaman (Halaman Utama)
    public function index()
    {
        // Join tabel pinjaman dengan users agar nama peminjam muncul
        $data = [
            'title'    => 'Data Pinjaman',
            'pinjaman' => $this->pinjamanModel
                ->select('pinjaman.*, users.nama_lengkap')
                ->join('users', 'users.id_user = pinjaman.id_user')
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];
        return view('admin/pinjaman/index', $data);
    }

    // 2. Tampilkan Form Pengajuan
    public function create()
    {
        // Ambil data anggota yang aktif saja untuk dropdown
        $data = [
            'title'   => 'Buat Pengajuan Pinjaman',
            'anggota' => $this->userModel->where('role', 'anggota')
                                         ->where('status_aktif', 1)
                                         ->findAll()
        ];
        
        return view('admin/pinjaman/create', $data);
    }

    // 3. Proses Simpan Pengajuan
    public function save()
    {
        // Validasi input
        if (!$this->validate([
            'id_user' => 'required',
            'jumlah'  => 'required|numeric',
            'bunga'   => 'required|numeric',
            'tenor'   => 'required|integer'
        ])) {
            return redirect()->back()->with('error', 'Pastikan semua data diisi dengan benar.');
        }

        $this->pinjamanModel->save([
            'id_user'           => $this->request->getPost('id_user'),
            'jumlah_pinjaman'   => $this->request->getPost('jumlah'),
            'bunga_persen'      => $this->request->getPost('bunga'),
            'tenor_bulan'       => $this->request->getPost('tenor'),
            'keterangan'        => $this->request->getPost('keterangan'),
            'tanggal_pengajuan' => date('Y-m-d'), // Tanggal hari ini
            'status'            => 'pending'      // Default status menunggu
        ]);

        return redirect()->to(base_url('pinjaman'))->with('success', 'Pengajuan pinjaman berhasil dibuat!');
    }

    // 4. Halaman Detail Pinjaman & Riwayat Angsuran
    public function detail($id)
    {
        // Ambil data pinjaman spesifik + nama user
        $pinjaman = $this->pinjamanModel
            ->select('pinjaman.*, users.nama_lengkap, users.nik, users.no_telp')
            ->join('users', 'users.id_user = pinjaman.id_user')
            ->find($id);

        if (!$pinjaman) {
            return redirect()->to('/pinjaman')->with('error', 'Data tidak ditemukan.');
        }

        // Ambil riwayat angsuran dari tabel angsuran
        $angsuran = $this->angsuranModel->where('id_pinjaman', $id)->findAll();

        $data = [
            'title'    => 'Detail Pinjaman',
            'pinjaman' => $pinjaman,
            'angsuran' => $angsuran
        ];

        return view('admin/pinjaman/detail', $data);
    }

    // 5. Proses Bayar Angsuran
    public function bayarAngsuran()
    {
        $id_pinjaman = $this->request->getPost('id_pinjaman');
        
        // Hitung ini angsuran ke berapa (total angsuran sebelumnya + 1)
        $jumlah_angsuran_skrg = $this->angsuranModel->where('id_pinjaman', $id_pinjaman)->countAllResults();
        $angsuran_ke = $jumlah_angsuran_skrg + 1;

        $this->angsuranModel->save([
            'id_pinjaman'   => $id_pinjaman,
            'id_user'       => $this->request->getPost('id_user'),
            'angsuran_ke'   => $angsuran_ke,
            'jumlah_bayar'  => $this->request->getPost('jumlah_bayar'),
            'tanggal_bayar' => date('Y-m-d H:i:s'),
            'denda'         => 0 // Default denda 0
        ]);

        // Cek apakah sudah lunas? (Opsional: logic pelunasan otomatis bisa ditambah disini)

        return redirect()->to(base_url('pinjaman/detail/' . $id_pinjaman))->with('success', 'Angsuran berhasil dibayar.');
    }

    // 6. Approve Pinjaman (Pending -> Disetujui)
    public function approve($id)
    {
        $this->pinjamanModel->update($id, ['status' => 'disetujui']);
        return redirect()->to(base_url('pinjaman/detail/' . $id))->with('success', 'Pinjaman berhasil disetujui!');
    }
}