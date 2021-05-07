<?php namespace App\Models;

use CodeIgniter\Model;

class TataLetakModel extends Model
{
    protected $table      = 'tata_letak';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ "halaman",  "judul",  "penempatan",  "row",  "urutan_col",  "lebar_lg",  "lebar_md",  "lebar_sm",  "lebar_xs",  "kelas",  "jenis_konten",  "view",  "options"];

}