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
add_action( 'woocommerce_breadcrumb_defaults',                  'ecothe7_woocommerce_breadcrumb_defaults',          90);



/**
 * Layout
 *
 * @see ecothe7_loop_columns()
 * @see ecothe7_loop_shop_per_page()
 *
 * @see ecothe7_wc_output_related_products_args()
 *
 * @see ecothe7_product_columns_wrapper_close()
 * @see ecothe7_product_columns_wrapper()
 */
add_filter( 'loop_shop_columns',                                'ecothe7_loop_columns' );
add_filter( 'loop_shop_per_page',                               'ecothe7_loop_shop_per_page',                       20 );

add_filter( 'woocommerce_output_related_products_args',         'ecothe7_wc_output_related_products_args',          20 );

add_action( 'woocommerce_after_shop_loop',                      'ecothe7_product_columns_wrapper_close',            40 );
add_action( 'woocommerce_before_shop_loop',                     'ecothe7_product_columns_wrapper',                  40 );



/**
 * Products
 *
 * @see woocommerce_template_loop_product_thumbnail()
 * @see ecothe7_template_loop_product_thumbnail()
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_filter( 'woocommerce_before_shop_loop_item_title',      'ecothe7_template_loop_product_thumbnail',          20 );
