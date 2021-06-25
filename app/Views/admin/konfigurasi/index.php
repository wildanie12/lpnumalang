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


<div class="header bg-dark py-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col d-flex justify-content-start align-items-center">
				<i class="fas fa-cog fa-spin" style="font-size: 32pt; color: white"></i>
				<div class="title ml-4" >
					<h2 class="text-white text-uppercase mb-0">Konfigurasi Website</h2>
				</div>
			</div> <!-- end col -->
			<div class="col-auto d-flex flex-column">
				<a href="<?=base_url()?>" target="preview_website" class="btn btn-warning pl-2 btn-sm">
					<i class="fas fa-eye mr-1"></i>
					Lihat Website
				</a>
			</div>
		</div> <!-- end row -->
	</div> <!-- end container-fluid -->
</div> <!-- end header -->
<div class="container-fluid mt--3" >
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body pt-3">
					<div class="row">
						<div class="col-sm-8">
							<form action="<?=site_url('admin/konfigurasi/submit')?>">
								<h5 class="text-uppercase text-xs" style="color: #bfbfbf">Pengaturan Website secara Umum</h5>
								<hr class="mt-2 mb-3">
								<div class="row pl-3">
									<div class="form-group lpnu-form col">
										<label class="form-control-label font-weight-500">Nama Website</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-signature"></i></span>
											</div>
											<input type="text" name="APP_JUDUL" class="form-control" value='<?=$konfigurasi['APP_JUDUL']['value']?>'>
										</div>
									</div>
								</div>
								<div class="row pl-3">
									<div class="form-group lpnu-form col">
										<label class="form-control-label font-weight-500">Deskripsi Website</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-quote-left"></i></span>
											</div>
											<textarea rows="4" name="APP_DESCRIPTION" class="form-control"><?=$konfigurasi['APP_DESCRIPTION']['value_text']?></textarea>
										</div>
									</div>
								</div>
								<div class="row pl-3">
									<div class="form-group lpnu-form col-sm">
										<label class="form-control-label font-weight-500">Teks pada Logo</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-heading"></i></span>
											</div>
											<input type="text" name="APP_LOGO_TEXT" value="<?=$konfigurasi['APP_LOGO_TEXT']['value']?>" class="form-control element-gambar-b">
										</div>
										<span class="text-muted text-xs font-italic">Tambahkan <strong>&lt;br></strong> untuk enter</span>
									</div>
								</div>
								<div class="row pl-3">
									<div class="form-group lpnu-form col-sm">
										<label class="form-control-label font-weight-500">Logo Utama Website</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-image"></i></span>
											</div>
											<input type="file" name="APP_LOGO" class="form-control element-gambar">
										</div>
										<span class="text-muted font-italic text-xs">Gambar logo ini muncul di menu utama atas</span>
									</div>
									<div class="form-group lpnu-form col-sm">
										<label class="form-control-label font-weight-500">Logo Footer Website</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-image"></i></span>
											</div>
											<input type="file" name="APP_LOGO_FOOTER" class="form-control element-gambar-b">
										</div>
										<span class="text-muted font-italic text-xs">Gambar ini muncul di footer bagian bawah artikel</span>
									</div>
								</div>
								<h5 class="text-uppercase text-xs mt-4" style="color: #bfbfbf">Footer</h5>
								<hr class="mt-2 mb-3">
								<div class="row pl-3">
									<div class="form-group lpnu-form col-sm pr-sm-1">
										<label class="form-control-label font-weight-500">Judul Footer</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-heading"></i></span>
											</div>
											<input type="text" name="APP_FOOTER_JUDUL" class="form-control" value="<?=$konfigurasi['APP_FOOTER_JUDUL']['value']?>">
										</div>
										<span class="text-muted text-xs font-italic">Tambahkan <strong>&lt;br></strong> untuk enter</span>
									</div>
									<div class="form-group lpnu-form col-sm pl-sm-1">
										<label class="form-control-label font-weight-500">Sub Judul Footer</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-heading"></i></span>
											</div>
											<input type="text" name="APP_FOOTER_SUBJUDUL" class="form-control" value="<?=$konfigurasi['APP_FOOTER_SUBJUDUL']['value']?>">
										</div>
										<span class="text-muted text-xs font-italic">Tambahkan <strong>&lt;br></strong> untuk enter</span>
									</div>
								</div>
								<div class="row pl-3">
									<div class="form-group lpnu-form col-sm">
										<label class="form-control-label font-weight-500">Pesan Copyright Footer</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-copyright"></i></span>
											</div>
											<input type="text" name="APP_FOOTER_COPYRIGHT" class="form-control" value="<?=$konfigurasi['APP_FOOTER_COPYRIGHT']['value_text']?>">
										</div>
									</div>
								</div>
								<div class="row pl-3">
									<div class="form-group lpnu-form col-sm">
										<label class="form-control-label font-weight-500">Alamat</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
											</div>
											<textarea rows="4" name="APP_FOOTER_ALAMAT" class="form-control"><?=$konfigurasi['APP_FOOTER_ALAMAT']['value_text']?></textarea>
										</div>
										<span class="text-muted text-xs font-italic">Tambahkan <strong>&lt;br></strong> untuk enter</span>
									</div>
								</div>
								<h5 class="text-uppercase text-xs mt-4" style="color: #bfbfbf">Menu Navigasi</h5>
								<hr class="mt-2 mb-3">
								<div class="row">
									<div class="col table-responsive">
										<input type="hidden" name="APP_NAVBAR">
										<button class="btn-tambah-nav btn-sm btn btn-primary">Tambah Menu</button>
										<table class="table table-sm mt-2">
											<thead>
												<tr>
													<th style="width: 60px"></th>
													<th>Ikon</th>
													<th>Judul</th>
													<th>Link</th>
												</tr>
											</thead>
											<tbody class="load-nav">
											</tbody>
										</table>
									</div>
								</div>

								<h5 class="text-uppercase text-xs mt-4" style="color: #bfbfbf">Postingan Artikel</h5>
								<hr class="mt-2 mb-4">
								<div class="row pl-3">
									<div class="form-group lpnu-form col">
										<label class="form-control-label font-weight-500">Batas jumlah Artikel pada postingan Terkini</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-file-alt"></i></span>
											</div>
											<input type="number" value="<?=$konfigurasi['CONTENT_LIMIT_POST_TERKINI']['value']?>" name="CONTENT_LIMIT_POST_TERKINI" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">Artikel/Halaman</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row pl-3">
									<div class="form-group lpnu-form col">
										<label class="form-control-label font-weight-500">Batas jumlah Artikel pada postingan Terpopuler</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-file-alt"></i></span>
											</div>
											<input type="number" value="<?=$konfigurasi['CONTENT_LIMIT_POST_TERPOPULER']['value']?>" name="CONTENT_LIMIT_POST_TERPOPULER" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">Artikel/Halaman</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row pl-3">
									<div class="form-group lpnu-form col">
										<label class="form-control-label font-weight-500">Batas jumlah Artikel pada postingan kategori</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-file-alt"></i></span>
											</div>
											<input type="number" value="<?=$konfigurasi['CONTENT_LIMIT_POST_KATEGORI']['value']?>" name="CONTENT_LIMIT_POST_KATEGORI" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">Artikel/Halaman</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row pl-3">
									<div class="form-group lpnu-form col">
										<label class="form-control-label font-weight-500">Batas jumlah Artikel pada postingan penulis</label>
										<div class="input-group input-group-merge">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fas fa-file-alt"></i></span>
											</div>
											<input type="number" value="<?=$konfigurasi['CONTENT_LIMIT_POST_PENULIS']['value']?>" name="CONTENT_LIMIT_POST_PENULIS" class="form-control">
											<div class="input-group-append">
												<span class="input-group-text">Artikel/Halaman</span>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="col-sm-4 text-center">
							<h4 class="text-center mb-0 text-uppercase">Logo Utama</h4>
							<hr class="my-3">
							<img src="<?=site_url($konfigurasi['APP_LOGO']['value_text'])?>" class="gambar-fill" style="max-width: 100%;">
							<br>
							<hr class="mt-5 mb-2">
							<h4 class="text-center mb-0 text-uppercase">Logo Footer</h4>
							<hr class="mb-3 mt-2">
							<img src="<?=site_url($konfigurasi['APP_LOGO_FOOTER']['value_text'])?>" class="gambar_b-fill" style="max-width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->endSection(); ?>
