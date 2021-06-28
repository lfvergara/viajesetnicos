<?php
if (!isset($title_tag) || $title_tag == ''){
	$title_tag = 'h4';
}

if (!isset($thumb_size)){
	$thumb_size = 'full';
}

if (!isset($display_label)){
	$display_label = 'yes';
}

?>
<div <?php post_class(array('mkdf-tours-gallery-simple-item mkdf-tours-row-item',mkdf_tours_get_tour_rating_class())); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="mkdf-tours-gallery-simple-item-image-holder">
			<?php if(mkdf_tours_get_tour_label_html() && $display_label == 'yes') : ?>
				<span class="mkdf-tours-gallery-simple-item-label-holder">
					<?php echo mkdf_tours_get_tour_label_html(); ?>
				</span>
			<?php endif; ?>
			
			<div class="mkdf-tours-gallery-simple-item-image">
				<?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>
				<!--
				<span class="mkdf-tours-gallery-simple-item-price-holder">
					<b>Desde</b><?php //echo mkdf_tours_get_tour_price_html(get_the_ID()); ?>
				</span>
				-->
				<div class="mkdf-tours-gallery-simple-item-content-holder">
					<div class="mkdf-tours-gallery-simple-item-content-inner">
						<?php if (mkdf_tours_get_tour_destination()) { ?>
							<h5 class="mkdf-tours-gallery-simple-item-destination-holder">
								<?php echo mkdf_tours_get_tour_destination_html(); ?>
							</h5>
						<?php } ?>
						<div class="mkdf-tours-gallery-simple-title-holder">
							<<?php echo esc_attr($title_tag);?> class="mkdf-tour-title">
								<?php the_title(); ?>
							</<?php echo esc_attr($title_tag);?>>
						</div>
					</div>
				</div>
				<a class="mkdf-tours-gallery-simple-item-link" href="<?php the_permalink(); ?>"></a>
			</div>
		</div>
	<?php endif; ?>
</div>