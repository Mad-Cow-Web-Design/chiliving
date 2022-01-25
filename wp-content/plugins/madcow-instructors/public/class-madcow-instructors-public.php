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
class Madcow_Instructors_Public {

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
	 * @param      string    $madcow_instructors       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $madcow_instructors, $version ) {

		$this->madcow_instructors = $madcow_instructors;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->madcow_instructors, plugin_dir_url( __FILE__ ) . 'css/madcow-instructors-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'madcow-instructors-google-map-public', plugin_dir_url( __FILE__ ) . 'css/madcow-instructors-google-map-public.css', array(), $this->version, 'all' );
		
		if ( is_user_logged_in() ) {
			wp_enqueue_style( 'madcow-instructors-logged-in-public', plugin_dir_url( __FILE__ ) . 'css/madcow-instructors-logged-in-public.css', array(), $this->version, 'all' );
		}
		else {
			wp_enqueue_style( 'madcow-instructors-logged-out-public', plugin_dir_url( __FILE__ ) . 'css/madcow-instructors-logged-out-public.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		//Mediatech.group API key
		//wp_enqueue_script( 'madcow_instructors_google_maps_api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCbUl_nRuqQqr3mNXHtD-Z8erSkvRlwMfM', null, null, false );
		
		//Madcow API key
		wp_enqueue_script( 'madcow_instructors_google_maps_api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAUFQIb76kk-aNd6PaafnxkgM54RDIfZgE', null, null, false );
		wp_enqueue_script( $this->madcow_instructors, plugin_dir_url( __FILE__ ) . 'js/madcow-instructors-public.js', array( 'jquery' ), $this->version, false );

	}

}

//Include files organized by types of functions
include_once plugin_dir_path( __FILE__ ) . 'madcow-instructors-shortcodes-public.php';
include_once plugin_dir_path( __FILE__ ) . 'madcow-instructors-google-map-public.php';

function madcow_instructors_login_redirect( $redirect_to, $request, $user ) {
	$redirect_to = home_url();
	
	if(isset($user->roles) && is_array($user->roles)) {		
		if(in_array('instructor', $user->roles)) {
			$redirect_to = home_url('/') . "profile-edit/";
		}
	}
    return $redirect_to;
}

add_filter( 'login_redirect', 'madcow_instructors_login_redirect', 10, 3 );

function madcow_instructors_login_page_logo() {
	?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo esc_url( plugins_url('images/chi-living-color-300x86.png', __FILE__ ) ); ?>);
			height:86px;
			width:300px;
			background-size: 300px 95px;
			background-repeat: no-repeat;
			padding-bottom: 30px;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'madcow_instructors_login_page_logo' );

function madcow_instructors_login_page_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'madcow_instructors_login_page_logo_url' );

function madcow_instructors_login_page_logo_url_title() {
    return 'ChiLiving _ Living never felt this good.';
}
add_filter( 'login_headertext', 'madcow_instructors_login_page_logo_url_title' );