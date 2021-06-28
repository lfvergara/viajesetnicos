<div class="mkdf-tours-single-title <?php echo esc_attr($additional_classes);?>" <?php mkdf_tours_inline_style($holder_style);?>>
	<div class="mkdf-tours-single-title-table">
		<div class="mkdf-tours-single-title-table-cell">
			<h1 class="mkdf-tt-single entry-title">
				<?php the_title(); ?>
			</h1>
			<?php echo wp_kses($separator_html,array(
				'img' => array(
					'src' => true,
					'alt' => true,
					'width' => true,
					'height' => true,
					'class' => true,
				)
			));?>
		</div>
	</div>
	<div class="mkdf-tours-single-bottom-holder">
		<div class="mkdf-tours-single-bottom-holder-table">
			<div class="mkdf-tours-single-info-left">
			</div>
			<div class="mkdf-tours-single-scroll-down">
				<span class="mkdf-ts-scroll-text">
					<?php esc_html_e('Desplazar hacia abajo','mkdf-tours'); ?>
				</span>
				<span class="mkdf-tst-icon ion-android-arrow-down"></span>
			</div>
			<div class="mkdf-tours-single-info-right">
				<?php echo mkdf_tours_get_tour_rating_stars_html(); ?>
			</div>
		</div>
	</div>
</div>