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
			<center>
			<form action="<?php echo esc_url(mkdf_tours_get_search_page_url()); ?>" method="GET">
				<div class="mkdf-tours-filters-fields-holder">
					<div class="mkdf-tours-filter-field-holder mkdf-tours-filter-col">
						<div class="mkdf-tours-input-with-icon">
							<select class="mkdf-tours-select-placeholder" name="destination">
								<option value=""><?php esc_html_e('¿Dónde?', 'mkdf-tours'); ?></option>
								<option value="Armenia"><?php esc_html_e('Armenia', 'mkdf-tours'); ?></option>
								<option value="Benin"><?php esc_html_e('Benin', 'mkdf-tours'); ?></option>
								<option value="Bolivia"><?php esc_html_e('Bolivia', 'mkdf-tours'); ?></option>
								<option value="China"><?php esc_html_e('China', 'mkdf-tours'); ?></option>
								<option value="Colombia"><?php esc_html_e('Colombia', 'mkdf-tours'); ?></option>
								<option value="Corea del Norte"><?php esc_html_e('Corea del Norte', 'mkdf-tours'); ?></option>
								<option value="Costa Rica"><?php esc_html_e('Costa Rica', 'mkdf-tours'); ?></option>
								<option value="Etiopía"><?php esc_html_e('Etiopía', 'mkdf-tours'); ?></option>
								<option value="Egipto"><?php esc_html_e('Egipto', 'mkdf-tours'); ?></option>
								<option value="Guinea-Bissau"><?php esc_html_e('Guinea Bissau', 'mkdf-tours'); ?></option>
								<option value="Groenlandia"><?php esc_html_e('Groenlandia', 'mkdf-tours'); ?></option>
								<option value="Guatemala"><?php esc_html_e('Guatemala', 'mkdf-tours'); ?></option>
								<option value="India"><?php esc_html_e('India', 'mkdf-tours'); ?></option>
								<option value="Irán"><?php esc_html_e('Irán', 'mkdf-tours'); ?></option>
								<option value="Kirguistán"><?php esc_html_e('Kirguistán', 'mkdf-tours'); ?></option>
								<option value="Myanmar"><?php esc_html_e('Myanmar', 'mkdf-tours'); ?></option>
								<option value="Panamá"><?php esc_html_e('Panamá', 'mkdf-tours'); ?></option>
								<option value="Papúa Nueva Guinea"><?php esc_html_e('Papúa Nueva Guinea', 'mkdf-tours'); ?></option>
								<option value="Senegal"><?php esc_html_e('Senegal', 'mkdf-tours'); ?></option>
								<option value="Turquia"><?php esc_html_e('Turquía', 'mkdf-tours'); ?></option>
								<option value="Vietnam"><?php esc_html_e('Vietnam', 'mkdf-tours'); ?></option>
								<option value=""><?php esc_html_e('Cualquiera'); ?></option>
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
			</center>
		</div>

        <?php if($filter_in_grid == 'yes') { ?>
		    </div>
        <?php } ?>

	<?php endif; ?>
</div>