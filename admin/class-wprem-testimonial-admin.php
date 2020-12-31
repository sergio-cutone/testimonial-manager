<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wprem_Testimonial
 * @subpackage Wprem_Testimonial/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wprem_Testimonial
 * @subpackage Wprem_Testimonial/admin
 * @author     Imran Lakhani <imran.lakhani@yp.ca>
 */
class Wprem_Testimonial_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wprem_Testimonial_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wprem_Testimonial_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wprem-testimonial-admin.css', array(), $this->version, 'all');

        wp_enqueue_style('thickbox');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wprem_Testimonial_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wprem_Testimonial_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        //wp_enqueue_script('jquery');

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wprem-testimonial-admin.js', array('jquery'), $this->version, true);
        wp_enqueue_script('jquery-ui-dialog'); //, '//code.jquery.com/ui/1.12.1/jquery-ui.js', array( 'jquery' ), $this->version, true );
        //wp_enqueue_script( 'my-thickbox-script', plugin_dir_url( __FILE__ ) . 'js/thickbox.js', array( 'jquery', 'thickbox' ), $this->version, true );
    }

    public function add_button()
    {

        echo '<a href="#TB_inline?&height=500&amp;width=780&amp;inlineId=wp_testimonial_shortcode" class="button thickbox" title="Testimonial Options">TE</a>';
    }

    public function select_op($n)
    {
        return '<td><select id="' . $n . '"><option value="1">Show</option><option value="0">Hide</option></select></td>';
    }

    public function get_cats()
    {
        $terms = get_terms(['taxonomy' => 'wprem_testimonials_category', 'hide_empty' => false]); // Get all terms of a taxonomy
        if ($terms && !is_wp_error($terms)) {
            ?>
		<select id="wprem_testimonials_category" style="display: none">
			<option value="all">Show All Categories</option>
		<?php foreach ($terms as $term) {?>
			<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
		<?php }?>
		</select>
		<?php
} else {
            echo '<input type="hidden" id="wprem_testimonials_category" value="all" />';
        }
    }

    public function wp_doin_mce_popup()
    {
        ?>
		<div id="wp_testimonial_shortcode" style="display:none;">
			<div class="wrap">
				<div style="padding:10px">
					<h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;">Testimonials Shortcode</h3>
					<p>Select to show all testimonials or a specific testimonial.</p>
					<div class="field-container">
						<div class="label-desc">
								<?php
$args = array(
            'post_type' => 'wprem_testimonial',
            'post_status' => 'publish',
        );
        echo '<select id="wp_testimonials_id"><option value="">- - Select an Option - -</option><option value="all">Show All Testimonials</option><option value="rand">Show Random Testimonial</option>';
        $staffs = get_posts($args);
        foreach ($staffs as $staff):
            setup_postdata($staff);
            echo "<option value=" . $staff->ID . ">" . $staff->post_title . "</option>";
        endforeach;
        wp_reset_postdata();
        echo "</select>";
        echo $this->get_cats();
        ?>
						</div>
						<div id="wprem_testimonial_options" style="display:none">
							<table class="widefat fixed" cellspacing="0">
								<tr><th><h3>Display Option</h3></th></tr>
								<tr>
									<td><strong>Select View</strong></td>
									<td>
										<select id="wp_testimonial_view">
											<option value="list">List</option>
                                            <option value="masonry">Masonry</option>
											<option value="slide">Slider</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><strong>Select Content Layout</strong></td>
									<td>
<?php
$args = array(
    'post_type' => 'wprem_testi_content',
    'post_status' => 'publish',
);
echo '<select id="wp_testimonial_content"><option value="">- - Select an Option - -</option>';
$content_views = get_posts($args);
foreach ($content_views as $content_view):
    setup_postdata($content_view);
    echo "<option value=" . $content_view->ID . ">" . $content_view->post_title . "</option>";
endforeach;
wp_reset_postdata();
echo "</select>";
?>
									</td>
								</tr>
							</table>

							<div id="wprem_testimonial_slideroptions" style="display:none">
								<table class="widefat fixed" cellspacing="0">
									<tr><th><h3>Slider Options</h3></th></tr>
									<tr>
										<td><strong>Arrows</strong></td>
										<?php echo $this->select_op('wp_testimonial_sliderarrows'); ?>
									</tr>
									<tr>
										<td><strong>Bullets</strong></td>
										<?php echo $this->select_op('wp_testimonial_sliderbullets'); ?>
									</tr>
									<tr>
										<td><strong>Milliseconds Between Slides</strong><br/>1 Second = 1000</td>
										<td>
											<input name="wp_testimonial_sliderdelay" id="wp_testimonial_sliderdelay" value="3000"/>
										</td>
									</tr>
								</table>
							</div>
							<table class="widefat fixed" cellspacing="0">
								<tr><th><h3>Ordering Options</h3></th></tr>
								<tr>
									<td><strong>Order By</strong></td>
									<td>
										<select id="wp_testimonial_orderby">
											<option value="title">Title</option>
											<option value="date">Date</option>
											<option value="rand">Random</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><strong>Order</strong></td>
									<td>
										<select id="wp_testimonial_order">
											<option value="ASC">Ascending</option>
											<option value="DESC">Descending</option>
										</select>
									</td>
								</tr>
								<tr>
								    <td><strong>Columns</strong></td>
                                    <td><select id="wp_testimonial_columns">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                    </select></td>
								</tr>
							</table>
						</div>
						<div id="wprem_testimonial_base_options" style="display:none">
							<table class="widefat fixed" cellspacing="0">
								<tr><td><h3>Show / Hide Options</h3></td></tr>
								<tr>
									<td><strong>Testimonial Title</strong></td>
									<?php echo $this->select_op('wp_testimonial_title'); ?>
								</tr>
								<tr>
									<td><strong>Client Name</strong></td>
									<?php echo $this->select_op('wp_testimonial_clientname'); ?>
								</tr>
								<tr>
									<td><strong>Client Title</strong></td>
									<?php echo $this->select_op('wp_testimonial_clienttitle'); ?>
								</tr>
								<tr>
									<td><strong>Company Name</strong></td>
									<?php echo $this->select_op('wp_testimonial_companyname'); ?>
								</tr>
                               <tr>
                                    <td><strong>Company URL</strong></td>
                                    <?php echo $this->select_op('wp_testimonial_companyurl'); ?>
                                </tr>
								<tr>
									<td><strong>Date</strong></td>
									<?php echo $this->select_op('wp_testimonial_date'); ?>
								</tr>
								<tr>
									<td><strong>Excerpt</strong></td>
									<?php echo $this->select_op('wp_testimonial_excerpt'); ?>
								</tr>
							</table>
						</div>
						<br/>
						<input type="button" class="button-primary" value="Insert Testimonial" id="testimonial-insert" />
					</div>
				</div>
			</div>
		</div>
		<?php

    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */

    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        add_submenu_page(
            'edit.php?post_type=wprem_testimonial',
            'Testimonial Options', // The title to be displayed in the browser window for this page.
            'Testimonial Options', // The text to be displayed for this menu item
            'manage_options', // Which type of users can see this menu item
            $this->plugin_name, // The unique ID - that is, the slug - for this menu item
            array($this, 'display_plugin_setup_page') // The name of the function to call when rendering this menu's page
        );
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links($links)
    {
        /*
         *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
         */
        $settings_link = array(
            '<a href="' . admin_url('edit.php?post_type=wprem_testimonial&page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge($settings_link, $links);

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_plugin_setup_page()
    {
        include_once 'partials/wprem-testimonial-admin-display.php';
    }

    /**
     *
     * admin/class-wp-cbf-admin.php
     *
     **/
    public function validate($input)
    {
        // All checkboxes inputs
        $valid = array();

        $valid['showtitle'] = (isset($input['showtitle']) && !empty($input['showtitle'])) ? 1 : 0;
        $valid['showdescription'] = (isset($input['showdescription']) && !empty($input['showdescription'])) ? 1 : 0;
        $valid['showclientname'] = (isset($input['showclientname']) && !empty($input['showclientname'])) ? 1 : 0;
        $valid['showclienttitle'] = (isset($input['showclienttitle']) && !empty($input['showclienttitle'])) ? 1 : 0;
        $valid['showcompany'] = (isset($input['showcompany']) && !empty($input['showcompany'])) ? 1 : 0;
        $valid['showdate'] = (isset($input['showdate']) && !empty($input['showdate'])) ? 1 : 0;

        //Slider Option
        $valid['shownav'] = (isset($input['shownav']) && !empty($input['shownav'])) ? 1 : 0;
        $valid['showindicators'] = (isset($input['showindicators']) && !empty($input['showindicators'])) ? 1 : 0;
        $valid['setpause'] = (isset($input['setpause']) && !empty($input['setpause'])) ? 1 : 0;
        $valid['setinterval'] = (isset($input['setinterval']) && !empty($input['setinterval'])) ? $input['setinterval'] : '';
        $valid['columns'] = (isset($input['columns']) && !empty($input['columns'])) ? 1 : 1;
        return $valid;
    }

    /**
     *
     * admin/class-wp-cbf-admin.php
     *
     **/
    public function options_update()
    {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

    public function content_types()
    {
        $exludefromsearch = (esc_attr(get_option('wprem_searchable_wprem-testimonial')) === "1") ? false : true;
        $args = array('exclude_from_search' => $exludefromsearch,
            'has_archive' => false,
            'hierarchical' => false,
            'show_in_nav_menus' => false,
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'rewrite' => false,
            'menu_icon' => 'dashicons-format-status',
            'labels' => array('name' => __('Testimonials', 'cuztom'),
                'menu_name' => __('Testimonials', 'cuztom'),
                'add_new' => __('Add New Testimonial', 'cuztom'),
                'add_new_item' => __('Add New Testimonial', 'cuztom'),
                'all_items' => __('All Testimonials', 'cuztom'),
                'view' => __('View Testimonial', 'cuztom'),
                'view_item' => __('View Testimonial', 'cuztom'),
                'search_items' => __('Search Testimonials', 'cuztom'),
                'not_found' => __('No Testimonial Found', 'cuztom'),
                'not_found_in_trash' => __('No Testimonial found in Trash', 'cuztom')),
            'supports' => array('title', 'editor'),
            'show_in_rest' => true,
        );

        $test = register_cuztom_post_type('wprem_testimonial', $args);

        $category = register_cuztom_taxonomy(
            'wprem_testimonials_category',
            'wprem_testimonial',
            array(
                'labels' => array('name' => __('Categories', 'cuztom'), 'menu_name' => __('Categories', 'cuztom')),
                'show_admin_column' => true,
                'admin_column_sortable' => true,
                'admin_column_filter' => true,
                'show_in_rest' => true,
            )
        );

        $box = register_cuztom_meta_box('data', 'wprem_testimonial', array(
            'title' => __('Testimonial Information', 'cuztom'),
            'fields' => array(
                array(
                    'id' => '_data_client',
                    'label' => 'Client Name',
                    'type' => 'text',
                    'show_admin_column' => true,
                    'admin_column_sortable' => false,
                    'admin_column_filter' => true,
                ),
                array(
                    'id' => '_data_client_title',
                    'label' => 'Client Title',
                    'type' => 'text',
                ),
                array(
                    'id' => '_data_client_company',
                    'label' => 'Company Name',
                    'type' => 'text',
                    'show_admin_column' => true,
                    'admin_column_sortable' => false,
                    'admin_column_filter' => true,
                ),
                array(
                    'id' => '_data_client_company_url',
                    'label' => 'Company URL',
                    'type' => 'text',
                    'show_admin_column' => true,
                    'admin_column_sortable' => false,
                    'admin_column_filter' => true,
                ),
                array(
                    'id' => '_data_date',
                    'type' => 'date',
                    'label' => 'Date',
                    'args' => array(
                        'date_format' => 'yy/mm/dd',
                    ),

                ),
            ),
        )
        );
        $contentargs = array('exclude_from_search' => $exludefromsearch,
            'has_archive' => false,
            'hierarchical' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => 'edit.php?post_type=wprem_testimonial',
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'rewrite' => false,
            'menu_icon' => 'dashicons-format-status',
            'labels' => array('name' => __('Content Layouts', 'cuztom'),
                'menu_name' => __('Content Layouts', 'cuztom'),
                'add_new' => __('Add New Layout', 'cuztom'),
                'add_new_item' => __('Add New Layout', 'cuztom'),
                'all_items' => __('All Layouts', 'cuztom'),
                'view' => __('View Layout', 'cuztom'),
                'view_item' => __('View Layout', 'cuztom'),
                'search_items' => __('Search Layouts', 'cuztom'),
                'not_found' => __('No Layout Found', 'cuztom'),
                'not_found_in_trash' => __('No Layout found in Trash', 'cuztom')),
            'supports' => array('title'),
            'show_in_rest' => true,
        );
        $contentlayout = register_cuztom_post_type('wprem_testi_content', $contentargs);
        $contentlayoutbox = register_cuztom_meta_box('data', 'wprem_testi_content', array(
            'title' => __('Testimonial Content Layout', 'cuztom'),
            'fields' => array(
                array(
                    'id'    => '_data_contentvu',
                    'type'  => 'wysiwyg',
                    'label' => 'Content Layout',
                    'description'   => __('{title} {date} {content} {excerpt} {author} {company_name} {featured_image} {client_name}'),
                ),
            ),
        )
        );
        flush_rewrite_rules();
    }

}
