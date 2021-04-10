jQuery(document).ready(function($) {
	$('.img-wrapper').css('display', 'none');
	function readURL(input) {
	    if (input.files && input.files[0]){
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('.gambar-fill').attr('src', e.target.result);
				$('.img-wrapper').css('display', 'block');
				gambarElement = $('.gambar-fill');
				hitungAspectRatio(gambarElement);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(".element-gambar").change(function(){
	    readURL(this);
	});

	$('.img-wrapper-b').css('display', 'none');
	function readURL_B(input) {
	    if (input.files && input.files[0]){
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('.gambar_b-fill').attr('src', e.target.result);
				$('.img-wrapper-B').css('display', 'block');
				gambarElement = $('.gambar_b-fill');
				hitungAspectRatio(gambarElement);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(".element-gambar-b").change(function(){
	    readURL_B(this);
	});
});
$(".foto-profil").each(function() {
    hitungAspectRatio($(this))
})
function hitungAspectRatio($this) {
        // Calculate aspect ratio and store it in HTML data- attribute
        width = parseInt($this[0].scrollWidth);
		if (width <= 0) {
	        width = parseInt($this.scrollWidth);
		}
        height = parseInt($this[0].scrollHeight);
		if (width <= 0) {
	        height = parseInt($this.scrollHeight);
		}
        var aspectRatio = width/height;
        $this.attr("aspect-ratio", aspectRatio);

        // Conditional statement
        if(aspectRatio > 1) {
            // Image is landscape
            $this.css({
                width: "auto",
                height: "100%",
                top: 0,
            });
        } 
        else if (aspectRatio < 1) {
            // Image is portrait
            $this.css({
                width: "100%",
                height: "auto",
                left: 0,
                top: 0            
            });
        } 
        else {
            // Image is square
            $this.css({
                width: "100%",
                height: "auto",
                left: 0,
                top: 0            
            });            
        }


    }