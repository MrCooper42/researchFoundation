<?php

class SH_Shortcodes {

	protected $keys;
	protected $toggle_count = 0;

	function __construct() {
		$GLOBALS['sh_toggle_count'] = 0;
		add_action( 'init', array( $this, 'add' ) );
	}

	function add() {
		include( SH_FRW_DIR . 'resource/shortcodes.php' );
		$this->keys = array_keys( $options );
		foreach ( $this->keys as $k ) {
			if ( method_exists( $this, $k ) )
				add_shortcode( 'sh_' . $k, array( $this, $k ) );
		}
	}

	function event_calender( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
						), $atts )
		);
		
		include(get_template_directory() . '/framework/modules/shortcodes/event_calender.php');
		return $output;
	}
		
	function services( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
						), $atts )
		);

		$sh_services = 'modren';
		include(get_template_directory() . '/framework/modules/shortcodes/services.php');

		return $output;
	}

	function services_without( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
						), $atts )
		);

		$sh_services = 'without_image';
		include(get_template_directory() . '/framework/modules/shortcodes/services.php');

		return $output;
	}

	function blog_category( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'cat' => '',
						), $atts )
		);

		$blog_type = 'category';
		include(get_template_directory() . '/framework/modules/shortcodes/blog-shortcodes.php');

		return $output;
	}

	function events_carousal( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'order' => '',
			'cat' => '',
			'margins' => '',
						), $atts )
		);

		$event_type = 'carousal';
		include(get_template_directory() . '/framework/modules/shortcodes/events.php');

		return $output;
	}

	function sermons_paralex_slider( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'orderby' => '',
			'order' => '',
						), $atts )
		);

		$sermons = 'parallex';
		include(get_template_directory() . '/framework/modules/shortcodes/sermons.php');
		return $output;
	}

	function our_blog_slider( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'orderby' => '',
			'order' => '',
			'cat' => '',
			'show_readmore'	=>	'',
			'limit'	=> '',
			'slider'	=>	'',
						), $atts )
		);

		$blog_type = 'slider';
		include(get_template_directory() . '/framework/modules/shortcodes/blog-shortcodes.php');

		return $output;
	}

	function latest_sermons( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'orderby' => '',
			'order' => '',
						), $atts )
		);

		$sermons = 'latest';
		include(get_template_directory() . '/framework/modules/shortcodes/sermons.php');

		return $output;
	}

	function sermons_wrapper( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'sermon' => '',
			'overlp' => '',
						), $atts )
		);
		$sermons = 'wrapper';
		include(get_template_directory() . '/framework/modules/shortcodes/sermons.php');

		return $output;
	}

	function news_latest( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'cat' => '',
			'orderby' => '',
			'order' => '',
						), $atts )
		);

		$args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $number,
                    'post_status' => 'publish',
                    'orderby' => $orderby,
                    'order' => $order,
		);
                if(is_numeric($cat)){
                    $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => $cat));
                }
                
		$query = new WP_Query( $args );
                printr($query);
		$output = '';
		if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();

				$output .= '<div class="remove-gap">
						<div class="latest-news">
						   <div class="news">
							<div class="news-date"><span><i class="fa fa-calendar-o"></i> ' . get_the_date( 'd M Y' ) . '</span></div>
							<div class="row">
							 <div class="col-md-7">
							  <h3><a href="' . get_the_permalink() . '" title="">' . get_the_title() . '</a></h3>
                        	  <p>' . substr( strip_tags( get_the_content() ), 0, 100 ) . '</p>
							 </div>
							 <div class="col-md-5 news-img">
							  <div class="image">';
				if ( has_post_thumbnail() ):
					$output .= get_the_post_thumbnail( get_the_id(), array( 270, 270 ) );
					$output .= '<a href="' . get_the_permalink() . '" title=""><i class="fa fa-link"></i></a>';
				endif;
				$output .= '</div>
						   </div>
						 </div>
					   </div>
					  </div>
					</div>';
			endwhile;
		endif;
		wp_reset_query();
		return $output;
	}

	function meet_our_staff( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'orderby' => '',
			'order' => '',
			'cat' => '',
						), $atts )
		);

		include(get_template_directory() . '/framework/modules/shortcodes/team.php');

		return $output;
	}

	function heading( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'sub_title' => '',
			'heading_style' => 'simple',
						), $atts )
		);

		$title_class = ($heading_style == 'underline') ? 'title' : 'title2';
		ob_start();
		?>
		<div class="<?php echo $title_class; ?>">
			<span><?php echo $sub_title; ?></span>
			<h2><?php echo $title; ?></h2>
		</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	function simple_donation( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'vid_link' => '',
			'contents' => '',
			'btn_text' => '',
			'margins' => '',
						), $atts )
		);

		$donation = 'simple';
		include(get_template_directory() . '/framework/modules/shortcodes/donations.php');

		return $output;
	}

	function gallery_masonary( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'column' => '',
			'number' => '',
			'orderby' => '',
			'order' => '',
			'columns' => '',
						), $atts )
		);
		$gallery_type = 'masonary';
		include(get_template_directory() . '/framework/modules/shortcodes/gallery.php');

		return $output;
	}

	function gallery_simple( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'column' => '',
			'number' => '',
			'orderby' => '',
			'order' => '',
			'columns' => '',
						), $atts )
		);

		$gallery_type = 'simple';

		include(get_template_directory() . '/framework/modules/shortcodes/gallery.php');

		return $output;
	}

	function contact_information( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'text' => '',
			'facebook' => '',
			'twitter' => '',
			'gplus' => '',
			'linkedin' => '',
						), $atts )
		);

		$contact_type = 'info';
		include(get_template_directory() . '/framework/modules/shortcodes/contact.php');

		return $output;
	}

	function contact_form( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'margins' => '',
			'email'	=>	'',
                    'secret_key'    =>  '',
                    'site_key' =>   '',
						), $atts )
		);

		$contact_type = 'form';
		include(get_template_directory() . '/framework/modules/shortcodes/contact.php');

		return $output;
	}

	function contact_info_boxes( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'address' => '',
			'phone' => '',
			'website' => '',
			'email' => '',
			'margins' => '',
						), $atts )
		);

		$contact_type = 'boxes';
		include(get_template_directory() . '/framework/modules/shortcodes/contact.php');

		return $output;
	}

	function audio_box( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'sound_values' => '',
						), $atts )
		);

		$values = explode( ',', $sound_values );
		foreach ( $values as $value ) {
			$output.= '<div class="sound-cloud"><iframe width="100%" height="125" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/' . trim( $value, ' ' ) . '&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe></div>';
		}

		return $output;
	}

	function events( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'order' => '',
			'cat' => '',
						), $atts )
		);
		$query_args = array(
			'post_type' => 'cs_events',
			'showposts' => -1,
			'post_status' => 'publish',
		);

                if(is_numeric($cat)){
                    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'slug', 'terms' => $cat));
                }
			
		$query = new WP_Query( $query_args );
                
		if ( $query->have_posts() ): 
			while ( $query->have_posts() ) : $query->the_post();
				$post_ids[get_the_ID()] = sh_set(sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_event_meta', true), 'sh_event_options'), '0'), 'start_date');
			endwhile; wp_reset_postdata();
		endif;

		if(!empty($post_ids) && count($post_ids) > 0){
			if($order == 'ASC'){
				asort($post_ids);
			}elseif($order == 'DESC'){
				arsort($post_ids);
			}
		}
		$cc = 0;
		
		$output = '';
		$output .= '<div class="event-listing">';
		if(!empty($post_ids) && count($post_ids) > 0):
				foreach($post_ids as $k => $v):
				if($cc == $number){
					break;
				}
				$events_meta = sh_set( sh_set( get_post_meta( $k, 'sh_event_meta', true ), 'sh_event_options' ), 0 );
				$time = strtotime( sh_set( $events_meta, 'start_time' ) );
				$new_time = date( 'g:i a', $time );


				$dateTime = new DateTime( sh_set( $events_meta, 'start_date' ) );
				$year = $dateTime->format( 'Y' );
				$month = $dateTime->format( 'M' );
				$day = $dateTime->format( 'd' );
				//printr($events_meta);
				
				$output .= '<div class="event">
							<div class="event-date">
								<span>' . $year . '</span>
								<strong>' . $day . '</strong>
								<i>' . $month . '</i>
							</div>
							<h3><a href="' . get_the_permalink($k) . '" title="' . get_the_title($k) . '">' . get_the_title($k) . '</a></h3>
							<p>' . substr( strip_tags( sh_the_content_by_id($k) ), 0, 90 ) . '</p>
							<span><i class="fa fa-map-marker"></i>' . sh_set( $events_meta, 'location' ) . '</span>
							<span><i class="fa fa-clock-o"></i>' . $new_time . '</span>
						</div>';
	
			$cc++;
			endforeach;
		endif;
		$output .= '</div>';
		return $output;
	}

	function twittes( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'tw_user' => '',
			'number' => '',
						), $atts )
		);

		include( get_template_directory() . '/framework/helpers/class.tweets.php' );
		$output = '';
		$output .='<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>';
		$output = '<div class="latest-tweets">
  						<span><i class="fa fa-twitter"></i></span>
                				<div id="tweet" class="tweets-slides"><span class="tweet-loader">Loading tweets...</span></div>
					</div>';
		$output .='<script type="text/javascript">
					jQuery(document).ready(function($){
						var tweets =';
		$output .= GetTweets::get_most_recent( $tw_user, $number, "true" );
		$output .= ';display_tweets(tweets);

						$(".tweets-slides").owlCarousel({
							autoPlay: 7000,
							slideSpeed:1000,
							singleItem : true,
							transitionStyle : "fadeUp",
							navigation : false
						}); /*** TWEETS CAROUSEL ***/
					});
					</script>';

		return $output;
	}

	function daily_news( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '2',
			'orderby' => 'date',
			'order' => 'ASC',
			'cat' => '',
						), $atts )
		);
		$query_args = array(
                    'post_type' => 'post',
                    'showposts' => $number,
                    'post_status' => 'publish',
                    'orderby' => $orderby,
                    'order' => $order,
		);
                
                if(is_numeric($cat)){
                    $query_args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $query_args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => $cat));
                }
                
		$output = '';
		$query = new WP_Query( $query_args );
                
		$output .= '<div class="latest-news-carousel">';
		if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();

				$output .= '<div class="news-carousel">
							<div class="news-image">';
				if ( has_post_thumbnail() ) : $output .= get_the_post_thumbnail( get_the_id(), 'full' );
				endif;
				$output .= '<div class="news-details">
									<span class="address"><i class="fa fa-calendar-o"></i> ' . get_the_date() . '</span>
									<span><i class="fa fa-user"></i> ' . ucwords( get_the_author() ) . '</span>
									<span><i class="fa fa-folder-open"></i> ';
				foreach ( get_the_category() as $category ) {
					$output .= '<a href="' . get_category_link( $category->cat_ID ) . '">' . $category->name . '</a>';
				}
				$output .=' </span>
								</div>
							</div>
							<h4 class="new-title"><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h4>
						</div>';

			endwhile;
		endif;
		wp_reset_query();
		$output .= '</div>';

		$output .= '<script>
						jQuery(document).ready(function($) {

							$(".latest-news-carousel").owlCarousel({
								autoPlay: 5000,
								slideSpeed:1000,
								singleItem : true,
								transitionStyle : "fadeUp",
								navigation : true
							}); /*** CAROUSEL ***/
						});
					</script>';

		return $output;
	}

	function blog_listing( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '2',
			'orderby' => 'date',
			'order' => 'ASC',
			'cat' => '',
						), $atts )
		);

		$query_args = array(
                    'post_type' => 'post',
                    'showposts' => $number,
                    'post_status' => 'publish',
                    'orderby' => $orderby,
                    'order' => $order,
		);
                
                if(is_numeric($cat)){
                    $query_args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $query_args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => $cat));
                }

		$output = '';
		$query = new WP_Query( $query_args );
		$output .= '<div class="blog-listing">';
		if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
				$output .= '<div class="blog-list">
							<a href="' . get_the_permalink() . '" title="">';
				if ( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array( 80, 80 ) );
				endif;
				$output .= '<h3><a href="' . get_the_permalink() . '" title="">' . get_the_title() . '</a></h3>
							<ul>
								<li><i class="fa fa-tag"></i>';
				$tags = get_the_tags();
				$count = 0;
				if ( $tags ):
					foreach ( $tags as $tag ) {
						$count++;
						if ( 1 == $count || 2 == $count ) {
							$output .= $tag->name . ' / ';
						}
					}
				endif;
				$output .= '</li><li><i class="fa fa-calendar-o"></i> ' . get_the_date( 'M d' ) . '</li>
							</ul>
						</div>';
			endwhile;
		endif;
		wp_reset_query();
		$blog = get_option( 'page_for_posts' );
		$output .= '<a title="" href="' . get_page_link( $blog ) . '"><i class="fa fa-angle-double-right"></i></a>';
		$output .= '</div">';

		return $output;
	}

	function about_us( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'desc' => '',
			'gallery' => '',
						), $atts )
		);
		$output = '';
		$output .='<div class="about">
					<div class="col-md-6 column">
						<h4><i class="fa fa-bank"></i>' . $title . '</h4>
						<p>' . rawurldecode( base64_decode( $desc ) ) . '</p>
						<ul class="nav nav-tabs" id="myTab">';
		$coutner = 1;
		$images = explode( ',', $gallery );
		foreach ( $images as $img ):
			$imag = wp_get_attachment_image_src( $img, 'full' );

			$exp = explode( '.', $imag[0] );
			$ext = array_pop( $exp );
			$imgage = implode( '.', $exp );

			$output .= '<li class="col-md-4';
			if ( 1 == $coutner ): $output.=' active';
			endif;
			$output .= '"><a data-toggle="tab" href="#image' . $coutner++ . '"><img src="' . $imgage . '-370x230.' . $ext . '" alt="" /></a></li>';
		endforeach;
		$output .='</ul>
					</div>
					<div class="col-md-6 column">
						<div class="tab-content" id="myTabContent">';
		$counter = 1;
		$images = explode( ',', $gallery );
		foreach ( $images as $img ):
			$imag = wp_get_attachment_image_src( $img, '570x345' );

			$exp = explode( '.', $imag[0] );
			$ext = array_pop( $exp );
			$imgage = implode( '.', $exp );

			$output .= '<div id="image' . $counter++ . '" class="tab-pane fade';
			if ( 2 == $counter ): $output.=' in active';
			endif;
			$output .= ' ">';
			$output .= '<img src="' . $imgage . '.' . $ext . '" alt="" />';
			$output .= '</div>';
		endforeach;
		$output .= '</div>
					</div>
				</div>';
		return $output;
	}

	function church_stories( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '2',
			'orderby' => 'date',
			'order' => 'ASC',
			'cat' => '',
						), $atts )
		);

		$query_args = array(
                    'post_type' => 'cs_church',
                    'showposts' => $number,
                    'post_status' => 'publish',
                    'orderby' => $orderby,
                    'order' => $order,
		);

                if(is_numeric($cat)){
                    $query_args['tax_query'] = array(array('taxonomy' => 'church_category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $query_args['tax_query'] = array(array('taxonomy' => 'church_category', 'field' => 'slug', 'terms' => $cat));
                }
		
		$query = new WP_Query( $query_args );
		$output = '';
		$output .= '<div class="remove-ext">';
		if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
				$church_meta = get_post_meta( get_the_ID(), 'sh_church_meta', true );
				$output .= '<div class="col-md-6">
							<div class="story">
								<div class="image">';
				if ( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array( 370, 164 ) );
				endif;
				$output .= '<a href="' . get_the_permalink() . '" title=""><i class="fa fa-link"></i></a>
								</div>
								<div class="story-detail">
									<span class="date"><i class="fa fa-calendar-o"></i> ' . get_the_date() . '</span>
									<h3><a href="' . get_the_permalink() . '" title="">' . get_the_title() . '</a></h3>
									<span><i class="fa fa-user"></i> ' . sh_set( $church_meta, 'author' ) . '</span>
								</div>
							</div>
						</div>';

			endwhile;
		endif;
		wp_reset_query();
		$output .= '</div>';
		return $output;
	}

	function up_event_with_video( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'heading' => '',
			'sub_heading' => '',
			'vimeo' => '',
			'event_id'=>'',
						), $atts )
		);

		$output = '';
		$output .= '<div class="upcoming-event">';

				$events_meta = sh_set( sh_set( get_post_meta( $event_id, 'sh_event_meta', true ), 'sh_event_options' ), 0 );

				$time = strtotime( sh_set( $events_meta, 'start_time' ) );
				$new_time = date( 'g:i a', $time );

				$date = strtotime( sh_set( $events_meta, 'start_date' ) );

				$c_t = date( 'H:i:s', $time );
				$c_d = date( 'm/d/Y', $date );

				if ( $vimeo != '' ) {
					$class = 'col-md-6';
				} else {
					$class = 'col-md-12';
				}
				$output .= '<div class="row">
							<div class="' . $class . ' column">
								<h3><i class="fa fa-bank"></i> ' . get_the_title($event_id) . '</h3>
								<span><i class="fa fa-calendar-o"></i> ' . date( 'M d, Y', $date ) . '</span>
								<span><i class="fa fa-clock-o"></i> ' . $c_t . '</span>
								<p>' . substr( strip_tags( sh_the_content_by_id($event_id) ), 0, 150 ) . '</p>

								<div class="remaining-time">
									<div class="col-md-6 column">
										<h5>' . $heading . '</h5>
										<span>' . $sub_heading . '</span>
									</div>
									<div class="col-md-6 timing column">
										<ul class="countdown">
											<li> <span class="days">00</span>
											<p class="days_ref">DAYS</p>
											</li>
											<li> <span class="hours">00</span>
											<p class="hours_ref">HOURS</p>
											</li>
											<li> <span class="minutes">00</span>
											<p class="minutes_ref">MINTS</p>
											</li>
											<li> <span class="seconds">00</span>
											<p class="seconds_ref">SECS</p>
											</li>
										</ul>
									</div>
								</div>
							</div>';
				if ( $vimeo ):
					$output .= '<div class="col-md-6 column">
									<iframe src="http://player.vimeo.com/video/' . $vimeo . '?title=0&amp;byline=0&amp;portrait=0" height="280" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									</div>';

		endif;
		$output .= '</div>';
		$opt = get_option( 'wp_deeds' . '_theme_options' );
		$timezone = explode( ' ', sh_set( $opt, 'time_zone' ), 2 );

		$output .= '<script>
				 				jQuery(document).ready(function($) {
									new_counter( ".countdown", "' . $c_d . ' ' . $c_t . '", ' . sh_set( $timezone, '0' ) . ');
								});
							</script>';
		return $output;
	}

	function up_event_with_counter( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'type' => '',
			'order' => 'ASC',
			'cat' => '',
						), $atts )
		);
		
		$post_ids = array();
		
		$query_args = array(
			'post_type' => 'cs_events',
			'posts_per_page' => -1,
			'post_status' => 'publish',
		);
		
                if(is_numeric($cat)){
                    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'slug', 'terms' => $cat));
                }
                
		$query = new WP_Query( $query_args );

		if ( $query->have_posts() ): 
			while ( $query->have_posts() ) : $query->the_post();
				$post_ids[get_the_ID()] = sh_set(sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_event_meta', true), 'sh_event_options'), '0'), 'start_date');
			endwhile; wp_reset_postdata();
		endif;
	
		if(!empty($post_ids) && count($post_ids) > 0){
			if($order == 'ASC'){
				asort($post_ids);
			}elseif($order == 'DESC'){
				arsort($post_ids);
			}
		}
		
		

		$output = '';
		$output .= '<div class="counter-events">';
		$output .= '<div class="row">';
		if ( $type == 'Carousel' ): $output .= '<div class="event-carousel">';
		endif;
		$counter = 1;
		$counter2 = 1;
		$cc = 0;
		
		if(!empty($post_ids) && count($post_ids) > 0):
				foreach($post_ids as $k => $v):
				if($cc == $number){
					break;
				}
				$events_meta = sh_set( sh_set( get_post_meta( $k, 'sh_event_meta', true ), 'sh_event_options' ), 0 );
				$time = strtotime( sh_set( $events_meta, 'start_time' ) );
				$new_time = date( 'g:i a', $time );
				$date = strtotime( sh_set( $events_meta, 'start_date' ) );
				$c_t = date( 'H:i:s', $time );
				$c_d = date( 'm/d/Y', $date );
				
				if ( $type == 'Simple' ): 
					$output .= '<div class="col-md-4">';
				endif;

				$output .='<div class="event-count">
							<div class="event-img">';
				if ( has_post_thumbnail($k) ):  
					$output .= get_the_post_thumbnail( $k, array( 370, 230 ) );
				endif;
				$output .= '<div class="downcount">
									<i class="fa fa-clock-o"></i>
									<ul class="countdown' . $counter . '">
										<li> <span class="days">00</span>
										<p class="days_ref">DAYS</p>
										</li>
										<li> <span class="hours">00</span>
										<p class="hours_ref">HOURS</p>
										</li>
										<li> <span class="minutes">00</span>
										<p class="minutes_ref">MINTS</p>
										</li>
										<li> <span class="seconds">00</span>
										<p class="seconds_ref">SECS</p>
										</li>
									</ul>
								</div>
							</div>
							<h4><a href="' . get_the_permalink($k) . '" title="">' . get_the_title($k) . '</a></h4>
						</div>';
				$opt = get_option( 'wp_deeds' . '_theme_options' );
				$timezone = explode( ' ', sh_set( $opt, 'time_zone' ), 2 );
				if ( $type == 'Simple' ): 
					$output .='<script type="text/javascript">
									jQuery(document).ready(function($) {
										new_counter(".countdown' . $counter . '", "' . $c_d . ' ' . $c_t . '", ' . sh_set( $timezone, '0' ) . ');
									});
								</script>';
				endif;
				if ( $type == 'Simple' ): 
					$output .= '</div>';
				endif;
				$counter++;
				$cc++;
			endforeach;
		endif;
		wp_reset_query();

		$output .= '</div></div>';
		if ( $type == 'Carousel' ): $output .= '</div>';
		endif;

		if ( $type == 'Carousel' ):
			$counter2 = 1;
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$events_meta = sh_set( sh_set( get_post_meta( get_the_ID(), 'sh_event_meta', true ), 'sh_event_options' ), 0 );

					$time = strtotime( sh_set( $events_meta, 'start_time' ) );
					$new_time = date( 'g:i a', $time );

					$date = strtotime( sh_set( $events_meta, 'start_date' ) );

					$c_t = date( 'g:i:s', $time );
					$c_d = date( 'm/d/Y', $date );

					$opt = get_option( 'wp_deeds' . '_theme_options' );
					$timezone = explode( ' ', sh_set( $opt, 'time_zone' ), 2 );

					$output .='<script type="text/javascript">
			 				jQuery(document).ready(function($){
								new_counter(".countdown' . $counter2++ . '", "' . $c_d . ' ' . $c_t . '", ' . sh_set( $timezone, '0' ) . ');
							});
						</script>';
				endwhile;
			endif;
			wp_reset_query();
		endif;


		if ( $type == 'Carousel' ):
			$output .= "
				<script type='text/javascript'>
					jQuery(document).ready(function($) {
						var col = $('div.event-carousel').parent('div').parent('div').parent('div').attr('class');
						if( col == 'col-md-12 column ' || col == 'col-md-11 column ' ){
								$('.event-carousel').owlCarousel({
									autoPlay: false,
									rewindSpeed : 3000,
									slideSpeed:2000,
									items : 3,
									itemsDesktop : [1199,3],
									itemsDesktopSmall : [979,2],
									itemsTablet : [768,2],
									itemsMobile : [479,1],
									navigation : false,
								});
						}
						else if( col == 'col-md-10 column ' || col == 'col-md-9 column ' || col == 'col-md-8 column ' ){
								$('.event-carousel').owlCarousel({
										autoPlay: false,
										rewindSpeed : 3000,
										slideSpeed:2000,
										items : 3,
										itemsDesktop : [1199,3],
										itemsDesktopSmall : [979,2],
										itemsTablet : [768,2],
										itemsMobile : [479,1],
										navigation : false,
									});
						}
						else if( col == 'col-md-6 column ' || col == 'col-md-4 column ' ){
								$('.event-carousel').owlCarousel({
										autoPlay: false,
										rewindSpeed : 3000,
										slideSpeed:2000,
										items : 2,
										itemsDesktop : [1199,2],
										itemsDesktopSmall : [979,2],
										itemsTablet : [768,2],
										itemsMobile : [479,1],
										navigation : false,
									});
						}
						else if( col == 'col-md-3 column' || col == 'col-md-2 column ' || col == 'col-md-1 column ' ){
								$('.event-carousel').owlCarousel({
										autoPlay: false,
										rewindSpeed : 3000,
										slideSpeed:2000,
										items : 1,
										itemsDesktop : [1199,1],
										itemsDesktopSmall : [979,1],
										itemsTablet : [768,1],
										itemsMobile : [479,1],
										navigation : false,
									});
						}
					});
				</script>";
		endif;


		return $output;
	}

	function button( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'text' => 'button',
			'btn_style' => 'gray',
			'inverse' => '',
			'btn_link' => '#',
						), $atts )
		);
		$output = '';
		if ( $inverse == 'true' ): $inv = 'inverse';
		else: $inv = '';
		endif;
		$output .= '<div class="buttons"><a href="' . $btn_link . '" class="theme-btn ' . $btn_style . ' ' . $inv . '" title="">' . $text . '</a></div>';

		return $output;
	}

	function welcome_msg( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'wel_title' => '',
			'wel_msg' => '',
			'btn_txt' => '',
			'btn_link' => '#',
						), $atts )
		);

		$output = '';
		$ext = explode( ' ', $wel_title, 2 );
		$output .= '<div class="welcome">
						<h1>' . sh_set( $ext, '0' ) . ' <span>' . sh_set( $ext, '1' ) . '</span></h1>
						<p>' . rawurldecode( base64_decode( $wel_msg ) ) . '</p>';
		if ( $btn_txt ): $output .= '<a href="' . $btn_link . '" title="">' . $btn_txt . '</a>';
		endif;
		$output .='</div>';

		return $output;
	}

	function pastors_msg( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '2',
                        'carousel' => false,
						), $atts )
		);
                
		$output = '';
		$pastors = get_option( 'wp_deeds' . '_theme_options' );
		$get_pastor = sh_set( $pastors, 'dynamic_pastors' );

		//printr($get_pastor);
		$output .= '<div class="pastors-carousel">';
		$counter = 0;
		if ( $get_pastor ) {
			foreach ( $get_pastor as $pastor ) {
				foreach ( $pastor as $pas ) {
					$output .= '<div class="pastors-message">
								<div class="col-md-3">
									<img src="' . sh_set( $pas, 'pastor_img' ) . '" alt="" />
								</div>
								<div class="col-md-9">
									<h4>' . sh_set( $pas, 'pastor_name' ) . '</h4>
									<span>' . sh_set( $pas, 'pastor_design' ) . '</span>
									<p>' . sh_set( $pas, 'pastor_msg' ) . '</p>
									<ul class="sermon-media lightbox">
										<li><a href="http://vimeo.com/' . sh_set( $pas, 'pastor_vimeo' ) . '" data-poptrox="vimeo" title=""><i class="fa fa-film"></i></a></li>
										<li><a title=""><i class="audio-btn fa fa-headphones"></i>
											<div class="audioplayer"><audio id="player2" src="' . sh_set( $pas, 'pastor_audio' ) . '"></audio><span class="cross">X</span></div>
										</a></li>
										<li><a target="_blank" href="' . sh_set( $pas, 'pastor_pdf' ) . '" title=""><i class="fa fa-download"></i></a></li>
										<li><a target="_blank" href="' . sh_set( $pas, 'pastor_pdf_view' ) . '" title=""><i class="fa fa-book"></i></a></li>
									</ul>
								</div>
							</div>';
					$counter++;
					if ( $number == $counter ): break;
					endif;
				}
			}
		}
		$output .= '</div>';
                if($carousel != true){
		$output .= '
			<script>
				jQuery(window).load(function() {
                                jQuery("div.pastors-carousel").parent().parent().parent().parent().removeClass("block");
					jQuery(".pastors-carousel").owlCarousel({
						autoPlay: 5000,
						slideSpeed:1000,
						singleItem : true,
						transitionStyle : "goDown",
						navigation : false
					}); /*** CAROUSEL ***/

				});


				</script>';
                }
		return $output;
	}

	function products_listing( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => __( 'Products', 'wp_deeds' ),
			'sub_title' => '',
			'number' => '4',
			'orderby' => 'date',
			'order' => 'ASC',
			'cat' => '',
			'cols' => '4',
						), $atts ) );


		$query_args = array(
			'showposts' => $number,
			'post_status' => 'publish',
			'post_type' => 'product',
			'orderby' => $orderby,
			'order' => $order
		);

		if ($cat){
                    if(is_numeric($cat)){
                        $query_args['tax_query'] = array( array( 'taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => (int)$cat ) );
                    }else{
                        $query_args['tax_query'] = array( array( 'taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => $cat ) );
                    }
                }

		$prods = new WP_Query( $query_args );
		$output = '';
		include( get_template_directory() . '/framework/modules/products.php');
		wp_reset_query();

		return $output;
	}

	function give_us_donation( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'rotating_title' => '',
			'main_text' => '',
			'title' => '',
			'tagline' => '',
			'text' => '',
			'links' => '',
			'detail_link' => '',
			'donate_btn_text' => '',
			'detail_link_text' => '',
			'detail_link_anchor' => '',
						), $atts )
		);
		$donation = 'parallax';
		include(get_template_directory() . '/framework/modules/shortcodes/give_us_donation.php');

		return $output;
	}

	function donation_box( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'heading' => '',
			'sub_heading' => '',
						), $atts )
		);

		include(get_template_directory() . '/framework/modules/shortcodes/donation_box.php');

		return $output;
	}

	function accordian_block( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'desc' => '',
						), $atts )
		);

		$output = '';
		$output .=' <div id="toggle">
						' . do_shortcode( $content ) . '
					</div>';

		return $output;
	}

	function accordian( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'acc_content' => '',
						), $atts )
		);

		$output = '';

		$output .= '<div class="toggle-item">
            	<h2><i class="fa fa-arrow-circle-right"></i>' . $title . '</h2>
            	<div class="content">
                	<p>' . $acc_content . '</p>
            	</div>
           </div>';

		return $output;
	}

	function blockqoute( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'block_cont' => '',
			'blockqoute_bg' => '',
						), $atts )
		);

		$output = '';
		$output .= '<blockquote>';
		if ( $blockqoute_bg ):
			$img = wp_get_attachment_image_src( $blockqoute_bg, 'full' );
			$output .= '<div class="parallax" style="background:url(' . $img[0] . ');"></div>';
		endif;
		$output .= '<i class="fa fa-quote-left"></i>' . $block_cont . '<i class="fa fa-quote-right"></i></blockquote>';

		return $output;
	}

	function church( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'ch_title' => '',
			'ch_txt' => '',
			'ch_p_title' => '',
			'ch_p_txt' => '',
			'ch_m_title' => '',
			'ch_m_text' => '',
			'ch_email' => '',
						), $atts )
		);

		include(get_template_directory() . '/framework/modules/shortcodes/church_form.php');
		return $output;
	}

	function newsletter_paralex( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'newlatter_link' => '',
			'sh_ns_media' => '',
						), $atts )
		);
		$output = '';
		$options = get_option( 'wp_deeds' . '_theme_options' );
		$social_media = sh_set( sh_set( $options, 'social_media' ), 'social_media' );
		$output .= '<form class="newsletter-signup" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onSubmit="window.open("http://feedburner.google.com/fb/a/mailverify?uri=' . $newlatter_link . '", "popupwindow", "scrollbars=yes,width=550,height=520");return true">

						  <input type="text" placeholder="youremail@domain.com" name="email" autocomplete="off" >
						  <input type="hidden" value="' . $newlatter_link . '" name="uri"/>
						  <input type="hidden" name="loc" value="en_US"/>
						  <input type="submit" value="Subscribe" />

						</form>';
		if ( $sh_ns_media == 'true' ):
			$output .= '<div class="social-corner">
						<p>' . __( 'Think people should hear about this?', 'wp_deeds' ) . '</p>
						<ul class="social-media">';
			if ( is_array( $social_media ) ):
				foreach ( (array) $social_media as $social ):
					if ( sh_set( $social, 'tocopy' ) )
						continue;
					$icon = sh_set( $social, 'social_icon' );
					$output .= '<li>
												<a title="" href="' . sh_set( $social, 'social_link' ) . '">
													<i class="fa ' . $icon . '"></i>
												</a>
											</li>';
				endforeach;
			endif;
			$output .= '</ul>
					</div>';
		endif;
		return $output;
	}

	function ministry_tabs( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'cat1' => '',
			'cat2' => '',
			'cat3' => '',
			'cat4' => '',
			'tab1' => '',
			'tab2' => '',
			'tab3' => '',
			'tab4' => '',
						), $atts )
		);
		$output = '';
		$output .= '<div class="tab-style">
						<ul class="nav nav-tabs" id="myTab2">';
		if ( $tab1 != "" ):
			$query_args = array(
				'post_type' => 'cs_ministry',
				'showposts' => 1,
				'post_status' => 'publish',
			);
                        if(is_numeric($cat1)){
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'term_id', 'terms' => (int) $cat1));
                        }else{
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'slug', 'terms' => $cat1));
                        }
			
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$output .= '<li class="col-md-3 active"><a data-toggle="tab" href="#' . strtolower( str_replace( ' ', '_', $tab1 ) ) . '">' . $tab1 . '</a></li>';
				endwhile;
			endif;
			wp_reset_query();
		endif;

		if ( $tab2 != "" ):
			$query_args = array(
				'post_type' => 'cs_ministry',
				'showposts' => 1,
				'post_status' => 'publish',
			);
                
                        if(is_numeric($cat2)){
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'term_id', 'terms' => (int) $cat2));
                        }else{
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'slug', 'terms' => $cat2));
                        }
                        
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$output .= '<li class="col-md-3"><a data-toggle="tab" href="#' . strtolower( str_replace( ' ', '_', $tab2 ) ) . '">' . $tab2 . '</a></li>';
				endwhile;
			endif;
			wp_reset_query();
		endif;

		if ( $tab3 != "" ):
			$query_args = array(
				'post_type' => 'cs_ministry',
				'showposts' => 1,
				'post_status' => 'publish',
			);
                
                        if(is_numeric($cat3)){
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'term_id', 'terms' => (int) $cat3));
                        }else{
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'slug', 'terms' => $cat3));
                        }
			
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$output .= '<li class="col-md-3"><a data-toggle="tab" href="#' . strtolower( str_replace( ' ', '_', $tab3 ) ) . '">' . $tab3 . '</a></li>';
				endwhile;
			endif;
			wp_reset_query();
		endif;

		if ( $tab4 != "" ):
			$query_args = array(
				'post_type' => 'cs_ministry',
				'showposts' => 1,
				'post_status' => 'publish',
			);
                
                        if(is_numeric($cat4)){
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'term_id', 'terms' => (int) $cat4));
                        }else{
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'slug', 'terms' => $cat4));
                        }
			
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$output .= '<li class="col-md-3"><a data-toggle="tab" href="#' . strtolower( str_replace( ' ', '_', $tab4 ) ) . '">' . $tab4 . '</a></li>';
				endwhile;
			endif;
			wp_reset_query();
		endif;

		$output .= '</ul>
						<div class="tab-content" id="myTabContent2">';
		if ( $tab1 != "" ):
			$query_args = array(
				'post_type' => 'cs_ministry',
				'showposts' => 1,
				'post_status' => 'publish',
			);
                        if(is_numeric($cat1)){
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'term_id', 'terms' => (int) $cat1));
                        }else{
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'slug', 'terms' => $cat1));
                        }
			
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$output .= '<div id="' . strtolower( str_replace( ' ', '_', $tab1 ) ) . '" class="tab-pane fade active in">
										<div class="row">
											<div class="col-md-8">
												<h4>' . get_the_title() . '</h4>
												<p>' . substr( get_the_content(), 0, 400 ) . '</p>
											</div>
											<div class="col-md-4">';
					if ( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array( 270, 270 ) );
					endif;
					$output .= '</div>
										</div>
									</div>';
				endwhile;
			endif;
			wp_reset_query();
		endif;

		if ( $tab2 != "" ):
			$query_args = array(
				'post_type' => 'cs_ministry',
				'showposts' => 1,
				'post_status' => 'publish',
			);
                        if(is_numeric($cat2)){
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'term_id', 'terms' => (int) $cat2));
                        }else{
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'slug', 'terms' => $cat2));
                        }
                        
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$output .= '<div id="' . strtolower( str_replace( ' ', '_', $tab2 ) ) . '" class="tab-pane fade">
										<div class="row">
											<div class="col-md-8">
												<h4>' . get_the_title() . '</h4>
												<p>' . substr( get_the_content(), 0, 400 ) . '</p>
											</div>
											<div class="col-md-4">';
					if ( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array( 270, 270 ) );
					endif;
					$output .= '</div>
										</div>
									</div>';
				endwhile;
			endif;
			wp_reset_query();
		endif;


		if ( $tab3 != "" ):
			$query_args = array(
				'post_type' => 'cs_ministry',
				'showposts' => 1,
				'post_status' => 'publish',
			);
                        
                        if(is_numeric($cat3)){
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'term_id', 'terms' => (int) $cat3));
                        }else{
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'slug', 'terms' => $cat3));
                        }
                        
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$output .= '<div id="' . strtolower( str_replace( ' ', '_', $tab3 ) ) . '" class="tab-pane fade">
										<div class="row">
											<div class="col-md-8">
												<h4>' . get_the_title() . '</h4>
												<p>' . substr( get_the_content(), 0, 400 ) . '</p>
											</div>
											<div class="col-md-4">';
					if ( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array( 270, 270 ) );
					endif;
					$output .= '</div>
										</div>
									</div>';
				endwhile;
			endif;
			wp_reset_query();
		endif;


		if ( $tab4 != "" ):
			$query_args = array(
                            'post_type' => 'cs_ministry',
                            'showposts' => 1,
                            'post_status' => 'publish',
			);
                        if(is_numeric($cat4)){
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'term_id', 'terms' => (int) $cat4));
                        }else{
                            $query_args['tax_query'] = array(array('taxonomy' => 'ministry_category', 'field' => 'slug', 'terms' => $cat4));
                        }
			
			$query = new WP_Query( $query_args );
			if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post();
					$output .= '<div id="' . strtolower( str_replace( ' ', '_', $tab4 ) ) . '" class="tab-pane fade">
										<div class="row">
											<div class="col-md-8">
												<h4>' . get_the_title() . '</h4>
												<p>' . substr( get_the_content(), 0, 400 ) . '</p>
											</div>
											<div class="col-md-4">';
					if ( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array( 270, 270 ) );
					endif;
					$output .= '</div>
										</div>
									</div>';
				endwhile;
			endif;
			wp_reset_query();
		endif;

		$output .= '</div></div>';
		return $output;
	}

	function events_carousel( $atts, $content = null ) {
		extract( shortcode_atts( array(
                    'bc_number' => '',
                    'cat' => '',
                    'order' => '',
                                            ), $atts )
		);
                
		$query_args = array(
                    'post_type' => 'cs_events',
                    'showposts' => -1,
                    'post_status' => 'publish',
		);
		$post_ids = array();
		
                if(is_numeric($cat)){
                    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'slug', 'terms' => $cat));
                }
                
		$query = new WP_Query( $query_args );

		if ( $query->have_posts() ): 
			while ( $query->have_posts() ) : $query->the_post();
				$post_ids[get_the_ID()] = sh_set(sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_event_meta', true), 'sh_event_options'), '0'), 'start_date');
			endwhile; wp_reset_postdata();
		endif;
		if(!empty($post_ids) && count($post_ids) > 0){
			if($order == 'ASC'){
				asort($post_ids);
			}elseif($order == 'DESC'){
				arsort($post_ids);
			}
		}
		$cc = 0;		

		$output = '';
		$output .= '<div class="fullwidth-carousel">';
		if(!empty($post_ids) && count($post_ids) > 0):
				foreach($post_ids as $k => $v): 
				if($cc == $bc_number){
					break;
				}
		
				$events_meta = sh_set( sh_set( get_post_meta( $k, 'sh_event_meta', true ), 'sh_event_options' ), 0 );
				$output .= '<div class="carousel-item">';
				if ( has_post_thumbnail($k) ): $output .= get_the_post_thumbnail($k, array( 341, 470 ) );
				endif;
				$output .='<div class="item-detail">
								<h3><a href="' . get_the_permalink($k) . '" title="">' . get_the_title($k) . '</a></h3>
								<div class="round-icon">
									<i class="fa fa-send"></i>
								</div>
								<ul>
									<li><i class="fa fa-map-marker"></i>  ' . sh_set( $events_meta, 'location' ) . '</li>
								</ul>
								<a href="' . get_the_permalink($k) . '" title="">' . __( 'READ MORE', 'wp_deeds' ) . '</a>
							</div>
						</div>';
			endforeach;
		endif;
		
		$output .= "</div>
				<script type='text/javascript'>
					jQuery(document).ready(function($) {
						$('.fullwidth-carousel').parent().parent().parent().addClass('expand');
						$('.fullwidth-carousel').owlCarousel({
							autoPlay: false,
							rewindSpeed : 3000,
							slideSpeed:2000,
							items : 4,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [979,2],
							itemsTablet : [768,2],
							itemsMobile : [479,1],
							navigation : false,
						});

					});
				</script>";
		return $output;
	}

	function church_story_carousel( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'bc_number' => '',
			'cat' => '',
			'orderby' => '',
			'order' => '',
						), $atts )
		);

		$query_args = array(
			'post_type' => 'cs_church',
			'showposts' => $bc_number,
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
		);
                
                if(is_numeric($cat)){
                    $query_args['tax_query'] = array(array('taxonomy' => 'church_category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $query_args['tax_query'] = array(array('taxonomy' => 'church_category', 'field' => 'slug', 'terms' => $cat));
                }
		
		$query = new WP_Query( $query_args );

		$output = '';
		$output .= '<div class="fullwidth-carousel">';
		if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
				$output .= '<div class="carousel-item">';
				if ( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array( 341, 470 ) );
				endif;
				$output .='<div class="item-detail">
								<h3><a href="' . get_the_permalink() . '" title="">' . get_the_title() . '</a></h3>
								<ul>
									<li><i class="fa fa-calendar-o"></i> ' . get_the_date( 'd m Y' ) . '</li>
									<li><i class="fa fa-user"></i> <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"></a>' . get_the_author_meta( 'display_name' ) . '</li>
								</ul>
								<p>' . substr( get_the_content(), 0, 150 ) . '</p>
								<a href="' . get_the_permalink() . '" title="">' . __( 'READ MORE', 'wp_deeds' ) . '</a>
							</div>
						</div>';
			endwhile;
		endif;
		wp_reset_query();
		$output .= "</div>
				<script type='text/javascript'>
					jQuery(document).ready(function($) {
						$('.fullwidth-carousel').parent().parent().parent().addClass('expand').parent().addClass('no-padding');
						$('.fullwidth-carousel').owlCarousel({
							autoPlay: false,
							rewindSpeed : 3000,
							slideSpeed:2000,
							items : 4,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [979,2],
							itemsTablet : [768,2],
							itemsMobile : [479,1],
							navigation : false,
						});

					});
				</script>";
		return $output;
	}

	function survey_box_paralex( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'sb_box_title' => '',
						), $atts )
		);

		$survey = get_option( 'wp_deeds' . '_theme_options ' );
		$output = '';
		$output .= '<div class="row">
						<div class="col-md-8 column">
							<div class="welcome">
								<h1><i class="fa fa-recycle"></i> ' . sh_set( $survey, 'survey_title' ) . '</h1>
								<p>' . sh_set( $survey, 'survey_description' ) . '</p>';
		if ( sh_set( $survey, 'btn_text' ) ): $output .= '<a title="" href="' . sh_set( $survey, 'btn_link' ) . '">' . sh_set( $survey, 'btn_text' ) . '</a>';
		endif;
		$output .='			</div>
						</div>
						<div class="col-md-4 column">
							<div class="survey">
								<h3>' . $sb_box_title . '</h3>
								<div class="needed">
									<span><i class="' . sh_set( $survey, 'servey_amnt_box_icn' ) . '"></i></span>
									<h5>$ ' . sh_set( $survey, 'servey_box_ammount' ) . '</h5>
									<h6>' . __( 'NEEDED EVERY YEAR', 'wp_deeds' ) . '</h6>
								</div>
								<div class="survey-report">
									<span><i class="' . sh_set( $survey, 'servey_spent_box_icn' ) . '"></i></span>
									<h5>' . sh_set( $survey, 'servey_spent' ) . '</h5>
									<h6>' . __( 'SPENT', 'wp_deeds' ) . '</h6>
								</div>
								<div class="survey-report">
									<span><i class="' . sh_set( $survey, 'servey_project_box_icn' ) . '"></i></span>
									<h5>' . sh_set( $survey, 'servey_project' ) . '</h5>
									<h6>' . __( 'PROJECTS', 'wp_deeds' ) . '</h6>
								</div>
							</div>
						</div>
					</div>';

		return $output;
	}

	function blog_masonry( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'bc_number' => '',
			'cat' => '',
			'orderby' => '',
			'order' => '',
			'showmore_button'	=>	'',
			'showmore_button_text'	=>	'',
						), $atts )
		);

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $bc_number,
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'suppress_filters' => 0,
		);
                
                if(is_numeric($cat)){
                    $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => (int) $cat));
                }else{
                    $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => $cat));
                }

		$output = '';
		query_posts( $args );
		$output .= '<div class="row"><div class="masonary-blog">';
		$number = 0;
		if ( have_posts() ): while ( have_posts() ): the_post();
				if ( $number % 2 == 0 ) {
					$size = '370x230';
				} else {
					$size = '370x403';
				}
				$output .= '<div class="col-md-4">
						<div class="simple-blog">
							<div class="image">';
				if ( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), '370x230' );
				endif;
				$output .='<a href="' . get_the_permalink() . '" title=""><i class="fa fa-link"></i></a>
							</div>
							<h4><a href="' . get_the_permalink() . '" title="">' . get_the_title() . '</a></h4>
							<p>' . substr( get_the_content(), 0, 130 ) . '</p>
							<span>
								<a class="blog-date" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title=""><i class="fa fa-calendar-o"></i> ' . get_the_date( 'd m Y' ) . '</a>
								<a class="blog-more" href="' . get_the_permalink() . '" title="">READ MORE <i class="fa fa-long-arrow-right"></i></a>
							</span>
						</div>
					</div>';
				$number++;
			endwhile;
		endif;
		$button_text = ($showmore_button_text) ? $showmore_button_text : "";
		wp_reset_query();
		$output .= '</div></div>';
		
		if( $showmore_button == "true" ) :
			$output .= '<a class="button3" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title="">' . $button_text . '</a>';
		endif;
		
		$output .= '<script>
					jQuery(document).ready(function(){
						jQuery(function(){
							var $portfolio = jQuery(".masonary-blog");
							$portfolio.isotope({
							masonry: {
							  columnWidth: 1
							}
							});
						});
					});
				</script>';
				
		return $output;
	}

	function our_deals( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'deal_title' => '',
			'sb_desc' => '',
			'sb_lft_img' => '',
			'sb_right_img' => '',
			'deal_btn_title' => '',
						), $atts )
		);
		$output = '';
		$lft_img = wp_get_attachment_image_src( $sb_lft_img, 'medium' );
		$right_img = wp_get_attachment_image_src( $sb_right_img, 'medium' );
		$con = explode( ' ', $deal_title, 2 );
		$output .= '<div class="top-adds">
						<div class="row">
							<div class="col-md-3">
								<div class="add">
									<img src="' . $lft_img[0] . '" alt="" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="online-store">
									<h4>' . sh_set( $con, '0' ) . ' <span>' . sh_set( $con, '1' ) . '</span></h4>
									<p>' . $sb_desc . '</p>';
		if ( $deal_btn_title ):
			$output .= '<a class="button3" href="' . $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ) . '" title="">' . $deal_btn_title . '</a>';
		endif;
		$output .='		</div>
							</div>
							<div class="col-md-3">
								<div class="add">
									<img src="' . $right_img[0] . '" alt="" />
								</div>
							</div>
						</div>
					</div>';
		return $output;
	}

	function product_sale( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'popular_number' => '',
			'recent_number' => '',
			'featured_number' => '',
						), $atts )
		);
		$output = '';

		$args1 = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $recent_number,
			'orderby' => 'date',
			'order' => 'DESC',
			'suppress_filters' => 0
		);
		$show_all_query = new WP_Query( $args1 );

		$args2 = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'meta_key' => '_featured',
			'meta_value' => 'yes',
			'posts_per_page' => $featured_number,
			'orderby' => 'date',
			'order' => 'DESC',
			'suppress_filters' => 0
		);
		$featured_query = new WP_Query( $args2 );

		$args3 = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'meta_key' => 'sh_product_views_count',
			'orderby' => 'meta_value_num',
			'posts_per_page' => $popular_number,
			'order' => 'DESC',
			'suppress_filters' => 0
		);
		$popular_query = new WP_Query( $args3 );

		$output .= '<div class="row"><section id="options">
						<div class="option-combo">
							<ul id="filter" class="option-set" data-option-key="filter">
								<li><a href="#show-all" data-option-value="*" class="selected"> ' . __( 'Show All', 'wp_deeds' ) . '</a></li>
								<li><a href="#popular" data-option-value=".popular"> ' . __( 'Popular', 'wp_deeds' ) . '</a></li>
								<li><a href="#recent" data-option-value=".recent"> ' . __( 'Recent', 'wp_deeds' ) . '</a></li>
								<li><a href="#featured" data-option-value=".featured"> ' . __( 'Featured', 'wp_deeds' ) . '</a></li>
							</ul>
						</div>
					</section>';

		$output .= '<div class="masonary-product">';

		if ( $show_all_query->have_posts() ) :
			while ( $show_all_query->have_posts() ) : $show_all_query->the_post();
				global $product, $woocommerce_loop, $post;
				$output .= '<div id="show-all" class="col-md-3 recent">';
				$product_meta = get_post_meta( $post->ID, 'sh_product_meta', true );
				$output .= '<div class="product">';
				if ( has_post_thumbnail() ) {
					$output .= get_the_post_thumbnail( $post->ID, '370x230' );
				} else {
					$output .= woocommerce_placeholder_img( '270x201' );
				}
				$output .= '<i>' . sh_set( $product_meta, 'product_sub_title' ) . '</i>
								<h3><a href="' . get_the_permalink() . '" title="">' . get_the_title() . '</a></h3>
								<div class="product-bottom">';
				if ( $price_html = $product->get_price_html() ) :
					$output .= $price_html;
				endif;
				$add_to_cart = '';
				if ( $product->is_purchasable() && $product->is_in_stock() ) {
					if ( get_option( 'woocommerce_enable_ajax_add_to_cart' ) == 'yes' ) {
						$add_to_cart = 'add_to_cart_button ajax_add_to_cart';
					} else {
						$add_to_cart = 'add_to_cart_button';
					}
				}
				$output .= apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s"><i class="fa fa-shopping-cart"></i>%s</a>', esc_url( $product->add_to_cart_url() ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), $add_to_cart, esc_attr( $product->product_type ), esc_html( $product->add_to_cart_text() )
						), $product );
				$output .='		</div>
							</div>
					</div>';
			endwhile;
		endif;
		wp_reset_query();
		wp_reset_postdata();

		if ( $popular_query->have_posts() ) :
			while ( $popular_query->have_posts() ) : $popular_query->the_post();
				global $product, $woocommerce_loop, $post;
				$output .= '<div id="show-all" class="col-md-3 popular">';
				$product_meta = get_post_meta( $post->ID, 'sh_product_meta', true );
				$output .= '<div class="product">';
				if ( has_post_thumbnail() ) {
					$output .= get_the_post_thumbnail( $post->ID, '370x230' );
				} else {
					$output .= woocommerce_placeholder_img( '270x201' );
				}
				$output .= '<i>' . sh_set( $product_meta, 'product_sub_title' ) . '</i>
								<h3><a href="' . get_the_permalink() . '" title="">' . get_the_title() . '</a></h3>
								<div class="product-bottom">';
				if ( $price_html = $product->get_price_html() ) :
					$output .= $price_html;
				endif;
				$add_to_cart = '';
				if ( $product->is_purchasable() && $product->is_in_stock() ) {
					if ( get_option( 'woocommerce_enable_ajax_add_to_cart' ) == 'yes' ) {
						$add_to_cart = 'add_to_cart_button ajax_add_to_cart';
					} else {
						$add_to_cart = 'add_to_cart_button';
					}
				}
				$output .= apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s"><i class="fa fa-shopping-cart"></i>%s</a>', esc_url( $product->add_to_cart_url() ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), $add_to_cart, esc_attr( $product->product_type ), esc_html( $product->add_to_cart_text() )
						), $product );
				$output .='		</div>
							</div>
					</div>';
			endwhile;
		endif;
		wp_reset_query();
		wp_reset_postdata();

		if ( $featured_query->have_posts() ) :
			while ( $featured_query->have_posts() ) : $featured_query->the_post();
				global $product, $woocommerce_loop, $post;
				$output .= '<div id="featured" class="col-md-3 featured">';
				$product_meta = get_post_meta( $post->ID, 'sh_product_meta', true );
				$output .= '<div class="product">';
				if ( has_post_thumbnail() ) {
					$output .= get_the_post_thumbnail( $post->ID, '370x230' );
				} else {
					$output .= woocommerce_placeholder_img( '270x201' );
				}
				$output .= '<i>' . sh_set( $product_meta, 'product_sub_title' ) . '</i>
								<h3><a href="' . get_the_permalink() . '" title="">' . get_the_title() . '</a></h3>
								<div class="product-bottom">';
				if ( $price_html = $product->get_price_html() ) :
					$output .= $price_html;
				endif;
				$add_to_cart = '';
				if ( $product->is_purchasable() && $product->is_in_stock() ) {
					if ( get_option( 'woocommerce_enable_ajax_add_to_cart' ) == 'yes' ) {
						$add_to_cart = 'add_to_cart_button ajax_add_to_cart';
					} else {
						$add_to_cart = 'add_to_cart_button';
					}
				}
				$output .= apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s"><i class="fa fa-shopping-cart"></i>%s</a>', esc_url( $product->add_to_cart_url() ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), $add_to_cart, esc_attr( $product->product_type ), esc_html( $product->add_to_cart_text() )
						), $product );
				$output .='		</div>
							</div>
					</div>';
			endwhile;
		endif;
		wp_reset_query();
		wp_reset_postdata();


		$output .= '</div>';
		return $output;
	}

	function partners( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'partner_number' => '',
						), $atts )
		);
		$output = '';

		$options = get_option( 'wp_deeds' . '_theme_options' );
		$partners = sh_set( sh_set( $options, 'dynamic_partners' ), 'dynamic_partners' );
		//printr($partners);

		$number = 0;
		$output .= '<div class="partners">';
		foreach ( $partners as $key => $val ) {
			if ( sh_set( $val, 'tocopy' ) and $partner_number == $number )
				break;
			if ( 3 == $number || 6 == $number || 9 == $number ) {
				$output .= '</div><div class="partners">';
			}
			$output .= '<div id=' . $number . ' class="col-md-4">
							<div class="single-partner">
								<a href="' . sh_set( $val, 'partner_link' ) . '" title=""><img src="' . sh_set( $val, 'partner_img' ) . '" alt="" /></a>
							</div>
						</div>';
			$number++;
		}
		return $output;
	}

	function sconic_services( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'columns' => '',
						), $atts )
		);

		$sh_services = 'sconic_services';
		include(get_template_directory() . '/framework/modules/shortcodes/services.php');
		return $output;
	}

	function iconic_donation_box( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'country' => '',
			'btn_txt' => 'Donate Now',
			'overlap' => '',
						), $atts )
		);
		$donation = '';
		include(get_template_directory() . '/framework/modules/shortcodes/donation_model.php');
		return $output;
	}

	function event_carousel_date( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'number' => '',
			'order' => '',
			'cat' => '',
			'margins' => '',
						), $atts )
		);

		$event_type = 'carousal_date';
		include(get_template_directory() . '/framework/modules/shortcodes/events.php');

		return $output;
	}

	function donation_bar( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
			'btn_txt' => 'Donate Now',
						), $atts )
		);
		$donation = 'donation_bar';
		include(get_template_directory() . '/framework/modules/shortcodes/donation_model.php');
		return $output;
	}

}
