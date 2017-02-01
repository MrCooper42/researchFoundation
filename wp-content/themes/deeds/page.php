<?php
global $post_type, $wp_query;
get_header();
$settings = sh_set( sh_set( get_post_meta( get_the_ID(), 'sh_page_meta', true ), 'sh_page_options' ), 0 );
$theme_options = get_option( 'wp_deeds' . '_theme_options' );

$sidebar = sh_set( $settings, 'sidebar' );
$position = sh_set( $settings, 'layout' );
$span = ( $sidebar ) ? 'col-md-8' : 'col-md-12';

if ( class_exists( 'bbPress' ) ) {
	$bbpress = is_bbpress();
} else {
	$bbpress = '';
}

if ( class_exists( 'BuddyPress' ) ) {
	$buddy = 'true';
} else {
	$buddy = '';
}
?>
<?php
if ( sh_set( $settings, 'home' ) != 1 ):
	if ( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' ) == 'header3' || sh_set( $theme_options, 'custom_header' ) == 'header5' || sh_set( $theme_options, 'custom_header' ) == 'header6' || sh_set( $theme_options, 'custom_header' ) == 'header7' ): $rem_gap = 'extra-gap';
	else: $rem_gap = '';
	endif;
	?>

	<?php if ( !$settings ) { ?>
		<?php if ( sh_woo_pages( get_the_ID() ) == 'true' ) { ?>
			<div class="page-top <?php echo $rem_gap ?>">
				<div class="parallax" style="background:url();"></div>
				<div class="container">
					<h1><?php the_title(); ?></h1>
                    <span> <?php echo sh_set( $settings, 'sub_title' ); ?></span>
					<?php echo sh_get_the_breadcrumb(); ?>
				</div>
			</div>
			<?php
		} elseif ( $buddy == 'true' ) {
			?>
			<div class="page-top <?php echo $rem_gap ?>">
				<div class="parallax" style="background:url();"></div>
				<div class="container">
					<h1><?php the_title(); ?></h1>
                    <span> <?php echo sh_set( $settings, 'sub_title' ); ?></span>
					<?php echo sh_get_the_breadcrumb(); ?>
				</div>
			</div>
			<?php
		}
	} elseif ( $post_type != 'forum' || $post_type != 'reply' || $post_type != 'topic' || $bbpress != 1 || sh_woo_pages( get_the_ID() ) == 'false' ) {
		?>
		<div class="<?php
		if ( sh_set( $settings, 'breadcumb' ) == 1 ): echo 'page-top';
		endif;
		?> <?php echo $rem_gap; ?>">
				 <?php if ( sh_set( $settings, 'breadcumb' ) == 1 ): ?>
				<div class="parallax" style="background:url(<?php echo sh_set( $settings, 'top_img' ); ?>);"></div>
			<?php endif; ?>
			<div class="container">
				<?php if ( sh_set( $settings, 'breadcumb' ) == 1 ): ?>
					<h1><?php the_title(); ?><span> <?php echo sh_set( $settings, 'sub_title' ); ?></span></h1>
					<?php
					echo sh_get_the_breadcrumb();
				endif;
				?>
			</div>
		</div>
	<?php } endif; ?>
<?php if ( $post_type == 'forum' || $post_type == 'reply' || $post_type == 'topic' || sh_woo_pages( get_the_ID() ) == 'true' ): ?>
	<?php while ( have_posts() ): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php elseif ( $buddy == 'true' ): ?>
	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<?php if ( $position == 'left' ) : ?>
						<aside class="col-md-4 sidebar column">
							<?php dynamic_sidebar( $sidebar ); ?>
						</aside>
					<?php endif; ?>
					<div class="<?php echo $span; ?> column">
						<?php while ( have_posts() ): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					</div>
					<?php if ( $position == 'right' ) : ?>
						<aside class="col-md-4 sidebar column">
							<?php dynamic_sidebar( $sidebar ); ?>
						</aside>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php else: ?>
	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<?php if ( $position == 'left' ) : ?>
						<aside class="col-md-4 sidebar column">
							<?php dynamic_sidebar( $sidebar ); ?>
						</aside>
					<?php endif; ?>
					<div class="<?php echo $span; ?> column">
						<div class="default">
							<?php while ( have_posts() ): the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; ?>
						</div>
					</div>
					<?php if ( $position == 'right' ) : ?>
						<aside class="col-md-4 sidebar column">
							<?php dynamic_sidebar( $sidebar ); ?>
						</aside>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php
endif;
get_footer();
