<?php

/*
Custom Blocks
*/

add_action('acf/init', 'af_acf_init');

function af_acf_init()
{
    // Bail out if function doesn’t exist.
    if (!function_exists('acf_register_block')) {
        return;
    }

    // Register a Most Recent posts block.
    acf_register_block(array(
        'name'            => 'af_most_recent_block',
        'title'           => __('Most Recent Posts', 'accufire'),
        'description'     => __('Most Recent Post and Review.', 'accufire'),
        'render_callback' => 'af_most_recent_acf_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('posts'),
    ));

    // Register Products by Categories block.
    acf_register_block(array(
        'name'            => 'af_products_by_categories_block',
        'title'           => __('Products By Categories', 'accufire'),
        'description'     => __('Products By Categories block.', 'accufire'),
        'render_callback' => 'af_products_by_categories_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('products by categories'),
    ));

    // Register Basic Hero block.
    acf_register_block(array(
        'name'            => 'Basic Hero Block',
        'title'           => __('Basic Hero', 'accufire'),
        'description'     => __('Basic Hero block.', 'accufire'),
        'render_callback' => 'af_basic_hero_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('Basic Hero'),
    ));

    // Register Contact Info block.
    acf_register_block(array(
        'name'            => 'Contact Info Block',
        'title'           => __('Contact Info', 'accufire'),
        'description'     => __('Contact Info block.', 'accufire'),
        'render_callback' => 'af_contact_info_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('Contact Info'),
    ));

    // Register Downloads block.
    acf_register_block(array(
        'name'            => 'Downloads Block',
        'title'           => __('Downloads', 'accufire'),
        'description'     => __('Downloads block.', 'accufire'),
        'render_callback' => 'af_downloads_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('Downloads'),
    ));

    // Register Testimonials block.
    acf_register_block(array(
        'name'            => 'Testimonials Block',
        'title'           => __('Testimonials', 'accufire'),
        'description'     => __('Testimonials block.', 'accufire'),
        'render_callback' => 'af_testimonials_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('Testimonials'),
    ));

    // Register Documentation block.
    acf_register_block(array(
        'name'            => 'Documentation Block',
        'title'           => __('Documentation', 'accufire'),
        'description'     => __('Documentation block.', 'accufire'),
        'render_callback' => 'af_documentation_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('Documentation'),
    ));

    // Register FAQs block.
    acf_register_block(array(
        'name'            => 'FAQs Block',
        'title'           => __('FAQs', 'accufire'),
        'description'     => __('FAQs block.', 'accufire'),
        'render_callback' => 'af_faqs_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('FAQs'),
    ));

    // Register Section Separator block.
    acf_register_block(array(
        'name'            => 'Section Separator Block',
        'title'           => __('Section Separator', 'accufire'),
        'description'     => __('Section Separator block.', 'accufire'),
        'render_callback' => 'af_section_separator_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('Section Separator'),
    ));

    
    // Register News block.
    acf_register_block(array(
        'name'            => 'News Block',
        'title'           => __('News', 'accufire'),
        'description'     => __('News block.', 'accufire'),
        'render_callback' => 'af_news_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('News'),
    ));

    
    // Register Follow Us block.
    acf_register_block(array(
        'name'            => 'Follow Us Block',
        'title'           => __('Follow Us', 'accufire'),
        'description'     => __('Follow Us block.', 'accufire'),
        'render_callback' => 'af_follow_us_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('Follow Us'),
    ));

        
    // Register Section Title block.
    acf_register_block(array(
        'name'            => 'Section Title Block',
        'title'           => __('Section Title', 'accufire'),
        'description'     => __('Section Title block.', 'accufire'),
        'render_callback' => 'af_section_title_block_render_callback',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array('Section Title'),
    ));


        // Register Video Gallery block.
        acf_register_block(array(
            'name'            => 'Video Gallery Block',
            'title'           => __('Video Gallery', 'accufire'),
            'description'     => __('Video Gallery block.', 'accufire'),
            'render_callback' => 'af_video_gallery_block_render_callback',
            'category'        => 'formatting',
            'icon'            => 'admin-comments',
            'keywords'        => array('Video Gallery'),
        ));

        
}

// Most Recent Posts block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_most_recent_acf_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
    );

    $context['articles'] = Timber::get_posts($args);

    // Render the block.
    Timber::render('blocks/most-recent.twig', $context);
}


// Products by Category block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_products_by_categories_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    $args = array(
        'taxonomy'   => "product_cat",
        'number'     => 12,
        'orderby'    => 'term_id',
        'order'      => 'asc',
        'include'    => [],
        'hide_empty' => true
    );
    $categories = get_terms($args);
    foreach ($categories as $key => $category) {
        $cat_thumb_id = get_term_meta($category->term_id, 'thumbnail_id', true);
        $args = array(
            'category' => array($category->name),
        );
        $products = wc_get_products($args);
        $categories[$key]->products = $products;
        $shop_catalog_img = wp_get_attachment_image_src($cat_thumb_id, [630, 346], false);
        $categories[$key]->image = $shop_catalog_img[0];
    }
    $context['categories'] = $categories;

    // Render the block.
    Timber::render('blocks/products-by-categories.twig', $context);
}


// Basic Hero block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_basic_hero_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/basic-hero.twig', $context);
}


// Contact Info block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_contact_info_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/contact-info.twig', $context);
}


// Downloads block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_downloads_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/downloads.twig', $context);
}

// Testimonials block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_testimonials_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/testimonials-block.twig', $context);
}



// Documentation block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_documentation_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/documentation.twig', $context);
}


// FAQs block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_faqs_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/faqs.twig', $context);
}


// Section Separator block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_section_separator_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/section-separator.twig', $context);
}

// Section News block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_news_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 4,
    );
    $context['articles'] = Timber::get_posts($args);

    // Render the block.
    Timber::render('blocks/news.twig', $context);
}

// Follow Us block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_follow_us_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/follow-us.twig', $context);
}


// Section Title block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_section_title_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/section-title.twig', $context);
}


// Video Gallery block
/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function af_video_gallery_block_render_callback($block, $content = '', $is_preview = false)
{
    $context = Timber::context();
    $context['block'] = $block;
    $context['fields'] = get_fields();
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render('blocks/video-gallery.twig', $context);
}





/*

END Custom Blocks

*/
