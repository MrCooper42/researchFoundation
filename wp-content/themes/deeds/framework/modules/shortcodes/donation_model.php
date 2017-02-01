<?php
ob_start();
$settings = get_option( 'wp_deeds' . '_theme_options' );
$symbol = sh_set( $settings, 'currency_symbol', '$' );
$sh_currency_code = sh_set( $settings, 'currency_code', 'USD' );
$required = sh_set( $settings, 'donation_needed' );
$collected = sh_set( $settings, 'donation_collected' );
$collected_percentage = ($collected) ? ($collected * 100) / $required : '0';
if ( $donation == 'donation_bar' ) {
	?>
	<div class="donation-bar">
		<div class="donation-bg">
			<div class="row">
				<div class="col-md-4 column">
					<h3><?php echo $title ?></h3>
				</div>
				<div class="col-md-3 column">
					<a class="donate-btn donation_module" href="javascript:void(0)" data-toggle="modal"><?php echo $btn_txt ?></a>
				</div>
				<div class="col-md-5 column">
					<h5><?php _e( 'Collected Donation', 'wp_deeds' ) ?></h5>
					<div class="donation-amount">
						<i><?php echo $symbol ?></i>
							<?php
							$req_split = str_split( $collected );
							if ( $req_split )
								foreach ( $req_split as $req ):
									?>
									<i><?php echo $req; ?></i>
								<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}else if ( $donation == 'widget_donation' ) {
	?>
	<div class="widget-title"><h4><?php echo ucwords( $title ); ?></h4></div>
	<div class="coloured-donation">
		<h2><?php echo $donation_text ?></h2>
		<div class="donation-amount">
			<span><?php _e( 'Collected Needed', 'wp_deeds' ) ?></span>
			<i><?php echo $symbol ?></i>
			<?php
			$req_split = str_split( $required );
			if ( $req_split )
				foreach ( $req_split as $req ) {
					echo '<i>' . $req . '</i>';
				}
			?>
		</div>
		<a class="donate-btn donation_module" href="javascript:void(0)" data-toggle="modal"><?php echo $btn_txt ?></a>
	</div>
	<?php
} else {
	if ( $overlap == 'true' ): $lap = 'overlap';
	else: $lap = '';
	endif;
	?>
	<div class="coloured-donation <?php echo $lap ?>">
		<h2><?php echo rawurldecode( base64_decode( $title ) ) ?></h2>
		<div class="donation-amount">
			<i><?php echo $symbol ?></i>
			<?php
			$req_split = str_split( $required );
			if ( $req_split )
				foreach ( $req_split as $req ) {
					echo '<i>' . $req . '</i>';
				}
			?>
			<span><?php _e( 'NEEDED DONATION', 'wp_deeds' ) ?></span>
			<span><?php _e( 'IN', 'wp_deeds' ) ?> <strong><?php echo $country ?></strong> <?php _e( 'COUNTRIES', 'wp_deeds' ) ?>.</span>
		</div>
		<a class="donate-btn donation_module" href="javascript:void(0)" data-toggle="modal"><?php echo $btn_txt ?></a>
	</div>
	<?php
}
$output = ob_get_contents();
ob_end_clean();
