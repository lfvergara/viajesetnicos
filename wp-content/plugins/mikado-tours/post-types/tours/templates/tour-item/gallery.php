<?php
if (!isset($title_tag) || $title_tag == ''){
	$title_tag = 'h4';
}

if (!isset($text_length)){
	$text_length = '20';
}

if (!isset($custom_class)){
	$custom_class = '';
}

if (!isset($thumb_size)){
	$thumb_size = 'full';
}

if (!isset($display_label)){
	$display_label = 'yes';
}
?>
<div <?php post_class(array('mkdf-tours-gallery-item mkdf-tours-row-item',mkdf_tours_get_tour_rating_class(),$custom_class)); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="mkdf-tours-gallery-item-image-holder">
			<?php if(mkdf_tours_get_tour_label_html() && $display_label == 'yes') : ?>
				<span class="mkdf-tours-gallery-item-label-holder">
					<?php echo mkdf_tours_get_tour_label_html(); ?>
				</span>
			<?php endif; ?>
			
			<div class="mkdf-tours-gallery-item-image">
				<?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>
				
				<div class="mkdf-tours-gallery-item-content-holder">
					<div class="mkdf-tours-gallery-item-content-inner">
						<div class="mkdf-tours-gallery-title-holder">
							<<?php echo esc_attr($title_tag);?> class="mkdf-tour-title">
								<?php the_title(); ?>
							</<?php echo esc_attr($title_tag);?>>
							<span class="mkdf-tours-gallery-item-price-holder">
								<?php echo mkdf_tours_get_tour_price_html(); ?>
							</span>
						</div>
						<?php if (mkdf_tours_get_tour_destination()) { ?>
							<h5 class="mkdf-tours-gallery-item-destination-holder">
								<?php echo mkdf_tours_get_tour_destination_html(); ?>
							</h5>
						<?php } ?>
						<?php if(mkdf_tours_get_tour_excerpt()) : ?>
							<div class="mkdf-tours-gallery-item-excerpt">
								<div class="mkdf-tours-gallery-item-excerpt-inner">
									<?php echo mkdf_tours_get_tour_excerpt($text_length); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<a class="mkdf-tours-gallery-item-link" href="<?php the_permalink(); ?>"></a>
			</div>
		</div>
	<?php endif; ?>
</div>