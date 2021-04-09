<?php 
namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'username';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'password', 'nama_lengkap', 'avatar', 'tanggal_lahir', 'alamat', 'nomor_hp', 'nomor_ktp', 'token'];

    protected $useTimestamps = true;
}