<?php //if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<?php /*?><?php foreach ($items as $item): ?>
<label>
	<?php $checked = (in_array($item->value, $value)); ?>
	<input <?php if($checked) echo 'checked'; ?> class="vp-input<?php if($checked) echo " checked"; ?>" type="checkbox" name="<?php echo $name; ?>" value="<?php echo $item->value; ?>" />
	<span></span><?php echo $item->label; ?>
</label>
<?php endforeach; ?><?php */?>

	<?php 
	
		global $post_type, $post;
		
		$transaction_array = get_option('general_donation');
		
		
		if(!empty($transaction_array)){
		
		echo '<div id="accordion">';
		foreach($transaction_array as $trasaction):
			echo '<h2>'.__('Payer ID:').''.sh_set($trasaction, 'ship_to_name').' '.sh_set($trasaction, 'payer_id').'</h2>
					<div class="content">
					  <ul>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Transacction ID').'</td>
							  <td>'.sh_set($trasaction, 'transaction_id').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Transacction Type').'</td>
							  <td>'.sh_set($trasaction, 'transaction_type').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Payment Type').'</td>
							  <td>'.sh_set($trasaction, 'payment_type').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Order Time').'</td>
							  <td>'.sh_set($trasaction, 'order_time').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Amount').'</td>
							  <td>'.sh_set($trasaction, 'amount').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Currency Code').'</td>
							  <td>'.sh_set($trasaction, 'currency_code').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Fee Amount').'</td>
							  <td>'.sh_set($trasaction, 'fee_amount').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Settle Amount').'</td>
							  <td>'.sh_set($trasaction, 'settle_amount').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Tax Amount').'</td>
							  <td>'.sh_set($trasaction, 'tax_amount').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Exchange Rate').'</td>
							  <td>'.sh_set($trasaction, 'exchange_rate').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Payment Status').'</td>
							  <td>'.sh_set($trasaction, 'payment_status').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Pending Reason').'</td>
							  <td>'.sh_set($trasaction, 'pending_reason').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Reason Code').'</td>
							  <td>'.sh_set($trasaction, 'reason_code').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Donation Type').'</td>
							  <td>'.sh_set($trasaction, 'donation_type').'</td>
							</tr>
						  </table>
						</li>
					  </ul>
					</div>';
		endforeach;
		echo '</div>';
		echo '<script type="text/ecmascript">
				jQuery(document).ready(function($) {
					$(function() {
						$("#accordion .content").hide();
						$("#accordion h2:first").addClass("active").next().slideDown("slow");
						$("#accordion h2").click(function() {
							if($(this).next().is(":hidden")) {
								$("#accordion h2").removeClass("active").next().slideUp("slow");
								$(this).toggleClass("active").next().slideDown("slow");
							}
						});
					});
				});
			</script>';
		}else{
			echo __('There is no transaction', 'wp_deeds');
		}
	
	?>

<?php //if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot'); ?>