<?php namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table      = 'artikel';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['judul', 'slug', 'file_artikel', 'daftar_gambar', 'status', 'kategori_id', 'penulis_username', 'deskripsi_penelusuran'];

    protected $useTimestamps = true;
}