<?php $this->section('jsContent') ?>
<div class="modal fade" id="modal-tambah-nav">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title mb-0">Tambah Menu navigasi</h4>
				<button class="close p-2" data-dismiss="modal" type="button">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body pt-2">
				<form>
					<div class="row">
						<div class="form-group lpnu-form mb-1 col-sm-4 pr-sm-1">
							<label class="form-control-label font-weight-500">Icon Menu</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span>
								</div>
								<input type="text" name="icon" class="form-control" placeholder="contoh: fas fa-home, fas fa-address-card, dll.. ">
							</div>
							<div class="text-muted text-xs font-italic mt-1" style="line-height: 15px">Ikon diambil dari layanan FontAwesome 5, Kunjungi Galeri Ikonnya <a href="https://fontawesome.com/v5.15/icons?d=gallery" target="fontawesome_icon">disini</a></div>
						</div>
						<div class="form-group lpnu-form mb-1 col-sm pl-sm-1">
							<label class="form-control-label font-weight-500">Judul Menu</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-signature"></i></span>
								</div>
								<input type="text" name="judul" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group lpnu-form col-sm mb-1 pr-sm-1">
							<label class="form-control-label font-weight-500">Jenis Link</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-link"></i></span>
								</div>
								<select name="jenis_link" class="form-control">
									<option value="url">Link URL</option>
									<option value="halaman">Halaman</option>
									<option value="dropdown">Dropdown</option>
								</select>
							</div>
						</div>
						<div class="form-group lpnu-form col-sm option-halaman mb-1 pl-sm-1" style="display: none;">
							<label class="form-control-label font-weight-500">Pilih Halaman</label><br/>
							<input type="hidden" name="halaman_id">
							<button type="button" class="btn btn-default btn-pilih-halaman" data-for="[name='halaman_id']">
								<i class="fas fa-file-alt mr-1"></i>
								Pilih Halaman
							</button>
							<h4 class="mt-1 halaman-judul" style="display: none;">Digunakan: Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
						</div>
						<div class="form-group lpnu-form col-sm option-url mb-1 pl-sm-1">
							<label class="form-control-label font-weight-500">Alamat Url</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-link"></i></span>
								</div>
								<input type="text" name="url" class="form-control" placeholder="Contoh: http://www.google.com .. ">
							</div>
						</div>
					</div>
					<div class="row option-table-dropdown mt-3" style="display: none">
						<div class="form-group lpnu-form col-sm">
							<label class="form-control-label font-weight-500">Daftar Link Dropdown</label>
							<br>
							<button type="button" class="btn btn-sm btn-default btn-tambah-nav-dropdown">
								<i class="fas fa-file-alt mr-1"></i>
								Tambah Menu Dropdown
							</button>
							<table class="table mt-2">
								<thead>
									<tr>
										<th>Icon</th>
										<th>Judul</th>
										<th></th>
									</tr>
								</thead>
								<tbody class="load-nav-dropdown"></tbody>
							</table>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<button type="submit" class="btn btn-default btn-block">
								<i class="fas fa-paper-plane mr-1"></i>
								Tambahkan
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-tambah-nav-dropdown">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title mb-0">Tambah Menu Dropdown</h4>
				<button class="close p-2" data-dismiss="modal" type="button">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body pt-2">
				<form>
					<div class="row">
						<div class="form-group lpnu-form mb-1 col-sm-4 pr-sm-1">
							<label class="form-control-label font-weight-500">Icon Menu</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span>
								</div>
								<input type="text" name="icon" class="form-control" placeholder="contoh: fas fa-home, fas fa-address-card, dll.. ">
							</div>
							<div class="text-muted text-xs font-italic mt-1" style="line-height: 15px">Ikon diambil dari layanan FontAwesome 5, Kunjungi Galeri Ikonnya <a href="https://fontawesome.com/v5.15/icons?d=gallery" target="fontawesome_icon">disini</a></div>
						</div>
						<div class="form-group lpnu-form mb-1 col-sm pl-sm-1">
							<label class="form-control-label font-weight-500">Judul Menu</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-signature"></i></span>
								</div>
								<input type="text" name="judul" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group lpnu-form col-sm mb-1 pr-sm-1">
							<label class="form-control-label font-weight-500">Jenis Link</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-link"></i></span>
								</div>
								<select name="jenis_link" class="form-control">
									<option value="url">Link URL</option>
									<option value="halaman">Halaman</option>
								</select>
							</div>
						</div>
						<div class="form-group lpnu-form col-sm option-halaman mb-1 pl-sm-1" style="display: none;">
							<label class="form-control-label font-weight-500">Pilih Halaman</label><br/>
							<input type="hidden" name="halaman_id">
							<button type="button" class="btn btn-default btn-pilih-halaman" data-for="[name='halaman_id']">
								<i class="fas fa-file-alt mr-1"></i>
								Pilih Halaman
							</button>
							<h4 class="mt-1 halaman-judul" style="display: none">Digunakan: Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
						</div>
						<div class="form-group lpnu-form col-sm option-url mb-1 pl-sm-1">
							<label class="form-control-label font-weight-500">Alamat Url</label>
							<div class="input-group input-group-merge">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-link"></i></span>
								</div>
								<input type="text" name="url" class="form-control" placeholder="Contoh: http://www.google.com .. ">
							</div>
						</div>
					</div>
					<div class="row mt-2">
						<div class="form-group lpnu-form col">
							<button type="submit" class="btn btn-default btn-block">
								<i class="fas fa-paper-plane mr-1"></i>
								Tambahkan
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-pilih-halaman">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="mb-0 modal-title">Pilih postingan Halaman</h4>
				<button type="button" class="close p-3" data-dismiss='modal'>
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body pt-0">
				<div class="row">
					<div class="col-xl-6 col-lg-4 col-sm-6 col-12">
						<div class="form-group lpnu-form mb-0">
							<label class="form-control-label font-weight-500 mb-0">Cari dengan judul</label>
							<div class="input-group input-group-merge input-group-sm">
								<input type="text" id="filter-pencarian" class="form-control form-control-sm">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-sm-6 col-6">
						<div class="form-group lpnu-form mb-1">
							<label class="form-control-label font-weight-500 mb-1 d-block">Jumlah data/halaman</label>
							<div class="input-group input-group-merge input-group-sm">
								<input type="number" id="filter-limit" class="form-control form-control" value="50">
								<div class="input-group-append">
									<div class="input-group-text" style="font-size: 9pt !important">/ Halaman</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-sm-6 col-12">
						<div class="form-group lpnu-form mb-1">
							<label class="form-control-label font-weight-500 mb-1 d-block">Halaman</label>
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
						<div class="form-group lpnu-form mb-1">
							<label class="form-control-label font-weight-500 mb-0">Penulis</label>
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
				<div class="row">
					<input type="hidden" name="modal_referer">
					<input type="hidden" name="input_fill">
					<div class="col load-artikel"></div>
				</div>
			</div>
		</div>	
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".btn-tambah-nav").click(function(e) {
			e.preventDefault()
			$("#modal-tambah-nav").modal('show')
		});

		$("#modal-tambah-nav").on('shown.bs.modal', function(e) {
			e.preventDefault()
			modal = $(this);
			function checkJenis() {
				value = modal.find("[name='jenis_link']").val()
				if (value == 'halaman') {
					modal.find(".option-halaman").show();
					modal.find(".option-url").show();
					modal.find(".option-table-dropdown").hide();
					modal.find("[name='url']").attr('readonly', 'readonly');
				}
				else if (value == 'dropdown') {
					modal.find('.option-halaman').hide();
					modal.find(".option-url").hide();
					modal.find(".option-table-dropdown").show();
				}
				else {
					modal.find(".option-halaman").hide();
					modal.find(".option-url").show();
					modal.find(".option-table-dropdown").hide();
					modal.find("[name='url']").removeAttr('readonly');
				}
			}
			checkJenis()
			modal.find("[name='jenis_link']").unbind().change(function(e) {
				checkJenis()
			})
			modal.find(".btn-tambah-nav-dropdown").unbind().click(function(e) {
				$("#modal-tambah-nav-dropdown").modal('show');
			});
			modal.find(".btn-pilih-halaman").unbind().click(function(e) {
				$("#modal-pilih-halaman [name='modal_referer']").val("#modal-tambah-nav");
				$("#modal-pilih-halaman [name='input_fill']").val("#modal-tambah-nav [name='halaman_id']");
				$("#modal-pilih-halaman").modal('show');
			})
			modal.find('form').unbind().submit(function(e) {
				e.preventDefault()
				jenis_link = $(this).find("[name='jenis_link']").val()
				if (jenis_link == 'halaman' || jenis_link == 'url') {
					nav.push({
						icon: $(this).find("[name='icon']").val(),
						judul: $(this).find("[name='judul']").val(),
						url: $(this).find("[name='url']").val()
					})
				}
				else {
					nav.push({
						icon: $(this).find("[name='icon']").val(),
						judul: $(this).find("[name='judul']").val(),
						dropdown: navDropdown
					})
				}
				
				$(this)[0].reset()
				navDropdown = []
				refreshNavDropdown()
				refreshNav()
				modal.modal('hide')
			});
		})
		$("#modal-tambah-nav").on('hidden.bs.modal', function() {
	        $('body').removeClass('modal-open');
		});

		// * -----------------------------------------------------------
		// * Modal Tambah Menu Navigasi Dropdown
		// * -----------------------------------------------------------
		$("#modal-tambah-nav-dropdown").on('shown.bs.modal', function(e) {
			e.preventDefault()
			$("#modal-tambah-nav").css('z-index', '1040')
			modal = $(this);
			function checkJenis() {
				value = modal.find("[name='jenis_link']").val()
				if (value == 'halaman') {
					modal.find(".option-halaman").show();
					modal.find(".option-url").show();
					modal.find(".option-table-dropdown").hide();
					modal.find("[name='url']").attr('readonly', 'readonly');
				}
				else if (value == 'dropdown') {
					modal.find('.option-halaman').hide();
					modal.find(".option-url").hide();
					modal.find(".option-table-dropdown").show();
				}
				else {
					modal.find(".option-halaman").hide();
					modal.find(".option-url").show();
					modal.find(".option-table-dropdown").hide();
					modal.find("[name='url']").removeAttr('readonly');
				}
			}
			checkJenis()

			modal.find("[name='jenis_link']").unbind().change(function(e) {
				checkJenis()
			})
			modal.find(".btn-pilih-halaman").unbind().click(function(e) {
				$("#modal-pilih-halaman [name='modal_referer']").val("#modal-tambah-nav-dropdown");
				$("#modal-pilih-halaman [name='input_fill']").val("#modal-tambah-nav-dropdown [name='halaman_id']");
				$("#modal-pilih-halaman").modal('show');
			});
			modal.find('form').unbind().submit(function(e) {
				e.preventDefault()
				navDropdown.push({
					icon: $(this).find("[name='icon']").val(),
					judul: $(this).find("[name='judul']").val(),
					url: $(this).find("[name='url']").val()
				})
				refreshNavDropdown()
				$(this)[0].reset()
				modal.modal('hide')
			});
		})
		$("#modal-tambah-nav-dropdown").on('hidden.bs.modal', function(e) {
			$("#modal-tambah-nav").css('z-index', '1050')
			$("#modal-tambah-nav").trigger('shown.bs.modal')
	        $('body').addClass('modal-open');
		})

		// * -----------------------------------------------------------
		// * Modal Pilih Halmaan
		// * -----------------------------------------------------------
		$("#modal-pilih-halaman").on('shown.bs.modal', function(e) {
			modal = $(this)
			modalReferer = modal.find("[name='modal_referer']").val();
			inputFill = modal.find("[name='input_fill']").val();
			$(modalReferer).css('z-index', '1040')


			let params = {
				page: 1,
				limit: 50,
				notInId: $(inputFill).val()
			}
			function refreshList() {
				$(".progress-wrapper").css('visibility', 'visible');
				$.ajax({
					url: '<?=site_url('admin/konfigurasi/ajax_list_halaman/pilih-halaman')?>',
					type: 'GET',
					dataType: 'html',
					data: params,
				})
				.done(function(data) {
					$(".load-artikel").html(data)
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

				$(".btn-pilih-artikel").unbind().click(function(e) {
					id = $(this).data('id')
					judul = $(this).data('judul')
					url = $(this).data('url')

					$(inputFill).val(id)
					$(modalReferer).find('.halaman-judul').show()
					$(modalReferer).find("[name='url']").val(url)
					$(modalReferer).find('.halaman-judul').html("Digunakan: " +judul)
					modal.modal('hide')
				});
			}
			refreshList()
			$("#filter-pencarian").val('');
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
			$("#filter-penulis").val('');
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
			$("#filter-page").val('');
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
			$("#filter-limit").val('');
			$("#filter-limit").change(function(e) {
				value = $(this).val()
				if (value != '') {
					params.limit = value
				}
				else {
					delete params.limit
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
		})
		$("#modal-pilih-halaman").on('hidden.bs.modal', function(e) {
			modal = $(this)
			modalReferer = modal.find("[name='modal_referer']").val();

			$(modalReferer).css('z-index', '1050')
			$(modalReferer).trigger('shown.bs.modal')
	        $('body').addClass('modal-open');
		})

		// * -----------------------------------------------------------
		// * Refresh data navigasi dropdown
		// * -----------------------------------------------------------
		var navDropdown = []
		function refreshNavDropdown() {
			html = ""
			navDropdown.forEach(function(nav, index) {
				html += `
					<tr>
						<td><i class='${nav.icon}'></i></td>
						<td>${nav.judul}</td>
						<td><a target='_blank' href='${nav.url}'>${nav.url}</a></td>
						<td>
							<a href='#' class='btn-hapus-nav-dropdown btn btn-link' data-index='${index}'>
								<i class='fas fa-times'></i>
							</a>
						</td>
					</tr>
				`
			})
			$(".load-nav-dropdown").html(html)
			$(".btn-hapus-nav-dropdown").unbind().click(function(e) {
				index = $(this).data('index')
				navDropdown.splice(index, 1)
				refreshNavDropdown()
				e.preventDefault()
			})
		}



		// * -----------------------------------------------------------
		// * Refresh data navigasi
		// * -----------------------------------------------------------
		var nav = []
		nav = JSON.parse(`<?=$konfigurasi['APP_NAVBAR']['value_text']?>`)
		refreshNav()
		function refreshNav() {
			$("[name='APP_NAVBAR']").val(JSON.stringify(nav))
			$("[name='APP_NAVBAR']").trigger('change')
			html = ""
			nav.forEach(function(navItem, index) {
				html += `
					<tr>
						<td style="width: 60px; vertical-align: middle" class="p-0 text-center">`
				if (index != 0)
					html += `<a href="#" data-index="${index}" class="px-2 mr-0 btn-move-up btn btn-link btn-sm">
								<i class="fas fa-arrow-up"></i>
							</a>`
				if (index != (nav.length - 1))
					html += `<a href="#" data-index="${index}" class="px-2 mr-0 btn-move-down btn btn-link btn-sm">
								<i class="fas fa-arrow-down"></i>
							</a>`
				html += `	<br/>
							<a href='#' class='px-2 btn-hapus-nav btn btn-danger rounded-circle btn-sm' data-index='${index}'>
								<i class='fas fa-times'></i>
							</a>
						</td>
						<td><i class='${navItem.icon}' style="font-size: 20pt"></i></td>
						<td>${navItem.judul}</td>`
				if ("dropdown" in navItem) {
					html += `<td>`
					html += `<ul>`
					navItem.dropdown.forEach(function(navDropdown, index) {
						html += `<li><a href="${navDropdown.url}"><i class="${navDropdown.icon} mr-1"></i>${navDropdown.judul}</a></li>`
					})
					html += `</ul>`
					html += `</td>`
				} 
				else {
					html += `<td><a target='_blank' href='${navItem.url}'>${navItem.url}</a></td>`
				}
				html +=	`
					</tr>
				`
			})
			$(".load-nav").html(html)
			$(".btn-hapus-nav").unbind().click(function(e) {
				index = $(this).data('index')
				nav.splice(index, 1)
				refreshNav()
				e.preventDefault()
			})
			$(".btn-move-up").unbind().click(function(e) {
				index = $(this).data('index')
				navActual = nav[index]
				nav[index] = nav[index-1]
				nav[index-1] = navActual
				refreshNav()
				e.preventDefault()
			})
			$(".btn-move-down").unbind().click(function(e) {
				index = $(this).data('index')
				navActual = nav[index]
				nav[index] = nav[index+1]
				nav[index+1] = navActual
				refreshNav()
				e.preventDefault()
			})
		}

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
			}, 10000)
		}

		function setConfiguration(nama, valueType, value) {
			$.ajax({
				url: '<?=site_url('admin/konfigurasi/ajax_set_configuration')?>',
				type: 'POST',
				dataType: 'json',
				data: {nama: nama, value_type: valueType, value: value},
			})
			.done(function(data) {
				if (data.status == 'success') {
					showAlert(data.text, data.icon, data.color)
				}
			});
			
		}
		function setConfigurationImage(formData, callback) {
			$.ajax({
				url: '<?=site_url('admin/konfigurasi/ajax_set_configuration_image')?>',
				type: 'POST',
				dataType: 'json',
				data: formData,
				contentType: false,
				processData: false,
				cache: false
			})
			.done(function(data) {
				if (data.status == 'success') {
					showAlert(data.text, data.icon, data.color)
				}
				if (typeof callback !== 'undefined') 
					callback()
			});
			
		}
		$("[name='APP_JUDUL']").change(function(e) {
			value = $(this).val()
			setConfiguration('APP_JUDUL', 'varchar', value)
		})
		$("[name='APP_DESCRIPTION']").change(function(e) {
			value = $(this).val()
			setConfiguration('APP_DESCRIPTION', 'text', value)
		})
		$("[name='APP_LOGO']").change(function(e) {
			formData = new FormData();
			formData.append('image', $("[name='APP_LOGO']").prop('files')[0])
			formData.append('nama', 'APP_LOGO')
			setConfigurationImage(formData, () => {
				window.location.reload()
			})
		})
		$("[name='APP_LOGO_FOOTER']").change(function(e) {
			formData = new FormData();
			formData.append('image', $(this).prop('files')[0])
			formData.append('nama', 'APP_LOGO_FOOTER')
			setConfigurationImage(formData, () => {
				window.location.reload()
			})
		})
		$("[name='APP_FOOTER_JUDUL']").change(function(e) {
			value = $(this).val()
			setConfiguration('APP_FOOTER_JUDUL', 'varchar', value)
		})
		$("[name='APP_FOOTER_SUBJUDUL']").change(function(e) {
			value = $(this).val()
			setConfiguration('APP_FOOTER_SUBJUDUL', 'varchar', value)
		})
		$("[name='APP_FOOTER_COPYRIGHT']").change(function(e) {
			value = $(this).val()
			setConfiguration('APP_FOOTER_COPYRIGHT', 'text', value)
		})
		$("[name='APP_NAVBAR']").change(function(e) {
			value = $(this).val()
			setConfiguration('APP_NAVBAR', 'text', value)
		})
		$("[name='CONTENT_LIMIT_POST_TERKINI']").change(function(e) {
			value = $(this).val()
			setConfiguration('CONTENT_LIMIT_POST_TERKINI', 'varchar', value)
		})
		$("[name='CONTENT_LIMIT_POST_TERPOPULER']").change(function(e) {
			value = $(this).val()
			setConfiguration('CONTENT_LIMIT_POST_TERPOPULER', 'varchar', value)
		})
		$("[name='CONTENT_LIMIT_POST_KATEGORI']").change(function(e) {
			value = $(this).val()
			setConfiguration('CONTENT_LIMIT_POST_KATEGORI', 'varchar', value)
		})
		$("[name='CONTENT_LIMIT_POST_PENULIS']").change(function(e) {
			value = $(this).val()
			setConfiguration('CONTENT_LIMIT_POST_PENULIS', 'varchar', value)
		})
		$("[name='APP_FOOTER_ALAMAT']").change(function(e) {
			value = $(this).val()
			setConfiguration('APP_FOOTER_ALAMAT', 'text', value)
		})
		$("[name='APP_LOGO_TEXT']").change(function(e) {
			value = $(this).val()
			setConfiguration('APP_LOGO_TEXT', 'varchar', value)
		})
	})
</script>
<?php $this->endSection(); ?>