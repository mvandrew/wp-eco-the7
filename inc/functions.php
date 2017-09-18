<?php
/**
 * WordPress core functions.
 *
 * @author      Andrey Mishchenko
 * @since       2.0.0
 * @package     ecothe7
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'ecothe7_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 *
	 * @return bool
	 */
	function ecothe7_is_woocommerce_activated() {

		return class_exists( 'WooCommerce' ) ? true : false;

		// ecothe7_is_woocommerce_activated
	}
}

if ( !function_exists('ecothe7_enqueue_scripts') ) {
	/**
	 * Enqueue Scripts Hook function
	 *
	 * @return void
	 */
	function ecothe7_enqueue_scripts() {

		/**
		 * Styles
		 */
		wp_enqueue_style(
			'ecothe7-vendor-style',
			_ET7_STYLESHEETS . '/vendor-css.min.css',
			array('style'),
			_ET7_VERSION
		);

		wp_enqueue_style(
			'ecothe7-style',
			_ET7_STYLESHEETS . '/style.min.css',
			array('style', 'ecothe7-vendor-style'),
			_ET7_VERSION
		);

		/**
		 * Scripts
		 */
		wp_enqueue_script( 'ecothe7-vendor_script',
			_ET7_SCRIPTS . '/vendor-js.min.js',
			array( 'jquery' ),
			_ET7_VERSION );
		wp_enqueue_script( 'ecothe7-script',
			_ET7_SCRIPTS . '/script.min.js',
			array( 'jquery', 'ecothe7-vendor_script' ),
			_ET7_VERSION );

		/**
		 *
		 */
		wp_dequeue_style( 'dt-awsome-fonts' );

		// ecothe7_enqueue_scripts
	}
}



if ( !function_exists( 'ecothe7_setup') ) {
	/**
	 * After Setup Theme Hook
	 *
	 * @return void
	 */
	function ecothe7_setup () {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'eco-the7', _ET7_CHILD_DIR . '/languages' );

		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// ecothe7_setup
	}
}