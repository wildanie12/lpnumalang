<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<!------------------------------------------------->
<!-------   Filter / Penyaringan data      -------->
<!------------------------------------------------->
<div class="header bg-primary py-4">
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body pt-3 pl-3 pr-3 pb-0">
						<div class="row">
							<div class="col-md-2 col-sm-6 col-12">
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Kecamatan</label>
									<select class="form-control form-control-sm" id="filter-kecamatan">
										<option value="">- Pilih kecamatan -</option>
										<?php 
											foreach ($data_kecamatan as $kecamatan) {
										?>
										<option value="<?=$kecamatan['kecamatan']?>"><?=ucwords(strtolower($kecamatan['kecamatan']))?></option>
										<?php 
											}
										?>
									</select>
								</div>
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Kelurahan</label>
									<select class="form-control form-control-sm" id="filter-kelurahan">
										<option value="">- Pilih Kelurahan -</option>
									</select>
								</div>
							</div> <!-- end col -->
							<div class="col-md-2 col-sm-6 col-12">
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Peran Ekonomi</label>
									<select class="form-control form-control-sm" id="filter-status_usaha">
										<option value="">- Pilih Peran Ekonomi -</option>
										<option value="produsen">Produsen</option>
										<option value="distributor">Distributor</option>
										<option value="agen">Agen</option>
										<option value="retail">Retail</option>
									</select>
								</div>
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Kategori Usaha</label>
									<select class="form-control form-control-sm" id="filter-jenis_usaha">
										<option value="">- Pilih kategori -</option>
										<?php 
											foreach ($data_kategori as $kategori) {
												echo "<option value='" . $kategori['kategori'] . "'>" . $kategori['kategori'] . "</option>";
											}
										?>
									</select>
								</div>
							</div> <!-- end col -->
							<div class="col-md-8 col-sm-12 col-12">
								<div class="row">
									<div class="col">
										<div class="form-group mb-1">
											<label class="form-control-label mb-0">Pencarian</label>
											<div class="input-group input-group-merge input-group-sm">
												<input type="text" class="form-control filter-pencarian">
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-search"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-4 col-lg-8 col-sm-6 col-6">
										<div class="form-group mb-1">
											<label class="form-control-label mb-1 d-block">Cari berdasarkan</label>
											<div class="custom-control custom-control-inline custom-radio">
												<input type="radio" name="cari_berdasarkan" value="nama_pemilik" class="custom-control-input filter-pencarian_berdasarkan" id="search_by_name">
												<label class="custom-control-label font-weight-bold text-uppercase" style="color: green; font-size: 11pt" for="search_by_name">Nama <div class="d-none d-lg-inline-block">Pemilik</div></label>
											</div>
											<div class="custom-control custom-control-inline custom-radio">
												<input type="radio" name="cari_berdasarkan" value="merek_dagang" class="custom-control-input filter-pencarian_berdasarkan" id="search_by_merek" checked>
												<label class="custom-control-label font-weight-bold text-uppercase" style="color: green; font-size: 11pt" for="search_by_merek">Merek <div class="d-none d-lg-inline-block">dagang</div></label>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-sm-6 col-6">
										<div class="form-group mb-1">
											<label class="form-control-label mb-1 d-block">Jumlah data/halaman</label>
											<div class="input-group input-group-merge input-group-sm">
												<input type="number" id="filter-limit" class="form-control form-control" value="50">
												<div class="input-group-append">
													<div class="input-group-text" style="font-size: 9pt !important">/ Halaman</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-sm-6 col-12">
										<div class="form-group mb-1">
											<label class="form-control-label mb-1 d-block">Halaman</label>
											<div class="input-group input-group-merge input-group-sm">
												<div class="input-group-prepend">
													<button class="btn btn-sm btn-warning filter-btn-previous">
														<i class="fas fa-arrow-left"></i>
													</button>
												</div>
												<input type="number" class="filter-page form-control form-control text-center font-weight-bold" value="1" min="1">
												<div class="input-group-append">
													<button class="btn btn-sm btn-warning filter-btn-next">
														<i class="fas fa-arrow-right"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div> <!-- end row filter content -->
							</div> <!-- end col -->
						</div> <!-- end row -->
						<div class="progress-wrapper p-0" style="visibility: visible;">
							<div class="progress mb-1">
								<div class="progress-bar bg-success progress-bar-animated progress-bar-striped" style="width: 100%"></div>
							</div>
						</div>
						<div class="d-none">
							<form action="<?=site_url('admin/mitra/delete')?>" method="post" id="form-delete">
								<input type="hidden" name="id">
							</form>
						</div>
					</div> <!-- end card-body -->
				</div> <!-- end card -->
			</div> <!-- end col -->
		</div> <!-- end row -->
	</div> <!-- end container-fluid -->
</div> <!-- end header -->

<!------------------------------------------------->
<!-------   Grid data mitra ---------      -------->
<!------------------------------------------------->

