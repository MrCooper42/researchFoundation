<?php

/** A function to fetch the categories from wordpress */

function get_video_host($url) {
	$host = explode('.', str_replace('www.', '', strtolower(parse_url($url, PHP_URL_HOST))));
	$host = isset($host[0]) ? $host[0] : $host;
	return $host;
}
function sh_vd_details($url) {
        $host = explode('.', str_replace('www.', '', strtolower(parse_url($url, PHP_URL_HOST))));
        $host = isset($host[0]) ? $host[0] : $host;
		//printr($host);
        $videos = array();
        switch ($host) {
            case 'vimeo':
                $video_id = substr(parse_url($url, PHP_URL_PATH), 1);
                $get_details = wp_remote_get("http://vimeo.com/api/v2/video/{$video_id}.json");
                $hash = json_decode(sh_set($get_details, 'body'));
                return array(
                    'provider' => 'Vimeo',
                    'title' => $hash[0]->title,
                    'description' => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash[0]->description),
                    'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, $hash[0]->description),
                    'thumbnail' => $hash[0]->thumbnail_large,
                    'video' => "https://player.vimeo.com/video/" . $hash[0]->id,
                    'embed_video' => 'src="https://player.vimeo.com/video/' . $hash[0]->id . '"',
                );
                break;

            case 'youtube':
                preg_match("/v=([^&#]*)/", parse_url($url, PHP_URL_QUERY), $video_id);
                $video_id = $video_id[1];
                $hash = '';
                $get_details = wp_remote_get("http://gdata.youtube.com/feeds/api/videos/{$video_id}?v=2&alt=jsonc");
                $hash = json_decode(
				sh_set($get_details, 'body'));
                if ($hash != '') {
                    return array(
                        'provider' => 'YouTube',
                        'title' => $hash->data->title,
                        'description' => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash->data->description),
                        'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, nl2br($hash->data->description)),
                        'thumbnail' => $hash->data->thumbnail->hqDefault,
                        'video' => "http://www.youtube.com/watch?v=" . $hash->data->id,
                        'embed_video' => 'src="https://www.youtube.com/embed/' . $video_id . '"',
                    );
                } else {
                    return array(
                        'embed_video' => 'src="https://www.youtube.com/embed/' . $video_id . '"',
                    );
                }
                break;
            case 'dailymotion':
                preg_match("/video\/([^_]+)/", $url, $video_id);
                $video_id = $video_id[1];
                $get_details = wp_remote_get("https://api.dailymotion.com/video/$video_id?fields=title,thumbnail_url,owner%2Cdescription%2Cduration%2Cembed_html%2Cembed_url%2Cid%2Crating%2Ctags%2Cviews_total");
                $hash = json_decode(sh_set($get_details, 'body'));
                return array(
                    'provider' => 'Dailymotion',
                    'title' => $hash->title,
                    'description' => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash->description),
                    'thumbnail' => $hash->thumbnail_url,
                    'embed_video' => 'src="https://www.dailymotion.com/embed/video/' . $video_id . '"',
                );
                break;
        }
    }


function product_cat() {
    global $wpdb;
    $wpdb->show_errors();
    $prefix = $wpdb->prefix;
    $cat_name = $wpdb->get_results('select term_id from ' . $prefix . 'term_taxonomy where taxonomy="product_cat"');
    $result = array();
    foreach ($cat_name as $key => $value):
        $get_listing = $wpdb->get_results('select * from ' . $prefix . 'terms where term_id=' . $value->term_id);
        foreach ($get_listing as $key => $value):
            $result[$value->slug] = $value->name;
        endforeach;
    endforeach;
    return $result;
}

function sh_get_categories($arg = false, $slug = false) {

    global $wp_taxonomies;
    if (!empty($arg['taxonomy']) && !isset($wp_taxonomies[$arg['taxonomy']])) {
        register_taxonomy($arg['taxonomy'], $arg['taxonomy']);
    }
    $cats = array();
    $categories = get_categories($arg);

    foreach ($categories as $category) {
        if($slug==false){
            $cats[$category->term_id] = $category->name;
        }else{
           $cats[$category->slug] = $category->name; 
        }
    }
    return $cats;
}

