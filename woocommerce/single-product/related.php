<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop, $themePrefix;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) === 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 4,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );
if($products->have_posts()) : ?>
	<div class="column dt-sc-one-full" style="width:100%; margin:0;">
		<div class="dt-sc-tabs-container animate animated fadeInLeft" data-delay="100" data-animation="animated fadeInLeft" style="width:100%;">
		    <h3 class="border-title">Itens relacionados</h3>
			<?php 
			$i = 0;
			while ( $products->have_posts() ) : $products->the_post();
				if($i == 0){
					echo '<div class="column dt-sc-one-fourth first">';
					$i++;
				} else{
					echo '<div class="column dt-sc-one-fourth">';
				}
			    echo '<div class="dt-sc-team type2 animate animated fadeIn" data-delay="100" data-animation="animated fadeIn">';
				echo '<div class="image">'.get_the_post_thumbnail(get_the_id(), $themePrefix.'featuredProduct').'</div>';
			    echo '<div class="info-produtos"><h5><a href="'.get_permalink(get_the_id()).'">'.get_the_title().'</a></h5>';
			    echo '<span><a class="dt-sc-button small" href="'.get_permalink(get_the_id()).'">Comprar</a><h4>'.$product->get_price_html().'</h4></span>';
				echo '</div></div></div>';
			endwhile; ?>
		</div>
	</div> 
	<div class="hr-invisible"></div>
</div>
<?php endif;
wp_reset_postdata();