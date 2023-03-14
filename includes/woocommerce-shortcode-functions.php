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
        <button type="submit" name="buy-now" value="' . $product_id . '">Buy Now</button>
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
?>
