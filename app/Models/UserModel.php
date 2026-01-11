<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $allowedFields = [
    'username', 'password', 'nama_lengkap', 'nik', 
    'alamat', 'no_telp', 'role', 'status_aktif', 
    'email', 'gaji' // <--- Tambahkan dua ini
];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; 
}