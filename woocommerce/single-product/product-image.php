<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $product, $themePrefix; ?>

<div class="column dt-sc-two-fifth first">
	<div class="portfolio-single">
		<ul class="portfolio-slider">
			<?php
			$attachments = $product->get_gallery_attachment_ids();
			if (has_post_thumbnail()) {
				array_unshift($attachments, get_post_thumbnail_id($product->post->ID));
			}
			if (!empty($attachments)) {
			    foreach ( $attachments as $attachment ) {
			        echo '<li>'.wp_get_attachment_image( $attachment , $themePrefix.'singleProduct').'</li>';
			    }
			} ?>
		</ul>
	</div>
</div>
