<?php 

/** function widget($args, $instance) see @ WP_Widget::widget */
/** function update($new_instance, $old_instance) see @ WP_Widget::update */
/** function form($instance) see @ WP_Widget::form */


//About Us Widget
class SH_about_us extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'aboutus', /* Name */__('Deeds About US','wp_deeds'), array( 'description' => __('This widgtes is used to add About Us Details to Footer', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$logo_path = apply_filters( 'widget_logo_path', $instance['logo_path'] );
		$text = apply_filters( 'widget_text', $instance['text'] );
		$address = apply_filters( 'widget_address', $instance['address'] );
		$email = apply_filters( 'widget_email', $instance['email'] );
		$phone = apply_filters( 'widget_phone', $instance['phone'] );
		?>

		<?php echo $before_widget; ?>
            <div class="about">
                <img alt="" src="<?php echo $logo_path; ?>">
                <span><?php echo $title; ?></span>
            <p><?php echo $text; ?></p>
            <div class="contact">
                <ul>
                	<li><span><i class="fa fa-phone"></i><?php _e("Telephone " , 'wp_deeds'); ?> :</span><?php echo $phone; ?></li>                    
                    <li><span><i class="fa fa-envelope"></i><?php _e("Email" , 'wp_deeds'); ?> :</span>  <?php echo $email; ?></li>
                    <li><span><i class="fa fa-home"></i><?php _e("Address" , 'wp_deeds'); ?> :</span> <?php echo $address; ?></li>
                </ul>
            </div>
                <ul class="social-media">
                    <?php
                         $options = get_option('wp_deeds'.'_theme_options');
                         $social_media = sh_set(sh_set($options , 'social_media') , 'social_media'); 
                        if(is_array($social_media)):
                            foreach((array)$social_media as $social):
                                if(sh_set($social , 'tocopy')) continue;
                                    $icon = sh_set($social , 'social_icon'); ?>
                                    <li>
                                        <a title="" href="<?php echo sh_set($social , 'social_link'); ?>">
                                            <i class="fa <?php echo $icon ; ?>"></i>
                                        </a>
                                    </li>
                    <?php endforeach; endif; ?>
            </ul><!--- SOCIAL MEDIA -->
           </div>
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['logo_path'] = strip_tags($new_instance['logo_path']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$logo_path = ($instance) ? esc_attr($instance['logo_path']) : '' ;
		$text = ($instance) ? esc_attr($instance['text']) : '' ;
		$address = ($instance) ? esc_attr($instance['address']) : '' ;
		$email = ($instance) ? esc_attr($instance['email']) : '' ;
		$phone = ($instance) ? esc_attr($instance['phone']) : '' ;
		?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('logo_path');?>"><?php _e('Logo Url:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('logo_path');?>" name="<?php echo $this->get_field_name('logo_path');?>" type="text" value="<?php echo $logo_path;?>" />
        </p>
		 <p>    
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'wp_deeds');?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" > <?php echo $text; ?></textarea> 
        </p>
         <p>    
            <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'wp_deeds');?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" > <?php echo $address; ?></textarea> 
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email');?>"><?php _e('Email:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email');?>" name="<?php echo $this->get_field_name('email');?>" type="text" value="<?php echo $email;?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('phone');?>"><?php _e('Phone:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone');?>" name="<?php echo $this->get_field_name('phone');?>" type="text" value="<?php echo $phone;?>" />
        </p>
        <?php 
	}
}


// Recent Blog 

