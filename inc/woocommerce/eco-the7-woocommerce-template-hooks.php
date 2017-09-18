<?php
/**
 * WooCommerce hooks
 *
 * @author      Andrey Mishchenko
 * @since       2.0.0
 * @package     ecothe7
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Header
 *
 * @see ecothe7_woocommerce_breadcrumb_defaults()
 */
add_action( 'woocommerce_breadcrumb_defaults',          'ecothe7_woocommerce_breadcrumb_defaults',          90);
