<?php if($section_type == 'call_to_action'): 
$bg = sh_set(wp_get_attachment_image_src($section_bg , 'large') , 0);
?>
<?php ob_start(); 
$marginsarr = explode(',' , $margins);
if( in_array('top' , (array)$marginsarr)): ?><div class="block"></div> <?php endif;
?>
	
	<div class=" blackish">
		<div class="parallax" style="background:url(<?php echo $bg; ?>);"></div>
        <div class="parallax-text">
            <h4><?php echo $sub_heading; ?></h4>
            <h3 class="special-text"><?php echo $heading ; ?><span class="rotate"><?php echo $rotating_words; ?></span></h3>
            <p><?php echo $contents; ?></p>
        </div>
	</div>
<?php if( in_array('bottom' , (array)$marginsarr)): ?><div class="block"></div> <?php endif;?>  
<script>
jQuery(document).ready(function($) {
	$(".special-text .rotate").textrotator({
		animation: "fade",
		speed: 1500
	});  
});
</script>
<?php endif; ?>
<?php 
$output = ob_get_contents();
ob_end_clean();
?>