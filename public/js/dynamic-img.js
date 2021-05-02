jQuery(document).ready(function($) {
	$('.img-wrapper').css('display', 'none')
	function readURL(input, additionalClass) {
	    if (input.files && input.files[0]){
	        var reader = new FileReader()
	        reader.onload = function (e) {
	            $('.gambar-fill').attr('src', e.target.result)
				$('.img-wrapper').css('display', 'block')

				if (typeof additionalClass !== 'undefined') {
					$(additionalClass).attr('src', e.target.result)
				}

				$(".foto-profil").one("load", function() {
				    hitungAspectRatio($(this))
				})
	        }
	        reader.readAsDataURL(input.files[0])
	    }
	}
	$(".element-gambar").change(function(){
		if ($(this).hasClass('element-foto-profil')) {
			readURL(this, '.foto-profil')
		}
		else {
		    readURL(this)
		}
	})

	$('.img-wrapper-b').css('display', 'none')
	function readURL_B(input) {
	    if (input.files && input.files[0]){
	        var reader = new FileReader()
	        reader.onload = function (e) {
	            $('.gambar_b-fill').attr('src', e.target.result)
				$('.img-wrapper-B').css('display', 'block')
				gambarElement = $('.gambar_b-fill')
				hitungAspectRatio(gambarElement)
				$(".foto-profil").each(function() {
				    hitungAspectRatio($(this))
				})
	        }
	        reader.readAsDataURL(input.files[0])
	    }
	}
	$(".element-gambar-b").change(function(){
	    readURL_B(this)
	})
})
$(".foto-profil").one("load", function() {
    hitungAspectRatio($(this))
}).each(function() {
    hitungAspectRatio($(this))
})
function hitungAspectRatio($this, callbackLandscape, callbackPotrait, callbackSquare) {
        // Calculate aspect ratio and store it in HTML data- attribute
        width = Math.floor(parseInt($this[0].scrollWidth))
		if (width <= 0) {
	        width = parseInt($this.scrollWidth)
		}
        height = Math.floor(parseInt($this[0].scrollHeight))
		if (width <= 0) {
	        height = parseInt($this.scrollHeight)
		}
        var aspectRatio = width/height
        $this.attr("aspect-ratio", aspectRatio)

        // Conditional statement
        if(aspectRatio > 1) {
            // Image is landscape
            $this.css({
                width: "auto",
                height: "100%",
                top: 0,
                position: 'relative'
            })

	        width = Math.floor(parseInt($this[0].scrollWidth))
            widthParent = $this.parent().width()
            offsetArea = width - widthParent
            offset = -(offsetArea / 2)

            $this.css('left', offset);

            $this.attr('offsetarea', offsetArea)
            $this.attr('parentwidth', widthParent)
            $this.attr('imagewidth', width)
        } 
        else if (aspectRatio < 1) {
            // Image is portrait
            $this.css({
                width: "100%",
                height: "auto",
                left: 0,
                position: 'relative'        
            })

	        height = Math.floor(parseInt($this[0].scrollHeight))
            heightParent = $this.parent().height()
            offsetArea = height - heightParent
            offset = -(offsetArea / 2)

            $this.css('top', offset);

            $this.attr('offsetarea', offsetArea)
            $this.attr('parentheight', heightParent)
            $this.attr('imageheight', height)
        } 
        else {
            // Image is square
            $this.css({
                width: "100%",
                height: "auto",
                left: 0,
                top: 0            
            })            
        }


    }