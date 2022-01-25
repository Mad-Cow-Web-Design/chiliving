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
$workshop_instructor_id = get_field('instructor');
$workshop_instructor = get_user_by('id', $workshop_instructor_id);
$author_first_name = $workshop_instructor->display_name;
$ins_source_photo  = get_field('source_photo', 'user_'. $workshop_instructor_id);
$ins_website  = get_field('website', 'user_'. $workshop_instructor_id);
$ins_facebook  = get_field('facebook', 'user_'. $workshop_instructor_id);
$ins_twitter  = get_field('twitter', 'user_'. $workshop_instructor_id);
$ins_linkedin  = get_field('linkedin', 'user_'. $workshop_instructor_id);
$ins_instagram  = get_field('instagram', 'user_'. $workshop_instructor_id);
$ins_youtube  = get_field('youtube', 'user_'. $workshop_instructor_id);
$ins_phone  = get_field('phone', 'user_'. $workshop_instructor_id);
$ins_show_phone_publicly  = get_field('show_phone_publicly', 'user_'. $workshop_instructor_id);
$ins_email  = get_field('email', 'user_'. $workshop_instructor_id);
$ins_show_email_publicly  = get_field('show_email_publicly', 'user_'. $workshop_instructor_id);
$ins_certification_level  = get_field('certification_level', 'user_'. $workshop_instructor_id);
$ins_chirunning_certification  = get_field('chirunning_certification', 'user_'. $workshop_instructor_id);
$ins_chiwalking_certification  = get_field('chiwalking_certification', 'user_'. $workshop_instructor_id);
$workshop_name = get_field('name');
$workshop_cost = get_field('cost');
$workshop_link_to_purchase_workshop = get_field('link_to_purchase_workshop');
$workshop_start_date = get_field('start_date_&_time');
$workshop_start_date = new DateTime($workshop_start_date);
$workshop_end_date = get_field('end_date_&_time');
$workshop_additional_details = get_field('additional_details');
$workshop_venue = get_field('venue');
$workshop_address = get_field('address');
$workshop_city = get_field('city');
$workshop_state = get_field('state');
$workshop_country = get_field('country');
$workshop_link_to_map_for_location = get_field('link_to_map_for_location');
$workshop_description = get_field('description');
$workshop_testimonials = get_field('testimonials');
$workshop_override_default_refund_policy = get_field('override_default_refund_policy');
$workshop_custom_refund = get_field('custom_refund_&_cancellation_policy');

