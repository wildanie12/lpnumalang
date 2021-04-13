<?php $this->extend('template/mitra-detail') ?>


<?php $this->section('content') ?>
<div class="container-fluid" style="box-shadow: 0px 0 18px 0px #00000024; position: relative;">
	<div class="row">
		<div class="col-md-6 pr-0 pl-0 mr-0">
			<ul id="mitra-gallery" class="light-slider">
				<?php 
					$galeri = explode('|', $mitra['galeri']);
					foreach ($galeri as $gambar) {
				?>
				<li data-thumb="<?=$gambar?>">
					<img src="<?=$gambar?>">
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
<div class="header mt-4" style="background-color: #F5F5F5">
	<div class="container-fluid container-wildanie pt-4">
		<div class="row">
			<div class="col-lg-8">
				<div class="row mb-1">
					<div class="col">
						<h1 class="m-0" style="font-family: 'Raleway', sans-serif; font-weight: 700; font-size: 24pt">Profil Mitra LPNU: <?=$judul?></h1>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col d-flex flex-row align-items-center" style="font-size: 8pt; color: #099543; font-weight: 700;">
						<div class="d-flex flex-row align-items-center mr-4" style="">
							<?php 
								$penulis_text = '';
								$gambar = 'admin-default.png';
								$penulis = $adminModel->find($mitra['admin_username']);
								if (is_array($penulis)) {
									$penulis_text = $penulis['nama_lengkap'];
			                        if ($penulis['avatar'] != '') {
			                            if (file_exists('./images/profile/' . $penulis['avatar'])) {
			                                $gambar = $penulis['avatar'];
			                            }
			                        }
								}
								else {
									$penulis_text = 'Tidak diketahui';
								}
		                    ?>
							<img src="<?=site_url('images/profile/' . $gambar)?>" class="rounded-circle mr-1" style='height: 20px;'>
							<span><?=$mitra['admin_username']?></span>
						</div>
						<span class="mr-4"><i class="fas fa-calendar-alt pr-2"></i><?=date('d-m-Y H:i:s', strtotime($mitra['created_at']))?></span>
						<span class="label label-warning font-weight-bold text-dark mr-1">Profil Mitra</span>
					</div>
				</div>
				<div class="row">
					<div class="col article">
						<?=file_get_contents('./files/mitra/' . $mitra['file_artikel'])?>
					</div>
				</div>
			</div> <!-- end col for article -->
			<div class="col">
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header bg-primary">
								<h5 class="card-title mb-0 font-weight-bold" style="font-size: 12pt">Widget Title</h5>	
							</div>
							<div class="card-body">
								<div style="border: 2px dashed black; width: 100%; height: 200px"></div>
							</div>
						</div>
					</div>
				</div>
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

		thumbItem: 8,
		loop: true,
		auto: true,
		pause: 3000,
	})
</script>
<?php $this->endSection() ?>