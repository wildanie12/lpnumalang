<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\MitraModel;

class Admin extends Controller
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

		session();
		$data['ui_js'] = [
			"js/dynamic-img.js"
		];
		$data['ui_title'] = "Data Mitra LPNU - LPNU Administrator";
		$data['ui_sidebar'] = [
			"Dashboard|fas fa-tachometer-alt|primary|admin",
			"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
			"Data Mitra|fas fa-store|primary|admin/mitra",
			"Pengguna|fas fa-users|primary|admin/pengguna",
			"Tata Letak|fas fa-ruler-combined|primary|admin/mitra",
			"Konfigurasi|fas fa-cog|primary|admin/mitra",
		];
		$data['ui_sidebar_active'] = 'Pengguna';

		$data['ui_navbar'] = [
			"Tambah Data|fas fa-plus|admin/pengguna/tambah|primary",
			"List Akun Admin|fas fa-list|admin/pengguna"
		];
		$data['validation'] = \Config\Services::validation();
		$data['ui_navbar_active'] = "Tambah Data";


		$adminModel = new AdminModel();
		$data['data_admin'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();
		return view('admin/admin/list', $data);
	}

	public function tambah()
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

		session();
		$data['ui_js'] = [
			"js/dynamic-img.js"
		];
		$data['ui_title'] = "Data Mitra LPNU - LPNU Administrator";
		$data['ui_sidebar'] = [
			"Dashboard|fas fa-tachometer-alt|primary|admin",
			"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
			"Data Mitra|fas fa-store|primary|admin/mitra",
			"Pengguna|fas fa-users|primary|admin/pengguna",
			"Tata Letak|fas fa-ruler-combined|primary|admin/mitra",
			"Konfigurasi|fas fa-cog|primary|admin/mitra",
		];
		$data['ui_sidebar_active'] = 'Pengguna';

		$data['ui_navbar'] = [
			"Tambah Data|fas fa-plus|admin/pengguna/tambah|primary",
			"List Akun Admin|fas fa-list|admin/pengguna"
		];
		$data['ui_navbar_active'] = "Tambah Data";
		$data['validation'] = \Config\Services::validation();

		return view('admin/admin/tambah', $data);
	}

	public function save()
	{
		$userdata = $this->auth();
		if (!$userdata) {
			return redirect()->to(site_url('logout'));
		}

		$request = $this->request;

		$rules = [
			'username' => [
				'rules' => 'required|is_unique[admin.username]',
				'errors' => [
					'required' => '{field} admin harus di isi.',
					'is_unique' => '{field} admin sudah terdaftar'
				]
			],
			'password_confirm' => [
				'rules' => 'matches[password]',
				'errors' => [
					'matches' => 'konfirmasi password salah'
				]
			],
			'nama_lengkap' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'nama lengkap admin harus di isi.'
				]
			]
		];

		if (!$this->validate($rules)) {
			$validation = \Config\Services::validation();
			return redirect()->to(site_url('admin/pengguna/tambah'))->withInput()->with('validation', $validation);
		}

		$adminModel = new AdminModel();

		$data_insert = [
			'username' => $request->getPost('username'),
			'nama_lengkap' => $request->getPost('nama_lengkap'),
			'tanggal_lahir' => $request->getPost('tanggal_lahir'),
			'alamat' => $request->getPost('alamat'),
			'nomor_hp' => $request->getPost('nomor_hp'),
			'nomor_ktp' => $request->getPost('nomor_ktp'),
			'admin_username' => $userdata['username']
		];

		$password = $request->getPost('password');
		if ($password != '') {
			$data_insert['password'] = password_hash($password, PASSWORD_DEFAULT);
		}
		$avatar = $request->getFile('avatar');
		if ($avatar != '') {
			if ($avatar->isValid()) {
				$filename = $avatar->getRandomName();
				$avatar->move(ROOTPATH . 'public/images/profile', $filename);
				$data_insert['avatar'] = $filename;

				unlink('./images/profile/' . $userdata['avatar']);
			}
		}
		else {
			$data_insert['avatar'] = 'admin-default.png';
		}
		$adminModel->insert($data_insert);
		return redirect()->to(site_url('admin/pengguna'));
	}

	public function edit()
	{	
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}

		session();
		$data['ui_js'] = [
			"js/dynamic-img.js"
		];
		$data['ui_title'] = "Data Mitra LPNU - LPNU Administrator";
		$data['ui_sidebar'] = [
			"Dashboard|fas fa-tachometer-alt|primary|admin",
			"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
			"Data Mitra|fas fa-store|primary|admin/mitra",
			"Pengguna|fas fa-users|primary|admin/pengguna",
			"Tata Letak|fas fa-ruler-combined|primary|admin/mitra",
			"Konfigurasi|fas fa-cog|primary|admin/mitra",
		];
		$data['ui_sidebar_active'] = 'Pengguna';

		$data['ui_navbar'] = [
			"||"
		];
		$data['validation'] = \Config\Services::validation();

		return view('admin/admin/edit', $data);
	}


	public function modify()
	{
		$userdata = $this->auth();
		if (!$userdata) {
			return redirect()->to(site_url('logout'));
		}

		$request = $this->request;

		$rules = [
			'username' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} admin harus di isi.',
					'is_unique' => '{field} admin sudah terdaftar'
				]
			],
			'password_confirm' => [
				'rules' => 'matches[password]',
				'errors' => [
					'matches' => 'konfirmasi password salah'
				]
			],
			'nama_lengkap' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'nama lengkap admin harus di isi.'
				]
			]
		];

		if ($request->getPost('username') != $userdata['username']) {
			$rules['username']['rules'] .= '|is_unique[admin.username]';

			$mitraModel = new MitraModel();
			$mitraModel->where('admin_username', $userdata['username'])->set(['admin_username' => $request->getPost('username')])->update();
			session()->setFlashdata('admin_message', 'Akun anda berhasil diperbarui, silahkan login menggunakan username & password baru anda');
		}
		if (!$this->validate($rules)) {
			$validation = \Config\Services::validation();
			return redirect()->to(site_url('admin/pengguna/edit'))->withInput()->with('validation', $validation);
		}

		$adminModel = new AdminModel();

		$data_update = [
			'username' => $request->getPost('username'),
			'nama_lengkap' => $request->getPost('nama_lengkap'),
			'tanggal_lahir' => $request->getPost('tanggal_lahir'),
			'alamat' => $request->getPost('alamat'),
			'nomor_hp' => $request->getPost('nomor_hp'),
			'nomor_ktp' => $request->getPost('nomor_ktp'),
		];

		$password = $request->getPost('password');
		if ($password != '') {
			$data_update['password'] = password_hash($password, PASSWORD_DEFAULT);
		}
		$avatar = $request->getFile('avatar');
		if ($avatar != '') {
			if ($avatar->isValid()) {
				$filename = $avatar->getRandomName();
				$avatar->move(ROOTPATH . 'public/images/profile', $filename);
				$data_update['avatar'] = $filename;

				if ($userdata['avatar'] != '') {
					if ($userdata['avatar'] != 'admin-default.png') {
						if (file_exists('./images/profile/' . $userdata['avatar'])) {
							unlink('./images/profile/' . $userdata['avatar']);
						}
					}
				}
			}
		}
		$adminModel->update($userdata['username'], $data_update);
		return redirect()->to(site_url('admin/pengguna/edit'));
	}
	public function remove()
	{
		$request = $this->request;
		$username = $request->getPost('username');
		if ($username != '') {
			$adminModel = new AdminModel();
			$adminModel->delete($username);
		}
		return redirect()->to(site_url('admin/pengguna'));
	}
}

?>