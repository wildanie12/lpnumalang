<?php namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Artikel extends Controller
{
	protected $sidebar_link = [
		"Dashboard|fas fa-tachometer-alt|primary|admin",
		"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
		"Data Mitra|fas fa-store|primary|admin/mitra",
		"Pengguna|fas fa-users|primary|admin/pengguna",
		"Tata Letak|fas fa-ruler-combined|primary|admin/tataletak",
		"Konfigurasi|fas fa-cog|primary|admin/konfigurasi",
	];
	protected $navbar_link = [
		"Tulis Artikel|fas fa-pencil-alt|admin/postingan/artikel/tambah|primary",
		"Artikel|fas fa-newspaper|admin/postingan/artikel",
		"Halaman|fas fa-scroll|admin/postingan/halaman/",
	];

	function auth() {
		helper('cookie');
		$logged_username = get_cookie('logged_username');
		$logged_secret = get_cookie('logged_secret');
    	$adminModel = new \App\Models\AdminModel();
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
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = "Administrator - Daftar Artikel";
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Postingan';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "Artikel";
		$wilayahModel = new \App\Models\WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select('kecamatan')->distinct()->orderBy('kecamatan', 'asc')->findAll();		

		$kategoriModel = new \App\Models\KategoriModel();
		$data['data_kategori'] = $kategoriModel->orderBy('kategori', 'asc')->findAll();

		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();
		return view('admin/postingan/artikel/list', $data);
	}

	/* -------------------------------------------------------------------------
	 * Request Ajax : Daftar Artikel
	 * Catatan 		: bisa custom view, view tersimpan di admin/postingan/artikel/ajax/
  	 * ------------------------------------------------------------------------- */
	public function ajax_list($ui)
	{
		if ($this->request->isAJAX()) {
			
			$data['userdata'] = $this->auth();
			if (!$data['userdata']) {
				return redirect()->to(site_url('logout'));
			}

			$request = $this->request;
			if ($ui != 'single') {

				$data['adminModel'] = new \App\Models\AdminModel();
				$data['kategoriModel'] = new \App\Models\KategoriModel();

				$artikelFiltered = new \App\Models\ArtikelModel();
				$data['limit'] = $request->getGet('limit');
				$data['page'] = $request->getGet('page');
				$data['offset'] = ($data['page'] - 1) * $data['limit'];

				$pencarian = $request->getGet('pencarian');
				if ($pencarian != '') {
					$data['filter']['pencarian'] = $pencarian;
					$artikelFiltered->like('judul', $pencarian, 'both');
				}
				$kategori = $request->getGet('kategori');
				if ($kategori != '') {
					$data['filter']['kategori'] = $kategori;
					if ($kategori == 'null') 
						$artikelFiltered->where('kategori_id', '');
					else
						$artikelFiltered->like('kategori_id', $kategori, 'both');
				}
				$status = $request->getGet('status');
				if ($status != '') {
					$data['filter']['status'] = $status;
					$artikelFiltered->where('status', $status);
				}
				$penulis = $request->getGet('penulis');
				if ($penulis != '') {
					$data['filter']['penulis'] = $penulis;
					$artikelFiltered->where('penulis_username', $penulis);
				}

				$artikelFiltered->orderBy('id', 'desc');
				$data['data'] = $artikelFiltered->findAll($data['limit'], $data['offset']);
				return view('admin/postingan/artikel/ajax/' . $ui, $data);
			}
		}
	}

	/* -------------------------------------------------------------------------
	 * Request Ajax : Daftar Artikel
	 * Catatan 		: bisa custom view, view tersimpan di admin/postingan/artikel/ajax/
  	 * ------------------------------------------------------------------------- */
	public function ajax_set_status()
	{
		$request = $this->request;
		if ($request->isAJAX()) {
			$id = $request->getPost('id');
			if ($id != '') {
				$artikelModel = new \App\Models\ArtikelModel();
				$status = $request->getPost('status');
				$artikelModel->update($id, ['status' => $status]);
				$json = [
					'status' => 'success',
					'message' => [
						'text' => 'Artikel berhasil di ' . (($status == 'draf')? 'kembalikan ke draf' : 'publikasikan'),
						'icon' => 'fas fa-thumbs-up',
						'color' => 'default'
					]
				];
				echo json_encode($json);
				die;
			}
			else {
				$json = [
					'status' => 'error',
					'message' => [
						'text' => 'Tidak dapat melakukan aksi, ID tidak ada',
						'icon' => 'fas fa-times',
						'color' => 'danger'
					]
				];
				echo json_encode($json);
			}
		}
	}

	/* -------------------------------------------------------------------------
	 * Request Ajax : Menghapus Artikel
	 * Catatan 		: dikirim via ajax http_post, dengan membawa id
  	 * ------------------------------------------------------------------------- */
	public function ajax_delete() {
		$request = $this->request;
		if ($request->isAJAX()) {
			$id = $request->getPost('id');
			if ($id != '') {
				$artikelModel = new \App\Models\ArtikelModel();
				$artikel = $artikelModel->find($id);

				if ($artikel['daftar_gambar'] != '') {
					$data_gambar = explode('|', $artikel['daftar_gambar']);
					foreach ($data_gambar as $gambar) {
						$base_length = strlen(base_url());
						$file_url = substr($gambar, $base_length);
						if (file_exists('.' . $file_url)) {
							unlink('.' . $file_url);
						}
					}
				}
				if ($artikel['file_artikel'] != '') {
					if (file_exists('./files/postingan/artikel/' . $artikel['file_artikel'])) {
						unlink('./files/postingan/artikel/' . $artikel['file_artikel']);
					}
				}

				$pageViewModel = new \App\Models\PageViewModel();
				$pageViewModel->where('postingan_id', $id)
					->where('jenis_postingan', 'artikel')
					->delete();

				$artikelModel->delete($id);
				$json = [
					'status' => 'success',
					'message' => [
						'text' => 'Artikel berhasil di hapus',
						'icon' => 'fas fa-thumbs-up',
						'color' => 'default'
					]
				];
				echo json_encode($json);
			}
			else {
				$json = [
					'status' => 'error',
					'message' => [
						'text' => 'Tidak dapat menghapus artikel, ID tidak ada',
						'icon' => 'fas fa-times',
						'color' => 'danger'
					]
				];
				echo json_encode($json);
			}
		}
	}

	public function tambah()
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

		$data['ui_css'] = [
			"lib/tail-select/css/tail.select-default.css",
			"lib/dropzone/css/dropzone.css",
		];
		$data['ui_js'] = [
			"lib/tail-select/js/tail.select.js",
			"lib/dropzone/js/dropzone.js",
			"lib/ckeditor5/build/ckeditor.js"
		];
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = "Administrator - Tulis Artikel";;
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Postingan';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "Tulis Artikel";
		$kategoriModel = new \App\Models\KategoriModel();
		$data['data_kategori'] = $kategoriModel->findAll();

		return view('admin/postingan/artikel/tambah', $data);
	}

	public function edit($id = FALSE)
	{
		if ($id != FALSE) {
			$data['userdata'] = $this->auth();
			if (!$data['userdata']) {
				return redirect()->to(site_url('logout'));
			}

			$data['ui_css'] = [
				"lib/tail-select/css/tail.select-default.css",
				"lib/dropzone/css/dropzone.css",
			];
			$data['ui_js'] = [
				"lib/tail-select/js/tail.select.js",
				"lib/dropzone/js/dropzone.js",
				"lib/ckeditor5/build/ckeditor.js"
			];
			$konfigurasiModel = new \App\Models\KonfigurasiModel();
			$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
			$data['ui_title'] = "Administrator - Edit Artikel";;
			$data['ui_sidebar'] = $this->sidebar_link;
			$data['ui_sidebar_active'] = 'Postingan';

			$data['ui_navbar'] = $this->navbar_link;
			$data['ui_navbar_active'] = "Tulis Artikel";
			$kategoriModel = new \App\Models\KategoriModel();
			$artikelModel = new \App\Models\ArtikelModel();
			$data['data_kategori'] = $kategoriModel->findAll();
			$data['artikel'] = $artikelModel->find($id);
			$adminModel = new \App\Models\AdminModel();
			$data['penulis'] = $adminModel->find($data['artikel']['penulis_username']);


			return view('admin/postingan/artikel/edit', $data);
		}
		else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak dapat ditemukan');
		}
	}

	/* -------------------------------------------------------------------------
	 * Elemen Dinamis Ajax: select kategori pada tambah artikel
	 * Catatan: Menyediakan data berupa <option> ke dalam elemen <select> kategori
  	 * ------------------------------------------------------------------------- */
	public function dynamic_form_kategori()
	{
		if ($this->request->isAJAX()) {
			$data['userdata'] = $this->auth();
			if (!$data['userdata']) {
				return redirect()->to(site_url('logout'));
			}

			$kategoriModel = new \App\Models\KategoriModel();
			$kategoriModel = $kategoriModel->orderBy('id', 'desc')->findAll();
			foreach ($kategoriModel as $kategori) {
				echo "<option data-description='" .$kategori['id']. "' value='" .$kategori['id']. "'> " . ucfirst(strtolower($kategori['kategori'])) . "</option>";
			}
		}
	}

	/* -------------------------------------------------------------------------
	 * Elemen Dinamis Ajax: membuat dan menghapus kategori pada tambah artikel
	 * Catatan: 	Menambah dan menghapus kategori menggunakan popover di halaman 
	 * 				tambah, 
  	 * ------------------------------------------------------------------------- */
	public function dynamic_form_kategori_write($mode)
	{
		if ($this->request->isAJAX()) {
			$data['userdata'] = $this->auth();
			if (!$data['userdata']) {
				return redirect()->to(site_url('logout'));
			}


			$request = $this->request;
			$kategoriModel = new \App\Models\KategoriModel();
			if ($mode == 'insert') {
				
				$rules = [
					'kategori' => [
						'rules' => 'required|is_unique_without_deleted[kategori.kategori]',
						'errors' => [
							'required' => 'Kategori belum di isi saat tambah kategori',
							'is_unique_without_deleted' => 'Kategori sudah ada'
						]
					]
				];

				if (!$this->validate($rules)) {
					$validation = \Config\Services::validation();
					echo json_encode(['error' => join(', ', $validation->getErrors())]);
					die;
				}
				$kategoriModel->save(['kategori' => $request->getPost('kategori'), 'slug' => url_title($request->getPost('kategori'))]);
			}
			else if ($mode == 'delete') {
				$id = $request->getPost('id');
				// $kategoriModel->delete($id);
				$artikelModel = new \App\Models\ArtikelModel();
				$data_artikel = $artikelModel->like('kategori_id', $id, 'both')->findAll();
				$data_artikel = count($data_artikel);
				if ($data_artikel <= 0) {
					$kategoriModel->delete($id, true);
				}
				else {
					$kategoriModel->delete($id);
				}
			}
			echo json_encode(['status' => 'success']);
			die;
		}
	}


	/* -------------------------------------------------------------------------
	 * Handler: Menangani fitur upload gambar untuk CKEditor 5
  	 * ------------------------------------------------------------------------- */
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
				$uploadConfig = new \Config\Upload();
				$gambar->move($uploadConfig->directoryArtikelGambar);
				$imagick = \Config\Services::image();
				$imagick->withFile($uploadConfig->directoryArtikelGambar . '/' . $gambar->getName())
					->resize(800, 800, true)
					->save($uploadConfig->directoryArtikelGambar . '/' . $gambar->getName(), 70);
				$json['url'] = site_url('/images/postingan/artikel/') . $gambar->getName();
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
					if (file_exists('.' . $file_url)) {
						unlink('.' . $file_url);
					}
				}
				$json['status'] = 'success';
			}

		}
		echo json_encode($json);
		die;
	}

	/* -------------------------------------------------------------------------
	 * Ajax 	: Menyimpan artikel sebagai draf.
	 * Catatan 	: Menambah dan menghapus kategori menggunakan popover di halaman 
	 * 			  tambah, 
  	 * ------------------------------------------------------------------------- */
	public function save_draf()
	{
		$userdata = $this->auth();
		if (!$userdata) {
			return redirect()->to(site_url('logout'));
		}

		$request = $this->request;
		if ($request->isAJAX()) {
			
			$data_db = [
				'judul' => $request->getPost('judul'),
				'slug' => url_title($request->getPost('judul')),
				'status' => $request->getPost('status'),
				'daftar_gambar' => $request->getPost('daftar_gambar'),
				'kategori_id' => $request->getPost('kategori_id'),
				'deskripsi_penelusuran' => $request->getPost('deskripsi_penelusuran'),
				'penulis_username' => $userdata['username'],
			];
			$rules = [
				'judul' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Judul harus di isi',
						'is_unique' => 'Judul sudah digunakan oleh artikel lain'
					]
				],
			];

			if ($request->getPost('id') != '') {
				$data_db['id'] = $request->getPost('id');
				$artikelModel = new \App\Models\ArtikelModel();
				$artikel = $artikelModel->find($request->getPost('id'));
				if (strtolower($request->getPost('judul')) != strtolower($artikel['judul'])) {
					$rules['judul']['rules'] .= '|is_unique[artikel.judul]';
				}
			}
			else {
				$rules['judul']['rules'] .= '|is_unique[artikel.judul]';
			}



			if (!$this->validate($rules)) {
				$validation = \Config\Services::validation();
				echo json_encode(['status' => 'error', 'errors' => $validation->getErrors()]);
				die;
			}

			helper('filesystem');
			if ($request->getPost('id') != '') {
				$artikel_input = $request->getPost('artikel');
				$uploadConfig = new \Config\Upload();
				if (!write_file($uploadConfig->directoryArtikelFile . '/' . $artikel['file_artikel'], $artikel_input)) {
					echo "Tidak bisa menambahkan file artikel";
				}
			}
			else {
				// Write file artikel
				$artikel = $request->getPost('artikel');
				$file_artikel = 'artikel-' . time() . '-' . round(microtime(true) * 1000) . '-' . rand(0, 1000) . '.php';
				$uploadConfig = new \Config\Upload();
				if (!write_file($uploadConfig->directoryArtikelFile . '/' . $file_artikel, $artikel)) {
					echo "Tidak bisa menambahkan file artikel";
				}
				$data_db['file_artikel'] = $file_artikel;
			}





			$artikelModel = new \App\Models\ArtikelModel();
			$artikelModel->save($data_db);

			if ($data_db['status'] == 'dipublikasikan') {
				session()->setFlashdata('admin_artikel_msg', 'Postingan Artikel berhasil dipublikasikan!');
			}
			else {
				session()->setFlashdata('admin_artikel_msg', 'Postingan Artikel berhasil disimpan sebagai draf!');
			}


			$json = ['status' => 'success'];
			if ($request->getPost('id') == '') {
				$json['id'] = $artikelModel->getInsertID();
			}
			else {
				$json['id'] = $request->getPost('id');
			}



			echo json_encode($json);

		}
	}

}