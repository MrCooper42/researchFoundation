<?php $theme_options = get_option('wp_deeds'.'_theme_options');
$bg_src = sh_set(wp_get_attachment_image_src($bg_img , 'large') , 0);
?>

<?php ob_start(); 
$cb = new Codebird;
$cb->setConsumerKey(sh_set($theme_options, 'twitter_api'), sh_set($theme_options, 'twitter_api_secret'));
$cb->setToken(sh_set($theme_options, 'twitter_token'), sh_set($theme_options, 'twitter_token_Secret'));
$reply = (array) $cb->statuses_userTimeline(array('count'=>$number, 'screen_name'=>$twitter_id));
if( isset( $reply['httpstatus'] ) ) unset( $reply['httpstatus'] );
$marginsarr = explode(',' , $margins);
if( in_array('top' , (array)$marginsarr)): ?><div class="block"></div> <?php endif;
?>      
<div class="tweets">
	<div class="parallax" style="background:url(<?php echo $bg_src; ?>);"></div>
	<div class="container">
		<div class="twitter-icon">
			<i class="fa fa-twitter"></i>
		</div>		
		<div class="tweet-carousel">
        <?php foreach( $reply as $k => $v ): 
		$text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', sh_set( $v, 'text'));
		?>
			<div class="tweet-text">
				<p><?php echo $text; ?></p>
				<span>(ABOUT 5 HOURS AGO)</span>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</div>
<?php if( in_array('bottom' , (array)$marginsarr)): ?><div class="block"></div> <?php endif;?> 
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php $output = ob_get_contents();
 ob_end_clean();
 
 ?>