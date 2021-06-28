<div <?php mkdf_tours_class_attribute($filter_class); ?>>
	<?php if($filter_type === 'vertical') : ?>
		<?php echo mkdf_tours_get_search_main_filters_html($show_tour_types, $number_of_tour_types); ?>
	<?php else: ?>
		<?php
			$tour_types = get_terms(array(
				'taxonomy' => 'tour-category'
			));
		?>
		<?php if($filter_in_grid == 'yes') { ?>
			<div class="mkdf-grid">
		<?php } ?>
		
		<div class="mkdf-tours-search-horizontal-filters-holder">
			<form action="<?php echo esc_url(mkdf_tours_get_search_page_url()); ?>" method="GET">
				<div class="mkdf-tours-filters-fields-holder">
					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-col">
						<div class="mkdf-tours-input-with-icon">
							<input type="text" value="" class="mkdf-tours-destination-search" name="destination" placeholder="<?php esc_attr_e('¿Dónde?', 'mkdf-tours'); ?>">
						</div>
					</div>
					
					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-col">
						<div class="mkdf-tours-input-with-icon">
							<select class="mkdf-tours-select-placeholder" name="month">
								<option value=""><?php esc_html_e('¿Cuando?', 'mkdf-tours'); ?></option>
								<option value="1"><?php esc_html_e('Enero', 'mkdf-tours'); ?></option>
								<option value="2"><?php esc_html_e('Febrero', 'mkdf-tours'); ?></option>
								<option value="3"><?php esc_html_e('Marzo', 'mkdf-tours'); ?></option>
								<option value="4"><?php esc_html_e('Abril', 'mkdf-tours'); ?></option>
								<option value="5"><?php esc_html_e('Mayo', 'mkdf-tours'); ?></option>
								<option value="6"><?php esc_html_e('Junio', 'mkdf-tours'); ?></option>
								<option value="7"><?php esc_html_e('Julio', 'mkdf-tours'); ?></option>
								<option value="8"><?php esc_html_e('Agosto', 'mkdf-tours'); ?></option>
								<option value="9"><?php esc_html_e('Septiembre', 'mkdf-tours'); ?></option>
								<option value="10"><?php esc_html_e('Octubre', 'mkdf-tours'); ?></option>
								<option value="11"><?php esc_html_e('Noviembre', 'mkdf-tours'); ?></option>
								<option value="12"><?php esc_html_e('Diciembre', 'mkdf-tours'); ?></option>
							</select>
						</div>
					</div>
					
					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-col">
						<div class="mkdf-tours-input-with-icon">
							<select class="mkdf-tours-select-placeholder" name="type[]">
								<option value=""><?php esc_html_e('Tipo de Viaje','mkdf-tours'); ?></option>
								<?php if(is_array($tour_types) && count($tour_types)) : ?>
									<?php foreach($tour_types as $tour_type) : ?>
										<option value="<?php echo esc_attr($tour_type->slug); ?>"><?php echo esc_html($tour_type->name); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</div>
					</div>

					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-submit-field-holder mkdf-tours-filter-col">
						<?php if(mkdf_tours_theme_installed()) : ?>
							<?php echo mkdf_tours_execute_shortcode('mkdf_button', array(
								'html_type'  => 'input',
								'input_name' => 'mkdf_tours_search_submit',
								'text'       => esc_attr__('BUSCAR', 'mkdf-tours'),
								'custom_class' => 'mkdf-tours-filter-button',
								'custom_attrs' => array(
									'data-searching-label' => esc_attr__('Buscando...', 'mkdf-tours')
								)
							)); ?>
						<?php else: ?>
							<input type="submit" data-searching-label="<?php esc_attr_e('Searching...', 'mkdf-tours'); ?>" name="mkdf_tours_search_submit" value="<?php esc_attr_e('FIND NOW', 'mkdf-tours') ?>">
						<?php endif; ?>
					</div>
					
					<?php if(mkdf_tours_is_wpml_installed()) { ?>
						<?php
							$lang = ICL_LANGUAGE_CODE;
						?>
						<input type="hidden" name="lang" value="<?php echo esc_attr($lang); ?>">
					<?php } ?>
				</div>
			</form>
		</div>

        <?php if($filter_in_grid == 'yes') { ?>
		    </div>
        <?php } ?>

	<?php endif; ?>
</div>