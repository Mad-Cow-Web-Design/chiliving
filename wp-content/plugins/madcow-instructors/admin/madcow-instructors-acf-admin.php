<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Madcow_Instructors
 * @subpackage Madcow_Instructors/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Madcow_Instructors
 * @subpackage Madcow_Instructors/admin
 * @author     Your Name <email@example.com>
 */

//ACF Functions
add_action('acf/init', 'madcowweb_acf_google_map_api');
function madcowweb_acf_google_map_api() {
	//Mediatech.group API key
	//acf_update_setting('google_api_key', 'AIzaSyCbUl_nRuqQqr3mNXHtD-Z8erSkvRlwMfM');
	
	//Madcow API key
	acf_update_setting('google_api_key', 'AIzaSyAUFQIb76kk-aNd6PaafnxkgM54RDIfZgE');
}

add_shortcode( 'my_acf_user_form', 'my_acf_user_form_func' );
function my_acf_user_form_func( $atts ) {
    $a = shortcode_atts( array(
        'field_group' => ''
    ), $atts );

    $uid = get_current_user_id();

    if ( ! empty ( $a['field_group'] ) && ! empty ( $uid ) ) {
        $options = array(
        'post_id' => 'user_'.$uid,
        'field_groups' => array( intval( $a['field_group'] ) ),
        'return' => add_query_arg( 'updated', 'true', get_permalink() )
        );
        ob_start();
        acf_form( $options );
        $form = ob_get_contents();
        ob_end_clean();
    }
    return $form;
}

//adding ACF form head
add_action( 'wp_head', 'add_acf_form_head', 7 );
function add_acf_form_head(){
    global $post;
    if ( !empty($post) && has_shortcode( $post->post_content, 'my_acf_user_form' ) ) {
        acf_form_head();
    }
}