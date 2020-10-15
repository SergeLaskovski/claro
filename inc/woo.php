<?php
//WooCommerce support
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

add_shortcode ('woo_cart_but', 'woo_cart_but' );
// Create Shortcode for WooCommerce Cart Menu Item
function woo_cart_but() {
	ob_start();
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
        <a class="cart-contents" href="<?php echo $cart_url; ?>" title="My Basket">
            <?php
            if ( $cart_count > 0 ) {
            ?>
                <span class="cart-contents-count"><?php echo $cart_count; ?></span>
            <?php
            }
            ?>
        </a>
        <?php
    return ob_get_clean();
}


add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
// Add AJAX Shortcode when cart contents update
function woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
        <?php
        if ( $cart_count > 0 ) {
            ?>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
            <?php            
        }
        ?>
    </a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}

//custom registration fields added to Ultimate Member plugin

/**
 * This example shows how to add custom WooCommerce fields to the Account page of the Ultimate Member. 
 * See the article https://docs.ultimatemember.com/article/1504-how-to-add-custom-woocommerce-fields-to-account
 *
 * This example adds the tab 'wc_custom' that contains the field 'wc_custom_01'. You can add your own tabs and fields.
 * Important! Each account tab has an unique key. Replace 'wc_custom' to your unique key.
 *
 * You can add this code to the end of the file functions.php in the active theme (child theme) directory.
 * 
 * Ultimate Member documentation: https://docs.ultimatemember.com/
 * Ultimate Member support (for customers): https://ultimatemember.com/support/ticket/
 */

/**
 * Add custom tab
 *
 * @param array $tabs
 * @return array
 */
function um_account_custom_tab_wc( $tabs ) {
	$tabs[ 290 ][ 'wc_custom' ] = array(
		'icon'         => 'um-faicon-asterisk',
		'title'        => __( 'WC Custom', 'um-woocommerce' ),
		'submit_title' => __( 'Save', 'um-woocommerce' ),
		'custom'       => true,
	);
	return $tabs;
}
add_filter( 'um_account_page_default_tabs_hook', 'um_account_custom_tab_wc', 100 );


/**
 * Add custom tab content
 *
 * @global WC_User $current_user
 * @param string $output
 * @param array $args
 * @return string
 */
function um_account_custom_tab_content_wc( $output = '', $args = array() ) {
	global $current_user;

	ob_start();
	echo '<div class="um-woo-form um-wc_custom">';
		

	/** Render field 'wc_custom_01', start */
	$key = 'wc_custom_01';
	echo '<div class="um-field" data-key="' . $key . '">';
	woocommerce_form_field( $key, array(
		'id'                => $key,
		'type'              => 'text',
		'label'             => 'Custom field label',
		'description'       => 'Custom field description',
		'placeholder'       => 'Custom field placeholder',
		'class'             => array(),
		'custom_attributes' => array(),
		'required'          => true,
		'default'           => '',
	), $current_user->$key );
	if( UM()->form()->has_error( 'wc_custom_01' ) ){
		echo '<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>' . UM()->form()->errors[ 'wc_custom_01' ] . '</div>';
	}
	echo '</div>';
	/** Render field 'wc_custom_01', end */
		

	echo '</div>';
	$output .= ob_get_clean();

	return do_shortcode( $output );
}
add_filter( 'um_account_content_hook_wc_custom', 'um_account_custom_tab_content_wc', 20, 2 );


/**
 * Validate custom fields
 *
 * @param array $post_args
 * @return type
 */
function um_account_custom_tab_errors_wc( $post_args ) {

	if( !isset( $post_args[ 'um_account_submit' ] ) ) {
		return;
	}

	/** Validate field 'wc_custom_01' */
	if( isset( $post_args[ 'wc_custom_01' ] ) && ( strlen( $post_args[ 'wc_custom_01' ] ) < 3 || 99 < strlen( $post_args[ 'wc_custom_01' ] ) ) ) {
		UM()->form()->add_error( 'wc_custom_01', __( 'This field length should be between 3 and 99', 'ultimate-member' ) );
	}
}
add_action( 'um_submit_account_errors_hook', 'um_account_custom_tab_errors_wc', 20 );


/**
 * Save custom fields
 *
 * @param int $user_id
 * @param array $changes
 */
function um_account_custom_tab_submit_wc( $user_id, $changes ) {

	/** Save field 'wc_custom_01' */
	if( isset( $_POST[ 'wc_custom_01' ] ) && !UM()->form()->has_error( 'wc_custom_01' ) ) {
		update_user_meta( $user_id, 'wc_custom_01', $_POST[ 'wc_custom_01' ] );
	}
}
add_action( 'um_after_user_account_updated', 'um_account_custom_tab_submit_wc', 20, 2 );



