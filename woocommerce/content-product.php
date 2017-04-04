<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $themePrefix;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
} 
$classes[] = 'column dt-sc-one-third';
?>

<div <?php post_class( $classes )?>>
<?php 
echo '<div class="dt-sc-team type2 animate" data-delay="100" data-animation="animated fadeIn">';
echo '<div class="image">'.get_the_post_thumbnail($product->ID, $themePrefix.'featuredProduct', array('title'=>$product->post->post_title, 'alt'=> $product->post->post_excerpt)).'</div>';
echo '<div class="info-produtos"><h5><a href="'.get_permalink($product->ID).'">'.$product->post->post_title.'</a></h5>';
echo '<span><a class="dt-sc-button small" href="'.get_permalink($product->ID).'" >Comprar</a> <h4>'.$product->get_price_html().'</h4></span>';
echo '</div></div></div>';