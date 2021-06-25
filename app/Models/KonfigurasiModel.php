<?php namespace App\Models;

use CodeIgniter\Model;

class KonfigurasiModel extends Model
{
    protected $table      = 'konfigurasi';
    protected $primaryKey = 'nama';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nama', 'value', 'value_text', 'deskripsi'];

    public function showKeyValue()
    {
        $db = \Config\Database::connect();
        $data_konfigurasi = $db->table($this->table)->get()->getResult();
        $data_return = [];
        foreach ($data_konfigurasi as $konfigurasi) {
            $data_return[$konfigurasi->nama] = ['value_text' => $konfigurasi->value_text, 'value' => $konfigurasi->value];
        }
        return $data_return;
    }
}