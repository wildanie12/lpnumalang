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
				 *	view: Carousel
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
	<div class="col pr-0">
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
						<div style="color: #4fffae">
							<?php 
								// Menampilkan kategori
								if ($artikel['kategori_id'] != '') {
									$data_kategori_id = explode('|', $artikel['kategori_id']);
									foreach ($data_kategori_id as $index => $kategori_id) {
										$kategori = $kategoriModel->find($kategori_id);
							?>
							<a href="<?=(($kategori != '')? site_url('kategori/' . $kategori['slug']) : '#')?>" class="font-weight-bold" style="color: #fbc658"><?=(($kategori != '')? $kategori['kategori'] : '')?></a>
							<?php 
										if ($index < count($data_kategori_id) - 1) {
							?>
							<i class="fas fa-circle mx-2 text-white" style="font-size: 2pt; position: relative; bottom: 2px"></i> 
							<?php 
										}
									}
								}
							?>
							<br/>
							<?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?> 
						</div>
						<a class="text-white" href="#">
							<h5 class="text-white" style="font-size: 10pt"><?=$artikel['judul']?></h5>
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
		else if ($element['view'] == 'card-thumbnail') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: Thumbnail Col
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

	<div class="col-md-8 pt-2 pt-md-0">
		<div class="row justify-content-center">
			<?php 
				foreach ($data_artikel as $index => $artikel) {
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
			<div class="col-lg-12 col-md-12 col-sm-4 col-6 ">
				<div href='<?=site_url($artikel['slug'])?>' class="card card-link ratio-4x3 backdrop-gradient" style="overflow: hidden; margin-bottom: 15px">
					<img class='center-crop' src="<?=$gambar?>">
					<div class="caption text-left" style="bottom: -10px; width: 90%; line-height: 13px">
						<?php 
							if ($artikel['kategori_id'] != '') {
								$data_kategori_id = explode('|', $artikel['kategori_id']);
								foreach ($data_kategori_id as $index => $kategori_id) {
									$kategori = $kategoriModel->find($kategori_id);
						?>
						<?=(($index == 0) ? '' : '.')?>
						<a href='#' class="font-weight-bold text-success" style="font-size: 7pt"><?=(($kategori != '') ? $kategori['kategori'] : '')?></a>
						<?php
								}
							}
						?>
						<a href="#" class="text-white"><h5 class="mb-0 text-white"><?=$artikel['judul']?></h5></a>
					</div>
				</div>
			</div>
			<?php 
				}
			?>
		</div>
	</div> <!-- end artikel-thumbnail -->

	<?php 
		} // end view: thumbnail-col
		else if ($element['view'] == 'mitra-slider') {
			/* -------------------------------------------------------------------------------------------------
			 *	view content: Mitra
			 * -------------------------------------------------------------------------------------------------*/
			if ($element['jenis_konten'] == 'mitra-terkini') {
				$data_mitra = $mitraModel->findAll($options->limit);
			}
			else if ($element['jenis_konten'] == 'mitra-kategori') {
				$data_mitra = $mitraModel->like('jenis_usaha', $options->kategori_usaha, 'both')->findAll($options->limit);
			}
			else if ($element['jenis_konten'] == 'mitra-featured') {
				$data_mitra = $mitraModel->find($options->mitra_featured);
			}
	?>
	<div class="col">
		<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
			<h4 class="m-2 text-dark" style="font-weight: bold; font-size: 12pt;"><?=$element['judul']?></h4>
			<?php 
				if (isset($options->baca_selengkapnya)) {
					if ($options->baca_selengkapnya == true && $element['jenis_konten'] != 'featured') {
			?>
			<a href="#" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
			<?php 
					}
				}
			?>
		</div>
		<ul id="lightslider-mitra-1" class="light-slider" style="height: 180px; background-color: transparent;">
			<?php 
				$index = 0;
				foreach ($data_mitra as $mitra) {
					$index++;
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
					<a href="#" class='text-white'>
						<h5 class="mb-0 text-white" style="font-size: 12pt"><?=ucwords(strtolower($mitra['merek_dagang']))?></h5>
					</a>

					<?php 
						if ($mitra['jenis_usaha'] != '') {
							$jenis_usaha = explode('|', $mitra['jenis_usaha']);
							if (is_array($jenis_usaha)) {
								foreach ($jenis_usaha as $jenis) {
									echo "<span class='badge badge-warning mb-1 p-1 font-weight-bold text-dark' style='font-size: 7pt'><i class='fas fa-tag'></i> $jenis</span>";
								}
							}
							else {
								echo "<span class='badge badge-warning mb-1 p-1 font-weight-bold text-dark' style='font-size: 7pt'><i class='fas fa-tag'></i> $jenis_usaha</span>";
							}
						}
						else {
							echo "-";
						}
					?>
					<span class="badge badge-success p-1 text-dark font-weight-bold" style="font-size: 7pt">
						<i class="fas fa-map-marker-alt"></i>
						<?=ucwords(strtolower($mitra['kecamatan']))?>
					</span>
				</div>
			</li>
			<?php 
				}
			?>
		</ul>
		<?php 
			if ($index <= 0) {
				echo "<h4 class='text-center rounded border border-warning p-4'>Tidak ada data mitra</h4>";
			}
		?>
	</div> <!-- end mitra -->
	<?php 
		} // end view: mitra
		else if ($element['view'] == 'mini-thumbnail-title') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: mini-thumbnail-title
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
	<div class="col pt-2">
		<div class="row">
			<div class="col d-flex justify-content-between align-items-center">
				<h4 style="font-weight: bold; font-size: 12pt;" class="m-2"><?=$element['judul']?></h4>
				<?php 
					if (isset($options->baca_selengkapnya)) {
						if ($options->baca_selengkapnya == true && $element['jenis_konten'] != 'featured') {
				?>
				<a href="#" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >></a>
				<?php 
						}
					}
				?>
			</div>
		</div>
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
				<a href="#>">
					<div class="mr-3 artikel-thumbnail" style="overflow: hidden; border-radius: 16px">
						<img class="center-crop" src="<?=$gambar?>">
					</div>
				</a>
			</div>
			<div class="col pl-0">
				<a href="#" class="text-dark">
					<h5 class="mb-0 text-dark" style="font-size: 11pt;font-weight: bold; font-family: 'Raleway', sans-serif;"><?=substr($artikel['judul'], 0, 61) . ((strlen($artikel['judul']) > 61) ? '...' : '')?></h5>
				</a>
				<a href='javascript:void(0)' class="text-lpnu font-italic" style="font-size: 7pt"><?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?></a>
			</div>
		</div>
		<?php 
				}
		?>
	</div> <!-- end mini title thumbnail -->
	<?php 
		} // end view: mini-thumbnail-title

		else if ($element['view'] == 'card-thumbnail-slider') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: card-thumbnail-slider
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
	<div class="col pt-2">
		<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
			<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$element['judul']?></h4>
			<?php 
				if (isset($options->baca_selengkapnya)) {
					if ($options->baca_selengkapnya == true && $element['jenis_konten'] != 'featured') {
			?>
			<a href="#" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
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
					<span href="#" class="text-success font-weight-bold" style="font-size: 7pt"><?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?></span>
					<a href="#" class='text-white'>
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
		} // end view: card-thumbnail-slider
		else if ($element['view'] == 'text-only') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: Text-only
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
	<div class="col pt-2">
		<div class="row">
			<div class="col" style="border-bottom: 1px solid #ddd">
				<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
					<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$element['judul']?></h4>
					<?php 
						if (isset($options->baca_selengkapnya)) {
							if ($options->baca_selengkapnya == true && $element['jenis_konten'] != 'featured') {
					?>
					<a href="#" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
					<?php
							}
						}
					?>
				</div>
			</div>
		</div>
		<?php 
			foreach ($data_artikel as $artikel) {
				$penulis = $adminModel->find($artikel['penulis_username']);
		?>
		<div class="row py-3 border-bottom">
			<div class="col">
				<a href="#" class="text-dark">
					<h5 class="mb-0 text-dark" style="font-size: 11pt;font-weight: bold; font-family: 'Raleway', sans-serif;"><?=$artikel['judul']?></h5>
				</a> 
				<div class="text-lpnu font-italic d-flex align-items-center mt-2" style="font-size: 7pt">
					<div class="d-flex flex-row align-items-center">
						<div class='rounded-circle mr-2' style="width: 20px; height: 20px; overflow: hidden">
							<img class="foto-profil" src="<?=(($penulis != '') ? site_url('images/profile/' . $penulis['avatar']) : '')?>">
						</div>
						<?php 
							if ($penulis != '') {
						?>
						<a href='#' class="font-weight-bold text-dark"><?=$penulis['nama_lengkap']?></a>
						<?php 
							}
						?>
					</div>
					<i class="fas fa-circle px-2 text-dark" style="font-size: 3pt"></i>
					<?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?> 
					<i class="fas fa-ci	rcle px-2" style="font-size: 4pt"></i>
					<?php 
						if ($artikel['kategori_id'] != '') {
							$kategori_id_array = explode('|', $artikel['kategori_id']);
							foreach ($kategori_id_array as $index => $kategori_id) {
								$kategori = $kategoriModel->find($kategori_id);
								if ($kategori != '') {
									if ($index != 0)
					?>
					<a href='#' class="font-weight-bold">
						<span class="badge badge-warning p-1 text-dark font-weight-bold mr-1 mb-0" style="font-size: 6pt">
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
	</div> <!-- end col view: text-only -->
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
		jQuery(document).ready(function() {
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
				$options = json_decode($element['options']);
				if ($element['view'] == 'carousel') {
					/* -------------------------------------------------------------------------------------------------
					 *	view content: Carousel
					 * -------------------------------------------------------------------------------------------------*/
					$options = json_decode($element['options']);
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
			});
			<?php 
				}
				else if ($element['view'] == 'mitra-slider') {
					/* -------------------------------------------------------------------------------------------------
					 *	view content: mitra-slider
					 * -------------------------------------------------------------------------------------------------*/
			?>
			$("#lightslider-mitra-1").lightSlider({
				item: itemMitra,
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
				else if ($element['view'] == 'card-thumbnail-slider') {
					/* -------------------------------------------------------------------------------------------------
					 *	view content: card-thumbnail-slider
					 * -------------------------------------------------------------------------------------------------*/
			?>
			$("#lightslider-postingan-1").lightSlider({
				item: itemArtikel,
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
			?>
			
			elementWidth = parseInt($(".ratio-4x3").width())
			elementHeight = elementWidth * 0.80
			$(".ratio-4x3").css('height', elementHeight)
			$(".center-crop").one("load", function() {
			    hitungAspectRatio($(this))
			}).each(function() {
			    hitungAspectRatio($(this))
			})		
		});
	</script>
