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


<div class="header bg-default py-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col d-flex justify-content-start align-items-center">
				<i class="fas fa-home" style="font-size: 32pt; color: white"></i>
				<div class="title ml-4" >
					<h2 class="text-white text-uppercase mb-0">Halaman List Artikel</h2>
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
						<div class="col-lg-8 load-content" style="min-height: 300px">
							<div class="row">
								<div class="col">
									<h3>Konten Utama</h3>
									<hr class="mt-3 mb-2">
								</div>
							</div>
							<div class="row border border-warning border-bottom-0 rounded-top">
								<div class="col py-1 d-flex justify-content-left align-items-center bg-warning">
									<h5 class="mb-0 text-white mr-2">Baris 1</h5>
								</div>
							</div>
							<div class="row" style="margin-top: -4px;">
								<div id="element-65" class="col-lg-12 col-md-12 col-sm-12 col-12 border-warning rounded align-items-center d-flex justify-content-center py-2" style="min-height: 320px; border: 1px solid #e9ecef">
									<div class="d-flex flex-column justify-content-center">
										<h4 class="mb-1">Daftar Postingan Utama</h4>
										<div>
											<hr class="mt-1 mb-0">
											<span class="badge badge-primary"> 
												<i class="fas fa-desktop mr-1"></i>
												12				</span>
											<span class="badge badge-primary"> 
												<i class="fas fa-desktop mr-1"></i>
												12				</span>
											<span class="badge badge-primary"> 
												<i class="fas fa-tablet-alt mr-1"></i>
												12				</span>
											<span class="badge badge-primary"> 
												<i class="fas fa-mobile-alt mr-1"></i>
												12				</span>	
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 load-widget" style="min-height: 300px">
							<h4 class="text-center align-self-center mt-5">Memuat Halaman ...</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->endSection(); ?>

<?php $this->section('jsContent') ?>

