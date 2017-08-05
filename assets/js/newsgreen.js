(function(jQuery) {
    'use strict';
    jQuery(document).ready(function($) {

   
    /*-----------------------------------------------------------------
     * Variables
     *-----------------------------------------------------------------*/

    var $body_html = $('body, html'),
        $html = $('html'),
        $body = $('body'),

        $navigation = $('#navigation'),
        navigation_height = $navigation.height() - 20,

        $scroll_to_top = $('#scroll-to-top');

    if (navigation_height <= 0) navigation_height = 60;

    /*-----------------------------------------------------------------
     * Is mobile
     *-----------------------------------------------------------------*/

    var ua_test = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i,
        is_mobile = ua_test.test(navigator.userAgent);

    $html.addClass(is_mobile ? 'mobile' : 'no-mobile');

    
	if( $('.navbar-toggle').length ){
		$('.navbar-toggle').on('click', function(){
			$(this).find('i').toggleClass('fa-bars').toggleClass('fa-close');
		});
	}

	/* ============== DROP ANIMATION ============== */
	if( $('.drop-toggle').length ){
	$('.drop-toggle').on('click', function(e){
		e.preventDefault();
		$(this).siblings('.dropdown-menu').slideToggle();
		$(this).find('i').toggleClass('fa-angle-down fa-angle-up');
	});
	}
    /*-----------------------------------------------------------------
     * Affixed Navbar
     *-----------------------------------------------------------------*/
	   if( $('.affix').length ){
	   $('.affix').affix({
			offset: {
				top: 180
			}
		});
	   }
   

    /*-----------------------------------------------------------------
     * Scroll To Top
     *-----------------------------------------------------------------*/

    $(window).scroll(function () {

        var $scroll_top = $(this).scrollTop();

        if ($scroll_top > navigation_height) {
            $scroll_to_top.addClass('in');
        } else {
            $scroll_to_top.removeClass('in');
        }
    });

    $scroll_to_top.click(function() {
	
        $.scrollWindow(0);
    });

    $.scrollWindow = function(offset) {
        $body_html.animate({
            scrollTop: offset
        }, 500);
    };


    /*-----------------------------------------------------------------
     * Magnific
     *-----------------------------------------------------------------*/
	if( $('.image-popup').length ){
		$('.image-popup').magnificPopup({
			closeBtnInside : true,
			type           : 'image',
			mainClass      : 'mfp-with-zoom'
		});
	}
	if( $('.iframe-popup').length ){
		$('.iframe-popup').magnificPopup({
			type      : 'iframe',
			mainClass : 'mfp-with-zoom'
		});
	}
  
	if( jQuery(".postGallery").length){
			 // Home Page Slider
			jQuery(".postGallery").owlCarousel({
				singleItem            : true,
				responsive            : true,
				autoHeight            : false,
				mouseDrag             : false,
				touchDrag             : false,
				responsiveRefreshRate : 0,
				transitionStyle       : 'fadeUp',
				pagination        : false,
				navigation        : true,
				navigationText    : [
						'<i class="fa fa-angle-left"></i>',
						'<i class="fa fa-angle-right"></i>'
					]
	
			});
		}


 });
})(jQuery);