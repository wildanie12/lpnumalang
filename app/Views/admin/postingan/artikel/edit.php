<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid mt-4">
	<form action="<?=site_url('admin/mitra/save')?>" method="post">
		<?=csrf_field()?>
		<div class="row">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-header p-3" style="line-height: 8px">
						<h3 class="card-title mb-0 pb-0">Tulis artikel untuk halaman depan</h3>
						<span class="text-muted text-uppercase font-weight-bold" style="font-size: 8pt;">Anda bisa menuliskan apapun seperti: berita, pengumuman, artikel, dsb.</span>
					</div>
					<div class="card-body">
						<div class="form-grup lpnu-form mb-2">
							<input type="text" name="judul" class="form-control" placeholder="Tuliskan judul disini..." value="<?=$artikel['judul']?>">
							<div class="invalid-feedback invalid-feedback-judul font-italic" style="display: none"></div>
						</div>
						<div class="form-group lpnu-form">
							<input type="hidden" name="daftar_gambar" value="<?=$artikel['daftar_gambar']?>">
							<textarea name="artikel" id="artikel" rows="8"><?=file_get_contents('./files/postingan/artikel/' . $artikel['file_artikel'])?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card bg-warning text-white sticky-top" style="z-index: 0 !important;">
					<div class="card-body pb-0 pt-3">
						<div class="row justify-content-center">
							<div class="form-group bg-dark mb-4 py-2 px-3 col-auto rounded d-flex flex-row justify-content-center align-items-center">
								<div class="rounded-circle border-warning border" style="width: 80px; height: 80px; overflow: hidden">
									<img src="<?=site_url('images/profile/' . $penulis['avatar'])?>" class="foto-profil" style="width: 100%">
								</div>
								<div class="text-white ml-3" style="line-height: 18px; max-width: 150px">
									<span class="text-warning font-weight-bold" style="font-size: 15pt">Penulis</span><br/>
									<span class="text-white font-weight-bold" style="font-size: 10pt"><?=$penulis['nama_lengkap']?></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col">
								<label class="form-control-label text-white d-flex justify-content-between">
									Kategori
									<a href="javascript:void(0)" class="btn-tambah-kategori btn-secondary btn-primary btn-sm" style='font-size:8pt'>[Tambah Kategori]</a>
								</label>
								<select id="tags-kategori" class="form-control" name="kategori[]" multiple="multiple">
								</select>
								<span class="text-muted text-xs text-white">Anda bisa tambah kategori jika tidak ada</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col">
								<label class="form-control-label text-white">Deskripsi Penelusuran</label>
								<textarea class="form-control" name="deskripsi_penelusuran" rows="3"><?=$artikel['deskripsi_penelusuran']?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<button type="submit" class="btn btn-block btn-secondary btn-simpan">
									<i class="fas fa-file-alt mr-1"></i> 
									Simpan Sebagai draf
								</button>
								<button type="submit" class="btn btn-block bg-lpnu border-0 text-white btn-publikasikan">
									<i class="fas fa-paper-plane mr-1"></i> 
									Publikasikan
								</button>
							</div>
						</div>
						<div class="row">
							<div class="col">
							</div>
						</div>
						<div class="progress mb-0 mt-3" style="margin: -1.5rem; visibility: hidden;">
							<div class="progress-bar progress-bar-striped-light progress-bar-animated-fast bg-secondary" style="width: 100%"></div>
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

		var inserted = true;
		var inserted_id = '<?=$artikel['id']?>'

		var kategori = tail.select('#tags-kategori', {
			animate: true,
			hideSelected: true,	
			multiShowCount: false,
			multiContainer: true,
			search: true,
			cbLoopItem: (item, group, search) => {
				var newItem = document.createElement('li');
				newItem.innerHTML = "<a href='#' class='delete-item btn btn-sm btn-danger rounded-circle' data-toggle='tooltip' title='Hapus kategori' data-value='" +item.description+ "'><i class='fas fa-times'></i></a> " + item.value;
				return newItem;
			},
			cbComplete: () => {
				$('.delete-item').unbind().click(function(e) {
					e.preventDefault();
					if (confirm('Anda Yakin')) {
						value = $(this).data('value');
						$.ajax({
							url: '<?=site_url('admin/postingan/artikel/dynamic_form_kategori_write/delete')?>',
							type: 'POST',
							dataType: 'json',
							data: {
								id: value
							}
						})
						.done(function(data) {
							refreshKategori(true);
						})
					}
				});
			}
		})
		$(".btn-tambah-kategori").popover({
	        html: true,
	        trigger: 'click',
	        placement: 'bottom',
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
	        $('#tambah-kategori').unbind().keypress(function(e) {
	        	value = $(this).val();
	        	if (e.which == 13) {
	        		tambahKategori(value)
		            $this.popover('hide')
	        	}
	        })

	        $('.btn-tambah-kategori-submit').unbind().click(function(e) {
	        	value = $('#tambah-kategori').val()
	    		tambahKategori(value)
	            $this.popover('hide')
	        });
	    })

	    function refreshKategori(open, callback) {
			$.ajax({
				url: '<?=site_url('admin/postingan/artikel/dynamic_form_kategori')?>',
				type: 'GET',
				dataType: 'html',
			})
			.done(function(data) {
				$("#tags-kategori").html(data);
				kategori.reload();
				if (typeof open !== 'undefined') {
					kategori.open();
				}
				if (typeof callback !== 'undefined') {
					callback()
				}
			});
		}
		function tambahKategori(kategori) {
			$.ajax({
				url: '<?=site_url('admin/postingan/artikel/dynamic_form_kategori_write/insert')?>',
				type: 'POST',
				dataType: 'json',
				data: {kategori: kategori},
			})
			.done(function(data) {
				if (typeof data.error !== "undefined") {
					alert(data.error)
				} 					
				else {
					refreshKategori(true)
				}
			})
		}
		refreshKategori(false, function() {
			<?php 
				if ($artikel['kategori_id'] != '') {
					$data_kategori = explode('|', $artikel['kategori_id']);
					foreach ($data_kategori as $kategori) {
			?>
			$("#tags-kategori [value='<?=$kategori?>']").attr('selected', 'selected');
			<?php 
					}
				}
			?>
			kategori.reload();
		});




	    var listImagesOld = []
	    <?php 
	    	if ($artikel['daftar_gambar'] != '') {
	    		$gambar_array = explode('|', $artikel['daftar_gambar']);
	    		foreach ($gambar_array as $gambar) {
	    ?>
	    listImagesOld.push('<?=$gambar?>')
	    <?php 
	    		}
	    	}
	    ?>

	    let editor;
		ClassicEditor.create(document.querySelector('#artikel'), {
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
				uploadUrl: '<?=site_url('admin/postingan/artikel/article_image_handler')?>',
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
		.then(newEditor => {
			editor = newEditor
			onEditorReady(newEditor)
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
						url: '<?=site_url('admin/postingan/artikel/article_image_handler')?>',
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
				$("[name='daftar_gambar']").val(listImagesNew.join('|'));
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
		function save(status, callback, callbackSuccess) {
			$(".progress").css('visibility', 'visible');
			kategori = $("[name='kategori[]']").val();
			artikelParams = {
				judul: $("[name='judul']").val(),
				daftar_gambar: $("[name='daftar_gambar']").val(),
				kategori_id: kategori.join('|'),
				artikel: editor.getData(),
				deskripsi_penelusuran: $("[name='deskripsi_penelusuran']").val(),
				status: status,
			}
			artikelParams.id = inserted_id;
			saveAjax(artikelParams, callback, callbackSuccess)
		}
		function saveAjax(artikelParams, callback, callbackSuccess) {
			$.ajax({
				url: '<?=site_url('admin/postingan/artikel/save_draf')?>',
				type: 'POST',
				dataType: 'json',
				data: artikelParams,
			})
			.done(function(data) {
				if (data.status == 'success') {
					inserted = true;
					inserted_id = data.id
					$("[name='judul']").removeClass('is-invalid');
					$(".invalid-feedback-judul").hide();

					if (typeof callbackSuccess !== 'undefined') {
						callbackSuccess();
					}
				}
				else {
					$([document.body, document.documentElement]).animate({
							scrollTop: $("[name='judul']").offset().top - 100
					}, 500)
					setTimeout(function() {
						$("[name='judul']").addClass('is-invalid');
						$("[name='judul']").focus();
						$(".invalid-feedback-judul").html(data.errors.judul);
						$(".invalid-feedback-judul").show();
					}, 600)
				}
				if (typeof callback !== 'undefined') {
					callback();
				}
			})
			.always(function() {
				$(".progress").css('visibility', 'hidden')
			})
		}

		$(".btn-simpan").click(function(e) {
			e.preventDefault()
			setKeDraft = true
			$(this).attr('disabled', 'disabled')
			let initialText = $(this).html()
			$(this).html('Menyimpan...')

			save('draf', function() {
				$(".btn-simpan").removeAttr('disabled')
				$(".btn-simpan").html(initialText)
			}, function() {
				$(".btn-simpan").html("Berhasil disimpan.!")
				setTimeout(function() {
					$(".btn-simpan").removeAttr('disabled')
					$(".btn-simpan").html(initialText)
				}, 1000);
			});
		});


		let previousStatus = '<?=$artikel['status']?>'
		let setKeDraft = false;
		setInterval(function() {
			if (setKeDraft) {
				$(".btn-simpan").click()
			}
			else {
				if (previousStatus == 'dipublikasikan') {
					$('.btn-simpan').attr('disabled', 'disabled')
					let initialText = $('.btn-simpan').html()
					$('.btn-simpan').html('Menyimpan...')

					save('dipublikasikan', function() {
						$(".btn-simpan").removeAttr('disabled')
						$(".btn-simpan").html(initialText)
					}, function() {
						$(".btn-simpan").html("Berhasil disimpan.!")
						setTimeout(function() {
							$(".btn-simpan").removeAttr('disabled')
							$(".btn-simpan").html(initialText)
						}, 1000);
					});
				}
				else {
					$(".btn-simpan").click()
				}
			}
		}, 120000)

		$(".btn-publikasikan").click(function(e) {
			e.preventDefault();
			save('dipublikasikan', function() {
				window.location = '<?=site_url('admin/postingan/artikel')?>';
			})
		});
	});
	
</script>
<?php $this->endSection(); ?>