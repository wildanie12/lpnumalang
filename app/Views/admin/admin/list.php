<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<!------------------------------------------------->
<!-------   Filter / Penyaringan data      -------->
<!------------------------------------------------->
<div class="header bg-primary py-5">
	<div class="container-fluid">
		<div class="row">
			<div class="col d-flex flex-row align-items-center">
				<i class="fas fa-users-cog" style="font-size: 36pt; color: white;"></i>
				<div class="title ml-4">
					<h2 class="text-white">DAFTAR ADMINISTRATOR TERDAFTAR</h2>
				</div>
			</div>
		</div>
	</div>
</div> <!-- end header -->
<div class="container">
	<div class="row">
		<div class="col form-group">
			<label class="form-control-label">Nama</label>
			<div class="input-group input-group-merge">
				<div class="input-group-prepend">
					<span class="input-gruop-text"><i class="fas fa-signature"></i></span>
				</div>
				<input type="text" class="form-control" name="nama" placeholder="Masukkan nama ....">
			</div>
		</div>
		<div class="input-group"></div>
	</div>
</div>
<div class="container-fluid mt--3">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body table-responsive">
					<table class="table table-striped">
						<tr>
							<th>Nama Lengkap</th>
							<th>Username</th>
							<th>Tanggal Lahir</th>
							<th style="white-space: pre-wrap;">Alamat</th>
							<th>Nomor hp</th>
							<th>Nomor ktp</th>
							<th>Tgl. Ditambahkan</th>
							<th></th>
						</tr>
						<?php 
							foreach ($data_admin as $admin) {
						?>
						<tr>
							<td class="d-flex align-items-center">
								<?php 
			                        $gambar = 'admin-default.png';
			                        if ($admin['avatar'] != '') {
			                            if (file_exists('./images/profile/' . $admin['avatar'])) {
			                                $gambar = $admin['avatar'];
			                            }
			                        }
			                    ?>
								<div class="rounded-circle foto-profil-wrapper" style="overflow: hidden; width: 40px; height: 40px">
									<img class="foto-profil" style="width:40px" src="<?=site_url('images/profile/' . $gambar)?>">
								</div>
								<h4 class="text-dark mb-0 ml-2"><?=$admin['nama_lengkap']?></h4>
							</td>
							<td style="vertical-align: middle"><?=$admin['username']?></td>
							<td style="vertical-align: middle"><?=date('d-m-Y', strtotime($admin['tanggal_lahir']))?></td>
							<td style="vertical-align: middle" style="white-space: pre-wrap;"><?=$admin['alamat']?></td>
							<td style="vertical-align: middle"><?=$admin['nomor_hp']?></td>
							<td style="vertical-align: middle"><?=$admin['nomor_ktp']?></td>
							<td style="vertical-align: middle"><?=date('d-m-Y H:i:s', strtotime($admin['created_at']))?></td>
							<td style="vertical-align: middle">
								<form action="<?=site_url('admin/pengguna')?>" method="post" class='content-delete'>
									<input type="hidden" name="username" value="<?=$admin['username']?>">
									<button type="submit" class="btn btn-sm rounded-circle btn-danger" data-toggle='tooltip' title='Hapus Admin'>
										<i class="fas fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>
						<?php 
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div> <!-- end container-fluid -->


<?php $this->endSection(); ?>

<?php $this->section('jsContent') ?>
<script type="text/javascript">
	$(".content-delete").submit(function(e) {
		if (!confirm('Anda Yakin?')) {
			e.preventDefault();
		}
	});

</script>
<?php $this->endSection(); ?>