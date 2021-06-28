<div <?php post_class('mkdf-tours-list-item mkdf-tours-row-item'); ?> style="background: #FFF;">
	<div class="mkdf-tours-list-item-table">
		<?php if(has_post_thumbnail()) : ?>
			<div class="mkdf-tours-list-item-image-holder">
				<div class="mkdf-tours-list-item-image-holder-inner">
					<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>);" target="_blank">
						<?php the_post_thumbnail($thumb_size); ?>
					</a>
					<?php if(mkdf_tours_get_tour_label_html()) : ?>
						<span class="mkdf-tours-standard-item-label-holder">
							<?php echo mkdf_tours_get_tour_label_html(); ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="mkdf-tours-list-item-content-holder">
			<div class="mkdf-tours-list-item-title-price-holder">
				<<?php echo esc_attr($title_tag);?> class="mkdf-tour-title">
					<a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
				</<?php echo esc_attr($title_tag);?>>
			</div>

			<div class="mkdf-tours-list-item-rating">
				<?php echo mkdf_tours_get_tour_rating_html(); ?>
			</div>

			<?php if(mkdf_tours_get_tour_excerpt()) : ?>
				<div class="mkdf-tours-list-item-excerpt">
					<p><?php echo mkdf_tours_get_tour_excerpt($text_length); ?></p>
				</div>
			<?php endif; ?>

			
			<div class="mkdf-tours-list-item-price-holder">
				<?php if(mkdf_tours_get_tour_destination()) : ?>
					<div class="mkdf-tours-list-item-destination">
						<p><?php echo mkdf_tours_get_tour_destination_html(); ?></p>
					</div>
				<?php endif; ?>
				<!--
				<div class="mkdf-tours-list-item-price">
				    <span class="mkdf-tours-list-price-label"><?php //esc_html_e('Desde ', 'mkdf-tours'); ?></span>
					<?php //echo mkdf_tours_get_tour_price_html(); ?>
					<span class="mkdf-tours-list-price-label"><?php //esc_html_e('', 'mkdf-tours'); ?></span>
				</div>
				-->
				
				<?php if(mkdf_tours_theme_installed()) : ?>
					<?php echo roam_mikado_get_social_share_html(); ?>
				<?php endif; ?>
			</div>


			<div class="mkdf-tours-list-item-bottom-content">
				<?php if(mkdf_tours_get_tour_duration()) : ?>
					<div class="mkdf-tours-list-item-bottom-item">
						<?php echo mkdf_tours_get_tour_duration_html(); ?>
					</div>
				<?php endif; ?>

				<?php if(mkdf_tours_get_tour_min_age()) : ?>
					<div class="mkdf-tours-list-item-bottom-item">
						<?php echo mkdf_tours_get_tour_min_age_html(); ?>
					</div>
				<?php endif; ?>
				<div class="mkdf-tours-list-item-bottom-item">
					<?php echo mkdf_tours_get_tour_categories_html(); ?>
				</div>
			</div>
		</div>
	</div>
</div>