class SH_recent_blog extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'recentblog', /* Name */__('Deeds Blog Posts','wp_deeds'), array( 'description' => __('This widgtes is used to show Blog Posts to Footer', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$number = apply_filters( 'widget_number', $instance['number'] );
		$order_by = apply_filters( 'widget_order_by', $instance['order_by'] );
		$order = apply_filters( 'widget_order', $instance['order'] );
		$post_args = array('post_type' => 'post' ,  'showposts' => $number , 'orderby'=> $order_by , 'order'=> $order);
		query_posts($post_args);
		?>
		<?php echo $before_widget; ?>
        <?php
			echo ($title)? $before_title.$title.$after_title : '' ;
		?>
            <div class="remove-ext">
            	<?php if(have_posts()): while(have_posts()): the_post(); ?>
                <div class="widget-blog">
                    <div class="widget-blog-img">
                    <?php if(has_post_thumbnail()) the_post_thumbnail('270x270'); ?>
                    </div>
                    <h6><a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                    <p><?php echo substr( strip_tags(get_the_content()), 0, 50 );?></p>
                    <span><i class="fa fa-calendar-o"></i><?php echo get_the_date('M d, Y'); ?></span>
                </div><!-- WIDGET BLOG -->
                <?php endwhile; endif ; wp_reset_query(); ?>
            </div>
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['order_by'] = strip_tags($new_instance['order_by']);
		$instance['order'] = strip_tags($new_instance['order']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$number = ($instance) ? esc_attr($instance['number']) : '' ;
		$order_by = ($instance) ? esc_attr($instance['order_by']) : '';
		$order = ($instance) ? esc_attr($instance['order']) : '' ;
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('order_by');?>"><?php _e('Order By:', 'wp_deeds');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('order_by');?>" name="<?php echo $this->get_field_name('order_by');?>" >
            	<option value="date" <?php if($order_by == 'date') :?> selected="selected" <?php endif; ?>> <?php _e("Date" , 'wp_deeds'); ?></option>
                <option value="title" <?php if($order_by == 'title') :?> selected="selected" <?php endif; ?>><?php _e("Title" , 'wp_deeds'); ?> </option>
                <option value="name" <?php if($order_by == 'name') :?> selected="selected" <?php endif; ?>> <?php _e("Name" , 'wp_deeds'); ?> </option>
                <option value="author" <?php if($order_by == 'author') :?> selected="selected" <?php endif; ?>><?php _e("Author" , 'wp_deeds'); ?> </option>
                <option value="comment_count" <?php if($order_by == 'comment_count') :?> selected="selected" <?php endif; ?>><?php _e("Comment Count" , 'wp_deeds'); ?> </option>
            	<option value="random" <?php if($order_by == 'random') :?> selected="selected" <?php endif; ?>><?php _e("Random" , 'wp_deeds'); ?> </option>
            </select>
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('order');?>"><?php _e('Order:', 'wp_deeds');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('order');?>" name="<?php echo $this->get_field_name('order');?>" >
            	<option value="ASC" <?php if($order == 'ASC') :?> selected="selected" <?php endif; ?>> <?php _e("Ascending Order" , 'wp_deeds'); ?></option>
                <option value="DESC" <?php if($order == 'DESC') :?> selected="selected" <?php endif; ?>><?php _e("Descending Order" , 'wp_deeds'); ?> </option>
                
            </select>
        </p>
        <?php 
	}
}


// Flicker Gallery
class SH_Flickr extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Flickr', /* Name */__('Deeds Flickr Feed','wp_deeds'), array( 'description' => __('Fetch the latest feed from Flickr', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$flickr_id = apply_filters( 'widget_flickr_id', $instance['flickr_id'] );
		$number = apply_filters( 'widget_number', $instance['number'] );
		wp_enqueue_script('flickrjs');
		echo $before_widget;

		echo $before_title.$title.$after_title;
		
		$limit = ( $number ) ? $number : 9;?>
            <div class="gallery-widget flicker lightbox">
               <script type="text/javascript">
                    jQuery(document).ready(function($) {
                     $('.gallery-widget.flicker').jflickrfeed({
                      limit: <?php echo esc_js($limit); ?> ,
                      qstrings: {id: '<?php echo esc_js($instance['flickr_id']); ?>'},
                      itemTemplate: '<div class="col-md-4"><a href="{{image}}" title=""><img src="{{image_s}}" alt="{{title}}" /></a></div>'
                     });
                    });
					jQuery(window).load(function(){
						jQuery('.lightbox').poptrox({
							usePopupNav:true
						});
					});
               </script>
            </div><?php
			
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = $new_instance['flickr_id'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	function form($instance)
	{
		wp_enqueue_script('flickrjs');
		$title = ($instance) ? esc_attr($instance['title']) : __('OUR FLICKR', 'wp_deeds');
		$flickr_id = ($instance) ? esc_attr($instance['flickr_id']) : '';
		$number = ( $instance ) ? esc_attr($instance['number']) : 8;?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('flickr_id');?>"><?php _e('Flickr ID:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('flickr_id');?>" name="<?php echo $this->get_field_name('flickr_id');?>" type="text" value="<?php echo $flickr_id;?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of Tweets:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" />
        </p>
        <?php 
	}
}


//News Letter Subscription
class SH_News_Letter_Subscription extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'NewsLetterSubscription', /* Name */__('Deeds News Letter Subscription','wp_deeds'), array( 'description' => __('This widgtes is used to add news letter subscription form to Footer', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$text = apply_filters( 'widget_text', $instance['text'] );
		?>

		<?php echo $before_widget; 
				echo $before_title.$title.$after_title ;
		?>
        <form id="news_letter_form" name="news_letter_form" method="post" action="<?php admin_url('admin-ajax.php?action=dictate_ajax_callback&subaction=sh_news_letter_form_submit'); ?>">
            <input type="email" placeholder="<?php _e("EMAIL ADDRESS" , 'wp_deeds'); ?>">
            <input type="submit" value="<?php _e("SIGN UP NOW" , 'wp_deeds'); ?>">
        </form>
    
        <p><?php echo $text ; ?></p>
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('NEWSLETTER SIGNUP', 'wp_deeds');
		$text = ($instance) ? esc_attr($instance['text']) : '' ;
		?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
		 <p>    
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'wp_deeds');?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" > <?php echo $text; ?></textarea> 
        </p>
        
        <?php 
	}
}

