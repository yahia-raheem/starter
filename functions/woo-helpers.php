<?php
add_action( 'wp_enqueue_scripts', 'crunchify_disable_woocommerce_loading_css_js' );
 
function crunchify_disable_woocommerce_loading_css_js() {
 
	// Check if WooCommerce plugin is active
	if( function_exists( 'is_woocommerce' ) ){
 
		// Check if it's any of WooCommerce page
		if(! is_woocommerce() && ! is_cart() && ! is_checkout() ) { 		
			
			## Dequeue WooCommerce styles
			wp_dequeue_style('woocommerce-layout'); 
			wp_dequeue_style('woocommerce-general'); 
			wp_dequeue_style('woocommerce-smallscreen'); 	
 
			## Dequeue WooCommerce scripts
			wp_dequeue_script('wc-cart-fragments');
			wp_dequeue_script('woocommerce'); 
			wp_dequeue_script('wc-add-to-cart'); 
		
			wp_deregister_script( 'js-cookie' );
			wp_dequeue_script( 'js-cookie' );
 
		}
	}	
}

add_shortcode ('woo_cart_but', 'woo_cart_but' );

function woo_cart_but() {
	ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_total = WC()->cart->get_cart_total();
        $cart_url = wc_get_cart_url();  // Set Cart URL
        
  
        ?>
        <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart', 'IMP_child'); ?>">
	    <?php
        if ( $cart_count > 0 ) {
        ?>
            <span class="cart-contents-total d-lg-flex d-none"><?php echo $cart_total; ?></span>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php
        }
        ?>
        </a>
        <?php
	        
    return ob_get_clean();
 
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );

function woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_total = WC()->cart->get_cart_total();
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart', 'IMP_child'); ?>">
	<?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-total d-lg-flex d-none"><?php echo $cart_total; ?></span>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php            
    }
        ?></a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}

function check_if_user_own_product($product_id) {
    if ( is_user_logged_in()) {
        $current_user = wp_get_current_user();
        if (wc_customer_bought_product( $current_user->user_email, $current_user->ID, $product_id)) {
            return 'yes';
        } else {
            return 'not-own';
        }
    } else {
        return 'not-loged-in';
    }
}

function get_products_purchased_by_user() {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $orders = get_posts(array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => $current_user->ID,
            'post_type' => wc_get_order_types(),
            'post_status' => array_keys(wc_get_is_paid_statuses()),
        ));
        if ($orders) {
            $product_ids = array();
            foreach($orders as $one) {
                $order = wc_get_order($one -> ID);
                $items = $order -> get_items();
                foreach ($items as $item) {
                    $prodId = $item->get_product_id();
                    $product_ids[] = $prodId;
                }
            }
            $product_ids = array_unique($product_ids);
            return $product_ids;
        }
    }
    return false;
}