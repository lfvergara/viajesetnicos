<div class="mkdf-tours-top-reviews-carousel-holder">
	<?php if(is_array($reviews) && count($reviews)) : ?>
		<div class="mkdf-tours-top-reviews-carousel-inner">
			<?php if(!empty($title)) { ?>
				<h3 class="mkdf-tours-top-reviews-carousel-title"><?php echo esc_html($title); ?></h3>
			<?php } ?>
	
			<div class="mkdf-tours-top-reviews-carousel mkdf-owl-slider">
				<?php foreach($reviews as $review) : ?>
					<div class="mkdf-tours-top-reviews-carousel-item">
						<h4 class="mkdf-tours-top-reviews-item-title">
							<a href="<?php the_permalink($review->comment_post_ID); ?>"><?php echo get_the_title($review->comment_post_ID) ?></a>
						</h4>

						<div class="mkdf-tour-reviews-criteria-holder">
							<div class="mkdf-tour-reviews-criteria-holder-inner">
								<span class="mkdf-tour-reviews-rating-holder">
								<?php for($i = 0; $i < MIKADO_TOURS_REVIEWS_MAX_RATING; $i++) : ?>
									<?php
									$is_empty_star = $i >= $review->rating;
									$star_class = $is_empty_star ? 'icon_star_alt' : 'icon_star';
									?>

									<span class="mkdf-tour-reviews-star-holder"><span class="mkdf-tour-reviews-star <?php echo esc_attr($star_class); ?>"></span></span>
								<?php endfor; ?>
								</span>
							</div>
						</div>

						<div class="mkdf-tours-top-reviews-item-content">
							<?php comment_text($review->comment_ID); ?>
						</div>

						<div class="mkdf-tours-top-reviews-item-author-info">
							<span class="mkdf-tours-top-reviews-item-author-avatar">
								<?php echo get_avatar($review->comment_author_email, 54); ?>
							</span>
							<h5 class="mkdf-tours-top-reviews-item-author-name">
								<?php echo get_comment_author_link($review->comment_ID); ?>
							</h5>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</div>