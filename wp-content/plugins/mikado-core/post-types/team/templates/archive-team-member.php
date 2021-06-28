<?php
get_header();
roam_mikado_get_title(); ?>
<div class="mkdf-container mkdf-default-page-template">
	<?php do_action('roam_mikado_after_container_open'); ?>
	<div class="mkdf-container-inner clearfix">
		<?php
			$mkdf_taxonomy_id = get_queried_object_id();
			$mkdf_taxonomy = !empty($mkdf_taxonomy_id) ? get_category($mkdf_taxonomy_id) : '';
			$mkdf_taxonomy_slug = !empty($mkdf_taxonomy) ? $mkdf_taxonomy->slug : '';
		
			mkdf_core_get_team_category_list($mkdf_taxonomy_slug);
		?>
	</div>
	<?php do_action('roam_mikado_before_container_close'); ?>
</div>
<?php get_footer(); ?>
