<?php ob_start(); ?>

<div id='calendar'></div>

<?php 
	$args = array(
		'post_type'	=>	'cs_events',
		'posts_per_page'	=>	-1,
		'post_status'	=>	'publish',
	);
	$query = new WP_Query($args);
	//printr(date('Y-d-m'));
?>

<script>
	jQuery(document).ready(function() {
		jQuery('#calendar').fullCalendar({
			defaultDate: '<?php echo esc_js(date('Y-m-d')); ?>',
			editable: false,
			eventLimit: false, // allow "more" link when too many events
			events: [
			<?php 
                            if($query->have_posts()) :  while($query->have_posts()) : $query->the_post();
                            $meta = get_post_meta(get_the_ID(), 'sh_event_meta', true);
                            $event_meta = sh_set(sh_set($meta, 'sh_event_options'), '0');
                            $start_date = sh_set($event_meta, 'start_date');
                            $end_date = sh_set($event_meta, 'end_date');
                            $start_time = sh_set($event_meta, 'start_time');
                            $end_time = sh_set($event_meta, 'end_time');
                        ?>
                            {
                                title: '<?php the_title(); ?>',
                                start: '<?php echo esc_js($start_date); ?>T<?php echo esc_js($start_time); ?>',
                                end: '<?php echo esc_js($end_date); ?>T<?php echo esc_js($end_time); ?>',
                                url: '<?php echo esc_js(get_the_permalink(get_the_ID()));?>'
                            },
			<?php endwhile; wp_reset_postdata(); endif; ?>
			]
		});
	});
</script>

<?php
$output = ob_get_contents();
 ob_end_clean();
 
 ?>