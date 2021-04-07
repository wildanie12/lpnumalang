<?php 

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Mitra extends Controller
{

	public function list()
	{	
		$data['userdata'] = [
			'username' => 'wildanie12',
			'nama_lengkap' => 'M. Badar Wildanie',
			'avatar' => 'admin-default.png',
		];

		$data['ui_title'] = "Data Mitra LPNU - LPNU Administrator";
		$data['ui_sidebar'] = [
			"Dashboard|fas fa-tachometer-alt|primary|admin",
			"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
			"Data Mitra|fas fa-store|primary|admin/mitra",
			"Tata Letak|fas fa-ruler-combined|primary|admin/mitra",
			"Konfigurasi|fas fa-cog|primary|admin/mitra",
		];
		$data['ui_sidebar_active'] = 'Data Mitra';

		$data['ui_navbar'] = [
			"Tambah Mitra|fas fa-plus-circle|admin/mitra/tambah|primary",
			"List Mitra|fas fa-list|admin/mitra/",
			"Laporan|fas fa-clipboard-list|admin/mitra/laporan",
			"Statistik|fas fa-chart-line|admin/mitra/statistik",
		];
		$data['ui_navbar_active'] = "List Mitra";
		return view('admin/mitra/list', $data);
	}

	public function tambah()
	{
		$data['userdata'] = [
			'username' => 'wildanie12',
			'nama_lengkap' => 'M. Badar Wildanie',
			'avatar' => 'admin-default.png',
		];

		$data['ui_css'] = [
			"lib/tail-select/css/tail.select-default.css",
			"lib/dropzone/css/dropzone.css",
		];
		$data['ui_js'] = [
			"lib/tail-select/js/tail.select.js",
			"lib/dropzone/js/dropzone.js",
			"lib/ckeditor5/build/ckeditor.js"
		];
		$data['ui_title'] = "Tambah data Mitra - LPNU Administrator";
		$data['ui_sidebar'] = [
			"Dashboard|fas fa-tachometer-alt|primary|admin",
			"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
			"Data Mitra|fas fa-store|primary|admin/mitra",
			"Tata Letak|fas fa-ruler-combined|primary|admin/mitra",
			"Konfigurasi|fas fa-cog|primary|admin/mitra",
		];
		$data['ui_sidebar_active'] = 'Data Mitra';

		$data['ui_navbar'] = [
			"Tambah Mitra|fas fa-plus-circle|admin/mitra/tambah|primary",
			"List Mitra|fas fa-list|admin/mitra/",
			"Laporan|fas fa-clipboard-list|admin/mitra/laporan",
			"Statistik|fas fa-chart-line|admin/mitra/statistik",
		];
		$data['ui_navbar_active'] = "Tambah Mitra";
		return view('admin/mitra/tambah', $data);
	}


	public function insert()
	{
		// Insert DB
	}

	public function update()
	{
		// Update DB
	}

	public function delete()
	{
		// Delete DB
	}
}