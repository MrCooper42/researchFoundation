<?php
define( 'DOMAIN', 'wp_deeds' );
define( 'SH_VERSION', 'v2.0' );
define( 'SH_ROOT', get_template_directory() . '/' );
define( 'SH_URL', get_template_directory_uri() . '/' );
define( 'SH_LANG_DIR', SH_ROOT . 'languages' );
define( 'SH_DIR', dirname( __FILE__ ) );
define( 'CPATH', SH_ROOT.'framework/importer/');

get_template_part( 'framework/loader' );
get_template_part( 'framework/resource/remove_action' );

function sh_theme_localized( $locale ) {
	$options = get_option( 'wp_deeds' . '_theme_options' );
	$lang = sh_set( $options, 'sh_localize' );
	$locale = (sh_set( $options, 'sh_localize' )) ? sh_set( $options, 'sh_localize' ) : $locale;
	if ( isset( $_GET['l'] ) ) {
		printr( esc_attr( $_GET['l'] ) );
	}
	return $locale;
}

add_filter( 'locale', 'sh_theme_localized', 10 );


add_action('init', 'deeds_load_demo_script'); 

function deeds_load_demo_script(){
    wp_enqueue_script('deeds-demo-improter', VP_PUBLIC_URL.'/js/demo-import.js', '', '1.0', true);
}


add_action("wp_ajax_nopriv_theme-install-demo-data", 'theme_install_demo_data');
add_action("wp_ajax_theme-install-demo-data", 'theme_install_demo_data');

function theme_install_demo_data() {
    if (isset($_POST['action']) && $_POST['action'] == 'theme-install-demo-data') {
       include SH_ROOT .'framework/helpers/xml_importer.php';
        WST_Xml_importer::get_instance()->wst_demo_importer($_POST);
        exit;
    }
}
include  SH_ROOT . 'framework/importer/importer/importer.php';

if ( !function_exists( 'wp_wpstore_wpImporterScript' ) ) {
    function wp_wpstore_wpImporterScript($selected_demo) {
        include_once(SH_ROOT . 'framework/importer/import_export.php');
        $importer = new wp_wpstore_import_export($selected_demo);
        $importer->import();
    }
}


add_action( 'after_setup_theme', 'sh_theme_setup' );

function sh_theme_setup() {
	if ( get_option( 'wp_corner_stone_theme_options' ) && get_option( 'wp_deeds_theme_options' ) != '' ) {
		$opt = get_option( 'wp_corner_stone_theme_options' );
		$opt['action'] = 'vp_ajax_wp_deeds_theme_options_save';
		update_option( 'wp_deeds_theme_options', get_option( 'wp_corner_stone_theme_options' ) );
		delete_option( 'wp_corner_stone_theme_options' );
	}
	global $wp_version;
	sh_db_prayer_table();
	load_theme_textdomain( 'wp_deeds', SH_ROOT . '/languages' );
	add_editor_style();
	sh_create_donation_table();

	//ADD THUMBNAIL SUPPORT
	add_theme_support( "title-tag" );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' ); //Add menu support
	add_theme_support( 'automatic-feed-links' ); //Enables post and comment RSS feed links to head.
	add_theme_support( 'widgets' ); //Add widgets and sidebar support
	add_theme_support( 'woocommerce' ); // add woocommerce theme support
	add_theme_support( 'post-formats', array(
		'video', 'audio', 'gallery',
	) );
	add_theme_support( "custom-background" );
	add_theme_support( "custom-header" );

	if ( isset( $_POST['recurring_pp_submit'] ) ) {
		require_once(get_template_directory() . '/framework/modules/pp_recurring/expresscheckout.php');
	}
	/** Register wp_nav_menus */
	if ( function_exists( 'register_nav_menu' ) ) {
		register_nav_menus(
				array(
					/** Register Main Menu location header */
					'main_menu' => __( 'Main Menu', 'wp_deeds' ),
					'responsive_menu' => __( 'Responsive Menu', 'wp_deeds' ),
				//'footer_menu' => __('Footer Menu', 'wp_deeds'),
				)
		);
	}

	if ( !isset( $content_width ) )
		$content_width = 960;
	// for ministry crop 270x270
	add_image_size( '370x164', 370, 164, true ); //up
	add_image_size( '270x270', 270, 270, true );
	add_image_size( '80x80', 80, 80, true );
	add_image_size( '370x403', 370, 403, true );
	add_image_size( '341x470', 341, 470, true );
	add_image_size( '370x230', 370, 230, true );
	add_image_size( '770x324', 770, 324, true ); //new
	add_image_size( '570x345', 570, 345, true ); //new
	add_image_size( '370x201', 370, 201, true ); //new
}

function sh_widget_init() {

	register_widget( "SH_about_us" );
	register_widget( "SH_recent_blog" );
	register_widget( "SH_Flickr" );
	register_widget( "SH_News_Letter_Subscription" );
	register_widget( "SH_Video" );
	register_widget( "SH_Footer_Contact" );
	register_widget( "SH_our_gallery" );
	register_widget( "SH_latest_event_with_description" );
	register_widget( "SH_latest_event_without_description" );
	register_widget( "SH_upcoming_event_wiht_timer" );
	register_widget( "SH_donate_us" );
	register_widget( "SH_recent_sermons" );
	register_widget( "SH_pastor_messages" );
	global $wp_registered_sidebars;

	register_sidebar( array(
		'name' => __( 'Default Sidebar', 'wp_deeds' ),
		'id' => 'default-sidebar',
		'description' => __( 'Widgets in this area will be shown on the right-hand side.', 'wp_deeds' ),
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>'
	) );

	register_sidebar( array(
		'name' => __( 'Footer Sidebar', 'wp_deeds' ),
		'id' => 'footer-sidebar',
		'description' => __( 'Widgets in this area will be shown in Footer Area.', 'wp_deeds' ),
		'class' => '',
		'before_widget' => '<div class="col-md-4"><div class="widget">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>'
	) );

	register_sidebar( array(
		'name' => __( 'Blog Listing', 'wp_deeds' ),
		'id' => 'blog-sidebar',
		'description' => __( 'Widgets in this area will be shown on the right-hand side.', 'wp_deeds' ),
		'class' => '',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>'
	) );


	$sidebars = sh_set( sh_set( get_option( 'wp_deeds' . '_theme_options' ), 'dynamic_sidebar' ), 'dynamic_sidebar' );

	if ( !empty($sidebars) ) {
	foreach ( array_filter( (array) $sidebars ) as $sidebar ) {
		if ( sh_set( $sidebar, 'sidebar_name' ) != '' ) {
			if ( sh_set( $sidebar, 'topcopy' ) )
				break;
			$slug = bistro_slug( $sidebar );
			register_sidebar( array(
				'name' => sh_set( $sidebar, 'sidebar_name' ),
				'id' => sh_set( $slug, 'sidebar_name' ),
				'before_widget' => '<div class="widget">',
				'after_widget' => "</div>",
				'before_title' => '<div class="widget-title"><h4>',
				'after_title' => '</h4></div>',
			) );
			}
		}
	}
	
	$footer_sidebars = sh_set( sh_set( get_option( 'wp_deeds' . '_theme_options' ), 'footer_dynamic_sidebar' ), 'footer_dynamic_sidebar' );
	
	if ( !empty($footer_sidebars) ) {
		foreach ( ($footer_sidebars ) as $side ) {
			if ( sh_set( $side, 'footer_sidebar_name' ) != '' ) {
				if ( sh_set( $side, 'topcopy' ) )
					break;
				$slug = bistro_slug( $side );
				register_sidebar( array(
					'name' => sh_set( $side, 'footer_sidebar_name' ),
					'id' => sh_set( $slug, 'footer_sidebar_name' ),
					'before_widget' => '<div class="'.sh_set( $slug, 'footer_sidebar_column' ).'"><div class="widget">',
					'after_widget' => "</div></div>",
					'before_title' => '<div class="widget-title"><h4>',
					'after_title' => '</h4></div>',
				) );
			}
		}
	}

	update_option( 'wp_registered_sidebars', $wp_registered_sidebars );
}

