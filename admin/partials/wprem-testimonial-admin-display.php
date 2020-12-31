<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wprem_Testimonial
 * @subpackage Wprem_Testimonial/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
<!-- Display Setting Saved Message -->
<?php settings_errors(); ?>

<form method="post" name="testimonial_options" action="options.php">

<?php
//Grab all options
$options = get_option($this->plugin_name);

$showtitle = $options['showtitle'];
$showdescription = $options['showdescription'];
$showclientname = $options['showclientname'];
$showclienttitle = $options['showclienttitle'];
$showcompany = $options['showcompany'];
$showdate = $options['showdate'];

//Slider Option
$shownav = $options['shownav'];
$showindicators = $options['showindicators'];
$setpause = $options['setpause'];
$setinterval = $options['setinterval'];


?>
<!-- This line will add a nonce, option_page, action, and a http_referer field as hidden inputs. -->
<?php 
    settings_fields($this->plugin_name); 
    do_settings_sections($this->plugin_name);
 ?>

<div class="cuztom cuztom--post v-cuztom">
    <div class="cuztom__content">
        <table class="form-table cuztom-table cuztom-main">
            <tbody>
                <tr class="cuztom-cell cuztom-tabs">
                    <td class="cuztom-field" colspan="2">

                        <div class="js-cuztom-tabs">
                            <ul>
                                <li><a href="#testi-layouts-option">Content Layouts</a></li>
                                <li><a href="#testi-display-option">Display Option</a></li>
                                <li><a href="#testi-slider-option">Slider Option</a></li>
                                
                            </ul>
<div id="testi-layouts-option" class="">
Content Layouts
</div>


                            <div id="testi-display-option" class="">
                                

                                <!--<table border="0" cellpadding="0" cellspacing="0" class="form-table cuztom-table">
                                    <tbody>
                                        <tr class="cuztom-cell">
                                            <th>
                                                <legend class="screen-reader-text"><span><?php _e('Show Title', $this->plugin_name);?></span></legend>
                                                <label for="<?php echo $this->plugin_name; ?>-showtitle" class="cuztom-field__label"><?php esc_attr_e('Show Title', $this->plugin_name); ?></label>
                                            </th>
                                            <td class="cuztom-field cuztom-field--checkbox">
                                                <div class="cuztom-checkbox">
                                                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showtitle" name="<?php echo $this->plugin_name; ?>[showtitle]" value="1" class="cuztom-input" <?php checked($showtitle, 1); ?> />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>-->

                                
                                    <!-- Show Title -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Title', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-showtitle" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showtitle" name="<?php echo $this->plugin_name; ?>[showtitle]" value="1" class="cuztom-input" <?php checked($showtitle, 1); ?> />
                                            <span><?php esc_attr_e('Show Title', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Show Description -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Description', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-showdescription" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showdescription" name="<?php echo $this->plugin_name; ?>[showdescription]" value="1" class="cuztom-input" <?php checked($showdescription, 1); ?> />
                                            <span><?php esc_attr_e('Show Description', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Show Client Name -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Client Name', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-showclientname" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showclientname" name="<?php echo $this->plugin_name; ?>[showclientname]" value="1" class="cuztom-input" <?php checked($showclientname, 1); ?> />
                                            <span><?php esc_attr_e('Show Client Name', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Show Client Title -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Client Title', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-showclienttitle" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showclienttitle" name="<?php echo $this->plugin_name; ?>[showclienttitle]" value="1" class="cuztom-input" <?php checked($showclienttitle, 1); ?> />
                                            <span><?php esc_attr_e('Show Client Title', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Show Company -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Company', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-showcompany" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showcompany" name="<?php echo $this->plugin_name; ?>[showcompany]" value="1" class="cuztom-input" <?php checked($showcompany, 1); ?> />
                                            <span><?php esc_attr_e('Show Company', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Show Date -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Date', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-showdate" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showdate" name="<?php echo $this->plugin_name; ?>[showdate]" value="1" class="cuztom-input" <?php checked($showdate, 1); ?>/>
                                            <span><?php esc_attr_e('Show Date', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>
                            </div>

                            <div id="testi-slider-option" class="">

                                    <!-- Show Navigation -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Navigation', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-shownav" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-shownav" name="<?php echo $this->plugin_name; ?>[shownav]" value="1" class="cuztom-input" <?php checked($shownav, 1); ?> />
                                            <span><?php esc_attr_e('Show Navigation', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Show Indicators -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Indicators', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-showindicators" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showindicators" name="<?php echo $this->plugin_name; ?>[showindicators]" value="1" class="cuztom-input" <?php checked($showindicators, 1); ?> />
                                            <span><?php esc_attr_e('Show Indicators', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Set Pause on hover -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Pause on mouse hover', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-setpause" class="cuztom-field__label">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-setpause" name="<?php echo $this->plugin_name; ?>[setpause]" value="1" class="cuztom-input" <?php checked($setpause, 1); ?> />
                                            <span><?php esc_attr_e('Pause on mouse hover', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Set Interval -->
                                    <fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Set Interval', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-setinterval">
                                            <select id="<?php echo $this->plugin_name; ?>-setinterval" name="<?php echo $this->plugin_name; ?>[setinterval]" class="cuztom-input">
                                              <option value="" <?php selected( $setinterval, ''); ?>>Select Interval</option>
                                              <option value="2000" <?php selected( $setinterval, 2000 ); ?>>2 second</option>
                                              <option value="3000" <?php selected( $setinterval, 3000 ); ?>>3 second</option>
                                              <option value="4000" <?php selected( $setinterval, 4000 ); ?>>4 second</option>
                                              <option value="5000" <?php selected( $setinterval, 5000 ); ?>>5 second</option>
                                              <option value="6000" <?php selected( $setinterval, 6000 ); ?>>6 second</option>
                                              <option value="7000" <?php selected( $setinterval, 7000 ); ?>>7 second</option>
                                              <option value="8000" <?php selected( $setinterval, 8000 ); ?>>8 second</option>
                                              <option value="9000" <?php selected( $setinterval, 9000 ); ?>>9 second</option>
                                              <option value="10000" <?php selected( $setinterval, 10000 ); ?>>10 second</option>
                                            </select>
                                            <span class="cuztom-field__label"><?php esc_attr_e('Set Interval', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>

                                    <!-- Show Client Title -->
                                    <!--<fieldset>
                                        <legend class="screen-reader-text"><span><?php _e('Show Client Title', $this->plugin_name);?></span></legend>
                                        <label for="<?php echo $this->plugin_name; ?>-showclienttitle">
                                            <input type="checkbox" id="<?php echo $this->plugin_name; ?>-showclienttitle" name="<?php echo $this->plugin_name; ?>[showclienttitle]" value="1" <?php checked($showclienttitle, 1); ?> />
                                            <span><?php esc_attr_e('Show Client Title', $this->plugin_name); ?></span>
                                        </label>
                                    </fieldset>-->
                            </div>

                        </div>
                        <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</form>
