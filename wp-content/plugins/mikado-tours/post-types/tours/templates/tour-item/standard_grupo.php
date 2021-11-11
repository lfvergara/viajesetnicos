<?php
if (!isset($title_tag) || $title_tag == ''){
	$title_tag = 'h4';
}

if (!isset($text_length)){
	$text_length = '20';
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
<div <?php post_class('mkdf-tours-standard-item mkdf-tours-row-item'); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="mkdf-tours-standard-item-image-holder">
			<a href="<?php the_permalink(); ?>">
				<?php echo mkdf_tours_get_tour_image_html($thumb_size); ?>
			</a>
			<?php if(mkdf_tours_get_tour_label_html() && $display_label == 'yes') : ?>
				<span class="mkdf-tours-standard-item-label-holder">
					<?php echo mkdf_tours_get_tour_label_html(); ?>
				</span>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="mkdf-tours-standard-item-content-holder">
		<div class="mkdf-tours-standard-item-content-inner" <?php mkdf_tours_inline_style($content_style);?>>
			<span class="mkdf-tours-standard-item-price-holder" style="width: 100%; text-align: right !important; margin-bottom: 2%;">
				<?php echo mkdf_tours_get_tour_price_grupo_html(); ?>
			</span>
			<div class="mkdf-tours-standard-item-title-price-holder">
				<<?php echo esc_attr($title_tag);?> class="mkdf-tour-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</<?php echo esc_attr($title_tag);?>>
			</div>
	
			<?php if(mkdf_tours_get_tour_rating()) : ?>
				<div class="mkdf-tours-standard-item-rating">
					<?php echo mkdf_tours_get_tour_rating_html(); ?>
				</div>
			<?php endif; ?>
	
			<?php if(mkdf_tours_get_tour_excerpt()) : ?>
				<div class="mkdf-tours-standard-item-excerpt">
					<?php echo mkdf_tours_get_tour_excerpt($text_length); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="mkdf-tours-standard-item-bottom-content">
			<?php if(mkdf_tours_get_tour_duration()) : ?>
				<div class="mkdf-tours-standard-item-bottom-item">
					<b><?php echo mkdf_tours_get_tour_duration_html(); ?></b>
				</div>
			<?php endif; ?>

			<?php if(mkdf_tours_get_tour_min_age()) : ?>
				<div class="mkdf-tours-standard-item-bottom-item">
					<?php echo mkdf_tours_get_tour_min_age_html(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>