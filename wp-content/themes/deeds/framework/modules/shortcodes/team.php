<?php ob_start(); 
$query_args = array(
    'post_type' => 'cs_team' ,
    'showposts' => $number ,
    'post_status' => 'publish', 
    'orderby' => $orderby,
    'order' => $order,
    );

if(is_numeric($cat)){
    $query_args['tax_query'] = array(array('taxonomy' => 'team_category', 'field' => 'term_id', 'terms' => (int) $cat));
}else{
    $query_args['tax_query'] = array(array('taxonomy' => 'team_category', 'field' => 'slug', 'terms' => $cat));
}

$query = new WP_Query($query_args);

?>
<div class="row">
	<div class="team-carousel">
    <?php if($query->have_posts()):  while($query->have_posts()) : $query->the_post(); 	 
          $team_meta = get_post_meta(get_the_ID() , 'sh_team_meta' , true) ;
          $team_info = sh_set(sh_set($team_meta , 'sh_team_options') , 0);
          $team_social = sh_set($team_meta , 'sh_team_social_profile');
    ?>
    <div class="member">
        <div class="team">
        <div class="team-img">
            <?php if(has_post_thumbnail()) the_post_thumbnail('370x403'); ?>
        </div>
        <div class="member-detail">
            <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
            <span><?php echo sh_set($team_info , 'designation'); ?></span>
            <p><?php echo substr(strip_tags(get_the_content(get_the_ID())) , 0 , 100); ?></p>
        </div>
        </div>
    </div>
    <?php endwhile ; endif; wp_reset_query(); ?>
</div>
</div>
<script>
jQuery(document).ready(function($) {
	var col = $('div.team-carousel').parent('div').parent('div').attr('class');
	
	if( col == 'col-md-12 column ' || col == 'col-md-11 column ' ){
		$(".team-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** TEAM CAROUSEL ***/
	}
	else if( col == 'col-md-10 column ' || col == 'col-md-9 column ' || col == 'col-md-8 column ' ){
		$(".team-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 3,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** TEAM CAROUSEL ***/
	}
	else if( col == 'col-md-6 column ' || col == 'col-md-4 column ' ){
		$(".team-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 2,
			itemsDesktop : [1199,2],
			itemsDesktopSmall : [979,2],
			itemsTablet : [768,2],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** TEAM CAROUSEL ***/
	}
	else if( col == 'col-md-3 column ' || col == 'col-md-2 column ' || col == 'col-md-1 column ' ){
		$(".team-carousel").owlCarousel({
			autoPlay: 8000,
			rewindSpeed : 3000,
			slideSpeed:2000,
			items : 1,
			itemsDesktop : [1199,1],
			itemsDesktopSmall : [979,1],
			itemsTablet : [768,1],
			itemsMobile : [479,1],
			navigation : false,
		}); /*** TEAM CAROUSEL ***/
	}
	
    
});
</script>

<?php $output = ob_get_contents();
 ob_end_clean();
 
 ?>