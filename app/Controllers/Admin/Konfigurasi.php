<?php namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Konfigurasi extends Controller
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
		"Website|fas fa-cog|admin/konfigurasi",
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

	public function index()
	{

		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}
		$data['ui_title'] = "Administrator - Konfigurasi Website";
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Konfigurasi';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "Website";

		$kategoriModel = new \App\Models\KategoriModel();
		$data['data_kategori'] = $kategoriModel->orderBy('kategori', 'asc')->findAll();
		$kategoriUsahaModel = new \App\Models\KategoriUsahaModel();
		$data['data_kategori_usaha'] = $kategoriUsahaModel->orderBy('kategori', 'asc')->findAll();
		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();

		return view('admin/konfigurasi/index', $data);
	}


	/* -------------------------------------------------------------------------
	 * Request Ajax : Daftar halaman
	 * Catatan 		: bisa custom view, view tersimpan di admin/Konfigurasi/ajax/
  	 * ------------------------------------------------------------------------- */
	public function ajax_list_halaman($ui)
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
				$not_in_id = $request->getGet('notInId');
				$id_array = explode('|', $not_in_id);
				if (is_array($id_array)) {
				 	$halamanFiltered->whereNotIn('id', $id_array);
				} 

				$halamanFiltered->orderBy('id', 'desc');
				$data['data'] = $halamanFiltered->findAll($data['limit'], $data['offset']);
				return view('admin/konfigurasi/ajax/' . $ui, $data);
			}
		}
	}


	public function ajax_get_configuration()
	{
		$request = $this->request;
		if ($request->isAJAX()) {
			$nama = $request->post('nama');

			$konfigurasiModel = new \App\Models\KonfigurasiModel();
			$konfigurasi = $konfigurasiModel->find($nama);

			echo json_encode($konfigurasi);
		}
	}

	public function ajax_set_configuration()
	{
		$request = $this->request;
		if ($request->isAJAX()) {
			$nama = $request->getPost('nama');
			$valueType = $request->getPost('value_type');
			$value = $request->getPost('value');

			$konfigurasiModel = new \App\Models\KonfigurasiModel();
			if ($valueType == 'text') 
				$konfigurasiModel->update($nama, ['value_text' => $value]);
			else
				$konfigurasiModel->update($nama, ['value' => $value]);

			$json['affected_id'] = $nama;
			$json['status'] = 'success';
			$json['text'] = "Konfigurasi berhasil diperbarui<br/>";
			$json['icon'] = 'fas fa-thumbs-up';
			$json['color'] = 'default';
			echo json_encode($json);
		}
	}
	public function ajax_set_configuration_image()
	{
		$request = $this->request;
		if ($request->isAJAX()) {
			$nama = $request->getPost('nama');

			$gambar = $request->getFile('image');
			if ($gambar->isValid()) {
				$uploadConfig = new \Config\Upload();

				$konfigurasiModel = new \App\Models\KonfigurasiModel();
				$konfigurasi = $konfigurasiModel->find($nama);
				if (file_exists($uploadConfig->directoryPublic . '/' . $konfigurasi['value_text'])) {
					unlink($uploadConfig->directoryPublic . '/' . $konfigurasi['value_text']);
				}

				$gambar->move($uploadConfig->directoryPublic);
				$imagick = \Config\Services::image();
				$imagick->withFile($uploadConfig->directoryPublic . '/' . $gambar->getName())
					->resize(500, 500, true)
					->save($uploadConfig->directoryPublic . '/' . $gambar->getName(), 70);

				$konfigurasiModel->update($nama, ['value_text' => $gambar->getName()]);

				$json['affected_id'] = $nama;
				$json['status'] = 'success';
				$json['text'] = "Konfigurasi berhasil diperbarui<br/>";
				$json['icon'] = 'fas fa-thumbs-up';
				$json['color'] = 'default';
			}
			else {
				$json['affected_id'] = $nama;
				$json['status'] = 'success';
				$json['text'] = "Tidak dapat menerapkan konfigurasi<br/>";
				$json['icon'] = 'fas fa-times';
				$json['color'] = 'warning';
			}

			echo json_encode($json);
		}
	}
}