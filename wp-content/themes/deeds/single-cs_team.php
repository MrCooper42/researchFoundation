<?php  get_header();  ?>
<?php 
if(have_posts()): while(have_posts()): the_post(); 
$team_meta = get_post_meta(get_the_ID() , 'sh_team_meta' , true) ;
$team_page_options = sh_set(sh_set($team_meta , 'sh_team_page_options') , 0);
$team_info = sh_set(sh_set($team_meta , 'sh_team_options') , 0);
$team_social = sh_set($team_meta , 'sh_team_social_profile'); 
$qual = sh_set(sh_set($team_meta , 'sh_team_qualification') , 0);
$sidebar = sh_set($team_page_options , 'sidebar') ;
$layout = sh_set($team_page_options , 'layout') ;
$col_class = ($sidebar && $layout != 'full') ? 'col-md-8' : 'col-md-12' ;
?>
<?php $theme_options = get_option('wp_deeds'.'_theme_options'); ?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>

<?php if( sh_set($team_page_options, 'show_team_banner') ) : ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" <?php if( sh_set( $team_page_options, 'top_img' ) != "" ):?>style="background:url(<?php echo sh_set( $team_page_options, 'top_img' );?>);"<?php endif;?>></div>	
	<div class="container"> 
		<h1><?php the_title(); ?></h1>
        <span><?php echo sh_set($team_page_options , 'sub_title'); ?></span>
        <?php 
			if( sh_set($team_page_options, 'show_breadcrumbs') ) :
				echo sh_get_the_breadcrumb(); 
			 endif; 
		?>
	</div>
</div>
<?php endif; ?>

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
					<div class="team-single">
						<div class="member-img">
							<?php if(has_post_thumbnail()) the_post_thumbnail('370x403'); ?>
						</div>

						<div class="team-detail">
							<h3><?php the_title(); ?></h3>
							<ul class="team-list">
								<?php if(sh_set($team_info , 'designation')): ?> <li><i class="fa fa-user"></i> <?php echo sh_set($team_info , 'designation'); ?> </li><?php endif; ?> 
								<?php if(sh_set($team_info , 'address')): ?><li><i class="fa fa-home"></i> <?php echo sh_set($team_info , 'address'); ?> </li><?php endif; ?> 
								<?php if(sh_set($team_info , 'ph_number')): ?><li><i class="fa fa-phone"></i> <?php echo sh_set($team_info , 'ph_number'); ?> </li><?php endif; ?> 
								<?php if(sh_set($team_info , 'website')): ?><li><i class="fa fa-google"></i> <?php echo sh_set($team_info , 'website'); ?> </li><?php endif; ?> 
								<?php if(sh_set($team_info , 'email')): ?><li><i class="fa fa-envelope"></i> <?php echo sh_set($team_info , 'email'); ?> </li><?php endif; ?> 
							</ul>
                            <ul class="social-media">
							<?php foreach($team_social as $social): 
								$icon = str_replace('icon' , 'fa' , sh_set($social , 'social_icon'));
							?>
								<li><a href="<?php echo sh_set($social , 'social_link'); ?>" title=""><i class="fa <?php echo $icon; ?>"></i></a></li>
							<?php endforeach ; ?>
						</ul>
						</div>
						
					</div><!-- TEAM SINGLE -->
					<?php the_content(); ?>
					<div class="space"></div>
					<div class="simple-text">
						<h3><?php _e("QUALIFICATION" , 'wp_deeds'); ?>:</h3>
						<p><?php echo sh_set($qual , 'content'); ?></p>
					</div>
					<ul>
                    <?php 
					$qualification = sh_set($qual , 'sh_team_qualification_info');
					foreach((array)$qualification as $q): ?>
						<li><i class="fa fa-check-square"></i><?php echo sh_set($q , 'qualification_line'); ?></li>
                    <?php endforeach; ?>
					</ul>
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