function sh_get_services() {
    $theme_options = get_option('wp_deeds' . '_theme_options');
    $services = sh_set(sh_set($theme_options, 'dynamic_services'), 'dynamic_services');
    $service = array();
    if ($services):
        array_pop($services);
        foreach ($services as $key => $value):
            $service[$key] = sh_set($value, 'service_title');
        endforeach;
    endif;
    return $service;
}

/* function sh_get_categories($arg = false, $slug = false)
  {
  global $wp_taxonomies;

  if( ! empty($arg['taxonomy']) && ! isset($wp_taxonomies[$arg['taxonomy']]))
  {
  register_taxonomy( $arg['taxonomy'], isset($arg['post_type']));
  }

  $categories = get_categories($arg);
  $cats = array();

  if( is_wp_error( $categories ) ) return array(''=>'All');

  if( sh_set( $arg, 'show_all' ) ) $cats[''] = __('All Categories', 'wp_deeds');

  foreach($categories as $category)
  {
  $key = ($slug ) ? $category->slug : $category->term_id;
  $cats[$key] = $category->name;
  }
  //exit('ssss');
  return $cats;
  } */

function sh_excerpt($pos, $limit = 127) {
    $string = is_object($pos) ? do_shortcode(sh_set($pos, 'post_content')) : $pos;

    return sh_character_limit($limit, strip_tags($string));
}

function sh_get_sidebars($multi = false) {
    global $wp_registered_sidebars;

    $sidebars = !($wp_registered_sidebars) ? get_option('wp_registered_sidebars') : $wp_registered_sidebars;

    if ($multi)
        $data[] = array('value' => '', 'label' => __('No Sidebar', 'wp_deeds'));
    else
        $data = array('' => __('No Sidebar', 'wp_deeds'));

    foreach ((array) $sidebars as $sidebar) {
        if ($multi)
            $data[] = array('value' => sh_set($sidebar, 'id'), 'label' => sh_set($sidebar, 'name'));
        else
            $data[sh_set($sidebar, 'id')] = sh_set($sidebar, 'name');
    }
    return $data;
}

if (!function_exists('character_limiter')) {

    function character_limiter($str, $n = 500, $end_char = '&#8230;', $allowed_tags = false) {
        if ($allowed_tags)
            $str = strip_tags($str, $allowed_tags);
        if (strlen($str) < $n)
            return $str;
        $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n)
            return $str;

        $out = "";
        foreach (explode(' ', trim($str)) as $val) {
            $out .= $val . ' ';

            if (strlen($out) >= $n) {
                $out = trim($out);
                return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
            }
        }
    }

}

function get_social_icons() {
    $t = $GLOBALS['_sh_base'];
    $options = $t->alloption('wp_bistro'); //printr($options);
    $icons = array('facebook' => __('Like us on Facebook', 'wp_deeds'), 'twitter' => __('Follow us on Twitter', 'wp_deeds'), 'google-plus' => __('Circle Us on Google Plus', 'wp_deeds'), 'linkedin' => __('Follow us on Linkedin', 'wp_deeds'), 'xing' => __('Follow us on Xing', 'wp_deeds'), 'pinterest' => __('Follow us on Pinterest', 'wp_deeds'));
    if ($options):
        ?>
        <ul class="social">
            <?php foreach ($icons as $i => $str): ?>
                <?php
                if (sh_set($str, 'tocopy'))
                    continue;
                if ($url = sh_set($options, $i)):
                    ?>
                    <li><a href="<?php echo $url; ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $str; ?>"><i class="icon-<?php echo $i; ?>"></i></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php
    endif;
}

function _sh_star_rating($dis = false) {
    $ip = $_SERVER['REMOTE_ADDR'];

    $meta = get_post_meta(get_the_id(), '_download_rating', true);

    $count = count($meta) ? count($meta) : 1;

    $titles = array(__('Poor', 'wp_deeds'), __('Satisfactory', 'wp_deeds'), __('Good', 'wp_deeds'), __('Better', 'wp_deeds'), __('Awesome', 'wp_deeds'));

    $evg = array_sum((array) $meta) / $count;

    if ($dis) {
        foreach (array_reverse(range(0, 4)) as $rang) {
            $checked = ( ( $rang + 1 ) <= round($evg) ) ? 'fa-star' : 'fa-star-o';
            echo '<i class="fa ' . $checked . '" title="' . $titles[$rang] . '" data-post-id="' . get_the_ID() . '"/></i>' . "\n";
        }
    } else {
        $disabled = isset($meta[$ip]) ? ' disabled="disabled"' : '';
        echo '<div class="clearfix center">' . "\n";
        foreach (range(0, 4) as $rang) {
            $checked = ( ( $rang + 1 ) == round($evg) ) ? ' checked="checked"' : '';
            echo '<input class="download-star" type="radio" name="download-2-rating-1"' . $disabled . $checked . ' value="' . ( $rang + 1 ) . '" title="' . $titles[$rang] . '" data-post-id="' . get_the_ID() . '"/>' . "\n";
        }
        echo '</div>' . "\n";
        printf(__('Average Rating %s', 'wp_deeds'), $evg);
    }
}

