<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>
<div class="overlay" style="display: none !important;"><div class="loader-center loader-inner ball-scale-ripple-multiple"><div></div><div></div><div></div></div></div>
<div class="buttons"><a href="javascript:void(0)" class="button btn blue ph-btn-red"><?php echo sh_set( $head_info, 'label' ); ?></a></div>
<?php /*?><input class="vp-input-language" type="text" readonly id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" />
<div class="buttons-language">
  <input id="language_upload" class="" type="button" value="<?php _e('Choose File', 'wp_deeds'); ?>" />
</div><?php */?>
<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot'); ?>