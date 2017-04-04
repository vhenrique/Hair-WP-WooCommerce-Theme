<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<div class="container">
	<div class="column dt-sc-one-sixth first">
		<?php $terms = get_terms('product_cat', array('hide_empty'=>1, 'parent'=>0));
		if(!empty($terms)){
			echo '<h3 class="border-title"> Menu </h3><div class="column dt-sc-one-fourth first">';
			echo '<ul class="dt-sc-fancy-list orange arrow">';
			foreach($terms as $term){
	            $children = get_term_children($term->term_id, 'product_cat');
	            if(!empty($children)){
	            	echo '<li><a href="'.get_term_link($term, 'product_cat').'">'.$term->name.'</a><ul>';
	            	foreach($children as $child){
	            		$objChild = get_term_by( 'id', $child, 'product_cat');
	                    if($objChild->count != 0){
	                        echo '<li><a href="'.get_term_link($child, 'product_cat').'">'.$objChild->name.'</a></li>';
	                    }
	            	}
	            	echo '</ul></li>';
	            } else{
	            	echo '<li><a href="'.get_term_link($term, 'product_cat').'">'.$term->name.'</a></li>';
	            }
	        }
	        echo '</ul></div>';
		} ?>
	</div>

	<div class="column dt-sc-five-sixth">
		<h3 class="border-title"><?php woocommerce_page_title(); ?></h3>