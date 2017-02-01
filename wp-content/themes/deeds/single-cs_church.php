<?php  get_header();  ?>
<?php 
if(have_posts()): while(have_posts()): the_post(); 
$church_meta = get_post_meta(get_the_ID() , 'sh_church_meta' , true) ;
$sidebar = sh_set($church_meta , 'sidebar') ;
$layout = sh_set($church_meta , 'layout') ;
$col_class = ($sidebar && $layout != 'full') ? 'col-md-8' : 'col-md-12' ;
?>
<?php $theme_options = get_option('wp_deeds'.'_theme_options'); ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" <?php if( sh_set( $church_meta, 'top_img' ) != "" ):?>style="background:url(<?php echo sh_set( $church_meta, 'top_img' );?>);"<?php endif;?>></div>	
	<div class="container"> 
		<h1><?php the_title(); ?></h1>
        <span> <?php echo sh_set($church_meta , 'sub_title'); ?></span>
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div>
<section>
	<div class="block">
		<div class="container">
			<div class="row">
            	<?php if($sidebar && $layout == 'left'): ?>
                <aside class="col-md-4 sidebar column">
					<?php dynamic_sidebar($sidebar); ?>
				</aside>
                <?php endif;?>
				<div class="<?php  echo $col_class; ?> column">
					<div class="single-page">
						<?php if(has_post_thumbnail()) the_post_thumbnail(); ?>
                        <h2><?php the_title()?></h2>

						<div class="meta">
							<ul>
								<li><i class="fa fa-reply"></i> <?php _e("Posted In " , 'wp_deeds'); ?> <?php echo sh_get_terms( array( 'type' => 'church_category' ) );?></li>
								<li><i class="fa fa-calendar-o"></i> <?php echo get_the_date();?></li>
								<?php if( sh_set( $church_meta, 'author' ) != '' ): ?><li><i class="fa fa-user"></i> <?php echo sh_set( $church_meta, 'author' ) ?></li><?php endif; ?>
							</ul>
						</div>
						
					</div><!-- TEAM SINGLE -->
					<?php the_content(); ?>
					<div class="space"></div>					
				</div>
				 <?php if($sidebar && $layout == 'right'): ?>
                    <aside class="col-md-4 sidebar column">
                        <?php dynamic_sidebar($sidebar); ?>
                    </aside>
                 <?php endif;?>
				
			</div>
		</div>
	</div>
</section>

<?php 
endwhile; endif;
get_footer(); ?>