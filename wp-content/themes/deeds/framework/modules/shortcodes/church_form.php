<?php  ob_start(); ?>

<div id="toggle" class="simple-toggle">
<?php if( $ch_title ): ?>
<div class="toggle-item">
    <h2><img src="<?php echo get_template_directory_uri()?>/images/icon2.png" alt="" /><?php echo $ch_title?></h2>
    <div class="content">
        <p><?php echo $ch_txt?></p>
            <script>
            (function() {
              var cx = '006578059515761367767:-gxu8i4xyie';
              var gcse = document.createElement('script');
              gcse.type = 'text/javascript';
              gcse.async = true;
              gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(gcse, s);
            })();
          </script>
            <gcse:search></gcse:search>
	</div>
</div>
<?php endif; ?>

<?php if( $ch_p_title ): ?>
    <div class="toggle-item">
		<h2><img src="<?php echo get_template_directory_uri()?>/images/icon3.png" alt="" /><?php echo $ch_p_title?></h2>
		<div class="content">
			<p><?php echo $ch_p_txt; ?></p>
			<div id="msgs"></div>
                        
			<form id="req_prayers" name="req_prayers" method="post" action="<?php echo admin_url('admin-ajax.php?action=dictate_ajax_callback&subaction=sh_prayers'); ?>">
				<input type="text" id="name" placeholder="<?php _e( "Name", 'wp_deeds' ); ?>" required="required" />
				<input type="email" id="email" placeholder="<?php _e( "Email", 'wp_deeds' );?>" required="required" />
				<textarea id="message" name="message" placeholder="<?php _e( "Write Your Words", 'wp_deeds' );?>" required="required"></textarea>
				<button type="submit" id="submit" class="button2"><i class="fa fa-envelope"></i><?php _e( "Send", 'wp_deeds' )?></button>
			</form>
			<script type="text/javascript">
						jQuery(document).ready(function($) {
							
							$('#req_prayers').submit(function(){
								var action = $(this).attr('action');
								$("#msgs").slideUp(750,function() {
									var url = document.getElementById('admn_url').innerHTML;
								$('#msgs').hide();
								$('#submit')
									.after('<img class="loader" src='+url+'/images/ajax-loader.gif  />').attr("disabled","disabled");
						
								$.post(action, {
									name: $('#name').val(),
									email: $('#email').val(),
									message: $('#message').val(),
								},
									function(data){
										document.getElementById('msgs').innerHTML = data;
										$('#msgs').slideDown('slow');
										$('#req_prayers img.loader').fadeOut('slow',function(){$(this).remove()});
										$("#submit").removeAttr('disabled');
										if(data.match("success") != null) $("#req_prayers").slideUp("slow");										
										/*if(data.match("success") == null)
										{
											setTimeout(function() {
												  $('#msgs').slideUp("slow");
											}, 5000);
										}*/
									}
								);
								});
								return false;
							});
									
						
						});
						</script>
		</div>
	</div>
<?php endif; ?>

<?php if( $ch_m_title ): ?>
    <div class="toggle-item">
                <h2><img src="<?php echo get_template_directory_uri()?>/images/icon1.png" alt="" /><?php echo $ch_m_title ?></h2>
                <div class="content">
					<div id="msgss"></div>
                    <form id="meet_me" name="meet_me" method="post" action="<?php echo admin_url('admin-ajax.php?action=dictate_ajax_callback&subaction=sh_meet_me'); ?>">
						 <p><?php echo $ch_m_text ?></p>
						<select id="gender" name="gender">
                            <option value="Male"><?php _e( "Male", 'wp_deeds' )?></option>
                            <option value="Female"><?php _e( "Female", 'wp_deeds' )?></option>
                            <option value="Other"><?php _e( "Other", 'wp_deeds' )?></option>
                        </select>
                        <select id="age" name="age">
                            <option value="14 - 20"><?php _e( "14 - 20 years", 'wp_deeds' )?></option>
                            <option value="20 - 25"><?php _e( "20 - 25 years", 'wp_deeds' )?></option>
                            <option value="25 - 35"><?php _e( "25 - 35 years", 'wp_deeds' )?></option>
                            <option value="35 - 42"><?php _e( "35 - 42 years", 'wp_deeds' )?></option>
                            <option value="42 - 50"><?php _e( "42 - 50 years", 'wp_deeds' )?></option>
                            <option value="50 - 60"><?php _e( "50 - 60 years", 'wp_deeds' )?></option>
                            <option value="60 - 60"><?php _e( "60 - 60 plus years", 'wp_deeds' )?></option>
                        </select>
                        <select id="country" name="country">
                            <option value="Asian"><?php _e( "Asian", 'wp_deeds' )?></option>
                            <option value="European"><?php _e( "European", 'wp_deeds' )?></option>
                            <option value="Sub Continent"><?php _e( "Sub Continent", 'wp_deeds' )?></option>
                            <option value="African"><?php _e( "African", 'wp_deeds' )?></option>
                            <option value="American"><?php _e( "American", 'wp_deeds' )?></option>
                            <option value="Russian"><?php _e( "Russian", 'wp_deeds' )?></option>
                        </select>
                        <input type="text" id="name" name="name" placeholder="<?php _e( "Enter Your Name", 'wp_deeds' )?>" required="required" />
						<input type="email" id="email" name="email" placeholder="<?php _e( "Enter Your Email", 'wp_deeds' )?>" required="required" />
						<input type="hidden" id="sender_email" name="sender_email" value="<?php echo $ch_email; ?>" />
						<textarea id="msg" name="msg" placeholder="<?php _e( "Write Your Words", 'wp_deeds' );?>" required="required" ></textarea>
                        <button type="submit" id="meet_submit" class="button2"><?php _e( "Send", 'wp_deeds' ); ?></button>
                    </form>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							
							$('#meet_me').submit(function(){
								var action = $(this).attr('action');
								$("#msgs").slideUp(750,function() {
									var url = document.getElementById('admn_url').innerHTML;
								$('#msgss').hide();
								$('#meet_submit')
									.after('<img class="loader" src='+url+'/images/ajax-loader.gif  />').attr("disabled","disabled");
						
								$.post(action, {
									gender: $('#gender').val(),
									age: $('#age').val(),
									country: $('#country').val(),
									name: $('#name').val(),
									email: $('#email').val(),
									sender: $('#sender_email').val(),
									msg: $('#msg').val()
								},
									function(data){
										document.getElementById('msgss').innerHTML = data;
										$('#msgss').slideDown('slow');
										$('#meet_me img.loader').fadeOut('slow',function(){$(this).remove()});
										$("#meet_submit").removeAttr('disabled');
										if(data.match("success") != null) $("#meet_me").slideUp("slow");										
										/*if(data.match("success") == null)
										{
											setTimeout(function() {
												  $('#msgss').slideUp("slow");
											}, 5000);
										}*/
									}
								);
								});
								return false;
							});
									
						
						});
						</script>
                </div>
            </div>
<?php endif; ?>
        </div>

<?php $output = ob_get_contents(); 

ob_end_clean(); 


