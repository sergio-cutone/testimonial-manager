<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wprem_Testimonial
 * @subpackage Wprem_Testimonial/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wprem_Testimonial
 * @subpackage Wprem_Testimonial/public
 * @author     Imran Lakhani <imran.lakhani@yp.ca>
 */
class Wprem_Testimonial_Public
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
 * @param      string    $plugin_name       The name of the plugin.
 * @param      string    $version    The version of this plugin.
 */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->wprem_testimonial_options = get_option($this->plugin_name);

    }

/**
 * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wprem-testimonial-public.min.css', array(), $this->version, 'all');

    }

/**
 * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wprem-testimonial-public.min.js', array('jquery'), $this->version, true);

    }

    public function wrap($id = null, $field, $class, $isDate = false, $isWrap = true)
    {
        $content = $id ? get_post_meta($id, $field, true) : $field;
        if (intval($content) && $isDate) {
            $content = date('F d, Y', $content);
        }

        if ($isWrap) {
            return '<div class="' . $class . '">' . $content . '</div>';
        } else {
            return $content;
        }

    }

    // create shortcode to list
    public function testimonials_list_shortcode($atts)
    {
        ob_start();
/*
View: List / Slide / Single
Amount: All / Single
Cat: Get category ID
Order by: Date / Alpha / Random
Order: ASC, DESC
ID: For single testimonial
Title: bool (post title)
Client Name: bool
Client Title: bool
Company Name: bool
Company URL: bool
Date: bool
Col: column class (col-md-6, md-12 etc.)
Columns: number of columns
Arrows: bool - Slide Arrows
Bullets: bool - Slide Bullets
Setinterval: Milliseconds for slide delay
 */
        extract(shortcode_atts(array(
            'type' => 'wprem_testimonial',
            'view' => 'list',
            'content' => '0',
            'cat' => 'all',
            'orderby' => 'date',
            'order' => 'ASC',
            'posts' => -1,
            'id' => '',
            'ttitle' => 0,
            'cname' => 0,
            'ctitle' => 0,
            'coname' => 0,
            'courl' => 0,
            'date' => 0,
            'excerpt' => 0,
            'col' => 'col-xs-12',
            'columns' => 1,
            'arrows' => '',
            'bullets' => '',
            'delay' => '3000',
        ), $atts));

//$content_view = $this->wprem_testimonial_options;
//$content_view = get_option('wprem_testi_content_options');
//$vu = get_post_custom($content_view);
//$content_view = get_post_meta( $content, '_data_wysiwyg', true) ; 

        $orderby = ($orderby === 'date') ? $orderby = 'meta_value' : $orderby;

        if ($id === 'rand') {
            $orderby = 'rand';
            $id = '';
        }

$multi = '';
if ( $columns == 4 ) {
    $col = 'col-xs-12 col-sm-6 col-md-3';
    $multi = 'carousel-multi ';
} elseif ( $columns == 3 ) {
    $col = 'col-xs-12 col-sm-6 col-md-4';
    $multi = 'carousel-multi ';
} elseif ( $columns == 2 ) {
    $col = 'col-xs-12 col-sm-6 col-md-6';
    $multi = 'carousel-multi ';
}

