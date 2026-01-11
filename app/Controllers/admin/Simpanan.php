<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SimpananModel;
use App\Models\UserModel;

class Simpanan extends BaseController
{
    protected $simpananModel;
    protected $userModel;

    public function __construct()
    {
        // Inisialisasi Model agar bisa dipakai di semua fungsi
        $this->simpananModel = new SimpananModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Simpanan',
            // Join ke tabel users untuk ambil nama & NIK
            'simpanan' => $this->simpananModel->select('simpanan.*, users.nama_lengkap, users.nik')
                                              ->join('users', 'users.id_user = simpanan.id_user')
                                              ->orderBy('tanggal_transaksi', 'DESC')
                                              ->findAll()
        ];
        
        return view('admin/simpanan/index', $data);
    }

    // 1. Tampilkan Form Input (Create)
    public function create()
    {
        $data = [
            'title'   => 'Input Setoran Simpanan',
            // Ambil hanya anggota aktif untuk dropdown
            'anggota' => $this->userModel->where('role', 'anggota')
                                         ->where('status_aktif', 1)
                                         ->findAll()
        ];

        return view('admin/simpanan/create', $data);
    }

    // 2. Proses Simpan Data (Store)
    // PENTING: Nama fungsi ini harus 'store' karena di form action-nya 'simpanan/store'
    public function store()
    {
        // Validasi Input
        if (!$this->validate([
            'id_user'        => 'required',
            'jenis_simpanan' => 'required',
            'jumlah'         => 'required|numeric|greater_than[0]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Pastikan semua data diisi dengan benar.');
        }

        // Simpan ke Database
        $this->simpananModel->save([
            'id_user'           => $this->request->getPost('id_user'),
            'jenis_simpanan'    => $this->request->getPost('jenis_simpanan'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'keterangan'        => $this->request->getPost('keterangan'),
            'tanggal_transaksi' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('simpanan'))->with('success', 'Transaksi simpanan berhasil dicatat.');
    }

    // 3. Tampilkan Form Edit
    public function edit($id)
    {
        // Ambil data simpanan berdasarkan ID
        $dataSimpanan = $this->simpananModel->find($id);

        if (!$dataSimpanan) {
            return redirect()->to(base_url('simpanan'))->with('error', 'Data tidak ditemukan.');
        }

        // Ambil data user terkait untuk ditampilkan namanya
        $user = $this->userModel->find($dataSimpanan['id_user']);

        $data = [
            'title'        => 'Edit Simpanan',
            'simpanan'     => $dataSimpanan,
            'nama_anggota' => $user['nama_lengkap'] ?? 'Anggota Tidak Ditemukan'
        ];

        return view('admin/simpanan/edit', $data);
    }

    // 4. Proses Update Data
    public function update($id)
    {
        // Validasi
        if (!$this->validate([
            'jumlah'         => 'required|numeric',
            'jenis_simpanan' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid.');
        }

        $this->simpananModel->update($id, [
            'jenis_simpanan' => $this->request->getPost('jenis_simpanan'),
            'jumlah'         => $this->request->getPost('jumlah'),
            'keterangan'     => $this->request->getPost('keterangan'),
            // id_user & tanggal biasanya tidak diubah saat edit
        ]);

        return redirect()->to(base_url('simpanan'))->with('success', 'Data simpanan berhasil diperbarui.');
    }
    
    // 5. Hapus Data
    public function delete($id)
    {
        $this->simpananModel->delete($id);
        return redirect()->to(base_url('simpanan'))->with('success', 'Data berhasil dihapus.');
    }
}