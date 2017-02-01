<?php

/**
 * Here is the place to put your own defined function that serve as
 * datasource to field with multiple options.
 */
function vp_get_categories() {
	$wp_cat = get_categories( array( 'hide_empty' => 0 ) );
	$result = array();
	foreach ( $wp_cat as $cat ) {
		$result[] = array( 'value' => $cat->cat_ID, 'label' => $cat->name );
	}
	return $result;
}

function vp_get_users() {
	$wp_users = VP_WP_User::get_users();
	$result = array();
	foreach ( $wp_users as $user ) {
		$result[] = array( 'value' => $user['id'], 'label' => $user['display_name'] );
	}
	return $result;
}

function vp_get_posts() {
	$wp_posts = get_posts( array(
		'posts_per_page' => -1,
			) );

	$result = array();
	foreach ( $wp_posts as $post ) {
		$result[] = array( 'value' => $post->ID, 'label' => $post->post_title );
	}
	return $result;
}

function vp_get_posts_custom() {
	$args = array(
		'post_type' => 'cs_events',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	);

	$result = array();
	$my_query = null;
	$my_query = new WP_Query( $args );
	if ( $my_query->have_posts() ) {
		foreach ( $my_query->posts as $key => $value ):
			$result[] = array( 'value' => $value->ID, 'label' => $value->post_title );
		endforeach;
	}
	return $result;
	wp_reset_query();
}

function vp_get_pages() {
	$wp_pages = get_pages();

	$result = array();
	foreach ( $wp_pages as $page ) {
		$result[] = array( 'value' => $page->ID, 'label' => $page->post_title );
	}
	return $result;
}

function vp_get_tags() {
	$wp_tags = get_tags( array( 'hide_empty' => 0 ) );
	$result = array();
	foreach ( $wp_tags as $tag ) {
		$result[] = array( 'value' => $tag->term_id, 'label' => $tag->name );
	}
	return $result;
}

function vp_get_roles() {
	$result = array();
	$editable_roles = VP_WP_User::get_editable_roles();

	foreach ( $editable_roles as $key => $role ) {
		$result[] = array( 'value' => $key, 'label' => $role['name'] );
	}

	return $result;
}

