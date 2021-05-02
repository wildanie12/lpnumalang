<?php namespace App\Models;

use CodeIgniter\Model;

class HalamanModel extends Model
{
    protected $table = 'halaman';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['judul', 'slug', 'file_artikel', 'daftar_gambar', 'penulis_username', 'deskripsi_penelusuran'];

    protected $useTimestamps = true;
}