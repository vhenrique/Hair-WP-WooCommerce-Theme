<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
	exit; // Exit if accessed directly
}

global $product;
?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<div class="container">
	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="content">
			<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			<div class="column dt-sc-three-fifth">
                <div class="hr-invisible-medium"></div>
                <h3 class="border-title"><?php the_title(); ?></h3>
                <?php echo apply_filters('the_content', $product->post->post_content); ?>
                <ul class="info portfolio-single">
					<li>
				        <span>Preço :</span>
				        <h4><?php echo $product->get_price_html(); ?></h4>
				    </li>
				    <li>
				    	<span>Referência :</span>
				        <h4><?php echo $product->post->ID; ?></h4>
				    </li>
				    <li>
				        <span>Estoque:</span>
				        <?php if($product->stock_status == 'instock'){
				        	echo '<h4>Disponível</h4>';
				        } else{
				        	echo '<h4>Indisponível</h4>';
				        }?>
				    </li>
				    <li>
				        <span>Peso em KG:</span>
				        <?php echo '<h4>'.$product->get_weight().'</h4>'; ?>
				    </li>
				    <form class="cart" method="POST" enctype="multipart/form-data">
				    <?php 
			        	if($product->product_type == 'variable'){
			        		$screenTypes = get_terms(array('taxonomy'=>'pa_tela', 'hide_empty'=>true));
			        		if(!empty($screenTypes)){
			        			echo '<li class="size"><span>Tela: </span>';
			        			echo '<select class="attribute screenType" name="attribute_pa_tela">';
			        			foreach($screenTypes as $screenType){
			        				echo '<option value="'.$screenType->slug.'">'.$screenType->name.'</option>';
			        			}
			        			echo '</select></li>';
			        		}

			        		// To products that has variation of size
			        		$variations = $product->get_available_variations();
			        		echo '<li class="size"><span>Tamanho: </span>';
			        		echo '<select class="attribute sizeOf" name="attribute_pa_tamanho">';
			        		foreach($variations as $variation){
				        		echo '<option value="'.$variation['attributes']['attribute_pa_tamanho'].'" data-variation="'.$variation['variation_id'].'">'.$variation['attributes']['attribute_pa_tamanho'].' - '. $variation['price_html'].'</option>';
				        	}
				        	echo '</select></li>';
			        	}
			        ?>
				    <li>
				    	<span>Quantidade:</span>
						 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
						 	<?php
						 		if ( !$product->is_sold_individually() ) {
						 			woocommerce_quantity_input( array(
						 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
						 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
						 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
						 			) );
						 		} ?>
				    </li>
				    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
				 	<input type="hidden" name="product_id" value="<?php echo esc_attr( $product->id ); ?>">
				 	<?php if(!empty($variations)){
				 		echo '<input type="hidden" name="variation_id" class="variation_id" value="'.esc_attr($variations[0]['variation_id']).'">';
				 	}?>
				 	<button type="submit" class="single_add_to_cart_button dt-sc-button small"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
				    </form>	
				</ul>
			</div>
		</div>
	<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
	</div>
</div>