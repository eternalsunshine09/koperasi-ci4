<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamanModel extends Model
{
    protected $table            = 'pinjaman';
    protected $primaryKey       = 'id_pinjaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_user', 
        'tanggal_pengajuan', 
        'jumlah_pinjaman', 
        'bunga_persen', 
        'tenor_bulan', 
        'status', 
        'keterangan', 
        'created_at'
    ];

    // Mengaktifkan fitur otomatis update created_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Tidak ada updated_at di tabelmu, jadi kosongi
}