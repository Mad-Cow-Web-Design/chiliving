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
class Madcow_Instructors_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $madcow_instructors    The ID of this plugin.
	 */
	private $madcow_instructors;

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
	 * @param      string    $madcow_instructors       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $madcow_instructors, $version ) {

		$this->madcow_instructors = $madcow_instructors;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Madcow_Instructors_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Madcow_Instructors_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->madcow_instructors, plugin_dir_url( __FILE__ ) . 'css/madcow-instructors-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Madcow_Instructors_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Madcow_Instructors_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->madcow_instructors, plugin_dir_url( __FILE__ ) . 'js/madcow-instructors-admin.js', array( 'jquery' ), $this->version, false );

	}

}

//Include files organized by types of functions
include_once plugin_dir_path( __FILE__ ) . 'madcow-instructors-acf-admin.php';
include_once plugin_dir_path( __FILE__ ) . 'madcow-instructors-user-management-admin.php';