add_action( 'widgets_init', 'sh_widget_init' );

/**
 * this function either prints or return the pagination of any archive/listing page.
 *
 * @param    array $args Array of arguments
 * @param    bolean $echo whether print or return the output.
 *
 * @return    string    Prints or return the pagination output.
 */
function sh_the_pagination( $args = array(), $echo = 1 ) {
	global $wp_query;
	$default = array( 'base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ), 'format' => '?paged=%#%', 'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages, 'next_text' => __( '&gt;', 'wp_deeds' ), 'prev_text' => __( '&lt;', 'wp_deeds' ), 'type' => 'list' );
	$args = wp_parse_args( $args, $default );
	
	$pagination = '<div class="theme-pagination">' . paginate_links( $args ) . '</div>';
	
		if ( $echo )
			echo $pagination;
		return $pagination;
}

function sh_search_filter( $query ) {
	if ( !$query->is_admin && $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'cs_tearm', 'cs_sermons', 'cs_events', 'cs_gallery' ) );
	}
	return $query;
}

add_filter( 'pre_get_posts', 'sh_search_filter' );

//create pagination
function sh_paginate() {
	global $wp_query;
	$total = $wp_query->max_num_pages;
	// only bother with the rest if we have more than 1 page!
	if ( $total > 1 ) {
		// get the current page
		if ( !$current_page = get_query_var( 'paged' ) )
			$current_page = 1;
		// structure of "format" depends on whether we're using pretty permalinks
		if ( get_option( 'permalink_structure' ) ) {
			$format = '/page/%#%';
		} else {
			$format = 'page/%#%/';
		}
		echo paginate_links( array(
			'base' => get_pagenum_link( 1 ) . '%_%',
			'format' => $format,
			'current' => $current_page,
			'total' => $total,
			'mid_size' => 4,
			'type' => 'list'
		) );
	}
}

// breadcumb
function sh_get_the_breadcrumb() {
	global $post, $wp_query;
	$queried_object = get_queried_object();
	$output = '';
	if ( !is_home() ) {
		$output .= '<li><a href="' . home_url() . '"><i class="fa fa-home"></i></a></li>';
		if ( is_category() ) {
			$output .= '<li><a href="' . get_category_link( get_query_var( 'cat' ) ) . '">' . single_cat_title( '', FALSE ) . '</a></li><li></li>';
		} elseif ( is_single() ) {
			$output .= '</li></li><li>';
			if ( $category = wp_get_object_terms( get_the_ID(), array( 'category', 'team_category', 'events_category', 'church_category', 'ministry_category' ) ) ) {
				if ( !is_wp_error( $category ) ) {
					$output .= '<li><a href="' . get_term_link( sh_set( $category, '0' ) ) . '">' . sh_set( sh_set( $category, '0' ), 'name' ) . '</a></li><li>' . get_the_title() . '</li>';
				}
			}
		} elseif ( is_tax() ) {
			$output .= '<li><a href="' . get_term_link( $queried_object ) . '">' . $queried_object->name . '</a></li>';
		} elseif ( $wp_query->is_page == 1 ) {
			if ( $post->post_parent ) {
				$anc = get_post_ancestors( $post->ID );
				$title = get_the_title();
				foreach ( $anc as $ancestor ) {
					$output .= '<li><a href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
				}
				$output .='<li> ' . $title . '</li>';
			} else {
				$output .= '<li>' . get_the_title() . '</li>';
			}
		}
	} elseif ( is_tag() ) {
		$output .= '<li><a href="' . get_term_link( $queried_object ) . '">' . single_tag_title( '', FALSE ) . '</a></li>';
	} elseif ( is_day() ) {
		$output .= '<li><a href="">' . __( 'Archive for ', 'wp_deeds' ) . get_the_time( 'F jS, Y' ) . '</a></li>';
	} elseif ( is_month() ) {
		$output .= '<li><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . __( 'Archive for ', 'wp_deeds' ) . get_the_time( 'F, Y' ) . '</a></li>';
	} elseif ( is_year() ) {
		$output .= '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . __( 'Archive for ', 'wp_deeds' ) . get_the_time( 'Y' ) . '</a></li>';
	} elseif ( is_author() ) {
		$output .= '<li><a href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '">' . __( 'Archive for ', 'wp_deeds' ) . get_the_author() . '</a></li>';
	} elseif ( is_search() ) {
		$output .= '<li>' . __( 'Search Results for ', 'wp_deeds' ) . get_search_query() . '</li>';
	} elseif ( is_404() ) {
		$output .= '<li>' . __( '404 - Not Found', 'wp_deeds' ) . '</li>';
	} else
		$output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';

	return '<ul class="breadcrumbs">' . $output . '</ul>';
}

function sh_get_messaage() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'get_messaage' ):
		global $wpdb;
		$id = sh_set( $_POST, 'id' );
		$output = '';
		$wpdb->show_errors();
		$table_name = $wpdb->prefix . "prayers";
		$select = $wpdb->get_results( 'select * from ' . $table_name . ' where id=' . $id );
		if ( !$select ) {
			$wpdb->print_error();
		}
		foreach ( $select as $key => $val ):
			$output .='
			<h3>Message From: <strong>' . $val->name . '</strong></h3>
			<h3>Email: <strong>' . $val->email . '</strong></h3>
                <form>
                    <textarea>' . $val->message . '</textarea>
                </form>';
		endforeach;
		echo $output;
		exit;
	endif;
}

