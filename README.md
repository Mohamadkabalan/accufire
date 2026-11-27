# Accufire

A WordPress and WooCommerce online store built for a client in consumer retail. The repository holds the whole site: a Composer-managed WordPress install, its plugin list, and a custom theme.

**Built on:**
- [Bedrock](https://roots.io/bedrock/) by Roots (MIT), using the Platform.sh "WordPress WooCommerce (Bedrock)" template
- WordPress and WooCommerce, plus the third-party plugins listed in `composer.json`, such as ACF Pro, Timber, Yoast SEO, Kadence Blocks and Jetpack
- [Timber Starter Theme](https://github.com/timber/starter-theme) (MIT), which the custom theme is based on

The custom work is mainly the custom theme in `web/app/themes/accufire/`.

## Custom theme

- Twig templates (Timber) for pages, posts, archives, search and 404
- WooCommerce template overrides: cart, checkout, thank-you page, my account, product archive, single product, mini cart (`templates/woo/`, `woocommerce/`)
- ACF Gutenberg blocks registered in `includes/custom-blocks.php`: hero, contact info, downloads, documentation, FAQs, testimonials, news, follow us, section title and separator, video gallery, most recent posts, products by category
- Custom post types: testimonials, documents and FAQs (`includes/custom-post-types.php`)
- ACF field group export in `custom-fields/acf-export-2021-07-14.json`
- SCSS organised per block, built with Gulp. Bootstrap 5 and jQuery front-end scripts (navbar, mini cart, product image, video gallery)

## Stack

- PHP 7.4, WordPress 5.8+, WooCommerce 6, MariaDB 10.4
- Composer, wpackagist
- Timber/Twig, Advanced Custom Fields Pro, Bootstrap 5, Sass, Gulp
- Hosting configuration for Platform.sh (`.platform.app.yaml`, `.platform/`, `.environment`)

## Getting started

Requirements: PHP 7.4, Composer, MariaDB/MySQL.

```bash
composer install      # needs access to the private and premium packages in composer.json
cp .env.example .env  # set DB_* , WP_HOME, WP_SITEURL and salts
```

Point the web server at `web/`, then run the WordPress installer. Activate the `accufire` theme and WooCommerce.

To build theme styles:

```bash
cd web/app/themes/accufire
npm install
npx gulp style     # or: npx gulp watch
```

## Project structure

```
config/                       Bedrock environment config
web/app/themes/accufire/      custom theme (Twig templates, blocks, WooCommerce overrides, SCSS)
web/app/mu-plugins/           Bedrock must-use plugins
custom/plugins/gateway/       third-party WooCommerce payment-gateway plugin (vendor code)
```
