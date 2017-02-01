<?php ob_start(); ?>

<?php
$settings = get_option( 'wp_deeds' . '_theme_options' );
$symbol = sh_set( $settings, 'currency_symbol', '$' );

$required = sh_set( $settings, 'donation_needed' );
$collected = sh_set( $settings, 'donation_collected' );
$collected_percentage = ($collected) ? ($collected * 100) / $required : '0';

?>
<div class="donation-box">
	<div class="needed-amount">
		<?php if ( $required ): ?>
			<span>
				<i><?php echo $symbol; ?></i>
				<?php
				$req_split = str_split( $required );
				if ( $req_split )
					foreach ( $req_split as $req ):
						?>
						<i><?php echo $req; ?></i>
					<?php endforeach; ?>
			</span>

			<i><?php _e( 'NEEDED DONATION', 'wp_deeds' ); ?></i>
		<?php endif; ?>
	</div>
	<div class="col-md-6">
		<h3><?php echo $heading; ?></h3>
		<p><?php echo $sub_heading; ?></p>
	</div>
	<div class="col-md-6">
		<a class="donate-btn donation_module" href="javascript:void(0)" data-toggle="modal"><?php _e( 'DONATE NOW', 'wp_deeds' ); ?></a>
	</div>
	<div class="needed-amount collected-amt">
		<?php if ( $collected ): ?>
			<span>
				<i><?php echo $symbol; ?></i>
				<?php
				$req_split = str_split( $collected );
				if ( $req_split )
					foreach ( $req_split as $req ):
						?>
						<i><?php echo $req; ?></i>
					<?php endforeach; ?>
			</span>
			<i><?php _e( 'NEEDED DONATION', 'wp_deeds' ); ?></i>
		<?php endif; ?>
	</div>
</div>
<?php
$output = ob_get_contents();
ob_end_clean();
