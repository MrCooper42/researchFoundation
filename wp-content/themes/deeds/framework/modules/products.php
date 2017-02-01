<?php ob_start(); ?>
	 <?php $shop_page = get_option( 'woocommerce_shop_page_id' ); ?>
    <div class="our-books">
        <div class="row">
            <div class="products-carousel">
            	<?php while( $prods->have_posts() ): $prods->the_post(); ?>
                	<?php global $product, $woocommerce_loop, $post; ?>
                	<?php $product_meta = get_post_meta(get_the_ID() , 'sh_product_meta' , true); //printr($product_meta);?>
                	
                    <div class="product">
                         <?php echo ( has_post_thumbnail() ? get_the_post_thumbnail( $post->ID, '370x230' ) : woocommerce_placeholder_img( '370x230' ) ); ?>
                        <?php echo (sh_set($product_meta, 'product_sub_title')) ? '<i>'.sh_set($product_meta, 'product_sub_title').'</i>' : '';?>
                        <h3><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
                        <div class="product-bottom">
                            <?php if ( $price_html = $product->get_price_html() ) : ?>
                                <?php echo $price_html;?>
                            <?php endif;?>
                           	<?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>
                    </div><!-- BOOK -->
                <?php endwhile;?>
              
            </div><!-- BOOK CAROUSEL -->
        </div>
    </div>
    <script type="text/javascript">
	jQuery(document).ready(function($) {
   	var col = $('div.products-carousel').parent('div').parent('div').parent('div').attr('class');
	
	if( col == 'col-md-12 column ' || col == 'col-md-11 column ' ){
		
		$(".products-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** BOOKS CAROUSEL ***/
	}
	else if( col == 'col-md-10 column ' || col == 'col-md-9 column ' || col == 'col-md-8 column ' ){
		
		$(".products-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 3,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** BOOKS CAROUSEL ***/
	}
	else if( col == 'col-md-6 column ' || col == 'col-md-4 column ' ){
		
		$(".products-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 2,
			itemsDesktop : [1199,2],
			itemsDesktopSmall : [979,2],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** BOOKS CAROUSEL ***/
	}
	else if( col == 'col-md-3 column ' || col == 'col-md-2 column ' || col == 'col-md-1 column ' ){
		
		$(".products-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 1,
			itemsDesktop : [1199,1],
			itemsDesktopSmall : [979,1],
			itemsTablet : [768,1],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** BOOKS CAROUSEL ***/
	}
		
	});	
	</script>
<?php

$output = ob_get_contents();
ob_end_clean();