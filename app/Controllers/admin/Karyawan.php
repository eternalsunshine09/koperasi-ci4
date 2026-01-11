<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Karyawan extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Data Karyawan',
            // Ambil hanya role admin dan petugas
            'karyawan' => $this->userModel->whereIn('role', ['admin', 'petugas'])->findAll()
        ];
        return view('admin/karyawan/index', $data);
    }

    public function create()
    {
        return view('admin/karyawan/create');
    }

    public function save()
    {
        $this->userModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'), // Default username (bisa diset otomatis atau input hidden)
            'password'     => '123456', // Password default sementara
            'nik'          => time(),   // NIK dummy jika di form tidak ada, atau tambahkan input NIK
            'role'         => $this->request->getPost('jabatan'), // Mapping Jabatan ke Role
            'email'        => $this->request->getPost('email'),
            'no_telp'      => $this->request->getPost('telepon'),
            'gaji'         => $this->request->getPost('gaji'),
            'status_aktif' => 1
        ]);

        return redirect()->to(base_url('karyawan'))->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to(base_url('karyawan'))->with('success', 'Data berhasil dihapus.');
    }
}