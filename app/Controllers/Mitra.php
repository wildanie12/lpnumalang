<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\models\MitraModel;
use App\models\AdminModel;
use App\models\WilayahModel;

class Mitra extends Controller
{
	public function index()
	{
		
	}

	public function list()
	{
		$wilayahModel = new WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select('kecamatan')->distinct()->orderBy('kecamatan', 'asc')->findAll();
		$data['ui_title'] = "Toserba Mulyadi Elektro - Mitra LPNU Malang";
		$data['ui_css'] = [
			"lib/light-slider/css/lightslider.min.css"
		];
		$data['ui_js'] = [
			"lib/light-slider/js/lightslider.min.js"
		];
		$data['ui_navbar'] = [
			"Home|fas fa-home|". base_url(),
			"Mitra|fas fa-list|". site_url('mitra'),
			"LPNU Kecamatan" => [
				"Sub #1|fab fa-facebook|https://www.facebook.com/",
				"Sub #2|fab fa-twitter|https://www.twitter.com/",
				"Sub #3|fab fa-instagram|https://www.instagram.com/"
			],
			"Statistik|fas fa-chart-line|". site_url('mitra'),
		];
		return view('mitra/list', $data);
	}

	public function detail($id = false)
	{
		$mitraModel = new MitraModel();
		$data['adminModel'] = new AdminModel();
		$data['mitra'] = $mitraModel->find($id);
		if ($data['mitra'] != '') {
			$data['ui_title'] = "Toserba Mulyadi Elektro - Mitra LPNU Malang";
			$data['ui_css'] = [
				"lib/light-slider/css/lightslider.min.css"
			];
			$data['ui_js'] = [
				"lib/light-slider/js/lightslider.min.js"
			];
			$data['ui_navbar'] = [
				"Home|fas fa-home|". base_url(),
				"Mitra|fas fa-list|". site_url('mitra'),
				"LPNU Kecamatan" => [
					"Sub #1|fab fa-facebook|https://www.facebook.com/",
					"Sub #2|fab fa-twitter|https://www.twitter.com/",
					"Sub #3|fab fa-instagram|https://www.instagram.com/"
				],
				"Statistik|fas fa-chart-line|". site_url('mitra'),
			];
			return view('mitra/detail', $data);
		}
		else {
			return view('errors/html/error_404');
		}
	}

	public function dynamic_form_kelurahan()
	{
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


	public function ajax_list($ui)
	{
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
			return view('mitra/ajax/' . $ui, $data);
		}
	}
}