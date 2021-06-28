<div class="mkdf-gallery-blocks-holder mkdf-disable-bottom-space <?php echo esc_attr($holder_classes); ?>">
    <?php
        $rand = rand(0,1000);
        $i = 1;
    ?>
    <div class="mkdf-gb-images mkdf-outer-space">
        <?php foreach ($images as $image) { ?>
	        <?php if($i === 1 && $featured_image_size !== 'no-image') { ?>
	            <div class="mkdf-gb-image mkdf-gb-featured-image mkdf-item-space">
            <?php } else { ?>
                <div class="mkdf-gb-image mkdf-item-space">
            <?php } ?>
	                <?php if ($enable_lightbox) { ?>
	                    <a itemprop="image" href="<?php echo esc_url($image['url'])?>" data-rel="prettyPhoto[gallery_blocks_pp-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['alt']); ?>">
                    <?php } ?>
	                        <?php
		                        if($i === 1 && $featured_image_size !== 'no-image') {
		                            if(is_array($featured_image_size) && count($featured_image_size)) {
		                                echo roam_mikado_generate_thumbnail($image['id'], null, $featured_image_size[0], $featured_image_size[1]);
		                            } else {
		                                echo wp_get_attachment_image($image['id'], $featured_image_size);
		                            }
		                        } else {
		                            if(is_array($image_size) && count($image_size)) {
		                                echo roam_mikado_generate_thumbnail($image['id'], null, $image_size[0], $image_size[1]);
		                            } else {
		                                echo wp_get_attachment_image($image['id'], $image_size);
		                            }
		                        }
		                        $i++;
	                        ?>
                    <?php if ($enable_lightbox) { ?>
	                    </a>
	                <?php } ?>
                </div>
        <?php } ?>
    </div>
</div>