<div class="container-fluid mt--4">
	<div class="row" id="load-list-mitra">
	</div> <!-- end row -->

	<div class="row justify-content-center">
		<div class="col-6">
			<div class="form-group mb-1 text-center">
				<label class="form-control-label mb-1 d-block">Halaman</label>
				<div class="input-group input-group-merge input-group">
					<div class="input-group-prepend">
						<button class="btn btn-sm btn-warning filter-btn-previous">
							<i class="fas fa-arrow-left"></i>
						</button>
					</div>
					<input type="number" class="text-lg text-dark filter-page form-control form-control text-center font-weight-bold" value="1" min="1">
					<div class="input-group-append">
						<button class="btn btn-sm btn-warning filter-btn-next">
							<i class="fas fa-arrow-right"></i>
						</button>
					</div>
				</div>
			</div> <!-- end form-group -->
		</div> <!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container-fluid -->


<?php $this->endSection(); ?>

<?php $this->section('jsContent') ?>
<script type="text/javascript">
	$("#filter-kecamatan").change(function(e) {
		value = $(this).val()
		loadKelurahan(value)
	});
	function loadKelurahan(kecamatan) {
		if (kecamatan == '') {
			$("#filter-kelurahan").html("<option value=''>- Pilih Kelurahan -</option>")
		}
		else {
			$("#filter-kelurahan").html("<option value=''>- Pilih Kelurahan -</option>")
			$.ajax({
				url: '<?=site_url('admin/mitra/dynamic_form_kelurahan')?>',
				type: 'GET',
				dataType: 'html',
				data: {kecamatan: kecamatan},
			})
			.done(function(data) {
				$("#filter-kelurahan").append(data);
			});
		}
	}


	let mitraParams = {
		page: 1,
		limit: 50,
		pencarian_berdasarkan: 'merek_dagang'
	}
	function refreshMitra() {
		$(".progress").css('visibility', 'visible');
		$.ajax({
			url: '<?=site_url('admin/mitra/ajax_list/list-col-main')?>',
			type: 'GET',
			dataType: 'html',
			data: mitraParams,
		})
		.done(function(data) {
			$.getScript("<?=site_url('js/default.js')?>")
			$(".progress").css('visibility', 'hidden');
			$("#load-list-mitra").html(data);
			eventAfterLoadMitra();
		})
	}
	refreshMitra();

	function eventAfterLoadMitra() {
		$(".btn-content-delete").click(function(e) {
			if (confirm('Anda yakin?')) {
				$("#form-delete [name='id']").val($(this).data('id'));
				$("#form-delete").submit();
			}
		});
	}

	$(".filter-page").change(function(e) {
		value = $(this).val()
		if (value >= 1) {
			mitraParams.page = value
			$(".filter-page").val(value)
		}
		else {
			$(this).val(1);
			delete mitraParams.page
		}
		refreshMitra();
	})
	$(".filter-btn-previous").click(function(e) {
		value = $(".filter-page").val()
		value = parseInt(value) - 1
		if (value <= 0) {
			value = 1;
		}
		$(".filter-page").val(value)
		mitraParams.page = value
		refreshMitra();
	})
	$(".filter-btn-next").click(function(e) {
		value = $(".filter-page").val()
		value = parseInt(value) + 1
		$(".filter-page").val(value)
		mitraParams.page = value
		refreshMitra();
	})
	$("#filter-kecamatan").change(function(e) {
		value = $(this).val()
		if (value != '') {
			mitraParams.kecamatan = value
		}
		else {
			delete mitraParams.kecamatan
			delete mitraParams.kelurahan
		}
		refreshMitra();
	})
	$("#filter-kelurahan").change(function(e) {
		value = $(this).val()
		if (value != '') {
			mitraParams.kelurahan = value
		}
		else {
			delete mitraParams.kelurahan
		}
		refreshMitra();
	})
	$("#filter-status_usaha").change(function(e) {
		value = $(this).val()
		if (value != '') {
			mitraParams.status_usaha = value
		}
		else {
			delete mitraParams.status_usaha
		}
		refreshMitra();
	})
	$("#filter-jenis_usaha").change(function(e) {
		value = $(this).val()
		if (value != '') {
			mitraParams.jenis_usaha = value
		}
		else {
			delete mitraParams.jenis_usaha
		}
		refreshMitra();
	})
	$(".filter-pencarian").on('input', function(e) {
		value = $(this).val()
		if (value != '') {
			mitraParams.pencarian = value
		}
		else {
			delete mitraParams.pencarian
		}
		refreshMitra();
	})
	$(".filter-pencarian_berdasarkan").change(function(e) {
		value = $(this).val()
		if (value != '') {
			mitraParams.pencarian_berdasarkan = value
		}
		else {
			delete mitraParams.pencarian_berdasarkan
		}
		refreshMitra();
	})
	$("#filter-limit").change(function(e) {
		value = $(this).val()
		if (value >= 1) {
			mitraParams.limit = value
		}
		else {
			value = 50
			mitraParams.limit = value
			$(this).val(50)
		}
		refreshMitra();
	})

</script>
<?php $this->endSection(); ?>