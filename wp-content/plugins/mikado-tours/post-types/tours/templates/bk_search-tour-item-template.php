<?php get_header();
roam_mikado_get_title();
get_template_part( 'slider' );
?>
	<div class="mkdf-tours-search-page-holder">
		<div class="mkdf-tours-search-order-container">
			<div class="mkdf-grid">
				<?php echo mkdf_tours_get_search_ordering_html(); ?>
			</div>
		</div>
		<div class="mkdf-container">
			<div class="mkdf-container-inner">
				<div class="mkdf-grid-row">
					<div class="mkdf-grid-col-9">
						<?php echo mkdf_tours_get_search_page_content_html(); ?>

						<?php echo mkdf_tours_get_search_pagination(); ?>
					</div>
					<div class="mkdf-grid-col-3">
						<aside class="mkdf-sidebar">
							<div class="widget mkdf-tours-main-search-filters">
								<?php echo mkdf_tours_get_search_main_filters_html(); ?>
							</div>
							<?php dynamic_sidebar('tour-search-sidebar'); ?>
						</aside>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>