<?php 
    if (isset($ui_css)) {
        if (is_array($ui_css)) {
            foreach ($ui_css as $css) {
?>
<link rel="stylesheet" type="text/css" href="<?=site_url($css)?>">
<?php 
            }
        }
    }
?>
<?php 
	$options = json_decode($element['options']);
	if ($element['view'] == 'carousel') {
		/* -------------------------------------------------------------------------------------------------
		 *	view widget: Carousel
		 * -------------------------------------------------------------------------------------------------*/
		if ($element['jenis_konten'] == 'terkini') {
			$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
		}
		else if ($element['jenis_konten'] == 'terpopuler'){
			$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->findAll($options->limit);
		}
		else if ($element['jenis_konten'] == 'kategori'){

			$data_artikel = $artikelModel->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
		}
		else if ($element['jenis_konten'] == 'featured') {
			$data_artikel = $artikelModel->find($options->featured);
		} 
		else if ($element['jenis_konten'] == 'penulis') {
			$data_artikel = $artikelModel->where('penulis_username', $options->penulis)->findAll($options->limit);
		}
?>
<div class="col-12 <?=$element['kelas']?>">
	<div class="carousel slide" id="carousel-1" style="overflow: hidden; border-radius: 16px">
		<ol class="carousel-indicators">
			<?php 
				foreach ($data_artikel as $index => $artikel) {
			?>
			<li data-target='#carousel-1' data-slide-to='<?=$index?>' <?=(($index == 0) ? "class='active'" : '')?>></li>
			<?php 
				}
			?>
		</ol>
		<div class="carousel-inner backdrop-gradient">
			<?php 
				foreach ($data_artikel as $index => $artikel) {

					// Menampilkan Gambar
					$gambar = site_url('img_unavailable.png');
					if ($artikel['daftar_gambar'] != '') {
						$data_gambar = explode('|', $artikel['daftar_gambar']);
						foreach ($data_gambar as $new_gambar) {
							$base_length = strlen(base_url());
							$file_url = substr($new_gambar, $base_length);
							if (file_exists('.' . $file_url)) {
								$gambar = $new_gambar;
							}
						}
					}
			?>
			<div class="carousel-item <?=(($index == 0) ? 'active' : '')?>">
				<img src="<?=$gambar?>">
				<div class="carousel-caption text-left">
					<div class="text-success">
						<?php 
							// Menampilkan kategori
							if ($artikel['kategori_id'] != '') {
								$data_kategori_id = explode('|', $artikel['kategori_id']);
								foreach ($data_kategori_id as $kategori_id) {
									$kategori = $kategoriModel->find($kategori_id);
						?>
						<a href="<?=(($kategori != '')? site_url('kategori/' . $kategori['slug']) : '#')?>" class="text-warning font-weight-bold"><?=(($kategori != '')? $kategori['kategori'] : '')?></a>
						<i class="fas fa-circle mx-2 text-white" style="font-size: 4pt; position: relative; bottom: 2px"></i> 
						<?php 
								}
							}
						?>
						<?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?> 
					</div>
					<a class="text-white" href="<?=site_url($artikel['slug'])?>">
						<h5 class="text-white"><?=$artikel['judul']?></h5>
					</a>
				</div>
			</div>
			<?php 
				}
			?>
			<a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div> <!-- end artikel-carousel -->
<?php 
	} // end if
	else if ($element['view'] == 'mitra-slider') {
		/* -------------------------------------------------------------------------------------------------
		 *	view widget: Mitra-slider
		 * -------------------------------------------------------------------------------------------------*/
		if ($element['jenis_konten'] == 'mitra-terkini') {
			$data_mitra = $mitraModel->findAll($options->limit);
		}
		else if ($element['jenis_konten'] == 'mitra-kategori') {
			$data_mitra = $mitraModel->like('jenis_usaha', $options->kategori_usaha, 'both')->findAll($options->limit);
		}
		else if ($element['jenis_konten'] == 'mitra-featured') {
			$data_mitra = $mitraModel->find($options->featured);
		}
?>
<div class="col-12 <?=$element['kelas']?> mb-2">
	<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
		<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$element['judul']?></h4>
		<?php 
			if (isset($options->baca_selengkapnya)) {
				if ($options->baca_selengkapnya == true && $element['jenis_konten'] != 'featured') {
		?>
		<a href="javascript:void(0)" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
		<?php 
				}
			}
		?>
	</div>
	<ul id="lightslider-mitra-1" class="light-slider" style="height: 180px; background-color: transparent;">
		<?php 
			foreach ($data_mitra as $mitra) {
				$url_gambar = '';
				if ($mitra['galeri'] != '') {
					$galeri = explode('|', $mitra['galeri']);
					if (is_array($galeri)) {
						foreach ($galeri as $gambar) {
							if (file_exists('./images/mitra/galeri/' . $gambar)) {
								$url_gambar = site_url('/images/mitra/galeri/') . $gambar;
								break;
							}
						}
					}
					else {
						if (file_exists('./images/mitra/galeri/' . $mitra['galeri'])) {
							$url_gambar = site_url('/images/mitra/galeri/') . $mitra['galeri'];
							break;
						}
					}
				}
				else {
					$url_gambar = site_url('img_unavailable.png');
				}
		?>
		<li style="overflow: hidden; height: 100%; border-radius: 24px; position: relative">
			<img class="center-crop-parent" src="<?=$url_gambar?>">
			<div class="backdrop-gradient"></div>
			<div class="caption text-left" style="bottom: -4px; line-height: 0; width: 90%">
				<a href="javascript:void(0)" class='text-white'>
					<h5 class="mb-0 text-white" style="font-size: 12pt"><?=ucwords(strtolower($mitra['merek_dagang']))?></h5>
				</a>

				<?php 
					if ($mitra['jenis_usaha'] != '') {
						$jenis_usaha = explode('|', $mitra['jenis_usaha']);
						if (is_array($jenis_usaha)) {
							foreach ($jenis_usaha as $jenis) {
								echo "<span class='badge mb-1 badge-warning p-1 font-weight-bold text-dark' style='font-size: 7pt'><i class='fas fa-tag'></i> $jenis</span>";
							}
						}
						else {
							echo "<span class='badge mb-1 badge-warning p-1 font-weight-bold text-dark' style='font-size: 7pt'><i class='fas fa-tag'></i> $jenis_usaha</span>";
						}
					}
					else {
						echo "-";
					}
				?>
				<span class="badge badge-success p-1 text-dark font-weight-bold mb-1" style="font-size: 7pt">
					<i class="fas fa-map-marker-alt"></i>
					<?=ucwords(strtolower($mitra['kecamatan']))?>
				</span>
			</div>
		</li>
		<?php 
			}
		?>
	</ul>
</div> <!-- end mitra -->
<?php 
	} // end view: mitra
	else if ($element['view'] == 'mini-thumbnail-title') {
		/* -------------------------------------------------------------------------------------------------
		 *	view widget: mini-thumbnail-title
		 * -------------------------------------------------------------------------------------------------*/
		$readmore_url = '';
		if ($element['jenis_konten'] == 'terkini') {
			$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
			$readmore_url = site_url('terkini');
		}
		else if ($element['jenis_konten'] == 'terpopuler'){
			$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->findAll($options->limit);
			$readmore_url = site_url('terpopuler');
		}
		else if ($element['jenis_konten'] == 'kategori'){
			$data_artikel = $artikelModel->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
			$kategori = $kategoriModel->find($options->kategori_id);
			if ($kategori != '') {
				$readmore_url = site_url('kategori/' . $kategori['slug']);
			}
		}
		else if ($element['jenis_konten'] == 'featured') {
			$data_artikel = $artikelModel->find($options->featured);
		} 
		else if ($element['jenis_konten'] == 'penulis') {
			$data_artikel = $artikelModel->where('penulis_username', $options->penulis)->findAll($options->limit);
			$readmore_url = site_url('penulis/' . $options->penulis);
		}
?>
<div class="col-12">
	<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style="border-radius: 4px">
		<div class="card-header d-flex justify-content-between align-items-center bg-<?=$options->background?> py-2">
			<div class="text-white widget-title"><?=$element['judul']?></div>
			<?php 
				if (isset($options->baca_selengkapnya)) {
					if ($options->baca_selengkapnya == true && $element['jenis_konten'] != 'featured') {
			?>
			<a href="javascript:void(0)" class="font-weight-bold text-white" style="font-size: 7pt">Lihat Selengkapnya >></a>
			<?php 
					}
				}
			?>
		</div>
		<div class="card-body p-2">
			<?php 
				foreach ($data_artikel as $artikel) {
					$gambar = site_url('img_unavailable.png');
					if ($artikel['daftar_gambar'] != '') {
						$data_gambar = explode('|', $artikel['daftar_gambar']);
						foreach ($data_gambar as $new_gambar) {
							$base_length = strlen(base_url());
							$file_url = substr($new_gambar, $base_length);
							if (file_exists('.' . $file_url)) {
								$gambar = $new_gambar;
							}
						}
					}
			?>
			<div class="row align-items-center mb-2">
				<div class="col-auto pr-0">
					<a href="javascript:void(0)">
						<div class="mr-3 artikel-thumbnail" style="overflow: hidden; border-radius: 16px">
							<img class="center-crop" src="<?=$gambar?>">
						</div>
					</a>
				</div>
				<div class="col pl-0">
					<a href="javascript:void(0)">
						<h5 class="mb-0" style="font-size: 10pt;font-weight: bold;"><?=substr($artikel['judul'], 0, 61) . ((strlen($artikel['judul']) > 61) ? '...' : '')?></h5>
					</a>
					<?php 
					if ($artikel['kategori_id'] != '') {
						$kategori_id_array = explode('|', $artikel['kategori_id']);
						foreach ($kategori_id_array as $index => $kategori_id) {
							$kategori = $kategoriModel->find($kategori_id);
							if ($kategori != '') {
								if ($index != 0)
									echo ". ";
					?>
					<a href='javascript:void(0)' class="font-weight-bold text-lpnu" style="font-size: 7pt"><?=$kategori['kategori']?></a>
					<?php 
								}
							}
						}
					?>
				</div>
			</div>
			<?php 
				}
			?>
		</div>
	</div> <!-- end card -->
</div> <!-- end col -->
<?php 
	} // end view: mini-thumbnail-title

	else if ($element['view'] == 'card-thumbnail-slider') {
		/* -------------------------------------------------------------------------------------------------
		 *	view widget: card-thumbnail-slider
		 * -------------------------------------------------------------------------------------------------*/
		$readmore_url = '';
		if ($element['jenis_konten'] == 'terkini') {
			$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
			$readmore_url = site_url('terkini');
		}
		else if ($element['jenis_konten'] == 'terpopuler'){
			$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->findAll($options->limit);
			$readmore_url = site_url('terpopuler');
		}
		else if ($element['jenis_konten'] == 'kategori'){
			$data_artikel = $artikelModel->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
			$kategori = $kategoriModel->find($options->kategori_id);
			if ($kategori != '') {
				$readmore_url = site_url('kategori/' . $kategori['slug']);
			}
		}
		else if ($element['jenis_konten'] == 'featured') {
			$data_artikel = $artikelModel->find($options->featured);
		} 
		else if ($element['jenis_konten'] == 'penulis') {
			$data_artikel = $artikelModel->where('penulis_username', $options->penulis)->findAll($options->limit);
			$readmore_url = site_url('penulis/' . $options->penulis);
		}
?>
<div class="col-12 pb-2">
	<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
		<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$element['judul']?></h4>
		<?php 
			if (isset($options->baca_selengkapnya)) {
				if ($options->baca_selengkapnya == true && $element['jenis_konten'] != 'featured') {
		?>
		<a href="javascript:void(0)" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
		<?php 
				}
			}
		?>
	</div>
	<ul id="lightslider-postingan-1" class="light-slider" style="height: 180px; background-color: transparent;">
		<?php 
			foreach ($data_artikel as $artikel) {
				$gambar = site_url('img_unavailable.png');
				if ($artikel['daftar_gambar'] != '') {
					$data_gambar = explode('|', $artikel['daftar_gambar']);
					foreach ($data_gambar as $new_gambar) {
						$base_length = strlen(base_url());
						$file_url = substr($new_gambar, $base_length);
						if (file_exists('.' . $file_url)) {
							$gambar = $new_gambar;
						}
					}
				}
		?>

		<li style="overflow: hidden; height: 100%; border-radius: 24px; position: relative">
			<img class="center-crop-parent" src="<?=$gambar?>">
			<div class="backdrop-gradient"></div>
			<div class="caption text-left" style="bottom: -4px; line-height: 12px; width: 90%">
				<span href="javascript:void(0)" class="text-success font-weight-bold" style="font-size: 7pt"><?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?></span>
				<a href="javascript:void(0)" class='text-white'>
					<h5 class="mb-0 text-white" style="font-size: 9pt; white-space: pre-wrap;"><?=$artikel['judul']?></h5>
				</a>
			</div>
		</li>
		<?php 
			}
		?>
	</ul>
</div> <!-- end mitra -->
<?php 
	} // end view: text-only
	else if ($element['view'] == 'text-only') {
		/* -------------------------------------------------------------------------------------------------
		 *	view widget: text-only
		 * -------------------------------------------------------------------------------------------------*/
		$readmore_url = '';
		if ($element['jenis_konten'] == 'terkini') {
			$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
			$readmore_url = site_url('terkini');
		}
		else if ($element['jenis_konten'] == 'terpopuler'){
			$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->findAll($options->limit);
			$readmore_url = site_url('terpopuler');
		}
		else if ($element['jenis_konten'] == 'kategori'){
			$data_artikel = $artikelModel->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
			$kategori = $kategoriModel->find($options->kategori_id);
			if ($kategori != '') {
				$readmore_url = site_url('kategori/' . $kategori['slug']);
			}
		}
		else if ($element['jenis_konten'] == 'featured') {
			$data_artikel = $artikelModel->find($options->featured);
		} 
		else if ($element['jenis_konten'] == 'penulis') {
			$data_artikel = $artikelModel->where('penulis_username', $options->penulis)->findAll($options->limit);
			$readmore_url = site_url('penulis/' . $options->penulis);
		}
?>
<div class="col-12 <?=$element['kelas']?> pb-2">
	<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style='border-radius: 4px'>
		<div class="card-header d-flex justify-content-between align-items-center py-2 bg-<?=((isset($options->background)) ? $options->background : 'white')?>">
			<div class="mb-0 widget-title card-title text-<?=((isset($options->color)) ? $options->color : 'dark')?>"><?=$element['judul']?></div>
			<?php 
				if (isset($options->baca_selengkapnya)) {
					if ($options->baca_selengkapnya == true && $element['jenis_konten'] != 'featured') {
			?>
			<a href="javascript:void(0)" class="font-weight-bold text-<?=((isset($options->color)) ? $options->color : 'dark')?>" style="font-size: 7pt">Lihat Selengkapnya >> </a>
			<?php
					}
				}
			?>
		</div>
		<div class="card-body py-0">
			
	<?php 
			foreach ($data_artikel as $artikel) {
	?>
			<div class="row border-bottom py-2">
				<div class="col">
					<a href="javascript:void(0)" class="text-dark">
						<h5 class="mb-0" style="font-size: 10pt;font-weight: bold;"><?=$artikel['judul']?></h5>
					</a> 
					<div class="font-weight-bold text-lpnu d-flex align-items-center" style="font-size: 7pt">
						<?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?> 
						<i class="fas fa-circle text-dark px-2" style="font-size: 4pt"></i>
						<?php 
							if ($artikel['kategori_id'] != '') {
								$kategori_id_array = explode('|', $artikel['kategori_id']);
								foreach ($kategori_id_array as $index => $kategori_id) {
									$kategori = $kategoriModel->find($kategori_id);
									if ($kategori != '') {
										if ($index != 0)
						?>
						<a href='javascript:void(0)' class="font-weight-bold">
							<span class="badge badge-warning p-1 text-dark font-weight-bold mr-1 mb-0">
								<i class="fas fa-tag"></i> 
								<?=$kategori['kategori']?>
							</span>
						</a>
						<?php 
									}
								}
							}
						?>
					</div>
				</div>
			</div>
	<?php 
			}
	?>
		</div>
	</div>
</div> <!-- end col view: text-only -->
<?php 
	} // end view widget: text-only
	else if ($element['view'] == "kalender") {
		/* -------------------------------------------------------------------------------------------------
		 *	view widget: text-only
		 * -------------------------------------------------------------------------------------------------*/
?>
<div class="col mb-2 <?=$element['kelas']?>">
	<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style='border-radius: 4px'>
		<div class="card-header py-2 bg-<?=((isset($options->background)) ? $options->background : 'white')?>">
			<div class="card-title widget-title mb-0 text-<?=((isset($options->color)) ? $options->color : 'dark')?>"><?=$element['judul']?></div>
		</div>
		<div class="card-body p-0">
			<div id="calendar-container-1">
			</div>
		</div>
	</div>
</div>
<?php 
	}
	else if ($element['view'] == 'arsip') {
		/* -------------------------------------------------------------------------------------------------
		 *	view widget: Arsip
		 * -------------------------------------------------------------------------------------------------*/
		$data_tahun = $artikelModel->select("DISTINCT(YEAR(created_at)) AS year")->orderBy('year', 'desc')->findAll();
?>
<div class="col">
	<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style='border-radius: 4px; <?=((isset($options->border) && $options->border == 'secondary') ? 'border-color: #6c757d !important;' : '')?>'>
		<div class="card-header py-2 bg-<?=((isset($options->background)) ? $options->background : 'white')?>" style="<?=((isset($options->background) && $options->background == 'secondary') ? 'background: #6c757d !important;' : '')?>">
			<div class="card-title widget-title mb-0 text-<?=((isset($options->color)) ? $options->color : 'dark')?>" style="<?=((isset($options->color) && $options->color == 'secondary') ? 'color: #6c757d !important;' : '')?>"><?=$element['judul']?></div>
		</div>
		<div class="card-body p-0">
			<ul class="nav flex-column" id="accordion-1">
				<?php 
					foreach ($data_tahun as $index_tahun => $tahun) {
						$data_bulan = $artikelModel->select("DISTINCT(MONTH(created_at)) AS month")->where('YEAR(created_at)', $tahun['year'])->orderBy('month', 'desc')->findAll();

				?>
				<li class="nav-item bg-white">
					<h5 style="font-size: 9pt; cursor: pointer" class="nav-link font-weight-bold mb-0 p-3" data-toggle="collapse" data-target="#collapse-1-<?=$tahun['year']?>">2021</h5>
					<div class="collapse <?=(($index_tahun == 0) ? 'show' : '')?>" data-parent="#accordion-1" id="collapse-1-<?=$tahun['year']?>">


						<ul class="nav flex-column" id="accordion-1-<?=$tahun['year']?>">
							<?php 
								foreach ($data_bulan as $index_bulan => $bulan) {
									$data_artikel = $artikelModel->where('YEAR(created_at)', $tahun['year'])->where('MONTH(created_at)', $bulan['month'])->findAll();
							?>
							<li class="nav-item bg-white pl-2">
								<h5 style="font-size: 9pt; cursor: pointer" class="nav-link font-weight-bold mb-0 p-3" data-toggle="collapse" data-target="#collapse-1-<?=$tahun['year']?>-<?=$bulan['month']?>">
									<i class="fas fa-calendar mr-2"></i>
									<?=$nama_bulan[$bulan['month'] - 1]?>											
								</h5>
								<div class="collapse <?=(($index_bulan == 0) ? 'show' : '')?>" data-parent="#accordion-1-<?=$tahun['year']?>" id="collapse-1-<?=$tahun['year']?>-<?=$bulan['month']?>">
									<ul class="nav flex-column">
										<?php 
											foreach ($data_artikel as $artikel) {
										?>
										<li class="nav-item">
											<a href="javascript:void(0)" class="nav-link bg-dark" style="color: white !important; font-size: 8pt; font-weight: bold">
												<i class="fas fa-chevron-right mr-2"></i>
												<?=$artikel['judul']?>
											</a>
										</li>
										<?php
											}
										?>
									</ul>
								</div>
							</li>
							<?php 
								}
							?>
						</ul>
					</div>
				</li>
				<?php 
					}
				?>
			</ul>	
		</div>
	</div>
</div>
<?php 
	}
