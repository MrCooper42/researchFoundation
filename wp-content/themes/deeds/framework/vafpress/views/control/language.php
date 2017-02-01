<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<input class="vp-input-language" type="text" readonly id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
<div class="buttons-language">
  <input id="language_upload" class="" type="button" value="<?php _e('Choose File', 'wp_deeds'); ?>" />
</div>
<div id="language_uploader_output"></div>
<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot'); ?>
