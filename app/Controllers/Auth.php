<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // --- FITUR LOGIN (KODINGAN LAMA KAMU) ---
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        $user = $model->where('username', $username)->first();

        if ($user) {
            // Cek password (Plain Text sesuai permintaan)
            if ($password == $user['password']) {
                
                if ($user['status_aktif'] == 0) {
                    return redirect()->back()->with('error', 'Akun Anda dinonaktifkan.');
                }

                $sessionData = [
                    'id_user'      => $user['id_user'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'role'         => $user['role'],
                    'logged_in'    => TRUE
                ];
                $session->set($sessionData);

                return redirect()->to(base_url('dashboard'));
                
            } else {
                return redirect()->back()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth'));
    }

    // --- FITUR REGISTRASI (BARU DITAMBAHKAN) ---
    
    // 1. Menampilkan Form Daftar
    public function register()
    {
        return view('auth/register');
    }

    // 2. Proses Simpan User Baru
    public function registerProcess()
    {
        $model = new UserModel();

        // Cek validasi sederhana agar username/NIK tidak kembar
        if (!$this->validate([
            'username' => 'is_unique[users.username]',
            'nik'      => 'is_unique[users.nik]',
        ])) {
            return redirect()->back()->with('error', 'Username atau NIK sudah terdaftar!');
        }

        // Simpan data
        $model->save([
            'username'     => $this->request->getVar('username'),
            'password'     => $this->request->getVar('password'), // Simpan biasa (No Hash)
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'nik'          => $this->request->getVar('nik'),
            'no_telp'      => $this->request->getVar('no_telp'),
            'role'         => 'anggota', // Default role = anggota
            'status_aktif' => 1          // Default = aktif
        ]);

        return redirect()->to(base_url('auth'))->with('success', 'Registrasi berhasil! Silahkan login.');
    }
}