//Hide price and "add to cart" button util log in

if (!is_user_logged_in()) {
    //Remove single product add to cart            
    //remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

    //Remove single product price
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

    //Remove loop add to cart
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

    //Remove loop price
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
}

add_action('woocommerce_single_product_summary', 'wl8ShowCustomMsgToGuest', 10);
add_action('woocommerce_after_shop_loop_item', 'wl8ShowCustomMsgToGuest', 10);

function wl8ShowCustomMsgToGuest(){
        //
        if (!is_user_logged_in()) {
            echo '<div class="my-4 p-3 claro-msg">Please <a href="/login/">log in</a> or <a href="/register/">register</a> to see the price.</div>';
        }
}


// Avoid add to cart for non logged user (or not registered)
add_filter( 'woocommerce_add_to_cart_validation', 'logged_in_customers_validation', 10, 3 );
function logged_in_customers_validation( $passed, $product_id, $quantity) {
    if( ! is_user_logged_in() ) {
        $passed = false;

        // Displaying a custom message
        $message = __("Please log in or sign up to add to cart…", "woocommerce");
        $button_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
        $message .= ' <a href="/login/" class="login-register button" style="float:right;">'.$button_text.'</a>';

        wc_add_notice( $message, 'error' );
    }
    return $passed;
}



// Modify the default WooCommerce orderby dropdown
//
// Options: menu_order, popularity, rating, date, price, price-desc
// In this example I'm removing price & price-desc but you can remove any of the options

function patricks_woocommerce_catalog_orderby( $orderby ) {
	unset($orderby["popularity"]);
	unset($orderby["rating"]);
	$orderby[ 'date' ] = 'latest'; // rename
	$orderby[ 'price' ] = 'price &darr;'; // rename
	$orderby[ 'price-desc' ] = 'price &uarr;'; // rename
	return $orderby;
}

add_filter( "woocommerce_catalog_orderby", "patricks_woocommerce_catalog_orderby", 20 );

/**
 * Customize ordering by price
 */
add_filter('woocommerce_get_catalog_ordering_args', function ($args) {
    $orderby_value = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

    if ('price' == $orderby_value) {
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
        $args['meta_key'] = '_regular_price';
    }

    if ('price-desc' == $orderby_value) {
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
        $args['meta_key'] = '_regular_price';
    }

    return $args;
});

//remove breadcrumbs
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	//add_action( 'woocommerce_after_shop_loop', 'woocommerce_breadcrumb', 20, 0 );
}

//move 'results'
add_action( 'init', 'woo_move_result_string' );
function woo_move_result_string() {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20, 0 );
}

//redirect to home after logout
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){

  wp_redirect( home_url() );
  exit();

}


/**
 * Shop/archives: wrap the product image/thumbnail in a div.
 * 
 * The product image itself is hooked in at priority 10 using woocommerce_template_loop_product_thumbnail(),
 * so priority 9 and 11 are used to open and close the div.
 * **/

add_action( 'woocommerce_before_shop_loop_item_title', function(){
    echo '<div class="woo-imagewrapper">';
}, 9 );
add_action( 'woocommerce_before_shop_loop_item_title', function(){
    echo '</div>';
}, 11 );
 


//Option for rural delivery

add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_ups_y_n_fee', 43, 1);
function woo_add_cart_ups_y_n_fee( $cart ){
       if ( ! $_POST || ( is_admin() && ! is_ajax() ) ) {
       return;
   }

   if ( isset( $_POST['post_data'] ) ) {
       parse_str( $_POST['post_data'], $post_data );
   } else {
       $post_data = $_POST;
   }

   if (isset($post_data['RuraldeliveryChk'])) {
       $extracost = 5;
       WC()->cart->add_fee( 'Rural Delivery', $extracost );
     // WC()->cart->shipping_total = WC()->cart->shipping_total + $extracost;
       //WC()->cart->add_fee('Shipping', WC()->cart->shipping_total + $extracost);
       WC()->session->set( 'Rural Delivery', $extracost );
   }

}


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
   
    $fields['Ruraldelivery']['RuraldeliveryChk']  = array(
   'type'      => 'checkbox',
   'label'     => __('<span>$5.00</span>', 'woocommerce'),
   'class'     => array(''),
   'clear'     => true
);  
    return $fields;
}



//remove shipping from cart
function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );




?>

