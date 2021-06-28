<div class="mkdf-image-with-text-holder <?php echo esc_attr($holder_classes); ?>">
    <?php if (($image_behavior === 'lightbox') || ($image_behavior === 'custom_link')) { ?>
        <a class="mkdf-iwt-link" itemprop="image" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[iwt_pretty_photo]" title="<?php echo esc_attr($image['alt']); ?>"></a>
    <?php } else if ($image_behavior === 'custom-link' && !empty($custom_link)) { ?>
        <a class="mkdf-iwt-link" itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>"></a>
    <?php } ?>
    <div class="mkdf-iwt-image">
        <?php if(is_array($image_size) && count($image_size)) : ?>
            <?php echo roam_mikado_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
        <?php else: ?>
            <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
        <?php endif; ?>
    </div>
    <div class="mkdf-iwt-text-holder">
        <?php if(!empty($title)) { ?>
            <<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php echo roam_mikado_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        <?php } ?>
		<?php if(!empty($text)) { ?>
            <p class="mkdf-iwt-text" <?php echo roam_mikado_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
        <?php } ?>
    </div>
</div>