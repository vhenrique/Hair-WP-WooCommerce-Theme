<?php
add_filter( 'wp_nav_menu_items', 'navPriceItem', 10, 2 );
function navPriceItem($items, $args){
	$items.= '<li><a href="'.WC()->cart->get_cart_url().'">Itens('.WC()->cart->get_cart_contents_count().') '.WC()->cart->get_cart_total().'</a></li>';
	return $items;
}

function limitText($text, $limit){
	$text = explode(' ', $text);
	for($i = 0; $i < $limit; $i++){
		$words[] = $text[$i];
	}
	return implode(' ', $words);
}

// Remove default post type
add_action('admin_menu','remove_default_post_type');
function remove_default_post_type() {
	remove_menu_page('edit.php');
}

// Custom numeric pagination function
	function get_numeric_pagination(){
		global $wp_query, $numpages;
		$total_pages	= $wp_query->max_num_pages;
		$big			= 999999999;
		if($total_pages > 1){
			echo '<div class="numeric-pagination full-width-wrapper">';
			echo paginate_links(
				array(
					'base'		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format'	=> '/page/%#%',
					'current'	=> max(1, get_query_var('paged')),
					'total'		=> $wp_query->max_num_pages,
					'type'		=> 'plain',
					'prev_text'	=> '<',
					'next_text'	=> '>'
				)
			);
			echo '</div>';
		}
	}

// Breadcrumbs
	function get_breadcrumbs(){
		$delimiter = '<span class="fa fa-angle-right"> </span>';
		$name = 'Home';
		$currentBefore = '<h4>';
		$currentAfter = '</h4>';
		echo '<div class="breadcrumb">';
		if(is_home()){
			echo '<span class="current">Home</span>';
		}
		if(!is_home() && !is_front_page() || is_paged()){
			global $post;
			$home = get_bloginfo('url');
			echo '<a href="' . $home . '" title="Home">' . $name . '</a> ' . $delimiter . ' ';
			if(is_category()){
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
				echo $currentBefore;
				single_cat_title();
				echo $currentAfter;
			} elseif(is_day()){
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
				echo $currentBefore . get_the_time('d') . $currentAfter;
			} elseif(is_month()){
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo $currentBefore . get_the_time('F') . $currentAfter;
			} elseif(is_year()){
				echo $currentBefore . get_the_time('Y') . $currentAfter;
			} elseif(is_single() && !is_attachment()){
				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} elseif(is_attachment()){
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} elseif(is_page() && !$post->post_parent){
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} elseif(is_page() && $post->post_parent){
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} elseif(is_search()){
				echo $currentBefore . 'Resultados da busca por &#39;' . get_search_query() . '&#39;' . $currentAfter;
			} elseif(is_tag()){
				echo $currentBefore . 'Posts com a tag &#39;';
				single_tag_title();
				echo '&#39;' . $currentAfter;
			} elseif(is_author()){
				global $author;
				$userdata = get_userdata($author);
				echo $currentBefore . 'Posts postados por ' . $userdata->display_name . $currentAfter;
			} elseif(is_404()){
				echo $currentBefore . 'Erro 404' . $currentAfter;
			}
			if(get_query_var('paged')){
				if(is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Página') . ' ' . get_query_var('paged');
				if(is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}
		}
		echo '</div>';
	}
?>