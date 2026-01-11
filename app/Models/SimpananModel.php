<?php
namespace App\Models;
use CodeIgniter\Model;

class SimpananModel extends Model {
    protected $table = 'simpanan';
    protected $primaryKey = 'id_simpanan';
    protected $allowedFields = ['id_user', 'jenis_simpanan', 'jumlah', 'keterangan', 'tanggal_transaksi'];
}