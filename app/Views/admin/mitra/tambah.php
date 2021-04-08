<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid mt-4">
	<form action="<?=site_url('admin/mitra/save')?>" method="post">
		<?=csrf_field()?>
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header p-3" style="line-height: 8px">
						<h3 class="card-title mb-0 pb-0">Tambah data Mitra LPNU Malang</h3>
						<span class="text-muted text-uppercase font-weight-bold" style="font-size: 8pt;">Masukkan identitas, gambar, dan artikel profil di formulir berikut</span>
					</div>
					<div class="card-body">
						<div class="row">							
							<div class="col form-group mb-1 lpnu-form">
								<label class="form-control-label">Nama Pemilik</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-signature"></i></span>
									</div>
									<input type="text" name="nama_pemilik" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col form-group mb-1 lpnu-form">
								<label class="form-control-label">Nomor HP</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
									</div>
									<input type="text" name="nomor_hp" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col-sm-6 pr-sm-1 form-group mb-1 lpnu-form">
								<label class="form-control-label">Kecamatan</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-city"></i></span>
									</div>
										<?php
											$options_kecamatan = [];
											foreach ($data_kecamatan as $kecamatan) {
												$options_kecamatan[$kecamatan['kecamatan']] = ucwords(strtolower($kecamatan['kecamatan']));
											}
											echo form_dropdown('kecamatan', $options_kecamatan, '', ['class' => 'form-control input-kecamatan']);
										?>
								</div>
							</div>
							<div class="col-sm-6 pl-sm-1 form-group mb-1 lpnu-form">
								<label class="form-control-label">Kelurahan</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-city"></i></span>
									</div>
									<select class="form-control" name="kelurahan" id="load-input-kelurahan">
										<option>Putat Lor</option>
										<option>Putat Kidul</option>
										<option>Ganjaran</option>
										<option>Sepanjang</option>
										<option>Gondanglegi Wetan</option>
										<option>Gondanglegi</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col form-group mb-1 lpnu-form">
								<label class="form-control-label">Alamat usaha</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
									</div>
									<textarea class="form-control" rows="3" name="alamat_usaha"></textarea>
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col-sm-6 pr-sm-1 form-group mb-1 lpnu-form">
								<label class="form-control-label">Ranting NU</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-sitemap"></i></span>
									</div>
									<input type="text" name="ranting_nu" class="form-control">
								</div>
							</div>
							<div class="col-sm-6 pl-sm-1 form-group mb-1 lpnu-form">
								<label class="form-control-label">MWCNU</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-code-branch"></i></span>
									</div>
									<input type="text" name="mwcnu" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">							
							<div class="col-sm-6 pr-sm-1 form-group mb-1 lpnu-form">
								<label class="form-control-label">Peran Ekonomi</label>
								<select id="tags-status_usaha" class="form-control" name="status_usaha[]" multiple>
									<option value="Produsen">Produsen</option>
									<option value="Distributor">Distributor</option>
									<option value="Agen">Agen</option>
									<option value="Retail">Retail</option>
								</select>
								<span class="text-muted text-xs">Anda bisa menambahkan lebih dari satu</span>

							</div>
							<div class="col-sm-6 pl-sm-1 form-group mb-1 lpnu-form">
								<label class="form-control-label">Kategori Usaha <a href="javascript:void(0)" class="btn-tambah-kategori" style='font-size:8pt'>[Tambah Kategori]</a></label>
								<select id="tags-jenis_usaha" class="form-control" name="jenis_usaha[]" multiple>
									<option value="Makanan & Minuman">Makanan & Minuman</option>
									<option value="Warung Kopi">Warung Kopi</option>
									<option value="Elektronik">Elektronik</option>
								</select>
								<span class="text-muted text-xs">Anda bisa tambah kategori jika tidak ada</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col mb-1 lpnu-form">
								<label class="form-control-label">Nama Barang</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-boxes"></i></span>
									</div>
									<input type="text" name="nama_barang" class="form-control">
								</div>
								<span class="text-muted text-xs">Anda juga bisa menambahkan lebih dari 1, <strong>Gunakan tanda , (koma) </strong> untuk memisahkan</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col mb-1 lpnu-form">
								<label class="form-control-label">Merek Dagang</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-copyright"></i></span>
									</div>
									<input type="text" name="merek_dagang" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col mb-1 lpnu-form">
								<label class="form-control-label">Ada Izin?</label>
								<div class="input-group input-group-merge">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-boxes"></i></span>
									</div>
									<select class="form-control" name="izin">
										<option value="Ada">Ada</option>
										<option value="Belum ada">Belum ada</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- end card -->
			</div> <!-- end col -->
			<div class="col-md-6">
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-header p-3" style="line-height: 8px">
								<h4 class="card-title mb-0 pb-0">Galeri foto Mitra</h4>
								<span class="text-muted text-uppercase" style="font-size: 8pt">Anda dapat memambahkan lebih dari 1 FSoto</span>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col">
										<input type="hidden" name="galeri">
										<div id="dz-mitra" class="dz-wrapper">
											<div class="dz-default dz-message">
												<h4>SERET FILE DISINI</h4>
								                <p>ATAU KLIK UNTUK UPLOAD</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col d-flex justify-content-center flex-wrap" id="load-galeri">
										
									</div>
								</div>
							</div>
						</div> <!-- end card -->
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="card bg-primary text-white">
							<div class="card-body">
								<div class="row">
									<div class="col-lg-6">
										<h3 class="text-white mt-2 mt-lg-0"><span class="fill-nama_pemilik">Nama Pemilik</span></h3>
										<table class="table table-condensed text-white">
											<tr>
												<th>Nomor HP</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-nomor_hp">-</span></td>
											</tr>
											<tr>
												<th>Kecamatan</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-kecamatan">-</span></td>
											</tr>
											<tr>
												<th>Kelurahan</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-kelurahan">-</span></td>
											</tr>
											<tr>
												<th>Alamat</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-alamat_usaha">-</span></td>
											</tr>
											<tr>
												<th>Ranting</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-ranting_nu">-</span></td>
											</tr>
											<tr>
												<th>MWCNU</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-mwcnu">-</span></td>
											</tr>
										</table>
									</div>
								</div> <!-- end row identity -->
								<div class="row mt-2">
									<div class="col">
										<table class="table table-condensed text-white">
											<tr>
												<th style="max-width: 40%">Merek Dagang</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-merek_dagang">-</span></td>
											</tr>
											<tr>
												<th style="max-width: 40%">Peran Ekonomi</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-status_usaha">-</span></td>
											</tr>
											<tr>
												<th style="max-width: 40%">Kategori Usaha</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-jenis_usaha">-</span></td>
											</tr>
											<tr>
												<th style="max-width: 40%">Nama Barang</th>
												<td style="width: 15px">:</td>
												<td><span class="fill-nama_barang">-</span></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- end col -->
		</div> <!-- end row -->
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header p-3" style="line-height: 8px">
						<h3 class="card-title mb-0 pb-0">Tulis artikel profil Mitra (opsional)</h3>
						<span class="text-muted text-uppercase font-weight-bold" style="font-size: 8pt;">Anda dapat menuliskan sesuatu tentang profil yang anda input.</span>
					</div>
					<div class="card-body">
						<div class="form-group lpnu-form">
							<input type="hidden" name="status">
							<input type="hidden" name="list_gambar">
							<textarea name="artikel" id="artikel-mitra" rows="8"></textarea>
						</div>
						<div class="form-group lpnu-form row justify-content-center">
							<div class="col">
								<input type="submit" name="publikasikan" class="btn btn-primary btn-block" value="Publikasikan">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end row-->
	</form>
