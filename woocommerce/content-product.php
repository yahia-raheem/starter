<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( 'col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center align-items-center', $product ); ?>>
    <div class="featured-card">
        <div class="img-holder">
            <?php 
            $thumbId = $product -> get_image_id();
            ?>
            <a href="<?php echo $product -> get_permalink(); ?>" class="clickable-image"></a>
            <img <?php responsive_image($thumbId, 'medium', true); ?> class="lazyload bg-image">
            <div class="live-status"><?php echo $product -> get_attribute('live'); ?></div>
            <a href="<?php echo $product -> get_permalink(); ?>"
                class="btn course-cta btn-primary"><?php _e('Read More', 'IMP_child'); ?></a>
        </div>
        <div class="course-content">
            <a href="<?php echo $product -> get_permalink(); ?>">
                <h5 class="course-title" data-trim="50"><?php echo $product -> get_name(); ?></h5>
            </a>
            <div class="price">
                <?php echo $product -> get_price_html(); ?>
            </div>
        </div>
    </div>
</div>