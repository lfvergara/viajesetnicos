<?php get_header();
roam_mikado_get_title();
get_template_part( 'slider' );
?>
<div class="mkdf-grid-col-12" style="padding-left: 0px; padding-right: 0px; margin-bottom: 0px;">
	<?php echo mkdf_tours_get_search_main_filters_html(); ?>
</div>
<div class="mkdf-tours-search-page-holder">
	<!--
	<div class="mkdf-tours-search-order-container">
		<div class="mkdf-grid">
			<?php //echo mkdf_tours_get_search_ordering_html(); ?>
		</div>
	</div>
	-->
	<div class="mkdf-container" style="background-color: #282828;">
		<div class="mkdf-container-inner">
			<div class="mkdf-grid-row">
				<div class="mkdf-grid-col-12">
					<?php echo mkdf_tours_get_search_page_content_html(); ?>

					<?php echo mkdf_tours_get_search_pagination(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>