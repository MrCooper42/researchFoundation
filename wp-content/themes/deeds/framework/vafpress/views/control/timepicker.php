<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<input type="text" data-id="timepicker" name="<?php echo $name ?>" class="vp-input vp-timepicker input-large" value="<?php echo $value; ?>" />
<script>jQuery(document).ready(function(){sh_timepicker();});</script>
<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot'); ?>