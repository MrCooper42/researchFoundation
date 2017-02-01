<?php
$options = get_option('wp_deeds' . '_theme_options'); //printr($options);

$footer_sidebar = sh_set( sh_set( get_option( 'wp_deeds' . '_theme_options' ), 'footer_dynamic_sidebar' ), 'footer_dynamic_sidebar' );

if (sh_set($options, 'show_footer')):
    ?>

<footer>
    <div class="block blackish">
        <?php if (sh_set($options, 'show_footer') == 1) : $bg = sh_set($options, 'footer_background'); endif; ?>
        <div class="parallax" style="background:url(<?php echo $bg ?>);"></div>
            <div class="container">
                <div class="row"> 
                <?php
                    if ($footer_sidebar != "") : 
                        foreach ($footer_sidebar as $sidebar) :
                            if (sh_set($sidebar, 'tocopy') ) break;
                                dynamic_sidebar(sh_set($sidebar, 'footer_sidebar_name'));
                        endforeach;
                    else :
                        dynamic_sidebar('footer-sidebar');
                    endif; 
                ?>
                </div>
            </div>
        </div>                
    </div>
</footer><!-- FOOTER -->

<?php endif; ?>    

<?php if(sh_set($options, 'show_copyright')) : ?>
<div class="bottom-footer">
    <div class="container">
        <?php if (sh_set($options, 'copyright_text') == ''): ?>
            <p><?php echo __('&copy; 2014', 'wp_deeds'); ?> <a href="http://cornerstone.sugotech.org/" title=""><?php echo __('Hala Church', 'wp_deeds'); ?></a> <?php echo __('Wordpress All rights reserved. Design by', 'wp_deeds'); ?> <a href="http://www.webinane.com" title=""><?php echo __('Webinane', 'wp_deeds'); ?></a></p>
        <?php else: ?>
            <p><?php echo stripslashes(sh_set($options, 'copyright_text')); ?></p>
        <?php endif; ?>
<?php //wp_nav_menu( array( 'theme_location' => 'footer_menu' ) );  ?>
    </div>
</div><!-- BOTTOM FOOTER STRIP -->
<?php endif; ?>

<?php if (sh_set($options, 'footer_analytics') != ''): ?>
	<script>
	<?php echo sh_set($options, 'footer_analytics'); ?>
	</script>
<?php endif; ?>

<?php echo '<span id="adminurl" style="display:none" class="hidden">' . get_admin_url() . '</span>'; ?>
<?php wp_footer(); ?>
</body>
</html>