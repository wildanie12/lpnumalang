<div class="row">
	<div class="col">
		<h3>Widget</h3>
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
	if (count($data) > 0) {
	$max_row = max(array_column($data, 'row'));
	for ($row = 1; $row <= $max_row; $row++) {
?>
<div class="row mb-2">
	<?php 
		$data_row = searchByKeyVal($data, 'row', $row);
		if (count($data_row) <= 0)
			continue;
		foreach ($data_row as $col) {
	?>
	<div class="col mx-1 rounded align-items-center d-flex justify-content-between py-2" style="min-height: 120px; border: 1px solid #172b4d;"  id="element-<?=$col['id']?>">
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
		</div>
		<div class="d-flex flex-row">
			<div class="d-flex flex-column mr-1">
				<?php 
					if ($row != 1) {
				?>
				<button class="btn btn-link btn-sm mr-0 mb-1 btn-move-widget-up" data-toggle='tooltip' data-penempatan="widget" data-halaman="<?=$col['halaman']?>" data-row="<?=$row?>" title='Pindah ke atas' data-placement="left">
					<i class="fas fa-arrow-up"></i>
				</button>
				<?php 
					}
					if ($row != $max_row) {
				?>
				<button class="btn btn-link btn-sm mb-1 btn-move-widget-down" data-toggle='tooltip' data-penempatan="widget" data-halaman="<?=$col['halaman']?>" data-row="<?=$row?>" title='Pindah ke bawah' data-placement="left">
					<i class="fas fa-arrow-down"></i>
				</button>
				<?php 
					}
				?>
			</div>
			<div class="d-flex flex-column">
				<button class="btn btn-secondary btn-sm mr-0 mb-1 btn-edit-widget" data-id="<?=$col['id']?>" data-toggle='tooltip' title='Edit' data-placement="left">
					<i class="fas fa-pencil-alt"></i>
				</button>
				<button class="btn btn-danger btn-sm mb-1 btn-hapus-widget" data-id="<?=$col['id']?>" data-toggle='tooltip' title='Hapus' data-placement="left">
					<i class="fas fa-trash"></i>
				</button>
			</div>
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
	<div class="col mx-1 d-flex align-items-center justify-content-center rounded" style="min-height: 80px; border: 2px dashed #5e72e4;">
		<a href="#" class="btn btn-primary btn-sm btn-tambah-widget" data-max-row="<?=$max_row?>">
			<i class="fas fa-plus"></i>
			Tambah Widget
		</a>
	</div>
</div>