<div class="modal fade" id="modal-tambah-elemen">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title mb-0">Tambah Elemen</h4>
				<button class="close p-3" type="button" data-dismiss='modal'>
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body pt-1">
				<div class="row">
					<div class="col-lg-8">
						<form>
							<div class="row">
								<div class="form-group lpnu-form col">
									<label class="form-control-label">Judul</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-signature"></i></span>
										</div>
										<input type="text" name="judul" class="form-control" placeholder="Tuliskan judul..." autocomplete="off">
									</div>
								</div> 
							</div>
							<div class="row">
								<div class="form-group lpnu-form col-sm-6 pr-sm-2">
									<label class="form-control-label">Jenis Postingan</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-database"></i></span>
										</div>
										<select class="form-control" name="jenis_konten">
											<optgroup label="Artikel">
												<option value="terkini">Terkini</option>
												<option value="terpopuler">Terpopuler</option>
												<option value="kategori">Berdasarkan kategori</option>
												<option value="penulis">Berdasarkan penulis</option>
												<option value="featured">Featured / pilihan</option>
											</optgroup>
											<optgroup label="Data mitra">
												<option value="mitra-terkini">Mitra baru ditambahkan</option>
												<option value="mitra-kategori">Berdasarkan Kategori</option>
												<option value="mitra-featured">Featured / Pilihan</option>
											</optgroup>
										</select>
									</div>
								</div>
								<div class="form-group lpnu-form col-sm-6 pl-sm-2">
									<label class="form-control-label">Jenis Tampilan</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-object-group"></i></span>
										</div>
										<select class="form-control" name="view">
											<option value="carousel">Carousel</option>
											<option value="card-thumbnail">Card Thumbnail</option>
											<option value="mitra-slider">Mitra Slider</option>
											<option value="mini-thumbnail-title">Card Thumbnail Mini</option>
											<option value="card-thumbnail-slider">Card Thumbnail Slider</option>
											<option value="text-only">Text Only</option>
											<option value="kalender">Kalender</option>
											<option value="arsip">Arsip</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row ml-4 mb-4 p-2 rounded element-options">
								<div class="form-group col-md-6 element-option-limit">
									<label class="form-control-label">Limit</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
										</div>
										<input type="number" name="option_limit" value="10" class="form-control" min="1">
										<div class="input-group-append">
											<span class="input-group-text">Item</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-baca_selengkapnya" style="display: none">
									<label class="form-control-label">Tampilkan Baca Selengkapnya?</label>
									<br>
									<div class="custom-control custom-control-inline custom-radio">
										<input type="radio" name="option_baca_selengkapnya" value="true" class="custom-control-input" id="baca_selengkapnya-tampilkan" checked="checked">
										<label class="custom-control-label" for="baca_selengkapnya-tampilkan">Tampilkan</label>
									</div>
									<div class="custom-control custom-control-inline custom-radio">
										<input type="radio" name="option_baca_selengkapnya" value="" class="custom-control-input" id="baca_selengkapnya-sembunyikan">
										<label class="custom-control-label" for="baca_selengkapnya-sembunyikan">Sembunyikan 	</label>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-durasi" style="display: none">
									<label class="form-control-label">Durasi Slideshow</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-clock"></i></span>
										</div>
										<input type="number" name="option_durasi" value="3" class="form-control" min="1">
										<div class="input-group-append">
											<span class="input-group-text">Detik</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-kategori_artikel" style="display: none">
									<label class="form-control-label">Kategori Artikel</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-tags"></i></span>
										</div>
										<select class="form-control" name="option_kategori_artikel">
											<?php 
												foreach ($data_kategori as $kategori) {
											?>
											<option value="<?=$kategori['id']?>"><?=$kategori['kategori']?></option>
											<?php 
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-penulis" style="display: none">
									<label class="form-control-label">Penulis</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user-edit"></i></span>
										</div>
										<select class="form-control" name="option_penulis">
											<?php 
												foreach ($data_penulis as $penulis) {
											?>
											<option value="<?=$penulis['username']?>"><?=$penulis['nama_lengkap']?></option>
											<?php 
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-artikel_featured" style="display: none">
									<label class="form-control-label">Pilih Postingan</label>
									<br>
									<input type="hidden" name="option_featured">
									<a href="#" class="btn btn-default btn-tambah-artikel-featured">
										<i class="fas fa-plus mr-2"></i>
										Tambah Postingan
									</a>
									<br>
									<div class="table-responsive">
										<table class="table table-striped table-xs">
											<thead>
												<tr>
													<th>Judul</th>
													<th></th>
												</tr>
											</thead>
											<tbody class="load-featured-artikel">
											</tbody>
										</table>
									</div>
								</div>	
								<div class="form-group col-md-6 element-option-kategori_usaha" style="display: none">
									<label class="form-control-label">Kategori Usaha</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-store"></i></span>
										</div>
										<select class="form-control" name="option_kategori_usaha">
											<?php 
												foreach ($data_kategori_usaha as $kategori_usaha) {
											?>
											<option value="<?=$kategori_usaha['kategori']?>"><?=$kategori_usaha['kategori']?></option>
											<?php 
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-mitra_featured" style="display: none">
									<label class="form-control-label">Pilih Mitra</label>
									<br>
									<input type="hidden" name="option_mitra_featured">
									<a href="#" class="btn btn-default btn-tambah-mitra-featured">
										<i class="fas fa-plus mr-2"></i>
										Tambah Mitra
									</a>
									<br>
									<div class="table-responsive">
										<table class="table table-striped table-xs">
											<thead>
												<tr>
													<th>Judul</th>
													<th></th>
												</tr>
											</thead>
											<tbody class="load-featured-mitra">
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-widget-background" style="display: none">
									<label class="form-control-label">Background Judul Widget</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-store"></i></span>
										</div>
										<select class="form-control" name="option_widget_background">
											<option value="guest-orange" class="bg-warning text-white">Kuning</option>
											<option value="white" class="bg-white">Putih</option>
											<option value="primary" class="bg-primary text-white">Biru Langit</option>
											<option value="secondary" class="text-white" style="background: #6c757d">Abu Cerah</option>
											<option value="dark" class="bg-dark text-white">Abu Gelap</option>
											<option value="success" class="bg-success text-dark">Hijau</option>
											<option value="danger" class="bg-danger text-white">Merah</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-widget-color" style="display: none">
									<label class="form-control-label">Warna Judul Widget</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-store"></i></span>
										</div>
										<select class="form-control" name="option_widget_color">
											<option value="white" class="bg-white">Putih</option>
											<option value="primary" class="bg-primary text-white">Biru Langit</option>
											<option value="secondary" class="text-white" style="background: #6c757d">Abu Cerah</option>
											<option value="dark" class="bg-dark text-white">Abu Gelap</option>
											<option value="success" class="bg-success text-dark">Hijau</option>
											<option value="guest-orange" class="bg-warning text-white">Kuning</option>
											<option value="danger" class="bg-danger text-white">Merah</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-widget-border" style="display: none">
									<label class="form-control-label">Border Widget</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-store"></i></span>
										</div>
										<select class="form-control" name="option_widget_border">
											<option value="guest-orange" class="bg-warning text-white">Kuning</option>
											<option value="white" class="bg-white">Putih</option>
											<option value="primary" class="bg-primary text-white">Biru Langit</option>
											<option value="secondary" class="text-white" style="background: #6c757d">Abu Cerah</option>
											<option value="dark" class="bg-dark text-white">Abu Gelap</option>
											<option value="success" class="bg-success text-dark">Hijau</option>
											<option value="danger" class="bg-danger text-white">Merah</option>
										</select>
									</div>
								</div>
							</div>
							<hr class="mb-2">
							<div class="mb-3 text-uppercase font-weight-bold text-muted" style="font-size: 8pt">Pengaturan Lanjutan</div>
							<div class="row">
								<div class="form-group lpnu-form col-sm-3">
									<label class="form-control-label">Lebar LG</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-desktop"></i></span>
										</div>
										<input type="number" name="lebar_lg" max="12" min="2" class="form-control" value="12">
									</div>
								</div>
								<div class="form-group lpnu-form col-sm-3 pl-sm-0">
									<label class="form-control-label">Lebar MD</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-desktop"></i></span>
										</div>
										<input type="number" name="lebar_md" max="12" min="2" class="form-control" value="12">
									</div>
								</div>
								<div class="form-group lpnu-form col-sm-3 pl-sm-0">
									<label class="form-control-label">Lebar SM</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-tablet-alt"></i></span>
										</div>
										<input type="number" name="lebar_sm" max="12" min="2" class="form-control" value="12">
									</div>
								</div>
								<div class="form-group lpnu-form col-sm-3 pl-sm-0">
									<label class="form-control-label">Lebar XS</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
										</div>
										<input type="number" name="lebar_xs" max="12" min="2" class="form-control" value="12">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group lpnu-form col-md-3">
									<label class="form-control-label">Halaman</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-file-alt"></i></span>
										</div>
										<input type="text" name="halaman" value="detail-artikel" class="form-control text-center" readonly="readonly">
									</div>
								</div>
								<div class="form-group lpnu-form col-md-3 pl-md-0">
									<label class="form-control-label">Penempatan</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-object-group"></i></span>
										</div>
										<input type="text" name="penempatan" value="content" class="form-control text-center" readonly="readonly">
									</div>
								</div>
								<div class="form-group lpnu-form col-md-3 pl-md-0">
									<label class="form-control-label">Baris</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-th-list"></i></span>
										</div>
										<input type="number" name="row" class="form-control text-center" readonly="readonly">
										<input type="hidden" name="urutan_col">
									</div>
								</div>
								<div class="form-group lpnu-form col-md-3 pl-md-0">
									<label class="form-control-label"><i>Class</i> Tambahan</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-th-list"></i></span>
										</div>
										<input type="text" name="kelas" class="form-control" placeholder="mt-2, pl-2, ...">
									</div>
								</div>
								<div class="form-group col">
									<button class="btn btn-warning btn-block" type="submit">
										<i class="fas fa-plus-square mr-1"></i>
										Tambahkan
									</button>
								</div>
							</div> 
						</form>
					</div>
					<div class="col-lg-4">
						<div class="row">
							<div class="col p-3">
								<h4 class="text-dark">Pratinjau</h4>
								<hr class="m-0">
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 py-3 d-flex align-items-center justify-content-center preview-element" style="background: #F1F1F1">
								
							</div>
						</div>
					</div>
				</div> <!-- end row -->
			</div>	
		</div>
	</div>
</div>
<div class="modal fade" id="modal-edit-elemen">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title mb-0">Edit Elemen</h4>
				<button class="close p-3" type="button" data-dismiss='modal'>
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body pt-1">
				<div class="row">
					<div class="col-lg-8">
						<form>
							<div class="row">
								<div class="form-group lpnu-form col">
									<label class="form-control-label">Judul</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-signature"></i></span>
										</div>
										<input type="hidden" name="id">
										<input type="text" name="judul" class="form-control" placeholder="Tuliskan judul..." autocomplete="off">
									</div>
								</div> 
							</div>
							<div class="row">
								<div class="form-group lpnu-form col-sm-6 pr-sm-2">
									<label class="form-control-label">Jenis Postingan</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-database"></i></span>
										</div>
										<select class="form-control" name="jenis_konten">
											<optgroup label="Artikel">
												<option value="terkini">Terkini</option>
												<option value="terpopuler">Terpopuler</option>
												<option value="kategori">Berdasarkan kategori</option>
												<option value="penulis">Berdasarkan penulis</option>
												<option value="featured">Featured / pilihan</option>
											</optgroup>
											<optgroup label="Data mitra">
												<option value="mitra-terkini">Mitra baru ditambahkan</option>
												<option value="mitra-kategori">Berdasarkan Kategori</option>
												<option value="mitra-featured">Featured / Pilihan</option>
											</optgroup>
										</select>
									</div>
								</div>
								<div class="form-group lpnu-form col-sm-6 pl-sm-2">
									<label class="form-control-label">Jenis Tampilan</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-object-group"></i></span>
										</div>
										<select class="form-control" name="view">
											<option value="carousel">Carousel</option>
											<option value="card-thumbnail">Card Thumbnail</option>
											<option value="mitra-slider">Mitra Slider</option>
											<option value="mini-thumbnail-title">Card Thumbnail Mini</option>
											<option value="card-thumbnail-slider">Card Thumbnail Slider</option>
											<option value="text-only">Text Only</option>
											<option value="kalender">Kalender</option>
											<option value="arsip">Arsip</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row ml-4 mb-4 p-2 rounded element-options">
								<div class="form-group col-md-6 element-option-limit">
									<label class="form-control-label">Limit</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
										</div>
										<input type="number" name="option_limit" value="10" class="form-control" min="1">
										<div class="input-group-append">
											<span class="input-group-text">Item</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-baca_selengkapnya" style="display: none">
									<label class="form-control-label">Tampilkan Baca Selengkapnya?</label>
									<br>
									<div class="custom-control custom-control-inline custom-radio">
										<input type="radio" name="option_baca_selengkapnya" value="true" class="custom-control-input" id="edit-baca_selengkapnya-tampilkan" checked="checked">
										<label class="custom-control-label" for="edit-baca_selengkapnya-tampilkan">Tampilkan</label>
									</div>
									<div class="custom-control custom-control-inline custom-radio">
										<input type="radio" name="option_baca_selengkapnya" value="" class="custom-control-input" id="edit-baca_selengkapnya-sembunyikan">
										<label class="custom-control-label" for="edit-baca_selengkapnya-sembunyikan">Sembunyikan 	</label>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-durasi" style="display: none">
									<label class="form-control-label">Durasi Slideshow</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-clock"></i></span>
										</div>
										<input type="number" name="option_durasi" value="3" class="form-control" min="1">
										<div class="input-group-append">
											<span class="input-group-text">Detik</span>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-kategori_artikel" style="display: none">
									<label class="form-control-label">Kategori Artikel</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-tags"></i></span>
										</div>
										<select class="form-control" name="option_kategori_artikel">
											<?php 
												foreach ($data_kategori as $kategori) {
											?>
											<option value="<?=$kategori['id']?>"><?=$kategori['kategori']?></option>
											<?php 
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-penulis" style="display: none">
									<label class="form-control-label">Penulis</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user-edit"></i></span>
										</div>
										<select class="form-control" name="option_penulis">
											<?php 
												foreach ($data_penulis as $penulis) {
											?>
											<option value="<?=$penulis['username']?>"><?=$penulis['nama_lengkap']?></option>
											<?php 
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-artikel_featured" style="display: none">
									<label class="form-control-label">Pilih Postingan</label>
									<br>
									<input type="hidden" name="option_featured">
									<a href="#" class="btn btn-default btn-tambah-artikel-featured">
										<i class="fas fa-plus mr-2"></i>
										Tambah Postingan
									</a>
									<br>
									<div class="table-responsive">
										<table class="table table-striped table-xs">
											<thead>
												<tr>
													<th>Judul</th>
													<th></th>
												</tr>
											</thead>
											<tbody class="load-featured-artikel">
											</tbody>
										</table>
									</div>
								</div>	
								<div class="form-group col-md-6 element-option-kategori_usaha" style="display: none">
									<label class="form-control-label">Kategori Usaha</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-store"></i></span>
										</div>
										<select class="form-control" name="option_kategori_usaha">
											<?php 
												foreach ($data_kategori_usaha as $kategori_usaha) {
											?>
											<option value="<?=$kategori_usaha['kategori']?>"><?=$kategori_usaha['kategori']?></option>
											<?php 
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-mitra_featured" style="display: none">
									<label class="form-control-label">Pilih Mitra</label>
									<br>
									<input type="hidden" name="option_mitra_featured">
									<a href="#" class="btn btn-default btn-tambah-mitra-featured">
										<i class="fas fa-plus mr-2"></i>
										Tambah Mitra
									</a>
									<br>
									<table class="table table-striped table-xs">
										<thead>
											<tr>
												<th>Judul</th>
												<th></th>
											</tr>
										</thead>
										<tbody class="load-featured-mitra">
										</tbody>
									</table>
								</div>
								<div class="form-group col-md-6 element-option-widget-background" style="display: none">
									<label class="form-control-label">Background Judul Widget</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-store"></i></span>
										</div>
										<select class="form-control" name="option_widget_background">
											<option value="white" class="bg-white">Putih</option>
											<option value="primary" class="bg-primary text-white">Biru Langit</option>
											<option value="secondary" class="text-white" style="background: #6c757d">Abu Cerah</option>
											<option value="dark" class="bg-dark text-white">Abu Gelap</option>
											<option value="success" class="bg-success text-dark">Hijau</option>
											<option value="guest-orange" class="bg-warning text-white">Kuning</option>
											<option value="danger" class="bg-danger text-white">Merah</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-widget-color" style="display: none">
									<label class="form-control-label">Warna Judul Widget</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-store"></i></span>
										</div>
										<select class="form-control" name="option_widget_color">
											<option value="white" class="bg-white">Putih</option>
											<option value="primary" class="bg-primary text-white">Biru Langit</option>
											<option value="secondary" class="text-white" style="background: #6c757d">Abu Cerah</option>
											<option value="dark" class="bg-dark text-white">Abu Gelap</option>
											<option value="success" class="bg-success text-dark">Hijau</option>
											<option value="guest-orange" class="bg-warning text-white">Kuning</option>
											<option value="danger" class="bg-danger text-white">Merah</option>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6 element-option-widget-border" style="display: none">
									<label class="form-control-label">Border Widget</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-store"></i></span>
										</div>
										<select class="form-control" name="option_widget_border">
											<option value="white" class="bg-white">Putih</option>
											<option value="primary" class="bg-primary text-white">Biru Langit</option>
											<option value="secondary" class="text-white" style="background: #6c757d">Abu Cerah</option>
											<option value="dark" class="bg-dark text-white">Abu Gelap</option>
											<option value="success" class="bg-success text-dark">Hijau</option>
											<option value="guest-orange" class="bg-warning text-white">Kuning</option>
											<option value="danger" class="bg-danger text-white">Merah</option>
										</select>
									</div>
								</div>
							</div>
							<hr class="mb-2">
							<div class="mb-3 text-uppercase font-weight-bold text-muted" style="font-size: 8pt">Pengaturan Lanjutan</div>
							<div class="row">
								<div class="form-group lpnu-form col-sm-3">
									<label class="form-control-label">Lebar LG</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-desktop"></i></span>
										</div>
										<input type="number" name="lebar_lg" max="12" min="2" class="form-control" value="12">
									</div>
								</div>
								<div class="form-group lpnu-form col-sm-3 pl-sm-0">
									<label class="form-control-label">Lebar MD</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-desktop"></i></span>
										</div>
										<input type="number" name="lebar_md" max="12" min="2" class="form-control" value="12">
									</div>
								</div>
								<div class="form-group lpnu-form col-sm-3 pl-sm-0">
									<label class="form-control-label">Lebar SM</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-tablet-alt"></i></span>
										</div>
										<input type="number" name="lebar_sm" max="12" min="2" class="form-control" value="12">
									</div>
								</div>
								<div class="form-group lpnu-form col-sm-3 pl-sm-0">
									<label class="form-control-label">Lebar XS</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
										</div>
										<input type="number" name="lebar_xs" max="12" min="2" class="form-control" value="12">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group lpnu-form col-md-3">
									<label class="form-control-label">Halaman</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-file-alt"></i></span>
										</div>
										<input type="text" name="halaman" value="detail-artikel" class="form-control text-center" readonly="readonly">
									</div>
								</div>
								<div class="form-group lpnu-form col-md-3 pl-md-0">
									<label class="form-control-label">Penempatan</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-object-group"></i></span>
										</div>
										<input type="text" name="penempatan" value="content" class="form-control text-center" readonly="readonly">
									</div>
								</div>
								<div class="form-group lpnu-form col-md-3 pl-md-0">
									<label class="form-control-label">Baris</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-th-list"></i></span>
										</div>
										<input type="number" name="row" class="form-control text-center" readonly="readonly">
										<input type="hidden" name="urutan_col">
									</div>
								</div>
								<div class="form-group lpnu-form col-md-3 pl-md-0">
									<label class="form-control-label"><i>Class</i> Tambahan</label>
									<div class="input-group input-group-merge">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-th-list"></i></span>
										</div>
										<input type="text" name="kelas" class="form-control" placeholder="mt-2, pl-2, ...">
									</div>
								</div>
								<div class="form-group col">
									<button class="btn btn-warning btn-block" type="submit">
										<i class="fas fa-pencil-alt mr-1"></i>
										Edit
									</button>
								</div>
							</div> 
						</form>
					</div>
					<div class="col-lg-4">
						<div class="row">
							<div class="col p-3">
								<h4 class="text-dark">Pratinjau</h4>
								<hr class="m-0">
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 py-3 d-flex align-items-center justify-content-center preview-element" style="background: #F1F1F1">
							</div>
						</div>
					</div>
				</div> <!-- end row -->
			</div>	
		</div>
	</div>
</div>
<div class="modal fade" id="modal-pilih-artikel-featured">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="mb-0 modal-title">Pilih postingan artikel</h4>
				<button type="button" class="close p-3" data-dismiss='modal'>
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body pt-0">
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
							<label class="form-control-label mb-1 d-block">Jumlah data/halaman</label>
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
				<div class="row">
					<input type="hidden" name="modal">
					<div class="col load-artikel"></div>
				</div>
			</div>
		</div>	
	</div>
</div>
<div class="modal fade" id="modal-pilih-mitra-featured">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="mb-0 modal-title">Pilih data mitra</h4>
				<button type="button" class="close p-3" data-dismiss='modal'>
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body pt-0">
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
				<input type="hidden" name="modal">
				<div class="row load-mitra py-2" style="background: url('<?=site_url('images/background-logged.jpg')?>')">
				</div>
			</div>
		</div>	
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		// $("#modal-tambah-elemen").modal('show')
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
		// * -------------------------------------------------------------
		// * Load Widget  - halaman list layout
		// * -----------
		function refreshWidget(affected_id) {
			$.ajax({
				url: '<?=site_url('admin/tataletak/ajax_list/homepage_widget')?>',
				type: 'GET',
				dataType: 'html',
				data: {
					halaman: 'detail-artikel',
					penempatan: 'widget'
				},
			})
			.done(function(data) {
				$(".load-widget").html(data)
				onWidgetLoad()
				if (typeof affected_id !== 'undefined') {
					$('html, body').animate({
						scrollTop: $("#element-" + affected_id).offset().top - 100
					}, 1000, function() {
						$("#element-" + affected_id).animate({opacity: 0.5, borderWidth: '8px'}, 250, function() {
							$("#element-" + affected_id).animate({opacity: 1, borderWidth: '1px'}, 250);
						})
					})

				}
			})
		}
		function onWidgetLoad() {
			$(".btn-tambah-widget").click(function(e) {
				maxRow = $(this).data('max-row')
				$("#modal-tambah-elemen").modal('show')
				$("#modal-tambah-elemen [name='halaman']").val('detail-artikel')
				$("#modal-tambah-elemen [name='penempatan']").val('widget')
				$("#modal-tambah-elemen [name='row']").val(parseInt(maxRow + 1))
				$("#modal-tambah-elemen [name='urutan_col']").val(1)
				e.preventDefault()
			})
			$(".btn-edit-widget").click(function(e) {
				id = $(this).data('id')
				$.ajax({
					url: '<?=site_url('admin/tataletak/ajax_list/single')?>',
					type: 'GET',
					dataType: 'json',
					data: {id: id},
				})
				.done(function(data) {
					if (data != '') {
						$("#modal-edit-elemen [name='id']").val(data.id)
						$("#modal-edit-elemen [name='judul']").val(data.judul)
						$("#modal-edit-elemen [name='jenis_konten']").val(data.jenis_konten)
						$("#modal-edit-elemen [name='view']").val(data.view)
						$("#modal-edit-elemen [name='lebar_lg']").val(data.lebar_lg)
						$("#modal-edit-elemen [name='lebar_md']").val(data.lebar_md)
						$("#modal-edit-elemen [name='lebar_sm']").val(data.lebar_sm)
						$("#modal-edit-elemen [name='lebar_xs']").val(data.lebar_xs)
						$("#modal-edit-elemen [name='halaman']").val(data.halaman)
						$("#modal-edit-elemen [name='penempatan']").val(data.penempatan)
						$("#modal-edit-elemen [name='row']").val(data.row)
						$("#modal-edit-elemen [name='urutan_col']").val(data.urutan_col)
						$("#modal-edit-elemen [name='kelas']").val(data.kelas)
						options = JSON.parse(data.options)
						if (options.limit != '') 
							$("#modal-edit-elemen [name='option_limit']").val(options.limit)
						if (options.baca_selengkapnya != true) {
							$("#modal-edit-elemen [value='edit-baca_selengkapnya-tampilkan']").prop('checked', true)
						}
						else {
							$("#modal-edit-elemen [value='edit-baca_selengkapnya-sembunyikan']").prop('checked', true)
						}
						if (options.durasi !== undefined) 
							$("#modal-edit-elemen [name='option_durasi']").val(options.durasi / 1000)
						if (options.kategori_id !== undefined) 
							$("#modal-edit-elemen [name='option_kategori_artikel']").val(options.kategori_id)
						if (options.penulis !== undefined) 
							$("#modal-edit-elemen [name='option_penulis']").val(options.penulis)
						if (options.featured !== undefined) {
							artikelFeatured = data.featured
							refreshFeaturedArtikel($("#modal-edit-elemen"));
							artikelFeaturedId = artikelFeatured.map(function(artikel) {
								return artikel.id;
							})
							$("#modal-edit-elemen").find("[name='option_featured']").val(artikelFeaturedId.join('|'))
						}
						if (options.kategori_usaha !== undefined) 
							$("#modal-edit-elemen [name='option_kategori_usaha']").val(options.kategori_usaha)
						if (options.mitra_featured !== undefined) {
							mitraFeatured = data.featured_mitra
							refreshFeaturedMitra($("#modal-edit-elemen"));
							mitraFeaturedId = mitraFeatured.map(function(mitra) {
								return mitra.id;
							})
							$("#modal-edit-elemen").find("[name='option_mitra_featured']").val(mitraFeaturedId.join('|'))
						}
						if (options.background !== undefined) 
							$("#modal-edit-elemen [name='option_widget_background']").val(options.background)
						if (options.color !== undefined) 
							$("#modal-edit-elemen [name='option_widget_color']").val(options.color)
						if (options.border !== undefined) 
							$("#modal-edit-elemen [name='option_widget_border']").val(options.border)
						$("#modal-edit-elemen").modal('show')
					}
				});
			});
			$(".btn-hapus-widget").unbind().click(function(e) {
				if (confirm('Anda yakin?')) {
					id = $(this).data('id');
					$.ajax({
						url: '<?=site_url('admin/tataletak/ajax_write/delete')?>',
						type: 'POST',
						dataType: 'json',
						data: {id: id},
					})
					.done(function(data) {
						refreshWidget();
						if (data.status == 'success') {
							showAlert(data.text, data.icon, data.color)
						}
					})
				}
				e.preventDefault()
			})
			$(".btn-move-widget-up").unbind().click(function(e) {
				e.preventDefault()
				row = $(this).data('row')
				penempatan = $(this).data('penempatan')
				halaman = $(this).data('halaman')
				$.ajax({
					url: '<?=site_url('admin/tataletak/ajax_write/moveup')?>',
					type: 'POST',
					dataType: 'json',
					data: {row: row, mode: 'row', penempatan: penempatan, halaman: halaman},
				})
				.done(function(data) {
					if (data.status == 'success') {
						refreshWidget(data.affected_id)
						showAlert(data.text, data.icon, data.color)
					}
				})
			})
			$(".btn-move-widget-down").unbind().click(function(e) {
				e.preventDefault()
				row = $(this).data('row')
				penempatan = $(this).data('penempatan')
				halaman = $(this).data('halaman')
				$.ajax({
					url: '<?=site_url('admin/tataletak/ajax_write/movedown')?>',
					type: 'POST',
					dataType: 'json',
					data: {row: row, mode: 'row', penempatan: penempatan, halaman: halaman},
				})
				.done(function(data) {
					if (data.status == 'success') {
						refreshWidget(data.affected_id)
						showAlert(data.text, data.icon, data.color)
					}
				})
			})
		}
		refreshWidget();

		// * -------------------------------------------------------------
		// * Refresh Preview - Modal Tambah/Edit elemen
		// --------------
		function refreshPreview(modal) {
			let formData = new FormData(modal.find('form')[0])
			$.ajax({
				url: '<?=site_url('admin/tataletak/ajax_preview_element')?>',
				type: 'POST',
				dataType: 'html',
				data: formData,
				processData:false,
		        contentType:false,
		        cache:false,
		        async:false,
			})
			.done(function(data) {
				modal.find('.preview-element').html(data)
			})
		}
		// * -------------------------------------------------------------
		// * Modal Tambah Element untuk widget dan content
		// -----------------------------
		$("#modal-tambah-elemen").on('shown.bs.modal', function(e) {
			e.preventDefault();
			modal = $("#modal-tambah-elemen")
			function checkJenisKontenOption() {
				value = modal.find("form [name='jenis_konten']").val()
				if (value == 'kategori')
					modal.find("form .element-option-kategori_artikel").show('400')
				else 
					modal.find("form .element-option-kategori_artikel").hide('400')
				if (value == 'penulis')
					modal.find("form .element-option-penulis").show('400')
				else 
					modal.find("form .element-option-penulis").hide('400')
				if (value == 'featured')
					modal.find("form .element-option-artikel_featured").show('400')
				else {
					artikelFeatured = []
					refreshFeaturedArtikel($("#modal-tambah-elemen"))
					modal.find("form .element-option-artikel_featured").hide('400')	
				}
				// Mitra
				if (value == 'mitra-kategori')
					modal.find("form .element-option-kategori_usaha").show('400')
				else 
					modal.find("form .element-option-kategori_usaha").hide('400')	
				if (value == 'mitra-featured')
					modal.find("form .element-option-mitra_featured").show('400')
				else 
					modal.find("form .element-option-mitra_featured").hide('400')	
				if (value == 'mitra-terkini' || value == 'mitra-kategori' || value == 'mitra-featured') {
					modal.find("form option[value='carousel']").hide()
					modal.find("form option[value='card-thumbnail']").hide()
					modal.find("form option[value='mitra-slider']").show()
					modal.find("form option[value='mini-thumbnail-title']").hide()
					modal.find("form option[value='card-thumbnail-slider']").hide()
					modal.find("form option[value='text-only']").hide()
					modal.find("form [name='view']").val('mitra-slider')
					checkWidgetOption()
				}
				else {
					modal.find("form option[value='carousel']").show()
					modal.find("form option[value='card-thumbnail']").show()
					modal.find("form option[value='mitra-slider']").hide()
					modal.find("form option[value='mini-thumbnail-title']").show()
					modal.find("form option[value='card-thumbnail-slider']").show()
					modal.find("form option[value='text-only']").show()
					modal.find("form [name='view']").val('carousel')
					checkWidgetOption()
				}
				// limit
				if (value == 'mitra-featured' || value == 'featured') 
					modal.find("form .element-option-limit").hide('400')	
				else 
					modal.find("form .element-option-limit").show('400')	
			}
			function checkViewOption() {
				value = modal.find("form [name='view']").val()
				valueJenisKonten = modal.find("form [name='jenis_konten']").val()
				if (value == 'carousel' || value == 'card-thumbnail' || value == 'kalender' || value == 'arsip') {
					modal.find("form .element-option-baca_selengkapnya").hide('400')
				}
				else {
					if (valueJenisKonten == 'featured' || valueJenisKonten == 'mitra-featured')
						modal.find("form .element-option-baca_selengkapnya").hide('400')
					else
						modal.find("form .element-option-baca_selengkapnya").show('400')
				}
				if (value == 'carousel' || value == 'card-thumbnail-slider' || value == 'mitra-slider') 
					modal.find("form .element-option-durasi").show('400')
				else 
					modal.find("form .element-option-durasi").hide('400')
				if (value == 'kalender' || value == 'arsip') 
					modal.find("form .element-option-limit").hide()
				else 
					modal.find("form .element-option-limit").show()
			}
			function checkWidgetOption() {
				value = modal.find("form [name='penempatan']").val();
				valueKonten = modal.find("form [name='jenis_konten']").val()
				if (value == 'widget') {
					modal.find("form .element-option-widget-background").show('400')
					modal.find("form .element-option-widget-color").show('400')
					modal.find("form .element-option-widget-border").show('400')

					modal.find("form option[value='kalender']").show()
					modal.find("form option[value='arsip']").show()
					modal.find("form option[value='card-thumbnail']").hide()
				}
				else {
					modal.find("form .element-option-widget-background").hide('400')
					modal.find("form .element-option-widget-color").hide('400')
					modal.find("form .element-option-widget-border").hide('400')

					modal.find("form option[value='kalender']").hide()
					modal.find("form option[value='arsip']").hide()
					if (valueKonten == 'mitra-terkini' || valueKonten == 'mitra-kategori' || valueKonten == 'mitra-featured') 
						modal.find("form option[value='card-thumbnail']").hide()
					else
						modal.find("form option[value='card-thumbnail']").show()
				}
			}
			checkJenisKontenOption()
			checkWidgetOption()
			refreshPreview(modal)
			modal.find("[name='jenis_konten']").change(function(e) {
				checkJenisKontenOption()
			})
			modal.find("[name='view']").change(function(e) {
				checkViewOption()
			})
			modal.find(":input").change(function(e) {
				refreshPreview($("#modal-tambah-elemen"))
			});
			modal.find(".btn-tambah-artikel-featured").click(function(e) {
				$("#modal-pilih-artikel-featured [name='modal']").val("#modal-tambah-elemen")
				$("#modal-pilih-artikel-featured").modal('show')
			});
			modal.find(".btn-tambah-mitra-featured").click(function(e) {
				$("#modal-pilih-mitra-featured [name='modal']").val("#modal-tambah-elemen")
				$("#modal-pilih-mitra-featured").modal('show')
			});
			modal.find("form").unbind().submit(function(e) {
				e.preventDefault()
				$.ajax({
					url: '<?=site_url('admin/tataletak/ajax_write/insert')?>',
					type: 'POST',
					dataType: 'json',
					data: new FormData(this),
					cache: false,
					contentType: false,
					processData: false,
				})
				.done(function(data) {
					if (data.status == 'success') {
						refreshWidget(data.inserted_id)
						showAlert(data.text, data.icon, data.color)
					}
					modal.modal('hide')
					modal.find('form')[0].reset();
					modal.find("[name='judul'], [name='kelas'], [name='option_featured'], [name='option_mitra_featured']").val('')
					modal.find("[name='lebar_lg'], [name='lebar_md'], [name='lebar_sm'], [name='lebar_xs']").val(12)
					modal.find("[name='durasi']").val(3)
					modal.find("[name='option_limit']").val(10)
					modal.find("#baca_selengkapnya-tampilkan").prop('checked', true)
					artikelFeatured = []
					mitraFeatured = []
					refreshFeaturedArtikel($("#modal-tambah-elemen"))
				});
			});
		}); // end shown.bs.modal
		$("#modal-tambah-elemen").on('hidden.bs.modal', function(e) {
			e.preventDefault()
			$("body").removeClass('modal-open')
			modal.find("[name='jenis_konten']").unbind()
			modal.find("[name='view']").unbind()
			modal.find(":input").unbind()
			modal.find(".btn-tambah-artikel-featured").unbind()
			modal.find(".btn-tambah-mitra-featured").unbind()
			modal.find("form").unbind().unbind()

		});
		// * -------------------------------------------------------------
		// * Modal Edit Element untuk widget dan content
		// -----------------------------
		$("#modal-edit-elemen").on('shown.bs.modal', function(e) {
			e.preventDefault();
			modal = $("#modal-edit-elemen")
			function checkJenisKontenOption(initiated) {
				value = modal.find("form [name='jenis_konten']").val()
				if (value == 'kategori')
					modal.find("form .element-option-kategori_artikel").show('400')
				else 
					modal.find("form .element-option-kategori_artikel").hide('400')
				if (value == 'penulis')
					modal.find("form .element-option-penulis").show('400')
				else 
					modal.find("form .element-option-penulis").hide('400')
				if (value == 'featured')
					modal.find("form .element-option-artikel_featured").show('400')
				else 
					modal.find("form .element-option-artikel_featured").hide('400')	
				
				// Mitra
				if (value == 'mitra-kategori')
					modal.find("form .element-option-kategori_usaha").show('400')
				else 
					modal.find("form .element-option-kategori_usaha").hide('400')	
				if (value == 'mitra-featured')
					modal.find("form .element-option-mitra_featured").show('400')
				else 
					modal.find("form .element-option-mitra_featured").hide('400')	
				if (value == 'mitra-terkini' || value == 'mitra-kategori' || value == 'mitra-featured') {
					modal.find("form option[value='carousel']").hide()
					modal.find("form option[value='card-thumbnail']").hide()
					modal.find("form option[value='mitra-slider']").show()
					modal.find("form option[value='mini-thumbnail-title']").hide()
					modal.find("form option[value='card-thumbnail-slider']").hide()
					modal.find("form option[value='text-only']").hide()
					if (typeof initiated === 'undefined') 
						modal.find("form [name='view']").val('mitra-slider')
					checkViewOption()
					checkWidgetOption()
				}
				else {
					modal.find("form option[value='carousel']").show()
					modal.find("form option[value='card-thumbnail']").show()
					modal.find("form option[value='mitra-slider']").hide()
					modal.find("form option[value='mini-thumbnail-title']").show()
					modal.find("form option[value='card-thumbnail-slider']").show()
					modal.find("form option[value='text-only']").show()
					if (typeof initiated === 'undefined') 
						modal.find("form [name='view']").val('carousel')
					checkViewOption()
				}
				// limit
				if (value == 'mitra-featured' || value == 'featured') 
					modal.find("form .element-option-limit").hide('400')	
				else 
					modal.find("form .element-option-limit").show('400')	
			}
			function checkViewOption() {
				value = modal.find("form [name='view']").val()
				valueJenisKonten = modal.find("form [name='jenis_konten']").val()
				if (value == 'carousel' || value == 'card-thumbnail') {
					modal.find("form .element-option-baca_selengkapnya").hide('400')
				}
				else {
					if (valueJenisKonten == 'featured' || valueJenisKonten == 'mitra-featured')
						modal.find("form .element-option-baca_selengkapnya").hide('400')
					else
						modal.find("form .element-option-baca_selengkapnya").show('400')
				}
				if (value == 'carousel' || value == 'card-thumbnail-slider' || value == 'mitra-slider') 
					modal.find("form .element-option-durasi").show('400')
				else 
					modal.find("form .element-option-durasi").hide('400')
			}
			function checkWidgetOption() {
				value = modal.find("form [name='penempatan']").val();
				valueKonten = modal.find("form [name='jenis_konten']").val()
				if (value == 'widget') {
					modal.find("form .element-option-widget-background").show('400')
					modal.find("form .element-option-widget-color").show('400')
					modal.find("form .element-option-widget-border").show('400')

					modal.find("form option[value='kalender']").show()
					modal.find("form option[value='arsip']").show()
					modal.find("form option[value='card-thumbnail']").hide()
				}
				else {
					modal.find("form .element-option-widget-background").hide('400')
					modal.find("form .element-option-widget-color").hide('400')
					modal.find("form .element-option-widget-border").hide('400')

					modal.find("form option[value='kalender']").hide()
					modal.find("form option[value='arsip']").hide()
					if (valueKonten == 'mitra-terkini' || valueKonten == 'mitra-kategori' || valueKonten == 'mitra-featured') 
						modal.find("form option[value='card-thumbnail']").hide()
					else
						modal.find("form option[value='card-thumbnail']").show()
				}
			}
			checkJenisKontenOption(true)
			checkWidgetOption()
			refreshPreview(modal)
			modal.find("[name='jenis_konten']").change(function(e) {
				checkJenisKontenOption()
			})
			modal.find("[name='view']").change(function(e) {
				checkViewOption()
			})
			modal.find(":input").change(function(e) {
				refreshPreview($("#modal-edit-elemen"))
			});
			modal.find(".btn-tambah-artikel-featured").click(function(e) {
				$("#modal-pilih-artikel-featured [name='modal']").val("#modal-edit-elemen")
				$("#modal-pilih-artikel-featured").modal('show')
			});
			modal.find(".btn-tambah-mitra-featured").click(function(e) {
				$("#modal-pilih-mitra-featured [name='modal']").val("#modal-edit-elemen")
				$("#modal-pilih-mitra-featured").modal('show')
			});
			modal.find("form").unbind().submit(function(e) {
				e.preventDefault()
				$.ajax({
					url: '<?=site_url('admin/tataletak/ajax_write/modify')?>',
					type: 'POST',
					dataType: 'json',
					data: new FormData(this),
					cache: false,
					contentType: false,
					processData: false,
				})
				.done(function(data) {
					if (data.status == 'success') {
						refreshWidget(data.id)
						showAlert(data.text, data.icon, data.color)
					}
					modal.modal('hide')
					$("[name='judul'], [name='kelas'], [name='option_featured'], [name='option_mitra_featured']").val('')
					$("[name='lebar_lg'], [name='lebar_md'], [name='lebar_sm'], [name='lebar_xs']").val(12)
					$("[name='durasi']").val(3)
					$("[name='option_limit']").val(10)
					$("#baca_selengkapnya-tampilkan").prop('checked', true)
					artikelFeatured = []
					mitraFeatured = []
					refreshFeaturedArtikel(modal)
				});
			});
		}); // end shown.bs.modal
		$("#modal-edit-elemen").on('hidden.bs.modal', function(e) {
			e.preventDefault()
			$("body").removeClass('modal-open')
		});

		// * -------------------------------------------------------------
		// * Refresh list featured artikel untuk `tambah `dan edit
		// -----------------------------
		var artikelFeatured = []
		function refreshFeaturedArtikel(modal) {
			htmlData = "";
			artikelFeatured.forEach(function(artikel, index) {
				htmlData += `<tr>
								<td style='white-space: pre-wrap; width: 200px'>${artikel.judul}</td>
								<td>
									<a href='#' data-id='${artikel.id}' data-index='${index}' class='btn btn-danger btn-hapus-featured-artikel btn-sm rounded-circle'>
										<i class='fas fa-trash'></i>
									</a>
								</td>
							</tr>`
			})
			modal.find(".load-featured-artikel").html(htmlData)
			modal.find(".btn-hapus-featured-artikel").click(function(e) {
				index = $(this).data('index')
				artikelFeatured.splice(index, 1)
				refreshFeaturedArtikel(modal)
				artikelFeaturedId = artikelFeatured.map(function(artikel) {
					return artikel.id;
				})
				modal.find("[name='option_featured']").val(artikelFeaturedId.join('|'))
				refreshPreview(modal)
			});
		}
		// * -------------------------------------------------------------
		// * Refresh list featured artikel untuk tambah dan edit
		// -----------------------------
		var mitraFeatured = []
		function refreshFeaturedMitra(modal) {
			htmlData = "";
			mitraFeatured.forEach(function(mitra, index) {
				htmlData += `<tr>
								<td style='white-space: pre-wrap; width: 200px'>${mitra.judul}</td>
								<td>
									<a href='#' data-id='${mitra.id}' data-index='${index}' class='btn btn-danger btn-hapus-featured-mitra btn-sm rounded-circle'>
										<i class='fas fa-trash'></i>
									</a>
								</td>
							</tr>`
			})
			modal.find(".load-featured-mitra").html(htmlData)
			modal.find(".btn-hapus-featured-mitra").click(function(e) {
				index = $(this).data('index')
				mitraFeatured.splice(index, 1)
				refreshFeaturedMitra(modal)
				mitraFeaturedId = mitraFeatured.map(function(artikel) {
					return artikel.id;
				})
				modal.find("[name='option_mitra_featured']").val(mitraFeaturedId.join('|'))
				refreshPreview(modal)
			});
		}

		// * -------------------------------------------------------------
		// * modal tambah Artikel Feature 
		// * -----------
		$("#modal-pilih-artikel-featured").on('shown.bs.modal', function() {
			$("#modal-tambah-elemen").css('z-index', '1040');
			$("#modal-edit-elemen").css('z-index', '1040');
			$(".progress-wrapper").css('visibility', 'hidden');
			artikelFeaturedId = artikelFeatured.map(function(artikel) {
				return artikel.id;
			})
			let params = {
				page: 1,
				limit: 50,
				notInId: artikelFeaturedId.join('|')
			}
			function refreshList() {
				$(".progress-wrapper").css('visibility', 'visible');
				$.ajax({
					url: '<?=site_url('admin/tataletak/ajax_list_artikel/pilih-artikel')?>',
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
					modal = $($("#modal-pilih-artikel-featured [name='modal']").val())

					artikelFeatured.push({id: id, judul: judul})
					refreshFeaturedArtikel(modal);
					artikelFeaturedId = artikelFeatured.map(function(artikel) {
						return artikel.id;
					})
					$(modal).find("[name='option_featured']").val(artikelFeaturedId.join('|'))

					refreshPreview($(modal));
					$("#modal-pilih-artikel-featured").modal('hide')
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
			$("#filter-kategori").val('---');
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
			$("#filter-status").val('');
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
		$("#modal-pilih-artikel-featured").on('hidden.bs.modal', function() {
			$("#modal-tambah-elemen").css('z-index', '1050')
			$("#modal-edit-elemen").css('z-index', '1050')
	        $('body').addClass('modal-open');
		})

		$("#modal-pilih-mitra-featured").on('shown.bs.modal', function() {
			$("#modal-tambah-elemen").css('z-index', '1040')
			$("#modal-edit-elemen").css('z-index', '1040')
			modal = $("#modal-pilih-mitra-featured")
			modal.find("#filter-kecamatan").change(function(e) {
				value = $(this).val()
				loadKelurahan(value)
			});
			function loadKelurahan(kecamatan) {
				if (kecamatan == '') {
					modal.find("#filter-kelurahan").html("<option value=''>- Pilih Kelurahan -</option>")
				}
				else {
					modal.find("#filter-kelurahan").html("<option value=''>- Pilih Kelurahan -</option>")
					$.ajax({
						url: '<?=site_url('admin/mitra/dynamic_form_kelurahan')?>',
						type: 'GET',
						dataType: 'html',
						data: {kecamatan: kecamatan},
					})
					.done(function(data) {
						modal.find("#filter-kelurahan").append(data);
					});
				}
			}
			mitraFeaturedId = mitraFeatured.map((mitra) => {return mitra.id})
			let mitraParams = {
				page: 1,
				limit: 50,
				pencarian_berdasarkan: 'merek_dagang',
				notInId: mitraFeaturedId.join('|')
			}
			function refreshMitra() {
				modal.find(".progress").css('visibility', 'visible');
				$.ajax({
					url: '<?=site_url('admin/tataletak/ajax_list_mitra/pilih-mitra')?>',
					type: 'GET',
					dataType: 'html',
					data: mitraParams,
				})
				.done(function(data) {
					$.getScript("<?=site_url('js/default.js')?>")
					modal.find(".progress").css('visibility', 'hidden');
					modal.find(".load-mitra").html(data);
					eventAfterLoadMitra();
				})
			}
			refreshMitra();

			function eventAfterLoadMitra() {
				modal.find(".btn-pilih-mitra").unbind().click(function(e) {
					id = $(this).data('id')
					judul = $(this).data('judul')
					modal = $($("#modal-pilih-mitra-featured [name='modal']").val())

					mitraFeatured.push({id: id, judul: judul})
					refreshFeaturedMitra(modal);
					mitraFeaturedId = mitraFeatured.map(function(mitra) {
						return mitra.id;
					})
					$(modal).find("[name='option_mitra_featured']").val(mitraFeaturedId.join('|'))

					refreshPreview($(modal));
					$("#modal-pilih-mitra-featured").modal('hide')
				});
			}

			modal.find(".filter-page").change(function(e) {
				value = $(this).val()
				if (value >= 1) {
					mitraParams.page = value
					modal.find(".filter-page").val(value)
				}
				else {
					$(this).val(1);
					delete mitraParams.page
				}
				refreshMitra();
			})
			modal.find(".filter-btn-previous").click(function(e) {
				value = modal.find(".filter-page").val()
				value = parseInt(value) - 1
				if (value <= 0) {
					value = 1;
				}
				modal.find(".filter-page").val(value)
				mitraParams.page = value
				refreshMitra();
			})
			modal.find(".filter-btn-next").click(function(e) {
				value = modal.find(".filter-page").val()
				value = parseInt(value) + 1
				modal.find(".filter-page").val(value)
				mitraParams.page = value
				refreshMitra();
			})
			modal.find("#filter-kecamatan").change(function(e) {
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
			modal.find("#filter-kelurahan").change(function(e) {
				value = $(this).val()
				if (value != '') {
					mitraParams.kelurahan = value
				}
				else {
					delete mitraParams.kelurahan
				}
				refreshMitra();
			})
			modal.find("#filter-status_usaha").change(function(e) {
				value = $(this).val()
				if (value != '') {
					mitraParams.status_usaha = value
				}
				else {
					delete mitraParams.status_usaha
				}
				refreshMitra();
			})
			modal.find("#filter-jenis_usaha").change(function(e) {
				value = $(this).val()
				if (value != '') {
					mitraParams.jenis_usaha = value
				}
				else {
					delete mitraParams.jenis_usaha
				}
				refreshMitra();
			})
			modal.find(".filter-pencarian").on('input', function(e) {
				value = $(this).val()
				if (value != '') {
					mitraParams.pencarian = value
				}
				else {
					delete mitraParams.pencarian
				}
				refreshMitra();
			})
			modal.find(".filter-pencarian_berdasarkan").change(function(e) {
				value = $(this).val()
				if (value != '') {
					mitraParams.pencarian_berdasarkan = value
				}
				else {
					delete mitraParams.pencarian_berdasarkan
				}
				refreshMitra();
			})
			modal.find("#filter-limit").change(function(e) {
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
		})
		$("#modal-pilih-mitra-featured").on('hidden.bs.modal', function() {
			$("#modal-tambah-elemen").css('z-index', '1050')
			$("#modal-edit-elemen").css('z-index', '1050')
	        $('body').addClass('modal-open');
		})

		
	});

</script>
<?php $this->endSection(); ?>