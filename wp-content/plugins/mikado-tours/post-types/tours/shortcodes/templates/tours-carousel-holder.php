<div class="mkdf-tours-carousel-holder mkdf-carousel-pagination">
	<div <?php mkdf_tours_class_attribute($list_classes);?>>
	    <?php if($query->have_posts()) : ?>
		    <div class="mkdf-tours-row-inner-holder">
		        <div class="mkdf-tours-carousel mkdf-owl-slider" <?php echo mkdf_tours_get_inline_attrs($carousel_data); ?>>

		            <?php while($query->have_posts()) : ?>
		                <?php $query->the_post(); ?>
	                    <?php $caller->getItemTemplate($tour_type, $item_params); ?>
		            <?php endwhile; ?>

		        </div>
		    </div>
	    <?php else: ?>
	        <p><?php esc_html_e('No tours match your criteria', 'mkdf-tours'); ?></p>
	    <?php endif; ?>
	    <?php wp_reset_postdata(); ?>
	</div>
</div>