<?php
/**
 * Eco-The7 theme function files initialize.
 *
 * @author      Andrey Mishchenko
 * @since       2.0.0
 * @package     ecothe7
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// ------------------------------------------
// Determining the theme version.
// ------------------------------------------
$theme_child                                = wp_get_theme( 'eco-the7' );
define( '_ET7_VERSION',                     $theme_child['Version'] );


// ------------------------------------------
// Determining theme folders.
// ------------------------------------------
define( '_ET7_PARENT_DIR',                  get_template_directory() );
define( '_ET7_CHILD_DIR',                   get_stylesheet_directory() );

define( '_ET7_INCLUDES_DIR',                _ET7_CHILD_DIR . '/inc' );
define( '_ET7_CLASSES_DIR',                 _ET7_INCLUDES_DIR . '/classes' );
define( '_ET7_WOOCOMMERCE_DIR',             _ET7_INCLUDES_DIR . '/woocommerce' );

// Template Elements Folder
define( '_ET7_TEMPLATE_ELEMENTS_DIR',       _ET7_CHILD_DIR . '/template-elements' );


// ------------------------------------------
// Determining theme links.
// ------------------------------------------
define( '_ET7_PARENT_URI',                  get_template_directory_uri() );
define( '_ET7_CHILD_URI',                   get_stylesheet_directory_uri() );
define( '_ET7_STYLESHEETS',                 _ET7_CHILD_URI . '/css' );


// ------------------------------------------
// Include library files.
// ------------------------------------------
require_once ( _ET7_INCLUDES_DIR . '/functions.php' );
require_once ( _ET7_INCLUDES_DIR . '/customizer.php' );
require_once ( _ET7_INCLUDES_DIR . '/template-functions.php' );
require_once ( _ET7_INCLUDES_DIR . '/template-hooks.php' );
require_once ( _ET7_INCLUDES_DIR . '/eco-the7-template-functions.php' );
require_once ( _ET7_INCLUDES_DIR . '/eco-the7-template-hooks.php' );


// ------------------------------------------
// Include WooCommerce Hooks
// ------------------------------------------
if ( ecothe7_is_woocommerce_activated() ) {
	require_once ( _ET7_WOOCOMMERCE_DIR . '/eco-the7-woocommerce-template-functions.php' );
	require_once ( _ET7_WOOCOMMERCE_DIR . '/eco-the7-woocommerce-template-hooks.php' );
}


// ------------------------------------------
// Include classes.
// ------------------------------------------
require_once ( _ET7_CLASSES_DIR . '/class-eco-the7.php' );
require_once ( _ET7_CLASSES_DIR . '/class-eco-the7-counters.php' );
