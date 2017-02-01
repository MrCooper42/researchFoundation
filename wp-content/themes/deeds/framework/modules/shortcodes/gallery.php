<?php ob_start(); ?> 
<?php if($gallery_type == 'simple'): 
$query_args = array(
					'post_type' => 'cs_gallery' , 
					'showposts' => $number ,
					'post_status' => 'publish', 
					'orderby' => $orderby,
					'order' => $order,
					'suppress_filters' => 0,
				   );

$query = new WP_Query($query_args);

if( $columns == '4col' )
{
	$inner_col_class = 'col-md-3';
}
elseif( $columns == '3col' )
{
	$inner_col_class ='col-md-4';
}
elseif( $columns == '2col' )
{
	$inner_col_class ='col-md-6';
}


$featured_img_size = ($column == '4col') ? '370x397' : '370x253' ;

?>     
<div class="remove-ext">
    <div class="row">
        <div class="mas-gallery">
        <?php if($query->have_posts()) : while($query->have_posts()): $query->the_post();
		$gallery_meta = get_post_meta(get_the_ID() , 'sh_gallery_meta' , true);
		$gal_items = sh_set($gallery_meta , 'sh_gallery_items');
		?>
            <div class="<?php echo $inner_col_class ; ?>">
                <div class="gallery">
                    <?php if(has_post_thumbnail()) the_post_thumbnail($featured_img_size); ?> 
                    <div class="gallery-title">
                        <i class="fa fa-picture-o"></i>
                        <h3><?php the_title(); ?></h3>
                    </div>
                    <ul class="lightbox">
                    <?php foreach($gal_items as $item): 
					$item_id = sh_get_attachment_id_by_url(sh_set($item , 'gallery_item'));
					$item_img_src = sh_set(wp_get_attachment_image_src($item_id , '80x80') , 0);
					?>
                        <li>
                            <a href="<?php echo sh_set($item , 'gallery_item'); ?>" title="">
                            	<img src="<?php echo $item_img_src; ?>" alt="" />
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div><!-- GALLERY ITEM -->
            </div>
        <?php endwhile ; endif; wp_reset_query(); ?>
        </div>
    </div>
</div>

<?php elseif($gallery_type == 'masonary'):

$query_args = array(
					'post_type' => 'cs_gallery' , 
					'showposts' => $number ,
					'post_status' => 'publish', 
					'orderby' => $orderby,
					'order' => $order,
					'suppress_filters' => 0
				   );
				      
$query = new WP_Query($query_args);

if( $columns == '4col' )
{
	$inner_col_class = 'col-md-3';
}
elseif( $columns == '3col' )
{
	$inner_col_class ='col-md-4';
}
elseif( $columns == '2col' )
{
	$inner_col_class ='col-md-6';
}

?>
<div class="remove-ext">
    <div class="row">
        <div class="mas-gallery" >
        
        <?php 
		$count = 1 ; 
		if($query->have_posts()) : while($query->have_posts()): $query->the_post();
		$gallery_meta = get_post_meta(get_the_ID() , 'sh_gallery_meta' , true);
		$gal_items = sh_set($gallery_meta , 'sh_gallery_items');
		$featured_img_size = ($count == 1) ? '370x403' : '370x230' ;
		?>
            <div class="<?php echo $inner_col_class; ?>">
                <div class="gallery">
                    <?php if(has_post_thumbnail()) the_post_thumbnail($featured_img_size); ?>
                    <div class="gallery-title">
                        <i class="fa fa-picture-o"></i>
                        <h3><?php the_title(); ?></h3>
                    </div>
                    <ul class="lightbox">
                    <?php foreach($gal_items as $num=>$item):
						$item_id = sh_get_attachment_id_by_url(sh_set($item , 'gallery_item'));
						$item_img_src = sh_set(wp_get_attachment_image_src($item_id , '80x80') , 0);
					?>
                        <li>
                            <a href="<?php echo sh_set($item , 'gallery_item'); ?>" title="">
                            	<img src="<?php echo $item_img_src; ?>" alt="" />
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
		<?php 
		$count = ($count == 2) ? 1 : $count+1; 
		endwhile ; endif; wp_reset_query(); ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/js/jquery.isotope.min.js"></script>
<script>
 jQuery(window).load(function(){
  jQuery(function(){
   var $portfolio = jQuery('.mas-gallery');
   $portfolio.isotope({
   masonry: {
     columnWidth: 1
   }
   });
  });
 });
</script>				

<?php endif; ?>
<?php 
$output = ob_get_contents(); 
ob_end_clean(); ?>