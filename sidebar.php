	<div id="sidebar">
		<?php /* Widgetized sidebar, if you DO NOT have the plugin installed. */ if(!function_exists('dynamic_sidebar') || !dynamic_sidebar()): ?>
			<div class="widget">
				<?php get_search_form(); ?>
			</div>
			<div class="widget">
				<h3>Páginas</h3>
				<?php wp_list_pages('title_li=' ); ?>
			</div>
			<div class="widget">
				<h3>Arquivos</h3>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</div>
			<div class="widget">
				<h3>Categorias</h3>
				<ul>
					<?php wp_list_categories('show_count=1&title_li='); ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>