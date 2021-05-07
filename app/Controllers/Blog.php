<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Blog extends Controller
{
	protected $sidebar;

	function __construct() {
		$this->sidebar = [
			"Home|fas fa-home|". base_url(),
			"Mitra|fas fa-list|". site_url('mitra'),
			"Dropdown" => [
				"Mitra|fas fa-list|". site_url('mitra'),
				"Mitra|fas fa-list|". site_url('mitra'),
				"Mitra|fas fa-list|". site_url('mitra')
			],
			"Visi Misi|fas fa-paper-plane|". site_url('mitra'),
			"Tentang|fas fa-info-circle|". site_url('mitra'),
			"-|fab fa-facebook|https://www.facebook.com/groups/1576452679187898/?ref=share",
			"-|fab fa-youtube|https://youtube.com/c/PENGAMBUHMALANGRAYA99",
		];
	}
	public function homepage()
	{
		$data['ui_title'] = "LPNU Malang Official website - lpnumalang.or.id";
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
}