<?php
$options = get_option( 'wp_deeds_theme_options' );

$boxed = (sh_set( $options, 'boxed_layout' )) ? 'boxed' : '';
$pat = (sh_set( $options, 'boxed_layout' )) ? sh_set( $options, 'bg_pattorns' ) : '';
$background = (sh_set( $options, 'boxed_layout' )) ? sh_set( $options, 'site_background' ) : '';
$header = sh_set( $options, 'custom_header' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
		<?php echo ( sh_set( $options, 'site_favicon' ) ) ? '<link rel="icon" type="image/png" href="' . sh_set( $options, 'site_favicon' ) . '">' : ''; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php (is_home() || is_front_page()) ? bloginfo( 'name' ) : bloginfo( 'name' ); wp_title("|", true, 'left'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />

		<?php wp_head(); ?>
    <div id="admn_url" style="display:none"><?php echo get_template_directory_uri(); ?></div>
</head>
<body <?php
body_class();
if ( $background != '' ) {
	echo 'style="background-image: url(' . $background . '); no-repeat scroll 0 0 / cover transparent; background-attachment: fixed;"';
} else {
	if ( $pat != '' ) {
		echo 'style="background-image: url( ' . SH_URL . "images/" . $pat . ".png" . ')"';
	}
}
echo '>';
donation_box();
?>
	<div class="loader-wrapper" style="display: none">
		<div class="loader spunner"></div>
	</div>
	<div class="model-response" style="display: none"></div>
    <div class="theme-layout <?php echo $boxed; ?>">
		<?php
		if ( sh_set( $options, 'custom_header' ) ): $header = sh_set( $options, 'custom_header' );
		else: $header = 'header2';
		endif;
		?>
		<?php
		if ( sh_set( $options, 'show_header_sticky' ) ): $sticky = 'stick';
		else: $sticky = '';
		endif;
		?>
		<?php
		if ( is_page( 1064 ) ): $header = NULL;
			$header = 'header9';
		endif;
		?>
        <header class="<?php echo $header . ' ' . $sticky ?>">
            <div class="topbar">
                <div class="container">

					<?php if ( sh_set( $options, 'show_header_event' ) == 1 && sh_set( $options, 'header_event' ) != '' ): ?>
						<?php
						$id = sh_set( $options, 'header_event' );
						$event_meta = sh_set( sh_set( get_post_meta( $id, 'sh_event_meta', true ), 'sh_event_options' ), 0 );
						$time = strtotime( sh_set( $event_meta, 'start_time' ) );
						$new_time = date( 'g:i a', $time );

						$date = strtotime( sh_set( $event_meta, 'start_date' ) );

						$c_t = date( 'H:i:s', $time );
						$c_d = date( 'm/d/Y', $date );
						?>
						<div class="header-timer">
							<a href="<?php echo get_permalink( $id ); ?>" title=""><?php echo sh_set( $options, 'header_event_title' ); ?></a>
							<ul class="headercounter_new">
								<li> <span class="days">00</span>
									<p class="days_ref"><?php _e( 'days', 'wp_deeds' ); ?></p>
								</li>
								<li> <span class="hours">00</span>
									<p class="hours_ref"><?php _e( 'hours', 'wp_deeds' ); ?></p>
								</li>
								<li> <span class="minutes">00</span>
									<p class="minutes_ref"><?php _e( 'minutes', 'wp_deeds' ); ?></p>
								</li>
								<li> <span class="seconds">00</span>
									<p class="seconds_ref"><?php _e( 'seconds', 'wp_deeds' ); ?></p>
								</li>
							</ul>
						</div>
						<?php
						$get_timezone = ( sh_set( $options, 'time_zone' ) != '') ? explode( ' ', sh_set( $options, 'time_zone' ), 2 ) : '';
						$timezone = (!empty( $get_timezone )) ? sh_set( $get_timezone, '0' ) : '0';
						echo '<script type="text/javascript">
							jQuery(document).ready(function($){
								header_event("ul.headercounter_new","' . $c_d . ' ' . $c_t . '", ' . $timezone . ');
						});
						</script>';
					endif;
					?>
					<?php if ( sh_set( $options, 'show_header_contact' ) == 1 && sh_set( $options, 'header_contact' ) != '' ): ?><p><i class="fa fa-mobile"></i> <?php echo sh_set( $options, 'header_contact' ) ?></p><?php endif; ?><!--- CONTACT -->
					<?php if ( sh_set( $options, 'show_header_email' ) == 1 && sh_set( $options, 'header_email' ) != '' ): ?><p><i class="fa fa-envelope"></i> <?php echo sh_set( $options, 'header_email' ) ?></p><?php endif; ?><!--- EMAIL -->

					<?php if ( sh_set( $options, 'header_social' ) == 1 ) : ?>
						<ul class="social-media">

							<?php
							$social_media = sh_set( sh_set( $options, 'social_media' ), 'social_media' );
							array_pop($social_media);
							if ( is_array( $social_media ) ):
								foreach ( (array) $social_media as $social ):
									if ( sh_set( $social, 'tocopy' ) )
										continue;
									$icon = sh_set( $social, 'social_icon' );
									?>
									<li>
										<a title="" href="<?php echo sh_set( $social, 'social_link' ); ?>">
											<i class="fa <?php echo $icon; ?>" style="color:<?php echo (sh_set($social, 'social_btn_color')) ?  esc_js(sh_set($social, 'social_btn_color')) : ""; ?>"></i>
										</a>
									</li>
									<?php
								endforeach;
							endif;
							?>
						</ul><!--- SOCIAL MEDIA -->
					<?php endif; ?>

					<?php
					if ( sh_set( $options, 'show_header_cart' ) == 1 ):
						if ( class_exists( 'Woocommerce' ) ) {
							global $woocommerce;
							//printr($woocommerce);
							$my_cart_count = $woocommerce->cart->cart_contents_count;
							$my_cart_total = $woocommerce->cart->cart_contents_total;
							?>
							<div class="cart_outer">
								<div class="cart-dropdown">
									<p><i class="fa fa-shopping-cart"></i> <?php echo $my_cart_count; ?> items - <span><?php
											echo get_woocommerce_currency_symbol();
											echo $my_cart_total;
											?></span></p>
									<ul>
										<p><?php echo $my_cart_count; ?> <?php _e( 'items in the shopping cart', 'wp_deeds' ) ?></p>
										<?php if ( $my_cart_count > 0 ): ?>
											<?php include( 'framework/modules/cart_items.php' ); ?>
											<li>
												<a class="cart-drop-btn" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title=""><?php _e( 'VIEW CART', 'wp_deeds' ) ?></a>
												<a class="cart-drop-btn" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title=""><?php _e( 'CHECKOUT', 'wp_deeds' ) ?></a>
											</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
							<?php
						}
					endif;
					?>
                </div>
            </div>
            <nav>
                <div class="container">
                    <div class="logo">
						<?php if ( sh_set( $options, 'logo_type' ) == 'image' ): ?>
							<?php $Logo = '<img src="' . sh_set( $options, 'logo_image' ) . '" alt="" />'; ?>
							<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" >
								<?php echo $Logo; ?>
							</a>
							<?php
						else:
							$logo_txt = (sh_set( $options, 'text_logo_text' )) ? sh_set( $options, 'text_logo_text' ) : '';
							$logo_size = (sh_set( $options, 'text_logo_size' )) ? sh_set( $options, 'text_logo_size' ) . 'px' : '24px';
							$logo_margin = (sh_set( $options, 'text_logo_margin' )) ? sh_set( $options, 'text_logo_margin' ) . 'px' : '';
							$logo_color = (sh_set( $options, 'text_logo_color' )) ? sh_set( $options, 'text_logo_color' ) : '';
							$logo_font = (sh_set( $options, 'text_logo_font' )) ? sh_set( $options, 'text_logo_font' ) : '';
							$style = array( 'font-size' => $logo_size, 'margin-top' => $logo_margin, 'color' => $logo_color, 'font-family' => $logo_font );
							$render_style = 'style=';
							foreach ( $style as $key => $s ) {
								if ( !empty( $s ) ) {
									$render_style .= $key . ':' . $s . ';';
								}
							}
							?>
							<h1 <?php echo esc_attr( $render_style ) ?>>
								<a style="color:<?php echo esc_attr( $logo_color ) ?>" href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" >
									<?php echo $logo_txt; ?>
								</a>
							</h1>
						<?php endif; ?>
                    </div>
					<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'container' => false ) ); ?>
					<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>
					<?php $dir = ABSPATH . 'wp-content/plugins/sitepress-multilingual-cms/sitepress.php'; ?>
                    <form class="header-search" action="<?php echo home_url(); ?>" method="get">
						<?php
						if ( is_plugin_active( $dir ) ): echo '<input type="hidden" name="lang" value="' . ( ICL_LANGUAGE_CODE ) . '"/>';
						endif;
						?>
                        <input type="text" name="s" placeholder="Enter Your Search Keyword">
                        <input type="submit" value="">
                    </form>
                </div>
            </nav>
        </header><!--- HEADER -->

		<div class="responsive-header">
			<?php
			if ( sh_set( $options, 'show_h_event' ) == 1 && sh_set( $options, 'header_event' ) != '' ) {
				$id = sh_set( $options, 'header_event' );
				$event_meta = sh_set( sh_set( get_post_meta( $id, 'sh_event_meta', true ), 'sh_event_options' ), 0 );
				$time = strtotime( sh_set( $event_meta, 'start_time' ) );
				$new_time = date( 'g:i a', $time );

				$date = strtotime( sh_set( $event_meta, 'start_date' ) );

				$c_t = date( 'H:i:s', $time );
				$c_d = date( 'm/d/Y', $date );
				?>
				<div class="responsive-prayer">
					<p><a href="<?php echo get_permalink( $id ); ?>" title=""><?php echo sh_set( $options, 'header_event_title' ); ?></a></p>
					<ul class="headercounter">
						<li> <span class="days">00</span>
							<p class="days_ref"><?php _e( 'days', 'wp_deeds' ); ?></p>
						</li>
						<li> <span class="hours">00</span>
							<p class="hours_ref"><?php _e( 'hours', 'wp_deeds' ); ?></p>
						</li>
						<li> <span class="minutes">00</span>
							<p class="minutes_ref"><?php _e( 'minutes', 'wp_deeds' ); ?></p>
						</li>
						<li> <span class="seconds">00</span>
							<p class="seconds_ref"><?php _e( 'seconds', 'wp_deeds' ); ?></p>
						</li>
					</ul>
				</div>
				<?php
				$get_timezone = ( sh_set( $options, 'time_zone' ) != '') ? explode( ' ', sh_set( $options, 'time_zone' ), 2 ) : '';
				$timezone = (!empty( $get_timezone )) ? sh_set( $get_timezone, '0' ) : '0';
				echo '<script type="text/javascript">
							jQuery(document).ready(function($){
								header_event("ul.headercounter", "' . $c_d . ' ' . $c_t . '", ' . $timezone . ');
						});
						</script>';
			}
			if ( sh_set( $options, 'show_h_email' ) == 1 || sh_set( $options, 'show_h_contact' ) == 1 ) {
				?>
				<div class="responsive-contact">
					<span>
						<?php if ( sh_set( $options, 'show_header_contact' ) == 1 && sh_set( $options, 'header_contact' ) != '' ): ?>
							<p class="responsive-phone">
								<i class="fa fa-mobile"></i>
								<?php echo sh_set( $options, 'header_contact' ) ?>
							</p>
						<?php endif; ?>
						<?php if ( sh_set( $options, 'show_header_email' ) == 1 && sh_set( $options, 'header_email' ) != '' ): ?>
							<p class="responsive-mail">
								<i class="fa fa-envelope"></i>
								<?php echo sh_set( $options, 'header_email' ) ?>
							</p>
						<?php endif; ?>
					</span>
					<a class="phone-btn active" href="javascript:void(0)" title=""><i class="fa fa-phone"></i></a>
					<a class="mail-btn" href="javascript:void(0)" title=""><i class="fa fa-envelope"></i></a>
				</div><!-- Responsive Contact -->
			<?php } ?>
			<?php if ( sh_set( $options, 'show_h_search' ) == 1 || sh_set( $options, 'show_h_social' ) == 1 ): ?>
				<div class="responsive-extras">
					<?php if ( sh_set( $options, 'show_h_search' ) == 1 ): ?>
						<?php include_once(ABSPATH . 'wp-admin/includes/plugin.php'); ?>
						<?php $dir = ABSPATH . 'wp-content/plugins/sitepress-multilingual-cms/sitepress.php'; ?>
						<div class="responsive-search">
							<span><i class="fa fa-search"></i></span>
							<form action="<?php echo home_url(); ?>" method="get">
								<?php
								if ( is_plugin_active( $dir ) ): echo '<input type="hidden" name="lang" value="' . ( ICL_LANGUAGE_CODE ) . '"/>';
								endif;
								?>
								<input type="text" name="s" placeholder="<?php _e( 'Enter Your Search Keyword', 'wp_deeds' ) ?>">
								<button type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					<?php endif; ?>
					<?php if ( sh_set( $options, 'show_h_social' ) == 1 ) { ?>
						<div class="responsive-social">
							<?php
							$social_media = sh_set( sh_set( $options, 'social_media' ), 'social_media' );
							array_pop($social_media);
							if ( is_array( $social_media ) ) {
								foreach ( (array) $social_media as $social ) {
									if ( sh_set( $social, 'tocopy' ) == 1 )
										break;
									$icon = sh_set( $social, 'social_icon' );
									?>
									<a title="" href="<?php echo sh_set( $social, 'social_link' ); ?>">
										<i class="fa <?php echo $icon; ?>" style="color:<?php echo (sh_set($social, 'social_btn_color')) ?  esc_js(sh_set($social, 'social_btn_color')) : ""; ?>"></i>
									</a>
									<?php
								}
							}
							?>
						</div><!--- SOCIAL MEDIA -->
					<?php } ?>
					<?php
					if ( sh_set( $options, 'show_h_cart' ) == 1 ) {
						if ( class_exists( 'Woocommerce' ) ) {
							global $woocommerce;
							//printr($woocommerce);
							$my_cart_count = $woocommerce->cart->cart_contents_count;
							$my_cart_total = $woocommerce->cart->cart_contents_total;
							?>
							<div class="responsive-cart">
								<i class="fa fa-shopping-cart"></i> <?php echo $my_cart_count; ?> <?php _e( 'items', 'wp_deeds' ) ?> -
								<span>
									<?php
									echo get_woocommerce_currency_symbol();
									echo $my_cart_total;
									?>
								</span>
							</div>
							<?php
						}
					}
					?>
				</div>
			<?php endif; ?>
			<div class="responisve-bar">
				<div class="responsive-logo">
					<?php if ( sh_set( $options, 'logo_type_res' ) == 'image' ): ?>
						<?php $Logo = '<img src="' . sh_set( $options, 'logo_image_res' ) . '" alt="" />'; ?>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" >
							<?php echo $Logo; ?>
						</a>
						<?php
					else:
						$logo_txt = (sh_set( $options, 'text_logo_text_res' )) ? sh_set( $options, 'text_logo_text_res' ) : '';
						$logo_size = (sh_set( $options, 'text_logo_size_res' )) ? sh_set( $options, 'text_logo_size_res' ) . 'px' : '24px';
						$logo_margin = (sh_set( $options, 'text_logo_margin_res' )) ? sh_set( $options, 'text_logo_margin_res' ) . 'px' : '';
						$logo_color = (sh_set( $options, 'text_logo_color_res' )) ? sh_set( $options, 'text_logo_color_res' ) : '';
						$logo_font = (sh_set( $options, 'text_logo_font_res' )) ? sh_set( $options, 'text_logo_font_res' ) : '';
						$style = array( 'font-size' => $logo_size, 'margin-top' => $logo_margin, 'color' => $logo_color, 'font-family' => $logo_font );
						$render_style = 'style=';
						foreach ( $style as $key => $s ) {
							if ( !empty( $s ) ) {
								$render_style .= $key . ':' . $s . ';';
							}
						}
						?>
						<h1 <?php echo esc_attr( $render_style ) ?>>
							<a style="color:<?php echo esc_attr( $logo_color ) ?>" href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" >
								<?php echo $logo_txt; ?>
							</a>
						</h1>
					<?php endif; ?>
				</div>

				<span class="responsive-btn"><i class="fa fa-list"></i></span>
			</div>
		</div><!-- Responsive Header -->

		<div class="responsive-menu">
			<?php
			if ( sh_set( $options, 'select_res_menu' ) != '' ) {
				$locations = get_theme_mod( 'nav_menu_locations' );
				$locations['responsive_menu'] = sh_set( $options, 'select_res_menu' );
				set_theme_mod( 'nav_menu_locations', $locations );
			}
			wp_nav_menu( array( 'theme_location' => 'responsive_menu', 'container' => false ) );
			?>
		</div>
