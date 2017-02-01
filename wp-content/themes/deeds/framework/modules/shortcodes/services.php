<?php $theme_options = get_option('wp_deeds'.'_theme_options');
$services = sh_set(sh_set($theme_options, 'dynamic_services') , 'dynamic_services');


ob_start();
if( $sh_services == 'modren' ){
	if( $services ) :
		if( array_key_exists( $number, $services ) ):
			foreach( $services as $key => $service ):
				if( $key == $number ):
				$icon = str_replace('icon', 'fa' , sh_set($service , 'service_icon'));
				?>
						<div id='service-block' class="service-block">
							<div class="service-image">
								<img src="<?php echo sh_set($service , 'service_bg'); ?>" alt="" />
								<?php if( sh_set( $service, 'srvices_social_icon' ) != '' ) :?><i class="<?php echo sh_set( $service, 'srvices_social_icon' ); ?>"></i><?php endif;?>
							</div>
								<h3><?php echo sh_set($service , 'service_title'); ?></h3>
								<p><?php echo sh_set($service , 'service_tag_line'); ?></p>
								<a title="" href="<?php echo sh_set($service , 'service_link'); ?>"><?php echo sh_set($service , 'btn_text'); ?></a>
							</div>
				<?php 
				endif;
			endforeach;
		endif;
	endif;

}else if( $sh_services == 'sconic_services' ){
	if( $services ) :
	$counter = 0;
			foreach( $services as $key => $service ): 
			if( sh_set( $service , 'tocopy' ) || $counter == $number ) break;
				?>
                	<div class="col-md-<?php echo $columns?> column">
                        <div class="iconic-service">
                            <span><i class="<?php echo sh_set( $service, 'srvices_social_icon' ); ?>"></i></span>
                            <h3><?php echo sh_set($service , 'service_title'); ?></h3>
                            <p><?php echo sh_set($service , 'service_tag_line'); ?></p>
                        </div><!-- ICONIC SERVICE -->	
                    </div>
				<?php
			$counter++; 
			endforeach;
	endif;

}elseif( $sh_services == 'without_image' )
{
	if( $services ) :
	if( array_key_exists( $number, $services ) ):
		foreach( $services as $key => $service ):
			if( $key == $number ):
			$icon = str_replace('icon', 'fa' , sh_set($service , 'service_icon'));
			?>
					<div class="simple-service">
						<div class="simple-icon">
							<span><?php if( sh_set( $service, 'srvices_social_icon' ) != '' ) :?><i class="<?php echo sh_set( $service, 'srvices_social_icon' ); ?>"></i><?php endif;?></span>
						</div>
							<h3><?php echo sh_set($service , 'service_title'); ?></h3>
							<p><?php echo sh_set($service , 'service_tag_line'); ?></p>
							<a title="" href="<?php echo sh_set($service , 'service_link'); ?>"><?php echo sh_set($service , 'btn_text'); ?></a>
						</div>
			<?php 
			endif;
		endforeach;
	endif;
endif;
}
$output = ob_get_contents();
ob_end_clean();
?>