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
 
if( is_admin() ){
    remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
    add_action( 'personal_options', 'prefix_hide_personal_options' );
}
function prefix_hide_personal_options() { ?>
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ){
            $( '#your-profile .form-table:first, #your-profile h3:first, .yoast, .user-description-wrap, .user-profile-picture, h2, .user-pinterest-wrap, .user-myspace-wrap, .user-soundcloud-wrap, .user-tumblr-wrap, .user-wikipedia-wrap, #application-passwords-section' ).remove();
        } );
    </script>
<?php }

//Make "subscriber/author" slug/url be "instructor"
add_action('init', 'new_author_base');
function new_author_base() {
    global $wp_rewrite;
    $myauthor_base = 'instructor';
    $wp_rewrite->author_base = $myauthor_base;
}

/**
 * Start output buffering
 *
 * @return void
 */

function madcow_instructors_user_edit_ob_start() {
    ob_start();
}

add_action( 'personal_options', 'madcow_instructors_user_edit_ob_start' );

/**
 * Insert a new textinput for Nicename below the Username row on User/Profile page
 *
 * @param object $user The current WP_User object.
 * @return void
 */
function madcow_instructors_insert_nicename_input( $user ) {
    $content = ob_get_clean();

    // Find the proper class, try to be future proof
    $regex = '/<tr(.*)class="(.*)\buser-user-login-wrap\b(.*)"(.*)>([\s\S]*?)<\/tr>/';

    // HTML code of the table row
    $nicename_row = sprintf(
        '<tr class="user-user-nicename-wrap"><th><label for="user_nicename">%1$s</label></th><td><input type="text" name="user_nicename" id="user_nicename" value="%2$s" class="regular-text" />' . "\n" . '<span class="description">%3$s</span></td></tr>',
        esc_html__( 'Nicename' ),
        esc_attr( $user->user_nicename ),
        esc_html__( 'Must be unique, this is used for your profile URL.' )
    );

    // Insert the row in the content
    echo preg_replace( $regex, '\0' . $nicename_row, $content );
}

add_action( 'show_user_profile', 'madcow_instructors_insert_nicename_input' );
add_action( 'edit_user_profile', 'madcow_instructors_insert_nicename_input' );

/**
 * Handle user profile updates
 *
 * @param object  &$errors Instance of WP_Error class.
 * @param boolean $update  True if updating an existing user, false if saving a new user.
 * @param object  &$user   User object for user being edited.
 * @return void
 */
function madcow_instructors_profile_update( $errors, $update, $user ) {

    // Return if not update
    if ( !$update ) return;

    if ( empty( $_POST['user_nicename'] ) ) {
        $errors->add(
            'empty_nicename',
            sprintf(
                '<strong>%1$s</strong>: %2$s',
                esc_html__( 'Error' ),
                esc_html__( 'Please enter a Nicename.' )
            ),
            array( 'form-field' => 'user_nicename' )
        );
    } else {
        // Set the nicename
        $user->user_nicename = $_POST['user_nicename'];
    }
}

add_action( 'user_profile_update_errors', 'madcow_instructors_profile_update', 10, 3 );