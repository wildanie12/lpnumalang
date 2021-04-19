<?php 
	$i = 0;
	foreach ($data_mitra as $mitra) {
		$i++;
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
<div class="col-lg-4 col-md-6 col-sm-12 col-12">
	<div class="card">
		<div class="card-body p-3">
			<div class="row">
				<div class="col-8" style="z-index: 100">
					<h2 class="mb-3" style="color: #099543; font-weight: bolder"><?=$judul?> </h2>			
					<hr class="mb-2 mt-0">

					<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
					<h4 style="font-weight: bolder"><?=$mitra['nama_pemilik']?></h4>

					<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt; display: block">Kategori Usaha</span>
					<?php 
						if ($mitra['jenis_usaha'] != '') {
							$jenis_usaha = explode('|', $mitra['jenis_usaha']);
							if (is_array($jenis_usaha)) {
								foreach ($jenis_usaha as $jenis) {
									echo "<span class='badge badge-warning font-weight-bold text-dark'>$jenis</span>";
								}
							}
							else {
								echo "<span class='badge badge-warning font-weight-bold text-dark'>$jenis_usaha</span>";
							}
						}
						else {
							echo "-";
						}
					?>

					<span class="text-muted text-uppercase d-block" style="font-weight: bolder; font-size: 8pt">Alamat</span>
					<h4 style="font-weight: bolder"><?=$mitra['alamat_usaha']?></h4>
				</div>
				<?php 
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
					if ($url_gambar == '') {
						$url_gambar = site_url('img_unavailable.png');
					}
				?>
				<div class="col-6 center-crop" style="background-image: url('<?=$url_gambar?>'); margin-left: -20%; overflow: hidden">
					<div class="triangle"><div></div></div>
					<div class="row" style="position: absolute; right: 0; bottom: 6px; z-index: 999">
						<div class="col d-flex justify-content-center">
							<a href="<?=site_url('mitra/' . $mitra['id'])?>" target="_blank" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
								<i class="fas fa-eye"></i>
							</a>
							<a href="<?=site_url('admin/mitra/edit/' . $mitra['id'])?>" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a href="#" data-id='<?=$mitra['id']?>' class="btn btn-danger btn-content-delete btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
								<i class="fas fa-trash"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end card -->
</div> <!-- end col -->
<?php 
	}
	if ($i == 0) {
?>
<div class="col-12">
	<div class="card">
		<div class="card-body bg-danger p-3 text-center">
			<i class="fas fa-exclamation-triangle text-white mb-2" style="font-size: 40pt"></i>
			<h4 class="text-center text-white">Ups, tidak ada data mitra yang tersedia</h4>
		</div>
	</div>
</div>
<?php 
	}
?>