<?php 
namespace App\Models;

use CodeIgniter\Model;

class MitraModel extends Model
{
    protected $table      = 'mitra';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['nama_pemilik', 'nomor_hp', 'alamat_usaha', 'kecamatan', 'kelurahan', 'ranting_nu', 'mwcnu', 'status_usaha', 'jenis_usaha', 'nama_barang', 'merek_dagang', 'izin', 'galeri', 'file_artikel', 'status', 'admin_username'
    ];
    protected $useTimestamps = true;


}

?>