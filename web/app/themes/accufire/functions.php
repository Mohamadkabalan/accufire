<?php

/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {
        // Use categories and tags with attachments
        register_taxonomy_for_object_type( 'category', 'attachment' );
        register_taxonomy_for_object_type( 'post_tag', 'attachment' );

	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		//$context['foo']   = 'bar';

		$context['custom_logo_url']   = wp_get_attachment_image(get_theme_mod('custom_logo'), 'full');
		//$context['stuff'] = 'I am a value set in your functions.php file';
		//$context['notes'] = 'These values are available everytime you call Timber::context();';
		$context['menu']  = new Timber\Menu('Main menu');
		$context['footer_menu'] = new \Timber\Menu( 'Footer menu' );
		$context['social_menu'] = new \Timber\Menu( 'Social menu' );

		$context['site']  = $this;

    $args = array(
        'taxonomy'   => "product_cat",
        'number'     => 12,
        'orderby'    => 'term_id',
        'order'      => 'asc',
        'include'    => [],
        'hide_empty' => true
    );
    $prod_categories=get_terms($args);

    foreach( $prod_categories as $key => $prod_cat ) {
        $cat_thumb_id = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );

        $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id,[630,346], false );
        $prod_categories[$key]->image=$shop_catalog_img[0];
    }

    $context['product_categories']=$prod_categories;

		$fetch_deals = array(
			'post_type' => 'deals',
			'orderby' => 'title',
			'order'   => 'ASC',
		);
		$context['deals'] = Timber::get_posts( $fetch_deals );

		$fetch_dealers = array(
        'post_type' => 'dealers',
        'orderby' => 'title',
        'order'   => 'ASC',
    );
    $context['dealers'] = Timber::get_posts( $fetch_dealers );

		$fetch_partners = array(
			'post_type' => 'partner',
			'orderby' => 'title',
			'order'   => 'ASC',
		);

		$context['partners'] = Timber::get_posts( $fetch_partners );

    $fetch_news = array(
      'post_type' => 'post',
      'posts_per_page' => 3,
    );
    $context['news'] = Timber::get_posts($fetch_news);

		return $context;
	}

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );

		$defaults = array(
			'height' => 100,
			'width' => 150,
			'flex-height' => false,
			'flex-width' => false,
			'unlink-homepage-logo' => true,
		);

		add_theme_support( 'custom-logo', $defaults );
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	// public function myfoo( $text ) {
	// 	$text .= ' bar!';
	// 	return $text;
	// }

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {

		$twig->addFilter(new \Twig_SimpleFilter('is_current_url', function ($link) {
			return ($_SERVER["REQUEST_URI"] == $link) ? true : false;
		}));
		
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		// $twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

}

new StarterSite();

/**
 * Separate out some code into include files so it's easier to manage all of the
 * functions in this file
 */

// Include CSS and JS files
require_once( __DIR__ . '/includes/css-js.php');

// Uncomment to include custom post types
require_once( __DIR__ . '/includes/custom-post-types.php');

// Include all the custom blocks
require_once( __DIR__ . '/includes/custom-blocks.php');

// Enabled WooCommerce support in the theme
require_once( __DIR__ . '/includes/woo.php');


/* Skip "Crop Site Logo" */
function logo_size_change(){
	remove_theme_support( 'custom-logo' );
	add_theme_support( 'custom-logo', array(
	    'height'      => 100,
	    'width'       => 400,
	    'flex-height' => true,
	    'flex-width'  => true,
	) );
}

add_action( 'after_setup_theme', 'logo_size_change', 11 );


/* Adding Dealer custom role */
add_role('dealer', __('Dealer'),
	array(
		'read'            => true, // Allows a user to read
		'create_posts'      => false, // Allows user to create new posts
		'edit_posts'        => false, // Allows user to edit their own posts
		'edit_others_posts' => false, // Allows user to edit others posts too
		'publish_posts' => false, // Allows the user to publish posts
		'manage_categories' => false, // Allows user to manage post categories
		)
 );



 // Store Locator Settings

 add_filter( 'wpsl_js_settings', 'custom_js_settings' );

function custom_js_settings( $settings ) {

    $settings['startMarker'] = '';

    return $settings;
}


add_filter( 'woocommerce_return_to_shop_redirect', 'st_woocommerce_shop_url' );
/**
 * Redirect WooCommerce Shop URL
 */

function st_woocommerce_shop_url(){

return site_url() . '/products/';

}


// For templating my account page
function my_account_menu_order() {
	$menuOrder = array(
		'dashboard' => __('Dashboard', 'woocommerce'),
		'orders' => __('Orders', 'woocommerce'),
		'downloads' => __('Downloads', 'woocommerce'),
		'edit-address' => __('Addresses', 'woocommerce'),
		'edit-account' => __('Account Details', 'woocommerce'),
		'customer-logout' => __('Logout', 'woocommerce'),
	);
	return $menuOrder;
}

add_filter ('woocommerce_account_menu_items', 'my_account_menu_order');