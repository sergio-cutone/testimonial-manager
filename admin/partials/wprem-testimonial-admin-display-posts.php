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

//define('WP_USE_THEMES', false);

define( 'ABSPATH', $_SERVER['DOCUMENT_ROOT'] . '/' );
define( 'WPINC', 'wp-includes' );

// Load the WordPress library.
require( $_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );

// Set up the WordPress query.
//wp();

//echo ABSPATH.WPINC;
// Load the theme template.
//require_once( ABSPATH . WPINC . '/template-loader.php' );
//wp_enqueue_style('forms');

/*
function my_assets() {
    wp_register_style('forms');
    wp_enqueue_style('forms');
}
add_action( 'admin_enqueue_scripts', 'my_assets' );
*/

?>
    <!-- This file should primarily consist of HTML with a little bit of PHP. -->
    <h2><?php echo esc_html_e(get_admin_page_title()); ?></h2>

    <div id="wp_testimonial_shortcode" class="wp-admin">

        <div class="wrap">
            <div style="padding:0 10px">
                    
                <h4><?php _e( 'Choose Addon', 'cuztom' ); ?></h4>
                <select name="addon" id="addon">
                <?php
                //global $post;
                $args = array(
                           'public'   => true,
                           '_builtin' => false,
                           'show_in_nav_menus' => true
                        );
                $post_types = get_post_types($args,'names');
                foreach( $post_types as $post_type ) : ?>
                <option value="<? echo $post_type ?>"><?php echo ucwords(str_replace("wprem_","",$post_type)); ?></option>
                <?php endforeach; ?>
                </select>
                <p class="howto">Choosing a addon will filter the shortcode select</p>
                <h4><?php _e( 'Shortcode to Embed', 'cuztom' ); ?></h4>
                <select name="shortcode_type" id="shortcode_type">
                    <option value="">Select Shortcode</option>
                    <option value="default">Default</option>
                    <option value="list">List All</option>
                    <option value="slider">Slider</option>
                </select>
                <hr>
                                             
                <div id="poststuff">
                    <div id="post-body" class="metabox-holder">
                        <!-- main content -->
                        <div id="post-body-content" style="position: relative;">
                            
                            <!-- Testimonial Default Options -->
                            <div id="wprem_testimonial-default" class="postbox-container hidden">
                                <div class="meta-box-sortables ui-sortable nodrag">
                                    <div class="postbox" id="testi-list">
                                        <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Default Testimonial Information</span><span class="toggle-indicator" aria-hidden="true"></span></button>
                                        <!-- Toggle -->
                                        <h2 class="hndle ui-sortable-handle"><span><?php esc_attr_e( 'Default', 'cuztom' ); ?></span></h2>
                                        <div class="inside">
                                            <table border="0" cellpadding="0" cellspacing="0" class="form-table">
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <legend class="screen-reader-text"><span><?php _e('Order By', 'wprem-testimonial');?></span></legend>
                                                            <label for="<?php echo 'wprem-testimonial' ?>-showtitle" class="cuztom-field__label"><?php esc_attr_e('Order By', 'wprem-testimonial'); ?></label>
                                                        </th>
                                                        <td class="cuztom-field">
                                                            <div class="cuztom-select">
                                                            <select name="wprem_testimonial-orderby" id="wprem_testimonial-orderby">
                                                                <option value="">None</option>
                                                                <option value="date"><?php _e( 'Date', 'cuztom' ); ?></option>
                                                                <option value="title"><?php _e( 'Title', 'cuztom' ); ?></option>
                                                                <option value="rand"><?php _e( 'Random', 'cuztom' ); ?></option>
                                                            </select>
                                                            <!--<input type="checkbox" id="<?php #echo $this->plugin_name; ?>-showtitle" name="<?php #echo $this->plugin_name; ?>[showtitle]" value="1" class="cuztom-input" <?php #checked($showtitle, 1); ?> />-->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                                                            <label for="<?php echo 'wprem-testimonial'; ?>-order" class="cuztom-field__label"><?php esc_attr_e('Order', 'wprem-testimonial'); ?></label>

                                                        </th>
                                                        <td class="cuztom-field cuztom-field--radio">
                                                            <div class="cuztom-radio">
                                                            <label title='g:i a'>
                                                                <input type="radio" name="wprem_testimonial-order" value="asc" />
                                                                <span><?php esc_attr_e( 'Ascending', 'wprem-testimonial'); ?></span>
                                                            </label>
                                                            <label title='g:i a'>
                                                                <input type="radio" name="wprem_testimonial-order" value="desc" />
                                                                <span><?php esc_attr_e( 'Descending', 'wprem-testimonial'); ?></span>
                                                            </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <legend class="screen-reader-text"><span><?php _e('Choose Posts', 'wprem-testimonial');?></span></legend>
                                                            <label for="<?php echo 'wprem-testimonial'; ?>-posts" class="cuztom-field__label"><?php esc_attr_e('Choose Posts', 'wprem-testimonial'); ?></label>
                                                        </th>
                                                        <td class="cuztom-field cuztom-field--textcheckbox">
                                                            <div class="cuztom-checkbox">
                                                            <input type="text" id="wprem_testimonial-posts" value="" class="regular-text" />
                                                            <a href="<?php echo plugin_dir_url( __FILE__ ); ?>partials/wprem-testimonial-admin-display-posts.php?placeValuesBeforeTB_=savedValues&TB_iframe=true&height=400&amp;width=500&amp;modal=true" class="button button-small thickbox" title="Find Posts"><span class="dashicons dashicons-search"></span></a>

                                                            <a href="<?php echo plugin_dir_url( __FILE__ ); ?>partials/wprem-testimonial-admin-display-posts.php?&height=400&amp;width=800&amp;modal=true" class="button button-small thickbox" title="Find Posts"><span class="dashicons dashicons-search"></span></a>
                                                            
                                                            <!--<button id="open-post" type="button" class="button button-small" title="Find Posts"><span class="dashicons dashicons-search"></span></button>-->
                                                            
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .postbox-container -->
                            
                            <!-- Testimonial List All Options -->
                            <div id="wprem_testimonial-list" class="postbox-container hidden">
                                <div class="meta-box-sortables ui-sortable">
                                    <div id="tagsdiv-post_tag" class="postbox">
                                        <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: List All</span><span class="toggle-indicator" aria-hidden="true"></span></button>
                                        <h2 class="hndle ui-sortable-handle"><span><?php esc_attr_e( 'List All', 'cuztom' ); ?></span></h2>
                                        <div class="inside">
                                            ...
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .postbox-container -->
                            
                            <!-- Testimonial Slider Options -->
                            <div id="wprem_testimonial-slider" class="postbox-container hidden">
                                <div class="meta-box-sortables ui-sortable">
                                    <div id="tagsdiv-post_tag" class="postbox">
                                        <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Slider</span><span class="toggle-indicator" aria-hidden="true"></span></button>
                                        <h2 class="hndle ui-sortable-handle"><span><?php esc_attr_e( 'Slider', 'cuztom' ); ?></span></h2>
                                        <div class="inside">
                                            ...
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .postbox-container -->


                        </div><!-- post-body-content -->
                        <br class="clear">
                    </div><!-- post-body -->

                </div><!-- poststuff -->
                
                     
                <p><strong>Single Promotion</strong> will override <strong>Single Random Testimonial</strong></p>
                <hr />
                <div class="field-container">
                    <div class="label-desc">
                        <?php
                        $args = array(
                            'post_type'   => 'wprem_testimonial',
                            'post_status' => 'publish'
                        );
                        echo '<select id="wp_test_id"><option value="">- Select Single Testimonial -</option>';
                        $testimonials = get_posts( $args );
                        foreach ( $testimonials as $testimonial ) :
                            setup_postdata( $testimonial );
                            echo "<option value=".$testimonial->ID.">".$testimonial->post_title."</option>";
                        endforeach;
                        wp_reset_postdata();
                        echo "</select>";
                        ?>
                    </div>
                </div>
                <div class="field-container">
                    <div class="label-desc">
                        <input type="checkbox" name="wp_test_list" id="wp_test_list" value="true" />
                        <label for="wp_test_list"><strong>List Testimonials</strong></label>
                    </div>
                </div>
                <div class="field-container">
                    <div class="label-desc">
                        <input type="checkbox" name="wp_test_rnd" id="wp_test_rnd" value="true" />
                        <label for="wp_test_rnd"><strong>Single Random Testimonial</strong></label>
                    </div>
                </div>
                <div class="field-container">
                    <div class="label-desc">
                        <input type="checkbox" name="wp_test_rev" id="wp_test_rev" value="true" />
                        <label for="wp_test_rev"><strong>List Testimonials - Reverse</strong></label>
                    </div>
                </div>
                <div class="field-container">
                    <div class="label-desc">
                        <input type="checkbox" name="wp_test_slider" id="wp_test_slider" value="true" />
                        <label for="wp_test_slider"><strong>List Testimonials - Slider</strong></label>
                    </div>
                </div>
            </div>
            <hr />
            <div style="padding:15px;">
                <input type="button" class="button-primary" value="Insert Testimonial" id="testimonial-insert" />
                &nbsp;&nbsp;&nbsp;<a class="button" href="#" onclick="tb_remove(); return false;">Cancel</a>
            </div>
            
        </div>
    </div>