<?php
$image_gallery_val = get_post_meta(get_the_ID(), 'mkdf_tours_gallery_images', true);

if($image_gallery_val !== "") { ?>
    <div class="mkdf-tour-masonry-gallery-holder">
        <div class="mkdf-tour-masonry-gallery clearfix mkdf-tours-gallery-images-fixed">
	        <div class="mkdf-tour-grid-sizer"></div>
	        <div class="mkdf-tour-grid-gutter"></div>
            <?php
            if($image_gallery_val != '') {
                $image_gallery_array = explode(',', $image_gallery_val);
            }

            if(isset($image_gallery_array) && count($image_gallery_array) != 0) {
                foreach($image_gallery_array as $gimg_id) {
	                $image_size = get_post_meta($gimg_id, 'tours_gallery_masonry_image_size', true);
	                switch ($image_size) {
	                	case 'mkdf-default-masonry-item':
	                		$image_classs = 'mkdf-tgi-masonry-default';
	                		$image_size = 'roam_mikado_square';
	                		break;
	                	case 'mkdf-large-width-masonry-item':
	                		$image_classs = 'mkdf-tgi-masonry-large-width';
	                		$image_size = 'roam_mikado_landscape';
	                		break;
	                	case 'mkdf-large-height-masonry-item':
	                		$image_classs = 'mkdf-tgi-masonry-large-height';
	                		$image_size = 'roam_mikado_portrait';
	                		break;
	                	case 'mkdf-large-width-height-masonry-item':
	                		$image_classs = 'mkdf-tgi-masonry-large-width-height';
	                		$image_size = 'roam_mikado_huge';
	                		break;	                	
	                	default:
	                		$image_classs = 'mkdf-tgi-masonry-default';
	                		$image_size = 'roam_mikado_square';
	                		break;
	                }
                    // $image_classs = !empty($image_size) ? $image_size : 'mkdf-default-masonry-item';
                    ?>
                    <div class="mkdf-tour-gallery-item <?php echo esc_attr($image_classs); ?>">
	                    <div class="mkdf-tour-gallery-item-inner">
		                    <a href="<?php echo wp_get_attachment_url($gimg_id) ?>" data-rel="prettyPhoto[gallery_pretty_photo]">
			                    <?php echo wp_get_attachment_image($gimg_id, $image_size); ?>
		                    </a>
	                    </div>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>
<?php } ?>