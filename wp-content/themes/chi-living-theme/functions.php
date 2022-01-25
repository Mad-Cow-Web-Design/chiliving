<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
add_action('wp_enqueue_scripts', 'madcow_enqueue_styles', 20);
function madcow_enqueue_styles()
{
    //wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    $css_file = get_stylesheet_directory() . '/chi-styles.css';
    $js_file = get_stylesheet_directory() . '/chi-js.js';
    wp_enqueue_style( 'chi-style', get_stylesheet_directory_uri() . '/chi-styles.css', array('hello-elementor-theme-style'), filemtime($css_file) );
    wp_enqueue_script( 'chi_js', get_stylesheet_directory_uri() . '/chi-js.js', array('jquery'), filemtime($js_file), false );
}


// REMOVE PAGE TITLES
add_filter( 'hello_elementor_page_title', 'madcow_disable_page_title' );
function madcow_disable_page_title( $return ) {
  return false;
}

// REGISTER ALL CUSTOM SHORTCODES
add_action( 'init', 'madcowweb_shortcodes');
function madcowweb_shortcodes(){
    add_shortcode('blog-post-products', 'blog_post_products');
}

function blog_post_products() {
    $post_products = get_field('post_product', $post_object->ID);
    $html = '<div class="post-products-container">';
    foreach ($post_products as $post_product) :
        $product = wc_get_product( $post_product->ID );
        $html .= '<div class="post-product">';
        $html .= wp_get_attachment_image( get_post_thumbnail_id( $post_product->ID ), 'single-post-thumbnail' );
        $html .= '<p>' . $product->get_categories() . '</p>';
        $html .= '<p>' . $post_product->post_title . '</p>';
        $html .= '<p class="blog-product-price">' . $product->get_price() . '</p>';
        $html .= '<a href="' . $post_product->guid . '" class="blog-product-link">View Product</a>';
        $html .= '</div>';
    endforeach;
    $html .= '</div>';
    return $html;
}



//PRE POPULATE INSTRUCTOR GRAVITY FORM FIELD WITH INSTRUCTOR EMAIL
add_filter('gform_field_value_instructor_email', 'instructor_email');
function instructor_email($value){
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    $author_id = get_the_author_meta('ID');
    $author_email = $curauth->user_email;
    return $author_email;
}