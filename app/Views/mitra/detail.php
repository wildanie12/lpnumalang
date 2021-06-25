<?php $this->extend('template/guest') ?>


<?php $this->section('content') ?>
<div class="container-fluid bg-white pb-1" style="box-shadow: 0px 0 18px 0px #00000024; position: relative;">
	<div class="row">
		<div class="col-md-6 pr-0 pl-0 mr-0">
			<ul id="mitra-gallery" class="light-slider">
				<?php 
					$galeri = explode('|', $mitra['galeri']);
					if ($mitra['galeri'] != '') {
						foreach ($galeri as $gambar) {
						
				?>
				<li data-thumb="<?=site_url('/images/mitra/galeri/') . $gambar?>">
					<img src="<?=site_url('/images/mitra/galeri/') . $gambar?>">
				</li>
				<?php 
						}
					}
					else {
				?>
				<li data-thumb="<?=site_url('img_unavailable.png')?>">
					<img src="<?=site_url('img_unavailable.png')?>" style="max-height: 400px; max-width: 400px;">
				</li>
				<?php 
					}
				?>
			</ul>
		</div>
		<div class="col-md-6" style="background-color: #099543;">
			<div class="p-3 pb-4 mt-3 mb-2 bg-dark" style="font-family: 'Raleway', sans-serif; line-height: 5px ">
				<?php 
					$judul = '';
					if ($mitra['merek_dagang'] != '') {
						$judul = $mitra['merek_dagang'];
					}
					else if ($mitra['nama_barang'] != '') {
						$judul = $mitra['nama_barang'];
					}
					else if ($mitra['jenis_usaha'] != '') {
						$jenis_usaha = explode('|', $mitra['jenis_usaha']);
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
				?>
				<h2 class="text-white m-0 bg-dark text-uppercase" style="font-weight: 900"><?=$judul?></h2>
				<span class="text-white pb-2"><?=join(', ', explode('|', $mitra['status_usaha']))?></span>
			</div>
			<table class="table text-white table-sm table-border-0">
				<tr>
					<th class="bg-dark d-flex flex-row align-items-center text-warning"><i class="fas fa-store pl-1 pr-2"></i>Kategori Usaha</th>
					<td>:</td>
					<th>
						<?php 
							$jenis_usaha = explode('|', $mitra['jenis_usaha']);
							foreach ($jenis_usaha as $jenis) {
						?>
						<span class="label label-warning font-weight-bold text-dark"><?=$jenis?></span>
						<?php 
							}
						?>
					</td>
				</tr>
				<tr>
					<th class="d-flex flex-row align-items-center"><i class="fas fa-box-open pl-1 pr-2"></i>Nama Barang</th>
					<td>:</td>
					<th>
						<?php 
							$nama_barang = explode(',', $mitra['nama_barang']);
							foreach ($nama_barang as $barang) {
						?>
						<span class="label label-info font-weight-bold text-dark"><?=ltrim($barang)?></span>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<th class="bg-dark d-flex flex-row align-items-center text-info"><i class="fas fa-city pl-1 pr-2"></i>Kecamatan</th>
					<td>:</td>
					<th><?=$mitra['kecamatan']?></td>
				</tr>
				<tr>
					<th class="d-flex flex-row align-items-center"><i class="fas fa-city pl-1 pr-2"></i>Kelurahan</th>
					<td>:</td>
					<th><?=$mitra['kelurahan']?></td>
				</tr>
				<tr>
					<th class="bg-dark d-flex flex-row align-items-center  text-success"><i class="fas fa-map-marked-alt pl-1 pr-2"></i>Alamat</th>
					<td>:</td>
					<th><?=$mitra['alamat_usaha']?></td>
				</tr>
				<tr>
					<th class="bg-dark d-flex flex-row align-items-center text-danger"><i class="fas fa-signature pl-1 pr-2"></i>Nama Pemilik</th>
					<td>:</td>
					<th><?=$mitra['nama_pemilik']?></td>
				</tr>
				<tr>
					<th class="d-flex flex-row align-items-center"><i class="fas fa-phone-alt pl-1 pr-2"></i>Nomor HP</th>
					<td>:</td>
					<th><?=$mitra['nomor_hp']?></td>
				</tr>
				<tr>
					<th class="bg-dark d-flex flex-row align-items-center text-primary"><i class="fas fa-code-branch pl-1 pr-2"></i>Ranting NU</th>
					<td>:</td>
					<th><?=$mitra['ranting_nu']?></td>
				</tr>
				<tr>
					<th class="d-flex flex-row align-items-center"><i class="fas fa-sitemap pl-1 pr-2"></i>MWCNU</th>
					<td>:</td>
					<th><?=$mitra['mwcnu']?></td>
				</tr>
			</table>
		</div> <!-- end col-6 -->
	</div> <!-- end row -->
</div> <!-- end container-fluid -->
<div class="header mt-4">
	<div class="container-fluid container-wildanie pt-4">
		<div class="row">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<span class="badge badge-secondary p-2 text-white font-weight-bold mr-1 mb-0" style="font-size: 7pt">
									<i class="fas fa-home"></i>
									Home
								</span>
								<i class="fas fa-angle-double-right text-dark" style="font-size: 7pt"></i>
								<a href='javascript:void(0)' class="font-weight-bold">
									<span class="badge badge-warning p-2 text-dark font-weight-bold mr-1 mb-0" style="font-size: 7pt">
										<i class="fas fa-tag"></i> 
										Profil Mitra
									</span>
								</a>
							</div>
						</div>
						<hr class="my-2">
					
						<div class="row mb-1">
							<div class="col">
								<h1 class="mt-0 mt-2 mb-0" style="font-size: 20px;font-family: 'Raleway', sans-serif;font-weight: 600;">Profil Mitra LPNU: <?=$judul?></h1>
							</div>
						</div>
						<div class="d-flex mt-0 mb-3 flex-row justify-content-between align-items-start">
							<div class="d-flex align-items-center mr-2">
								<?php 
									$penulis = $adminModel->find($mitra['admin_username']);
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
								<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?=site_url('mitra/' . $mitra['id'])?>" class="btn btn-sm btn-link text-white p-1" style="background-color: #3b5998; width: 30px; height: 30px">
									<i class="fab fa-facebook-f" style="font-size:15pt; top: 1px; position: relative;"></i>
								</a>
								<a target="_blank" href="http://twitter.com/share?url=<?=site_url('mitra/' . $mitra['id'])?>" class="btn btn-sm btn-link text-white p-1" style="background-color: #55acee; width: 30px; height: 30px">
									<i class="fab fa-twitter" style="font-size:15pt; top: 1px; position: relative;"></i>
								</a>
								<a target="_blank" href="mailto:?Subject=Artikel Berjudul <?=$judul?>&Body=Kunjungi selengakpnya di <?=site_url('mitra/' . $mitra['id'])?>" class="btn btn-sm btn-link text-white p-1" style="background-color: #D93025; width: 30px; height: 30px">
									<i class="fas fa-envelope" style="font-size:15pt; left: -1px; position: relative;"></i>
								</a>
								<a target="_blank" href="whatsapp://send?text=Artikel berjudul <?=$judul?>, Kunjungi selengakpnya di <?=site_url('mitra/' . $mitra['id'])?>" data-action="share/whatsapp/share" class="btn btn-sm btn-link text-white p-1" style="background-color: #28A219; width: 30px; height: 30px">
									<i class="fab fa-whatsapp" style="font-size:15pt; top: 0px; position: relative;"></i>
								</a>
								<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=site_url('mitra/' . $mitra['id'])?>" class="btn btn-sm btn-link text-white p-1" style="background-color: #007bb5; width: 30px; height: 30px">
									<i class="fab fa-linkedin-in" style="font-size:15pt; top: 0px; position: relative;"></i>
								</a>
							</div>
							<span class="font-italic" style="font-size: 7pt; font-weight: 700; font-family: 'Raleway', sans-serif; color: #7d7d7d;"><?=$nama_hari[date('N', strtotime($mitra['created_at']))]?>, <?=date('d', strtotime($mitra['created_at']))?> <?=$nama_bulan[date('n', strtotime($mitra['created_at']))]?> <?=date('Y', strtotime($mitra['created_at']))?> </span>
						</div>
						<div class="row">
							<div class="col article">
								<?php 
									if (file_exists('./files/mitra/' . $mitra['file_artikel'])) {
										$article = file_get_contents('./files/mitra/' . $mitra['file_artikel']);
										if ($article != '') {
											echo $article;
										}
										else {
											echo "<div class='d-block text-center mt-5' style='font-size: 15pt'>- Tidak ada artikel terkait -</div>";
										}
									}
									else {
										echo "<div class='d-block text-center mt-5' style='font-size: 15pt'>- Tidak ada artikel terkait -</div>";

									}
								?>
							</div>
						</div>
					</div> <!-- end col for article -->
				</div>
			</div>
			<div class="col">
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
								$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
							}
							else if ($content_col['jenis_konten'] == 'terpopuler'){
								$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
							}
							else if ($content_col['jenis_konten'] == 'kategori'){

								$data_artikel = $artikelModel->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
							}
							else if ($content_col['jenis_konten'] == 'featured') {
								$data_artikel = $artikelModel->find($options->featured);
							} 
							else if ($content_col['jenis_konten'] == 'penulis') {
								$data_artikel = $artikelModel->where('penulis_username', $options->penulis)->findAll($options->limit);
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
								$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
								$readmore_url = site_url('terkini');
							}
							else if ($content_col['jenis_konten'] == 'terpopuler'){
								$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
								$readmore_url = site_url('terpopuler');
							}
							else if ($content_col['jenis_konten'] == 'kategori'){
								$data_artikel = $artikelModel->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
								$kategori = $kategoriModel->find($options->kategori_id);
								if ($kategori != '') {
									$readmore_url = site_url('kategori/' . $kategori['slug']);
								}
							}
							else if ($content_col['jenis_konten'] == 'featured') {
								$data_artikel = $artikelModel->find($options->featured);
							} 
							else if ($content_col['jenis_konten'] == 'penulis') {
								$data_artikel = $artikelModel->where('penulis_username', $options->penulis)->findAll($options->limit);
								$readmore_url = site_url('penulis/' . $options->penulis);
							}
					?>
					<div class="col-12">
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
								$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
								$readmore_url = site_url('terkini');
							}
							else if ($content_col['jenis_konten'] == 'terpopuler'){
								$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
								$readmore_url = site_url('terpopuler');
							}
							else if ($content_col['jenis_konten'] == 'kategori'){
								$data_artikel = $artikelModel->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
								$kategori = $kategoriModel->find($options->kategori_id);
								if ($kategori != '') {
									$readmore_url = site_url('kategori/' . $kategori['slug']);
								}
							}
							else if ($content_col['jenis_konten'] == 'featured') {
								$data_artikel = $artikelModel->find($options->featured);
							} 
							else if ($content_col['jenis_konten'] == 'penulis') {
								$data_artikel = $artikelModel->where('penulis_username', $options->penulis)->findAll($options->limit);
								$readmore_url = site_url('penulis/' . $options->penulis);
							}
					?>
					<div class="col-12 pb-2">
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
								$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
								$readmore_url = site_url('terkini');
							}
							else if ($content_col['jenis_konten'] == 'terpopuler'){
								$data_artikel = $artikelModel->orderBy('updated_at', 'desc')->findAll($options->limit);
								$readmore_url = site_url('terpopuler');
							}
							else if ($content_col['jenis_konten'] == 'kategori'){
								$data_artikel = $artikelModel->like('kategori_id', $options->kategori_id, 'both')->orderBy('updated_at', 'desc')->findAll($options->limit);
								$kategori = $kategoriModel->find($options->kategori_id);
								if ($kategori != '') {
									$readmore_url = site_url('kategori/' . $kategori['slug']);
								}
							}
							else if ($content_col['jenis_konten'] == 'featured') {
								$data_artikel = $artikelModel->find($options->featured);
							} 
							else if ($content_col['jenis_konten'] == 'penulis') {
								$data_artikel = $artikelModel->where('penulis_username', $options->penulis)->findAll($options->limit);
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
							$data_tahun = $artikelModel->select("DISTINCT(YEAR(created_at)) AS year")->orderBy('year', 'desc')->findAll();
					?>
					<div class="col">
						<div class="card mb-0 border border-<?=((isset($options->border)) ? $options->border : '')?>" style='border-radius: 4px'>
							<div class="card-header py-2 bg-<?=((isset($options->background)) ? $options->background : 'white')?>">
								<div class="card-title widget-title mb-0 text-<?=((isset($options->color)) ? $options->color : 'dark')?>"><?=$content_col['judul']?></div>
							</div>
							<div class="card-body p-0">
								<ul class="nav flex-column" id="accordion-<?=$content_col['id']?>">
									<?php 
										foreach ($data_tahun as $index_tahun => $tahun) {
											$data_bulan = $artikelModel->select("DISTINCT(MONTH(created_at)) AS month")->where('YEAR(created_at)', $tahun['year'])->orderBy('month', 'desc')->findAll();

									?>
									<li class="nav-item bg-default">
										<h5 style="font-size: 9pt; cursor: pointer" class="nav-link font-weight-bold mb-0 p-3" data-toggle="collapse" data-target="#collapse-<?=$content_col['id']?>-<?=$tahun['year']?>">2021</h5>
										<div class="collapse <?=(($index_tahun == 0) ? 'show' : '')?>" data-parent="#accordion-<?=$content_col['id']?>" id="collapse-<?=$content_col['id']?>-<?=$tahun['year']?>">


											<ul class="nav flex-column" id="accordion-<?=$content_col['id']?>-<?=$tahun['year']?>">
												<?php 
													foreach ($data_bulan as $index_bulan => $bulan) {
														$data_artikel = $artikelModel->where('YEAR(created_at)', $tahun['year'])->where('MONTH(created_at)', $bulan['month'])->findAll();
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
			</div>
		</div>
	</div>
</div>
<?php $this->endSection() ?>

<?php $this->section('modalContent') ?>
<!-- <div class="pratinjau">
	<h6>Pratinjau Halaman</h6>
	<p>Halaman ini hanya sebagai pratinjau dari artikel yang anda tulis. Anda bisa menutup tab ini setelah selesai</p>
</div> -->
<?php $this->endSection() ?>


<?php $this->section('jsContent') ?>
<script type="text/javascript">
	$("#mitra-gallery").lightSlider({
		gallery: true,
		item: 1,
        // adaptiveHeight:true,
		thumbItem: 8,
		loop: true,
		// auto: true,
		// pause: 3000,
	})
</script>
<?php $this->endSection() ?>