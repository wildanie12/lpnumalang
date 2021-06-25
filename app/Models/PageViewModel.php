<?php namespace App\Models;

use CodeIgniter\Model;

class PageViewModel extends Model
{
    protected $table      = 'page_view';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['postingan_id','jenis_postingan','client_ip_address','client_browser','client_referer'];

    protected $useTimestamps = true;
}