<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Blog extends Controller
{
	protected $sidebar;

	function __construct() {
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$navbar = $konfigurasiModel->find('APP_NAVBAR');
		$navbar = json_decode($navbar['value_text']);
		$navbar_converted = ["Beranda|fas fa-home|". base_url()];
		foreach ($navbar as $nav) {
			if (isset($nav->dropdown)) {
				$nav_dropdown = [];
				foreach ($nav->dropdown as $dropdown) {
					$nav_dropdown[] = (($dropdown->judul != '') ? $dropdown->judul : '-') . '|' . $dropdown->icon. '|' . $dropdown->url;
				}
				$navbar_converted[$nav->judul . '|' . $nav->icon] = $nav_dropdown;
			}
			else {
				$navbar_converted[] = (($nav->judul != '') ? $nav->judul : '-') . '|' . $nav->icon. '|' . $nav->url;
			}
		}
		$this->sidebar = $navbar_converted;
	}
	public function homepage()
	{
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = $data['konfigurasi']['APP_JUDUL']['value'] . " - Homepage";
		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css",
			'lib/powerful-calendar/style.css',
			'lib/powerful-calendar/theme.css'
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js",
			'lib/powerful-calendar/calendar.min.js'
		];
		$data['ui_container'] = 'container';
		$data['ui_navbar'] = $this->sidebar;

		$data['artikelModel'] = new \App\Models\ArtikelModel();
		$data['adminModel'] = new \App\Models\AdminModel();
		$data['kategoriModel'] = new \App\Models\KategoriModel();
		$data['mitraModel'] = new \App\Models\MitraModel();
		$tataLetakModel = new \App\Models\TataLetakModel();

		$data['nama_bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['nama_hari'] = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu', 'Ahad'];

		$content_max_row = $tataLetakModel->select('MAX(row) AS row')->where('penempatan', 'content')->where('halaman', 'homepage')->first();
		$widget_max_row = $tataLetakModel->select('MAX(row) AS row')->where('penempatan', 'widget')->where('halaman', 'homepage')->first();

		for ($i = 0; $i <= $content_max_row['row']; $i++) {
			$data['data_tata_letak_content'][$i] = $tataLetakModel->where('halaman', 'homepage')
														->where('penempatan', 'content')
														->where('row', $i)
														->orderBy('urutan_col', 'asc')
														->findAll();
		}
		for ($i = 0; $i <= $widget_max_row['row']; $i++) {
			$data['data_tata_letak_widget'][$i] = $tataLetakModel->where('halaman', 'homepage')
														->where('penempatan', 'widget')
														->where('row', $i)
														->orderBy('urutan_col', 'asc')
														->findAll();
		}
		return view('blog/home', $data);
	}

	public function terkini()
	{
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = $data['konfigurasi']['APP_JUDUL']['value'] . " - Terkini";
		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css",
			'lib/powerful-calendar/style.css',
			'lib/powerful-calendar/theme.css'
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js",
			'lib/powerful-calendar/calendar.min.js'
		];
		$data['ui_container'] = 'container';
		$data['ui_navbar'] = $this->sidebar;
		$data['ui_background_image'] = site_url('images/pattern-paper.jpg');
		$data['nama_bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['nama_hari'] = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu', 'Ahad'];
		$tataLetakModel = new \App\Models\TataLetakModel();
		$data['data_tata_letak_widget'] = $tataLetakModel
			->where('halaman', 'list-artikel')
			->where('penempatan', 'widget')
			->orderBy('row', 'asc')
			->findAll();
		
		$artikelModel = new \App\Models\ArtikelModel();
		$data['artikelModel'] = $artikelModel;
		$data['adminModel'] = new \App\Models\AdminModel();
		$data['kategoriModel'] = new \App\Models\KategoriModel();
		$data['data_artikel'] = $artikelModel->where('status', 'dipublikasikan')->orderBy('id', 'desc')->paginate($data['konfigurasi']['CONTENT_LIMIT_POST_TERKINI']['value'], 'artikel');
		$data['pager_artikel'] = $artikelModel->pager;

		return view('blog/terkini', $data);
	}
	public function terpopuler()
	{
		$limit = 5;
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = $data['konfigurasi']['APP_JUDUL']['value'] . " - Terpopuler";
		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css",
			'lib/powerful-calendar/style.css',
			'lib/powerful-calendar/theme.css'
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js",
			'lib/powerful-calendar/calendar.min.js'
		];
		$data['ui_container'] = 'container';
		$data['ui_navbar'] = $this->sidebar;
		$data['ui_background_image'] = site_url('images/pattern-paper.jpg');

		$data['nama_bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['nama_hari'] = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu', 'Ahad'];
		$tataLetakModel = new \App\Models\TataLetakModel();
		$data['data_tata_letak_widget'] = $tataLetakModel
			->where('halaman', 'list-artikel')
			->where('penempatan', 'widget')
			->orderBy('row', 'asc')
			->findAll();
		
		$pageViewModel = new \App\Models\PageViewModel();
		$artikelModel = new \App\Models\ArtikelModel();
		$data['artikelModel'] = $artikelModel;
		$data['adminModel'] = new \App\Models\AdminModel();
		$data['kategoriModel'] = new \App\Models\KategoriModel();

		$data['data_artikel'] = $artikelModel
			->select('COUNT(page_view.id) as jumlah_view, artikel.*')
			->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
			->groupBy('artikel.id')
			->orderBy('jumlah_view', 'desc')
			->where('status', 'dipublikasikan')
			->paginate(10, 'artikel');
		$data['pager_artikel'] = $artikelModel->pager;

		return view('blog/terpopuler', $data);
	}
	public function penulis($username)
	{
		$app_configuration = [
			'LIMIT_POST_TERKINI' => 5
		];

		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		
		$adminModel = new \App\Models\AdminModel();
		$data['penulis'] = $adminModel->find($username);

		$artikelModel = new \App\Models\ArtikelModel();
		$data['artikelModel'] = $artikelModel;
		$data['adminModel'] = new \App\Models\AdminModel();
		$data['kategoriModel'] = new \App\Models\KategoriModel();
		$data['data_artikel'] = $artikelModel->where('status', 'dipublikasikan')->orderBy('id', 'desc')->where('penulis_username', $username)->paginate($data['konfigurasi']['CONTENT_LIMIT_POST_PENULIS']['value'], 'artikel');
		$data['pager_artikel'] = $artikelModel->pager;

		$data['ui_title'] = "Artikel oleh " . $data['penulis']['nama_lengkap'] . " - " . $data['konfigurasi']['APP_JUDUL']['value'];

		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css",
			'lib/powerful-calendar/style.css',
			'lib/powerful-calendar/theme.css'
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js",
			'lib/powerful-calendar/calendar.min.js'
		];
		$data['ui_container'] = 'container';
		$data['ui_navbar'] = $this->sidebar;
		$data['ui_background_image'] = site_url('images/pattern-paper.jpg');
		$data['nama_bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['nama_hari'] = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu', 'Ahad'];
		$tataLetakModel = new \App\Models\TataLetakModel();
		$data['data_tata_letak_widget'] = $tataLetakModel
			->where('halaman', 'list-artikel')
			->where('penempatan', 'widget')
			->orderBy('row', 'asc')
			->findAll();
		return view('blog/penulis', $data);
	}
	public function kategori($kategori_slug)
	{
		$app_configuration = [
			'LIMIT_POST_TERKINI' => 5
		];

		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();

		$kategoriModel = new \App\Models\KategoriModel();
		$data['kategori'] = $kategoriModel->where('slug', $kategori_slug)->first();

		$artikelModel = new \App\Models\ArtikelModel();
		$data['artikelModel'] = $artikelModel;
		$data['adminModel'] = new \App\Models\AdminModel();
		$data['kategoriModel'] = new \App\Models\KategoriModel();
		$data['data_artikel'] = $artikelModel->where('status', 'dipublikasikan')->orderBy('id', 'desc')->like('kategori_id', $data['kategori']['id'],  'both')->paginate($data['konfigurasi']['CONTENT_LIMIT_POST_KATEGORI']['value'], 'artikel');
		$data['pager_artikel'] = $artikelModel->pager;

		$data['ui_title'] = "Artikel tentang " .$data['kategori']['kategori']. " - " . $data['konfigurasi']['APP_JUDUL']['value'];

		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css",
			'lib/powerful-calendar/style.css',
			'lib/powerful-calendar/theme.css'
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js",
			'lib/powerful-calendar/calendar.min.js'
		];
		$data['ui_container'] = 'container';
		$data['ui_navbar'] = $this->sidebar;
		$data['ui_background_image'] = site_url('images/pattern-paper.jpg');
		$data['nama_bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['nama_hari'] = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu', 'Ahad'];
		$tataLetakModel = new \App\Models\TataLetakModel();
		$data['data_tata_letak_widget'] = $tataLetakModel
			->where('halaman', 'list-artikel')
			->where('penempatan', 'widget')
			->orderBy('row', 'asc')
			->findAll();
		return view('blog/kategori', $data);
	}
	public function detail_artikel($slug)
	{
		$artikelModel = new \App\Models\ArtikelModel();
		$data['artikelModel'] = $artikelModel;
		$data['adminModel'] = new \App\Models\AdminModel();
		$data['kategoriModel'] = new \App\Models\KategoriModel();

		$data['artikel'] = $artikelModel->where('slug', $slug)->first();

		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = $data['artikel']['judul'] . ' - ' .$data['konfigurasi']['APP_JUDUL']['value'];

		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css",
			'lib/powerful-calendar/style.css',
			'lib/powerful-calendar/theme.css'
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js",
			'lib/powerful-calendar/calendar.min.js'
		];
		$data['ui_container'] = 'container';
		$data['ui_navbar'] = $this->sidebar;
		$data['ui_background_image'] = site_url('images/pattern-paper.jpg');
		$data['nama_bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['nama_hari'] = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu', 'Ahad'];
		$tataLetakModel = new \App\Models\TataLetakModel();
		$data['data_tata_letak_widget'] = $tataLetakModel
			->where('halaman', 'detail-artikel')
			->where('penempatan', 'widget')
			->orderBy('row', 'asc')
			->findAll();

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
			$browser = 'Internet explorer';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
			$browser = 'Internet explorer';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== FALSE) //For Supporting IE 11
			$browser = 'Android';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
			$browser = 'Mozilla Firefox';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
			$browser = 'Chrome';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
			$browser = "Opera Mini";
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
			$browser = "Opera";
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
			$browser = "Safari";
		else
			$browser = 'Lainnya';

		$pageViewModel = new \App\Models\PageViewModel();
		$pageViewModel->insert([
			'postingan_id' => $data['artikel']['id'],
			'jenis_postingan' => 'artikel',
			'client_ip_address' => $_SERVER['REMOTE_ADDR'],
			'client_browser' => $browser,
			'client_referer' => ((isset($_SERVER['HTTP_REFERER'])) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : 'Direct Link')
		]);

		return view('blog/detail_artikel', $data);
	}

	public function detail_halaman($slug)
	{
		$halamanModel = new \App\Models\HalamanModel();
		$data['halamanModel'] = $halamanModel;
		$data['artikelModel'] = new \App\Models\ArtikelModel();
		$data['adminModel'] = new \App\Models\AdminModel();
		$data['kategoriModel'] = new \App\Models\KategoriModel();

		$data['halaman'] = $halamanModel->where('slug', $slug)->first();

		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['ui_title'] = $data['halaman']['judul'] . ' - ' .$data['konfigurasi']['APP_JUDUL']['value'];

		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css",
			'lib/powerful-calendar/style.css',
			'lib/powerful-calendar/theme.css'
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js",
			'lib/powerful-calendar/calendar.min.js'
		];
		$data['ui_container'] = 'container';
		$data['ui_navbar'] = $this->sidebar;
		$data['ui_background_image'] = site_url('images/pattern-paper.jpg');
		$data['nama_bulan'] = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$data['nama_hari'] = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum\'at", 'Sabtu', 'Ahad'];
		$tataLetakModel = new \App\Models\TataLetakModel();
		$data['data_tata_letak_widget'] = $tataLetakModel
			->where('halaman', 'detail-artikel')
			->where('penempatan', 'widget')
			->orderBy('row', 'asc')
			->findAll();
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
			$browser = 'Internet explorer';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
			$browser = 'Internet explorer';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== FALSE) //For Supporting IE 11
			$browser = 'Android';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
			$browser = 'Mozilla Firefox';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
			$browser = 'Chrome';
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
			$browser = "Opera Mini";
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
			$browser = "Opera";
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
			$browser = "Safari";
		else
			$browser = 'Lainnya';
		$pageViewModel = new \App\Models\PageViewModel();
		$pageViewModel->insert([
			'postingan_id' => $data['halaman']['id'],
			'jenis_postingan' => 'halaman',
			'client_ip_address' => $_SERVER['REMOTE_ADDR'],
			'client_browser' => $browser,
			'client_referer' => ((isset($_SERVER['HTTP_REFERER'])) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : 'Direct Link')
		]);
		return view('blog/detail_halaman', $data);
	}
}