<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<div class="container-fluid mt-4">
	<form action="<?=site_url('admin/mitra/save')?>" method="post">
		<?=csrf_field()?>
		<div class="row">
			<div class="col-lg-8">
				<div class="card no-transform">
					<div class="card-header p-3" style="line-height: 8px">
						<h3 class="card-title mb-0 pb-0">Buat halaman statis</h3>
						<span class="text-muted text-uppercase font-weight-bold" style="font-size: 8pt;">Anda bisa menuliskan halaman statis seperti: Visi Misi, Tentang, Kontak, dsb.</span>
					</div>
					<div class="card-body">
						<div class="form-grup lpnu-form mb-2">
							<input type="text" name="judul" class="form-control" placeholder="Tuliskan judul disini...">
							<div class="invalid-feedback invalid-feedback-judul font-italic" style="display: none"></div>
						</div>
						<div class="form-group lpnu-form">
							<input type="hidden" name="daftar_gambar">
							<textarea name="artikel" id="artikel" rows="8"></textarea>
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
									<img src="<?=site_url('images/profile/' . $userdata['avatar'])?>" class="foto-profil" style="width: 100%">
								</div>
								<div class="text-white ml-3" style="line-height: 18px; max-width: 150px">
									<span class="text-warning font-weight-bold" style="font-size: 15pt">Penulis</span><br/>
									<span class="text-white font-weight-bold" style="font-size: 10pt"><?=$userdata['nama_lengkap']?></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col">
								<label class="form-control-label text-white">Deskripsi Penelusuran</label>
								<textarea class="form-control" name="deskripsi_penelusuran" rows="3"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<button type="submit" class="btn btn-block bg-lpnu border-0 text-white btn-simpan">
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

		var inserted = false;
		var inserted_id = false;


	    var listImagesOld = []

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
				uploadUrl: '<?=site_url('admin/postingan/halaman/article_image_handler')?>',
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
						url: '<?=site_url('admin/postingan/halaman/article_image_handler')?>',
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

		function save(callback, callbackSuccess) {
			$(".progress").css('visibility', 'visible');
			kategori = $("[name='kategori[]']").val();
			halamanParams = {
				judul: $("[name='judul']").val(),
				daftar_gambar: $("[name='daftar_gambar']").val(),
				artikel: editor.getData(),
				deskripsi_penelusuran: $("[name='deskripsi_penelusuran']").val(),
			}
			if (inserted) {
				halamanParams.id = inserted_id;
			}
			$.ajax({
				url: '<?=site_url('admin/postingan/halaman/save_draf')?>',
				type: 'POST',
				dataType: 'json',
				data: halamanParams,
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
			e.preventDefault();
			$(".btn-simpan").attr('disabled', 'disabled')
			let initialText = $(".btn-simpan").html()
			$(".btn-simpan").html('Menyimpan...')
			save(function() {
				$(".btn-simpan").removeAttr('disabled')
				$(".btn-simpan").html(initialText)
			}, function() {
				$(".btn-simpan").html("Berhasil disimpan.!")
				window.location = '<?=site_url('admin/postingan/halaman')?>';
				setTimeout(function() {
					$(".btn-simpan").removeAttr('disabled')
					$(".btn-simpan").html(initialText)
				}, 1000);
			});
		});
		setInterval(function() {
			$(".btn-simpan").attr('disabled', 'disabled')
			let initialText = $(".btn-simpan").html()
			$(".btn-simpan").html('Menyimpan...')
			save(function() {
				$(".btn-simpan").removeAttr('disabled')
				$(".btn-simpan").html(initialText)
			}, function() {
				$(".btn-simpan").html("Berhasil disimpan.!")
				setTimeout(function() {
					$(".btn-simpan").removeAttr('disabled')
					$(".btn-simpan").html(initialText)
				}, 1000);
			});
		}, 120000)

	});
	
</script>
<?php $this->endSection(); ?>