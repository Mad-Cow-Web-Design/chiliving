<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Madcow_Instructors
 * @subpackage Madcow_Instructors/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Madcow_Instructors
 * @subpackage Madcow_Instructors/public
 * @author     Your Name <email@example.com>
 */

// REGISTER ALL CUSTOM SHORTCODES
add_action( 'init', 'madcow_instructors_shortcodes');
function madcow_instructors_shortcodes(){
    add_shortcode('instructor-map', 'instructor_map');
	add_shortcode('madcow-instructors-show-map-legend', 'madcow_instructors_show_map_legend');
	add_shortcode('madcow-instructors-show-instructors-list', 'madcow_instructors_show_instructors_list');
	add_shortcode('madcow-instructors-show-instructors-search-filter', 'madcow_instructors_show_instructors_search_filter');
}