function sh_get_posts_array($post_type = 'post', $vp = false) {
    global $wpdb;

    $res = $wpdb->get_results("SELECT `ID`, `post_title` FROM `" . $wpdb->prefix . "posts` WHERE `post_type` = '" . $post_type . "' AND `post_status` = 'publish' ", ARRAY_A);
    $return = array();
    if ($vp)
        foreach ($res as $r)
            $return[] = array('value' => sh_set($r, 'ID'), 'label' => sh_set($r, 'post_title'));
    else
        foreach ($res as $r)
            $return[sh_set($r, 'ID')] = sh_set($r, 'post_title');

    return $return;
}

/**
 * Return an ID of an attachment by searching the database with the file URL.
 *
 * First checks to see if the $url is pointing to a file that exists in
 * the wp-content directory. If so, then we search the database for a
 * partial match consisting of the remaining path AFTER the wp-content
 * directory. Finally, if a match is found the attachment ID will be
 * returned.
 *
 * @return {int} $attachment
 */
function sh_get_attachment_id_by_url($url) {

// Split the $url into two parts with the wp-content directory as the separator.
    $parse_url = explode(parse_url(WP_CONTENT_URL, PHP_URL_PATH), $url);

// Get the host of the current site and the host of the $url, ignoring www.
    $this_host = str_ireplace('www.', '', parse_url(home_url(), PHP_URL_HOST));
    $file_host = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));

// Return nothing if there aren't any $url parts or if the current host and $url host do not match.
    if (!isset($parse_url[1]) || empty($parse_url[1]) || ( $this_host != $file_host ))
        return;

// Now we're going to quickly search the DB for any attachment GUID with a partial path match.
// Example: /uploads/2013/05/test-image.jpg
    global $wpdb;

    $prefix = $wpdb->prefix;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts WHERE guid RLIKE %s;", $parse_url[1]));

// Returns null if no attachment is found.
    return sh_set($attachment, 0);
}

