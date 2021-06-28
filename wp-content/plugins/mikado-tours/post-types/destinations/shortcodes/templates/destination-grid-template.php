<div class="mkdf-tours-destination-grid">
	<?php if($query->have_posts()) : ?>
		<div <?php mkdf_tours_class_attribute($classes);?>>
			<div class="mkdf-tours-row-inner-holder">
				<?php while($query->have_posts()) : ?>
					<?php $query->the_post(); ?>

					<?php if(has_post_thumbnail()) : ?>
						<div <?php post_class('mkdf-tours-destination-grid-item mkdf-tours-row-item'); ?>>
							<div class="mkdf-tours-destination-item-holder">
								<a href="<?php the_permalink() ?>">
									<div class="mkdf-tours-destination-item-image">
										<?php the_post_thumbnail($thumb_size); ?>
									</div>

									<div class="mkdf-tours-destination-item-content">
										<div class="mkdf-tours-destination-item-content-table">
											<div class="mkdf-tours-destination-item-content-table-cell">
												<<?php echo esc_attr($title_tag);?> class="mkdf-tours-destination-item-title">
													<?php the_title(); ?>
												</<?php echo esc_attr($title_tag);?>>
												<?php if (mkdf_tours_get_destinations_description()) { ?>
													<h5 class="mkdf-tours-destination-desc"><?php echo mkdf_tours_get_destinations_description();?></h5>
												<?php } ?>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		</div>

		<?php wp_reset_postdata(); ?>

	<?php else: ?>
		<p><?php esc_html_e('No destinations matched your criteria.', 'mkdf-tours'); ?></p>
	<?php endif; ?>
</div>