$workshop = get_queried_object();
$workshop_id = $workshop->ID;
$terms = get_the_terms( $workshop_id, 'workshop_type' );
$term_id = $terms[0]->term_id;
$workshop_img = get_field('background_img', 'workshop_type' . '_' . $term_id);
?>
<div class="workshop-content">
        <div class="instructor-banner" style="background-image: url('<?php
                if ($workshop_img) :
                    echo $workshop_img ;
                else :
                    echo 'https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/workshop-header.jpg' ;
                endif; ?>');">
        </div>
        <h1><?php echo $workshop_name; ?></h1>
        <div class="instructor-header workshop-header">
            <div class="left">
                <img src="<?php echo $ins_source_photo; ?>" alt="<?php echo $curauth->nickname; ?>">
                <div class="instructor-sub-header">
                    <div class="instructor-icons">
                        <?php if ($ins_chirunning_certification) : ?>
                            <img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/chirunning-certified-instructor.png" alt="">
                        <?php endif; ?>
                        <?php if ($ins_chiwalking_certification) : ?>
                            <img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/chiwalking-certified-instructor.png" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="instructor-title">
                        <h3><?php echo $ins_certification_level; ?></h3>
                    </div>
                </div>
            </div>
            <div class="right">
                <p class="workshop-date">
                    <img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/workshop-date-icon.png" alt=""><?php echo $workshop_start_date->format('m\/d\/Y | g A'); ?>
                </p>
                <p class="workshop-location">
                    <a target="_blank" href="<?php echo $workshop_link_to_map_for_location; ?>"><img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/workshop-location-icon.png" alt=""><?php echo $workshop_venue; ?></a>
                </p>
                <p class="workshop-cost">
                <img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/workshop-price-icon.png" alt=""><?php echo $workshop_cost; ?>
                </p>
                <h3>Connect with <?php echo $author_first_name; ?></h3>
                <div class="instructor-social">
                    <?php if ($ins_facebook) : ?>
                        <a target="_blank" href="<?php echo $ins_facebook; ?>"><img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/instructor-facebook-icon.png" alt="facebook"></a>
                    <?php endif; ?>
                    <?php if ($ins_twitter) : ?>
                        <a target="_blank" href="<?php echo $ins_twitter; ?>"><img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/instructor-twitter-icon.png" alt="twitter"></a>
                    <?php endif; ?>
                    <?php if ($ins_linkedin) : ?>
                        <a target="_blank" href="<?php echo $ins_linkedin; ?>"><img src="/wp-content/uploads/2022/01/metronome.jpg" alt="linkedin"></a>
                    <?php endif; ?>
                    <?php if ($ins_instagram) : ?>
                        <a target="_blank" href="<?php echo $ins_instagram; ?>"><img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/instructor-instagram-icon.png" alt="instagram"></a>
                    <?php endif; ?>
                    <?php if ($ins_youtube) : ?>
                        <a target="_blank" href="<?php echo $ins_youtube; ?>"><img src="/wp-content/uploads/2022/01/metronome.jpg" alt="youtube"></a>
                    <?php endif; ?>
                    <?php if ($ins_website) : ?>
                        <a target="_blank" href="<?php echo $ins_website; ?>"><img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/instructor-website-icon.png" alt="website"></a>
                    <?php endif; ?>
                    <?php if ($ins_phone && $ins_show_phone_publicly == 'yes') : ?>
                        <a target="_blank" href="tel:<?php echo $ins_phone; ?>"><img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/instructor-phone-number-icon.png" alt="phone"></a>
                    <?php endif; ?>
                    <?php if ($ins_email && $ins_show_email_publicly == 'yes') : ?>
                        <a target="_blank" href="mailto:<?php echo $ins_email; ?>"><img src="https://chiliving2021.wpengine.com/wp-content/uploads/2022/01/instructor-email-icon.png" alt="email"></a>
                    <?php endif; ?>
                </div> <!-- end instructor social -->
            </div>
        </div><!-- End instructor header -->
        <div class="tab">
            <?php if ($workshop_description) : ?>
                <button class="tablinks active" onclick="openDetails(event, 'Details')" id="defaultOpen">Workshop Details</button>
            <?php endif;
            if ($workshop_additional_details) : ?>
                <button class="tablinks" onclick="openDetails(event, 'Info')">Helpful Information</button>
            <?php endif;
            if ($workshop_override_default_refund_policy == 'yes') : ?>
                <button class="tablinks" onclick="openDetails(event, 'Cancel')">Cancellation Policy</button>
            <?php endif; ?>
        </div>
        <!-- Tab content -->
        <div id="Details" class="tabcontent" style="display: block;">
            <p><?php echo $workshop_description; ?></p>
        </div>
        <div id="Info" class="tabcontent">
            <p><?php echo $workshop_additional_details; ?></p>
        </div>
        <div id="Cancel" class="tabcontent">
            <p><?php echo $workshop_custom_refund; ?></p>
        </div>
        <div class="workshop-signup">
            <div class="content">
                <h2>Start Your Registration</h2>
                <p>Begin your registration by entering your name and email address here so we can send you pre-workshop materials. When you click the Register for Workshop button, you’ll be taken to the instructor’s website to complete your registration and submit payment.</p>
                <?php gravity_form( 5, false, false, false, '', false ); ?>
            </div>
        </div>
    </div><!-- end workshop-content -->
<?php
get_footer();



