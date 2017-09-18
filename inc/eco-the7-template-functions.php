<?php
/**
 * Theme spec functions.
 *
 * @author      Andrey Mishchenko
 * @since       2.0.0
 * @package     ecothe7
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }



if ( !function_exists('ecothe7_presscore_body_top') ) {
	/**
	 * Before Site Hook
	 *
	 * @return void
	 */
	function ecothe7_presscore_body_top() {

		EcoThe7Counters::get_instance()->yandex_metrika_code();
		EcoThe7Counters::get_instance()->google_analytics_code();

		// ecothe7_presscore_body_top
	}
}