?>

<script src="<?=site_url('js/default.js')?>" type="text/javascript"></script>
<script src="<?=site_url('js/dynamic-img.js?v=3')?>" type="text/javascript"></script>
<?php 
    if (isset($ui_js)) {
        if (is_array($ui_js)) {
            foreach ($ui_js as $js) {
?>
<script src="<?=site_url($js)?>"></script>
<?php 
            }
        }
    }
?>
<script type="text/javascript">
	width = $(window).width();
	if (width >= 1200) {  // XL
		itemMitra = 2
		itemArtikel = 2
		itemWidget = 2
		itemMitraWidget =  2
	}
	else if (width >= 992) { // LG
		itemMitra = 2
		itemArtikel = 2
		itemWidget = 2
		itemMitraWidget = 2
	}
	else if (width >= 768) { // MD
		itemMitra = 2
		itemArtikel = 2
		itemWidget = 2
		itemMitraWidget =  2
	}
	else {			 // SM
		itemMitra = 2
		itemArtikel = 2
		itemWidget = 2
		itemMitraWidget = 2
	}
	<?php 
		if ($element['view'] == 'carousel') {
			/* -------------------------------------------------------------------------------------------------
			 *	view widget: Carousel
			 * -------------------------------------------------------------------------------------------------*/
			$options = json_decode($element['options']);
	?>
	$("#carousel-1").carousel({
		interval: <?=((isset($options->durasi)) ? $options->durasi : '5000')?>,
		ride: true,
	})
	var $carouselInner = $("#carousel-1 .carousel-inner")
	var $carouselItem = $("#carousel-1 .carousel-item")
	$("#carousel-1 img").one("load", function() {
	    hitungAspectRatio($(this), {width: $carouselInner.width(), height: $carouselInner.height()}, $carouselItem)
	}).each(function() {
	    hitungAspectRatio($(this), {width: $carouselInner.width(), height: $carouselInner.height()}, $carouselItem)
	})
	<?php 
		}
		else if ($element['view'] == 'card-thumbnail-slider') {
			/* -------------------------------------------------------------------------------------------------
			 *	view widget: card-thumbnail-slider
			 * -------------------------------------------------------------------------------------------------*/
	?>
	$("#lightslider-postingan-1").lightSlider({
		item: itemWidget,
		pager: false,
		loop: true,
		auto: true,
		pause: 5000,
		onSliderLoad: function() {
			$(".center-crop-parent").one("load", function() {
			    hitungAspectRatio($(this))
			}).each(function() {
			    hitungAspectRatio($(this))
			})
		}
	});
	<?php 
		}
		else if ($element['view'] == 'mitra-slider') {
			/* -------------------------------------------------------------------------------------------------
			 *	view widget: mitra-slider
			 * -------------------------------------------------------------------------------------------------*/
	?>
	$("#lightslider-mitra-1").lightSlider({
		item: itemMitraWidget,
		pager: false,
		loop: true,
		auto: true,
		pause: <?=((isset($options->durasi))? $options->durasi : '5000')?>,
		onSliderLoad: function() {
			$(".center-crop-parent").one("load", function() {
			    hitungAspectRatio($(this))
			}).each(function() {
			    hitungAspectRatio($(this))
			})
		}
	});
	<?php 
		}
		else if ($element['view'] == 'kalender') {
			/* -------------------------------------------------------------------------------------------------
			 *	view widget: kalender
			 * -------------------------------------------------------------------------------------------------*/
	?>
	$('#calendar-container-1').calendar({
		date: new Date(), // today
		prevButton: "<i class='fas fa-arrow-left'></i>",
		nextButton: "<i class='fas fa-arrow-right'></i>",
		showTodayButton: false,
	});
	<?php 
		}
	?>

	$(".carousel").each(function(index, el) {
		carouselWidth = parseInt($(this).width())
		carouselHeight = carouselWidth * 3 / 4
		$(this).find(".carousel-inner").css('height', carouselHeight)
		if (carouselWidth <= 400) {
			$(this).find("h5").css('font-size', '11pt');
			$(this).find("h5").css('line-height', '16px');
			$(this).find(".carousel-caption > div").css('font-size', '7pt');
		}
	});
	elementWidth = parseInt($(".ratio-4x3").width())
	elementHeight = elementWidth * 0.80
	$(".ratio-4x3").css('height', elementHeight)
	$(".center-crop").one("load", function() {
	    hitungAspectRatio($(this))
	}).each(function() {
	    hitungAspectRatio($(this))
	})
</script>