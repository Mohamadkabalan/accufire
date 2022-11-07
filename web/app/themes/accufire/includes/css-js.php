<?php 

add_action('wp_enqueue_scripts', 'devvly_enqueue_styles');
add_action('wp_enqueue_scripts', 'devvly_enqueue_scripts');

function devvly_enqueue_styles() {
  wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/assets/css/style.css', false, 1.0, 'all');
  wp_enqueue_style( 'Fontawesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css', array(), 'v5.10.0', 'all');
}

function devvly_enqueue_scripts() {
  wp_enqueue_script( 'mini-cart-js', get_template_directory_uri() . '/assets/js/mini-cart.js', array('jquery'), 1.0, true);
  wp_enqueue_script( 'navbar-js', get_template_directory_uri() . '/assets/js/navbar.js', false, 1.0, true);
  wp_enqueue_script( 'app-js', get_template_directory_uri() . '/assets/js/app.js', false, 1.0, true);
  wp_enqueue_script( 'product-image-js', get_template_directory_uri() . '/assets/js/product-image.js', false, 1.0, true);
}