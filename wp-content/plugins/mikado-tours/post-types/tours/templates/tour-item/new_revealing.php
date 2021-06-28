<?php
if (!isset($title_tag) || $title_tag == ''){
	$title_tag = 'h6';
}

if (!isset($text_length)){
	$text_length = '15';
}

if (!isset($content_style)){
	$content_style = '';
}

if (!isset($thumb_size)){
	$thumb_size = 'full';
}

if (!isset($display_label)){
	$display_label = 'yes';
}
?>
<div <?php post_class(array('mkdf-tours-revealing-item mkdf-tours-row-item',mkdf_tours_get_tour_rating_class())); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="mkdf-tours-revealing-item-image-holder">
			<?php if(mkdf_tours_get_tour_label_html() && $display_label == 'yes') : ?>
				<span class="mkdf-tours-revealing-item-label-holder">
					<?php echo mkdf_tours_get_tour_label_html(); ?>
				</span>
			<?php endif; ?>
			
			<div class="mkdf-tours-revealing-item-image">
				<?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>
				
				<div class="mkdf-tours-revealing-item-content-holder" <?php mkdf_tours_inline_style($content_style);?>>
					<div class="mkdf-tours-revealing-item-content-inner">
						<div class="mkdf-tours-revealing-title-holder">
							<h6 class="mkdf-tour-title">
								<?php the_title(); ?>
							</h6>
							<span class="mkdf-tours-revealing-item-price-holder">
								<?php echo mkdf_tours_get_tour_price_html(); ?>
							</span>
						</div>
						<?php if(mkdf_tours_get_tour_excerpt()) : ?>
							<div class="mkdf-tours-revealing-item-excerpt">
								<div class="mkdf-tours-revealing-item-excerpt-inner">
									<?php echo mkdf_tours_get_tour_excerpt($text_length); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<a class="mkdf-tours-revealing-item-link" href="<?php the_permalink(); ?>"></a>
		</div>
	<?php endif; ?>
</div>