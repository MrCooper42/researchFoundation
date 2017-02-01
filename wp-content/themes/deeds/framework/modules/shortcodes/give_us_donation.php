<?php
ob_start();
$settings = get_option( 'wp_deeds' . '_theme_options' );
?>
<div class="donation-appeal">
	<div class="parallax-title">
        <span><?php _e( 'We Need Your Help', 'wp_deeds' ) ?></span>
		<h3 class="special-text"><?php echo rawurldecode( base64_decode( $rotating_title ) ); ?></h3>

	</div>
	<p><?php echo rawurldecode( base64_decode( $main_text ) ); ?></p>
	<a class="donate-btn donation_module" href="javascript:void(0)" data-toggle="modal"><?php echo $donate_btn_text ?></a>

	<?php if ( $detail_link ): ?>
		<a href="<?php echo $detail_link_anchor; ?>" title=""><?php echo $detail_link_text ?></a>
	<?php endif; ?>
</div>
<?php
$output = ob_get_contents();
ob_end_clean();
