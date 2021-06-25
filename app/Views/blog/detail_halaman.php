<?php $this->extend('template/blog/homepage')?>

<?php $this->section('metaTag')?>
<?php $this->section('metaTag')?>
<?php 
	if (file_exists('files/postingan/halaman/' . $halaman['file_artikel'])) {
		$isi_artikel = file_get_contents('files/postingan/halaman/' . $halaman['file_artikel']);
	}
	function limit_text($text, $limit) {
	    if (str_word_count($text, 0) > $limit) {
	        $words = str_word_count($text, 2);
	        $pos   = array_keys($words);
	        $text  = substr($text, 0, $pos[$limit]) . '...';
	    }
	    return $text;
	}
	$description = "";
	if ($halaman['deskripsi_penelusuran'] != '') 
		$description = $halaman['deskripsi_penelusuran'];
	else 
		$description = substr(strip_tags($isi_artikel), 0, 140);

	$gambar = site_url('img_unavailable.png');
	if ($halaman['daftar_gambar'] != '') {
		$data_gambar = explode('|', $halaman['daftar_gambar']);
		foreach ($data_gambar as $new_gambar) {
			$base_length = strlen(base_url());
			$file_url = substr($new_gambar, $base_length);
			if (file_exists('.' . $file_url)) {
				$gambar = $new_gambar;
				break;
			}
		}
	}

	$created_at = new DateTime($halaman['created_at']);
	$updated_at = new DateTime($halaman['updated_at']);
	$penulis = $adminModel->find($halaman['penulis_username']);
?>