//Video Widget
class SH_Video extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'Video', /* Name */__('Deeds Video','wp_deeds'), array( 'description' => __('This widgtes is used to add Video to sidebar.', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$vid_link = apply_filters( 'widget_vid_link', $instance['vid_link'] );
		echo $before_widget;
		echo ($title)? $before_title.$title.$after_title : ''; 
		$video_data = sh_grab_video( $vid_link , '');
		//printr($video_data);
		?>
		
        <div class="video">
            <div class="video-img lightbox">
                <img alt="" src="<?php echo sh_set($video_data , 'thumb'); ?>">
                <a title="<?php echo sh_set($video_data , 'title'); ?>" data-rel="vimeo" href="http://vimeo.com/<?php echo sh_set($video_data , 'id') ;?>"><i class="fa fa-play"></i></a>
            </div>
        </div>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['vid_link'] = strip_tags($new_instance['vid_link']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Popular', 'wp_deeds');
		$vid_link = ($instance) ? esc_attr($instance['vid_link']) : '' ;
		
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('vid_link');?>"><?php _e('Video Link:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('vid_link');?>" name="<?php echo $this->get_field_name('vid_link');?>" type="text" value="<?php echo $vid_link;?>" />
        </p>
        <?php
	}
}

//Video Widget
class SH_Footer_Contact extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Footer_Contact', /* Name */__('Deeds Contact Form','wp_deeds'), array( 'description' => __('This widgtes is used to add Contact Form to sidebar.', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$email = apply_filters( 'widget_email', $instance['email'] );
		
	

		echo $before_widget;
		echo ($title)? $before_title.$title.$after_title : '';
		?>
		
        <div class="quick-message">
        <div id="fotter_msg"></div>
            <form id="f_contact_form" action="<?php echo admin_url('admin-ajax.php?action=dictate_ajax_callback&subaction=sh_footer_contact_form');?>" method="post" >	
                <input type="text" id="f_name" name="f_name" placeholder="<?php _e( 'Name', 'wp_deeds' )?>" alt="" required="required" /> 
                <input type="email" id="f_email" name="f_email" placeholder="<?php _e( 'Email', 'wp_deeds' )?>" alt="" required="required" /> 
                <textarea id="f_msg" name="f_msg" placeholder="<?php _e( 'Enter Your Message', 'wp_deeds' )?>"></textarea>
                <input type="hidden" id="f_sender" name="f_sender" value="<?php echo $email;?>"  />
                <input type="submit" value="<?php _e( 'send', 'wp_deeds' )?>" id="f_sumbit" />
            </form>
            <div id="admn_url" style="display:none"><?php echo get_template_directory_uri();?></div>
        </div>
        <script>
			jQuery(document).ready(function($) {
				
				$('#f_contact_form').submit(function(){
					var url = document.getElementById('admn_url').innerHTML;
					var action = $(this).attr('action');
					$("#fotter_msg").slideUp(750,function() {
					$('#fotter_msg').hide();
					$('#f_sumbit')
						.after('<img class="loader" src='+url+'/images/ajax-loader.gif  />').attr("disabled","disabled");
			
					$.post(action, {
						name: $('#f_name').val(),
						email: $('#f_email').val(),
						comments: $('#f_msg').val(),
						sender: $('#f_sender').val(),
					},
						function(data){
							document.getElementById('fotter_msg').innerHTML = data;
							$('#fotter_msg').slideDown('slow');
							$('#f_contact_form img.loader').fadeOut('slow',function(){$(this).remove()});
							$('#f_sumbit').removeAttr('disabled');
							if(data.match('success') != null) $('#f_contact_form').slideUp('slow');
			
						}
					);
					});
					return false;
				});			
			});
			</script>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Quick Message', 'wp_deeds');
		$email = ($instance) ? esc_attr($instance['email']) : '' ;
		
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('email');?>"><?php _e('Enter Your Email:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email');?>" name="<?php echo $this->get_field_name('email');?>" type="text" value="<?php echo $email;?>" />
        </p>
        <?php
	}
}