add_action( 'wp_ajax_get_messaage', 'sh_get_messaage' );

function sh_send_messaage() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'send_messaage' ):
		global $wpdb;
		$id = sh_set( $_POST, 'id' );
		$output = '';
		$wpdb->show_errors();
		$table_name = $wpdb->prefix . "prayers";
		$select = $wpdb->get_results( 'select * from ' . $table_name . ' where id=' . $id );
		if ( !$select ) {
			$wpdb->print_error();
		}
		foreach ( $select as $key => $val ):
			$output .='
		<div id="masg"></div>
		<div id="ad_url" style="display:none"><?php echo admin_url();?></div>
			<form method="post" class="reply" id="sh_reply_to">
				<h3>Reply To: <strong>' . $val->name . '</strong></h3>
				<input type="email" name="sender" id="sender" value="' . $val->email . '"/>
				<textarea rows="8" id="send_msg_data" name="send_msg_data"></textarea>
				<input type="submit" value="Send" />
				<div class="loaders"><img src="' . SH_URL . 'images/ajax-loader.gif" /></div>
			</form>';
		endforeach;
		?>
		<script>
			jQuery("#sh_reply_to").submit(function () {
				var url2 = document.getElementById('ad_url').innerHTML;
				jQuery(this).find('div.loaders').show();
				var input_data = jQuery('#sh_reply_to').serialize() + "&action=reply_to_person";
				jQuery.ajax({
					type: "POST",
					url: url2 + 'admin-ajax.php',
					data: input_data,
					success: function (msg) {
						jQuery('div.loaders').hide();
						jQuery('div#masg').val('');
						jQuery('div#masg').append(msg);
						if (msg.match('success') != null)
							jQuery('#sh_reply_to').slideUp('slow');
					}
				});
				return false;

			});
		</script>
		<?php
		echo $output;
		exit;
	endif;
}

add_action( 'wp_ajax_send_messaage', 'sh_send_messaage' );

function sh_reply_to_person() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'reply_to_person' ):

		$sender = sh_set( $_POST, 'sender' );
		$msg = sh_set( $_POST, 'send_msg_data' );
		if ( sh_set( $_POST, 'sender' ) ) {
			$contact_to = $sender;
			$headers = 'From: ' . get_bloginfo( "name" ) . ' <' . get_option( 'admin_email' ) . '>' . "\r\n";
			if ( wp_mail( $contact_to, __( 'Response From ' . get_bloginfo( "name" ), 'wp_deeds' ), $msg, $headers ) ) {

				$message = sprintf( __( 'Reply to this person has been sent successfully.', 'wp_deeds' ) );
				echo $message;
				exit;
			} else {
				echo __( 'The message was not sent!', 'wp_deeds' );
				exit;
			}
		}
	endif;
}

add_action( 'wp_ajax_reply_to_person', 'sh_reply_to_person' );

function sh_delete_messaage() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'delete_messaage' ):
		global $wpdb;
		$id = sh_set( $_POST, 'id' );
		$output = '';
		$wpdb->show_errors();
		$table_name = $wpdb->prefix . "prayers";
		$select = $wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $table_name . ' WHERE id=%d', $id ) );
		if ( !$select ) {
			$wpdb->print_error();
		} else {
			echo '1';
		}
		exit;
	endif;
}

add_action( 'wp_ajax_delete_messaage', 'sh_delete_messaage' );

function sh_approve_messaage() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'approve_messaage' ):
		global $wpdb;
		$id = sh_set( $_POST, 'id' );
		$output = '';
		$wpdb->show_errors();
		$table_name = $wpdb->prefix . "prayers";
		$select = $wpdb->query( 'update ' . $table_name . ' set status="approve" WHERE id=' . $id );
		if ( $select == 0 ) {
			echo '<h3>Already Approve</h3>';
		} else {
			echo '<h3>Message has been approve</h3>';
		}
		exit;
	endif;
}

add_action( 'wp_ajax_approve_messaage', 'sh_approve_messaage' );

function sh_get_terms( $arg ) {
	$tax_terms = get_terms( sh_set( $arg, 'type' ) );
	$terms = '';
	if ( !sh_set( $tax_terms, 'errors' ) ) {
		foreach ( $tax_terms as $tax_term ) {
			$terms .= '<a href="' . get_term_link( $tax_term, sh_set( $arg, 'type' ) ) . '" title="' . sprintf( __( "View all posts in %s", 'wp_deeds' ), $tax_term->name ) . '"' . '>' . $tax_term->name . '</a>, ';
		}
	}

	return $terms;
}

//post like dislike
add_action( 'wp_ajax_nopriv_post-like', 'sh_post_like' );
add_action( 'wp_ajax_post-like', 'sh_post_like' );

function sh_post_like() {

	if ( isset( $_POST['post_like'] ) ) {
		// Retrieve user IP address
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];

		// Get voters'IPs for the current post
		$meta_IP = get_post_meta( $post_id, "voted_IP" );
		$voted_IP = $meta_IP;

		if ( !is_array( $voted_IP ) )
			$voted_IP = array();

		// Get votes count for the current post
		$meta_count = get_post_meta( $post_id, "votes_count", true );

		// Use has already voted ?
		if ( !sh_hasAlreadyVoted( $post_id ) ) {
			$voted_IP[$ip] = time();

			// Save IP and increase votes count
			update_post_meta( $post_id, "voted_IP", $voted_IP );
			update_post_meta( $post_id, "votes_count", ++$meta_count );

			// Display count (ie jQuery return value)
			echo $meta_count;
		}
	}
	exit;
}

function sh_hasAlreadyVoted( $post_id ) {
	global $timebeforerevote;

	// Retrieve post votes IPs
	$meta_IP = get_post_meta( $post_id, "voted_IP" );
	$voted_IP = $meta_IP;


	if ( !is_array( $voted_IP ) )
		$voted_IP = array();

	// Retrieve current user IP
	$ip = $_SERVER['REMOTE_ADDR'];
	// If user has already voted
	if ( in_array( $ip, array_keys( $voted_IP ) ) ) {
		$time = $voted_IP[$ip];
		$now = time();

		// Compare between current time and vote time
		if ( round( ($now - $time) / 60 ) > $timebeforerevote )
			return false;

		return true;
	}

	return false;
}

