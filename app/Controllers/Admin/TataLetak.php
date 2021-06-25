<?php namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class TataLetak extends Controller
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
		"Homepage|fas fa-home|admin/tataletak/homepage|primary",
		"List Artikel|fas fa-newspaper|admin/tataletak/listartikel",
		"Detail Artikel|fas fa-newspaper|admin/tataletak/detailartikel",
		"Detail Mitra|fas fa-scroll|admin/tataletak/detailmitra",
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

	public function homepage()
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = "Administrator - Tata letak Homepage";
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Tata Letak';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "Homepage";

		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$tataLetakModel = new \App\Models\TataLetakModel();
		$data['data_tataletak_content'] = $tataLetakModel->where('halaman', 'homepage')->where('penempatan', 'content')->orderBy('row', 'asc')->orderBy('urutan_col', 'asc')->findAll();
		$data['data_tataletak_widget'] = $tataLetakModel->where('halaman', 'homepage')->where('penempatan', 'widget')->orderBy('row', 'asc')->orderBy('urutan_col', 'asc')->findAll();

		// print_r($data['data_tataletak_content']);
		// die;

		$kategoriModel = new \App\Models\KategoriModel();
		$data['data_kategori'] = $kategoriModel->orderBy('kategori', 'asc')->findAll();
		$kategoriUsahaModel = new \App\Models\KategoriUsahaModel();
		$data['data_kategori_usaha'] = $kategoriUsahaModel->orderBy('kategori', 'asc')->findAll();
		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$wilayahModel = new \App\Models\WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select("distinct(kecamatan)")->orderBy('kecamatan', 'asc')->findAll();

		return view('admin/tata_letak/homepage', $data);
	}

	public function listartikel()
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = "Administrator - Tata letak daftar artikel";
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Tata Letak';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "List Artikel";

		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$tataLetakModel = new \App\Models\TataLetakModel();
		$data['data_tataletak_widget'] = $tataLetakModel->where('halaman', 'list-artikel')->where('penempatan', 'widget')->orderBy('row', 'asc')->orderBy('urutan_col', 'asc')->findAll();

		$kategoriModel = new \App\Models\KategoriModel();
		$data['data_kategori'] = $kategoriModel->orderBy('kategori', 'asc')->findAll();
		$kategoriUsahaModel = new \App\Models\KategoriUsahaModel();
		$data['data_kategori_usaha'] = $kategoriUsahaModel->orderBy('kategori', 'asc')->findAll();
		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$wilayahModel = new \App\Models\WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select("distinct(kecamatan)")->orderBy('kecamatan', 'asc')->findAll();

		return view('admin/tata_letak/list_artikel', $data);
	}
	public function detailartikel()
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = "Administrator - Tata letak detail Artikel";
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Tata Letak';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "Detail Artikel";

		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$tataLetakModel = new \App\Models\TataLetakModel();

		$kategoriModel = new \App\Models\KategoriModel();
		$data['data_kategori'] = $kategoriModel->orderBy('kategori', 'asc')->findAll();
		$kategoriUsahaModel = new \App\Models\KategoriUsahaModel();
		$data['data_kategori_usaha'] = $kategoriUsahaModel->orderBy('kategori', 'asc')->findAll();
		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$wilayahModel = new \App\Models\WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select("distinct(kecamatan)")->orderBy('kecamatan', 'asc')->findAll();

		return view('admin/tata_letak/detail_artikel', $data);
	}

	public function detailmitra()
	{
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = "Administrator - Tata letak detail Mitra";
		$data['ui_sidebar'] = $this->sidebar_link;
		$data['ui_sidebar_active'] = 'Tata Letak';

		$data['ui_navbar'] = $this->navbar_link;
		$data['ui_navbar_active'] = "Detail Mitra";

		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$tataLetakModel = new \App\Models\TataLetakModel();

		$kategoriModel = new \App\Models\KategoriModel();
		$data['data_kategori'] = $kategoriModel->orderBy('kategori', 'asc')->findAll();
		$kategoriUsahaModel = new \App\Models\KategoriUsahaModel();
		$data['data_kategori_usaha'] = $kategoriUsahaModel->orderBy('kategori', 'asc')->findAll();
		$adminModel = new \App\Models\AdminModel();
		$data['data_penulis'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();

		$wilayahModel = new \App\Models\WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select("distinct(kecamatan)")->orderBy('kecamatan', 'asc')->findAll();

		return view('admin/tata_letak/detail_mitra', $data);
	}

	/* -------------------------------------------------------------------------
	 * Request Ajax : Daftar Tata Letak (Read)
	 * Catatan 		: bisa custom view, view tersimpan di admin/tataletak/ajax/
  	 * ------------------------------------------------------------------------- */
	public function ajax_list($ui)
	{
		// if ($this->request->isAJAX()) {
			
			$data['userdata'] = $this->auth();
			if (!$data['userdata']) {
				return redirect()->to(site_url('logout'));
			}
			$request = $this->request;
			if ($ui != 'single') {
				$tataLetakFiltered = new \App\Models\TataLetakModel();
				$data['limit'] = (($request->getGet('limit') != '') ? $request->getGet('limit') : 0);
				$data['page'] = (($request->getGet('page') != '') ? $request->getGet('page') : 1);
				$data['offset'] = ($data['page'] - 1) * $data['limit'];

				$halaman = $request->getGet('halaman');
				if ($halaman != '') {
					$tataLetakFiltered->where('halaman', $halaman);
				}

				$penempatan = $request->getGet('penempatan');
				if ($penempatan != '') {
				$tataLetakFiltered->where('penempatan', $penempatan);
				}

				$jenis_konten = $request->getGet('jenis_konten');
				if ($jenis_konten != '') {
				$tataLetakFiltered->where('jenis_konten', $jenis_konten);
				}

				$view = $request->getGet('view');
				if ($view != '') {
				 	$tataLetakFiltered->where('view', $view);
				} 

				$judul = $request->getGet('judul');
				if ($judul != '') {
				$tataLetakFiltered->where('judul', $judul);
				}

				$tataLetakFiltered->orderBy('row', 'asc');
				$tataLetakFiltered->orderBy('urutan_col', 'asc');

				$data['data'] = $tataLetakFiltered->findAll($data['limit'], $data['offset']);
				return view('admin/tata_letak/ajax/' . $ui, $data);
			}
			else {
				$id = $request->getGet('id');
				$tataLetakModel = new \App\Models\TataLetakModel();
				$artikelModel = new \App\Models\ArtikelModel();
				$mitraModel = new \App\Models\MitraModel();
				$json = $tataLetakModel->find($id);
				if ($json['jenis_konten'] == 'featured') {
					$options = json_decode($json['options']);
					$data_artikel = $artikelModel->whereIn('id', $options->featured)->findAll();
					foreach ($data_artikel as $artikel) {
						$json['featured'][] = ["id" => $artikel['id'], "judul" => $artikel['judul']];
					}
				}
				else if ($json['jenis_konten'] == 'mitra-featured') {
					$options = json_decode($json['options']);
					$data_mitra = $mitraModel->whereIn('id', $options->mitra_featured)->findAll();
					foreach ($data_mitra as $mitra) {
						// membuat judul
						$judul = '';
						if ($mitra['merek_dagang'] != '') {
							$judul = $mitra['merek_dagang'];
						}
						else if ($mitra['nama_barang'] != '') {
							$judul = $mitra['nama_barang'];
						}
						else if ($mitra['jenis_usaha'] != '') {
							$jenis_usaha = explode('|', $mitra['jenis_usaha']);
							$i = 1;
							$judul = '';
							foreach ($jenis_usaha as $jenis) {
								$judul .= $jenis . ', ';
								if ($i >= 3) {
									break;
								}
								$i++;
							}
							rtrim($judul, ', ');
						}
						$json['featured_mitra'][] = ["id" => $mitra['id'], "judul" => $judul];
					}
				}
				echo json_encode($json);
				die;
			}
		// }
	}


	public function ajax_preview_element()
	{
		$data['artikelModel'] = new \App\Models\ArtikelModel();
		$data['adminModel'] = new \App\Models\AdminModel();
		$data['kategoriModel'] = new \App\Models\KategoriModel();
		$data['mitraModel'] = new \App\Models\MitraModel();

		$data['nama_bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['nama_hari'] = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu', 'Ahad'];

		$request = $this->request;
		$penempatan = $request->getPost('penempatan');
		$judul = $request->getPost('judul');
		$jenis_konten = $request->getPost('jenis_konten');
		$view = $request->getPost('view');

		$options = [];

		// Penempatan
		if ($penempatan == 'widget') {
			$options['background'] = $request->getPost('option_widget_background');
			$options['color'] = $request->getPost('option_widget_color');
			$options['border'] = $request->getPost('option_widget_border');
		}

		// Jenis Konten
		if ($jenis_konten == 'kategori') 
			$options['kategori_id'] = $request->getPost('option_kategori_artikel');
		if ($jenis_konten == 'penulis')
			$options['penulis'] = $request->getPost('option_penulis');
		if ($jenis_konten == 'featured')
			$options['featured'] = explode('|', $request->getPost('option_featured'));
		if ($jenis_konten == 'mitra-kategori')
			$options['kategori_usaha'] = $request->getPost('option_kategori_usaha');
		if ($jenis_konten == 'mitra-featured')
			$options['mitra_featured'] = explode('|', $request->getPost('option_mitra_featured'));


		// View
		if ($view != 'carousel' || $view != 'card-thumbnail')
			$options['baca_selengkapnya'] = (($request->getPost('option_baca_selengkapnya') == 'true') ? true : false);
		if ($view == 'carousel' || $view == 'card-thumbnail-slider' || $view == 'mitra-slider')
			$options['durasi'] = strval($request->getPost('option_durasi') * 1000);

		// no limit on featured
		if ($view != 'featured' && $view != 'mitra-featured') 
			$options['limit'] = $request->getPost('option_limit');

		$data['element'] = [
			'judul' => (($judul != '') ? $judul: '[Tidak ada judul]'),
			'jenis_konten' => $jenis_konten,
			'view' => $view,
			'options' => json_encode($options),
			'kelas' => $request->getPost('kelas')
		];


		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css",
			'lib/powerful-calendar/style.css',
			'lib/powerful-calendar/theme.css'
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js",
		];

		// $tataLetakModel = new \App\Models\TataLetakModel();
		// $data['element'] = $tataLetakModel->find(2);
		// $penempatan = $data['element']['penempatan'];
		if ($penempatan == 'content') {
			return view('admin/tata_letak/ajax/preview_element_content', $data);
		}
		else {
			$data['ui_js'][] = 'lib/powerful-calendar/calendar.min.js';
			return view('admin/tata_letak/ajax/preview_element_widget', $data);
		}


	}

	public function ajax_write($mode)
	{
		$request = $this->request;
		if ($request->isAJAX()) {
			$tataLetakModel = new \App\Models\TataLetakModel();
			if ($mode == 'insert') {
				$data_insert['penempatan'] = $request->getPost('penempatan');
				$data_insert['judul'] = $request->getPost('judul');
				$data_insert['jenis_konten'] = $request->getPost('jenis_konten');
				$data_insert['view'] = $request->getPost('view');

				$data_insert['options'] = [];
				$data_insert['options']['limit'] = $request->getPost('option_limit');

				// Penempatan
				if ($data_insert['penempatan'] == 'widget') {
					$data_insert['options']['background'] = $request->getPost('option_widget_background');
					$data_insert['options']['color'] = $request->getPost('option_widget_color');
					$data_insert['options']['border'] = $request->getPost('option_widget_border');
				}

				// Jenis Konten
				if ($data_insert['jenis_konten'] == 'kategori') 
					$data_insert['options']['kategori_id'] = $request->getPost('option_kategori_artikel');
				if ($data_insert['jenis_konten'] == 'penulis')
					$data_insert['options']['penulis'] = $request->getPost('option_penulis');
				if ($data_insert['jenis_konten'] == 'featured') 
					$data_insert['options']['featured'] = explode('|', $request->getPost('option_featured'));
				if ($data_insert['jenis_konten'] == 'mitra-kategori')
					$data_insert['options']['kategori_usaha'] = $request->getPost('option_kategori_usaha');
				if ($data_insert['jenis_konten'] == 'mitra-featured')
					$data_insert['options']['mitra_featured'] = explode('|', $request->getPost('option_mitra_featured'));

				// View
				if ($data_insert['view'] != 'carousel' || $data_insert['view'] != 'card-thumbnail')
					$data_insert['options']['baca_selengkapnya'] = (($request->getPost('option_baca_selengkapnya') == 'true') ? true : false);
				if ($data_insert['view'] == 'carousel' || $data_insert['view'] == 'card-thumbnail-slider' || $data_insert['view'] == 'mitra-slider')
					$data_insert['options']['durasi'] = strval($request->getPost('option_durasi') * 1000);

				$data_insert['lebar_lg'] = $request->getPost('lebar_lg');
				$data_insert['lebar_md'] = $request->getPost('lebar_md');
				$data_insert['lebar_sm'] = $request->getPost('lebar_sm');
				$data_insert['lebar_xs'] = $request->getPost('lebar_xs');
				$data_insert['halaman'] = $request->getPost('halaman');
				$data_insert['row'] = $request->getPost('row');
				$data_insert['urutan_col'] = $request->getPost('urutan_col');
				$data_insert['kelas'] = $request->getPost('kelas'); 
				$data_insert['options'] = json_encode($data_insert['options']);

				$tataLetakModel->insert($data_insert);

				$artikelModel = new \App\Models\ArtikelModel();
				$mitraModel = new \App\Models\MitraModel();
				$artikel_terbaru = $artikelModel->orderBy('id', 'desc')->first();
				$mitra_terbaru = $mitraModel->orderBy('id', 'desc')->first();

				$link_preview = base_url();
				if ($data_insert['halaman'] == 'homepage') 
					$link_preview = base_url();
				else if ($data_insert['halaman'] == 'list-artikel')
					$link_preview = site_url('terkini');
				else if ($data_insert['halaman'] == 'detail-artikel')
					$link_preview = site_url($artikel_terbaru['slug']);
				else if ($data_insert['halaman'] == 'detail-mitra')
					$link_preview = site_url('mitra/' . $mitra_terbaru['id']);



				$json['inserted_id'] = $tataLetakModel->getInsertID();
				$json['status'] = 'success';
				$json['text'] = "Tata Letak berhasil diperbarui<br/><a class='text-white' href='" .$link_preview. "' target='preview_website'><i class='fas fa-external-link-alt mr-2'></i>Lihat Website</a>";
				$json['icon'] = 'fas fa-thumbs-up';
				$json['color'] = 'default';
				echo json_encode($json);
			}
			else if ($mode == 'modify') {
				$id = $request->getPost('id');
				$data_modify['penempatan'] = $request->getPost('penempatan');
				$data_modify['judul'] = $request->getPost('judul');
				$data_modify['jenis_konten'] = $request->getPost('jenis_konten');
				$data_modify['view'] = $request->getPost('view');

				$data_modify['options'] = [];
				$data_modify['options']['limit'] = $request->getPost('option_limit');

				// Penempatan
				if ($data_modify['penempatan'] == 'widget') {
					$data_modify['options']['background'] = $request->getPost('option_widget_background');
					$data_modify['options']['color'] = $request->getPost('option_widget_color');
					$data_modify['options']['border'] = $request->getPost('option_widget_border');
				}

				// Jenis Konten
				if ($data_modify['jenis_konten'] == 'kategori') 
					$data_modify['options']['kategori_id'] = $request->getPost('option_kategori_artikel');
				if ($data_modify['jenis_konten'] == 'penulis')
					$data_modify['options']['penulis'] = $request->getPost('option_penulis');
				if ($data_modify['jenis_konten'] == 'featured') 
					$data_modify['options']['featured'] = explode('|', $request->getPost('option_featured'));
				if ($data_modify['jenis_konten'] == 'mitra-kategori')
					$data_modify['options']['kategori_usaha'] = $request->getPost('option_kategori_usaha');
				if ($data_modify['jenis_konten'] == 'mitra-featured')
					$data_modify['options']['mitra_featured'] = explode('|', $request->getPost('option_mitra_featured'));

				// View
				if ($data_modify['view'] != 'carousel' || $data_modify['view'] != 'card-thumbnail')
					$data_modify['options']['baca_selengkapnya'] = (($request->getPost('option_baca_selengkapnya') == 'true') ? true : false);
				if ($data_modify['view'] == 'carousel' || $data_modify['view'] == 'card-thumbnail-slider' || $data_modify['view'] == 'mitra-slider')
					$data_modify['options']['durasi'] = strval($request->getPost('option_durasi') * 1000);

				$data_modify['lebar_lg'] = $request->getPost('lebar_lg');
				$data_modify['lebar_md'] = $request->getPost('lebar_md');
				$data_modify['lebar_sm'] = $request->getPost('lebar_sm');
				$data_modify['lebar_xs'] = $request->getPost('lebar_xs');
				$data_modify['halaman'] = $request->getPost('halaman');
				$data_modify['row'] = $request->getPost('row');
				$data_modify['urutan_col'] = $request->getPost('urutan_col');
				$data_modify['kelas'] = $request->getPost('kelas'); 
				$data_modify['options'] = json_encode($data_modify['options']);

				$tataLetakModel->update($id, $data_modify);
				
				$artikelModel = new \App\Models\ArtikelModel();
				$mitraModel = new \App\Models\MitraModel();
				$artikel_terbaru = $artikelModel->orderBy('id', 'desc')->first();
				$mitra_terbaru = $mitraModel->orderBy('id', 'desc')->first();

				$link_preview = base_url();
				if ($data_modify['halaman'] == 'homepage') 
					$link_preview = base_url();
				else if ($data_modify['halaman'] == 'list-artikel')
					$link_preview = site_url('terkini');
				else if ($data_modify['halaman'] == 'detail-artikel')
					$link_preview = site_url($artikel_terbaru['slug']);
				else if ($data_modify['halaman'] == 'detail-mitra')
					$link_preview = site_url('mitra/' . $mitra_terbaru['id']);

				$json['id'] = $id;
				$json['status'] = 'success';
				$json['text'] = "Tata Letak berhasil diperbarui<br/><a class='text-white' href='" .$link_preview. "' target='preview_website'><i class='fas fa-external-link-alt mr-2'></i>Lihat Website</a>";
				$json['icon'] = 'fas fa-thumbs-up';
				$json['color'] = 'default';
				echo json_encode($json);
			}
			else if ($mode == 'moveup') {
				$element_type = $request->getPost('mode');
				$tataLetakModel = new \App\Models\TataLetakModel();
				if ($element_type == 'row') {
					$row = $request->getPost('row');
					$penempatan = $request->getPost('penempatan');
					$halaman = $request->getPost('halaman');

					$tataLetakUpperReference = $tataLetakModel
						->where('penempatan', $penempatan)						
						->where('halaman', $halaman)
						->where('row <', $row)
						->orderBy('row', 'desc')
						->first();
					$dataTataLetakActual = $tataLetakModel
						->where('penempatan', $penempatan)						
						->where('halaman', $halaman)
						->where('row', $row)
						->findAll();
					$dataTataLetakUpper = $tataLetakModel
						->where('penempatan', $penempatan)						
						->where('halaman', $halaman)
						->where('row', $tataLetakUpperReference['row'])
						->findAll();
					$tataLetakActualID = -1;
					foreach ($dataTataLetakActual as $tataLetakActual) {
						$tataLetakActualID = $tataLetakActual['id'];
						$tataLetakModel->update($tataLetakActual['id'], ['row' => $tataLetakUpperReference['row']]);
					}
					foreach ($dataTataLetakUpper as $tataLetakUpper) {
						$tataLetakModel->update($tataLetakUpper['id'], ['row' => $row]);
					}
					$halaman = $tataLetakUpperReference['halaman'];
					$json['affected_id'] = $tataLetakActualID;
				}
				else if ($element_type == 'col') {
					$id = $request->getPost('id');
					$tataLetak = $tataLetakModel->find($id);
					$tataLetakUpper = $tataLetakModel
						->where('penempatan', $tataLetak['penempatan'])						
						->where('halaman', $tataLetak['halaman'])
						->where('row', $tataLetak['row'])
						->where('urutan_col <', $tataLetak['urutan_col'])
						->orderBy('urutan_col', 'desc')
						->first();
					$tataLetakModel->update($tataLetak['id'], ['urutan_col' => $tataLetakUpper['urutan_col']]);
					$tataLetakModel->update($tataLetakUpper['id'], ['urutan_col' => $tataLetak['urutan_col']]);
					$json['affected_id'] = $tataLetak['id'];
					$halaman = $tataLetak['halaman'];
				}

				$artikelModel = new \App\Models\ArtikelModel();
				$mitraModel = new \App\Models\MitraModel();
				$artikel_terbaru = $artikelModel->orderBy('id', 'desc')->first();
				$mitra_terbaru = $mitraModel->orderBy('id', 'desc')->first();

				$link_preview = base_url();
				if ($halaman == 'homepage') 
					$link_preview = base_url();
				else if ($halaman == 'list-artikel')
					$link_preview = site_url('terkini');
				else if ($halaman == 'detail-artikel')
					$link_preview = site_url($artikel_terbaru['slug']);
				else if ($halaman == 'detail-mitra')
					$link_preview = site_url('mitra/' . $mitra_terbaru['id']);


				$json['status'] = 'success';
				$json['text'] = "Tata Letak berhasil diperbarui<br/><a class='text-white' href='" .$link_preview. "' target='preview_website'><i class='fas fa-external-link-alt mr-2'></i>Lihat Website</a>";
				$json['icon'] = 'fas fa-thumbs-up';
				$json['color'] = 'default';
				echo json_encode($json);
			}
			else if ($mode == 'movedown') {
				$element_type = $request->getPost('mode');
				$tataLetakModel = new \App\Models\TataLetakModel();
				if ($element_type == 'row') {
					$row = $request->getPost('row');
					$penempatan = $request->getPost('penempatan');
					$halaman = $request->getPost('halaman');
					$tataLetakUpperReference = $tataLetakModel
						->where('penempatan', $penempatan)						
						->where('halaman', $halaman)
						->where('row >', $row)
						->orderBy('row', 'asc')
						->first();
					$dataTataLetakActual = $tataLetakModel
						->where('penempatan', $penempatan)						
						->where('halaman', $halaman)
						->where('row', $row)
						->findAll();
					$dataTataLetakUpper = $tataLetakModel
						->where('penempatan', $penempatan)						
						->where('halaman', $halaman)
						->where('row', $tataLetakUpperReference['row'])
						->findAll();
					$tataLetakActualID = -1;
					foreach ($dataTataLetakActual as $tataLetakActual) {
						$tataLetakActualID = $tataLetakActual['id'];
						$tataLetakModel->update($tataLetakActual['id'], ['row' => $tataLetakUpperReference['row']]);
					}
					foreach ($dataTataLetakUpper as $tataLetakUpper) {
						$tataLetakModel->update($tataLetakUpper['id'], ['row' => $row]);
					}
					$json['affected_id'] = $tataLetakActualID;
					$halaman = $tataLetakUpperReference['halaman'];
				}
				else if ($element_type == 'col') {
					$id = $request->getPost('id');
					$tataLetak = $tataLetakModel->find($id);
					$tataLetakLower = $tataLetakModel
						->where('penempatan', $tataLetak['penempatan'])						
						->where('halaman', $tataLetak['halaman'])
						->where('row', $tataLetak['row'])
						->where('urutan_col >', $tataLetak['urutan_col'])
						->orderBy('urutan_col', 'asc')
						->first();
					$tataLetakModel->update($tataLetak['id'], ['urutan_col' => $tataLetakLower['urutan_col']]);
					$tataLetakModel->update($tataLetakLower['id'], ['urutan_col' => $tataLetak['urutan_col']]);
					$json['affected_id'] = $tataLetak['id'];
					$halaman = $tataLetak['halaman'];
				}

				$artikelModel = new \App\Models\ArtikelModel();
				$mitraModel = new \App\Models\MitraModel();
				$artikel_terbaru = $artikelModel->orderBy('id', 'desc')->first();
				$mitra_terbaru = $mitraModel->orderBy('id', 'desc')->first();

				$link_preview = base_url();
				if ($halaman == 'homepage') 
					$link_preview = base_url();
				else if ($halaman == 'list-artikel')
					$link_preview = site_url('terkini');
				else if ($halaman == 'detail-artikel')
					$link_preview = site_url($artikel_terbaru['slug']);
				else if ($halaman == 'detail-mitra')
					$link_preview = site_url('mitra/' . $mitra_terbaru['id']);


				$json['status'] = 'success';
				$json['text'] = "Tata Letak berhasil diperbarui<br/><a class='text-white' href='" .$link_preview. "' target='preview_website'><i class='fas fa-external-link-alt mr-2'></i>Lihat Website</a>";
				$json['icon'] = 'fas fa-thumbs-up';
				$json['color'] = 'default';
				echo json_encode($json);
			}
			else if ($mode == 'delete') {
				$id = $request->getPost('id');
				if ($id != '') {
					$tataLetak = $tataLetakModel->find($id);
					if ($tataLetak != '') {
						// Jika ada element dengan urutan col lebih banyak, element tersebut dikurangi 1
						$dataTataLetakUpperCol = $tataLetakModel
							->where('urutan_col >', $tataLetak['urutan_col'])
							->where('row', $tataLetak['row'])
							->where('penempatan', $tataLetak['penempatan'])
							->where('halaman', $tataLetak['halaman'])
							->findAll();
						foreach ($dataTataLetakUpperCol as $tataLetakUpper) {
							$tataLetakModel->update($tataLetakUpper['id'], ['urutan_col' => $tataLetakUpper['urutan_col'] - 1]);
						}

						$tataLetakModel->delete($tataLetak['id']);
						// Jika setelah dihapus, sudah tidak ada element yang ada di row yang sama maka row diatasnya dikurangi 1
						$countTataLetakSameRow = $tataLetakModel
							->where('row', $tataLetak['row'])
							->where('penempatan', $tataLetak['penempatan'])
							->where('halaman', $tataLetak['halaman'])
							->countAllResults();
						if ($countTataLetakSameRow <= 0) {
							$dataTataLetakUpperRow = $tataLetakModel
								->where('row >', $tataLetak['row'])
								->where('halaman', $tataLetak['halaman'])
								->where('penempatan', $tataLetak['penempatan'])
								->findAll();
							// print_r($dataTataLetakUpperRow);
							foreach ($dataTataLetakUpperRow as $tataLetakUpper) {
								$tataLetakModel->update($tataLetakUpper['id'], ['row' => $tataLetakUpper['row'] - 1]);
							}
						}

						$artikelModel = new \App\Models\ArtikelModel();
						$mitraModel = new \App\Models\MitraModel();
						$artikel_terbaru = $artikelModel->orderBy('id', 'desc')->first();
						$mitra_terbaru = $mitraModel->orderBy('id', 'desc')->first();
						
						$link_preview = base_url();
						if ($tataLetak['halaman'] == 'homepage') 
							$link_preview = base_url();
						else if ($tataLetak['halaman'] == 'list-artikel')
							$link_preview = site_url('terkini');
						else if ($tataLetak['halaman'] == 'detail-artikel')
							$link_preview = site_url($artikel_terbaru['slug']);
						else if ($tataLetak['halaman'] == 'detail-mitra')
							$link_preview = site_url('mitra/' . $mitra_terbaru['id']);


						$json['status'] = 'success';
						$json['text'] = "Tata Letak berhasil diperbarui<br/><a class='text-white' href='" .$link_preview. "' target='preview_website'><i class='fas fa-external-link-alt mr-2'></i>Lihat Website</a>";
						$json['icon'] = 'fas fa-thumbs-up';
						$json['color'] = 'default';
						echo json_encode($json);
					}
					else {
						echo json_encode(['status' => 'error', 'message' => 'Data layout tidak ditemukan']);
					}
				}
				else {
					echo json_encode(['status' => 'error', 'message' => 'Id tidak ada']);
				}
			}
			die;
		} // End Ajax Checker
	}

	/* -------------------------------------------------------------------------
	 * Request Ajax : Daftar Artikel
	 * Catatan 		: bisa custom view, view tersimpan di admin/postingan/artikel/ajax/
  	 * ------------------------------------------------------------------------- */
	public function ajax_list_artikel($ui)
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
				$not_in_id = $request->getGet('notInId');
				$id_array = explode('|', $not_in_id);
				if (is_array($id_array)) {
				 	$artikelFiltered->whereNotIn('id', $id_array);
				} 

				$artikelFiltered->orderBy('id', 'desc');
				$data['data'] = $artikelFiltered->findAll($data['limit'], $data['offset']);
				return view('admin/tata_letak/ajax/' . $ui, $data);
			}
		}
	}

	/* -------------------------------------------------------------------------
	 * Request Ajax : Daftar Artikel
	 * Catatan 		: bisa custom view, view tersimpan di admin/tata_letak/ajax/
  	 * ------------------------------------------------------------------------- */
	public function ajax_list_mitra($ui)
	{
		// if ($this->request->isAJAX()) {
			
			$data['userdata'] = $this->auth();
			if (!$data['userdata']) {
				return redirect()->to(site_url('logout'));
			}

			$request = $this->request;
			if ($ui != 'single') {

				$mitraFiltered = new \App\Models\MitraModel();
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
					$mitraFiltered->like('jenis_usaha', $jenis_usaha, 'both');
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

				$not_in_id = $request->getGet('notInId');
				$id_array = explode('|', $not_in_id);
				if (is_array($id_array)) {
				 	$mitraFiltered->whereNotIn('id', $id_array);
				} 

				$mitraFiltered->orderBy('id', 'desc');
				$data['data_mitra'] = $mitraFiltered->findAll($data['limit'], $data['offset']);
				return view('admin/tata_letak/ajax/' . $ui, $data);
			}
		// }
	}
}