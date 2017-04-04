<?php get_header(); ?>
	<?php if(have_posts()):
		woocommerce_content();
	else:
		echo '<p class="msg-info">'. _e('Sorry, no records were found','lang').'</p>';
	endif; ?>
<?php get_footer(); ?>