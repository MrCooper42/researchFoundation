<?php

class SH_Woo_Commerce
{
	function __construct()
	{
		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'before_shop_loop_item' ), 10, 2 ); //Before UL
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'after_shop_loop_item' ), 10, 2 );
	}
	
	function before_shop_loop_item()
	{
		//echo '<div class="col-md-4">';
	}
	
	function after_shop_loop_item()
	{
		//echo '</div>';
	}
}

new SH_Woo_Commerce();