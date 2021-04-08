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

	// Handler file gambar untuk CKEditor 5
	public function article_image_handler()
	{
		$request = $this->request;
		$json = [];
		$handle_mode = $request->getHeaderLine('x-handle-mode');
		if ($handle_mode == "upload") {
			$gambar = $request->getFile('upload');
			if ($gambar->isValid()) {
				$name = $gambar->getRandomName();
				$gambar->move(ROOTPATH . 'public/images/mitra', $name);
				$json['url'] = site_url('/images/mitra/') . $gambar->getName();
			}
			else {
				$json['error']['message'] = 'Tidak ada gambar';
			}
		}
		else if ($handle_mode == "delete") {
			helper('filesystem');
			$gambar = $request->getPost('images');
			if ($gambar != '') {
				$gambar_array = explode('|', $gambar);
				foreach ($gambar_array as $gambar) {
					$base_length = strlen(base_url());
					$file_url = substr($gambar, $base_length);
					print_r('.' . $file_url);
					unlink('.' . $file_url);
				}
				$json['status'] = 'success';
			}

		}
		echo json_encode($json);
		die;
	}

	public function save()
	{
		$request = $this->request;
		dd($this->request->getVar());
		print_r($_POST['status_usaha']);
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