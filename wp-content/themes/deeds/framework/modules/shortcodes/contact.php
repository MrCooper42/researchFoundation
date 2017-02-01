<?php 
ob_start(); 
if($contact_type == 'info'): ?>

<div class="column">
    <h4><?php echo $title; ?></h4>
    <div class="space"></div>
    <p><?php echo $text; ?></p>
    <div class="space"></div>
    <ul class="social-media">
        <?php if($linkedin): ?><li><a title="" href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
        <?php if($gplus): ?><li><a title="" href="<?php echo $gplus; ?>"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
        <?php if($twitter): ?><li><a title="" href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
        <?php if($facebook): ?><li><a title="" href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
    </ul>
</div>

<?php elseif($contact_type == 'form'): ?>


<div class="column">
    <h4><?php echo $title; ?></h4>
    <div class="space"></div>
    <div id="msgs2"></div>
    <form id="church_contactform" name="contactform" action="<?php echo admin_url('admin-ajax.php?action=dictate_ajax_callback&subaction=sh_contact_form_submit');?>" method="post" class="theme-form">
       	
        <input type="text" placeholder="<?php _e("Name" , 'wp_deeds'); ?>" id="names" class="half-field form-control" name="contact_name">
        <input type="text" placeholder="<?php _e("Email" , 'wp_deeds'); ?>" id="emails" class="half-field form-control" name="contact_email">
        <input type="hidden" value="<?php echo esc_attr($email); ?>" name="to_email" id="to-email" />
        <input type="hidden" value="<?php echo esc_attr($site_key); ?>" name="ar_site_key" id="ar_site_key" />
        <textarea placeholder="Description" id="commentss" class="form-control" name="contact_comments"></textarea>
        <input type="submit" value="<?php _e("SUBMIT" , 'wp_deeds'); ?>" id="submit2" class="submit">
        <div class="g-recaptcha" id="form-captcha" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
    </form><!--- FORM -->
    
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    <div id="admn_url" style="display:none"><?php echo get_template_directory_uri();?></div>
</div>

<script>
jQuery(document).ready(function($) {
	
	$('#church_contactform').submit(function(){
		var url = document.getElementById('admn_url').innerHTML;
		var action = $(this).attr('action');
		$("#msgs2").slideUp(750,function() {
		$('#msgs2').hide();
 		$('#submit2')
			.after('<img class="loader" src='+url+'/images/ajax-loader.gif  />').attr("disabled","disabled");

		$.post(action, {
			name: $('#names').val(),
			email: $('#emails').val(),
			comments: $('#commentss').val(),
			to_email: $("#to-email").val(),
                        site_key: $("#ar_site_key").val(),
			captcha: $(".g-recaptcha-response").val(),
		},
			function(data){
				document.getElementById('msgs2').innerHTML = data;
				$('#msgs2').slideDown('slow');
				$('#church_contactform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit2').removeAttr('disabled');
				if(data.match('success') != null) $('#church_contactform').slideUp('slow');

			}
		);
		});
		return false;
	});
		    

});
</script>

<?php elseif($contact_type == 'boxes'): ?>

<div class="contact-info">
    <div class="col-md-3">
        <div class="info-block">
            <i class="fa fa-home"></i>
            <p><?php echo $address; ?></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-block">
            <i class="fa fa-info"></i>
            <p><?php echo $website; ?></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-block">
            <i class="fa fa-envelope-o"></i>
            <p><?php echo $email; ?></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-block">
            <i class="fa fa-mobile"></i>
            <p><?php echo $phone ; ?></p>
        </div>
    </div>
</div>

				
<?php endif; ?>

<?php $output = ob_get_contents();
 ob_end_clean();
 
 ?>