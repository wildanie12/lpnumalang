<?php namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['kategori'];

    protected $useTimestamps = true;
}