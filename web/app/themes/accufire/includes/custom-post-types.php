<?php

// Testimonial content type
function af_custom_post_testimonial() {
  $labels = array(
    'name'               => _x( 'Testimonial', 'post type general name' ),
    'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Testimonial' ),
    'edit_item'          => __( 'Edit Testimonial' ),
    'new_item'           => __( 'New Testimonial' ),
    'all_items'          => __( 'All Testimonials' ),
    'view_item'          => __( 'View Testimonial' ),
    'search_items'       => __( 'Search Testimonials' ),
    'not_found'          => __( 'No Testimonials found' ),
    'not_found_in_trash' => __( 'No Testimonials found in the Trash' ),
    'menu_name'          => 'Testimonials'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Testimonials',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title'),
    'has_archive'   => false,
  );
  register_post_type( 'testimonial', $args );
}
add_action( 'init', 'af_custom_post_testimonial' );


// Document content type
function af_custom_post_document() {
  $labels = array(
    'name'               => _x( 'Document', 'post type general name' ),
    'singular_name'      => _x( 'Document', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Document' ),
    'edit_item'          => __( 'Edit Document' ),
    'new_item'           => __( 'New Document' ),
    'all_items'          => __( 'All Documents' ),
    'view_item'          => __( 'View Document' ),
    'search_items'       => __( 'Search Documents' ),
    'not_found'          => __( 'No Documents found' ),
    'not_found_in_trash' => __( 'No Documents found in the Trash' ),
    'menu_name'          => 'Documents'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Documents',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title'),
    'has_archive'   => false,
  );
  register_post_type( 'document', $args );
}
add_action( 'init', 'af_custom_post_document' );

// FAQs content type
function af_custom_post_faq() {
  $labels = array(
    'name'               => _x( 'Question', 'post type general name' ),
    'singular_name'      => _x( 'Question', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Question' ),
    'edit_item'          => __( 'Edit Question' ),
    'new_item'           => __( 'New Question' ),
    'all_items'          => __( 'All Frequent Questions' ),
    'view_item'          => __( 'View Question' ),
    'search_items'       => __( 'Search Frequent Asked Questions' ),
    'not_found'          => __( 'No Frequent Asked Questions found' ),
    'not_found_in_trash' => __( 'No Frequent Asked Questions found in the Trash' ),
    'menu_name'          => 'Frequent Asked Questions'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Frequent Asked Questions',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor'),
    'has_archive'   => false,
  );
  register_post_type( 'faq', $args );
}
add_action( 'init', 'af_custom_post_faq' );

