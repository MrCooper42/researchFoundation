(function ($) {
    "use strict";
    

    function ajaxCall(data){
	$.ajax({
	    type: "post",
	    url: ajaxurl,
	    data: data,
	    beforeSend: function () {
		if ($('body').find('div.preloader-wrapper') > 0) {
		} else {
		    $('body').prepend('<div class="preloader-wrapper"><div class="preloader"><i>.</i><i>.</i><i>.</i></div></div>');
		}
	    }
	}).done(function (response) {
	    if ('undefined' !== typeof response.status && 'newAJAX' === response.status) {
		ajaxCall(data);
	    } else if ('undefined' !== typeof response.message) {
                    jQuery('.importer_result .result').html('').hide();
                    var height = jQuery('html').height();
                    jQuery('.overlay').css({
                        'background': 'rgba(0,0,0,0.65)',
                        'position': 'fixed',
                        'top': '0',
                        'left': '0',
                        'width': '100%',
                        'height': '100%',
                        'z-index': '9999999'
                    });
                    jQuery('.overlay').fadeIn(500, 'swing');
                    jQuery('.importer_result').fadeIn(500, 'swing');
                    jQuery('.importer_result .result').append(response.message);
                    jQuery('.importer_result .result').fadeIn(500, 'swing');
                    $('.wobblebar').remove();
                    var done = jQuery('<span class="theme-install-done">' + response.message + '</span>').insertAfter('.left_side');
                    setTimeout(function () {
                        jQuery(done).fadeOut(500, 'swing');
                    }, 5000);
		
	    } else {
                jQuery('.importer_result .result').html('').hide();
                    var height = jQuery('html').height();
                    jQuery('.overlay').css({
                        'background': 'rgba(0,0,0,0.65)',
                        'position': 'fixed',
                        'top': '0',
                        'left': '0',
                        'width': '100%',
                        'height': '100%',
                        'z-index': '9999999'
                    });
                    jQuery('.overlay').fadeIn(500, 'swing');
                    jQuery('.importer_result').fadeIn(500, 'swing');
                    jQuery('.importer_result .result').append(response);
                    jQuery('.importer_result .result').fadeIn(500, 'swing');
                    $('.wobblebar').remove();
                    var done = jQuery('<span class="theme-install-done">' + response + '</span>').insertAfter('.left_side');
                    setTimeout(function () {
                        jQuery(done).fadeOut(500, 'swing');
                    }, 5000);
		
	    }
	}).fail(function (error) {
            jQuery('.importer_result .result').html('').hide();
                    var height = jQuery('html').height();
                    jQuery('.overlay').css({
                        'background': 'rgba(0,0,0,0.65)',
                        'position': 'fixed',
                        'top': '0',
                        'left': '0',
                        'width': '100%',
                        'height': '100%',
                        'z-index': '9999999'
                    });
                    jQuery('.overlay').fadeIn(500, 'swing');
                    jQuery('.importer_result').fadeIn(500, 'swing');
                    jQuery('.importer_result .result').append(error.statusText);
                    jQuery('.importer_result .result').fadeIn(500, 'swing');
                   $('.wobblebar').remove();
                    var done = jQuery('<span class="theme-install-done">' + error.statusText+ '</span>').insertAfter('.left_side');
                    setTimeout(function () {
                        jQuery(done).fadeOut(500, 'swing');
                    }, 5000);
	   
	});
    }


   
    $('#install_button').on('click', function () {
        jQuery('#install_button').addClass('is_disabled');
        var loading = $('<span class="wobblebar">Loading&#8230;</span>').insertAfter('#install_button');
        var demo = jQuery("#demos").val();
        var data = 'action=theme-install-demo-data&demo='+demo;
        ajaxCall(data);
    });
    $('div.importer-box .importer_heading .close').live('click', function () {
        $(this).parents('div.importer-box').remove();
        $('.overlay').remove();
    });

})(jQuery);