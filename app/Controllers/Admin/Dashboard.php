<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\MitraModel;
use DateTime;
use DateInterval;
use DatePeriod;

class Dashboard extends Controller
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

	public function index()
	{
		$konfigurasiModel = new \App\Models\KonfigurasiModel();
		$data['konfigurasi'] = $konfigurasiModel->showKeyValue();
		$data['userdata'] = $this->auth();
		if (!$data['userdata']) {
			return redirect()->to(site_url('logout'));
		}
		$data['ui_js'] = [
			"js/dynamic-img.js",
			"lib/chartjs/chart.min.js",
			"lib/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js",
		];
		$data['ui_title'] = "Dashboard - Administrator";
		$data['ui_sidebar'] = [
			"Dashboard|fas fa-tachometer-alt|primary|admin",
			"Postingan|fas fa-newspaper|primary|admin/postingan/artikel",
			"Data Mitra|fas fa-store|primary|admin/mitra",
			"Pengguna|fas fa-users|primary|admin/pengguna",
			"Tata Letak|fas fa-ruler-combined|primary|admin/tataletak",
			"Konfigurasi|fas fa-cog|primary|admin/konfigurasi",
		];
		$data['ui_sidebar_active'] = 'Dashboard';

		$data['ui_navbar'] = ['||'];
		$data['validation'] = \Config\Services::validation();
		$data['ui_navbar_active'] = "List Akun Admin";

		$date_sekarang = new DateTime();
		$date_besok = new DateTime();
		$date_besok->modify('+1 Day');
		$date_seminggu_lalu = new DateTime();
		$date_seminggu_lalu->modify('-1 Week');
		$date_kemarin = new DateTime();
		$date_kemarin->modify('-1 Day');
		$date_sebulan_lalu = new DateTime();
		$date_sebulan_lalu->modify('-1 Month');

		$mitraModel = new \App\Models\MitraModel();
		$mitra = $mitraModel->select('COUNT(*) as jumlah_mitra')->first();
		$mitra_seminggu = $mitraModel->select('COUNT(*) as jumlah_mitra')
			->where("created_at BETWEEN \"" .$date_seminggu_lalu->format('Y-m-d'). "\" AND \"" .$date_besok->format('Y-m-d')."\"")->first();
		$data['jumlah_mitra'] = $mitra['jumlah_mitra'];
		$data['jumlah_mitra_seminggu'] = $mitra_seminggu['jumlah_mitra'];

		$artikelModel = new \App\Models\ArtikelModel();
		$artikel = $artikelModel->select('COUNT(*) as jumlah_artikel')->first();
		$artikel_seminggu = $artikelModel->select('COUNT(*) as jumlah_artikel')
			->where("created_at BETWEEN \"" .$date_seminggu_lalu->format('Y-m-d'). "\" AND \"" .$date_besok->format('Y-m-d')."\"")->first();
		$data['jumlah_artikel'] = $artikel['jumlah_artikel'];
		$data['jumlah_artikel_seminggu'] = $artikel_seminggu['jumlah_artikel'];

		$mitra_kecamatan = $mitraModel->select("COUNT(DISTINCT(kecamatan)) AS jumlah_kecamatan")->first();
		$data['jumlah_kecamatan'] = $mitra_kecamatan['jumlah_kecamatan'];

		$adminModel = new AdminModel();
		$admin = $adminModel->select("COUNT(*) as jumlah_admin")->first();
		$data['jumlah_admin'] = $admin['jumlah_admin'];

		$pageViewModel = new \App\Models\PageViewModel(); 
		$view_sehari = $pageViewModel->select("COUNT(id) as jumlah_view")
			->where('jenis_postingan', 'artikel')
			->where('CAST(created_at AS DATE)', $date_sekarang->format('Y-m-d'))
			->first();
		$data['view_sehari'] = $view_sehari['jumlah_view'];
		$view_kemarin = $pageViewModel->select("COUNT(id) as jumlah_view")
			->where('jenis_postingan', 'artikel')
			->where('CAST(created_at AS DATE)', $date_kemarin->format('Y-m-d'))
			->first();
		$data['view_kemarin'] = $view_kemarin['jumlah_view'];
		$view_sebulan = $pageViewModel->select("COUNT(id) as jumlah_view")
			->where('jenis_postingan', 'artikel')
			->where("created_at BETWEEN \"" . $date_sebulan_lalu->format('Y-m-d') . "\" AND \"" . $date_besok->format('Y-m-d') . "\"")
			->first();
		$data['view_sebulan'] = $view_sebulan['jumlah_view'];

		$data['data_admin'] = $adminModel->orderBy('nama_lengkap', 'asc')->findAll();
		return view('admin/dashboard/index', $data);
	}



	public function ajax_penayangan()
	{
		$request = $this->request;
		if ($request->isAJAX()) {
			$tanggal_awal = new DateTime();
			$tanggal_akhir = new DateTime();
			$tanggal_akhir->modify('+1 Day');
			$periode = $request->getGet('periode');
			if ($periode == 'seminggu')
				$tanggal_awal->modify('-1 Week');
			else if ($periode == 'sebulan')
				$tanggal_awal->modify('-1 Month');

			$pageViewModel = new \App\Models\PageViewModel();
			$json['labels'] = [];
			$json['data'] = [];

			$interval = new DateInterval('P1D');
			$rentang = new DatePeriod($tanggal_awal, $interval, $tanggal_akhir);
			foreach ($rentang as $tanggal) {
				$pageView = $pageViewModel->select("COUNT(id) as jumlah_view")
					->where('jenis_postingan', 'artikel')
					->where('CAST(created_at AS DATE)', $tanggal->format('Y-m-d'))
					->first();
				$json['labels'][] = $tanggal->format('d-m-Y');
				$json['data'][] = $pageView['jumlah_view'];
			}
			echo json_encode($json);
		}
	}

	public function ajax_browser()
	{
		$request = $this->request;
		if ($request->isAJAX()) {
			
			$pageViewModel = new \App\Models\PageViewModel();
			$data_page_view = $pageViewModel->select('client_browser, COUNT(client_browser) AS jumlah_view')->groupBy('client_browser')->findAll();
			
			$json['labels'] = [];
			$json['data'] = [];
			foreach ($data_page_view as $page_view) {
				$json['labels'][] = $page_view['client_browser'];
				$json['data'][] = $page_view['jumlah_view'];
			}
			echo json_encode($json);
		}
	}
	public function ajax_referer()
	{
		$request = $this->request;
		if ($request->isAJAX()) {
			$pageViewModel = new \App\Models\PageViewModel();
			$data_page_view = $pageViewModel->select('client_referer, COUNT(client_referer) AS jumlah_view')->groupBy('client_referer')->orderBy('jumlah_view')->findAll();
			
			$json['labels'] = [];
			$json['data'] = [];
			foreach ($data_page_view as $page_view) {
				$json['labels'][] = $page_view['client_referer'];
				$json['data'][] = $page_view['jumlah_view'];
			}
			echo json_encode($json);
		}
	}
}

?>