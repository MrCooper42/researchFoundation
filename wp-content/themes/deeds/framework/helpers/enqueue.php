<?php

class SH_Enqueue {

	function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'sh_enqueue_scripts' ) );

		add_action( 'wp_head', array( $this, 'wp_head' ) );

		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'sh_load_wp_media_files' ) );
	}

	function sh_load_wp_media_files() {
		wp_enqueue_style( 'SH_loader', SH_URL . 'css/ball-scale-ripple-multiple.css', array(), SH_VERSION, 'all' );
	}

	function sh_admin_scripts() {
		global $post_type;
		if ( $post_type == 'cs_cermons' ) {
			echo '<script>
					jQuery(document).ready(function() {
						jQuery(".vp-timepicker").timepicker({
							timeFormat: "HH:mm:ss"
						});
					});
				 </script>';
		}
	}

	function sh_enqueue_scripts() {
		$options = get_option( 'wp_deeds' . '_theme_options' );

		$protocol = is_ssl() ? 'https' : 'http';
		$styles = array( 'google_fonts' => $protocol . '://fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700,700italic',
			'google_fonts_2' => $protocol . '://fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C300italic%2C400italic%2C600%2C600italic%2C700%2C700italic%2C800italic%2C800%27&ver=3.9.1',
			'bootstrap' => 'css/bootstrap.min.css',
			'my_font-awesome' => 'font-awesome/css/font-awesome.css',
			'element_player' => 'css/mediaelementplayer.min.css',
			'my_select2' => 'css/select2.css',
			'fullcalender'	=>	'css/fullcalendar.css',
			'main_style' => 'style.css',
			'revolution' => 'css/revolution.css',
			'owl_carousel' => 'css/owl-carousel.css',
			'responsive_css' => 'css/responsive.css',
			'color_scheme' => 'css/color.css',
		);

		if ( sh_set( $options, 'rtl_style' ) ):
			$rtl = array( 'rtl' => 'css/rtl.css' );
			$styles = array_merge( $styles, $rtl );
		endif;


		$fonts = $this->custom_fonts();
		if ( $fonts ):
			foreach ( $fonts as $key => $value ) {
				wp_enqueue_style( $key, $value );
			}
		endif;


		foreach ( $styles as $name => $style ) {

			if ( strstr( $style, 'http' ) || strstr( $style, 'https' ) )
				wp_enqueue_style( $name, $style );
			else
				wp_enqueue_style( $name, SH_URL . $style );
		}

		$scripts = array(
			'bootstrap' => 'bootstrap.min.js',
			'modernizr.custom' => 'modernizr.custom.17475.js',
			'owl.carousel.min' => 'owl.carousel.min.js',
			'jquery.proptrox' => 'jquery.poptrox.min.js',
			'jquery.knob' => 'jquery.knob.js',
			'knob-script' => 'knob-script.js',
			//'text-rotator' => 'jquery.simple-text-rotator.js',
			'mediaelements' => 'mediaelement-and-player.min.js',
			'jquery.isotope.min' => 'jquery.isotope.min.js',
			'flickrjs' => 'jflickrfeed.min.js',
			'counter' => 'jquery.downCount.js',
			'moment'	=>	'moment.min.js',
			'full_calender'	=>	'fullcalendar.min.js',
			'jq_select' => 'jquery.minimalect.min.js',
			'stripe' => 'https://js.stripe.com/v2/',
			'co2' => 'checkout2.js',
			'my_select2' => 'select2.js',
			'custom_script' => 'script.js',
		);
		foreach ( $scripts as $name => $js ) {
			wp_register_script( $name, $this->static_url( $js ), '', '', true );
		}
		wp_enqueue_script( array(
			'bootstrap',
			'modernizr.custom',
			'owl.carousel.min',
			'jquery.proptrox',
			'jquery.knob',
			//'knob-script',
			//'text-rotator',
			'mediaelements',
			'jquery.isotope.min',
			'counter',
			'jq_select',
			'moment',
			'full_calender',
			'stripe',
			'co2',
			'my_select2',
			'custom_script',
		) );
		if ( is_singular() )
			wp_enqueue_script( 'comment-reply' );
	}

	function static_url( $url = '' ) {
		if ( strpos( $url, 'http' ) === 0 ) {
			return $url;
		} else {
			return SH_URL . 'js/' . ltrim( $url, '/' );
		}
	}

	function wp_head() {
		$options = get_option( 'wp_deeds' . '_theme_options' );
		echo '<script type="text/javascript"> if( ajaxurl === undefined ) var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";</script>';
		?>

		<style type="text/css">
		<?php
		if ( sh_set( $options, 'body_custom_fonts' ) == 1 ):
			echo sh_get_font_settings( array( 'body_font_family' => 'font-family', 'body_font_color' => ';color' ), 'body, p {', ' !important}' );
		endif;
		if ( sh_set( $options, 'use_custom_font' ) == 1 ):
			echo sh_get_font_settings( array( 'h1_font_family' => 'font-family' ), 'h1 {', ' !important}' );
			echo sh_get_font_settings( array( 'h2_font_family' => 'font-family' ), 'h2 {', ' !important}' );
			echo sh_get_font_settings( array( 'h3_font_family' => 'font-family' ), 'h3 {', ' !important}' );
			echo sh_get_font_settings( array( 'h4_font_family' => 'font-family' ), 'h4 {', ' !important}' );
			echo sh_get_font_settings( array( 'h5_font_family' => 'font-family' ), 'h5 {', ' !important}' );
			echo sh_get_font_settings( array( 'h6_font_family' => 'font-family' ), 'h6 {', ' !important}' );


			echo sh_get_font_settings( array( 'h1_font_color' => ';color' ), 'h1 {', ' !important}' );
			echo sh_get_font_settings( array( 'h2_font_color' => ';color' ), 'h2 {', ' !important}' );
			echo sh_get_font_settings( array( 'h3_font_color' => ';color' ), 'h3 {', ' !important}' );
			echo sh_get_font_settings( array( 'h4_font_color' => ';color' ), 'h4 {', ' !important}' );
			echo sh_get_font_settings( array( 'h5_font_color' => ';color' ), 'h5 {', ' !important}' );
			echo sh_get_font_settings( array( 'h6_font_color' => ';color' ), 'h6 {', ' !important}' );
		endif;
		?>
		</style>
		<script>
		<?php
		$opt = get_option( 'wp_deeds' . '_theme_options' );
		echo "var STRIPE_PUBLISHABLE_KEY = '" . sh_set( $opt, 'stripe_publishable_key' ) . "'; ";
		echo "\n";
		echo 'var var_before= "' . __( 'Please Enter', 'wp-appointment' ) . '";';
		echo "\n";
		echo "var wst_card_amount = '" . __( 'Amount', 'wp-appointment' ) . "'; ";
		echo "\n";
		echo 'var wst_card_nub= "' . __( 'Card Number', 'wp-appointment' ) . '";';
		echo "\n";
		echo 'var wst_card_cem= "' . __( 'Card Expire Mounth', 'wp-appointment' ) . '";';
		echo "\n";
		echo 'wst_card_cey= "' . __( 'Card Expire Year', 'wp-appointment' ) . '";';
		echo "\n";
		echo 'var wst_card_cvc= "' . __( 'Card CVC Number', 'wp-appointment' ) . '";';
		echo "\n";
		echo 'var invalid_token= "' . __( 'Your Tocken Has Been Expire. Please Start From Over', 'wp-appointment' ) . '";';
		echo "\n";
		echo 'var CHECKOUT2_Account_No = "' . sh_set( $opt, 'account_no' ) . '";';
		if ( sh_set( $opt, 'checkout2_type' ) == 'true' ) {
			echo 'var MODE = "sandbox";';
		} else {
			echo 'var MODE = "production";';
		}
		echo "\n";
		echo 'var CHECKOUT2_PUBLIC_KEY = "' . sh_set( $opt, 'checkout2_publishable_key' ) . '";';
		echo "\n";
		echo 'var CHECKOUT2_Account_No = "' . sh_set( $opt, 'checkout2_account_number' ) . '";';
		echo "\n";
		echo 'var STRIPE_ERROR= "' . __( 'Payments Details Not Configured', 'wp-appointment' ) . '";';
		?>
		</script>
		<?php
		if ( sh_set( $options, 'header_css' ) != '' ) {
			echo '<style>' . sh_set( $options, 'header_css' ) . '</style>';
		}
		echo $custom_css = sh_set( $options, 'custom_css' );
		echo sh_theme_color_scheme();
		if ( sh_set( $options, 'logo_type' ) == 'text' && sh_set( $options, 'text_logo_font' ) != '' ):
			echo "<link rel='stylesheet' id='logo_font_style' href='https://fonts.googleapis.com/css?family=" . sh_set( $options, 'text_logo_font' ) . "' type='text/css' media='all' />";
		endif;
	}

	function custom_fonts( $styles = null ) {
		$opt = get_option( 'wp_deeds' . '_theme_options' );

		$protocol = ( is_ssl() ) ? 'https' : 'http';

		$font = array();
		if ( sh_set( $opt, 'use_custom_font' ) == 1 ):
			if ( $h1 = sh_set( $opt, 'h1_font_family' ) )
				$font[$h1] = urlencode( $h1 ) . ':400,300,600,700,800';
			if ( $h2 = sh_set( $opt, 'h2_font_family' ) )
				$font[$h2] = urlencode( $h2 ) . ':400,300,600,700,800';
			if ( $h3 = sh_set( $opt, 'h3_font_family' ) )
				$font[$h3] = urlencode( $h3 ) . ':400,300,600,700,800';
			if ( $h4 = sh_set( $opt, 'h4_font_family' ) )
				$font[$h4] = urlencode( $h4 ) . ':400,300,600,700,800';
			if ( $h5 = sh_set( $opt, 'h5_font_family' ) )
				$font[$h5] = urlencode( $h5 ) . ':400,300,600,700,800';
			if ( $h6 = sh_set( $opt, 'h6_font_family' ) )
				$font[$h6] = urlencode( $h6 ) . ':400,300,600,700,800';
		endif;
		if ( sh_set( $opt, 'body_custom_fonts' ) == 1 ):
			if ( $body = sh_set( $opt, 'body_font_family' ) )
				$font[$body] = urlencode( $body ) . ':400,300,600,700,800';
		endif;
		if ( $font )
			$styles['sh_google_custom_font'] = $protocol . '://fonts.googleapis.com/css?family=' . implode( '|', $font );
		return $styles;
	}

	function wp_footer() {
		
	}

}
