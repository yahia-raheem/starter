<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<p>
    <?php
	printf(
		/* translators: 1: user display name 2: logout url */
		__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url() )
	);
	?>
</p>

<p>
    <?php
	printf(
		__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
	?>
</p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
$customer_products = get_products_purchased_by_user();
if ($customer_products != false):
?>
<div class="row my-4">
    <div class="col-12">
        <h3 class="sec-title marked"><?php _e("Your Courses", "IMP_child"); ?></h3>
    </div>
</div>
<div class="row">
	<?php foreach($customer_products as $one): ?>
    <div class="col-lg-4 col-md-6 col-sm-12">
	
		<?php $course = wc_get_product($one); ?>
        <div class="featured-card">
            <div class="img-holder">
                <?php 
            	$thumbId = $course -> get_image_id();
            	?>
                <a href="<?php echo $course -> get_permalink(); ?>" class="clickable-image"></a>
                <img <?php responsive_image($thumbId, 'medium', true); ?> class="lazyload bg-image">
                <div class="live-status"><?php echo $course -> get_attribute('live'); ?></div>
                <a href="<?php echo $course -> get_permalink(); ?>"
                    class="btn course-cta btn-primary"><?php _e('Read More', 'IMP_child'); ?></a>
            </div>
            <div class="course-content">
                <a href="<?php echo $course -> get_permalink(); ?>">
                    <h5 class="course-title" data-trim="50"><?php echo $course -> get_name(); ?></h5>
                </a>
                <div class="price">
                    <?php echo $course -> get_price_html(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php
endif;