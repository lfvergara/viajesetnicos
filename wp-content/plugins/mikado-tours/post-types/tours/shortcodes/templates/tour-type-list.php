<div class="mkdf-tour-type-list-holder">
	<?php if(is_array($tour_types) && count($tour_types)) : ?>
		<div <?php mkdf_tours_class_attribute($list_classes);?>>
			<div class="mkdf-tours-row-inner-holder">
				<?php foreach($tour_types as $tour_type) : ?>
					<?php
					$type_icon = $caller->getTypeIcon($tour_type);
					$type_min_price = $caller->getTypeMinPrice($tour_type);
					?>
					<div class="mkdf-tours-type-item mkdf-tours-row-item">
						<a href="<?php echo esc_url(get_term_link($tour_type)); ?>">
							<?php if($type_icon) : ?>
							<span class="mkdf-tour-type-icon">
								<?php print $type_icon; ?>
							</span>
							<?php endif; ?>

							<h5 class="mkdf-tour-type-name">
								<?php echo esc_html($tour_type->name); ?>
							</h5>

							<?php if(!empty($type_min_price)) : ?>
								<span class="mkdf-tour-type-min-price-holder">
								<span class="mkdf-tour-type-min-price-label">
									<?php esc_html_e('From', 'mkdf-tours'); ?>
								</span>
								<span class="mkdf-tour-type-min-price">
									<?php echo mkdf_tours_price_helper()->formatPrice($type_min_price); ?>
								</span>
							</span>
							<?php endif; ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</div>