<?php if (!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<div id="vp-pfui-format-gallery-preview" class="vp-pfui-elm-block vp-pfui-elm-block-image">
    <div class="vp-pfui-elm-container">
        <div class="vp-pfui-gallery-picker">
            <?php
            global $post;
            preg_match_all("/[a-z _]+/i", sh_set($head_info, 'name'), $output_array);
            $key = sh_set(sh_set($output_array, 0), 0);
            $field = sh_set(sh_set($output_array, 0), 1);
            $field2 = sh_set(sh_set($output_array, 0), 2);
            $data = get_post_meta($post->ID, $key, true);
            $array = sh_set(sh_set($data, $field), 0);
            $images = sh_set(sh_set(sh_set($array, $field2), '0'), 'gallery_opt');

            $img_array = explode(',', $images);
            echo '<div class="gallery clearfix">';
            if ($images) {
                foreach ($img_array as $image) {
                    $thumbnail = wp_get_attachment_image_src($image, 'thumbnail');
                    echo '<span data-id="' . $image . '" title="' . 'title' . '"><img src="' . $thumbnail[0] . '" alt="" /><span class="close">x</span></span>';
                }
            }
            echo '</div>';
            ?>
            <input type="hidden" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" />
            <p class="none"><a href="#" class="button vp-pfui-gallery-button"><?php esc_html_e('Pick Images', 'themag'); ?></a></p>
        </div>
    </div>
</div>

<?php
if (!$is_compact)
    echo VP_View::instance()->load('control/template_control_foot');?>