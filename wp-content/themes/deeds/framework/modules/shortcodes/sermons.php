<?php ob_start();  
if($sermons == 'parallex'): 
$query_args = array(
					'post_type' => 'cs_sermons' , 
					'showposts' => $number ,
					'post_status' => 'publish', 
					'orderby' => $orderby,
					'order' => $order,
					'suppress_filters' => 0
 				);
$query = new WP_Query($query_args); 
?>
    <div class="pastors-carousel">
         <?php 
         if($query->have_posts()):  while($query->have_posts()) : $query->the_post(); 
         $meta = get_post_meta( get_the_ID() , 'sh_sermon_meta' , true );
         $sermon_info = sh_set(sh_set($meta , 'sh_sermon_options') , 0);
         $pastor_info = sh_set(sh_set($meta , 'sh_sermon_pastor') , 0);
         ?>
        <div class="pastors-message">
            <h2><?php the_title(); ?></h2>
            <p><?php echo substr(strip_tags(get_the_content()) , 0 , 200); ?></p>
            <div class="pastors-detail">
                <div class="col-md-4">
                    <h5><?php echo sh_set($pastor_info , 'pastor_name'); ?></h5>
                    <span><?php echo sh_set($pastor_info , 'pastor_desig'); ?></span>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo sh_set($pastor_info , 'pastor_image'); ?>" alt="" />
                </div>

                <div class="col-md-4">
                    <h6><i class="fa fa-calendar-o"></i> <?php echo get_the_time('M-d-Y' , get_the_ID()); ?></h6>
                    <ul class="dark sermon-media lightbox">
                    	<?php $host = get_video_host(sh_set($sermon_info , 'sermon_vid_link'));  ?>
                        <li><a href="<?php echo sh_set($sermon_info , 'sermon_vid_link'); ?>" data-poptrox="<?php echo esc_attr($host); ?>" title=""><i class="fa fa-film"></i></a></li>
                        <li><a title=""><i class="audio-btn fa fa-headphones"></i>
                            <div class="audioplayer"><audio id="player2" src="<?php echo sh_set($sermon_info , 'audio_upload'); ?>"></audio><span class="cross">X</span></div>
                        </a></li>
                        <li><a href="<?php echo sh_set($sermon_info , 'download_link'); ?>" title=""><i class="fa fa-download"></i></a></li>
                        <li><a href="<?php echo sh_set($sermon_info , 'pdf_file'); ?>" title=""><i class="fa fa-book"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php  endwhile ; endif; wp_reset_query(); ?>
    </div>

 
<?php /*?><script>
jQuery(document).ready(function($) {
	$(".pastors-carousel").owlCarousel({
			autoPlay: 5000,
			slideSpeed:1000,
			singleItem : true,
			transitionStyle : "fadeUp",		
			navigation : true
		});
    $('audio,video').mediaelementplayer();
});
</script><?php */?>

<?php 
elseif($sermons == 'wrapper'): 
$sermon_data = get_post($sermon);
$sermon_meta = get_post_meta(sh_set($sermon_data , 'ID') , 'sh_sermon_meta' , true);
$sermon_info = sh_set(sh_set($sermon_meta , 'sh_sermon_options') , 0);
$pastor_info = sh_set(sh_set($sermon_meta , 'sh_sermon_pastor') , 0); 
?>

<div class="remove-gap">
    <div class="featured-sermon-box <?php echo $overlp?>">
                    <div class="featured-sermon-title"><i class="fa fa-bullhorn"></i></div>
                    <div class="featured-sermon">
                        <div class="row">
                            <div class="col-md-8">
                            	<h3><a title="" href="<?php echo get_permalink(sh_set($sermon_data , 'ID'));?>"><?php echo get_the_title(sh_set($sermon_data , 'ID'));?></a></h3>
                                <p><?php echo substr(strip_tags(sh_set($sermon_data , 'post_content')) , 0 , 150); ?></p>
                            </div>
                            <div class="col-md-4">
                                <ul class="sermon-media lightbox">
                                	<?php $host = get_video_host(sh_set($sermon_info , 'sermon_vid_link'));  ?>
                                    <li><a href="<?php echo sh_set($sermon_info , 'sermon_vid_link'); ?>" data-poptrox="<?php echo esc_attr($host); ?>" title=""><i class="fa fa-film"></i></a></li>
                                    <li><a title=""><i class="audio-btn fa fa-headphones"></i>
                                        <div class="audioplayer"><audio id="player2" src="<?php echo sh_set($sermon_info , 'audio_upload'); ?>"></audio><span class="cross">X</span></div>
                                    </a></li>
                                    <li><a href="<?php echo sh_set($sermon_info , 'download_link'); ?>" title=""><i class="fa fa-download"></i></a></li>
                                    <li><a href="<?php echo sh_set($sermon_info , 'pdf_file'); ?>" title=""><i class="fa fa-book"></i></a></li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
</div>
<?php elseif($sermons == 'latest'): 
		$query_args = array(
					'post_type' => 'cs_sermons' , 
					'showposts' => $number ,
					'post_status' => 'publish', 
					'orderby' => $orderby,
					'order' => $order,
					'suppress_filters' => 0
 				);
$query = new WP_Query($query_args); 
?>
<div class="column">
    <div class="latest-sermons  remove-ext">
		<?php 
		 if($query->have_posts()):  while($query->have_posts()) : $query->the_post(); 
		 $meta = get_post_meta( get_the_ID() , 'sh_sermon_meta' , true );
		 $sermon_info = sh_set(sh_set($meta , 'sh_sermon_options') , 0);
		 $pastor_info = sh_set(sh_set($meta , 'sh_sermon_pastor') , 0);
		 ?>
						<div class="sermon">
							<div class="row">
								<div class="col-md-3">
									<div class="image">
										 <?php if(has_post_thumbnail()) the_post_thumbnail('270x270'); ?>
										<a href="<?php the_permalink();?>" title=""><i class="fa fa-link"></i></a>
									</div>
								</div>
								<div class="col-md-9">
									<h3><a href="<?php the_permalink();?>" title=""><?php the_title();?></a></h3>
									<span><i class="fa fa-calendar-o"></i> <?php echo get_the_date('F d, Y');?></span>
									<p><?php echo substr(strip_tags(get_the_content()) , 0 , 100); ?></p>
								</div>
								<div class="hover-in">
									<ul class="sermon-media lightbox">
                                    	<?php $host = get_video_host(sh_set($sermon_info, 'sermon_vid_link')); ?>
										<li><a href=<?php echo esc_url(sh_set($sermon_info, 'sermon_vid_link')); ?>" data-poptrox="<?php echo esc_attr($host); ?>" title=""><i class="fa fa-film"></i></a></li>
										<li><a title=""><i class="audio-btn fa fa-headphones"></i>
											<div class="audioplayer"><audio id="player2" src="<?php echo sh_set($sermon_info , 'audio_upload'); ?>"></audio><span class="cross">X</span></div>
										</a></li>
										<li><a target="_blank" href="<?php echo sh_set($sermon_info , 'download_link'); ?>" title=""><i class="fa fa-download"></i></a></li>
										<li><a target="_blank" href="<?php echo sh_set($sermon_info , 'pdf_file'); ?>" title=""><i class="fa fa-book"></i></a></li>
									</ul>
								</div>
							</div>
						</div><!-- SERMON -->
         <?php  endwhile ; endif; wp_reset_query();?>
    </div>
</div>
<?php endif; ?>
<?php 
$output = ob_get_contents();
ob_end_clean();
?>