function sh_getPostLikeLink( $post_id ) {
	$vote_count = get_post_meta( $post_id, "votes_count", true );
	$output = '<p class="post-like">';
	if ( sh_hasAlreadyVoted( $post_id ) )
		$output .= ' <span title="' . __( 'I like this article', 'wp_deeds' ) . '" class="like alreadyvoted"></span>';
	else
		$output .= '<a href="#" data-post_id="' . $post_id . '">
                    <span  title="' . __( 'I like this article', 'wp_deeds' ) . '"class="qtip like"></span>
                </a>';
	$output .= '<span class="count">' . $vote_count . ' </span>' . __( ' Likes', 'wp_deeds' ) . '</p>';

	return $output;
}

function sh_custom_excerpt_length( $length ) {
	return 20;
}

add_filter( 'excerpt_length', 'sh_custom_excerpt_length', 999 );

function sah_set_post_view( $postID ) {
	$count_key = 'sh_product_views_count';
	$count = get_post_meta( $postID, $count_key, true );
	$count++;
	update_post_meta( $postID, $count_key, $count );
}

function sh_get_comment() {
	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __( 'No Comments', 'wp_deeds' );
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __( ' Comments', 'wp_deeds' );
		} else {
			$comments = __( '1 Comment', 'wp_deeds' );
		}
		$write_comments = '<a href="' . get_comments_link() . '">' . $comments . '</a>';
	} else {
		$write_comments = __( 'Comments are off for this post.', 'wp_deeds' );
	}
	return $write_comments;
}

add_action( 'wp_ajax_sh_language_uploder', 'sh_language_uploder' );

function sh_language_uploder() {
	if ( isset( $_POST ) ) {

		$folder = SH_URL . 'languages/';
		if ( !isset( $_FILES['data'] ) || !is_uploaded_file( $_FILES['data'] ) ) {
			echo 'Language file is Missing!';
		}
		//printr($_FILES[$_POST['data']]);
		//uploaded file info we need to proceed
		$lang_name = $_POST['lang_file']['name']; //file name
		$lang_size = $_POST['lang_file']['size']; //file size
		$lang_temp = $_POST['lang_file']['tmp_name']; //file temp
		$file_path = $folder . $file_name;
		if ( move_uploaded_file( $lang_temp, $file_path ) ) {
			echo "File uploaded Success !";
		}
		//mime_content_type(
	}

	die();
}

function sh_woo_pages( $page_id ) {
	$pages = array(
		get_option( 'woocommerce_shop_page_id' ),
		get_option( 'woocommerce_cart_page_id' ),
		get_option( 'woocommerce_checkout_page_id' ),
		get_option( 'woocommerce_pay_page_id' ),
		get_option( 'woocommerce_thanks_page_id' ),
		get_option( 'woocommerce_myaccount_page_id' ),
		get_option( 'woocommerce_edit_address_page_id' ),
		get_option( 'woocommerce_view_order_page_id' ),
		get_option( 'woocommerce_terms_page_id' )
	);
	if ( $page_id == 0 )
		return 'false';
	return ( in_array( $page_id, $pages ) ) ? 'true' : 'false';
}

