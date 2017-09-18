<?php
/**
 * Registers the processing of the theme and WordPress core hooks.
 *
 * @author      Andrey Mishchenko
 * @since       2.0.0
 * @package     ecothe7
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Template System Hooks
 *
 * @see ecothe7_enqueue_scripts()
 * @see ecothe7_setup()
 */
add_action( 'wp_enqueue_scripts',                   'ecothe7_enqueue_scripts',          90 );
add_action( 'after_setup_theme',                    'ecothe7_setup' );
add_action( 'customize_register',                   'ecothe7_customize_register' );


/**
 * Parent theme customization
 *
 * @see ecothe7_presscore_credits()
 */
add_action( 'presscore_credits',                    'ecothe7_presscore_credits' );


/**
 * Header Hooks
 *
 * @see ecothe7_head()
 */
add_action( 'wp_head',                              'ecothe7_head',                   10 );