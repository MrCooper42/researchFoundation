<?php ob_start(); ?> 
<?php if($event_type == 'carousal'): 

$post_ids = array();
$query_args = array(
    'post_type' => 'cs_events' , 
    'showposts' => -1,
    'post_status' => 'publish', 
);

if(is_numeric($cat)){
    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'term_id', 'terms' => (int) $cat));
}else{
    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'slug', 'terms' => $cat));
}

$query = new WP_Query($query_args);

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
?>  
<div class="column">
    <div class="row">
        <div class="events">
            <?php 
			if(!empty($post_ids) && count($post_ids) > 0):
				foreach($post_ids as $k => $v):
				if($cc == $number){
					break;
				}
            $events_meta = sh_set(sh_set(get_post_meta($k, 'sh_event_meta' , true) , 'sh_event_options') , 0);
             ?> 
            <div class="category-box">
                <div class="category-block">
                    <div class="category-img">
                        <?php if(has_post_thumbnail($k)) echo get_the_post_thumbnail($k, '370x201'); ?>
                        <ul>
                            <li class="date"><a href="<?php the_permalink();?>" title=""><i class="fa fa-calendar-o"></i><?php echo sh_set($events_meta , 'start_date'); ?></a></li>
                            <li class="time"><a href="<?php the_permalink();?>" title=""><i class="fa fa-clock-o"></i><?php echo sh_set($events_meta , 'start_time'); ?></a></li>
                        </ul>
                    </div>
                    <h3><a href="<?php echo get_the_permalink($k); ?>" title=""><?php echo get_the_title($k); ?></a></h3>
                    <span><i class="fa fa-map-marker"></i> <?php echo sh_set($events_meta , 'location'); ?></span>
                </div>						
            </div>            
            <?php $cc++; endforeach; endif; ?>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($){
		$(".events").owlCarousel({
			autoPlay: 5000,
			slideSpeed:1000,
			singleItem : true,
			transitionStyle : "goDown",		
			navigation : false
		}); /*** CAROUSEL ***/
	});
</script>
<?php elseif($event_type == 'slider'):
$query_args = array(
					'post_type' => 'cs_events' , 
					'showposts' => $number ,
					'post_status' => 'publish', 
					'orderby' => $orderby,
					'order' => $order,
				   );
if( $cat ) $query_args['tax_query'] = array(array('taxonomy' => 'events_category','field' => 'id','terms' => (int)$cat)); 
$query = new WP_Query($query_args);
?>
<div class="row">
    <div class="events">
         <?php if($query->have_posts()):  while($query->have_posts()) : $query->the_post(); 	 
            $events_meta = sh_set(sh_set(get_post_meta(get_the_ID() , 'sh_event_meta' , true) , 'sh_event_options') , 0);
             ?> 
            <div class="category-box">
                <div class="category-block">
                    <div class="category-img">
                        <?php if(has_post_thumbnail()) the_post_thumbnail('370x248'); ?>
                        <ul>
                            <li><a href="<?php the_permalink();?>" title=""><i class="fa fa-calendar-o"></i> 
                            <?php $originalDate = sh_set($events_meta , 'start_date'); $newDate = date('d M Y', strtotime($originalDate)); echo $newDate; ?></a></li>
                            <li><a href="<?php the_permalink();?>" title=""><i class="fa fa-clock-o"></i>
                            <?php echo sh_set($events_meta , 'start_time'); ?></a></li>
                        </ul>
                    </div>
                    <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                    <span><i class="fa fa-map-marker"></i> <?php echo sh_set($events_meta , 'location'); ?></span>
                </div>						
            </div>
        <?php endwhile ; endif; wp_reset_query();?>
        
    </div>
</div>
<script>
    jQuery(document).ready(function($){
		$(".events").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 3,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,2],
			itemsTablet : [768,1],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** CAROUSEL ***/
	});
</script>
<?php elseif($event_type == 'carousal_date'):
$query_args = array(
    'post_type' => 'cs_events' , 
    'showposts' => -1,
    'post_status' => 'publish', 
    'order' => $order,
);
$post_ids = array();

if(is_numeric($cat)){
    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'term_id', 'terms' => (int) $cat));
}else{
    $query_args['tax_query'] = array(array('taxonomy' => 'events_category', 'field' => 'slug', 'terms' => $cat));
}
 
$query = new WP_Query($query_args);
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

?>
<div class="animal-events-carousel">
         <?php 
		 if(!empty($post_ids) && count($post_ids) > 0):
				foreach($post_ids as $k => $v):
				if($cc == $number){
					break;
				}
				
            $events_meta = sh_set(sh_set(get_post_meta($k, 'sh_event_meta' , true) , 'sh_event_options') , 0);
			$originalDate = sh_set($events_meta , 'start_date');
			$start_time = sh_set($events_meta, 'start_time');
			
             ?>
             <div class="animal-event">
                <div class="animal-img"><?php if(has_post_thumbnail($k)) echo get_the_post_thumbnail($k, '370x230'); ?><span><strong><?php echo date( 'd', strtotime( $originalDate) )?></strong><?php echo date( 'M Y', strtotime( $originalDate) )?></span></div>
                <div class="animal-detail">
                    <h4><a href="<?php echo get_the_permalink($k)?>" title="<?php echo get_the_title($k)?>"><?php echo get_the_title($k)?></a></h4>
                    <p><?php echo substr( sh_the_content_by_id($k), 0, 80 ) ?>...</p>
                    <ul>
                        <li><a href="#" title=""><i class="fa fa-map-marker"></i></a> <span><?php echo sh_set($events_meta , 'location'); ?></span></li>
                        <li><a href="#" title=""><i class="fa fa-comments"></i></a><span><?php echo sh_get_comment()?></span></li>
                        <li><a href="#" title=""><i class="fa fa-clock-o"></i></a><span><?php echo $originalDate." AT ".$start_time; ?></span></li>
                    </ul>
                </div>
            </div> 
        <?php $cc++; endforeach; endif; wp_reset_query();?>
        
    </div>
<script>
    jQuery(document).ready(function($){
		$(".animal-events-carousel").owlCarousel({
			autoPlay: 3500,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : false,
		});
	});
</script>
<?php endif; ?>
<?php 
$output = ob_get_contents(); 
ob_end_clean(); ?>