</div>
<?php $this->endSection(); ?>

<?php $this->section('jsContent') ?>
<script type="text/javascript">
		
	jQuery(document).ready(function($) {
		var submitted = false;
		$("form").submit(function(e) {
			submitted = true;
		});
		window.onbeforeunload = function () {
			if (!submitted) {
				listGaleri.forEach(function(item, index) {
					$.ajax({
						url: '<?=site_url('admin/mitra/galeri_handler/delete')?>',
						type: 'POST',
						dataType: 'json',
						data: {image: item}
					})
					.always(function() {
					});
				})
			}
		};
		loadKelurahan($(".input-kecamatan").val());
		$(".input-kecamatan").change(function(e) {
			value = $(this).val()
			loadKelurahan(value)
		});
		function loadKelurahan(kecamatan) {
			$.ajax({
				url: '<?=site_url('admin/mitra/dynamic_form_kelurahan')?>',
				type: 'GET',
				dataType: 'html',
				data: {kecamatan: kecamatan},
			})
			.done(function(data) {
				$("#load-input-kelurahan").html(data)
			});
		}




		$("[name='nama_pemilik']").change(function(e) {
			value = $(this).val()
			$(".fill-nama_pemilik").html(value)
		});
		$("[name='nomor_hp']").change(function(e) {
			value = $(this).val()
			$(".fill-nomor_hp").html(value)
		});
		$("[name='kecamatan']").change(function(e) {
			value = $(this).val()
			$(".fill-kecamatan").html(value)
		});
		$("[name='kelurahan']").change(function(e) {
			value = $(this).val()
			$(".fill-kelurahan").html(value)
		});
		$("[name='alamat_usaha']").change(function(e) {
			value = $(this).val()
			$(".fill-alamat_usaha").html(value)
		});
		$("input[name='ranting_nu']").change(function(e) {
			value = $(this).val()
			$(".fill-ranting_nu").html(value)
		})
		$("[name='mwcnu']").change(function(e) {
			value = $(this).val()
			$(".fill-mwcnu").html(value)
		})
		$("[name='merek_dagang']").change(function(e) {
			value = $(this).val()
			$(".fill-merek_dagang").html(value)
		})
		$("#tags-status_usaha").change(function(e) {
			value = $(this).val()
			$(".fill-status_usaha").html(value.join(', '))
		})
		$("#tags-jenis_usaha").change(function(e) {
			value = $(this).val()
			$(".fill-jenis_usaha").html(value.join(', '))
		})
		$("[name='nama_barang']").change(function(e) {
			value = $(this).val()
			$(".fill-nama_barang").html(value)
		})
		var statusUsaha = tail.select('#tags-status_usaha', {
			animate: true,
			hideSelected: true,
			multiContainer: true,
			multiShowCount: false,
		})
		var kategoriUsaha = tail.select('#tags-jenis_usaha', {
			animate: true,
			hideSelected: true,	
			multiShowCount: false,
			multiContainer: true,
			search: true,
			cbLoopItem: (item, group, search) => {
				console.log(item);
				var newItem = document.createElement('li');
				newItem.innerHTML = "<a href='#' class='delete-item btn btn-sm btn-danger rounded-circle' data-toggle='tooltip' title='Hapus kategori' data-value='" +item.description+ "'><i class='fas fa-times'></i></a> " + item.value;
				return newItem;
			},
			cbComplete: () => {
				$('.delete-item').click(function(e) {
					e.preventDefault();
					value = $(this).data('value');
					$.ajax({
						url: '<?=site_url('admin/mitra/dynamic_form_write_jenis_usaha/delete')?>',
						type: 'POST',
						dataType: 'json',
						data: {
							id: value
						}
					})
					.done(function(data) {
						refreshJenisUsaha(true);
					})
				});
			}
		})
		$(".btn-tambah-kategori").popover({
	        html: true,
	        trigger: 'click',
	        placement: 'left',
	        content: `<input id='tambah-kategori' type='text' class='form-control form-control-sm' placeholder='Tuliskan kategori usaha...'>`,
	        title: 'Buat kategori baru',
	        sanitize: false,
	        template: `<div class="popover text-center pb-2" role="tooltip">
	        				<a href='#' class='close-popover' style='color: white; position: absolute; top: 8px; right: 6px;'>
	        					<i class='fas fa-times'></i>
	        				</a>
	                        <div class="arrow"></div>
	                        <h3 class="popover-header pb-2 text-sm text-left text-uppercase bg-primary text-white"></h3>
	                        <div class="popover-body p-1">
	                        </div>
	                    	<input type='button' class='btn btn-primary btn-sm btn-tambah-kategori-submit' value='Tambah'>
	                    </div>`
	    })
	    .on('shown.bs.popover', function() {
	        $this = $(this);
	        $('.close-popover').click(function(e) {
	            e.preventDefault()
	            $this.popover('hide')
	        });
	        $('#tambah-kategori').focus()
	        $('#tambah-kategori').keypress(function(e) {
	        	value = $(this).val();
	        	if (e.which == 13) {
	        		tambahJenisUsaha(value)
		            $this.popover('hide')
	        	}
	        })

	        $('.btn-tambah-kategori-submit').click(function(e) {
	        	value = $('#tambah-kategori').val()
        		tambahJenisUsaha(value)
	            $this.popover('hide')
	        });
	    })

	    function refreshJenisUsaha(open) {
			$.ajax({
				url: '<?=site_url('admin/mitra/dynamic_form_jenis_usaha')?>',
				type: 'GET',
				dataType: 'html',
			})
			.done(function(data) {
				console.log(data);
				$("#tags-jenis_usaha").html(data);
				kategoriUsaha.reload();
				if (typeof open !== 'undefined') {
					kategoriUsaha.open();
				}
			});
		}
		function tambahJenisUsaha(kategori) {
			$.ajax({
				url: '<?=site_url('admin/mitra/dynamic_form_write_jenis_usaha/insert')?>',
				type: 'POST',
				dataType: 'html',
				data: {kategori: kategori},
			})
			.done(function(data) {
				refreshJenisUsaha(true);
			})
		}
		refreshJenisUsaha();


	    var listGaleri = []
	    var dzMitra = new Dropzone('#dz-mitra', {
	    	url: '<?=site_url('admin/mitra/galeri_handler/upload')?>',
	    	addRemoveLinks: true,
	    });
	    dzMitra.on('success', function(file, response) {
	    	dataResponse = JSON.parse(response)
	    	listGaleri.push(dataResponse.url);
	    	$("[name='galeri']").val(listGaleri.join('|'))
	    	refreshGaleri();
	    })
		dzMitra.on('complete', function(file) {
			$(".dz-progress").hide('slow');
			this.removeFile(file);
		});

		function refreshGaleri() {
			var htmlGaleri = ''
			listGaleri.forEach(function(item, index) {
				htmlGaleri += `	
					<div style="max-width: 250px; position:relative">
						<a style="position: absolute; top: 8px; right: 0;" href='#' data-gambar='${item}' class='galeri-hapus btn btn-danger btn-sm rounded-circle'><i class='fas fa-times'></i></a>
						<img src="${item}" class="img-thumbnail">
					</div>
				`
			})
			$("#load-galeri").html(htmlGaleri)

			$('.galeri-hapus').click(function(e) {
				e.preventDefault();
				value = $(this).data('gambar')
				$.ajax({
					url: '<?=site_url('admin/mitra/galeri_handler/delete')?>',
					type: 'POST',
					dataType: 'json',
					data: {image: value}
				})
				.always(function() {
					listGaleri = listGaleri.filter(function(item) {
					    return item !== value
					})
					refreshGaleri();
				});
			});
		}

		






	    var listImagesOld = []

		ClassicEditor.create(document.querySelector('#artikel-mitra'), {
			toolbar: [
				"heading", 
				"bold", 
				"italic", 
				"link", 
				"blockQuote", 
				"code", 
				"|",
				"numberedList", 
				"bulletedList", 
				"|",
				"imageUpload", 
				"mediaEmbed", 
				"|",
				"insertTable", 
				"tableColumn", 
				"tableRow", 
				"mergeTableCells",
				"|",
				"undo", 
				"redo"
			],
			simpleUpload: {
				uploadUrl: '<?=site_url('admin/mitra/article_image_handler')?>',
				headers: {
					'x-handle-mode': 'upload'
				}
			},
			image: {
				toolbar: [
					'imageStyle:alignLeft',
					'imageStyle:alignCenter',
					'imageStyle:alignRight',
				],
				styles: [
					'alignLeft',
					'alignCenter',
					'alignRight',
				]
			}
		})
		.then(editor => {
			onEditorReady(editor)
		})
		.catch(error => {
		})


		function onEditorReady(editor) {

			// Event jika gambar dihapus saat berada di editor
			editor.model.document.on('change:data', e => {
				listImagesNew = getListImages(editor.getData());
				var listImageDeleted = listImagesOld.filter((image) => {
					return listImagesNew.indexOf(image) === -1
				})
				if (listImageDeleted != '') {
					imageList = new FormData()
					imageList.append('images', listImageDeleted.join('|'));
					$.ajax({
						url: '<?=site_url('admin/mitra/article_image_handler')?>',
						type: 'POST',
						dataType: 'json',
						data: imageList,
						beforeSend: (request) => {
							request.setRequestHeader('x-handle-mode', 'delete');
						},
						processData: false,
						contentType: false,
						cache: false
					})
					.done(function(data) {
						if (data.status == 'success') {
							// Berhasil menghapus gambar
						}
					})
				}
				listImagesOld = listImagesNew
				$("[name='list_gambar']").val(listImagesNew.join('|'));
			});
		}


		function getListImages(content) {
			imgArray = Array.from(new DOMParser().parseFromString(content, 'text/html').querySelectorAll('img'));
			imgArray = imgArray.map(image => image.getAttribute('src'))
			return imgArray;
		}

		$(".form-artikel").submit(function(e) {
			$("[name='list_gambar']").val(listImagesOld.join('|'));
		});

	});
</script>
<?php $this->endSection(); ?>