function vp_get_gwf_family() {
	$fonts = file_get_contents( dirname( __FILE__ ) . '/gwf.json' );
	$fonts = json_decode( $fonts );

	$fonts = array_keys( get_object_vars( $fonts ) );

	foreach ( $fonts as $font ) {
		$result[] = array( 'value' => $font, 'label' => $font );
	}

	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_get_gwf_weight' );

function vp_get_gwf_weight( $face ) {
	if ( empty( $face ) )
		return array();

	$fonts = file_get_contents( dirname( __FILE__ ) . '/gwf.json' );
	$fonts = json_decode( $fonts );
	$weights = $fonts->{$face}->weights;

	foreach ( $weights as $weight ) {
		$result[] = array( 'value' => $weight, 'label' => $weight );
	}

	return $result;
}

VP_Security::instance()->whitelist_function( 'vp_get_gwf_style' );

function vp_get_gwf_style( $face ) {
	if ( empty( $face ) )
		return array();

	$fonts = file_get_contents( dirname( __FILE__ ) . '/gwf.json' );
	$fonts = json_decode( $fonts );
	$styles = $fonts->{$face}->styles;

	foreach ( $styles as $style ) {
		$result[] = array( 'value' => $style, 'label' => $style );
	}

	return $result;
}

function vp_get_social_medias() {
	$socmeds = array(
		array( 'value' => 'blogger', 'label' => 'Blogger' ),
		array( 'value' => 'delicious', 'label' => 'Delicious' ),
		array( 'value' => 'deviantart', 'label' => 'DeviantArt' ),
		array( 'value' => 'digg', 'label' => 'Digg' ),
		array( 'value' => 'dribbble', 'label' => 'Dribbble' ),
		array( 'value' => 'email', 'label' => 'Email' ),
		array( 'value' => 'facebook', 'label' => 'Facebook' ),
		array( 'value' => 'flickr', 'label' => 'Flickr' ),
		array( 'value' => 'forrst', 'label' => 'Forrst' ),
		array( 'value' => 'foursquare', 'label' => 'Foursquare' ),
		array( 'value' => 'github', 'label' => 'Github' ),
		array( 'value' => 'googleplus', 'label' => 'Google+' ),
		array( 'value' => 'instagram', 'label' => 'Instagram' ),
		array( 'value' => 'lastfm', 'label' => 'Last.FM' ),
		array( 'value' => 'linkedin', 'label' => 'LinkedIn' ),
		array( 'value' => 'myspace', 'label' => 'MySpace' ),
		array( 'value' => 'pinterest', 'label' => 'Pinterest' ),
		array( 'value' => 'reddit', 'label' => 'Reddit' ),
		array( 'value' => 'rss', 'label' => 'RSS' ),
		array( 'value' => 'soundcloud', 'label' => 'SoundCloud' ),
		array( 'value' => 'stumbleupon', 'label' => 'StumbleUpon' ),
		array( 'value' => 'tumblr', 'label' => 'Tumblr' ),
		array( 'value' => 'twitter', 'label' => 'Twitter' ),
		array( 'value' => 'vimeo', 'label' => 'Vimeo' ),
		array( 'value' => 'wordpress', 'label' => 'WordPress' ),
		array( 'value' => 'yahoo', 'label' => 'Yahoo!' ),
		array( 'value' => 'youtube', 'label' => 'Youtube' ),
	);

	return $socmeds;
}

function vp_get_fontawesome_icons() {
	// scrape list of icons from fontawesome css
	if ( false === ( $icons = get_transient( 'vp_get_fontawesome_icons' ) ) ) {
		$pattern = '/\.(fa-(?:\w+(?:-)?)+):before/';
		$subject = file_get_contents( VP_DIR . '/public/css/vendor/font-awesome.min.css' );
		preg_match_all( $pattern, $subject, $matches, PREG_SET_ORDER );
		$icons = array();
		foreach ( $matches as $match ) {
			//printr($matches);
			$icons[] = array( 'value' => 'fa ' . $match[1], 'label' => 'fa ' . $match[1] );
		}
		set_transient( 'vp_fontawesome_icons', $icons, 60 * 60 * 24 );
	}
	return $icons;
}

function fw_get_languages( $lang_dir = '' ) {
	$directory = wp_get_theme()->DomainPath;
	$dir = ( $lang_dir ) ? $lang_dir : SH_LANG_DIR;
	$data = @scandir( $dir );
	if ( !$data )
		return array();
	if ( $data && is_array( $data ) )
		unset( $data[0], $data[1] );
	$return = array();
	foreach ( $data as $d ) {
		if ( substr( $d, -3 ) == '.mo' ) {
			$name = substr( $d, 0, (strlen( $d ) - 3 ) );
			$return[] = array( 'value' => $name, 'label' => $name );
		}
	}
	return $return;
}

VP_Security::instance()->whitelist_function( 'vp_dep_boolean' );

function vp_dep_boolean( $value = null ) {
	$args = func_get_args();
	$result = true;
	foreach ( $args as $val ) {
		$result = ($result and ! empty( $val ));
	}
	return $result;
}

VP_Security::instance()->whitelist_function( 'sh_get_sidebars_2' );

function sh_get_sidebars_2() {
	global $wp_registered_sidebars;
	$sidebars = !($wp_registered_sidebars) ? get_option( 'wp_registered_sidebars' ) : $wp_registered_sidebars;
	$data = array( array( 'value' => '', 'label' => __( 'No Sidebar', 'wp_deeds' ) ) );
	foreach ( (array) $sidebars as $sidebar ) {
		$data[] = array( 'value' => sh_set( $sidebar, 'id' ), 'label' => sh_set( $sidebar, 'name' ) );
	}
	return $data;
}

function sh_time_zone() {
	if ( false === ( $timezone = get_transient( 'sh_time_zone' ) ) ) {
		$timezone = array(
			array( 'value' => '-12', 'label' => 'International Date Line West' ),
			array( 'value' => '-11', 'label' => 'Coordinated Universal Time-11' ),
			array( 'value' => '-10', 'label' => 'Hawaii' ),
			array( 'value' => '-9', 'label' => 'Alaska' ),
			array( 'value' => '-8', 'label' => 'Baja California' ),
			array( 'value' => '-8', 'label' => 'Pacific Time(US & Canada)' ),
			array( 'value' => '-7', 'label' => 'Arizona' ),
			array( 'value' => '-7', 'label' => 'Chihuahua, La Paz, Mazatlan' ),
			array( 'value' => '-7', 'label' => 'Mountain Time (US & Canada)' ),
			array( 'value' => '-6', 'label' => 'Central America' ),
			array( 'value' => '-6', 'label' => 'Central Time (US & Canada)' ),
			array( 'value' => '-6', 'label' => 'Guadalajara, Mexico City, Monterrey' ),
			array( 'value' => '-6', 'label' => 'Saskatchewan' ),
			array( 'value' => '-5', 'label' => 'Bogota, Lima, Quito, Rio Branco' ),
			array( 'value' => '-5', 'label' => 'Eastern Time (US & Canada)' ),
			array( 'value' => '-5', 'label' => 'Indiana (East)' ),
			array( 'value' => '-4.30', 'label' => 'Caracas' ),
			array( 'value' => '-4', 'label' => 'Asuncion' ),
			array( 'value' => '-4', 'label' => 'Atlantic Time (Canada)' ),
			array( 'value' => '-4', 'label' => 'Cuiaba' ),
			array( 'value' => '-4', 'label' => 'Georgetown, LA PAZ Manaus, San Juan' ),
			array( 'value' => '-4', 'label' => 'Santiago' ),
			array( 'value' => '-3.30', 'label' => 'Newfoundland' ),
			array( 'value' => '-3', 'label' => 'Brasilia' ),
			array( 'value' => '-3', 'label' => 'Busenos Aires' ),
			array( 'value' => '-3', 'label' => 'Cayenne, Fortaleza' ),
			array( 'value' => '-3', 'label' => 'Greenland' ),
			array( 'value' => '-3', 'label' => 'Mountevideo' ),
			array( 'value' => '-3', 'label' => 'Salvador' ),
			array( 'value' => '-2', 'label' => 'Coordinated Universal Time-02' ),
			array( 'value' => '-1', 'label' => 'Azores' ),
			array( 'value' => '-1', 'label' => 'Cape Verde Is.' ),
			array( 'value' => '0', 'label' => 'Casablanca' ),
			array( 'value' => '0', 'label' => 'Coordinated Universal Time' ),
			array( 'value' => '0', 'label' => 'Dublin, Edinburgh, Lisbon, London' ),
			array( 'value' => '0', 'label' => 'Monrovia, Reykjavik' ),
			array( 'value' => '+1', 'label' => 'Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna' ),
			array( 'value' => '+1', 'label' => 'Belgrade, Bratislava, Budapest, Ljubljana, Prague' ),
			array( 'value' => '+1', 'label' => 'Brussels, Copenhagen, Madrid, Paris' ),
			array( 'value' => '+1', 'label' => 'Sarajevo, Skopje, Warsaw, Zagreb' ),
			array( 'value' => '+1', 'label' => 'West Central Africa' ),
			array( 'value' => '+1', 'label' => 'Windhoek' ),
			array( 'value' => '+2', 'label' => 'Amman' ),
			array( 'value' => '+2', 'label' => 'Athens, Bucharest' ),
			array( 'value' => '+2', 'label' => 'Beirut' ),
			array( 'value' => '+2', 'label' => 'Cairo' ),
			array( 'value' => '+2', 'label' => 'Damascus' ),
			array( 'value' => '+2', 'label' => 'E. Europe' ),
			array( 'value' => '+2', 'label' => 'Harare, Pretoria' ),
			array( 'value' => '+2', 'label' => 'Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius' ),
			array( 'value' => '+2', 'label' => 'Istanbul' ),
			array( 'value' => '+2', 'label' => 'Jerusalem' ),
			array( 'value' => '+2', 'label' => 'Tripoli' ),
			array( 'value' => '+3', 'label' => 'Baghdad' ),
			array( 'value' => '+3', 'label' => 'Kaliningrad, Minsk' ),
			array( 'value' => '+3', 'label' => 'Kuwait, Riyadh' ),
			array( 'value' => '+3', 'label' => 'Nairobi' ),
			array( 'value' => '+3', 'label' => 'Tehran' ),
			array( 'value' => '+4', 'label' => 'Abu Dhabi, Muscat' ),
			array( 'value' => '+4', 'label' => 'Baku' ),
			array( 'value' => '+4', 'label' => 'Moscow, St. Petersburg, Volgograd' ),
			array( 'value' => '+4', 'label' => 'Port Louis' ),
			array( 'value' => '+4', 'label' => 'Tbilisi' ),
			array( 'value' => '+4', 'label' => 'Yerevan' ),
			array( 'value' => '+4.30', 'label' => 'Kabul' ),
			array( 'value' => '+5', 'label' => 'Ashgabat, Tashkent' ),
			array( 'value' => '+5', 'label' => 'Islamabad, Karachi' ),
			array( 'value' => '+5.30', 'label' => 'Chennai, Kolkata, Mumbai, New Delhi' ),
			array( 'value' => '+5.30', 'label' => 'Sri Jayawardenepura' ),
			array( 'value' => '+5.45', 'label' => 'Kathmandu' ),
			array( 'value' => '+6', 'label' => 'Astana' ),
			array( 'value' => '+6', 'label' => 'Dhaka' ),
			array( 'value' => '+6', 'label' => 'Ekaterinburg' ),
			array( 'value' => '+6.30', 'label' => 'Yangon (Rangoon)' ),
			array( 'value' => '+7', 'label' => 'Bangkok, Henoi, Jakarta' ),
			array( 'value' => '+7', 'label' => 'Novosibirsk' ),
			array( 'value' => '+8', 'label' => 'Beijing, Chongqing, Hong Kong, Urumqi' ),
			array( 'value' => '+8', 'label' => 'Krasnoyarsk' ),
			array( 'value' => '+8', 'label' => 'Kuala Lumpur, Singapore' ),
			array( 'value' => '+8', 'label' => 'Perth' ),
			array( 'value' => '+8', 'label' => 'Taipei' ),
			array( 'value' => '+8', 'label' => 'Ulaanbaatar' ),
			array( 'value' => '+9', 'label' => 'Lrkutsk' ),
			array( 'value' => '+9', 'label' => 'Osaka, Sapporo, Tokyo' ),
			array( 'value' => '+9', 'label' => 'Seoul' ),
			array( 'value' => '+9.30', 'label' => 'Adelaide' ),
			array( 'value' => '+9.30', 'label' => 'Darwin' ),
			array( 'value' => '+10', 'label' => 'Brisbane' ),
			array( 'value' => '+10', 'label' => 'Canberra, Melbourne, Sydney' ),
			array( 'value' => '+10', 'label' => 'Guam, Port Moresby' ),
			array( 'value' => '+10', 'label' => 'Hobart' ),
			array( 'value' => '+10', 'label' => 'Yekutsk' ),
			array( 'value' => '+11', 'label' => 'Solomon Is., New Caledonia' ),
			array( 'value' => '+11', 'label' => 'Vladivostok' ),
			array( 'value' => '+12', 'label' => 'Auckland, Wellington' ),
			array( 'value' => '+12', 'label' => 'Coordinated Universal Time+12' ),
			array( 'value' => '+12', 'label' => 'Fiji' ),
			array( 'value' => '+12', 'label' => 'Magadan' ),
			array( 'value' => '+13', 'label' => 'Nuku\'alofa' ),
			array( 'value' => '+13', 'label' => 'Samoa' ),
			array( 'value' => '+14', 'label' => 'Kiritimati Island' ),
		);
	}
	set_transient( 'sh_time_zone', $timezone, 60 * 60 * 24 );
	$new_zone = array();
	foreach ( $timezone as $key => $value ) {
		$new_zone[] = array( 'value' => sh_set( $value, 'value' ) . ' ' . sh_set( $value, 'label' ), 'label' => sh_set( $value, 'value' ) . ' ' . sh_set( $value, 'label' ) );
	}
	return $new_zone;
}

function sh_houre_range() {
	$value = range( 0, 100 );
	$return = array();
	foreach ( $value as $val ) {
		$return[] = array( 'value' => $val, 'label' => $val . ' Hour' );
	}
	return $return;
}

VP_Security::instance()->whitelist_function( 'vp_dep_logo' );

function vp_dep_logo( $value = null ) {
	if ( $value == 'image' ) {
		return true;
	} else {
		return false;
	}
}

VP_Security::instance()->whitelist_function( 'vp_dep_logo_res' );

function vp_dep_logo_res( $value = null ) {
	if ( $value == 'image' ) {
		return true;
	} else {
		return false;
	}
}

VP_Security::instance()->whitelist_function( 'vp_dep_logo_text' );

function vp_dep_logo_text( $value = null ) {
	if ( $value == 'text' ) {
		return true;
	} else {
		return false;
	}
}

VP_Security::instance()->whitelist_function( 'vp_dep_logo_text_res' );

function vp_dep_logo_text_res( $value = null ) {
	if ( $value == 'text' ) {
		return true;
	} else {
		return false;
	}
}
