<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MitraModel;
use App\Models\AdminModel;
use App\Models\WilayahModel;

class Mitra extends Controller
{
	public function index()
	{
		
	}

	public function list()
	{
		$wilayahModel = new WilayahModel();
		$data['data_kecamatan'] = $wilayahModel->select('kecamatan')->distinct()->orderBy('kecamatan', 'asc')->findAll();
		$data['ui_title'] = "Mitra-mitra LPNU Malang - lpnumalang.or.id";
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
		];
		return view('mitra/list', $data);
	}

	public function detail($id = false)
	{
		$mitraModel = new MitraModel();
		$data['adminModel'] = new AdminModel();
		$data['mitra'] = $mitraModel->find($id);
		if ($data['mitra'] != '') {
			// Pemberian Judul
			$judul = '';
			if ($data['mitra']['merek_dagang'] != '') {
				$judul = $data['mitra']['merek_dagang'];
			}
			else if ($data['mitra']['nama_barang'] != '') {
				$judul = $data['mitra']['nama_barang'];
			}
			else if ($data['mitra']['jenis_usaha'] != '') {
				$jenis_usaha = explode('|', $data['mitra']['jenis_usaha']);
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

			$data['ui_title'] = $judul . " - LPNU Malang";
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