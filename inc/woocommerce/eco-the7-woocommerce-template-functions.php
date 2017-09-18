<?php
/**
 * WooCommerce Template Functions.
 *
 * @author      Andrey Mishchenko
 * @since       2.0.0
 * @package     ecothe7
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( !function_exists('ecothe7_woocommerce_breadcrumb_defaults') ) {

	function ecothe7_woocommerce_breadcrumb_defaults($output) {

		$res = array(
			'delimiter'   => '',
			'wrap_before' => '<div class="assistive-text"></div><ol class="breadcrumbs wf-td text-small">',
			'wrap_after'  => '</ol>',
			'before'      => '<li>',
			'after'       => '</li>',
			'home'        => __( 'Home', 'eco-the7' ),
		);

		return $res;

		// ecothe7_woocommerce_breadcrumb_defaults
	}

}