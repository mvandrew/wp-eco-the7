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


if ( ! function_exists( 'ecothe7_loop_columns' ) ) {
	/**
	 * Default loop columns on product archives
	 *
	 * @return integer products per row
	 * @since  2.0.0
	 */
	function ecothe7_loop_columns() {
		return apply_filters( 'ecothe7_loop_columns', 3 ); // 3 products per row

		// ecothe7_loop_columns
	}
}


if ( !function_exists('ecothe7_loop_shop_per_page') ) {
	/**
	 * Default loop products on page
	 *
	 * @return integer products per row
	 * @since  2.0.0
	 */
	function ecothe7_loop_shop_per_page() {

		return apply_filters( 'ecothe7_loop_shop_per_page', 12 );

		// ecothe7_loop_shop_per_page
	}
}


if ( ! function_exists( 'ecothe7_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper
	 *
	 * @since   2.0.0
	 * @return  void
	 */
	function ecothe7_product_columns_wrapper() {
		$columns = ecothe7_loop_columns();
		echo '<div class="columns-' . intval( $columns ) . '">';

		// ecothe7_product_columns_wrapper
	}
}


if ( ! function_exists( 'ecothe7_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close
	 *
	 * @since   2.0.0
	 * @return  void
	 */
	function ecothe7_product_columns_wrapper_close() {

		echo '</div>';

		// ecothe7_product_columns_wrapper_close
	}
}


if ( ! function_exists( 'ecothe7_template_loop_product_thumbnail' ) ) {

	/**
	 * Get the product thumbnail for the loop.
	 *
	 * @since   2.0.0
	 * @return  void
	 */
	function ecothe7_template_loop_product_thumbnail() {
		global $product;

		$post_thumbnail_id = get_post_thumbnail_id( $product->get_id() );
		$style = '';

		if ( $post_thumbnail_id ) {
			$image = wp_get_attachment_image_src($post_thumbnail_id);
			list($src, $width, $height) = $image;
			$src = str_replace( array( 'https://', 'http://' ), '//', $src );
			$style = "style=\"background-image: url('$src');\"";
		}

		echo "<div class=\"thumbnail_block\" $style></div>";
	}
}
