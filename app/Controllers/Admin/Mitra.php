<?php 

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\models\MitraModel;
use App\models\WilayahModel;
use App\models\KategoriModel;

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
		$wilayahModel = new WilayahModel();
		$kategoriModel = new KategoriModel();
		$data['data_kecamatan'] = $wilayahModel->select('kecamatan')->distinct()->orderBy('kecamatan', 'asc')->findAll();
		$data['data_kategori'] = $kategoriModel->findAll();

		helper('form');
		return view('admin/mitra/tambah', $data);
	}

	public function dynamic_form_jenis_usaha()
	{
		$kategoriModel = new KategoriModel();
		$kategoriModel = $kategoriModel->orderBy('id', 'desc')->findAll();
		foreach ($kategoriModel as $kategori) {
			echo "<option data-description='" .$kategori['id']. "' value='" .$kategori['kategori']. "'> " . ucfirst(strtolower($kategori['kategori'])) . "</option>";
		}
	}

	public function dynamic_form_write_jenis_usaha($mode)
	{
		$request = $this->request;
		$kategoriModel = new KategoriModel();
		if ($mode == 'insert') {
			$kategoriModel->save(['kategori' => $request->getPost('kategori')]);
		}
		else if ($mode == 'delete') {
			$id = $request->getPost('id');
			$kategoriModel->delete($id);
		}
		echo json_encode(['status' => 'success']);
		die;
	}

	public function dynamic_form_kelurahan()
	{
		$data_kelurahan = new WilayahModel();
		$request = $this->request;
		$kecamatan = $request->getGet('kecamatan');
		if ($kecamatan != '') {
			$data_kelurahan = $data_kelurahan->where(['kecamatan' => $kecamatan])->findAll();
			foreach ($data_kelurahan as $kelurahan) {
				echo "<option value='${kelurahan['kelurahan']}'>" . ucfirst(strtolower($kelurahan['kelurahan'])) . "</option>";
			}
		}
	}

	public function save()
	{	
		// print_r($mitraModel);
		$request = $this->request;


		// Write file artikel
		helper('filesystem');
		$artikel = $request->getPost('artikel');
		$file_artikel = 'mitra-' . time() . '-' . round(microtime(true) * 1000) . '-' . rand(0, 1000) . '.php';
		if (!write_file('./files/mitra/' . $file_artikel, $artikel)) {
			echo "Tidak bisa menambahkan file artikel";
		}

		
		$mitraModel = new MitraModel();
		$mitraModel->save([
			'nama_pemilik' => $request->getPost('nama_pemilik'),
			'nomor_hp' => $request->getPost('nomor_hp'),
			'kecamatan' => $request->getPost('kecamatan'),
			'kelurahan' => $request->getPost('kelurahan'),
			'alamat_usaha' => $request->getPost('alamat_usaha'),
			'ranting_nu' => $request->getPost('ranting_nu'),
			'mwcnu' => $request->getPost('mwcnu'),

			'status_usaha' => join('|', $request->getPost('status_usaha')),
			'jenis_usaha' => join('|', $request->getPost('jenis_usaha')),
			
			'nama_barang' => $request->getPost('nama_barang'),
			'merek_dagang' => $request->getPost('merek_dagang'),
			'izin' => $request->getPost('izin'),
			'list_gambar' => $request->getPost('list_gambar'),
			'artikel' => $request->getPost('artikel'),
			'file_artikel' => $file_artikel,
			'galeri' => $request->getPost('galeri'),	
			'status' => 'dipublikasikan',
			'admin_username' => 'decoy'
		]);
	}

	// Handler Galeri
	public function galeri_handler($mode)
	{	
		$json = [];
		$request = $this->request;
		if ($mode == 'upload') {
			$gambar = $request->getFile('file');
			if ($gambar->isValid()) {
				$name = $gambar->getRandomName();
				$gambar->move(ROOTPATH . 'public/images/mitra/galeri', $name);
				$json['url'] = site_url('/images/mitra/galeri/') . $gambar->getName();
			}
			else {
				$json['error']['message'] = 'Tidak ada gambar';
			}
		}
		else if ($mode == 'delete') {
			helper('filesystem');
			$gambar = $request->getPost('image');
			if ($gambar != '') {
				$base_length = strlen(base_url());
				$file_url = substr($gambar, $base_length);
				unlink('.' . $file_url);
				$json['status'] = 'success';
			}
		}
		else {

		}
		echo json_encode($json);
		die;
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
					unlink('.' . $file_url);
				}
				$json['status'] = 'success';
			}

		}
		echo json_encode($json);
		die;
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