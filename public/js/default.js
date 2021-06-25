
// ---------------------------------------------------
// Menonaktifkan Perfect Scrollbar 
// (karena scrolling menjadi tidak smooth)
// ---------------------------------------------------

// ---------------------------------------------------
// Mengaktifkan Tooltip
// ---------------------------------------------------
$(function () {
  $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'})
  $('[data-toggle="popover"]').popover({trigger: 'hover', placement: 'top'})
});

// ---------------------------------------------------
// Membuat Bootstrap Notify
// ---------------------------------------------------
function buat_notifikasi(notifikasi) {
	$.notify({
		icon: notifikasi.icon,
		message: notifikasi.message
	},
	{	
		icon_type: 'class',
		type: notifikasi.type,
		timer: 1500,
		showProgressbar: false,
		placement: {
			from: 'top',
			align: 'right'
		},
		template: `<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0} align-items-center" role="alert" style='padding-bottom: 8px;'>
		<div class='d-flex'>
	<span data-notify="icon" style='font-size: 24pt' class='mr-4'></span>
	<span data-notify="title">{1}</span>
	<span data-notify="message">{2}</span>
	<button type="button" aria-hidden="true" class="close" data-notify="dismiss"><i class='fas fa-times'></i></button>
	</div>
	<div class="progress mt-1" data-notify="progressbar" style='height: 4px'>
		<div class="progress-bar progress-bar-striped progress-bar-animated bg-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
	</div>
	<a href="{3}" target="{4}" data-notify="url"></a>
</div>`
	});
	
}