function sh_language_uploader() {
	if ( sh_set( $_POST, 'action' ) && sh_set( $_POST, 'action' ) == 'sh_language_uploader' ) {
		echo '<div class="overlay"></div>
		<div id="upload-wrapper">
		  <div align="center"> <span class="close">X</span>
			<h3>
			 ' . __( 'Upload Language File', 'wp_deeds' ) . '
			</h3>
			<span class="">
				' . __( 'Type allowed: .mo. | Maximum Size 5 MB', 'wp_deeds' ) . '
			</span>
			<div id="sh_language_uploader">
			<form action="' . SH_URL . 'framework/modules/processupload.php" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
			  <input name="lang_file" id="language_input" type="file" />
			  <input type="submit"  id="submit-btn" value="Upload" />
			  <img src="' . SH_URL . 'images/ajaxloader.gif" id="loading-img" alt="Please Wait"/>
			</form>
			<div id="progressbox"><div id="progressbar"></div><div id="statustxt">0%</div></div>
			<div id="output"></div>
			</div>
		  </div>
		</div>
		<script>
			jQuery(document).ready(function($){
				jQuery("#upload-wrapper .close").on("click", function() {
					jQuery("div#language_uploader_output").empty();
					jQuery("div.overlay").hide();
				});
						var progressbox     = $("#progressbox");
						var progressbar     = $("#progressbar");
						var statustxt       = $("#statustxt");
						var completed       = "0%";

						var options = {
								target:   "#output",   // target element(s) to be updated with server response
								beforeSubmit:  beforeSubmit,  // pre-submit callback
								uploadProgress: OnProgress,
								success:       afterSuccess,  // post-submit callback
								resetForm: true        // reset the form after successful submit
							};

						 jQuery("#MyUploadForm").submit(function() {
								jQuery(this).ajaxSubmit(options);
								// return false to prevent standard browser submit and page navigation
								return false;
							});

					//when upload progresses
					function OnProgress(event, position, total, percentComplete)
					{
						//Progress bar
						progressbar.width(percentComplete + "%") //update progressbar percent complete
						statustxt.html(percentComplete + "%"); //update status text
						if(percentComplete>50)
							{
								statustxt.css("color","#fff"); //change status text to white after 50%
							}
					}

					//after succesful upload
					function afterSuccess()
					{
						jQuery("#upload-wrapper").css({
								"height" : "200px !important",
								"margin-top": "-100px !important",
							});
						jQuery("#submit-btn").show(); //hide submit button
						jQuery("#loading-img").hide(); //hide submit button

					}
					//function to check file size before uploading.
					function beforeSubmit(){
						//check whether browser fully supports all File API
					   if (window.File && window.FileReader && window.FileList && window.Blob)
						{

							if( !jQuery("#language_input").val()) //check empty input filed
							{
								jQuery("#output").html("Please Select a .mo file");
								return false
							}

							var fsize = jQuery("#language_input")[0].files[0].size; //get file size
							var ftype = jQuery("#language_input")[0].files[0].name; // get file type
							var extension = ftype.substr( (ftype.lastIndexOf(".") +1) );

							switch(extension)
							{
								case "mo":
									break;
								default:
									jQuery("#output").html("<b>"+ftype+"</b> Unsupported file type!");
									return false
							}

							//Allowed file size is less than 1 MB (1048576)
							if(fsize>1048576)
							{
								jQuery("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
								return false
							}

							//Progress bar

							progressbox.show(); //show progressbar
							progressbar.width(completed); //initial value 0% of progressbar
							statustxt.html(completed); //set status text
							statustxt.css("color","#000"); //initial color of status text


							jQuery("#submit-btn").hide(); //hide submit button
							jQuery("#loading-img").show(); //hide submit button
							jQuery("#output").html("");
						}
						else
						{
							jQuery("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
							return false;
						}
					}

					//function to format bites bit.ly/19yoIPO
					function bytesToSize(bytes) {
					   var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
					   if (bytes == 0) return "0 Bytes";
					   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
					   return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
					}

				});
		</script>';
	}
	exit;
}

add_action( 'wp_ajax_sh_language_uploader', 'sh_language_uploader' );
add_action( 'wp_ajax_nopriv_sh_language_uploader', 'sh_language_uploader' );

if ( in_array( 'bbpress/bbpress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	get_template_part( 'framework/modules/bbpress_fix' );
}

add_action( 'wp_ajax_theme-install-demo-data', 'theme_ajax_install_dummy_data' );

function theme_ajax_install_dummy_data() {
	require_once('framework/helpers/importer.php');
	sh_xml_importer();
	die();
}

function sh_admin_scripts() {
	wp_enqueue_style( 'my_admin_style', SH_URL . 'css/dropdown.css', array(), SH_VERSION, true );
}

add_action( 'wp_ajax_sh_model_popup', 'sh_model_popup' );
add_action( 'wp_ajax_nopriv_sh_model_popup', 'sh_model_popup' );

function sh_model_popup() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'sh_model_popup' ) {
		$options = get_option( 'wp_deeds' . '_theme_options' );
		$popup_title = (sh_set( $options, 'donation_popup_title' )) ? sh_set( $options, 'donation_popup_title' ) : '';
		$popup_sub_title = (sh_set( $options, 'donation_popup_sub_title' )) ? sh_set( $options, 'donation_popup_sub_title' ) : '';
		$symbol = sh_set( $options, 'currency_symbol', '$' );
		$required = sh_set( $options, 'donation_needed' );
		$collected = sh_set( $options, 'donation_collected' );
		$collected_percentage = ($collected) ? ($collected * 100) / $required : '0';
		$donation_periods = (sh_set( $options, 'donation_periods' )) ? sh_set( $options, 'donation_periods' ) : '';
		$dynamic_amount = sh_set( sh_set( $options, 'dynamic_amount' ), 'dynamic_amount' );
		?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="donation-popup">
				<div id="donation_currency" style="display: none"><?php echo esc_html( sh_set( $options, 'currency_code' ) ) ?></div>
				<div class="popup-title">
					<h5><?php echo esc_html( $popup_title ) ?></h5>
					<p><?php echo esc_html( $popup_sub_title ) ?></p>
					<div class="needed-amount">
						<?php if ( $required ): ?>
							<span>
								<i><?php echo $symbol; ?></i>
								<?php
								$req_split = str_split( $required );
								if ( $req_split )
									foreach ( $req_split as $req ):
										?>
										<i><?php echo $req; ?></i>
									<?php endforeach; ?>
							</span>

							<i><?php _e( 'NEEDED DONATION', 'wp_deeds' ); ?></i>
						<?php endif; ?>
					</div>
				</div>
				<div class="popup-content">
					<div class="collected">
						<?php if ( !empty( $donation_periods ) ): ?>
							<div class="periods">
								<ul>
									<?php foreach ( $donation_periods as $period ): ?>
										<li data-value="<?php echo esc_attr( $period ) ?>"><?php echo str_replace( '_', ' ', ucwords( $period ) ) ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
						<div class="percentage">
							<input class="knob" data-width="160" data-fgColor="#3a4c5a" data-bgColor="#dfdfdf" data-thickness=".1" readonly value="<?php echo esc_attr( $collected_percentage ) ?>" />
							<span><?php _e( 'COLLECTED DONATIONS', 'wp_deeds' ) ?></span>
						</div>
						<div class="collected-amount">
							<?php if ( $collected ): ?>
								<span>
									<i><?php echo $symbol; ?></i>
									<?php
									$req_split = str_split( $collected );
									if ( $req_split )
										foreach ( $req_split as $req ):
											?>
											<i><?php echo $req; ?></i>
										<?php endforeach; ?>
								</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="amount-selection">
						<?php if ( !empty( $dynamic_amount ) ): ?>
							<p><?php _e( 'I would like to make a donation in the amount of', 'wp_deeds' ) ?>:</p>
							<div class="row">
								<?php
								foreach ( $dynamic_amount as $amount ):
									if ( sh_set( $amount, 'tocopy' ) )
										break;
									?>
									<div class="col-sm-3">
										<input type="radio" value="<?php echo esc_attr( sh_set( $amount, 'dynamic_donation_amount' ) ) ?>" name="donation_amount" />
										<label><?php echo esc_html( $symbol ) . esc_html( sh_set( $amount, 'dynamic_donation_amount' ) ) ?></label>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<div class="payment-method">

							<div class="payment-choices">
								<?php if ( sh_set( $options, 'paypal_info' ) == 1 ): ?><a data-tab="paypal_tab" class="paypal_tab" href="javascript:void(0)" title=""><?php _e( 'PAYPAL', 'wp_deeds' ); ?></a><?php endif; ?>
								<?php if ( sh_set( $options, 'stripe_info' ) == 1 ): ?><a data-tab="stripe_tab" class="stripe_tab" href="javascript:void(0)" title=""><?php _e( 'STRIPE', 'wp_deeds' ); ?></a><?php endif; ?>
								<?php if ( sh_set( $options, 'checkout2_info' ) == 1 ): ?><a data-tab="checkout2_tab" class="checkout2_tab" href="javascript:void(0)" title=""><?php _e( '2CHECKOUT', 'wp_deeds' ); ?></a><?php endif; ?>
								<?php if ( sh_set( $options, 'braintree_info' ) == 1 ): ?><a data-tab="braintree" class="braintree_tab" href="javascript:void(0)" title=""><?php _e( 'BRAINTREE', 'wp_deeds' ); ?></a><?php endif; ?>
							</div>


							<div class="doner-info">
								<span><?php _e( 'Doner Info', 'wp_deeds' ) ?></span>
								<form>
									<div class="row">
										<div class="col-md-6">
											<input id="donor_name" name="donor_name" type="text" placeholder="<?php _e( 'Name', 'wp_deeds' ) ?>" />
										</div>
										<div class="col-md-6">
											<input id="donor_email" name="donor_email" type="text" placeholder="<?php _e( 'Email', 'wp_deeds' ) ?>" />
										</div>
									</div>
								</form>
							</div>
							<div class="donation_errors" style="display: none"></div>
							<?php if ( sh_set( $options, 'paypal_info' ) == 1 ): ?>
								<div id="paypal_tab" class="doner-info account-info">
									<span><?php _e( 'PayPal Info', 'wp_deeds' ) ?></span>
									<div class="paypal_donation_form">
										<?php
										$settings = get_option( 'wp_deeds' . '_theme_options' );
										$paypal = $GLOBALS['_sh_base']->donation;
										if ( isset( $_GET['recurring_pp_return'] ) && $_GET['recurring_pp_return'] == 'return' ) {
											$paypal_res = require_once( get_template_directory() . '/framework/modules/pp_recurring/review.php' );
										}
										$symbol = sh_set( $settings, 'currency_symbol', '$' );
										$sh_currency_code = sh_set( $settings, 'currency_code', 'USD' );
										$paypal = $GLOBALS['_sh_base']->donation;
										$http = (is_ssl()) ? 'https://' : 'http://';
										echo $paypal->button( array( 'currency_code' => $sh_currency_code, 'item_name' => get_bloginfo( 'name' ), 'amount' => 10, 'return' => $_SERVER['HTTP_REFERER'] ) );
										?>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( sh_set( $options, 'stripe_info' ) == 1 ): ?>
								<div id="stripe_tab" class="doner-info account-info">
									<span><?php _e( 'Stripe Info', 'wp_deeds' ) ?></span>
									<form>
										<div class="row">
											<div class="col-md-12">
												<div class="field">
													<input type="text" name="donation_amout" placeholder="<?php _e( 'Enter Amount Please', 'wp_deeds' ) ?>" />
												</div>
											</div>
											<div class="col-md-8">
												<div class="field">
													<input type="text" placeholder="<?php _e( 'Card Number:', 'wp-appointment' ) ?>" id="stripe_card_no"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="field">
													<input type="text" placeholder="<?php _e( 'Verification Number', 'wp-appointment' ) ?>" id="stripe-verify-num"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="field">
													<select id="stripe-card-expiry-month">
														<?php
														$mnth = range( 1, 12 );
														foreach ( $mnth as $m ):
															echo '<option value="' . $m . '">' . $m . '</option>';
														endforeach;
														?>
													</select>
													<script>
														jQuery(document).ready(function ($) {
															$('select#stripe-card-expiry-month').select2();
														});
													</script>
												</div>
											</div>
											<div class="col-md-6">
												<div class="field">
													<select id="stripe-card-expiry-year">
														<?php
														$year = range( 2015, 2025 );
														foreach ( $year as $y ):
															echo '<option value="' . $y . '">' . $y . '</option>';
														endforeach;
														?>
													</select>
													<script>
														jQuery(document).ready(function ($) {
															$('select#stripe-card-expiry-year').select2();
														});
													</script>
												</div>
											</div>
											<div class="col-md-12">
												<button id="stripe-checkout"><?php _e( 'Donate Now', 'wp-appointment' ) ?></button>
											</div>
										</div>
									</form>
								</div>
							<?php endif; ?>

							<?php if ( sh_set( $options, 'checkout2_info' ) == 1 ): ?>
								<div id="checkout2_tab" class="doner-info account-info">
									<span><?php _e( '2Checkout Info', 'wp_deeds' ) ?></span>
									<form>
										<div class="row">
											<div class="col-md-12">
												<div class="field">
													<input type="text" name="donation_amout" placeholder="<?php _e( 'Enter Amount Please', 'wp_deeds' ) ?>" />
												</div>
											</div>
											<div class="col-md-8">
												<div class="field">
													<input type="text" placeholder="<?php _e( 'Card Number:', 'wp-appointment' ) ?>" id="checkout2_card_no"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="field">
													<input type="text" placeholder="<?php _e( 'Verification Number', 'wp-appointment' ) ?>" id="checkout2-verify-num"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="field">
													<select id="checkout2-card-expiry-month">
														<?php
														$mnth = range( 1, 12 );
														foreach ( $mnth as $m ):
															echo '<option value="' . $m . '">' . $m . '</option>';
														endforeach;
														?>
													</select>
													<script>
														jQuery(document).ready(function ($) {
															$('select#checkout2-card-expiry-month').select2();
														});
													</script>
												</div>
											</div>
											<div class="col-md-6">
												<div class="field">
													<select id="checkout2-card-expiry-year">
														<?php
														$year = range( 2015, 2025 );
														foreach ( $year as $y ):
															echo '<option value="' . $y . '">' . $y . '</option>';
														endforeach;
														?>
													</select>
													<script>
														jQuery(document).ready(function ($) {
															$('select#checkout2-card-expiry-year').select2();
														});
													</script>
												</div>
											</div>
											<div class="col-md-12">
												<button id="checkout2-checkout"><?php _e( 'Donate Now', 'wp-appointment' ) ?></button>
											</div>
										</div>
									</form>
								</div>
							<?php endif; ?>

							<?php if ( sh_set( $options, 'braintree_info' ) == 1 ): ?>
								<div id="braintree" class="doner-info account-info">
									<span><?php _e( 'Braintree Info', 'wp_deeds' ) ?></span>
									<form>
										<div class="row">
											<div class="col-md-12">
												<div class="field">
													<input type="text" name="donation_amout" placeholder="<?php _e( 'Enter Amount Please', 'wp_deeds' ) ?>" />
												</div>
											</div>
											<div class="col-md-8">
												<div class="field">
													<input type="text" placeholder="<?php _e( 'Card Number:', 'wp-appointment' ) ?>" id="braintree_card_no"/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="field">
													<input type="text" placeholder="<?php _e( 'Verification Number', 'wp-appointment' ) ?>" id="braintree-verify-num"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="field">
													<select id="braintree-card-expiry-month">
														<?php
														$mnth = range( 1, 12 );
														foreach ( $mnth as $m ):
															echo '<option value="' . $m . '">' . $m . '</option>';
														endforeach;
														?>
													</select>
													<script>
														jQuery(document).ready(function ($) {
															$('select#braintree-card-expiry-month').select2();
														});
													</script>
												</div>
											</div>
											<div class="col-md-6">
												<div class="field">
													<select id="braintree-card-expiry-year">
														<?php
														$year = range( 2015, 2025 );
														foreach ( $year as $y ):
															echo '<option value="' . $y . '">' . $y . '</option>';
														endforeach;
														?>
													</select>
													<script>
														jQuery(document).ready(function ($) {
															$('select#braintree-card-expiry-year').select2();
														});
													</script>
												</div>
											</div>
											<div class="col-md-12">
												<button id="braintree-checkout"><?php _e( 'Donate Now', 'wp-appointment' ) ?></button>
											</div>
										</div>
									</form>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$(".knob").knob({
					change: function (value) {
					},
					release: function (value) {
						console.log("release : " + value);
					},
					cancel: function () {
						console.log("cancel : ", this);
					},
					draw: function () {
						if (this.$.data('skin') == 'tron') {

							var a = this.angle(this.cv),
									sa = this.startAngle,
									sat = this.startAngle,
									ea,
									eat = sat + a,
									r = 1;
							this.g.lineWidth = this.lineWidth;
							this.o.cursor && (sat = eat - 0.3) && (eat = eat + 0.3);
							if (this.o.displayPrevious) {
								ea = this.startAngle + this.angle(this.v);
								this.o.cursor && (sa = ea - 0.3) && (ea = ea + 0.3);
								this.g.beginPath();
								this.g.strokeStyle = this.pColor;
								this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
								this.g.stroke();
							}
							this.g.beginPath();
							this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
							this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
							this.g.stroke();
							this.g.lineWidth = 2;
							this.g.beginPath();
							this.g.strokeStyle = this.o.fgColor;
							this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
							this.g.stroke();
							return false;
						}
					}
				});
				var v,
						up = 0,
						down = 0,
						i = 0,
						$idir = $("div.idir"),
						$ival = $("div.ival"),
						incr = function () {
							i++;
							$idir.show().html("+").fadeOut();
							$ival.html(i);
						},
						decr = function () {
							i--;
							$idir.show().html("-").fadeOut();
							$ival.html(i);
						};
				$("input.infinite").knob({
					min: 0,
					max: 20,
					stopper: false,
					change: function () {
						if (v > this.cv) {
							if (up) {
								decr();
								up = 0;
							} else {
								up = 1;
								down = 0;
							}
						} else {
							if (v < this.cv) {
								if (down) {
									incr();
									down = 0;
								} else {
									down = 1;
									up = 0;
								}
							}
						}
						v = this.cv;
					}
				});
			});
		</script>
		<?php
	}
	exit;
}

