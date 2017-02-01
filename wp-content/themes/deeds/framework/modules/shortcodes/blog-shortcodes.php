<?php 

$query_args = array('post_type' => 'post' , 'showposts' => 1 ,'post_status' => 'publish');

if(is_numeric($cat)){
    $query_args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => (int) $cat));
}else{
    $query_args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => $cat));
}

$query = new WP_Query($query_args);
?>

<?php if($blog_type == 'category'): ?>
<?php if($query->have_posts()):  while($query->have_posts()) : $query->the_post(); 	 ?> 
<?php ob_start(); 
?>    
<div class="column">
    <div class="category-box">
        <div class="category-block">
            <div class="category-img">
                <?php if(has_post_thumbnail()) the_post_thumbnail('370x201'); ?>
            </div>
            <h3><a href="<?php the_permalink();?>" title=""><?php the_title();?></a></h3>
            <span><i class="fa fa-calendar-o"></i> <?php echo get_the_date('d M Y'); ?></span>
        </div>
    </div>
</div>
<?php endwhile ; endif; wp_reset_query(); 
?>
<?php elseif($blog_type == 'slider'): 

global $wp_query;

$args = array(
    'post_type' => 'post' ,
    'showposts' => $number ,
    'post_status' => 'publish', 
    'orderby' => $orderby,
    'order' => $order,
    'paged' => (isset( $wp_query->query['paged'] )) ? $wp_query->query['paged'] : 1,
);

if(is_numeric($cat)){
    $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => (int) $cat));
}else{
    $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => $cat));
}

/*$blog_posts = query_posts($args);
$chunks = array_chunk($blog_posts , 2);
printr($chunks);*/

$query = new WP_Query($args);

?>
<?php ob_start(); 
?> 

<div class="column">
    <div class="blog-carousel">
    	<?php echo ($slider == "true") ? '<div class="blog-slide remove-ext">' : ''; 
			while($query->have_posts()) : $query->the_post();
		?> 
            <div class="blog-post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="image">
                            <?php the_post_thumbnail(array(370,230)); ?>
                            <a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="blog-detail">
                            <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                            <p><?php 
                                $limit = ($limit) ? $limit : '50';
                                echo substr(strip_tags(get_the_content(get_the_ID())) , 0 , $limit); 
                            ?></p>
                            <span><i class="fa fa-calendar-o"></i><?php echo get_the_time('M-d-Y'); ?></span>
                            <?php if($show_readmore == "true") : ?>
                            <a title="" href="<?php the_permalink(); ?>" class="readmore"><?php _e('Read More', 'wp_deeds') ?></a>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
		<?php  
			endwhile; wp_reset_postdata(); 
			echo ($slider == "true") ? '</div>' : ''; 
			if ($slider != "true") : 
				echo sh_the_pagination(array( 'total' => $query->max_num_pages ), 0, true);
            endif; 
		?>
        
    </div>
</div><!-- BLOG CAROUSEL -->
<?php if ($slider == "true") : ?>
<script>
jQuery(document).ready(function($) {
    $(".blog-carousel").owlCarousel({
			autoPlay: 5000,
			slideSpeed:1000,
			singleItem : true,
			transitionStyle : "backSlide",		
			navigation : false
		}); /*** BLOG CAROUSEL ***/
});
</script>
<?php endif; ?>

<?php elseif($blog_type == 'news'): 
$args = array(
			'post_type' => 'post' ,
			'showposts' => $number ,
			'post_status' => 'publish', 
			'orderby' => $orderby,
			'order' => $order,
			'cat' => (int)$cat,
); 
$query = new WP_Query($args);
    if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
    
        <div class="latest-news">
            <div class="news">
                <div class="news-date"><span><i class="fa fa-calendar-o"></i><?php echo get_the_date(); ?></span></div>
                <div class="row">
                    <div class="col-md-7">
                        <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                        <p><?php echo substr(strip_tags(get_the_content()) , 0 , 100); ?></p>
                    </div>
                    <div class="col-md-5 news-img">
                        <div class="image">
                            <?php if(has_post_thumbnail()) the_post_thumbnail('170x190'); ?>
                            <a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link"></i></a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    <?php endwhile ; endif; wp_reset_query(); endif;?>
<?php 
$output = ob_get_contents(); 
ob_clean(); ?>