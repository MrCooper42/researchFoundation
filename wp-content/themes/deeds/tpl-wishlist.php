<?php /* Template Name: Wishlist */
get_header(); ?>
<?php global $current_user, $post;
get_currentuserinfo();

$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);
$meta = get_user_meta( $current_user->ID, '_os_product_wishlist', true );
$meta = array_filter( (array)$meta );
?>

<?php $bg_img = sh_set($settings , 'header_bg') ? 'background-image:url('.sh_set($settings , 'header_bg'). ');' : '' ;?>
<?php $theme_options = get_option('wp_deeds'.'_theme_options');?>
<?php if( sh_set( $theme_options, 'custom_header' ) == 'header1' || sh_set( $theme_options, 'custom_header' )== 'header3' || sh_set( $theme_options, 'custom_header' )== 'header5' || sh_set( $theme_options, 'custom_header' )== 'header6' || sh_set( $theme_options, 'custom_header' )== 'header7'): $rem_gap = 'extra-gap'; else: $rem_gap = ''; endif; ?>
<div class="page-top <?php echo $rem_gap; ?>">
	<div class="parallax" style="background:url(<?php echo sh_set($settings , 'top_img');?>);"></div>	
	<div class="container"> 
		<h1><?php the_title(); ?></h1>
        <span> <?php echo sh_set($settings , 'sub_title'); ?></span>
		<?php echo sh_get_the_breadcrumb(); ?>
	</div>
</div>


<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-md-12"> 
                    
					<?php while( have_posts() ): the_post(); ?>
                    <?php the_content();?>
                    <?php endwhile;?>
                    <?php if( is_user_logged_in() ): ?>
                    <div class="block-center" id="block-history">
                        <table class="std data-table table">
                            <thead>
                                <tr>
                                    <th class="first_item"><?php _e('Image', 'wp_deeds'); ?></th>
                                    <th class="first_item"><?php _e('Name', 'wp_deeds'); ?></th>
                                    <th class="item mywishlist_second"><?php _e('Direct Link', 'wp_deeds'); ?></th>
                                    <th class="last_item mywishlist_first"><?php _e('Delete', 'wp_deeds'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( (array)$meta as $met ): ?>
                                <tr id="wishlist_3">
                                    <td style="width:50px;"><?php echo get_the_post_thumbnail( $met, array(50, 50) ); ?></td>
                                    <td style="width:200px;"><a href="<?php echo get_permalink( $met ); ?>"><?php echo get_the_title( $met ); ?></a></td>
                                    <td><a href="<?php echo get_permalink( $met ); ?>">
                                        <?php _e('View', 'wp_deeds'); ?>
                                        </a></td>
                                    <td class="wishlist_delete"><a class="" rel="product_del_wishlist" data-id="<?php echo $met; ?>" href="javascript:;">
                                        <?php _e('Delete', 'wp_deeds'); ?>
                                        </a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <?php $acc_page = get_option('user_account_url'); ?>
                    <h2><?php printf(__('To view this page sign in at <a href="%s" title="Account Page">Account Page</a>', 'wp_deeds'), $acc_page); ?></h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>