add_action( 'wp_ajax_sh_donation_by_stripe', 'sh_donation_by_stripe' );

function sh_donation_by_stripe() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'sh_donation_by_stripe' ) {
		$result = array();
		$data = $_POST;
		require(SH_ROOT . 'framework/modules/stripe/init.php');
		try {
			$theme_options = get_option( 'wp_deeds' . '_theme_options' );
			\Stripe\Stripe::setApiKey( sh_set( $theme_options, 'stripe_secret_key' ) );
			$charge = \Stripe\Charge::create( array( 'card' => sh_set( $data, 'token' ), 'amount' => bcmul( sh_set( $data, 'amount' ), 100 ), 'currency' => sh_set( $data, 'currency' ) ) );
			if ( $charge->paid == true ) {
				$id = uniqid();
				$info = array(
					'amount' => sh_set( $data, 'amount' ),
					'currency' => sh_set( $data, 'currency' ),
					'token' => sh_set( $data, 'token' ),
					'trans_id' => sh_set( $data, 'trans_id' ),
					'transaction_type' => __( 'Instant', 'wp_deeds' ),
					'payment_type' => 'Strip',
					'time' => current_time( 'mysql' ),
					'fee_amount' => 'none',
					'settle_amount' => '',
					'payment_status' => __( 'Success', 'wp_deeds' ),
					'pending_reason' => '',
				);
				update_option( $id, $info );
				$result['session'] = $id;
				echo json_encode( $result );
			}
		} catch ( \Stripe\Error\Card $e ) {
			echo json_encode( $e->getMessage() );
		}
	}
	exit;
}

