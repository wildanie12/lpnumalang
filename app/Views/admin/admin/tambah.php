<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid mt-4">
    <form action="<?=site_url('admin/admin/save')?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Tambah Akun Administrator </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col form-group lpnu-form mb-2">
                                    <label class="form-control-label">Username</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend <?=(($validation->hasError('username')) ? 'is-invalid' : '')?>">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" value="<?=old('username')?>" name="username" class="form-control <?=(($validation->hasError('username')) ? 'is-invalid' : '')?>">
                                    </div>
                                    <?php 
                                        if ($validation->hasError('username')) {
                                    ?>
                                    <div class="invalid-feedback d-block font-italic"><?=$validation->getError('username')?></div>
                                    <?php 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group lpnu-form mb-2">
                                    <label class="form-control-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" value="<?=old('password')?>" name="password" class="form-control">
                                    </div>
                                    <span class="text-muted text-xs">Kosongi jika tidak ingin merubah password</span>
                                </div>
                                <div class="col-sm-6 form-group lpnu-form mb-2">
                                    <label class="form-control-label">Konfirmasi Password</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend <?=(($validation->hasError('password_confirm')) ? 'is-invalid' : '')?>">
                                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                        </div>
                                        <input type="password" value="<?=old('password_confirm')?>" name="password_confirm" class="form-control <?=(($validation->hasError('password_confirm')) ? 'is-invalid' : '')?>">
                                    </div>
                                    <span class="text-muted text-xs">Kosongi jika tidak ingin merubah password</span>
                                    <?php 
                                        if ($validation->hasError('password_confirm')) {
                                    ?>
                                    <div class="invalid-feedback d-block font-italic"><?=$validation->getError('password_confirm')?></div>
                                    <?php 
                                        }
                                    ?>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group lpnu-form mb-2">
                                    <label class="form-control-label">Nama Lengkap</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend <?=(($validation->hasError('nama_lengkap')) ? 'is-invalid' : '')?>">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                        </div>
                                        <input type="text" value="<?=old('nama_lengkap')?>" name="nama_lengkap" class="form-control <?=(($validation->hasError('nama_lengkap')) ? 'is-invalid' : '')?>">
                                    </div>
                                    <?php 
                                        if ($validation->hasError('nama_lengkap')) {
                                    ?>
                                    <div class="invalid-feedback d-block font-italic"><?=$validation->getError('nama_lengkap')?></div>
                                    <?php 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group lpnu-form mb-2">
                                    <label class="form-control-label">Tanggal Lahir</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" value="<?=old('tanggal_lahir')?>" name="tanggal_lahir" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group lpnu-form mb-2">
                                    <label class="form-control-label">Alamat</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                        </div>
                                        <textarea value="<?=old('alamat')?>" name="alamat" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group lpnu-form mb-2">
                                    <label class="form-control-label">Nomor Handphone</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="text" value="<?=old('nomor_hp')?>" name="nomor_hp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group lpnu-form mb-2">
                                    <label class="form-control-label">Nomor KTP</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                        </div>
                                        <input type="text" value="<?=old('nomor_ktp')?>" name="nomor_ktp" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <input type="submit" name="submit" class="btn btn-primary btn-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="card card-profile mt-5 order-1">
                    <?php 
                        $gambar = 'admin-default.png';
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-12 order-lg-2">
                            <div class="rounded-circle foto-profil-wrapper" style="overflow: hidden; position: absolute; width: 150px; height: 150px; top: -110px; left: 34%;">
                                <img src="<?=site_url('images/profile/' . $gambar)?>" class="foto-profil gambar-fill" data-toggle='tooltip' title="Klik untuk mengganti foto profil" data-placement="left" style="position: relative; cursor: pointer">
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="card-body pt-5">
                            <div class="row">
                                <div class="col">
                                        <div class="text-center">
                                        <h5 class="h3">
                                            <span class="fill-nama_lengkap">- Nama Lengkap - </span>
                                        </h5>
                                        <div class="h5 font-weight-300">
                                            <i class="ni location_pin mr-2"></i><span class="fill-alamat">- Alamat - </span>
                                        </div>
                                        <div>
                                            <i class="ni education_hat mr-2"></i>Administrator LPNU Malang
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row mt-4">
                                <div class="col form-group lpnu-form mb-2">
                                    <label class="form-control-label">Ganti foto profil</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                        </div>
                                        <input type="file" value="<?=old('avatar')?>" name="avatar" class="form-control element-gambar">
                                    </div>
                                    <span class="text-muted text-xs">Kosongi jika tidak ingin merubah foto</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $this->endSection()?>
<?php $this->section('jsContent')?>
<script type="text/javascript">
    $('.foto-profil').click(function(e) {
        $("[name='avatar']").click();
    });

    $(".foto-profil").each(function() {
        hitungAspectRatio($(this))
    })

	$("[name='nama_lengkap']").on('input', function(e) {
		value = $(this).val();
		if (value != '') {
			$(".fill-nama_lengkap").html(value);
		}
		else {
			$(".fill-nama_lengkap").html('- Nama Lengkap -');
		}
	});
	$("[name='alamat']").on('input', function(e) {
		value = $(this).val();
		if (value != '') {
			$(".fill-alamat").html(value);
		}
		else {
			$(".fill-alamat").html('- Alamat -');
		}
	});

    
</script>
<?php $this->endSection()?>