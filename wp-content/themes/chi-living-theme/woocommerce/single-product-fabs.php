<?php
global $product;

$fab_title_1 = get_field('feature_title_1', $product->get_id() );
$fab_blurb_1 = get_field('feature_blurb_1', $product->get_id() );
$fab_icon_1 = get_field('feature_icon_1', $product->get_id() );
$fab_title_2 = get_field('feature_title_2', $product->get_id() );
$fab_blurb_2 = get_field('feature_blurb_2', $product->get_id() );
$fab_icon_2 = get_field('feature_icon_2', $product->get_id() );
$fab_title_3 = get_field('feature_title_3', $product->get_id() );
$fab_blurb_3 = get_field('feature_blurb_3', $product->get_id() );
$fab_icon_3 = get_field('feature_icon_3', $product->get_id() );
$fab_title_4 = get_field('feature_title_4', $product->get_id() );
$fab_blurb_4 = get_field('feature_blurb_4', $product->get_id() );
$fab_icon_4 = get_field('feature_icon_4', $product->get_id() );
$fab_title_5 = get_field('feature_title_5', $product->get_id() );
$fab_blurb_5 = get_field('feature_blurb_5', $product->get_id() );
$fab_icon_5 = get_field('feature_icon_5', $product->get_id() );
?>

<div class="fab-section">
<h2 class="site-main">Features & Benefits</h2>
    <div class="fab-container site-main">
        <div class="fab">
            <img src="<?php echo $fab_icon_1; ?>" alt="<?php echo $fab_title_1; ?>">
            <p class="fab-title"><?php echo $fab_title_1; ?></p>
            <p class="fab-blurb"><?php echo $fab_blurb_1; ?></p>
        </div>
        <div class="fab">
            <img src="<?php echo $fab_icon_2; ?>" alt="<?php echo $fab_title_2; ?>">
            <p class="fab-title"><?php echo $fab_title_2; ?></p>
            <p class="fab-blurb"><?php echo $fab_blurb_2; ?></p>
        </div>
        <div class="fab">
            <img src="<?php echo $fab_icon_3; ?>" alt="<?php echo $fab_title_3; ?>">
            <p class="fab-title"><?php echo $fab_title_3; ?></p>
            <p class="fab-blurb"><?php echo $fab_blurb_3; ?></p>
        </div>
        <div class="fab">
            <img src="<?php echo $fab_icon_4; ?>" alt="<?php echo $fab_title_4; ?>">
            <p class="fab-title"><?php echo $fab_title_4; ?></p>
            <p class="fab-blurb"><?php echo $fab_blurb_4; ?></p>
        </div>
        <div class="fab">
            <img src="<?php echo $fab_icon_5; ?>" alt="<?php echo $fab_title_5; ?>">
            <p class="fab-title"><?php echo $fab_title_5; ?></p>
            <p class="fab-blurb"><?php echo $fab_blurb_5; ?></p>
        </div>
    </div>
</div>