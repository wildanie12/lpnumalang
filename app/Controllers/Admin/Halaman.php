<?php namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Halaman extends Controller
{
	protected $sidebar_link = [
		"Dashboard|fas fa-tachometer-alt|primary|admin",
		"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
		"Data Mitra|fas fa-store|primary|admin/mitra",
		"Pengguna|fas fa-users|primary|admin/pengguna",
		"Tata Letak|fas fa-ruler-combined|primary|admin/mitra",
		"Konfigurasi|fas fa-cog|primary|admin/mitra",
	];
	protected $navbar_link = [
		"Buat Halaman|fas fa-pencil-alt|admin/postingan/halaman/tambah|primary",
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
		$data['ui_title'] = "Data Mitra LPNU - LPNU Administrator";
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Postingan';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "Halaman";
		$wilayahModel = new \App\Models\WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select('kecamatan')->distinct()->orderBy('kecamatan', 'asc')->findAll();		

		$kategoriModel = new \App\Models\KategoriModel();
		$data['data_kategori'] = $kategoriModel->orderBy('kategori', 'asc')->findAll();

		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();
		return view('admin/postingan/halaman/list', $data);
	}


	/* -------------------------------------------------------------------------
	 * Request Ajax : Daftar Artikel (Read)
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

				$halamanFiltered = new \App\Models\HalamanModel();
				$data['limit'] = $request->getGet('limit');
				$data['page'] = $request->getGet('page');
				$data['offset'] = ($data['page'] - 1) * $data['limit'];

				$pencarian = $request->getGet('pencarian');
				if ($pencarian != '') {
					$data['filter']['pencarian'] = $pencarian;
					$halamanFiltered->like('judul', $pencarian, 'both');
				}
				$penulis = $request->getGet('penulis');
				if ($penulis != '') {
					$data['filter']['penulis'] = $penulis;
					$halamanFiltered->where('penulis_username', $penulis);
				}

				$halamanFiltered->orderBy('id', 'desc');
				$data['data'] = $halamanFiltered->findAll($data['limit'], $data['offset']);
				return view('admin/postingan/halaman/ajax/' . $ui, $data);
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
				$halamanModel = new \App\Models\HalamanModel();
				$halaman = $halamanModel->find($id);

				if ($halaman['daftar_gambar'] != '') {
					$data_gambar = explode('|', $halaman['daftar_gambar']);
					foreach ($data_gambar as $gambar) {
						$base_length = strlen(base_url());
						$file_url = substr($gambar, $base_length);
						if (file_exists('.' . $file_url)) {
							unlink('.' . $file_url);
						}
					}
				}
				if ($halaman['file_artikel'] != '') {
					if (file_exists('./files/postingan/halaman/' . $halaman['file_artikel'])) {

						unlink('./files/postingan/halaman/' . $halaman['file_artikel']);
					}
				}

				$halamanModel->delete($id);
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
		];
		$data['ui_js'] = [
			"lib/ckeditor5/build/ckeditor.js"
		];
		$data['ui_title'] = "Buat Halaman - LPNU Administrator";
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Postingan';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "Buat Halaman";

		return view('admin/postingan/halaman/tambah', $data);
	}

	public function edit($id = FALSE)
	{
		if ($id != FALSE) {
			$data['userdata'] = $this->auth();
			if (!$data['userdata']) {
				return redirect()->to(site_url('logout'));
			}

			$data['ui_css'] = [
			];
			$data['ui_js'] = [
				"lib/ckeditor5/build/ckeditor.js"
			];
			$data['ui_title'] = "Edit Halaman - LPNU Administrator";
			$data['ui_sidebar'] = $this->sidebar_link;
			$data['ui_sidebar_active'] = 'Postingan';

			$data['ui_navbar'] = $this->navbar_link;
			$data['ui_navbar_active'] = "Halaman";
			$halamanModel = new \App\Models\HalamanModel();
			$data['halaman'] = $halamanModel->find($id);
			$adminModel = new \App\Models\AdminModel();
			$data['penulis'] = $adminModel->find($data['halaman']['penulis_username']);


			return view('admin/postingan/halaman/edit', $data);
		}
		else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak dapat ditemukan');
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
				$gambar->move($uploadConfig->directoryHalamanGambar);
				$imagick = \Config\Services::image();
				$imagick->withFile($uploadConfig->directoryHalamanGambar . '/' . $gambar->getName())
					->resize(800, 800, true)
					->save($uploadConfig->directoryHalamanGambar . '/' . $gambar->getName(), 70);
				$json['url'] = site_url('/images/postingan/halaman/') . $gambar->getName();
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
				'daftar_gambar' => $request->getPost('daftar_gambar'),
				'deskripsi_penelusuran' => $request->getPost('deskripsi_penelusuran'),
				'penulis_username' => $userdata['username'],
			];
			$rules = [
				'judul' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Judul harus di isi',
						'is_unique' => 'Judul sudah digunakan oleh halaman lain'
					]
				],
			];

			if ($request->getPost('id') != '') {
				$data_db['id'] = $request->getPost('id');
				$halamanModel = new \App\Models\HalamanModel();
				$halaman = $halamanModel->find($request->getPost('id'));
				if (strtolower($request->getPost('judul')) != strtolower($halaman['judul'])) {
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
				if (!write_file($uploadConfig->directoryHalamanFile . '/' . $halaman['file_artikel'], $artikel_input)) {
					echo "Tidak bisa menambahkan file artikel";
				}
			}
			else {
				// Write file artikel
				$artikel = $request->getPost('artikel');
				$file_artikel = 'halaman-' . time() . '-' . round(microtime(true) * 1000) . '-' . rand(0, 1000) . '.php';
				$uploadConfig = new \Config\Upload();
				if (!write_file($uploadConfig->directoryHalamanFile . '/' . $file_artikel, $artikel)) {
					echo "Tidak bisa menambahkan file artikel";
				}
				$data_db['file_artikel'] = $file_artikel;
			}





			$halamanModel = new \App\Models\HalamanModel();
			$halamanModel->save($data_db);

			session()->setFlashdata('admin_artikel_msg', 'halaman berhasil dibuat!');


			$json = ['status' => 'success'];
			if ($request->getPost('id') == '') {
				$json['id'] = $halamanModel->getInsertID();
			}
			else {
				$json['id'] = $request->getPost('id');
			}



			echo json_encode($json);

		}
	}


}