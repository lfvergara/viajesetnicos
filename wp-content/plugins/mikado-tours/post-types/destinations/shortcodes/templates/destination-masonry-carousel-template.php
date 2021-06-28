<div class="mkdf-tours-destination-masonry-carousel">
	<?php if($query->have_posts()) : 
		$counter = 1;
		?>
		<div <?php mkdf_tours_class_attribute($classes);?>>
			<div class="mkdf-tours-row-inner-holder">
		        <div class="mkdf-tdm-carousel mkdf-owl-slider-style" <?php echo mkdf_tours_get_inline_attrs($carousel_data); ?>>
					<?php while($query->have_posts()) {
							$query->the_post();
							if(has_post_thumbnail()) { 
								$item_params = $caller->itemParams(get_the_ID(),$params,$counter);

								echo mkdf_tours_get_tour_module_template_part('templates/destination-masonry-carousel-item-template', 'destinations', 'shortcodes', '', $item_params);
								$counter++;
							}
						} ?>
				</div>
			</div>
		</div>

		<?php wp_reset_postdata(); ?>

	<?php else: ?>
		<p><?php esc_html_e('No destinations matched your criteria.', 'mkdf-tours'); ?></p>
	<?php endif; ?>
</div>