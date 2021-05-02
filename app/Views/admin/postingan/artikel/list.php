<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<!------------------------------------------------->
<!-------   Filter / Penyaringan data      -------->
<!------------------------------------------------->


<div class="alert alert-default alert-dismissible justify-content-between col-md-3 col-11 py-3 pl-3 pr-0 align-items-center" role="alert" style="position: fixed; right: 16px; top: 16px; z-index: 1050; display: none">
	<div class="text-left d-flex align-items-center">
	    <div class="alert-icon"><i class="fas fa-thumbs-up"></i></div>
	    <div class="alert-text mr-3"><?=session()->getFlashdata('admin_artikel_msg')?></div>
	</div>
    <a href="javascript:void(0)" data-dismiss='alert' class="btn btn-link text-white">
    	<i class="fas fa-times"></i> 
    </a>
</div>



<div class="header bg-warning py-4">
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body pt-3 pl-3 pr-3 pb-0">
						<div class="row">
							<div class="col-xl-6 col-lg-4 col-sm-6 col-12">
								<div class="form-group mb-0">
									<label class="form-control-label mb-0">Cari dengan judul</label>
									<div class="input-group input-group-merge input-group-sm">
										<input type="text" id="filter-pencarian" class="form-control form-control-sm">
										<div class="input-group-append">
											<span class="input-group-text"><i class="fas fa-search"></i></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-4 col-sm-6 col-6">
								<div class="form-group mb-1">
									<labe class="form-control-label mb-1 d-block">Jumlah data/halaman</label>
									<div class="input-group input-group-merge input-group-sm">
										<input type="number" id="filter-limit" class="form-control form-control" value="50">
										<div class="input-group-append">
											<div class="input-group-text" style="font-size: 9pt !important">/ Halaman</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-4 col-sm-6 col-12">
								<div class="form-group mb-1">
									<labe class="form-control-label mb-1 d-block">Halaman</label>
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
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Kategori</label>
									<select class="form-control form-control-sm" id="filter-kategori">
										<option value="---">- Pilih kategori -</option>
										<option value="null">Tanpa kategori</option>
										<?php 
											foreach ($data_kategori as $kategori) {
										?>
										<option value="<?=$kategori['id']?>"><?=ucwords(strtolower($kategori['kategori']))?></option>
										<?php 
											}
										?>
									</select>
								</div>
							</div> <!-- end col -->
							<div class="col-md-4">
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Status Publikasi</label>
									<select class="form-control form-control-sm" id="filter-status">
										<option value="">- Pilih status -</option>
										<option value="dipublikasikan">Dipublikasikan</option>
										<option value="draf">Draf</option>
									</select>
								</div>
							</div> <!-- end col -->
							<div class="col-md-4">
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Penulis</label>
									<select class="form-control form-control-sm" id="filter-penulis">
										<option value="">- Pilih Penulis -</option>
										<?php 
											foreach ($data_penulis as $penulis) {
										?>
										<option value="<?=$penulis['username']?>"><?=ucwords(strtolower($penulis['nama_lengkap']))?></option>
										<?php 
											}
										?>
									</select>
								</div>
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
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body load-list">
					
				</div>
			</div>
		</div>
	</div> <!-- end row -->

	<div class="row justify-content-center pagination">
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
	jQuery(document).ready(function($) {
		
		<?php 
			if (session()->getFlashdata('admin_artikel_msg')) {
				echo "showAlert('" . session()->getFlashdata('admin_artikel_msg') . "', 'fas fa-thumbs-up', 'default')";
				echo "\n";
			}
		?>
		function showAlert(text, icon, color) {
			$(".alert").addClass('d-flex')
			$(".alert-icon i").attr('class', '')
			$(".alert-icon i").addClass(icon)
			$(".alert-text").html(text)

			classArray = ['alert-danger', 'alert-success', 'alert-info', 'alert-dark', 'alert-light', 'alert-warning', 'alert-primary', 'alert-secondary', 'alert-default']
			$.each(classArray, function(index, value) {
				$(".alert").removeClass(value)
			})
			$(".alert").addClass('alert-' + color)


			$(".alert").css({opacity: '0.0'}).animate({opacity: '1.0'}, 500)
			setTimeout(function() {
				$(".alert").animate({opacity: '0.0'}, 500, 'linear', function() {
					$(this).removeClass('d-flex')
					$(this).css('display', 'none')
				})
			}, 5000)
		}

		$(".content-dropdown").on('shown.bs.dropdown', function(e) {
			$(".pagination").hide();
		});
		$(".content-dropdown").on('hidden.bs.dropdown', function(e) {
			$(".pagination").show();
		});


		let params = {
			page: 1,
			limit: 50,
		}
		$(".progress-wrapper").css('visibility', 'hidden');
		function refreshList() {
			$(".progress-wrapper").css('visibility', 'visible');
			$.ajax({
				url: '<?=site_url('admin/postingan/artikel/ajax_list/list-row-main')?>',
				type: 'GET',
				dataType: 'html',
				data: params,
			})
			.done(function(data) {
				$(".load-list").html(data)
				$('[data-toggle="tooltip"]').tooltip()
				onLoadList()
			})
			.always(function(data) {
				$(".progress-wrapper").css('visibility', 'hidden')
			})
			
		}
		function onLoadList() {
			$(".foto-profil").one("load", function() {
			    hitungAspectRatio($(this))
			}).each(function() {
			    hitungAspectRatio($(this))
			})

			$(".btn-content-publikasikan").unbind('click').click(function(e) {
				e.preventDefault()

				$(this).tooltip('hide')
				status = $(this).data('status')
				id = $(this).data('id')

				$.ajax({
					url: '<?=site_url('admin/postingan/artikel/ajax_set_status')?>',
					type: 'POST',
					dataType: 'json',
					data: {
						status: status,
						id: id,
					},
				})
				.done(function(data) {
					showAlert(data.message.text, data.message.icon, data.message.color)
					if (data.status == 'success') {
						refreshList();
					}
				});
			});
			$(".btn-content-hapus").unbind('click').click(function(e) {
				e.preventDefault();
				if (confirm('Anda Yakin?')) {
					if (confirm('Artikel yang terhapus tidak dapat dikembalikan lagi, Anda yakin?')) {
						id = $(this).data('id')
						$.ajax({
							url: '<?=site_url('admin/postingan/artikel/ajax_delete')?>',
							type: 'POST',
							dataType: 'json',
							data: {id: id},
						})
						.done(function(data) {
							showAlert(data.message.text, data.message.icon, data.message.color)
							if (data.status == 'success') {
								refreshList();
							}
						});
						
					}
				}
			});
		}
		refreshList()


		$("#filter-pencarian").on('input', function(e) {
			value = $(this).val()
			if (value != '') {
				params.pencarian = value
			}
			else {
				delete params.pencarian
			}
			refreshList()
		})
		$("#filter-kategori").change(function(e) {
			value = $(this).val()
			if (value != '---') {
				params.kategori = value
			}
			else {
				delete params.kategori
			}
			refreshList()
		})
		$("#filter-status").change(function(e) {
			value = $(this).val()
			if (value != '') {
				params.status = value
			}
			else {
				delete params.status
			}
			refreshList()
		})
		$("#filter-penulis").change(function(e) {
			value = $(this).val()
			if (value != '') {
				params.penulis = value
			}
			else {
				delete params.penulis
			}
			refreshList()
		})
		$("#filter-page").change(function(e) {
			value = $(this).val()
			if (value != '') {
				params.page = value
			}
			else {
				delete params.page
			}
			refreshList()
		})
		$(".filter-btn-previous").click(function(e) {
			value = $(".filter-page").val()
			value = parseInt(value) - 1
			if (value <= 0) {
				value = 1;
			}
			$(".filter-page").val(value)
			params.page = value
			refreshList()
		})
		$(".filter-btn-next").click(function(e) {
			value = $(".filter-page").val()
			value = parseInt(value) + 1
			$(".filter-page").val(value)
			params.page = value
			refreshList()
		})

	});
</script>
<?php $this->endSection(); ?>