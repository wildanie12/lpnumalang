<?php 

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\MitraModel;
use App\Models\WilayahModel;
use App\Models\KategoriModel;
use App\Models\AdminModel;

class Mitra extends Controller
{
	function auth() {
		helper('cookie');
		$logged_username = get_cookie('logged_username');
		$logged_secret = get_cookie('logged_secret');
    	$adminModel = new AdminModel();
		$user = $adminModel->find($logged_username);
		if ($logged_username != '' && $logged_secret != '') {
			if ($user != '') {
				if (password_verify($user['token'], $logged_secret)) {
					return $user;
				}
				else {
					session()->setFlashdata('admin_message', 'Anda telah keluar dari sistem, silahkan masuk kembali menggunakan akun anda');
					return false;
				}
			}
			else {
				session()->setFlashdata('admin_message', 'Anda telah keluar dari sistem, silahkan masuk kembali menggunakan akun anda');
				return false;
			}
		}
		else {
			session()->setFlashdata('admin_message', 'Anda telah keluar dari sistem, silahkan masuk kembali menggunakan akun anda');
			return false;
		}
	}

	public function list()
	{	
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

		$data['ui_title'] = "Data Mitra LPNU - LPNU Administrator";
		$data['ui_sidebar'] = [
			"Dashboard|fas fa-tachometer-alt|primary|admin",
			"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
			"Data Mitra|fas fa-store|primary|admin/mitra",
			"Pengguna|fas fa-users|primary|admin/pengguna",
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
		$wilayahModel = new WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select('kecamatan')->distinct()->orderBy('kecamatan', 'asc')->findAll();		
		return view('admin/mitra/list', $data);
	}

	public function ajax_list($ui)
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

		$request = $this->request;
		if ($ui != 'single') {

			$mitraFiltered = new MitraModel();
			$data['limit'] = $request->getGet('limit');
			$data['page'] = $request->getGet('page');
			$data['offset'] = ($data['page'] - 1) * $data['limit'];


			$kecamatan = $request->getGet('kecamatan');
			if ($kecamatan != '') {
				$data['filter']['kecamatan'] = $kecamatan;
				$mitraFiltered->where('kecamatan', strtoupper($kecamatan));
			}
			$kelurahan = $request->getGet('kelurahan');
			if ($kelurahan != '') {
				$data['filter']['kelurahan'] = $kelurahan;
				$mitraFiltered->where('kelurahan', $kelurahan);
			}
			$status_usaha = $request->getGet('status_usaha');
			if ($status_usaha != '') {
				$data['filter']['status_usaha'] = $status_usaha;
				$mitraFiltered->like('status_usaha', $status_usaha, 'both');
			}
			$jenis_usaha = $request->getGet('jenis_usaha');
			if ($jenis_usaha != '') {
				$data['filter']['jenis_usaha'] = $jenis_usaha;
				$mitraFiltered->like('jenis_usaha', $jenis_usahn, 'both');
			}
			$pencarian = $request->getGet('pencarian');
			$pencarian_berdasarkan = $request->getGet('pencarian_berdasarkan');
			if ($pencarian != '') {
				if ($pencarian_berdasarkan == '') {
					$data['filter']['pencarian_berdasarkan'] = 'nama_pemilik';
					$pencarian_berdasarkan = 'nama_pemilik';
				}
				$data['filter']['pencarian'] = $pencarian;
				$mitraFiltered->like($pencarian_berdasarkan, $pencarian, 'both');
			}
			$mitraFiltered->orderBy('id', 'desc');
			$data['data_mitra'] = $mitraFiltered->findAll($data['limit'], $data['offset']);
			return view('admin/mitra/ajax/' . $ui, $data);
		}
	}

	public function tambah()
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

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
			"Pengguna|fas fa-users|primary|admin/pengguna",
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
		if ($this->request->isAJAX()) {
			$data['userdata'] = $this->auth();
			if (!$data['userdata']) {
				return redirect()->to(site_url('logout'));
			}

			$kategoriModel = new KategoriModel();
			$kategoriModel = $kategoriModel->orderBy('id', 'desc')->findAll();
			foreach ($kategoriModel as $kategori) {
				echo "<option data-description='" .$kategori['id']. "' value='" .$kategori['kategori']. "'> " . ucfirst(strtolower($kategori['kategori'])) . "</option>";
			}
		}
	}

	public function dynamic_form_write_jenis_usaha($mode)
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

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
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

		$data_kelurahan = new WilayahModel();
		$request = $this->request;
		$kecamatan = $request->getGet('kecamatan');
		if ($kecamatan != '') {
			$data_kelurahan = $data_kelurahan->where(['kecamatan' => $kecamatan])->orderBy('kelurahan', 'asc')->findAll();
			foreach ($data_kelurahan as $kelurahan) {
				echo "<option value='${kelurahan['kelurahan']}'>" . ucfirst(strtolower($kelurahan['kelurahan'])) . "</option>";
			}
		}
	}

	public function save()
	{	
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

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
			'admin_username' => $data['userdata']['username']
		]);

		return redirect()->to(site_url('admin/mitra')); 
	}

	// Handler Galeri
	public function galeri_handler($mode)
	{	
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

		$json = [];
		$request = $this->request;
		if ($mode == 'upload') {
			$gambar = $request->getFile('file');
			if ($gambar->isValid()) {
				$name = $gambar->getRandomName();
				$upload = $gambar->move(ROOTPATH . 'public/images/mitra/galeri', $name);
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
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

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

	

	public function edit($id)
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

		$mitraModel = new MitraModel();
		$data['mitra'] = $mitraModel->find($id);
		if ($data['mitra'] == '') {
			return view('errors/html/error_404');
		}
		else {
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
			"Pengguna|fas fa-users|primary|admin/pengguna",
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
			return view('admin/mitra/edit', $data);
		}
	}


	public function modify()
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}
		
		$request = $this->request;

		// Write file artikel
		helper('filesystem');
		$artikel = $request->getPost('artikel');
		$file_artikel = $request->getPost('file_artikel');
		if (!write_file('./files/mitra/' . $file_artikel, $artikel)) {
			echo "Tidak bisa menambahkan file artikel";
		}

		
		$mitraModel = new MitraModel();
		$mitraModel->save([
			'id' => $request->getPost('id'),
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

		return redirect()->to(site_url('admin/mitra')); 
	}

	public function delete()
	{
		// Delete DB
	}
}