<?php

/** WooCommerce
 *
 * Functions providing WooCommerce support to the theme
 */

function theme_add_woocommerce_support() {
  add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

function timber_set_product( $post ) {
  global $product;

  if ( is_woocommerce() ) {
      $product = wc_get_product( $post->ID );
  }
}

add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
  ob_start();
  global $woocommerce;
  $context = [ 'woo' => $woocommerce ];

  Timber::render( 'woo/_cart-button.twig', $context );
  
  // Must be the same button ID with the one we use in template
  $fragments['#cart-button'] = ob_get_clean();
  return $fragments;
} );

	/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	$tabs['additional_information']['title'] = __( 'Specs' );	// Rename the additional information tab
	return $tabs;

}