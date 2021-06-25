<div class="overlay-loading p-2 bg-dark d-none">
	<div class="h-100 w-100 d-flex justify-content-center align-items-center flex-column">
		<div class="progress progress-content mb-0" style="height: 16px; width: 90%">
			<div class="progress-bar bg-warning progress-bar-animated progress-bar-striped" style="width: 100%"></div>
		</div>
		<h3 class="text-center text-white mt-3">Menyimpan...</h3>
	</div>
</div>
<div class="row">
	<div class="col">
		<h3>Konten Utama</h3>
		<hr class="mt-3 mb-2">
	</div>
</div>
<?php 
	function searchByKeyVal($array, $key, $value) {
		$result_array = [];
		if (is_array($array)) {
			if (isset($array[$key]) && $array[$key] == $value) {
				$result_array[] = $array;
			}
			foreach ($array as $row) {
				$result_array = array_merge($result_array, searchByKeyVal($row, $key, $value));
			}
		}
		return $result_array;
	}

	// Mengambil nilai minimum dan maksimum dari row
	if (count($data) > 0) {
	$max_row = max(array_column($data, 'row'));
?>
<?php
	for ($row = 1; $row <= $max_row; $row++) {
		$data_row = searchByKeyVal($data, 'row', $row);
		if (count($data_row) <= 0)
			continue;
		$max_col = max(array_column($data_row, 'urutan_col'));
		$count_col = count($data_row);
?>
<div class="row border border-warning border-bottom-0 rounded-top">
	<div class="col py-1 d-flex justify-content-left align-items-center bg-warning">
		<h5 class="mb-0 text-white mr-2">Baris <?=$row?></h5>
		<a href="#" class="btn btn-default btn-sm rounded-circle p-0 mr-1 btn-tambah-element-col" title='Tambah Elemen di baris ini' data-max-col="<?=$max_col?>" data-row="<?=$row?>" style="width: 20px; height: 20px;">
			<i class="fas fa-plus" style="position: relative; top: 1px"></i>
		</a>
		<?php 
			if ($row != 1) {
		?>
		<a href="#" class="btn btn-secondary btn-sm rounded-circle p-0 mr-1 btn-move-row-up" title='Pindah keatas' data-row="<?=$row?>" data-penempatan="content" data-halaman="homepage" style="width: 20px; height: 20px;"><i class="fas fa-arrow-up" style="position: relative; top: 1px"></i></a>
		<?php 
			}
			if ($row != $max_row) {
		?>
		<a href="#" class="btn btn-secondary btn-sm rounded-circle p-0 btn-move-row-down" title='Pindah kebawah' data-row="<?=$row?>" data-penempatan="content" data-halaman="homepage" style="width: 20px; height: 20px;"><i class="fas fa-arrow-down" style="position: relative; top: 1px"></i></a>
		<?php 
			}
		?>
	</div>
</div>
<div class="row mb-2" style="margin-top: -3px">


	<?php 
		foreach ($data_row as $col) {
	?>
	<div id="element-<?=$col['id']?>" class="col-lg-<?=$col['lebar_lg']?> col-md-<?=$col['lebar_md']?> col-sm-<?=$col['lebar_sm']?> col-<?=$col['lebar_xs']?> border-warning rounded align-items-center d-flex justify-content-between py-2" style="min-height: 120px; border: 1px solid #e9ecef">
		<div class="d-flex flex-column justify-content-center">
			<h4 class="mb-1"><?=$col['judul']?></h4>
			<div>
				<span class="badge badge-default">
					<i class="fas fa-database mr-1"></i>
					<?=$col['jenis_konten']?>
				</span>
				<span class="badge badge-success">
					<i class="fas fa-object-group mr-1"></i>
					<?=$col['view']?>
				</span>
			</div>
			<div>
				<hr class="mt-1 mb-0">
				<span class="badge badge-primary"> 
					<i class="fas fa-desktop mr-1"></i>
					<?=$col['lebar_lg']?>
				</span>
				<span class="badge badge-primary"> 
					<i class="fas fa-desktop mr-1"></i>
					<?=$col['lebar_md']?>
				</span>
				<span class="badge badge-primary"> 
					<i class="fas fa-tablet-alt mr-1"></i>
					<?=$col['lebar_sm']?>
				</span>
				<span class="badge badge-primary"> 
					<i class="fas fa-mobile-alt mr-1"></i>
					<?=$col['lebar_xs']?>
				</span>	
			</div>
		</div>
		<div class="d-flex flex-column">
			<?php 
				if ($col['urutan_col'] != 1) {
			?>
			<button class="btn btn-link btn-sm mr-0 mb-1 btn-move-col-left" data-id="<?=$col['id']?>" title='Pindah ke kiri' data-placement="left">
				<i class="fas fa-arrow-left"></i>
			</button>
			<?php 
				}
				if ($col['urutan_col'] != $max_col && $count_col > 1) {
			?>
			<button class="btn btn-link btn-sm mr-0 mb-1 btn-move-col-right" data-id="<?=$col['id']?>" title='Pindah ke kanan' data-placement="left">
				<i class="fas fa-arrow-right"></i>
			</button>
			<?php 
				}
			?>
			<button class="btn btn-secondary btn-sm mr-0 mb-1 btn-edit" data-id='<?=$col['id']?>' title='Edit' data-placement="left">
				<i class="fas fa-pencil-alt"></i>
			</button>
			<button class="btn btn-danger btn-sm mr-0 mb-1 btn-hapus" data-id='<?=$col['id']?>' title='Hapus' data-placement="left">
				<i class="fas fa-trash"></i>
			</button>
		</div>
	</div>	<!-- end element -->
	<?php 
		}
	?>
</div> <!-- end row -->
<?php 
	}
	}
	else 
		$max_row = 0;
?>
<div class="row">
	<div class="col d-flex align-items-center justify-content-center rounded" style="min-height: 80px; border: 2px dashed #fb6340;">
		<a href="#" class="btn btn-warning btn-tambah-element-row btn-sm" data-max-row="<?=$max_row?>">
			<i class="fas fa-plus"></i>
			Tambah Baris
		</a>
	</div>
</div>