if (!function_exists('bistro_slug')) {

    function bistro_slug($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}

/* function sh_get_the_breadcrumb()
  {
  global $_webnukes;
  $queried_object = get_queried_object();

  $breadcrumb = '';

  if ( ! is_home())
  {
  $breadcrumb .= '<li><a href="'.home_url().'">'.__('Home', 'wp_deeds').'</a></li>';

  /** If category or single post
  if(is_category())
  {
  $breadcrumb .= '<li><a href="'.get_category_link(get_query_var('cat')).'">'.single_cat_title('', FALSE).'</a></li>';
  }
  elseif(is_tax())
  {
  $breadcrumb .= '<li><a href="'.get_term_link($queried_object).'">'.$queried_object->name.'</a></li>';
  }
  elseif(is_page()) /** If WP pages
  {
  global $post;
  if($post->post_parent)
  {
  $anc = get_post_ancestors($post->ID);
  foreach($anc as $ancestor)
  {
  $breadcrumb .= '<li><a href="'.get_permalink($ancestor).'">'.get_the_title($ancestor).'</a></li>';
  }
  $breadcrumb .= '<li>'.get_the_title($post->ID).'</li>';

  }else $breadcrumb .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
  }
  elseif (is_singular())
  {
  if($category = wp_get_object_terms(get_the_ID(), array('category', 'wpsc_product_category', 'portfolio_category')))
  {
  if( !is_wp_error($category) )
  {
  $breadcrumb .= '<li><a href="'.get_term_link(sh_set($category, '0')).'">'.sh_set( sh_set($category, '0'), 'name').'</a></li>';
  $breadcrumb .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
  }
  }else{
  $breadcrumb .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
  }
  }
  elseif(is_tag()) $breadcrumb .= '<li><a href="'.get_term_link($queried_object).'">'.single_tag_title('', FALSE).'</a></li>'; /**If tag template
  elseif(is_day()) $breadcrumb .= '<li><a href="">'.__('Archive for ', 'wp_deeds').get_the_time('F jS, Y').'</a></li>'; /** If daily Archives
  elseif(is_month()) $breadcrumb .= '<li><a href="' .get_month_link(get_the_time('Y'), get_the_time('m')) .'">'.__('Archive for ', 'wp_deeds').get_the_time('F, Y').'</a></li>'; /** If montly Archives
  elseif(is_year()) $breadcrumb .= '<li><a href="'.get_year_link(get_the_time('Y')).'">'.__('Archive for ', 'wp_deeds').get_the_time('Y').'</a></li>'; /** If year Archives
  elseif(is_author()) $breadcrumb .= '<li><a href="'. esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) .'">'.__('Archive for ', 'wp_deeds').get_the_author().'</a></li>'; /** If author Archives
  elseif(is_search()) $breadcrumb .= '<li>'.__('Search Results for ', 'wp_deeds').get_search_query().'</li>'; /** if search template
  elseif(is_404()) $breadcrumb .= '<li>'.__('404 - Not Found', 'wp_deeds').'</li>'; /** if search template
  else $breadcrumb .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>'; /** Default value
  }

  return '<ul>'.$breadcrumb.'</ul>';
  }
 */

function sh_register_user($data) {
//printr($data);
    $user_name = sh_set($data, 'user_login');
    $user_email = sh_set($data, 'user_email');
    $user_pass = sh_set($data, 'user_password');
    $policy = sh_set($data, 'policy_agreed');

    $user_id = username_exists($user_name);
    $message = '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>' . __('You must agreed the policy', 'wp_deeds') . '</h5></div>';
    ;
    if (!$policy)
        $message = '';
    if (!$user_id && email_exists($user_email) == false) {

        if ($policy) {

            $random_password = ( $user_pass ) ? $user_pass : wp_generate_password($length = 12, $include_standard_special_chars = false);
            $user_id = wp_create_user($user_name, $random_password, $user_email);
            if (is_wp_error($user_id) && is_array($user_id->get_error_messages())) {
                foreach ($user_id->get_error_messages() as $message)
                    $message .= '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>' . $message . '</h5></div>';
            } else
                $message = '<div class="alert-success" style="margin-bottom:10px;padding:10px"><h5>' . __('Registration Successful - An email is sent', 'wp_deeds') . '</h5></div>';
        }
    } else {
        $message .= '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>' . __('Username or email already exists.  Password inherited.', 'wp_deeds') . '</h5></div>';
    }

    return $message;
}

function sh_comments_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li>

        <div id="comment-<?php comment_ID(); ?>" class="comment">

            <?php
            /** check if this comment author not have approved comments befor this */
            if ($comment->comment_approved == '0') :
                ?>
                <em><?php
                    /** print message below */
                    _e('Your comment is awaiting moderation.', 'wp_deeds');
                    ?></em>
                <br />
            <?php endif; ?>

            <div class="avatar">
                <?php echo get_avatar($comment, 86); ?>
                <?php
                /** check if thread comments are enable then print a reply link */
                comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
                ?>

            </div>

            <div class="comment-details">
                <h5><?php comment_author(); ?> <i><span><?php comment_date('d-m-Y'); ?></span></i></h5>
                <?php comment_text(); ?>
            </div>

        </div>    
        <?php
    }

    /**
     * Outputs a complete commenting form for use within a template.
     * Most strings and form fields may be controlled through the $args array passed
     * into the function, while you may also choose to use the comment_form_default_fields
     * filter to modify the array of default fields if you'd just like to add a new
     * one or remove a single field. All fields are also individually passed through
     * a filter of the form comment_form_field_$name where $name is the key used
     * in the array of fields.
     *
     * @since 3.0.0
     * @param array $args Options for strings, fields etc in the form
     * @param mixed $post_id Post ID to generate the form for, uses the current post if null
     * @return void
     */
    function sh_comment_form($args = array(), $post_id = null) {
        if (null === $post_id)
            $post_id = get_the_ID();
        else
            $id = $post_id;

        $commenter = wp_get_current_commenter();
        $user = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        $args = wp_parse_args($args);
        if (!isset($args['format']))
            $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';

        $req = get_option('require_name_email');
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $html5 = 'html5' === $args['format'];
        $fields = array(
            'author' => '<input placeholder="' . __('*Name', 'wp_deeds') . '" class="input-style" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />',
            'email' => '<input placeholder="' . __('*Email', 'wp_deeds') . '" class="input-style" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />',
        );

        $required_text = sprintf(' ' . __('Required fields are marked %s', 'wp_deeds'), '<span class="required">*</span>');
        $defaults = array(
            'fields' => apply_filters('comment_form_default_fields', $fields),
            'comment_field' => '<div class=""><div class="comment-form-comment"><textarea class="input-style" id="comment" name="comment" placeholder="*Description"cols="45" rows="8" aria-required="true"></textarea></div></div>',
            'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'wp_deeds'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
            'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'wp_deeds'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
            'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.', 'wp_deeds') . ( $req ? $required_text : '' ) . '</p>',
            'comment_notes_after' => '<p class="form-allowed-tags col-md-11">' . sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'wp_deeds'), '<code>' . allowed_tags() . '</code>') . '</p>',
            'id_form' => 'commentform',
            'id_submit' => 'submit',
            'title_reply' => __('<i class="theme-icon big comment-icon"></i>Leave a Reply', 'wp_deeds'),
            'title_reply_to' => __('Leave a Reply to %s', 'wp_deeds'),
            'cancel_reply_link' => __('Cancel reply', 'wp_deeds'),
            'label_submit' => __('Comment', 'wp_deeds'),
            'format' => 'xhtml',
        );

        $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));
        ?>
        <?php if (comments_open($post_id)) : ?>
            <?php do_action('comment_form_before'); ?>
            <div id="respond" class="comment-respond leave-a-comment remove-gap">

                <div class="leave-comment">	
                    <h4><i class="fa fa-edit"></i><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?> <small><?php cancel_comment_reply_link($args['cancel_reply_link']); ?></small></h4>

                    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                        <?php echo $args['must_log_in']; ?>
                        <?php do_action('comment_form_must_log_in_after'); ?>
                    <?php else : ?>
                        <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
                            <?php do_action('comment_form_top'); ?>
                            <?php if (is_user_logged_in()) : ?>
                                <?php echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity); ?>
                                <?php do_action('comment_form_logged_in_after', $commenter, $user_identity); ?>
                            <?php else : ?>
                                <div>
                                    <?php echo $args['comment_notes_before']; ?>
                                    <?php
                                    do_action('comment_form_before_fields');

                                    foreach ((array) $args['fields'] as $name => $field) {
                                        echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                                    }

                                    do_action('comment_form_after_fields');
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php echo apply_filters('comment_form_field_comment', $args['comment_field']); ?>
                            <div class="row"><?php echo $args['comment_notes_after']; ?></div>
                            <p class="form-submit col-md-12">
                                <input class="submit" name="submit" type="submit" id="<?php echo esc_attr($args['id_submit']); ?>" value="<?php echo esc_attr($args['label_submit']); ?>" >
                                <?php comment_id_fields($post_id); ?>
                            </p>
                            <?php do_action('comment_form', $post_id); ?>
                        </form>
                    <?php endif; ?>
                </div>
            </div><!-- #respond -->
            <?php do_action('comment_form_after'); ?>
        <?php else : ?>
            <?php do_action('comment_form_comments_closed'); ?>
        <?php endif; ?>
        <?php
    }

    function sh_contact_form_submit() {
        if (!count($_POST))
            return;


        _load_class('validation', 'helpers', true);
        $t = &$GLOBALS['_sh_base']; //printr($t);
        $settings = get_option('wp_bistro');

        /** set validation rules for contact form */
        $t->validation->set_rules('contact_name', '<strong>' . __('Name', 'wp_deeds') . '</strong>', 'required|min_length[4]|max_lenth[30]');
        $t->validation->set_rules('contact_email', '<strong>' . __('Email', 'wp_deeds') . '</strong>', 'required|valid_email');
        $t->validation->set_rules('contact_message', '<strong>' . __('Message', 'wp_deeds') . '</strong>', 'required|min_length[5]');
        if (sh_set($settings, 'captcha_status') == 'on') {
            if (sh_set($_POST, 'contact_captcha') !== sh_set($_SESSION, 'captcha')) {
                $t->validation->_error_array['captcha'] = __('Invalid captcha entered, please try again.', 'wp_deeds');
            }
        }

        $messages = '';

        if ($t->validation->run() !== FALSE && empty($t->validation->_error_array)) {

            $name = $t->validation->post('contact_name');
            $email = $t->validation->post('contact_email');
            $message = $t->validation->post('contact_message');
            $contact_to = ( sh_set($settings, 'contact_email') ) ? sh_set($settings, 'contact_email') : get_option('admin_email');

            $headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
            wp_mail($contact_to, __('Contact Us Message', 'wp_deeds'), $message, $headers);

            $message = sh_set($settings, 'success_message') ? $settings['success_message'] : sprintf(__('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.', 'wp_deeds'), $name);

            $messages = '<div class="alert alert-success">
						<p class="title">' . __('SUCCESS! ', 'wp_deeds') . $message . '</p>
					</div>';
        } else {
            if (is_array($t->validation->_error_array)) {
                foreach ($t->validation->_error_array as $msg) {
                    $messages .= '<div class="alert alert-error">
									<p class="title">' . __('Error! ', 'wp_deeds') . $msg . '</p>
								</div>';
                }
            }
        }

        return $messages;
    }

    function sh_blog_excerpt_more($more) {
        return '';
    }

    add_filter('excerpt_more', 'sh_blog_excerpt_more');

    function _the_pagination($args = array(), $echo = 1) {

        global $wp_query;

        $default = array('base' => str_replace(99999, '%#%', esc_url(get_pagenum_link(99999))), 'format' => '?paged=%#%', 'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages, 'next_text' => __('<i class="icon-angle-right"></i>', 'wp_deeds'), 'prev_text' => __('<i class="icon-angle-left"></i>', 'wp_deeds'), 'type' => 'list');

        $args = wp_parse_args($args, $default);

        $pagination = paginate_links($args);

        if (paginate_links(array_merge(array('type' => 'array'), $args))) {
            if ($echo)
                echo $pagination;
            return $pagination;
        }
    }

    function sh_include_file($path, $args) {
        if (file_exists(get_template_directory() . DIRECTORY_SEPARATOR . $path))
            include( get_template_directory() . DIRECTORY_SEPARATOR . $path );
    }

    function sh_create_donation_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . "donation";
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $query = "CREATE TABLE {$table_name} (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `transID` varchar(30) NOT NULL,
			  `status` varchar(20) NOT NULL,
			  `total` float NOT NULL,
			  `donalID` varchar(30) NOT NULL,
			  `donalName` varchar(120) NOT NULL,
			  `donalEmail` varchar(240) NOT NULL,
			  `note` text NOT NULL,
			  `data` text NOT NULL,
			  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($query);
        }
    }

    function sh_blog_posts() {
        while (have_posts()): the_post();
		$post_format = get_post_format();
		
            ?>						
            <div <?php post_class('blog-post'); ?>>
                <div class="row">
                    <div class="col-md-5">
                        <div class="image">
                            <?php the_post_thumbnail('370x230'); ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="blog-detail">
                            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo get_the_excerpt(); ?></p>
                            <a class="readmore" href="<?php the_permalink(); ?>" title=""><?php _e("Read More", 'wp_deeds'); ?></a>
                            <span><i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    }

    function sh_social_sharing() {
        ?>
        <ul class="social-media">
            <li><a target="_blank" title="<?php _e('Share on Linkedin', 'wp_deeds'); ?>" 
                   href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php the_title(); ?>&ro=false&summary=<?php the_excerpt(); ?>&source="><i class="fa fa-linkedin"></i></a></li>
            <li><a target="_blank" title="<?php _e('Share on Google Plus', 'wp_deeds'); ?>" 
                   href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>&t=<?php the_title(); ?>">
                    <i class="fa fa-google-plus"></i></a></li>
            <li>
                <a target="_blank" title="<?php _e('Share on Twitter', 'wp_deeds'); ?>" 
                   href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo urlencode(get_permalink()); ?>&related=">
                    <i class="fa fa-twitter"></i></a></li>
            <li><a target="_blank" title="<?php _e('Share on Facebook', 'wp_deeds'); ?>" 
                   href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&display=popup">
                    <i class="fa fa-facebook"></i></a></li>
        </ul>
        <?php
    }

    function sh_grab_video($url, $opt) {
        if (!esc_url($url))
            return;
        //$opt = get_post_meta( get_the_ID(), '_dictate_gal_videos', true );
        $key = md5($url);
        if (sh_set($opt, $key))
            return sh_set($opt, $key);

        $grab = new SH_grab($url);
        $res = $grab->result();

        if ($res) {
            $opt[$key] = sh_set($res, '0');
            update_post_meta(get_the_ID(), '_dictate_gal_videos', $opt);
            return sh_set($res, '0');
        }
        return false;
    }

    function sh_post_views() {
        global $post;
        $id = sh_set($post, 'ID');
        if (!$id)
            return;

        $meta = get_post_meta($id, '_dict_post_views', true);

        $views = ( $meta ) ? $meta + 1 : 1;

        update_post_meta($id, '_dict_post_views', (int) $views);

        return $views;
    }

    function sh_google_fonts() {

        $options = get_option('sh_google_fonts_array');

        if (!$options) {

            $fp = @fopen(get_template_directory() . '/framework/resource/default_fonts', 'r');
            if (!$fp)
                return array();
            $read = fread($fp, 1024000); //printr(json_decode($read));
        } else
            return $options;


        $return = array();
        $style = array();

        if ($items = sh_set(json_decode($read), 'items')) {
            foreach ($items as $item) {
                if ($styles = sh_set($item, 'variants')) {
                    foreach ($styles as $s)
                        $style[$s] = $s;
                }
                $return[sh_set($item, 'family')] = sh_set($item, 'family');
            }
        }
        update_option('sh_google_fonts_array', array('family' => $return, 'style' => $style));
        return array('family' => $return, 'style' => $style);
    }

    function sh_font_awesome($code = false) {
        $pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
        $subject = file_get_contents(get_template_directory() . '/font-awesome/css/font-awesome.css');

        preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

        $icons = array();

        foreach ($matches as $match) {
            $value = str_replace('fa-', '', $match[1]);
            if ($code)
                $icons[$match[1]] = stripslashes($match[2]);
            else
                $icons[$match[1]] = ucwords(str_replace('-', ' ', $value));
        }

        return $icons;
    }

    function sh_get_font_settings($FontSettings = array(), $StyleBefore = '', $StyleAfter = '') {
        $i = 1;
        $settings = get_option('wp_deeds' . '_theme_options');
        $Style = '';
        foreach ($FontSettings as $k => $v) {
            if ($i == 1 || $i == 5) {
                $Style .= ( sh_set($settings, $k) ) ? $v . ':' . sh_set($settings, $k) : '';
            } else {
                $Style .= ( sh_set($settings, $k) ) ? $v . ':' . sh_set($settings, $k) . ';' : '';
            }
            $i++;
        }
        return (!empty($Style) ) ? $StyleBefore . $Style . $StyleAfter : '';
    }

    function sh_theme_color_scheme($cookie = false) {
        $options = get_option('wp_deeds' . '_theme_options');
        $custom_color_scheme = sh_set($options, 'custom_color_scheme');
        $color_selection = sh_set($options, 'color_selection');
        $default_color_scheme = sh_set($options, 'default_color_scheme');

        if ($color_selection == 'default' && $default_color_scheme)
            echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/css/colors/' . $default_color_scheme . '.css" />';
        else if ($color_selection == 'custom' && $custom_color_scheme) {
            $_COOKIE['sh_color_scheme'] = isset($_COOKIE['sh_color_scheme']) ? $_COOKIE['sh_color_scheme'] : $custom_color_scheme;

            $custom_style = ( $cookie && isset($_COOKIE['sh_color_scheme']) ) ? $_COOKIE['sh_color_scheme'] : $custom_color_scheme;

            $content = @file_get_contents(get_template_directory_uri() . '/css/color.css');

            if ($custom_style) {


                $replace = str_replace('#f0283b', $custom_style, $content);

                $replace = ( $custom_style ) ? $replace : $content;
            } else
                $replace = $content;
            echo "\n" . '<style title="sh_color_scheme">' . $replace . '</style>';
        }
    }

    function sh_header_settings($settings = array()) {
        //$settings = get_option( 'wp_deeds' );
        $settings = ( $settings ) ? $settings : get_option('wp_deeds');

        $return = array();

        $return['responsive'] = ( sh_set($settings, 'layout_responsive_options') == 'true' ) ? true : false;

        $return['boxed'] = '';

        if ((is_home() || is_front_page()) && sh_set($settings, 'home_page_boxed_layout_status') == 'true')
            $return['boxed'] = 'boxed';
        elseif (sh_set($settings, 'boxed_layout_status') == 'true')
            $return['boxed'] = 'boxed';

        if (sh_set($settings, 'layout_responsive_width') && sh_set($return, 'boxed'))
            $return['width'] = ' width:' . sh_set($settings, 'layout_responsive_width') . 'px;';

        $return['pattern_image'] = ( sh_set($return, 'boxed') && sh_set($settings, 'layout_patron_image') ) ? 'background-image:url(' . sh_set($settings, 'layout_patron_image') . ');' : '';

        $return['pattern'] = ( sh_set($return, 'boxed') && !sh_set($settings, 'layout_patron_image') ) ? sh_set($settings, 'layout_sidebar_patron', 'bg-body1') : '';

        return $return;
    }

    add_action('woocommerce_before_main_content', 'sh_woocommerce_before_main_content');

    function sh_woocommerce_before_main_content() {

        if (!is_archive())
            return;

        $t = array();

        while (have_posts()): the_post();

            $terms = wp_get_post_terms(get_the_id(), 'product_cat');

            if ($terms && is_array($terms)) {
                foreach ($terms as $term) {

                    $t[$term->term_id] = '<li><a href="" data-filter=".product-cat-' . $term->slug . '">' . $term->name . '</a></li>';
                }
            }

        endwhile;


        echo '<div id="masonay-nav">
				
			</div>';
    }

    add_action('woocommerce_sidebar', 'sh_woocommerce_sidebar');

    function sh_woocommerce_sidebar() {
        
    }

    function sh_get_currencies() {
        $currencies = array(
            array(
                'value' => 'AUD',
                'label' => 'Australian Dollar',
            ),
            array(
                'value' => 'CAD',
                'label' => 'Canadian Dollar',
            ),
            array(
                'value' => 'EUR',
                'label' => 'Euro',
            ),
            array(
                'value' => 'GBP',
                'label' => 'Pound Sterling',
            ),
            array(
                'value' => 'JPY',
                'label' => 'Japanese Yen',
            ),
            array(
                'value' => 'USD',
                'label' => 'U.S. Dollar',
            ),
            array(
                'value' => 'NZD',
                'label' => 'N.Z. Dollar',
            ),
            array(
                'value' => 'CHF',
                'label' => 'Swiss Franc',
            ),
            array(
                'value' => 'HKD',
                'label' => 'Hong Kong Dollar',
            ),
            array(
                'value' => 'SGD',
                'label' => 'Singapore Dollar',
            ),
            array(
                'value' => 'SEK',
                'label' => 'Swedish Krona',
            ),
            array(
                'value' => 'DKK',
                'label' => 'Danish Krone',
            ),
            array(
                'value' => 'PLN',
                'label' => 'Polish Zloty',
            ),
            array(
                'value' => 'NOK',
                'label' => 'Norwegian Krone',
            ),
            array(
                'value' => 'HUF',
                'label' => 'Hungarian Forint',
            ),
            array(
                'value' => 'CZK',
                'label' => 'Czech Koruna',
            ),
            array(
                'value' => 'ILS',
                'label' => 'Israeli New Sheqel',
            ),
            array(
                'value' => 'MXN',
                'label' => 'Mexican Peso',
            ),
            array(
                'value' => 'BRL',
                'label' => 'Brazilian Real',
            ),
            array(
                'value' => 'MYR',
                'label' => 'Malaysian Ringgit',
            ),
            array(
                'value' => 'PHP',
                'label' => 'Philippine Peso',
            ),
            array(
                'value' => 'TWD',
                'label' => 'New Taiwan Dollar',
            ),
            array(
                'value' => 'THB',
                'label' => 'Thai Baht',
            ),
            array(
                'value' => 'TRY',
                'label' => 'Turkish Lira',
            ),
        );
        return $currencies;
    }

    function sh_db_prayer_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . "prayers";
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $query = "CREATE TABLE {$table_name} (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(30) NOT NULL,
				  `email` varchar(30) NOT NULL,
				  `message` varchar(1000) NOT NULL,
				  `status` varchar(10) NOT NULL,
				  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($query);
        }
    }

    function _WSH() {
        return $GLOBALS['_sh_base'];
    }
    