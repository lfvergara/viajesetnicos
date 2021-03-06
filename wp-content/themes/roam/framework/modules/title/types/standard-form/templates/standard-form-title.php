<?php do_action('roam_mikado_before_page_title'); ?>

<div class="mkdf-title-holder <?php echo esc_attr($holder_classes); ?>" <?php roam_mikado_inline_style($holder_styles); ?> <?php echo roam_mikado_get_inline_attrs($holder_data); ?>>
	<?php if(!empty($title_image)) { ?>
		<div class="mkdf-title-image">
			<img itemprop="image" src="<?php echo esc_url($title_image['src']); ?>" alt="<?php echo esc_html($title_image['alt']); ?>" style="height:390px;"/>
		</div>
	<?php } ?>
	<div class="mkdf-title-wrapper" <?php roam_mikado_inline_style($wrapper_styles); ?>>
		<div class="mkdf-title-inner">
			<div class="mkdf-grid">
				<div class="mkdf-grid-col-9" style="display: table-cell; height: 100%; vertical-align: middle; padding-top: 6%;">
					<?php if(!empty($title)) { ?>
						<<?php echo esc_attr($title_tag); ?> class="mkdf-page-title entry-title" <?php roam_mikado_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
					<?php } ?>
					<?php if(!empty($subtitle)){ ?>
						<<?php echo esc_attr($subtitle_tag); ?> class="mkdf-page-subtitle" <?php roam_mikado_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></<?php echo esc_attr($subtitle_tag); ?>>
					<?php } ?>
				</div>
					
				<div class="mkdf-grid-col-3">
					<div class="mkdf-tours-search-main-filters-holder mkdf-boxed-widget" style="margin-top: 3px; padding: 10px;">
						<form action="<?php echo esc_url(mkdf_tours_get_search_page_url()); ?>" method="GET">
							<input type="hidden" name="order_by" value="date">
							<input type="hidden" name="order_type" value="desc">
							<input type="hidden" name="view_type" value="list">
							<input type="hidden" name="page" value="1">
							<div class="mkdf-tours-search-main-filters-fields">
								<!--
								<div class="mkdf-tours-input-with-icon" style="margin-bottom: 0px;">
									<span class="mkdf-tours-input-icon">
										<span class="icon_compass"></span>
									</span>
									<input class="mkdf-tours-keyword-search" value="<?php //echo esc_attr($keyword); ?>" type="text" name="keyword" placeholder="<?php esc_attr_e('Buscar destino', 'mkdf-tours'); ?>">
								</div>
								-->

								<div class="mkdf-tours-input-with-icon" style="margin-bottom: 0px;">
									<span class="mkdf-tours-input-icon">
										<span class="icon_compass"></span>
									</span>
									<select class="mkdf-tours-select-placeholder" name="destination">
										<option value=""><?php esc_html_e('??D??nde?', 'mkdf-tours'); ?></option>
										<option value="Armenia"><?php esc_html_e('Armenia', 'mkdf-tours'); ?></option>
										<option value="Benin"><?php esc_html_e('Benin', 'mkdf-tours'); ?></option>
										<option value="Bolivia"><?php esc_html_e('Bolivia', 'mkdf-tours'); ?></option>
										<option value="China"><?php esc_html_e('China', 'mkdf-tours'); ?></option>
										<option value="Colombia"><?php esc_html_e('Colombia', 'mkdf-tours'); ?></option>
										<option value="Corea del Norte"><?php esc_html_e('Corea del Norte', 'mkdf-tours'); ?></option>
										<option value="Costa Rica"><?php esc_html_e('Costa Rica', 'mkdf-tours'); ?></option>
										<option value="Etiop??a"><?php esc_html_e('Etiop??a', 'mkdf-tours'); ?></option>
										<option value="Guinea-Bissau"><?php esc_html_e('Guinea-Bissau', 'mkdf-tours'); ?></option>
										<option value="Groenlandia"><?php esc_html_e('Groenlandia', 'mkdf-tours'); ?></option>
										<option value="Guatemala"><?php esc_html_e('Guatemala', 'mkdf-tours'); ?></option>
										<option value="India"><?php esc_html_e('India', 'mkdf-tours'); ?></option>
										<option value="Ir??n"><?php esc_html_e('Ir??n', 'mkdf-tours'); ?></option>
										<option value="Kirguist??n"><?php esc_html_e('Kirguist??n', 'mkdf-tours'); ?></option>
										<option value="Myanmar"><?php esc_html_e('Myanmar', 'mkdf-tours'); ?></option>
										<option value="Panam??"><?php esc_html_e('Panam??', 'mkdf-tours'); ?></option>
										<option value="Pap??a Nueva Guinea"><?php esc_html_e('Pap??a Nueva Guinea', 'mkdf-tours'); ?></option>
										<option value="Senegal"><?php esc_html_e('Senegal', 'mkdf-tours'); ?></option>
										<option value="Vietnam"><?php esc_html_e('Vietnam', 'mkdf-tours'); ?></option>
										<option value=""><?php esc_html_e('Cualquiera'); ?></option>
										<!--
										<option value="Extremo Oriente"><?php //esc_html_e('Extremo Oriente', 'mkdf-tours'); ?></option>
										<option value="Latinoam??rica"><?php //esc_html_e('Latinoam??rica', 'mkdf-tours'); ?></option>
										<option value="Oriente Pr??ximo"><?php //esc_html_e('Oriente Pr??ximo', 'mkdf-tours'); ?></option>
										<option value="Rusia y Asia Central"><?php //esc_html_e('Rusia y Asia Central', 'mkdf-tours'); ?></option>
										<option value="Tierras Polares"><?php //esc_html_e('Tierras Polares', 'mkdf-tours'); ?></option>
										<option value="Europa+y+Rusia+Europea"><?php //esc_html_e('Europa y Rusia Europea', 'mkdf-tours'); ?></option>
										<option value="Sur+de+Asia"><?php //esc_html_e('Sur de Asia', 'mkdf-tours'); ?></option>
										<option value="Sudeste+Asi??tico"><?php //esc_html_e('Sudeste Asi??tico', 'mkdf-tours'); ?></option>
										<option value="Ocean??a"><?php //esc_html_e('Ocean??a', 'mkdf-tours'); ?></option>
										<option value="Norte+de+??frica"><?php //esc_html_e('Norte de ??frica', 'mkdf-tours'); ?></option>
										<option value="??frica+Negra"><?php //esc_html_e('??frica Negra', 'mkdf-tours'); ?></option>
										<option value="Norteam??rica"><?php //esc_html_e('Norteam??rica', 'mkdf-tours'); ?></option>
										-->
									</select>
								</div>

								<!--
								<div class="mkdf-tours-input-with-icon" style="margin-bottom: 0px;">
									<span class="mkdf-tours-input-icon">
										<span class="icon_compass"></span>
									</span>
									<input type="text" value="<?php //echo esc_attr($destination); ?>" class="mkdf-tours-destination-search" name="destination" placeholder="<?php esc_attr_e('??D??nde?', 'mkdf-tours'); ?>">
								</div>

								<div class="mkdf-tours-input-with-icon" style="margin-bottom: 0px;">
									<span class="mkdf-tours-input-icon">
										<span class="icon_calendar"></span>
									</span>
									<select class="mkdf-tours-select-placeholder" name="month">
										<option value=""><?php //esc_html_e('Mes', 'mkdf-tours'); ?></option>
										<option value="1"><?php //esc_html_e('Enero', 'mkdf-tours'); ?></option>
										<option value="2"><?php //esc_html_e('Febrero', 'mkdf-tours'); ?></option>
										<option value="3"><?php //esc_html_e('Marzo', 'mkdf-tours'); ?></option>
										<option value="4"><?php //esc_html_e('Abril', 'mkdf-tours'); ?></option>
										<option value="5"><?php //esc_html_e('Mayo', 'mkdf-tours'); ?></option>
										<option value="6"><?php //esc_html_e('Junio', 'mkdf-tours'); ?></option>
										<option value="7"><?php //esc_html_e('Julio', 'mkdf-tours'); ?></option>
										<option value="8"><?php //esc_html_e('Agosto', 'mkdf-tours'); ?></option>
										<option value="9"><?php //esc_html_e('Septiembre', 'mkdf-tours'); ?></option>
										<option value="10"><?php //esc_html_e('Octubre', 'mkdf-tours'); ?></option>
										<option value="11"><?php //esc_html_e('Noviembre', 'mkdf-tours'); ?></option>
										<option value="12"><?php //esc_html_e('Diciembre', 'mkdf-tours'); ?></option>
										<option value=""><?php //esc_html_e('Cualquiera'); ?></option>
									</select>
								</div>
								-->
								<?php 
									$tour_types = get_terms(array('taxonomy' => 'tour-category'));
									if(is_array($tour_types) && count($tour_types)) : ?>
										<div class="mkdf-tours-input-with-icon" style="margin-bottom: 0px;">
											<span class="mkdf-tours-input-icon">
												<span class="icon_camera"></span>
											</span>
											<select class="mkdf-tours-select-placeholder" name="type[]">
												<option value=""><?php esc_html_e('Categor??as','mkdf-tours'); ?></option>
												<?php if(is_array($tour_types) && count($tour_types)) : ?>
													<?php foreach($tour_types as $tour_type) : ?>
														<option value="<?php echo esc_attr($tour_type->slug); ?>"><?php echo esc_html($tour_type->name); ?></option>
													<?php endforeach; ?>
												<?php endif; ?>
												<option value=""><?php esc_html_e('Todas las categor??as','mkdf-tours'); ?></option>
											</select>
										</div>									
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
									<input type="submit" name="mkdf_tours_search_submit" value="<?php esc_attr_e('Buscar', 'mkdf-tours') ?>" class="mkdf-btn mkdf-btn-medium" data-searching-label="<?php esc_attr_e('Buscando...', 'mkdf-tours'); ?>">
								<?php endif; ?>
							</div>
						</form>
					</div>
				</div>
	    	</div>
	    </div>
	</div>
</div>
<?php do_action('roam_mikado_after_page_title'); ?>