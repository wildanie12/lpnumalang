<?php namespace App\Models;

use CodeIgniter\Model;

class KategoriUsahaModel extends Model
{
    protected $table = 'kategori_usaha';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['kategori'];

    protected $useTimestamps = true;
}