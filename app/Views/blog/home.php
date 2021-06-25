<?php $this->extend('template/blog/homepage')?>
<?php $this->section('metaTag')?>
<!-- Primary MetaTag -->
<meta name="title" content="<?=$konfigurasi['APP_JUDUL']['value']?>">
<meta name='description' content="<?=$konfigurasi['APP_DESCRIPTION']['value_text']?>">
<!-- OpenGraph MetaTag -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?=base_url()?>">
<meta property="og:title" content="<?=$konfigurasi['APP_JUDUL']['value']?>">
<meta property="og:description" content="<?=$konfigurasi['APP_DESCRIPTION']['value_text']?>">
<meta property="og:image" content="<?=site_url($konfigurasi['APP_LOGO']['value_text'])?>">
<!-- Twitter -->
<meta property="twitter:card" content="summary">
<meta property="twitter:url" content="<?=base_url()?>">
<meta property="twitter:title" content="<?=$konfigurasi['APP_JUDUL']['value']?>">
<meta property="twitter:description" content="<?=$konfigurasi['APP_DESCRIPTION']['value_text']?>">
<meta property="twitter:image" content="<?=site_url($konfigurasi['APP_LOGO']['value_text'])?>">
<!-- Geo MetaTag -->
<meta name="geo.region" content="ID" />
<meta name="geo.placename" content="Malang" />
<meta name="geo.position" content="-8.001391;112.633424" />
<meta name="ICBM" content="-8.001391, 112.633424" />
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<?php 
	foreach ($data_tata_letak_content as $index => $content_row) {
		if ($index == 0) {
			continue;
		}
?>
<div class="row">
	<?php 
		foreach ($content_row as $content_col) {

			$options = json_decode($content_col['options']);
			if ($content_col['view'] == 'carousel') {
				/* -------------------------------------------------------------------------------------------------
				 *	view: Carousel
				 * -------------------------------------------------------------------------------------------------*/
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'kategori'){

					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
				}
	?>
	<div class="col-lg-<?=$content_col['lebar_lg']?> col-md-<?=$content_col['lebar_md']?> col-sm-<?=$content_col['lebar_sm']?> col-<?=$content_col['lebar_xs']?> <?=$content_col['kelas']?>">
		<div class="carousel slide" id="carousel-<?=$content_col['id']?>" style="overflow: hidden; border-radius: 16px">
			<ol class="carousel-indicators">
				<?php 
					foreach ($data_artikel as $index => $artikel) {
				?>
				<li data-target='#carousel-<?=$content_col['id']?>' data-slide-to='<?=$index?>' <?=(($index == 0) ? "class='active'" : '')?>></li>
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
									break;
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
							<h5><?=$artikel['judul']?></h5>
						</a>
					</div>
				</div>
				<?php 
					}
				?>
				<a class="carousel-control-prev" href="#carousel-<?=$content_col['id']?>" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel-<?=$content_col['id']?>" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div> <!-- end artikel-carousel -->
	<?php 
			} // end if
			else if ($content_col['view'] == 'card-thumbnail') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: Carousel
				 * -------------------------------------------------------------------------------------------------*/
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'kategori'){

					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
				}
	?>

	<div class="col-lg-<?=$content_col['lebar_lg']?> col-md-<?=$content_col['lebar_md']?> col-sm-<?=$content_col['lebar_sm']?> col-<?=$content_col['lebar_xs']?> <?=$content_col['kelas']?> pt-2 pt-md-0">
		<div class="row justify-content-center">
			<?php 
				$index = 0;
				foreach ($data_artikel as $index => $artikel) {
					$index++;
					$gambar = site_url('img_unavailable.png');
					if ($artikel['daftar_gambar'] != '') {
						$data_gambar = explode('|', $artikel['daftar_gambar']);
						foreach ($data_gambar as $new_gambar) {
							$base_length = strlen(base_url());
							$file_url = substr($new_gambar, $base_length);
							if (file_exists('.' . $file_url)) {
								$gambar = $new_gambar;
								break;
							}
						}
					}
			?>
			<div class="col-lg-12 col-md-12 col-sm-4 col-6 <?=(($index % 2 != 0) ? 'pr-1' : 'pl-1')?> pl-sm-2 pr-sm-2">
				<div href='<?=site_url($artikel['slug'])?>' class="card card-link ratio-4x3 backdrop-gradient" style="overflow: hidden; margin-bottom: 15px">
					<img class='center-crop' src="<?=$gambar?>" style="object-fit: cover;">
					<div class="caption text-left" style="bottom: -10px; width: 90%; line-height: 13px">
						<?php 
							if ($artikel['kategori_id'] != '') {
								$data_kategori_id = explode('|', $artikel['kategori_id']);
								foreach ($data_kategori_id as $index => $kategori_id) {
									$kategori = $kategoriModel->find($kategori_id);
						?>
						<?=(($index == 0) ? '' : '.')?>
						<a href='<?=site_url('kategori/'. (($kategori != '') ? $kategori['slug'] : '') )?>' class="font-weight-bold text-success" style="font-size: 7pt"><?=(($kategori != '') ? $kategori['kategori'] : '')?></a>
						<?php
								}
							}
						?>
						<a href="<?=site_url($artikel['slug'])?>" class="text-white"><h5 class="mb-0"><?=$artikel['judul']?></h5></a>
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
			else if ($content_col['view'] == 'mitra-slider') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: Mitra
				 * -------------------------------------------------------------------------------------------------*/
				if ($content_col['jenis_konten'] == 'mitra-terkini') {
					$data_mitra = $mitraModel->orderBy('id', 'desc')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'mitra-kategori') {
					$data_mitra = $mitraModel->like('jenis_usaha', $options->kategori_usaha, 'both')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'mitra-featured') {
					$data_mitra = $mitraModel->find($options->mitra_featured);
				}
	?>
	<div class="col-lg-<?=$content_col['lebar_lg']?> col-md-<?=$content_col['lebar_md']?> col-sm-<?=$content_col['lebar_sm']?> col-<?=$content_col['lebar_xs']?> <?=$content_col['kelas']?>">
		<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
			<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$content_col['judul']?></h4>
			<?php 
				if (isset($options->baca_selengkapnya)) {
					if ($options->baca_selengkapnya == true && $content_col['jenis_konten'] != 'featured') {
			?>
			<a href="<?=site_url('mitra')?>" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
			<?php 
					}
				}
			?>
		</div>
		<ul id="lightslider-mitra-<?=$content_col['id']?>" class="light-slider" style="height: 180px; background-color: transparent;">
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
					<a href="<?=site_url('mitra/' . $mitra['id'])?>" class='text-white'>
						<h5 class="mb-0" style="font-size: 12pt"><?=ucwords(strtolower($mitra['merek_dagang']))?></h5>
					</a>

					<?php 
						if ($mitra['jenis_usaha'] != '') {
							$jenis_usaha = explode('|', $mitra['jenis_usaha']);
							if (is_array($jenis_usaha)) {
								foreach ($jenis_usaha as $jenis) {
									echo "<span class='badge badge-warning p-1 font-weight-bold text-dark' style='font-size: 7pt'><i class='fas fa-tag'></i> $jenis</span>";
								}
							}
							else {
								echo "<span class='badge badge-warning p-1 font-weight-bold text-dark' style='font-size: 7pt'><i class='fas fa-tag'></i> $jenis_usaha</span>";
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
	</div> <!-- end mitra -->
	<?php 
			} // end view: mitra
			else if ($content_col['view'] == 'mini-thumbnail-title') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: mini-thumbnail-title
				 * -------------------------------------------------------------------------------------------------*/
				$readmore_url = '';
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$readmore_url = site_url('terkini');
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
					$readmore_url = site_url('terpopuler');
				}
				else if ($content_col['jenis_konten'] == 'kategori'){
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$kategori = $kategoriModel->find($options->kategori_id);
					if ($kategori != '') {
						$readmore_url = site_url('kategori/' . $kategori['slug']);
					}
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
					$readmore_url = site_url('penulis/' . $options->penulis);
				}
	?>
	<div class="col-lg-<?=$content_col['lebar_lg']?> col-md-<?=$content_col['lebar_md']?> col-sm-<?=$content_col['lebar_sm']?> col-<?=$content_col['lebar_xs']?> <?=$content_col['kelas']?> pt-2 mt-2">
		<div class="row">
			<div class="col d-flex justify-content-between align-items-center">
				<h4 style="font-weight: bold; font-size: 12pt;" class="m-2"><?=$content_col['judul']?></h4>
				<?php 
					if (isset($options->baca_selengkapnya)) {
						if ($options->baca_selengkapnya == true && $content_col['jenis_konten'] != 'featured') {
				?>
				<a href="<?=$readmore_url?>" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >></a>
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
								break;
							}
						}
					}
		?>
		<div class="row mt-2 align-items-center mb-2">
			<div class="col-auto pr-0">
				<a href="<?=$artikel['slug']?>">
					<div class="mr-3 artikel-thumbnail" style="overflow: hidden; border-radius: 16px">
						<img class="center-crop" src="<?=$gambar?>">
					</div>
				</a>
			</div>
			<div class="col pl-0">
				<a href="<?=$artikel['slug']?>" class="text-dark">
					<h5 class="mb-0" style="font-size: 13pt; line-height: 20px; font-weight: bold; font-family: 'Amiri', serif;"><?=substr($artikel['judul'], 0, 61) . ((strlen($artikel['judul']) > 61) ? '...' : '')?></h5>
				</a>
				<a href='javascript:void(0)' class="font-weight-bold text-lpnu" style="font-size: 7pt"><?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?></a>
			</div>
		</div>
		<?php 
				}
		?>
	</div> <!-- end mini title thumbnail -->
	<?php 
			} // end view: mini-thumbnail-title

			else if ($content_col['view'] == 'card-thumbnail-slider') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: card-thumbnail-slider
				 * -------------------------------------------------------------------------------------------------*/
				$readmore_url = '';
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$readmore_url = site_url('terkini');
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
					$readmore_url = site_url('terpopuler');
				}
				else if ($content_col['jenis_konten'] == 'kategori'){
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$kategori = $kategoriModel->find($options->kategori_id);
					if ($kategori != '') {
						$readmore_url = site_url('kategori/' . $kategori['slug']);
					}
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
					$readmore_url = site_url('penulis/' . $options->penulis);
				}
	?>
	<div class="col-lg-<?=$content_col['lebar_lg']?> col-md-<?=$content_col['lebar_md']?> col-sm-<?=$content_col['lebar_sm']?> col-<?=$content_col['lebar_xs']?> <?=$content_col['kelas']?> pt-2">
		<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
			<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$content_col['judul']?></h4>
			<?php 
				if (isset($options->baca_selengkapnya)) {
					if ($options->baca_selengkapnya == true && $content_col['jenis_konten'] != 'featured') {
			?>
			<a href="<?=$readmore_url?>" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
			<?php 
					}
				}
			?>
		</div>
		<ul id="lightslider-postingan-<?=$content_col['id']?>" class="light-slider" style="height: 180px; background-color: transparent;">
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
								break;
							}
						}
					}
			?>

			<li style="overflow: hidden; height: 100%; border-radius: 24px; position: relative">
				<img class="center-crop-parent" src="<?=$gambar?>">
				<div class="backdrop-gradient"></div>
				<div class="caption text-left" style="bottom: -4px; line-height: 12px; width: 90%">
					<span href="#" class="text-success font-weight-bold" style="font-size: 7pt"><?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?></span>
					<a href="<?=site_url($artikel['slug'])?>" class='text-white'>
						<h5 class="mb-0" style="font-size: 9pt; white-space: pre-wrap;"><?=$artikel['judul']?></h5>
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
			else if ($content_col['view'] == 'text-only') {
				/* -------------------------------------------------------------------------------------------------
				 *	view content: Text-only
				 * -------------------------------------------------------------------------------------------------*/
				$readmore_url = '';
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$readmore_url = site_url('terkini');
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
					$readmore_url = site_url('terpopuler');
				}
				else if ($content_col['jenis_konten'] == 'kategori'){
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$kategori = $kategoriModel->find($options->kategori_id);
					if ($kategori != '') {
						$readmore_url = site_url('kategori/' . $kategori['slug']);
					}
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
					$readmore_url = site_url('penulis/' . $options->penulis);
				}
	?>
	<div class="col-lg-<?=$content_col['lebar_lg']?> col-md-<?=$content_col['lebar_md']?> col-sm-<?=$content_col['lebar_sm']?> col-<?=$content_col['lebar_xs']?> <?=$content_col['kelas']?> pt-2">
		<div class="row">
			<div class="col" style="border-bottom: 1px solid #ddd">
				<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
					<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$content_col['judul']?></h4>
					<?php 
						if (isset($options->baca_selengkapnya)) {
							if ($options->baca_selengkapnya == true && $content_col['jenis_konten'] != 'featured') {
					?>
					<a href="<?=$readmore_url?>" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
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
				<a href="<?=site_url($artikel['slug'])?>" class="text-dark">
					<h5 class="mb-0" style="color: #3a3a3a;font-size: 13pt; line-height: 20px; font-weight: bold; font-family: 'Amiri', serif;"><?=$artikel['judul']?></h5>
				</a> 
				<div class="font-weight-bold text-lpnu d-flex align-items-center mt-2" style="font-size: 7pt">
					<div class="d-flex flex-row align-items-center">
						<?php 
							if ($penulis != '') {
						?>
						<div class='rounded-circle mr-2' style="width: 20px; height: 20px; overflow: hidden">
							<img class="foto-profil" src="<?=(($penulis != '') ? site_url('images/profile/' . $penulis['avatar']) : '')?>">
						</div>
						<a href='<?=site_url('penulis/' . $penulis['username'])?>' class="font-weight-bold text-dark"><?=$penulis['nama_lengkap']?></a>
						<?php 
							}
						?>
					</div>
					<i class="fas fa-circle px-2 text-dark" style="font-size: 4pt"></i>
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
					<a href='<?=site_url('kategori/' . $kategori['slug'])?>' class="font-weight-bold">
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
	</div> <!-- end col view: text-only -->
	<?php 
			}
	?>
	<?php 
		} // end foreach col
	?>

