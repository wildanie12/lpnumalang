<?php 
	foreach ($data as $artikel) {
		$penulis = $adminModel->find($artikel['penulis_username']);
?>
<div class="row mb-2 btn-content" data-href='<?=site_url('admin/postingan/artikel/edit/' . $artikel['id'])?>'>
	<div class="col p-3 border border-success rounded">
		<div class="row align-items-center justify-content-between">
			<div class="col-9 col-sm-7 col-lg-9 pr-0">
				<div class="row align-items-center">
					<div class="col-auto pr-0">
						<div class="mr-3 artikel-thumbnail" style="overflow: hidden;">
							<?php 
								$gambar = '';
								if ($artikel['daftar_gambar'] != '') {
									$gambar_array = explode('|', $artikel['daftar_gambar']);
									$gambar = $gambar_array[0];
								}
								else {
									$gambar = site_url('img_unavailable.png');
								}
							?>
							<img src="<?=$gambar?>" class="foto-profil" style="width: 100%">
						</div>
					</div>
					<div class="col-7 col-sm-7 col-lg-9 pl-0">
						<div class="mb-0 font-weight-bold" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 13pt"><?=$artikel['judul']?></div>
						<?php 
							if ($artikel['status'] == 'dipublikasikan') {
						?>
						<span class="badge bg-lpnu text-white" style="font-size: 8pt !important; font-weight: bolder !important;">
							<i class='fas fa-paper-plane mr-1'></i><?=ucwords(strtolower($artikel['status']))?>
						</span>
						<?php 
							}
							else if ($artikel['status'] == 'draf') {
						?>
						<span class="badge bg-warning text-white" style="font-size: 8pt !important; font-weight: bolder !important;">
							<i class='fas fa-file-alt mr-1'></i><?=ucwords(strtolower($artikel['status']))?>
						</span>
						<?php 
							}
						?>
						<span class="text-sm text-dark font-weight-bold d-none d-sm-inline-block">
							<i class="fas fa-circle mx-1" style="font-size: 4pt; position: relative; top: -3px;"></i>
						</span>
						<span class="text-danger text-uppercase d-block d-sm-inline-block" style="font-size: 9pt; font-weight: bolder;">
							<?=date('d F Y', strtotime($artikel['created_at']))?>
						</span>
						<?php 
							if ($artikel['kategori_id'] != '') {
								$kategori_id = explode('|', $artikel['kategori_id']);
								foreach ($kategori_id as $id) {
									$kategori = $kategoriModel->find($id);
						?>
						<span class="badge bg-default text-white p-1" style="font-size: 7pt !important; font-weight: bolder !important;">
							<i class='fas fa-tag mr-1'></i><?=(($kategori != '') ? $kategori['kategori'] : '')?>
						</span>
						<?php 
								}
							}
						?>
					</div>
				</div>
			</div> <!-- end col -->
			<div class="col-sm-5 col-lg-3 text-right d-sm-flex flex-column align-items-end">
				<?php 
					if ($penulis != '') {
				?>
				<div class="profile d-flex align-items-center mb-1">
					<span class="text-default mr-2" style="font-size: 10pt; text-transform: uppercase; font-weight: bold;"><?=$penulis['nama_lengkap']?></span>
					<div class="rounded-circle" style="width: 40px; height: 40px; overflow: hidden;">
						<img src="<?=site_url('images/profile/' . $penulis['avatar'])?>" class='foto-profil'>
					</div>
				</div>
				<?php 
					}
				?>
				<div>
					<a href="javascript:void(0)" class="btn btn-warning btn-sm btn-pilih-artikel" data-judul="<?=$artikel['judul']?>" data-id='<?=$artikel['id']?>'>
						<i class="fas fa-check-square mr-1"></i>
						Gunakan
					</a>
				</div>
			</div> <!-- end col btn for large screen -->
		</div>
	</div>
</div>
<?php 
	}
	if (count($data) <= 0) {
?>
<div class="row">
	<div class="col bg-danger p-3 text-center">
		<i class="fas fa-exclamation-triangle text-white mb-2" style="font-size: 40pt"></i>
		<h4 class="text-center text-white">Ups, tidak ada data artikel yang tersedia</h4>
	</div>
</div>
<?php 
	}
?>