add_action( 'wp_ajax_sh_donation_by_braintree', 'sh_donation_by_braintree' );

function sh_donation_by_braintree() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'sh_donation_by_braintree' ) {
		$return = array();
		$data = $_POST;
		require(SH_ROOT . 'framework/modules/braintree/Braintree.php');
		$theme_options = get_option( 'wp_deeds' . '_theme_options' );
		$return = array();
		Braintree\Configuration::environment( sh_set( $theme_options, 'braintree_type' ) );
		Braintree\Configuration::merchantId( sh_set( $theme_options, 'braintree_merchant_id' ) );
		Braintree\Configuration::publicKey( sh_set( $theme_options, 'braintree_private_key' ) );
		Braintree\Configuration::privateKey( sh_set( $theme_options, 'braintree_publishable_key' ) );
		$result = Braintree\Transaction::sale( array(
					'amount' => sh_set( $data, 'amount' ),
					'creditCard' => array(
						'cardholderName' => sh_set( $data, 'donor_name' ),
						'number' => sh_set( $data, 'card_no' ),
						'expirationDate' => sh_set( $data, 'mnth' ) . '/' . sh_set( $data, 'exp_year' ),
						'cvv' => sh_set( $data, 'cvc' ),
					),
					'options' => array( 'submitForSettlement' => true )
				) );
		if ( !empty( $result->success ) ) {
			$id = uniqid();
			$info = array(
				'amount' => $result->transaction->amount,
				'currency' => $result->transaction->currencyIsoCode,
				'token' => $result->transaction->id,
				'trans_id' => $result->transaction->id,
				'type' => __( 'Braintree', 'wp_deeds' ),
				'payment_type' => 'Instant',
				'time' => current_time( 'mysql' ),
				'fee_amount' => 'none',
				'settle_amount' => $result->transaction->amount,
				'payment_status' => $result->transaction->statusHistory[0]->status,
				'pending_reason' => '',
			);
			update_option( $id, $info );
			$return['session'] = $id;
		} else if ( $result->transaction ) {
			$return['msg'] = '<div class = "alert alert-success">' . sprintf( __( "Error processing transaction: code %s and text %s", 'wp-appointment' ), $result->transaction->processorResponseCode, $result->transaction->processorResponseText ) . '</div>';
		} else {
			$return['msg'] = '<div class = "alert alert-danger">' . __( "Validation errors:", 'wp-appointment' ) . $result->message . '</div>';
		}
		echo json_encode( $return );
	}
	exit;
}

add_action( 'wp_ajax_sh_save_donation_data', 'sh_save_donation_data' );

add_action( 'wp_ajax_sh_donation_by_checkout', 'sh_donation_by_checkout' );

