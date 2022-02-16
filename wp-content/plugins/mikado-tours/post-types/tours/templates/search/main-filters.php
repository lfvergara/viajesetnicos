<div class="mkdf-tours-search-main-filters-holder mkdf-boxed-widget" style="padding-top: 10px; padding-bottom: 90px; margin-bottom: 0px;">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h4 style="text-align: center;">
				<span style="color: #ffffff;">Encuentra la aventura que necesitas!</span>
			</h4>
		</div>
	</div>
	<form action="<?php echo esc_url(mkdf_tours_get_search_page_url()); ?>" method="GET">
		<!--
		<div class="mkdf-tours-search-main-filters-title">
			<h4><?php //esc_html_e('Destino', 'mkdf-tours'); ?></h4>
		</div>
		-->

		<input type="hidden" name="order_by" value="<?php echo esc_attr(mkdf_tours_search()->getOrderBy()); ?>">
		<input type="hidden" name="order_type" value="<?php echo esc_attr(mkdf_tours_search()->getOrderType()); ?>">
		<input type="hidden" name="view_type" value="<?php echo esc_attr(mkdf_tours_search()->getViewType()); ?>">
		<input type="hidden" name="page" value="<?php echo esc_attr($current_page); ?>">

		<div class="mkdf-tours-search-main-filters-fields">
			<!--
			<div class="mkdf-grid-col-3">
				<div class="mkdf-tours-input-with-icon">
					<span class="mkdf-tours-input-icon">
						<span class="icon_search"></span>
					</span>
					<input class="mkdf-tours-keyword-search" value="<?php //echo esc_attr($keyword); ?>" type="text" name="keyword" placeholder="<?php //esc_attr_e('Buscar destino', 'mkdf-tours'); ?>">
				</div>
			</div>
			-->
			<div class="mkdf-grid-col-4">
				<div class="mkdf-tours-input-with-icon">
					<span class="mkdf-tours-input-icon">
						<span class="icon_compass"></span>
					</span>
					<select class="mkdf-tours-select-placeholder" name="destination">
						<option value=""><?php esc_html_e('¿Dónde?', 'mkdf-tours'); ?></option>
						<option value="Armenia"><?php esc_html_e('Armenia', 'mkdf-tours'); ?></option>
						<option value="Benin"><?php esc_html_e('Benin', 'mkdf-tours'); ?></option>
						<option value="Bolivia"><?php esc_html_e('Bolivia', 'mkdf-tours'); ?></option>
						<option value="China"><?php esc_html_e('China', 'mkdf-tours'); ?></option>
						<option value="Colombia"><?php esc_html_e('Colombia', 'mkdf-tours'); ?></option>
						<option value="Corea del Norte"><?php esc_html_e('Corea del Norte', 'mkdf-tours'); ?></option>
						<option value="Costa Rica"><?php esc_html_e('Costa Rica', 'mkdf-tours'); ?></option>
						<option value="Egipto"><?php esc_html_e('Egipto', 'mkdf-tours'); ?></option>
						<option value="Etiopía"><?php esc_html_e('Etiopía', 'mkdf-tours'); ?></option>
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
						<option value="Vietnam"><?php esc_html_e('Vietnam', 'mkdf-tours'); ?></option>
						<option value=""><?php esc_html_e('Cualquiera'); ?></option>
					</select>
					<!--
					<input type="text" value="<?php //echo esc_attr($destination); ?>" class="mkdf-tours-destination-search" name="destination" placeholder="<?php //esc_attr_e('¿Dónde?', 'mkdf-tours'); ?>">
					-->
				</div>
			</div>
			<!--
			<div class="mkdf-grid-col-3">
				<div class="mkdf-tours-input-with-icon">
					<span class="mkdf-tours-input-icon">
						<span class="icon_calendar"></span>
					</span>
					<select name="month" class="mkdf-tours-select-placeholder">
						<?php //foreach($months as $month_value => $month_label) : ?>
							<?php //$selected = $month_value === (int) $chosen_month ? 'selected' : ''; ?>

							<option <?php //echo esc_attr($selected); ?> value="<?php //echo esc_attr($month_value); ?>"><?php //echo esc_html($month_label); ?></option>
						<?php //endforeach; ?>
						<option value=""><?php //esc_html_e('Cualquiera'); ?></option>
					</select>
				</div>
			</div>
			-->
			<!--
			<div class="mkdf-tours-range-input"></div>

			<div class="mkdf-tours-input-with-icon">
				<span><?php //esc_html_e('Rango de precio', 'mkdf-tours'); ?></span>
				<input type="text" class="mkdf-tours-price-range-field"
					data-currency-symbol-position="<?php //echo esc_attr($currency_position); ?>"
					data-currency-symbol="<?php //echo esc_attr($currency_symbol); ?>"
					data-min-price="<?php //echo esc_attr($min_price); ?>"
					data-max-price="<?php //echo esc_attr($max_price); ?>"
					data-chosen-min-price="<?php //echo esc_attr($chosen_min_price); ?>"
					data-chosen-max-price="<?php //echo esc_attr($chosen_max_price); ?>"
					placeholder="<?php //esc_attr_e('Rango de precio', 'mkdf-tours'); ?>">
				<input type="hidden" name="min_price">
				<input type="hidden" name="max_price">
			</div>
			-->


			<?php if(is_array($tour_types) && count($tour_types) && $show_tour_types) : ?>
				<div class="mkdf-grid-col-4">
					<div class="mkdf-tours-input-with-icon">
						<span class="mkdf-tours-input-icon">
							<span class="icon_camera"></span>
						</span>
						<select class="mkdf-tours-select-placeholder" name="type[]">
							<option value=""><?php esc_html_e('Categorías','mkdf-tours'); ?></option>
							<?php if(is_array($tour_types) && count($tour_types)) : ?>
								<?php foreach($tour_types as $tour_type) : ?>
									<option value="<?php echo esc_attr($tour_type->slug); ?>"><?php echo esc_html($tour_type->name); ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
							<option value=""><?php esc_html_e('Todas las categorías','mkdf-tours'); ?></option>
						</select>
					</div>
				</div>
			<?php endif; ?>

			<div class="mkdf-grid-col-4">
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
				<input type="submit" name="mkdf_tours_search_submit" value="<?php esc_attr_e('Buscar', 'mkdf-tours') ?>" class="mkdf-btn mkdf-btn-small" data-searching-label="<?php esc_attr_e('Buscando...', 'mkdf-tours'); ?>">
			</div>
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