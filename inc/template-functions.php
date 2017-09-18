<?php
/**
 * WordPress theme functions.
 *
 * @author      Andrey Mishchenko
 * @since       2.0.0
 * @package     ecothe7
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( !function_exists('ecothe7_head') ) {
	/**
	 * Displays additional info in the HEAD tag
	 *
	 * @return void
	 */
	function ecothe7_head() {

		// Output counters code
		EcoThe7Counters::get_instance()->yandex_webmaster_code();
		EcoThe7Counters::get_instance()->google_webmaster_code();

		// ecothe7_head
	}
}
