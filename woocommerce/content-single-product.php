<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$specs = rwmb_meta('cspecs_list');
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="row">
                <div class="col-12">
                    <h2 class="course-title single-title"><?php echo $product -> get_name(); ?></h2>
                </div>
                <div class="col-12 disc-col d-flex justify-content-between align-items-center">
                    <div class="disc-start">
                        <div class="detail-box cat-box">
                            <span class="attr"><?php _e('Categories', 'IMP_child'); ?></span>
                            <?php the_terms(get_the_ID(), 'product_cat'); ?>
                        </div>
                    </div>
                    <div class="disc-end">
                        <p
                            class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
                            <?php echo $product->get_price_html(); ?></p>
                    </div>
                </div>
            </div>
            <div class="row mb-md-4">
                <div class="col-12 course-tabs-cont">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active no-navigator" id="nav-overview-tab" data-toggle="tab"
                                href="#nav-overview" role="tab" aria-controls="nav-overview"
                                aria-selected="true"><?php _e('Overview'); ?></a>
                            <a class="nav-item nav-link no-navigator" id="nav-Curriculum-tab" data-toggle="tab"
                                href="#nav-curriculum" role="tab" aria-controls="nav-curriculum"
                                aria-selected="false"><?php _e('Curriculum'); ?></a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-overview" role="tabpanel"
                            aria-labelledby="nav-overview-tab">
                            <div class="row">
                                <div class="col-12">
                                    <?php the_content(); ?>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-curriculum" role="tabpanel"
                            aria-labelledby="nav-curriculum-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="accourdion-cc" id="accordionExample">
                                        <?php 
                                        $lectures = rwmb_meta('curr_section');
                                        foreach($lectures as $key => $section):
                                            $keyPrint = $key + 1;
                                        ?>
                                        <div class="card">
                                            <div class="card-header" id="<?php echo 'div-' . $key; ?>">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-block" type="button" data-toggle="collapse"
                                                        data-target="#<?php echo 'forcollapse-' . $key ?>"
                                                        aria-expanded="true"
                                                        aria-controls="<?php echo 'forcollapse-' . $key ?>">
                                                        <span class="title"><i
                                                                class="fas fa-chevron-up"></i><?php echo $section['curr_g_sectitle']; ?></span>
                                                        <span
                                                            class="count"><?php echo count($section['lec_g_lec']); ?></span>

                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="<?php echo 'forcollapse-' . $key ?>" class="collapse"
                                                aria-labelledby="<?php echo 'div-' . $key; ?>"
                                                data-parent="#accordionExample">
                                                <div class="card-body">
                                                <ul class="course-content-list" <?php if (check_if_user_own_product(get_the_ID()) != "yes"): ?> data-removeChildTag="a" <?php endif; ?>>
                                                        <?php
                                                        foreach($section['lec_g_lec'] as $lecKey => $lec):
                                                            $lecKeyPrint = $lecKey + 1;
                                                        ?>
                                                        <a href="<?php echo get_the_permalink( $lec ); ?>"><li>
                                                            <span class="lec-data">
                                                                <p class="label"><i class="far fa-sticky-note"></i><?php echo _e('Lecture') . ' ' . $keyPrint . '.' . $lecKeyPrint ?>
                                                                </p>
                                                                <p class="lec-title"><?php echo get_the_title( $lec ); ?></p>
                                                            </span>
                                                            <span class="lec-type">
                                                                <?php foreach(rwmb_meta("lec_type", [], $lec) as $type): ?>
                                                        
                                                                <?php switch($type) {
                                                                    case "video":
                                                                        echo '<i class="fas fa-video"></i>';
                                                                        break;
                                                                    case "aduio":
                                                                        echo '<i class="far fa-file-audio"></i>';
                                                                        break;
                                                                    case "picture":
                                                                        echo '<i class="far fa-image"></i>';
                                                                        break;
                                                                    case "text":
                                                                        echo '<i class="fas fa-paragraph"></i>';
                                                                        break;
                                                                }
                                                                ?>
                                                                <?php endforeach; ?>
                                                            </span>
                                                        </li></a>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <h3 class="sec-title marked mt-4"><?php _e('Latest Courses', 'IMP_child'); ?></h5>
                </div>
                <div class="col-12">
                    <div class="course-single-slider mb-4">
                        <?php  
                        $recent_posts = wp_get_recent_posts(array(
                            'post_type'      => 'product',
                            'post_status'    => 'publish',
                            'numberposts' => 5,
                            'orderby' => 'post_date',
                            'order' => 'DESC',
                            'suppress_filters' => false,
                            'post__not_in' => array(get_the_ID())
                        ), OBJECT );
                        if($recent_posts): foreach($recent_posts as $one):
                            $course = wc_get_product($one);
                        ?>
                        <div class="slide">
                            <div class="featured-card">
                                <div class="img-holder">
                                    <?php 
                                    $thumbId = $course -> get_image_id();
                                    ?>
                                    
                                    <a href="<?php echo $course -> get_permalink(); ?>" class="clickable-image"></a>
                                    <img <?php responsive_image($thumbId, 'medium', true); ?> class="lazyload bg-image">
                                    <a href="<?php echo $course -> get_permalink(); ?>"
                                        class="btn course-cta btn-primary"><?php _e('Read More', 'IMP_child'); ?></a>
                                </div>
                                <div class="course-content">
                                    <a href="<?php echo $course -> get_permalink(); ?>">
                                        <h5 class="course-title" data-trim="50"><?php echo $course -> get_name(); ?>
                                        </h5>
                                    </a>
                                    <div class="price">
                                        <?php echo $course -> get_price_html(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  
                        endforeach;endif;
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 sidebar">
            <div class="sidebar__inner d-flex flex-column justify-content-start align-items-start">
                <?php if($specs): ?>
                <?php 
                    $specIcons = rwmb_meta('cspec_icons_list', ['object_type' => 'setting'], 'theme_mods_imp');    
                ?>
                <div class="side-block">
                    <h5 class="block-title"><?php _e('Course Specifications', 'IMP_child'); ?></h5>
                    <div class="course-specs">
                        <table class="table table-borderless">
                            <tbody>
                                <?php foreach ($specs as $key => $value): if ($value): ?>
                                <tr>

                                    <th scope="row"><i class="<?php echo $specIcons[$key]; ?>"></i><span
                                            data-replace="-" data-replace-with=" "
                                            class="spec-title"><?php echo $key; ?></span></th>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                <div class="side-block">
                    <?php 
                    do_action( 'woocommerce_single_product_summary' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>