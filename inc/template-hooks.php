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
