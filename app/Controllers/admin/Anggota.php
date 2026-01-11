<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Anggota extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Tampil Daftar Anggota
    public function index()
    {
        $data = [
            'title'   => 'Data Anggota',
            'anggota' => $this->userModel->where('role', 'anggota')->findAll()
        ];
        return view('admin/anggota/index', $data);
    }

    // Form Tambah Anggota
    public function create()
    {
        return view('admin/anggota/create', ['title' => 'Tambah Anggota']);
    }

    // Simpan Data ke Database
    public function save()
    {
        $this->userModel->save([
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password'), // Sesuai permintaan: Plain Text
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nik'          => $this->request->getPost('nik'),
            'alamat'       => $this->request->getPost('alamat'),
            'no_telp'      => $this->request->getPost('no_telp'),
            'role'         => 'anggota',
            'status_aktif' => 1
        ]);

        return redirect()->to('/anggota')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    // Hapus Data
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/anggota')->with('success', 'Data berhasil dihapus.');
    }
}