<!-- Primary Meta Tags -->
<meta name="title" content="<?=$halaman['judul']?>">
<meta name='description' content="<?=$description?>">
<meta name="author" content="<?=(($penulis['nama_lengkap'] != '') ? $penulis['nama_lengkap'] : '')?>">
<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="<?=site_url('/' . $halaman['slug'])?>">
<meta property="og:title" content="<?=$halaman['judul']?>">
<meta property="og:description" content="<?=$description?>">
<meta property="og:image" content="<?=$gambar?>">
<meta property="article:published_time" content="<?=$created_at->format(DateTime::ATOM)?>">
<meta property="article:modified_time" content="<?=$updated_at->format(DateTime::ATOM)?>">
<meta property="article:author" content="<?=(($penulis['nama_lengkap'] != '') ? $penulis['nama_lengkap'] : '')?>">
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?=site_url('/' . $halaman['slug'])?>">
<meta property="twitter:title" content="<?=$halaman['judul']?>">
<meta property="twitter:description" content="<?=$description?>">
<meta property="twitter:image" content="<?=$gambar?>">
<!-- Geo MetaTag -->
<meta name="geo.region" content="ID" />
<meta name="geo.placename" content="Malang" />
<meta name="geo.position" content="-8.001391;112.633424" />
<meta name="ICBM" content="-8.001391, 112.633424" />
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<div class="row article">
					<div class="col">
						<h1 class="mt-0 mt-2 mb-2" style="font-size: 20px;font-family: 'Raleway', sans-serif;font-weight: 600;"><?=$halaman['judul']?></h1>
						<div class="d-flex mb-3 flex-row justify-content-between align-items-start">
							<div class="d-flex align-items-center mr-2">
								<?php 
									$penulis = $adminModel->find($halaman['penulis_username']);
									if ($penulis != '') {
								?>
								<div class='rounded-circle mr-2 d-flex' style="width: 15px; height: 15px; overflow: hidden">
									<img class="foto-profil" style="object-fit: cover;" src="<?=(($penulis != '') ? site_url('images/profile/' . $penulis['avatar']) : '')?>">
								</div>
								<a href='<?=site_url('penulis/' . $penulis['username'])?>' class="font-italic" style="font-size: 7pt; font-weight: 700; font-family: 'Raleway', sans-serif; color: #7d7d7d;"><?=$penulis['nama_lengkap']?></a>

								<?php 
									}
								?>
							</div>
							<div>
								<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?=site_url($halaman['slug'])?>" class="btn btn-sm btn-link text-white p-1" style="background-color: #3b5998; width: 30px; height: 30px">
									<i class="fab fa-facebook-f" style="font-size:15pt; top: 1px; position: relative;"></i>
								</a>
								<a target="_blank" href="http://twitter.com/share?url=<?=site_url($halaman['slug'])?>" class="btn btn-sm btn-link text-white p-1" style="background-color: #55acee; width: 30px; height: 30px">
									<i class="fab fa-twitter" style="font-size:15pt; top: 1px; position: relative;"></i>
								</a>
								<a target="_blank" href="mailto:?Subject=Artikel Berjudul <?=$halaman['judul']?>&Body=Kunjungi selengakpnya di <?=site_url($halaman['slug'])?>" class="btn btn-sm btn-link text-white p-1" style="background-color: #D93025; width: 30px; height: 30px">
									<i class="fas fa-envelope" style="font-size:15pt; left: -1px; position: relative;"></i>
								</a>
								<a target="_blank" href="whatsapp://send?text=Artikel berjudul <?=$halaman['judul']?>, Kunjungi selengakpnya di <?=site_url($halaman['slug'])?>" data-action="share/whatsapp/share" class="btn btn-sm btn-link text-white p-1" style="background-color: #28A219; width: 30px; height: 30px">
									<i class="fab fa-whatsapp" style="font-size:15pt; top: 0px; position: relative;"></i>
								</a>
								<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=site_url($halaman['slug'])?>" class="btn btn-sm btn-link text-white p-1" style="background-color: #007bb5; width: 30px; height: 30px">
									<i class="fab fa-linkedin-in" style="font-size:15pt; top: 0px; position: relative;"></i>
								</a>
							</div>
							<span class="font-italic" style="font-size: 7pt; font-weight: 700; font-family: 'Raleway', sans-serif; color: #7d7d7d;"><?=$nama_hari[date('N', strtotime($halaman['created_at']))]?>, <?=date('d', strtotime($halaman['created_at']))?> <?=$nama_bulan[date('n', strtotime($halaman['created_at']))]?> <?=date('Y', strtotime($halaman['created_at']))?> </span>
						</div>
						<?=$isi_artikel?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body pt-3">
				<div class="row">
					<div class="col-auto">
						<div class="artikel-thumbnail-sm" style="overflow: hidden; border-radius: 16px">
							<img src="<?=site_url('images/profile/' . $penulis['avatar'])?>" class="center-crop">
						</div>
					</div>
					<div class="col pl-4 pl-sm-0 align-self-center pr-4">
						<h3 class="mt-0 font-weight-bold" style="font-size: 16pt; font-family: 'Amiri', serif; color: #505050"><?=$penulis['nama_lengkap']?></h3>
						<table class="table table-sm mt-1 mb-2">
							<tr>
								<th style="font-family: 'Amiri', serif; padding: 0 8px; border: 0">Alamat</th>
								<th style="font-family: 'Amiri', serif; padding: 0 8px; border: 0">:</th>
								<td style="font-family: 'Amiri', serif; padding: 0 8px; border: 0"><?=$penulis['alamat']?></td>
							</tr>
							<tr>
								<th style="font-family: 'Amiri', serif; padding: 0 8px; border: 0">Tanggal Lahir</th>
								<th style="font-family: 'Amiri', serif; padding: 0 8px; border: 0">:</th>
								<td style="font-family: 'Amiri', serif; padding: 0 8px; border: 0"><?=date('d', strtotime($penulis['tanggal_lahir']))?> <?=$nama_bulan[date('n', strtotime($penulis['tanggal_lahir']))]?> <?=date('Y', strtotime($penulis['tanggal_lahir']))?></td>
							</tr>
						</table>
						<a href="<?=site_url('penulis/' . $penulis['username'])?>" class="btn btn-danger btn-sm" style="padding: 0 8px">
							<i class="fas fa-pen-alt mr-1"></i>
							Lihat Artikel Saya
						</a>
					</div>
				</div> <!-- end row -->
			</div>
		</div>
	</div>
</div>
<?php $this->endSection()?>

<?php $this->section('widget')?>
<?php 
	foreach ($data_tata_letak_widget as $content_col) {
?>
<div class="row">
	<?php 
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
				$data_mitra = $mitraModel->orderBy('id', 'desc')->findAll($options->limit);
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
			<div class="card-header d-flex justify-content-between align-items-center bg-<?=$options->background?> py-2">
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
</div>
<?php 
} // end foreach col
?>
<?php $this->endSection()?>



<?php $this->section('jsContent')?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		$(".center-crop").one("load", function() {
		    hitungAspectRatio($(this))
		}).each(function() {
		    hitungAspectRatio($(this))
		})
	});

	<?php 
	foreach ($data_tata_letak_widget as $content_col) {
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
	?>
</script>
<?php $this->endSection()?>


