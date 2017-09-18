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

		// storemsav_is_woocommerce_activated
	}
}