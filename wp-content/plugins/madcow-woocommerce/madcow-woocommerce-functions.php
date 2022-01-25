<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Plugin Name: Mad Cow Web WooCommerce Functions
 * Plugin URI: https://madcowweb.com/
 * Description: Custom Functions for Chi Living WooCommerce
 * Author: Jason Robie
 * Author URI: https://madcowweb.com/
 * Version: 1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    // Change "Buy product" button text site-wide for external products
    add_filter( 'woocommerce_product_add_to_cart_text', 'madcow_shop_page_external_button', 10, 2 );
    function madcow_shop_page_external_button( $button_text, $product ) {

        if ( 'external' === $product->get_type() ) {
            // enter the default text for external products
            return $product->button_text ? $product->button_text : 'View Product';
        }
        return $button_text;
    }

    // Add the open in a new browser tab WooCommerce external product Buy Product button.
    add_action( 'woocommerce_external_add_to_cart', 'madcow_external_add_to_cart', 30 );

    function madcow_external_add_to_cart() {
    global $product;

    if ( ! $product->add_to_cart_url() ) {
        return;
    }

    $product_url = $product->add_to_cart_url();
    if(strpos($product_url, 'myspreadshop')) {
        $button_text = 'Shop with Spreadshop';
    } elseif (strpos($product_url, 'finalsurge')) {
        $button_text = 'Shop with FinalSurge';
    } elseif (strpos($product_url, 'acuityscheduling')) {
        $button_text = 'Schedule';
    } else {
        $button_text = $product->single_add_to_cart_text();
    }
    /**
    * The code below outputs the edited button with target="_blank" added to the html markup.
    */
    do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <p class="cart">
    <a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt" target="_blank">
    <?php echo esc_html($button_text ); ?></a>
    </p>

    <?php do_action( 'woocommerce_after_add_to_cart_button' );
    }


    add_filter( 'woocommerce_loop_add_to_cart_link', 'ts_link_external_product_page', 16, 3 );
    function ts_link_external_product_page( $button, $product, $args ) {
        $url = $product->add_to_cart_url();

        if ( 'external' === $product->get_type() ) {
            $url = $product->get_permalink();
        }

        return sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        esc_url( $url ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        esc_html( $product->add_to_cart_text() )
        );
    }
    add_action( 'init', 'customize_woo_hooks', 11 );
    function customize_woo_hooks(){
        remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
        remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        remove_action('woocommerce_review_meta','woocommerce_review_display_meta', 10);
        add_action('woocommerce_review_after_comment_text','woocommerce_review_display_meta', 15);
    }
    /**
     * Remove product data tabs
     */
    add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

    function woo_remove_product_tabs( $tabs ) {

        //unset( $tabs['description'] );      	// Remove the description tab
        //unset( $tabs['reviews'] ); 			// Remove the reviews tab
        unset( $tabs['additional_information'] );  	// Remove the additional information tab

        return $tabs;
    }
    /**
     * Rename product data tabs
     */
    add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
    function woo_rename_tabs( $tabs ) {

        $tabs['description']['title'] = __( 'Additional Information' );		// Rename the description tab

        return $tabs;

    }
    /* ADD + AND - SYMBOLS TO QUANTITY SECION */
    add_action ('woocommerce_before_quantity_input_field', 'madcowweb_quantity_text');
    function madcowweb_quantity_text() {
        echo '<div class="mcw-quantity-number"><button type="button" class="minus" >-</button>';
    }


    add_action( 'woocommerce_after_quantity_input_field', 'ts_quantity_plus_sign' );
    function ts_quantity_plus_sign() {
        echo '<button type="button" class="plus" >+</button></div>';
    }

    // ADD FEATURES AND BENEFITS TO SINGLE PRODUCT PAGES

    add_action( 'woocommerce_after_single_product_summary', 'madcow_add_fabs', 14);
    function madcow_add_fabs() {
        get_template_part ('woocommerce/single-product-fabs');
    }

    /**
     * Change number of related products output
     */
    function woo_related_products_limit() {
        global $product;

        $args['posts_per_page'] = 6;
        return $args;
    }
    add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
        function jk_related_products_args( $args ) {
        $args['posts_per_page'] = 3; // 4 related products
        $args['columns'] = 3; // arranged in 2 columns
        return $args;
    }

    /**
     * Replace the home link URL
     */
    add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
    function woo_custom_breadrumb_home_url() {
        return home_url( '/' ) . 'chistore/';
    }
    /**
     * Change several of the breadcrumb defaults
     */
    add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
    function jk_woocommerce_breadcrumbs() {
        return array(
                'delimiter'   => ' &#62; ',
                'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
                'home'        => _x( 'ChiStore', 'breadcrumb', 'woocommerce' ),
            );
    }
}

