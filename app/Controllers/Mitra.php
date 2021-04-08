<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\models\MitraModel;

class Mitra extends Controller
{
	public function index()
	{
		
	}

	public function list()
	{
		
	}

	public function detail($id = false)
	{
		$mitraModel = new MitraModel();
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
}