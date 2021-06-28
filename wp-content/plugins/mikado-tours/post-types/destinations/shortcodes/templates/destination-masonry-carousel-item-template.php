<?php
/*open mkdf-tdm-item-holder for all items other then 2,5,8 etc for carousel */

if ($index%3 !== 2) { ?>
	<div class="mkdf-tdm-item-holder">
<?php } ?>
	<div <?php post_class($additional_classes); ?>>
		<div class="mkdf-tours-destination-item-holder mkdf-tours-row-item">
			<a class="mkdf-tdc-item-link" href="<?php the_permalink() ?>">
				<div class="mkdf-tours-destination-item-image">
					<?php the_post_thumbnail('thumbnail'); ?>
				</div>
				<div class="mkdf-tdc-item-background" <?php mkdf_tours_inline_style($style);?>></div>
				<div class="mkdf-tours-destination-item-content">
					<div class="mkdf-tours-destination-item-content-table">
						<div class="mkdf-tours-destination-item-content-table-cell">
							<<?php echo esc_attr($title_tag);?> class="mkdf-tours-destination-item-title">
								<?php the_title(); ?>
							</<?php echo esc_attr($title_tag);?>>
							<?php if (mkdf_tours_get_destinations_description()) { ?>
								<h5 class="mkdf-tours-destination-desc"><?php echo mkdf_tours_get_destinations_description();?></h5>
							<?php } ?>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
<?php
/*close mkdf-tdm-item-holder for all items other then 1,4,7 etc for carousel (to enable wrapping of small elements into one)*/
if ($index%3 !== 1 ) { ?>
	</div>
<?php } ?>