if ($view === 'masonry') {
    $col = '';
}

        $options = array(
            'post_type' => 'wprem_testimonial',
            'post_status' => 'publish',
            'meta_key' => '_data_date',
            'orderby' => $orderby, // Title, Date, Rand
            'order' => $order, // DESC | ASC
            'posts_per_page' => (($orderby == 'rand' && $id != 'all') ? 1 : $posts),
            'p' => $id == 'all' ? -1 : $id,
        );

        // Category
        $terms = get_terms(array(
            'taxonomy' => 'wprem_testimonials_category',
        ));
        // If categories are not empty and cat arg is not all
        if (!empty($terms && $cat != 'all')) {
            // Set tax_query in the query
            $options['tax_query'] = array(
                array(
                    'taxonomy' => 'wprem_testimonials_category',
                    'field' => 'term_id', // term_id, slug
                    'terms' => $cat,
                ),
            );
        }

        $vuoptions = array(
            'post_type' => 'wprem_testi_content',
            'post_status' => 'publish',
        );

        $testimonials_array = array();
        $query = new WP_Query($options);
        if ($query->have_posts()) {
            while ($query->have_posts()):
                $query->the_post();

                $o_client_name = $cname ? $this->wrap(get_the_ID(), '_data_client', 'wprem_client') : '';
                $o_client_title = $ctitle ? $this->wrap(get_the_ID(), '_data_client_title', 'wprem_client_title') : '';
                $o_company_name = $coname ? $this->wrap(get_the_ID(), '_data_client_company', 'wprem_company') : '';
                $o_company_url = $courl ? $this->wrap(get_the_ID(), '_data_client_company_url', 'wprem_company_url', false, false) : '';
                if ($o_company_url) {
                    $o_company_name = '<a href="' . $o_company_url . '" rel="nofollow" target="_blank">' . $o_company_name . '</a>';
                }
                $o_title = $ttitle ? $this->wrap(false, get_the_title(), 'wprem_title') : '';
                $o_date = $date ? $this->wrap(get_the_ID(), '_data_date', 'wprem_date', 1) : '';
                $o_content = $excerpt ? $this->wrap(false, apply_filters('the_content', substr(get_the_content(), 0, 200)), 'wprem_content') : $this->wrap(false, apply_filters('the_content', get_the_content()), 'wprem_content');

if ( $content == 0 ) {
    $contentView = '<aside>' . $o_title . $o_date . $o_content . $o_client_name . $o_client_title . $o_company_name . '</aside>';
} else {
    $contentView = get_post_meta( $content, '_data_contentvu', true);
    $contentView = str_replace("{title}", $o_client_title, $contentView);
    $contentView = str_replace("{client_name}", $o_client_name, $contentView);
    $contentView = str_replace("{content}", $o_content, $contentView);
    $contentView = str_replace("{excerpt}", $o_content, $contentView);
    $contentView = str_replace("{date}", $o_date, $contentView);
    $contentView = str_replace("{company_name}", $o_company_name, $contentView);
    $contentView = str_replace("{author}", '', $contentView);
    $contentView = str_replace("{featured_image}", '', $contentView);
}
                array_push($testimonials_array, '<div class="' . $col . '">' . $contentView . '</div>');
            endwhile;
        }
        wp_reset_postdata();

        if ($view === 'list') {
            echo '<div class="' . $this->plugin_name . '_container"><div class="' . $this->plugin_name . '">';
            foreach ($testimonials_array as $testimonial) {
                echo '<div class="row wprem_inner">' . $testimonial . '</div>';
            }
            echo '</div></div>';
        }  elseif ($view === 'masonry') {
            echo '<div class="' . $this->plugin_name . '_container"><div class="' . $this->plugin_name . ' masonry masonry-col-' . $columns . '">';
            foreach ($testimonials_array as $testimonial) {
                echo '<div class="row wprem_inner">' . $testimonial . '</div>';
            }
            echo '</div></div>';
        } elseif ($view === 'slide') {
            $carousel_id = "testimonial" . rand();
            echo ' <div id="' . $carousel_id . '" class="carousel slide ' . $multi . 'multi-col-' . $columns . ' ' . $this->plugin_name . '_container" data-ride="carousel" data-interval="' . $delay . '">';
            echo '<div class="carousel-inner" role="listbox">';
            $active = 'active';
            $bullets_out = '';
            $bullet_count = 0;
            foreach ($testimonials_array as $testimonial) {
                echo '<div class="item ' . $active . '">' . $testimonial . '</div>';
                $bullets_out .= '<li data-target="#' . $carousel_id . '" data-slide-to="' . $bullet_count . '" class="' . $active . '"></li>';
                $active = '';
                $bullet_count++;
            }
            echo '</div>';
            if ($arrows) {
                echo '<!-- Left and right controls -->
                <a class="left carousel-control" href="#' . $carousel_id . '" data-slide="prev">
                    <span class="fa fa-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#' . $carousel_id . '" data-slide="next">
                    <span class="fa fa-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>';
            }

            if ($bullets) {
                echo '<ol class="carousel-indicators">' . $bullets_out . '</ol>';
            }
            echo '</div>';
        }

        $out = ob_get_clean();
        return $out;
    }
}
