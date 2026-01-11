<?php
namespace App\Models;
use CodeIgniter\Model;

class AngsuranModel extends Model {
    protected $table = 'angsuran';
    protected $primaryKey = 'id_angsuran';
    protected $allowedFields = ['id_pinjaman', 'id_user', 'tanggal_bayar', 'angsuran_ke', 'jumlah_bayar', 'denda', 'keterangan'];
}