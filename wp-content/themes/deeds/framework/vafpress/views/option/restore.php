<div class="overlay" style="display: none !important;"><div class="center"><span class="circles">Loading…</span></div></div>
<div class="vp-field">
    <div class="label">
        <label>
            <?php _e('Import Dummy Data', 'wp_deeds') ?>
        </label>
        <div class="description">
            <p><?php _e('Demo settings will import "dummy data XML", "theme options", "widgets", "layerslider slider", "revolution slider" and "visual composer templates"', 'wp_deeds') ?></p>
        </div>
    </div>
    <div class="field">
        <div class="input">
            <div id="one_click" class="import_buttons">
                <a id="install_button" class="sh_demo_settings_import vp-button button button-primary" href="javascript:void(0);" >
                    <?php _e('Import Demo Settings', 'wp_deeds') ?>
                </a>
                <br><br>
                <select id="demos" class="custom-select">
                    <option value="deeds_1"><?php esc_html_e('Demo 1', 'wp_deeds') ?></option>
                    <option value="deeds_2"><?php esc_html_e('Demo 2', 'wp_deeds') ?></option>
                    <option value="deeds_3"><?php esc_html_e('Demo 3', 'wp_deeds') ?></option>
                    <option value="deeds_4"><?php esc_html_e('Demo 4', 'wp_deeds') ?></option>
                    <option value="deeds_5"><?php esc_html_e('Demo 5', 'wp_deeds') ?></option>
                    <option value="deeds_6"><?php esc_html_e('Demo 6', 'wp_deeds') ?></option>
                    <option value="deeds_7"><?php esc_html_e('Demo 7', 'wp_deeds') ?></option>
                    <option value="deeds_8"><?php esc_html_e('Demo 8', 'wp_deeds') ?></option>
                    <option value="deeds_9"><?php esc_html_e('Demo 9', 'wp_deeds') ?></option>
                    <option value="deeds_10"><?php esc_html_e('Demo 10', 'wp_deeds') ?></option>

                </select>
                <p><?php esc_html_e('** Please make sure you have already make a backup data of your current settings. Once you click this button, your current settings will be gone', 'wp_deeds'); ?></p>

            </div>
        </div>
    </div>
</div>


<div class="importer_result importer-box">
    <div class="importer_heading">
        <span class="close">X</span>
        <h1><?php _e('Import Results', 'wp_deeds') ?></h1>
    </div>
    <div class="result"></div>
</div>
