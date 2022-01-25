<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
global $current_user;
get_currentuserinfo();

echo 'Username: ' . $current_user->user_login . "\n";
echo 'User email: ' . $current_user->user_email . "\n";
echo 'User first name: ' . $current_user->user_firstname . "\n";
echo 'User last name: ' . $current_user->user_lastname . "\n";
echo 'User display name: ' . $current_user->display_name . "\n";
echo 'User ID: ' . $current_user->ID . "\n";

$location = get_field('location');
if( $location ): ?>
    <div class="acf-map" data-zoom="16">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
<?php endif;


echo do_shortcode('[elementor-template id="284"]');

get_footer();