</div>
<?php 
	} // end foreach row
?>
<?php $this->endSection() ?>






<?php $this->section('widget')?>
<?php 
	foreach ($data_tata_letak_widget as $index => $content_row) {
		if ($index == 0) {
			continue;
		}
?>
<div class="row">
	<?php 
		foreach ($content_row as $content_col) {

			$options = json_decode($content_col['options']);
			if ($content_col['view'] == 'carousel') {
				/* -------------------------------------------------------------------------------------------------
				 *	view widget: Carousel
				 * -------------------------------------------------------------------------------------------------*/
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'kategori'){

					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
				}
	?>
	<div class="col-lg-<?=$content_col['lebar_lg']?> col-md-<?=$content_col['lebar_md']?> col-sm-<?=$content_col['lebar_sm']?> col-<?=$content_col['lebar_xs']?> <?=$content_col['kelas']?>">
		<div class="carousel slide" id="carousel-<?=$content_col['id']?>" style="overflow: hidden; border-radius: 16px">
			<ol class="carousel-indicators">
				<?php 
					foreach ($data_artikel as $index => $artikel) {
				?>
				<li data-target='#carousel-<?=$content_col['id']?>' data-slide-to='<?=$index?>' <?=(($index == 0) ? "class='active'" : '')?>></li>
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
									break;
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
							<h5><?=$artikel['judul']?></h5>
						</a>
					</div>
				</div>
				<?php 
					}
				?>
				<a class="carousel-control-prev" href="#carousel-<?=$content_col['id']?>" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carousel-<?=$content_col['id']?>" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div> <!-- end artikel-carousel -->
	<?php 
			} // end if
			else if ($content_col['view'] == 'mitra-slider') {
				/* -------------------------------------------------------------------------------------------------
				 *	view widget: Mitra-slider
				 * -------------------------------------------------------------------------------------------------*/
				if ($content_col['jenis_konten'] == 'mitra-terkini') {
					$data_mitra = $mitraModel->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'mitra-kategori') {
					$data_mitra = $mitraModel->like('jenis_usaha', $options->kategori_usaha, 'both')->findAll($options->limit);
				}
				else if ($content_col['jenis_konten'] == 'mitra-featured') {
					$data_mitra = $mitraModel->find($options->featured);
				}
	?>
	<div class="col-12 <?=$content_col['kelas']?> mb-2">
		<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
			<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$content_col['judul']?></h4>
			<?php 
				if (isset($options->baca_selengkapnya)) {
					if ($options->baca_selengkapnya == true && $content_col['jenis_konten'] != 'featured') {
			?>
			<a href="<?=site_url('mitra')?>" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
			<?php 
					}
				}
			?>
		</div>
		<ul id="lightslider-mitra-<?=$content_col['id']?>" class="light-slider" style="height: 180px; background-color: transparent;">
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
					<a href="<?=site_url('mitra/' . $mitra['id'])?>" class='text-white'>
						<h5 class="mb-0" style="font-size: 12pt"><?=ucwords(strtolower($mitra['merek_dagang']))?></h5>
					</a>

					<?php 
						if ($mitra['jenis_usaha'] != '') {
							$jenis_usaha = explode('|', $mitra['jenis_usaha']);
							if (is_array($jenis_usaha)) {
								foreach ($jenis_usaha as $jenis) {
									echo "<span class='badge badge-warning p-1 font-weight-bold text-dark' style='font-size: 7pt'><i class='fas fa-tag'></i> $jenis</span>";
								}
							}
							else {
								echo "<span class='badge badge-warning p-1 font-weight-bold text-dark' style='font-size: 7pt'><i class='fas fa-tag'></i> $jenis_usaha</span>";
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
	</div> <!-- end mitra -->
	<?php 
			} // end view: mitra
			else if ($content_col['view'] == 'mini-thumbnail-title') {
				/* -------------------------------------------------------------------------------------------------
				 *	view widget: mini-thumbnail-title
				 * -------------------------------------------------------------------------------------------------*/
				$readmore_url = '';
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$readmore_url = site_url('terkini');
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
					$readmore_url = site_url('terpopuler');
				}
				else if ($content_col['jenis_konten'] == 'kategori'){
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$kategori = $kategoriModel->find($options->kategori_id);
					if ($kategori != '') {
						$readmore_url = site_url('kategori/' . $kategori['slug']);
					}
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
					$readmore_url = site_url('penulis/' . $options->penulis);
				}
	?>
	<div class="col-12 <?=$content_col['kelas']?>">
		<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style="border-radius: 4px">
			<div class="card-header d-flex justify-content-between align-items-center bg-guest-orange py-2">
				<div class="text-white widget-title"><?=$content_col['judul']?></div>
				<?php 
					if (isset($options->baca_selengkapnya)) {
						if ($options->baca_selengkapnya == true && $content_col['jenis_konten'] != 'featured') {
				?>
				<a href="<?=$readmore_url?>" class="font-weight-bold text-white" style="font-size: 7pt">Lihat Selengkapnya >></a>
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
									break;
								}
							}
						}
				?>
				<div class="row align-items-center mb-2">
					<div class="col-auto pr-0">
						<a href="<?=site_url($artikel['slug'])?>">
							<div class="mr-3 artikel-thumbnail" style="overflow: hidden; border-radius: 16px">
								<img class="center-crop" src="<?=$gambar?>">
							</div>
						</a>
					</div>
					<div class="col pl-0">
						<a href="<?=site_url($artikel['slug'])?>">
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
						<a href='<?=site_url('kategori/' . $kategori['slug'])?>' class="font-weight-bold text-lpnu" style="font-size: 7pt"><?=$kategori['kategori']?></a>
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

			else if ($content_col['view'] == 'card-thumbnail-slider') {
				/* -------------------------------------------------------------------------------------------------
				 *	view widget: card-thumbnail-slider
				 * -------------------------------------------------------------------------------------------------*/
				$readmore_url = '';
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$readmore_url = site_url('terkini');
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
					$readmore_url = site_url('terpopuler');
				}
				else if ($content_col['jenis_konten'] == 'kategori'){
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$kategori = $kategoriModel->find($options->kategori_id);
					if ($kategori != '') {
						$readmore_url = site_url('kategori/' . $kategori['slug']);
					}
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
					$readmore_url = site_url('penulis/' . $options->penulis);
				}
	?>
	<div class="col-12 pb-2 <?=$content_col['kelas']?>">
		<div class="header d-flex flex-row justify-content-between align-items-center py-2 px-0 border-0">
			<h4 class="m-2" style="font-weight: bold; font-size: 12pt;"><?=$content_col['judul']?></h4>
			<?php 
				if (isset($options->baca_selengkapnya)) {
					if ($options->baca_selengkapnya == true && $content_col['jenis_konten'] != 'featured') {
			?>
			<a href="<?=$readmore_url?>" class="font-weight-bold" style="font-size: 7pt">Lihat Selengkapnya >> </a>
			<?php 
					}
				}
			?>
		</div>
		<ul id="lightslider-postingan-<?=$content_col['id']?>" class="light-slider" style="height: 180px; background-color: transparent;">
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
								break;
							}
						}
					}
			?>

			<li style="overflow: hidden; height: 100%; border-radius: 24px; position: relative">
				<img class="center-crop-parent" src="<?=$gambar?>">
				<div class="backdrop-gradient"></div>
				<div class="caption text-left" style="bottom: -4px; line-height: 12px; width: 90%">
					<span href="#" class="text-success font-weight-bold" style="font-size: 7pt"><?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?></span>
					<a href="<?=site_url($artikel['slug'])?>" class='text-white'>
						<h5 class="mb-0" style="font-size: 9pt; white-space: pre-wrap;"><?=$artikel['judul']?></h5>
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
			else if ($content_col['view'] == 'text-only') {
				/* -------------------------------------------------------------------------------------------------
				 *	view widget: text-only
				 * -------------------------------------------------------------------------------------------------*/
				$readmore_url = '';
				if ($content_col['jenis_konten'] == 'terkini') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$readmore_url = site_url('terkini');
				}
				else if ($content_col['jenis_konten'] == 'terpopuler'){
					$data_artikel = $artikelModel
						->select('COUNT(page_view.id) as jumlah_view, artikel.*')
						->join('page_view', 'page_view.postingan_id = artikel.id', 'left')
						->groupBy('artikel.id')
						->orderBy('jumlah_view', 'desc')
						->where('status', 'dipublikasikan')
						->findAll($options->limit);
					$readmore_url = site_url('terpopuler');
				}
				else if ($content_col['jenis_konten'] == 'kategori'){
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
					$kategori = $kategoriModel->find($options->kategori_id);
					if ($kategori != '') {
						$readmore_url = site_url('kategori/' . $kategori['slug']);
					}
				}
				else if ($content_col['jenis_konten'] == 'featured') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->find($options->featured);
				} 
				else if ($content_col['jenis_konten'] == 'penulis') {
					$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('penulis_username', $options->penulis)->findAll($options->limit);
					$readmore_url = site_url('penulis/' . $options->penulis);
				}
	?>
	<div class="col-12 <?=$content_col['kelas']?> pb-2">
		<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style='border-radius: 4px'>
			<div class="card-header d-flex justify-content-between align-items-center py-2 bg-<?=((isset($options->background)) ? $options->background : 'white')?>">
				<div class="mb-0 widget-title card-title text-<?=((isset($options->color)) ? $options->color : 'dark')?>"><?=$content_col['judul']?></div>
				<?php 
					if (isset($options->baca_selengkapnya)) {
						if ($options->baca_selengkapnya == true && $content_col['jenis_konten'] != 'featured') {
				?>
				<a href="<?=$readmore_url?>" class="font-weight-bold text-<?=((isset($options->color)) ? $options->color : 'dark')?>" style="font-size: 7pt">Lihat Selengkapnya >> </a>
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
						<a href="<?=site_url($artikel['slug'])?>" class="text-dark">
							<h5 class="mb-0" style="font-size: 10pt;font-weight: bold;"><?=$artikel['judul']?></h5>
						</a> 
						<div class="font-weight-bold text-lpnu d-flex justify-content-between align-items-center" style="font-size: 7pt">
							<?=$nama_hari[date('N', strtotime($artikel['created_at']))]?>, <?=date('d', strtotime($artikel['created_at']))?> <?=$nama_bulan[date('n', strtotime($artikel['created_at']))]?> <?=date('Y', strtotime($artikel['created_at']))?> 
							<div>
								<?php 
									if ($artikel['kategori_id'] != '') {
										$kategori_id_array = explode('|', $artikel['kategori_id']);
										foreach ($kategori_id_array as $index => $kategori_id) {
											$kategori = $kategoriModel->find($kategori_id);
											if ($kategori != '') {
												if ($index != 0)
								?>
								<a href='<?=site_url('kategori/' . $kategori['slug'])?>' class="font-weight-bold">
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
				</div>
		<?php 
				}
		?>
			</div>
		</div>
	</div> <!-- end col view: text-only -->
	<?php 
			} // end view widget: text-only
			else if ($content_col['view'] == "kalender") {
				/* -------------------------------------------------------------------------------------------------
				 *	view widget: text-only
				 * -------------------------------------------------------------------------------------------------*/
	?>
	<div class="col mb-2 <?=$content_col['kelas']?>">
		<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style='border-radius: 4px'>
			<div class="card-header py-2 bg-<?=((isset($options->background)) ? $options->background : 'white')?>">
				<div class="card-title widget-title mb-0 text-<?=((isset($options->color)) ? $options->color : 'dark')?>"><?=$content_col['judul']?></div>
			</div>
			<div class="card-body p-0">
				<div id="calendar-container-<?=$content_col['id']?>">
				</div>
			</div>
		</div>
	</div>
	<?php 
			}
			else if ($content_col['view'] == 'arsip') {
				/* -------------------------------------------------------------------------------------------------
				 *	view widget: Arsip
				 * -------------------------------------------------------------------------------------------------*/
				$data_tahun = $artikelModel->where('status', 'dipublikasikan')->select("DISTINCT(YEAR(created_at)) AS year")->orderBy('year', 'desc')->findAll();
	?>
	<div class="col <?=$content_col['kelas']?>">
		<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style='border-radius: 4px'>
			<div class="card-header py-2 bg-<?=((isset($options->background)) ? $options->background : 'white')?>">
				<div class="card-title widget-title mb-0 text-<?=((isset($options->color)) ? $options->color : 'dark')?>"><?=$content_col['judul']?></div>
			</div>
			<div class="card-body p-0">
				<ul class="nav flex-column" id="accordion-<?=$content_col['id']?>">
					<?php 
						foreach ($data_tahun as $index_tahun => $tahun) {
							$data_bulan = $artikelModel->where('status', 'dipublikasikan')->select("DISTINCT(MONTH(created_at)) AS month")->where('YEAR(created_at)', $tahun['year'])->orderBy('month', 'desc')->findAll();

					?>
					<li class="nav-item bg-default">
						<h5 style="font-size: 9pt; cursor: pointer" class="nav-link font-weight-bold mb-0 p-3" data-toggle="collapse" data-target="#collapse-<?=$content_col['id']?>-<?=$tahun['year']?>">2021</h5>
						<div class="collapse <?=(($index_tahun == 0) ? 'show' : '')?>" data-parent="#accordion-<?=$content_col['id']?>" id="collapse-<?=$content_col['id']?>-<?=$tahun['year']?>">


							<ul class="nav flex-column" id="accordion-<?=$content_col['id']?>-<?=$tahun['year']?>">
								<?php 
									foreach ($data_bulan as $index_bulan => $bulan) {
										$data_artikel = $artikelModel->where('status', 'dipublikasikan')->where('YEAR(created_at)', $tahun['year'])->where('MONTH(created_at)', $bulan['month'])->findAll();
								?>
								<li class="nav-item bg-default pl-2">
									<h5 style="font-size: 9pt; cursor: pointer" class="nav-link font-weight-bold mb-0 p-3" data-toggle="collapse" data-target="#collapse-<?=$content_col['id']?>-<?=$tahun['year']?>-<?=$bulan['month']?>">
										<i class="fas fa-calendar mr-2"></i>
										<?=$nama_bulan[$bulan['month'] - 1]?>											
									</h5>
									<div class="collapse <?=(($index_bulan == 0) ? 'show' : '')?>" data-parent="#accordion-<?=$content_col['id']?>-<?=$tahun['year']?>" id="collapse-<?=$content_col['id']?>-<?=$tahun['year']?>-<?=$bulan['month']?>">
										<ul class="nav flex-column">
											<?php 
												foreach ($data_artikel as $artikel) {
											?>
											<li class="nav-item bg-default">
												<a href="<?=site_url($artikel['slug'])?>" class="nav-link bg-dark" style="color: white !important; font-size: 8pt; font-weight: bold">
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
	<?php 
		} // end foreach col
	?>

</div>
<?php 
	} // end foreach row
?>
<?php $this->endSection()?>




<?php $this->section('jsContent')?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		width = $(window).width();
		if (width >= 1200) {  // XL
			itemMitra = 4
			itemArtikel = 3
			itemWidget = 2
			itemMitraWidget =  2
		}
		else if (width >= 992) { // LG
			itemMitra = 4
			itemArtikel = 3
			itemWidget = 2
			itemMitraWidget = 2
		}
		else if (width >= 768) { // MD
			itemMitra = 3
			itemArtikel = 2
			itemWidget = 2
			itemMitraWidget =  2
		}
		else {			 // SM
			itemMitra = 2
			itemArtikel = 2
			itemWidget = 2
			itemMitraWidget =  2
		}


		<?php 
			foreach ($data_tata_letak_content as $index => $content_row) {
				if ($index == 0) {
					continue;
				}
				foreach ($content_row as $content_col) {

					$options = json_decode($content_col['options']);
					if ($content_col['view'] == 'carousel') {
						/* -------------------------------------------------------------------------------------------------
						 *	view content: Carousel
						 * -------------------------------------------------------------------------------------------------*/
						$options = json_decode($content_col['options']);
		?>
		$("#carousel-<?=$content_col['id']?>").carousel({
			interval: <?=((isset($options->durasi)) ? $options->durasi : '5000')?>,
			ride: true,
		})
		$carouselInner = $("#carousel-<?=$content_col['id']?> .carousel-inner")
		$carouselItem = $("#carousel-<?=$content_col['id']?> .carousel-item")
		$("#carousel-<?=$content_col['id']?> img").one("load", function() {
		    hitungAspectRatio($(this), {width: $carouselInner.width(), height: $carouselInner.height()}, $carouselItem)
		}).each(function() {
		    hitungAspectRatio($(this), {width: $carouselInner.width(), height: $carouselInner.height()}, $carouselItem)
		})
		<?php 
					}
					else if ($content_col['view'] == 'mitra-slider') {
						/* -------------------------------------------------------------------------------------------------
						 *	view content: mitra-slider
						 * -------------------------------------------------------------------------------------------------*/
		?>
		$("#lightslider-mitra-<?=$content_col['id']?>").lightSlider({
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
					else if ($content_col['view'] == 'card-thumbnail-slider') {
						/* -------------------------------------------------------------------------------------------------
						 *	view content: card-thumbnail-slider
						 * -------------------------------------------------------------------------------------------------*/
		?>
		$("#lightslider-postingan-<?=$content_col['id']?>").lightSlider({
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
				}
			}
			foreach ($data_tata_letak_widget as $index => $content_row) {
				if ($index == 0) {
					continue;
				}
				foreach ($content_row as $content_col) {

					$options = json_decode($content_col['options']);
					if ($content_col['view'] == 'carousel') {
						/* -------------------------------------------------------------------------------------------------
						 *	view widget: Carousel
						 * -------------------------------------------------------------------------------------------------*/
						$options = json_decode($content_col['options']);
		?>
		$("#carousel-<?=$content_col['id']?>").carousel({
			interval: <?=((isset($options->durasi)) ? $options->durasi : '5000')?>,
			ride: true,
		})
		var $carouselInner = $("#carousel-<?=$content_col['id']?> .carousel-inner")
		var $carouselItem = $("#carousel-<?=$content_col['id']?> .carousel-item")
		$("#carousel-<?=$content_col['id']?> img").one("load", function() {
		    hitungAspectRatio($(this), {width: $carouselInner.width(), height: $carouselInner.height()}, $carouselItem)
		}).each(function() {
		    hitungAspectRatio($(this), {width: $carouselInner.width(), height: $carouselInner.height()}, $carouselItem)
		})
		<?php 
					}
					else if ($content_col['view'] == 'card-thumbnail-slider') {
						/* -------------------------------------------------------------------------------------------------
						 *	view widget: card-thumbnail-slider
						 * -------------------------------------------------------------------------------------------------*/
		?>
		$("#lightslider-postingan-<?=$content_col['id']?>").lightSlider({
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
					else if ($content_col['view'] == 'mitra-slider') {
						/* -------------------------------------------------------------------------------------------------
						 *	view widget: mitra-slider
						 * -------------------------------------------------------------------------------------------------*/
		?>
		$("#lightslider-mitra-<?=$content_col['id']?>").lightSlider({
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
					else if ($content_col['view'] == 'kalender') {
						/* -------------------------------------------------------------------------------------------------
						 *	view widget: kalender
						 * -------------------------------------------------------------------------------------------------*/
		?>
		$('#calendar-container-<?=$content_col['id']?>').calendar({
			date: new Date(), // today
			prevButton: "<i class='fas fa-arrow-left'></i>",
			nextButton: "<i class='fas fa-arrow-right'></i>",
			showTodayButton: false,
		});
		<?php 
					}
				}
			}
		?>

		$(".carousel").each(function(index, el) {
			carouselWidth = parseInt($(this).width())
			carouselHeight = carouselWidth * 3 / 4
			$(this).find(".carousel-inner").css('height', carouselHeight)
			if (carouselWidth <= 400) {
				$(this).find("h5").css('font-size', '12pt');
				$(this).find("h5").css('line-height', '20px');
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
		


		$(".card-link").click(function(e) {
			window.location = $(this).attr('href')
		});
		
		
	});
</script>
<?php $this->endSection()?>


