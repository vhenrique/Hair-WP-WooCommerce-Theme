<?php get_header(); ?>
	<div id="content">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<h3 class="page-title"><?php the_category(', '); ?></h3>
			<div class="post" id="post-<?php the_ID(); ?>">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<p class="post-meta">Postado em <?php the_time('j/m/y'); ?>, em <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); comments_popup_link('Sem comentários &#187;', '1 comentário &#187;', '% comentários &#187;'); ?></p>
				<div class="entry">
					<?php
						the_content();
						wp_link_pages(array('before' => '<p class="post-pagination"><span>Páginas</span>', 'after' => '</p>'));
						the_tags('<p class="post-tags">Tags: ', ', ', '</p>');
					?>
				</div>
			</div>
			<div id="comments-wrapper" class="full-width-wrapper"><?php comments_template(); ?></div>
		<?php endwhile; else: ?>
			<p class="msg-info"><?php _e('Sorry, no records were found','lang'); ?></p>
		<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>