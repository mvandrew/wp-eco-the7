<?php
/**
 * Customizing elements.
 *
 * @author      Andrey Mishchenko
 * @since       2.0.0
 * @package     ecothe7
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( !function_exists('ecothe7_presscore_credits') ) {
	/**
	 * Display credits area
	 *
	 * @return void
	 */
	function ecothe7_presscore_credits() {

		// Current year
		$date = new DateTime();
		$year = $date->format('Y');

		echo '<ul class="ecothe7_credits">';

		// Display Credits info
		echo '<li>';
		printf( __('&copy; %1$s &mdash; <a href="%2$s">%3$s</a>, All Rights Reserved.', 'eco-the7'),
			$year,
			home_url(),
			get_bloginfo( 'name' ));
		echo '</li>';


		// Display author info
		echo '<li>';
		printf( __('<a href="%1$s">Designed by</a> %2$s', 'eco-the7'),
			'http://www.msav.ru/',
			'msav.ru');
		echo '</li>';

		// Closing credits area
		echo '</ul>';

		// ecothe7_presscore_credits
	}
}



if ( !function_exists('ecothe7_customize_register') ) {
	/**
	 * Added additional parameters and the counters IDs of the analytical systems.
	 *
	 * @param WP_Customize_Manager $wp_customize The Customizer object.
	 */
	function ecothe7_customize_register( $wp_customize ) {

		//
		// Start of the Additional Options
		//
		$panel = 'ecothe7_additional_options';
		$wp_customize->add_panel(   $panel, array(
			'capability'            => 'edit_theme_options',
			'description'           => __( 'Change the Additional Options from here as you want', 'eco-the7' ),
			'priority'              => 515,
			'title'                 => __( 'Additional Options', 'eco-the7' )
		));


		//
		// Counters IDs
		//
		EcoThe7Counters::get_instance()->customize_register( $wp_customize, $panel );

		// ecothe7_customize_register
	}
}