function sh_donation_by_checkout() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'sh_donation_by_checkout' ) {
		$return = array();
		$data = $_POST;
		$theme_options = get_option( 'wp_deeds' . '_theme_options' );
		require_once(SH_ROOT . 'framework/modules/2checkout/Twocheckout.php');
		Twocheckout::format( 'json' );
		Twocheckout::privateKey( sh_set( $theme_options, 'checkout2_private_key' ) );
		Twocheckout::sellerId( sh_set( $theme_options, 'checkout2_account_number' ) );
		Twocheckout::verifySSL( false );
		if ( sh_set( $theme_options, 'checkout2_type' ) == 'true' ) {
			Twocheckout::sandbox( true );
		} else {
			Twocheckout::sandbox( false );
		}
		$checkout = array(
			"sellerId" => sh_set( $theme_options, 'account_no' ),
			"merchantOrderId" => uniqid(),
			"token" => sh_set( $data, 'token' ),
			"currency" => sh_set( $data, 'currency' ),
			"total" => sh_set( $data, 'amount' ),
			"billingAddr" => array(
				"name" => "John",
				"addrLine1" => '123 Test St',
				"city" => 'Columbus',
				"state" => 'OH',
				"zipCode" => '43123',
				"country" => 'USA',
				"email" => 'admin@admin.com',
				"phoneNumber" => '123456789'
			),
			"shippingAddr" => array(
				"name" => "John",
				"addrLine1" => '123 Test St',
				"city" => 'Columbus',
				"state" => 'OH',
				"zipCode" => '43123',
				"country" => 'USA',
				"email" => 'admin@admin.com',
				"phoneNumber" => '123456789'
			)
		);
		try {
			$charge = Twocheckout_Charge::auth( $checkout );
			$result = json_decode( $charge );
			if ( sh_set( sh_set( $result, 'response' ), 'responseMsg' ) == 'Successfully authorized the provided credit card' ) {
				$id = uniqid();
				$info = array(
					'amount' => sh_set( $data, 'amount' ),
					'currency' => sh_set( $data, 'currency' ),
					'token' => sh_set( $data, 'token' ),
					'trans_id' => sh_set( sh_set( $result, 'response' ), 'transactionId' ),
					'type' => __( '2Checkout', 'wp_deeds' ),
					'payment_type' => 'Instant',
					'time' => current_time( 'mysql' ),
					'fee_amount' => 'none',
					'settle_amount' => '',
					'payment_status' => 'Authorized',
					'pending_reason' => '',
				);
				update_option( $id, $info );
				$return['session'] = $id;
			}
		} catch ( Twocheckout_Error $e ) {
			$return['msg'] = $e->getMessage();
		}
		echo json_encode( $return );
	}
	exit;
}

function sh_save_donation_data() {
	if ( isset( $_POST['action'] ) && $_POST['action'] == 'sh_save_donation_data' ) {
		$data = $_POST;
		$session_data = get_option( sh_set( $data, 'id' ), true );
		$theme_options = get_option( 'wp_deeds' . '_theme_options' );
		$target_amount = (sh_set( $theme_options, 'donation_collected' )) ? (int) str_replace( ', ', '', sh_set( $theme_options, 'donation_collected' ) ) + sh_set( $session_data, 'amount' ) : '';
		if ( $target_amount > 0 ) {
			$theme_options['donation_collected'] = $target_amount;
		}
		update_option( 'wp_deeds' . '_theme_options', $theme_options );
		$donation_transaction = array();
		$donation_transaction = (get_option( 'general_donation' )) ? get_option( 'general_donation' ) : array();


		array_push( $donation_transaction, array(
			'transaction_id' => sh_set( $session_data, 'trans_id' ),
			'transaction_type' => sh_set( $session_data, 'type' ),
			'payment_type' => sh_set( $session_data, 'payment_type' ),
			'order_time' => sh_set( $session_data, 'time' ),
			'amount' => sh_set( $session_data, 'amount' ),
			'currency_code' => sh_set( $session_data, 'currency' ),
			'fee_amount' => sh_set( $session_data, 'fee_amount' ),
			'settle_amount' => sh_set( $session_data, 'fee_amount' ),
			'payment_status' => sh_set( $session_data, 'payment_status' ),
			'pending_reason' => sh_set( $session_data, 'pending_reason' ),
			'payer_id' => sh_set( $session_data, 'token' ),
			'ship_to_name' => sh_set( $data, 'donor_name' ),
			'donation_type' => 'Single',
		) );
		update_option( 'general_donation', $donation_transaction );
		delete_option( sh_set( $data, 'id' ) );
		echo '<div class = "alert alert-info">' . __( 'Thank you for your payment.', 'wp_deeds' ) . '</div>';
	}
	exit;
}

$paypal = $GLOBALS['_sh_base']->donation;
if ( $notif = $paypal->_paypal->handleNotification() ) {
	$paypal_res = $paypal->single_pament_result( $notif );
}

function donation_box() {
	$paypal = $GLOBALS['_sh_base']->donation;
	echo '<div data-toggle="modal" data-target="#confirmmodal" id="hidden_popup_donation_btn_click"></div>';
	echo '<div class="modal fade" id="confirmmodal" tabindex="-1" role="dialog" aria-labelledby="confirmmodalLabel" aria-hidden="true">';
	if ( isset( $_GET['recurring_pp_return'] ) && $_GET['recurring_pp_return'] == 'return' ) {
		$paypal_res = require_once(get_template_directory() . '/framework/modules/pp_recurring/review.php');
		?>
		<div class="donate-popup"><?php echo $paypal_res ?></div>
		<script>
			jQuery(document).ready(function ($) {
				$('div#hidden_popup_donation_btn_click').trigger("click");
			});
		</script>
		<?php
	}
	echo '</div>';
}

function sh_get_all_menut() {
	$navs = array();
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	if ( count( $menus ) > 0 ) {
		foreach ( $menus as $m ) {
			$navs[] = array( 'value' => $m->term_id, 'label' => $m->name );
		}
	}
	return $navs;
}
function sh_the_content_by_id( $post_id=0, $more_link_text = null, $stripteaser = false ){
    global $post;
    $post = get_post($post_id);
    setup_postdata( $post, $more_link_text, $stripteaser );
    return (get_the_content());
    wp_reset_postdata( $post );
}

add_action('admin_enqueue_scripts', 'sh_admin_scripts_styles');

function sh_admin_scripts_styles(){
    wp_enqueue_style('admin-custom-style', get_template_directory_uri().'/css/admin-custom-style.css', array(), '2.4.2', 'all');
}

add_action('admin_head', 'sh_admin_custom_vars');

function sh_admin_custom_vars()
{
    if( function_exists( 'layerslider' )) $layer_slider_plugin = 'true';
    else $layer_slider_plugin = 'false';
    if(function_exists('vc_map')) $composer_plugin = 'true';
    else $composer_plugin = 'false';
    echo '<script type="text/javascript">var layer_slider_plugin='.$layer_slider_plugin.'; var composer_plugin='.$composer_plugin.';</script>';
}