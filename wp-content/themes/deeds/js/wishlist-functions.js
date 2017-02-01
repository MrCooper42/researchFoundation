(function($){
	"use strict";
	var onlineshop = {			
			count: 0,
			
			wishlist: function(options, selector)
			{
				options.action = 'dictate_ajax_callback';
				
				if( $(this).data('_sh_add_to_wishlist') === true ){
					onlineshop.msg( 'You have already added this product to wish list', 'error' );
					return;
				}
				
				var thiss = this;
				$(thiss).data('_sh_add_to_wishlist', true );
				
				onlineshop.loading(true);
				
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data:options,
					dataType:"json",
					success: function(res){

						try{
							var newjason = res;

							if( newjason.code === 'fail'){
								$(thiss).data('_sh_add_to_wishlist', false );
								onlineshop.loading(false);
								onlineshop.msg( newjason.msg, 'error' );
							}else if( newjason.code === 'exists'){
								$(thiss).data('_sh_add_to_wishlist', true );
								onlineshop.loading(false);
								onlineshop.msg( newjason.msg, 'error' );
							}else if( newjason.code === 'success' ){
								onlineshop.loading(false);
								$(thiss).data('_sh_add_to_wishlist', true );
								onlineshop.msg( newjason.msg, 'success' );
							}
							
							
						}
						catch(e){
							onlineshop.loading(false);
							$(thiss).data('_sh_add_to_wishlist', false );
							onlineshop.msg( 'There was an error while adding product to whishlist '+e.message, 'error' );
							
						}
					}
				});
			},
			loading: function( show ){
				if( $('.loading' ).length === 0 ) {
					$('body').append('<div class="loading" style="display:none;"></div>');
				}
				
				if( show === true ){
					$('.loading').show('slow');
				}
				if( show === false ){
					$('.loading').hide('slow');
				}
			},
			
			msg: function( msg, type ){
				if( $('#pop' ).length === 0 ) {
					$('body').append('<div style="display: none;" id="pop"><div class="pop"><div class="alert"><p></p></div></div></div>');
				}
				var alert_type = 'alert-' + type;
				
				$('#pop > .pop p').html( msg );
				$('#pop > .pop > .alert').addClass(alert_type);
				
				$('#pop').slideDown('slow').delay(5000).fadeOut('slow', function(){
					$('#pop .pop .alert').removeClass(alert_type);
				});
				
				
			},
			
		};
	
	
	$(document).ready(function() {
        
		$('.add_to_wishlist, a[rel="product_del_wishlist"]').click(function(e) {
			e.preventDefault();
			
			if( $(this).attr('rel') === 'product_del_wishlist' ){
				if( confirm( 'Are you sure! you want to delete it' ) ){
					var opt = {subaction:'wishlist_del', data_id:$(this).attr('data-id')};
					onlineshop.wishlist( opt, this );
				}
			}else{
				var opt = {subaction:'wishlist', data_id:$(this).attr('data-id')};
				onlineshop.wishlist( opt, this );
			}
			
		});/**wishlist end*/
		
    });/** document.ready end */
		
})(jQuery);



