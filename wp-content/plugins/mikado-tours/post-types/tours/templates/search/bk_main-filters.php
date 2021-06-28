<div class="mkdf-tours-search-main-filters-holder mkdf-boxed-widget">
	<form action="<?php echo esc_url(mkdf_tours_get_search_page_url()); ?>" method="GET">
		<div class="mkdf-tours-search-main-filters-title">
			<h4><?php esc_html_e('Destino', 'mkdf-tours'); ?></h4>
		</div>

		<input type="hidden" name="order_by" value="<?php echo esc_attr(mkdf_tours_search()->getOrderBy()); ?>">
		<input type="hidden" name="order_type" value="<?php echo esc_attr(mkdf_tours_search()->getOrderType()); ?>">
		<input type="hidden" name="view_type" value="<?php echo esc_attr(mkdf_tours_search()->getViewType()); ?>">
		<input type="hidden" name="page" value="<?php echo esc_attr($current_page); ?>">

		<div class="mkdf-tours-search-main-filters-fields">
			<div class="mkdf-tours-input-with-icon">
				<span class="mkdf-tours-input-icon">
					<span class="icon_search"></span>
				</span>
				<input class="mkdf-tours-keyword-search" value="<?php echo esc_attr($keyword); ?>" type="text" name="keyword" placeholder="<?php esc_attr_e('Buscar destino', 'mkdf-tours'); ?>">
			</div>
			<div class="mkdf-tours-input-with-icon">
				<span class="mkdf-tours-input-icon">
					<span class="icon_compass"></span>
				</span>
				<input type="text" value="<?php echo esc_attr($destination); ?>" class="mkdf-tours-destination-search" name="destination" placeholder="<?php esc_attr_e('¿Dónde?', 'mkdf-tours'); ?>">
			</div>
			<div class="mkdf-tours-input-with-icon">
				<span class="mkdf-tours-input-icon">
					<span class="icon_calendar"></span>
				</span>
				<select name="month" class="mkdf-tours-select-placeholder">
					<?php foreach($months as $month_value => $month_label) : ?>
						<?php $selected = $month_value === (int) $chosen_month ? 'selected' : ''; ?>

						<option <?php echo esc_attr($selected); ?> value="<?php echo esc_attr($month_value); ?>"><?php echo esc_html($month_label); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="mkdf-tours-range-input"></div>

			<div class="mkdf-tours-input-with-icon">
				<span><?php esc_html_e('Rango de precio', 'mkdf-tours'); ?></span>
				<input type="text" class="mkdf-tours-price-range-field"
					data-currency-symbol-position="<?php echo esc_attr($currency_position); ?>"
					data-currency-symbol="<?php echo esc_attr($currency_symbol); ?>"
					data-min-price="<?php echo esc_attr($min_price); ?>"
					data-max-price="<?php echo esc_attr($max_price); ?>"
					data-chosen-min-price="<?php echo esc_attr($chosen_min_price); ?>"
					data-chosen-max-price="<?php echo esc_attr($chosen_max_price); ?>"
					placeholder="<?php esc_attr_e('Rango de precio', 'mkdf-tours'); ?>">
				<input type="hidden" name="min_price">
				<input type="hidden" name="max_price">
			</div>


			<?php if(is_array($tour_types) && count($tour_types) && $show_tour_types) : ?>
				<?php foreach($tour_types as $type) : ?>
					<?php
					$checked = in_array($type->slug, $checked_types);
					$checked_attr = $checked ? 'checked' : '';
					?>

					<div class="mkdf-tours-type-filter-item">
						<input <?php echo esc_attr($checked_attr); ?> type="checkbox" id="mkdf-tour-type-filter-<?php echo esc_attr($type->slug); ?>" name="type[]" value="<?php echo esc_attr($type->slug); ?>">
						<label for="mkdf-tour-type-filter-<?php echo esc_attr($type->slug); ?>">
						<span>
							<?php echo esc_html($type->name); ?>
						</span>
						</label>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if(mkdf_tours_theme_installed()) : ?>
				<?php echo roam_mikado_execute_shortcode('mkdf_button', array(
					'html_type'    => 'input',
					'input_name'   => 'mkdf_tours_search_submit',
					'size'		   => 'medium',
					'text'         => esc_attr__('Buscar', 'mkdf-tours'),
					'custom_attrs' => array(
						'data-searching-label' => esc_attr__('Buscando...', 'mkdf-tours')
					)
				)); ?>
			<?php else: ?>
				<input type="submit" name="mkdf_tours_search_submit" value="<?php esc_attr_e('Buscar', 'mkdf-tours') ?>" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid" data-searching-label="<?php esc_attr_e('Buscando...', 'mkdf-tours'); ?>">
			<?php endif; ?>
			
			<?php if(mkdf_tours_is_wpml_installed()) { ?>
				<?php
					$lang = ICL_LANGUAGE_CODE;
				?>
				<input type="hidden" name="lang" value="<?php echo esc_attr($lang); ?>">
			<?php } ?>
		</div>
	</form>
</div>