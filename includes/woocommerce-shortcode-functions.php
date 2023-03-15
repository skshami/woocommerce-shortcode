<?php
//Add to cart button shortcode
function add_to_cart_button_shortcode() {
    global $product;
    $product_id = $product->get_id();
    $atc_button_html = '<form class="cart" action="' . esc_url( $product->add_to_cart_url() ) . '" method="post" enctype="multipart/form-data">
            <button type="submit" class="single_add_to_cart_button button primary is-bevel expand alt"><span>Add to cart</span><i class="icon-shopping-cart" aria-hidden="true"></i></button>
        </form>';
    return $atc_button_html;
}
add_shortcode( 'add_to_cart_button', 'add_to_cart_button_shortcode' );


//Buy now button shortcode
function buy_now_button_shortcode() {
    global $product;
    $product_id = $product->get_id();
    $button_html = '<form class="cart" method="post" enctype="multipart/form-data">
        <button class="button primary is-bevel expand" type="submit" name="buy-now" value="' . $product_id . '">Buy Now</button>
        </form>';
    return $button_html;
}
add_shortcode( 'buy_now_button', 'buy_now_button_shortcode' );

// Handle buy now button click
add_action('template_redirect', 'buy_now_button_redirect_to_cart');
function buy_now_button_redirect_to_cart(){
    if(isset($_POST['buy-now']) && is_numeric($_POST['buy-now'])) {
        $product_id = intval($_POST['buy-now']);
        // add the product to the cart
        WC()->cart->add_to_cart( $product_id );
        // redirect to cart page
        wp_redirect( wc_get_cart_url() );
        exit;
    }
}

add_shortcode( 'ad_collection_button', 'ad_collection_button_shortcode' );
function ad_collection_button_shortcode() {
 
  if ( is_user_logged_in() ) {
	global $product;

    $product_id = $product->get_id();
    $wishlist_url = get_permalink(get_option('yith_wcwl_wishlist_page_id'));
    $add_to_wishlist_url = esc_url(add_query_arg('add_to_wishlist', $product_id, $wishlist_url));

    return '<a href="' . $add_to_wishlist_url . '" class="ad-collection-button button primary is-bevel" style="border-radius:5px;padding:5px 35px 5px 35px;">' . __('Add to Collection! <i class="icon-plus" aria-hidden="true"></i>', 'text-domain') . '</a>';
    }
    // If the customer is not logged in, display the login/register button
    else {
        return '<a href="https://graphicsmaket.com/my-account/" class="ad-collection-button button primary is-bevel" style="border-radius:5px;padding:5px 35px 5px 35px;">Add to Collection! <i class="icon-plus" aria-hidden="true"></i></a>';
    }
	
}

function vendor_info_shortcode() {

	$vendor_id = get_post_field( 'post_author', $product_id );
	$vendor = get_userdata( $vendor_id );
	$vendor_name = $vendor->display_name;
	$dokan_store_url = dokan_get_store_url( $vendor_id );
	$vendor_store_info = dokan_get_store_info( $vendor_id );
	$vendor_store_image_url = isset( $vendor_store_info['store_banner'] ) ? $vendor_store_info['store_banner'] : '';
	
	$author_id = get_the_author_meta( 'ID' );
	$author_email = get_the_author_meta( 'user_email' );
	$author_gravatar_url = get_avatar_url( $author_email, array( 'size' => 80 ) );



	$output = '<div class="row" id="row-669174482">
    <div id="col-1130530835" class="col small-12 large-12">
        <div class="col-inner" style="background-color:rgb(248, 248, 248);">
            <div class="is-border" style="border-color:rgb(230, 230, 230);border-width:1px 1px 1px 1px;">
            </div>
            <div class="row" id="row-494195782">
                <div id="col-228558267" class="col medium-5 small-12 large-5">
                    <div class="col-inner">
                        <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_47687901">
                            <div class="img-inner dark">
                            <img width="80" height="80" src="' . $author_gravatar_url . '" class="attachment-large size-large" alt="' . $vendor_name . '" decoding="async" loading="lazy">
                            </div>
                            <style>
                                #image_47687901 {
                                    width: 100%;
                                }
                            </style>
                        </div>
                    </div>
                    <style>
                        #col-228558267>.col-inner {
                            margin: 0px 0px -19px 0px;
                        }
                    </style>
                </div>
                <div id="col-2042551224" class="col medium-7 small-12 large-7">
                    <div class="col-inner">
                        <h3>'. $vendor_name .'</h3>
                        <a href="' . $dokan_store_url . '" class="button primary is-bevel expand" style="border-radius:5px;padding:3px 0px 3px 0px;">
                            <span>View portfolio</span>
                        </a>
                    </div>
                    <style>
                        #col-2042551224>.col-inner {
                            margin: 0px 0px -19px 0px;
                        }
                    </style>
                </div>
            </div>
        </div>
        <style>
            #col-1130530835>.col-inner {
                padding: 10px 10px 0px 10px;
                border-radius: 5px;
            }
        </style>
    </div>
</div>';
	

	return $output;
}

add_shortcode( 'vendor_info', 'vendor_info_shortcode' );


?>
