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
							<div class="col-md-3 col-sm-6 col-12">
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Kecamatan</label>
									<select class="form-control form-control-sm" id="filter-kecamatan">
										<option value="">- Pilih kecamatan -</option>
										<option value="">Ampelgading</option>
										<option value="">Gondanglegi</option>
										<option value="">Bululawang</option>
										<option value="">Kepanjen</option>
										<option value="">Pakis</option>
									</select>
								</div>
								<div class="form-group mb-1">
									<label class="form-control-label mb-0">Kelurahan</label>
									<select class="form-control form-control-sm" id="filter-kelurahan">
										<option value="">- Pilih Kelurahan -</option>
										<option value="">Ampelgading</option>
										<option value="">Gondanglegi</option>
										<option value="">Bululawang</option>
										<option value="">Kepanjen</option>
										<option value="">Pakis</option>
									</select>
								</div>
							</div> <!-- end col -->
							<div class="col-md-3 col-sm-6 col-12">
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
										<option value="">Makanan & Minuman</option>
										<option value="">Elektronik</option>
										<option value="">Warung Kopi</option>
										<option value="">Peternakan Ayam</option>
									</select>
								</div>
							</div> <!-- end col -->
							<div class="col-md-6 col-sm-12 col-12">
								<div class="row">
									<div class="col">
										<div class="form-group mb-1">
											<label class="form-control-label mb-0">Pencarian</label>
											<div class="input-group input-group-merge input-group-sm">
												<input type="text" class="form-control" id="filter-pencarian">
												<div class="input-group-append">
													<span class="input-group-text"><i class="fas fa-search"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-8 col-lg-8 col-sm-6 col-6">
										<div class="form-group mb-1">
											<label class="form-control-label mb-1 d-block">Cari berdasarkan</label>
											<div class="custom-control custom-control-inline custom-radio">
												<input type="radio" name="cari_berdasarkan" value="nama_lengkap" id="search_by_name" class="custom-control-input" checked>
												<label class="custom-control-label font-weight-bold text-uppercase" style="color: green; font-size: 11pt" for="search_by_name">Nama <div class="d-none d-lg-inline-block">Lengkap</div></label>
											</div>
											<div class="custom-control custom-control-inline custom-radio">
												<input type="radio" name="cari_berdasarkan" value="merek_dagang" id="search_by_merek" class="custom-control-input">
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
								</div> <!-- end row filter content -->
							</div> <!-- end col -->
						</div> <!-- end row -->
						<div class="progress-wrapper p-0" style="visibility: visible;">
							<div class="progress mb-1">
								<div class="progress-bar bg-success progress-bar-animated progress-bar-striped" style="width: 100%"></div>
							</div>
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
		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8" style="z-index: 100">
							<h2 class="mb-3" style="color: #099543; font-weight: bolder">Toserba Al-Majid </h2>			
							<hr class="mb-2 mt-0">

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
							<h4 style="font-weight: bolder">Budi Mulyono</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Kategori Usaha</span>
							<h4 style="font-weight: bolder">Makanan & Minuman, Elektronik</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Alamat</span>
							<h4 style="font-weight: bolder">Jl. Melati 03/01, Dsn.Krajan, Putat Lor, Gondanglegi, Malang.</h4>
						</div>
						<div class="col-6 center-crop" style="background-image: url('<?=site_url('images/mitra/mitra-01.jpg')?>'); margin-left: -20%; overflow: hidden">
							<div class="triangle"><div></div></div>
							<div class="row" style="position: absolute; right: 0; bottom: 6px;">
								<div class="col d-flex justify-content-center">
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="btn btn-danger btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<hr class="m-1">

				</div>
			</div> <!-- end card -->
		</div> <!-- end col -->
		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8" style="z-index: 100">
							<h2 class="mb-3" style="color: #099543; font-weight: bolder">Toserba Al-Majid </h2>			
							<hr class="mb-2 mt-0">

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
							<h4 style="font-weight: bolder">Budi Mulyono</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Kategori Usaha</span>
							<h4 style="font-weight: bolder">Makanan & Minuman, Elektronik</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Alamat</span>
							<h4 style="font-weight: bolder">Jl. Melati 03/01, Dsn.Krajan, Putat Lor, Gondanglegi, Malang.</h4>
						</div>
						<div class="col-6 center-crop" style="background-image: url('<?=site_url('images/mitra/mitra-01.jpg')?>'); margin-left: -20%; overflow: hidden">
							<div class="triangle"><div></div></div>
							<div class="row" style="position: absolute; right: 0; bottom: 6px;">
								<div class="col d-flex justify-content-center">
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="btn btn-danger btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<hr class="m-1">

				</div>
			</div> <!-- end card -->
		</div> <!-- end col -->
		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8" style="z-index: 100">
							<h2 class="mb-3" style="color: #099543; font-weight: bolder">Toserba Al-Majid </h2>			
							<hr class="mb-2 mt-0">

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
							<h4 style="font-weight: bolder">Budi Mulyono</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Kategori Usaha</span>
							<h4 style="font-weight: bolder">Makanan & Minuman, Elektronik</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Alamat</span>
							<h4 style="font-weight: bolder">Jl. Melati 03/01, Dsn.Krajan, Putat Lor, Gondanglegi, Malang.</h4>
						</div>
						<div class="col-6 center-crop" style="background-image: url('<?=site_url('images/mitra/mitra-01.jpg')?>'); margin-left: -20%; overflow: hidden">
							<div class="triangle"><div></div></div>
							<div class="row" style="position: absolute; right: 0; bottom: 6px;">
								<div class="col d-flex justify-content-center">
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="btn btn-danger btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<hr class="m-1">

				</div>
			</div> <!-- end card -->
		</div> <!-- end col -->
		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8" style="z-index: 100">
							<h2 class="mb-3" style="color: #099543; font-weight: bolder">Toserba Al-Majid </h2>			
							<hr class="mb-2 mt-0">

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
							<h4 style="font-weight: bolder">Budi Mulyono</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Kategori Usaha</span>
							<h4 style="font-weight: bolder">Makanan & Minuman, Elektronik</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Alamat</span>
							<h4 style="font-weight: bolder">Jl. Melati 03/01, Dsn.Krajan, Putat Lor, Gondanglegi, Malang.</h4>
						</div>
						<div class="col-6 center-crop" style="background-image: url('<?=site_url('images/mitra/mitra-01.jpg')?>'); margin-left: -20%; overflow: hidden">
							<div class="triangle"><div></div></div>
							<div class="row" style="position: absolute; right: 0; bottom: 6px;">
								<div class="col d-flex justify-content-center">
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="btn btn-danger btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<hr class="m-1">

				</div>
			</div> <!-- end card -->
		</div> <!-- end col -->
		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8" style="z-index: 100">
							<h2 class="mb-3" style="color: #099543; font-weight: bolder">Toserba Al-Majid </h2>			
							<hr class="mb-2 mt-0">

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
							<h4 style="font-weight: bolder">Budi Mulyono</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Kategori Usaha</span>
							<h4 style="font-weight: bolder">Makanan & Minuman, Elektronik</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Alamat</span>
							<h4 style="font-weight: bolder">Jl. Melati 03/01, Dsn.Krajan, Putat Lor, Gondanglegi, Malang.</h4>
						</div>
						<div class="col-6 center-crop" style="background-image: url('<?=site_url('images/mitra/mitra-01.jpg')?>'); margin-left: -20%; overflow: hidden">
							<div class="triangle"><div></div></div>
							<div class="row" style="position: absolute; right: 0; bottom: 6px;">
								<div class="col d-flex justify-content-center">
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="btn btn-danger btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<hr class="m-1">

				</div>
			</div> <!-- end card -->
		</div> <!-- end col -->
		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8" style="z-index: 100">
							<h2 class="mb-3" style="color: #099543; font-weight: bolder">Toserba Al-Majid </h2>			
							<hr class="mb-2 mt-0">

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
							<h4 style="font-weight: bolder">Budi Mulyono</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Kategori Usaha</span>
							<h4 style="font-weight: bolder">Makanan & Minuman, Elektronik</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Alamat</span>
							<h4 style="font-weight: bolder">Jl. Melati 03/01, Dsn.Krajan, Putat Lor, Gondanglegi, Malang.</h4>
						</div>
						<div class="col-6 center-crop" style="background-image: url('<?=site_url('images/mitra/mitra-01.jpg')?>'); margin-left: -20%; overflow: hidden">
							<div class="triangle"><div></div></div>
							<div class="row" style="position: absolute; right: 0; bottom: 6px;">
								<div class="col d-flex justify-content-center">
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="btn btn-danger btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<hr class="m-1">

				</div>
			</div> <!-- end card -->
		</div> <!-- end col -->
		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8" style="z-index: 100">
							<h2 class="mb-3" style="color: #099543; font-weight: bolder">Toserba Al-Majid </h2>			
							<hr class="mb-2 mt-0">

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
							<h4 style="font-weight: bolder">Budi Mulyono</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Kategori Usaha</span>
							<h4 style="font-weight: bolder">Makanan & Minuman, Elektronik</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Alamat</span>
							<h4 style="font-weight: bolder">Jl. Melati 03/01, Dsn.Krajan, Putat Lor, Gondanglegi, Malang.</h4>
						</div>
						<div class="col-6 center-crop" style="background-image: url('<?=site_url('images/mitra/mitra-01.jpg')?>'); margin-left: -20%; overflow: hidden">
							<div class="triangle"><div></div></div>
							<div class="row" style="position: absolute; right: 0; bottom: 6px;">
								<div class="col d-flex justify-content-center">
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="btn btn-danger btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<hr class="m-1">

				</div>
			</div> <!-- end card -->
		</div> <!-- end col -->
		<div class="col-lg-4 col-md-6 col-sm-12 col-12">
			<div class="card">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-8" style="z-index: 100">
							<h2 class="mb-3" style="color: #099543; font-weight: bolder">Toserba Al-Majid </h2>			
							<hr class="mb-2 mt-0">

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Nama Pemilik</span>
							<h4 style="font-weight: bolder">Budi Mulyono</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Kategori Usaha</span>
							<h4 style="font-weight: bolder">Makanan & Minuman, Elektronik</h4>

							<span class="text-muted text-uppercase" style="font-weight: bolder; font-size: 8pt">Alamat</span>
							<h4 style="font-weight: bolder">Jl. Melati 03/01, Dsn.Krajan, Putat Lor, Gondanglegi, Malang.</h4>
						</div>
						<div class="col-6 center-crop" style="background-image: url('<?=site_url('images/mitra/mitra-01.jpg')?>'); margin-left: -20%; overflow: hidden">
							<div class="triangle"><div></div></div>
							<div class="row" style="position: absolute; right: 0; bottom: 6px;">
								<div class="col d-flex justify-content-center">
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Lihat Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-icon-only rounded-circle" data-toggle='tooltip' title="Edit Data Mitra">
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a href="#" class="btn btn-danger btn-icon-only rounded-circle" data-toggle='tooltip' title=" Hapus Data Mitra">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<hr class="m-1">

				</div>
			</div> <!-- end card -->
		</div> <!-- end col -->
	</div> <!-- end row -->
</div> <!-- end container-fluid -->

<?php $this->endSection(); ?>