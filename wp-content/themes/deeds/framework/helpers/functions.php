<?php

function get_social_icons()
{
	$t = $GLOBALS['_sh_base'];
	$options = $t->alloption('wp_bistro');//printr($options);
	$icons = array('facebook'=>__('Like us on Facebook', 'wp_deeds'), 'twitter'=>__('Follow us on Twitter', 'wp_deeds'), 'google-plus'=>__('Circle Us on Google Plus', 'wp_deeds'), 'linkedin'=>__('Follow us on Linkedin', 'wp_deeds'), 'xing'=>__('Follow us on Xing', 'wp_deeds'), 'pinterest'=>__('Follow us on Pinterest', 'wp_deeds'));			
	if( $options ):?>
    <ul class="social">
    	<?php foreach( $icons as $i => $str ): ?>
        	<?php if( $url = sh_set( $options, $i ) ): ?>
        		<li><a href="<?php echo $url; ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $str; ?>"><i class="icon-<?php echo $i; ?>"></i></a></li>
        	<?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <?php endif;
	
}

function sh_get_product_thumbnail($id = null, $size = 'slider')
{
	global $post;
	$id = ( $id == null ) ? sh_set( $post, 'ID') : $id;
	if ( has_post_thumbnail( $id ) ) {
		$image = get_the_post_thumbnail( $id, $size );
		return $image;
	} else{
		$attached_images = (array)get_posts( array(
				'post_type' => 'attachment',
				'numberposts' => 1,
				'post_status' => null,
				'post_parent' => $id,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			) );
		$attached_image = sh_set($attached_images, 0);
		$image = wp_get_attachment_image( sh_set($attached_image, 'ID'), $size );
		return ( $image ) ? $image : false;
	}
}