//our gallery Widget
class SH_our_gallery extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'ourgallery', /* Name */__('Deeds Our Gallery','wp_deeds'), array( 'description' => __('This widgtes is used to show gallery images', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		wp_reset_query();
		$title = apply_filters( 'widget_title', $instance['title'] );
		$gallery = $instance['gallery'];		
		$items  = sh_set( get_post_meta( $gallery, 'sh_gallery_meta', true ) , 'sh_gallery_items' );
		echo $before_widget;
		?>
            <div class="widget-title"><h4><?php echo ucwords( $title )?></h4></div>
            <div class="gallery-widget lightbox">
            	<?php if( $items ) : ?>
					<?php foreach( $items as $item ){?>
                        <div class="col-md-3">
                            <a href="<?php echo sh_set( $item, 'gallery_item' )?>">
                                <img src="<?php echo sh_set( $item, 'gallery_item' )?>" alt="" />
                            </a>
                        </div>
                   <?php } ?>
               <?php endif; ?>
            </div>
		
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['gallery'] = strip_tags($new_instance['gallery']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$gallery = ($instance) ? esc_attr($instance['gallery']) : '';
		?>
		<?php
        $args = array(
            'post_type' => 'cs_gallery',
        );
        
		$post = array();
		$loop = new WP_Query($args);
        while($loop->have_posts()): $loop->the_post();
        	$post[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_query();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
         	 <label for="<?php echo $this->get_field_id('gallery');?>"><?php _e('Select Gallery:', 'wp_deeds');?></label>
         	 <select class="widefat" id="<?php echo $this->get_field_id('gallery'); ?>" name="<?php echo $this->get_field_name('gallery'); ?>" >
			<?php foreach ($post as $k=>$op) : 	
					$selected = ($gallery == $k) ? 'selected="selected"' : '';
					echo '<option value="'.$k.'" '.$selected.'>'.$op.'</option>';
				  endforeach; ?>
			</select>
         </p>
        <?php 
	}
}


//latest event with description Widget
class SH_latest_event_with_description extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'latesteventwithdescription', /* Name */__('Deeds Latest Event With Description','wp_deeds'), array( 'description' => __('This widgtes is show latest event with description', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		$event = $instance['event'];		
		$event_meta  = sh_set( sh_set( get_post_meta( $event, 'sh_event_meta', true ), 'sh_event_options' ), 0 );
		$originalDate = sh_set($event_meta , 'start_date');
		$args = array(
				'p' => $event, // id of a page, post, or custom type
				'post_type' => 'cs_events'
			);
		$my_posts = new WP_Query($args);
		?>
            <div class="widget-title"><h4><?php echo $title?></h4></div>
            <?php while( $my_posts->have_posts() ): $my_posts->the_post(); ?>
                <div class="animal-event">
                <div class="animal-img"><?php if(has_post_thumbnail()) the_post_thumbnail('370x230'); ?><span><strong><?php echo date( 'd', strtotime( $originalDate) )?></strong><?php echo date( 'M Y', strtotime( $originalDate) )?></span></div>
                <div class="animal-detail">
                    <h4><a href="<?php the_permalink()?>" title="<?php the_title()?>"><?php the_title()?></a></h4>
                    <p><?php echo substr( get_the_content(), 0, 80 ) ?>...</p>
                    <ul>
                        <li><a href="#" title=""><i class="fa fa-map-marker"></i></a> <span><?php echo sh_set($event_meta , 'location'); ?></span></li>
                        <li><a href="#" title=""><i class="fa fa-comments"></i></a><span><?php echo sh_get_comment()?></span></li>
                        <li><a href="#" title=""><i class="fa fa-clock-o"></i></a><span><?php echo get_the_date('d-m-Y H:i a') ?></span></li>
                    </ul>
                </div>
            </div>
        <?php endwhile; wp_reset_query(); ?>
		
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['event'] = strip_tags($new_instance['event']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$event = ($instance) ? esc_attr($instance['event']) : '';
		?>
		<?php
        $args = array(
            'post_type' => 'cs_events',
        );
        
		$post = array();
		$loop = new WP_Query($args);
        while($loop->have_posts()): $loop->the_post();
        	$post[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_query();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
         	 <label for="<?php echo $this->get_field_id('event');?>"><?php _e('Select Event:', 'wp_deeds');?></label>
         	 <select class="widefat" id="<?php echo $this->get_field_id('event'); ?>" name="<?php echo $this->get_field_name('event'); ?>" >
			<?php foreach ($post as $k=>$op) : 	
					$selected = ($event == $k) ? 'selected="selected"' : '';
					echo '<option value="'.$k.'" '.$selected.'>'.$op.'</option>';
				  endforeach; ?>
			</select>
         </p>
        <?php 
	}
}

//latest event with description Widget
class SH_latest_event_without_description extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'latesteventwithoutdescription', /* Name */__('Deeds Latest Event Without Description','wp_deeds'), array( 'description' => __('This widgtes is show latest event without description', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		$event = $instance['event'];		
		$event_meta  = sh_set( sh_set( get_post_meta( $event, 'sh_event_meta', true ), 'sh_event_options' ), 0 );
		$originalDate = sh_set($event_meta , 'start_date');
		$args = array(
				'p' => $event, // id of a page, post, or custom type
				'post_type' => 'cs_events'
			);
		$my_posts = new WP_Query($args);
		?>
            <div class="widget-title"><h4><?php echo $title?></h4></div>
            <?php while( $my_posts->have_posts() ): $my_posts->the_post(); ?>
                <div class="animal-event simple">
                <div class="animal-detail">
                	<h4><a href="<?php the_permalink()?>" title="<?php the_title()?>"><?php the_title()?></a></h4>
					<div class="animal-img">
						<?php if(has_post_thumbnail()) the_post_thumbnail('370x230'); ?><span><strong><?php echo date( 'd', strtotime( $originalDate) )?></strong><?php echo date( 'M Y', strtotime( $originalDate) )?></span></div>
                    <ul>
                        <li><a href="#" title=""><i class="fa fa-map-marker"></i></a> <span><?php echo sh_set($event_meta , 'location'); ?></span></li>
                        <li><a href="#" title=""><i class="fa fa-comments"></i></a><span><?php echo sh_get_comment()?></span></li>
                        <li><a href="#" title=""><i class="fa fa-clock-o"></i></a><span><?php echo get_the_date('d-m-Y H:i a') ?></span></li>
                    </ul>
                </div>
            </div>
        <?php endwhile; wp_reset_query(); ?> 
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['event'] = strip_tags($new_instance['event']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$event = ($instance) ? esc_attr($instance['event']) : '';
		?>
		<?php
        $args = array(
            'post_type' => 'cs_events',
        );
        
		$post = array();
		$loop = new WP_Query($args);
        while($loop->have_posts()): $loop->the_post();
        	$post[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_query();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
         	 <label for="<?php echo $this->get_field_id('event');?>"><?php _e('Select Event:', 'wp_deeds');?></label>
         	 <select class="widefat" id="<?php echo $this->get_field_id('event'); ?>" name="<?php echo $this->get_field_name('event'); ?>" >
			<?php foreach ($post as $k=>$op) : 	
					$selected = ($event == $k) ? 'selected="selected"' : '';
					echo '<option value="'.$k.'" '.$selected.'>'.$op.'</option>';
				  endforeach; ?>
			</select>
         </p>
        <?php 
	}
}


//Upcoming Event wiht timer  Widget
class SH_upcoming_event_wiht_timer extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'upcoming_event_with_timer', /* Name */__('Deeds Upcoming Event With Timer','wp_deeds'), array( 'description' => __('This widgtes is show upcoming event wiht countdown', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		$event = $instance['event'];		
		$events_meta = sh_set(sh_set(get_post_meta( $event , 'sh_event_meta' , true) , 'sh_event_options') , 0);			
		$time = strtotime( sh_set( $events_meta, 'start_time' ) );
		$new_time = date( 'g:i a', $time );		
		$date = strtotime( sh_set( $events_meta, 'start_date' ) );		
		$c_t = date( 'g:i:s', $time );
		$c_d = date( 'm/d/Y', $date );
		$args = array(
				'p' => $event,
				'post_type' => 'cs_events'
			);
		$my_posts = new WP_Query($args);
		//printr($my_posts);
		?>
            <div class="widget-title"><h4><?php echo $title?></h4></div>
            <?php while( $my_posts->have_posts() ): $my_posts->the_post(); ?>
                <div class="event-count">
                <?php $cls = (has_post_thumbnail())? 'event-img' : 'event-img no_event_img';  ?>
                    <div class="<?php echo $cls;?>">
                        <?php if( has_post_thumbnail() ): echo get_the_post_thumbnail( get_the_id(), array(370,201) ); endif; ?>
                        <div class="downcount">
                            <i class="fa fa-clock-o"></i>
                            <ul id="widget_countdown" class="countdown">
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
                    <h4><a href="<?php the_permalink()?>" title="<?php the_title()?>"><?php the_title()?></a></h4>
                </div>
                <?php wp_enqueue_script(array('counter'));?>
                <?php
					$opt = get_option('wp_deeds'.'_theme_options');
					$timezone	=	explode( ' ', sh_set( $opt, 'time_zone' ), 2 );
				?>
                <script type="text/javascript">
					jQuery(document).ready(function($){
							new_counter('widget_countdown', '<?php echo $c_d.' '.$c_t?>', <?php echo esc_js(sh_set( $timezone, '0' )); ?>);
					});
				</script>
        <?php endwhile; wp_reset_query(); ?>
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['event'] = strip_tags($new_instance['event']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$event = ($instance) ? esc_attr($instance['event']) : '';
		?>
		<?php
        $args = array(
            'post_type' => 'cs_events',
			'posts_per_page' => -1,
//			'post_status'	=> 'publish',
        );
        
		$post = array();
		$loop = new WP_Query($args);
        while($loop->have_posts()): $loop->the_post();
        	$post[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_query();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
         	 <label for="<?php echo $this->get_field_id('event');?>"><?php _e('Select Event:', 'wp_deeds');?></label>
         	 <select class="widefat" id="<?php echo $this->get_field_id('event'); ?>" name="<?php echo $this->get_field_name('event'); ?>" >
			<?php foreach ($post as $k=>$op) : 	
					$selected = ($event == $k) ? 'selected="selected"' : '';
					echo '<option value="'.$k.'" '.$selected.'>'.$op.'</option>';
				  endforeach; ?>
			</select>
         </p>
        <?php 
	}
}



//donate us Widget
class SH_donate_us extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'donateus', /* Name */__('Deeds Donate Us','wp_deeds'), array( 'description' => __('This widgtes is show donate us box', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		$donation_text = ucwords( $instance['donation'] );
		$btn_txt = $instance['btn_txt'];
		$donation = 'widget_donation';
		include(get_template_directory().'/framework/modules/shortcodes/donation_model.php');		
		echo $output ;
		
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['donation'] = strip_tags($new_instance['donation']);
		$instance['btn_txt'] = strip_tags($new_instance['btn_txt']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$donation = ($instance) ? esc_attr($instance['donation']) : __( 'GIVE US DONATIONS', 'wp_deeds' );
		$btn_txt = ($instance) ? esc_attr($instance['btn_txt']) : __( 'Donate Now', 'wp_deeds' );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('donation');?>"><?php _e('Box Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('donation');?>" name="<?php echo $this->get_field_name('donation');?>" type="text" value="<?php echo $title;?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('btn_txt');?>"><?php _e('Button Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('btn_txt');?>" name="<?php echo $this->get_field_name('btn_txt');?>" type="text" value="<?php echo $title;?>" />
        </p>
        <?php 
	}
}

//recent sermons Widget
class SH_recent_sermons extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'recentsermons', /* Name */__('Deeds Recent Sermons','wp_deeds'), array( 'description' => __('This widgtes is show Recent Sermons', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		$sermon = $instance['sermon'];
		$sermon_meta = sh_set(sh_set(get_post_meta( $sermon , 'sh_sermon_meta' , true) , 'sh_sermon_options') , 0);
		$args = array(
				'p' => $sermon,
				'post_type' => 'cs_sermons'
			);
		$my_posts = new WP_Query($args);
		?>
            <div class="widget-title"><h4><?php echo $title?></h4></div>
            <?php while( $my_posts->have_posts() ): $my_posts->the_post(); ?>
                <div class="sermon-widget">
                    <div class="sermon-img">
                         <?php if( has_post_thumbnail() ): echo get_the_post_thumbnail( get_the_id(), array(370,230) ); endif; ?>
                        <span><i class="fa fa-calendar-o"></i> <?php echo get_the_time('M d, Y' , get_the_ID()); ?></span>
                        <h3><a href="<?php the_permalink()?>" title="<?php the_title()?>"><?php the_title()?></a></h3>
                    </div>
                    <div class="sermon-detail">
                        <p><?php echo substr( get_the_content(), 0, 80 )?>...</p>
                        <ul class="sermon-media">
                        	
                        	<?php $host = get_video_host(sh_set($sermon_meta, 'sermon_vid_link'));  ?>
                            <li class="lightbox"><a href="<?php echo sh_set($sermon_meta, 'sermon_vid_link'); ?>" data-poptrox="<?php echo esc_attr($host); ?>" title=""><i class="fa fa-film"></i></a></li>
                            <li><a title=""><i class="audio-btn fa fa-headphones"></i>
                                <div class="audioplayer"><audio  src="<?php echo sh_set($sermon_meta , 'audio_upload'); ?>"></audio><span class="cross">X</span></div>
                            </a></li>
                            <li><a target="_blank" href="<?php echo sh_set($sermon_meta , 'download_link'); ?>" title=""><i class="fa fa-download"></i></a></li>
                            <li><a target="_blank" href="<?php echo sh_set($sermon_meta , 'pdf_file'); ?>" title=""><i class="fa fa-book"></i></a></li>
                        </ul>									
                    </div>
                </div>
        <?php endwhile; wp_reset_query(); ?> 
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sermon'] = strip_tags($new_instance['sermon']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$sermon = ($instance) ? esc_attr($instance['sermon']) : '';
		?>
		<?php
        $args = array(
            'post_type' => 'cs_sermons',
        );
        
		$post = array();
		$loop = new WP_Query($args);
        while($loop->have_posts()): $loop->the_post();
        	$post[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_query();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
         	 <label for="<?php echo $this->get_field_id('event');?>"><?php _e('Select Sermons:', 'wp_deeds');?></label>
         	 <select class="widefat" id="<?php echo $this->get_field_id('sermon'); ?>" name="<?php echo $this->get_field_name('sermon'); ?>" >
			<?php foreach ($post as $k=>$op) : 	
					$selected = ($sermon == $k) ? 'selected="selected"' : '';
					echo '<option value="'.$k.'" '.$selected.'>'.$op.'</option>';
				  endforeach; ?>
			</select>
         </p>
        <?php 
	}
}

//latest event with description Widget
class SH_pastor_messages extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'pastormessage', /* Name */__('Deeds Pastor Messages','wp_deeds'), array( 'description' => __('This widgtes is show Pastor Messages', 'wp_deeds' )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		$num = $instance['number'];
		$pastors = get_option( 'wp_deeds'.'_theme_options' );
		$get_pastor = sh_set( $pastors, 'dynamic_pastors' );
		$counter = 0;
		?>
            <div class="widget-title"><h4><?php echo $title?></h4></div>
            	<div class="message-widget">
                	<div class="message-carousel">
						<?php
                            foreach( $get_pastor as $pastor )
                            {			
                                foreach( $pastor as $pas )
                                {
                                    if( sh_set( $pas , 'tocopy' ) || $counter == $num ) break;
                                        ?>
                                        	<div class="pop-message">
                                                <img src="<?php echo sh_set( $pas, 'pastor_img' )?>" alt="" />
                                                <h4><?php echo sh_set( $pas, 'pastor_name' )?></h4>
                                                <span><?php echo sh_set( $pas, 'pastor_design' )?></span>
                                                <blockquote><?php echo substr( sh_set( $pas, 'pastor_msg' ), 0, 80)?></blockquote>
                                                <ul class="sermon-media">
                                                    <li class="lightbox"><a href="http://vimeo.com/<?php echo sh_set( $pas, 'pastor_vimeo' )?>" title=""><i class="fa fa-film"></i></a></li>
                                                    <li><a title=""><i class="audio-btn fa fa-headphones"></i>
                                                        <div class="audioplayer"><audio  src="<?php echo sh_set( $pas, 'pastor_audio' )?>"></audio><span class="cross">X</span></div>
                                                    </a></li>
                                                    <li><a target="_blank" href="<?php echo sh_set( $pas, 'pastor_pdf' )?>" title=""><i class="fa fa-download"></i></a></li>
                                                    <li><a target="_blank" href="<?php echo sh_set( $pas, 'pastor_pdf_view' )?>" title=""><i class="fa fa-book"></i></a></li>
                                                </ul>									
                                            </div>
                                        <?php
                                    $counter++;
                                }
                            }
                        ?>
                    </div>
                </div>
               <script type="text/javascript">
					jQuery(window).load(function(){		
					jQuery(".message-carousel").owlCarousel({
							autoPlay: 5000,
							slideSpeed:1000,
							singleItem : true,
							transitionStyle : "goDown",		
							navigation : true
						});				
					});
    		 </script>
		<?php
		echo $after_widget ;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$number = ($instance) ? esc_attr($instance['number']) : '';
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of Posts:', 'wp_deeds');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" />
        </p>
        <?php 
	}
}