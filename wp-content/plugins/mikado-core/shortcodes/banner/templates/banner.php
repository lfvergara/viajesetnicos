<div class="mkdf-banner-holder <?php echo esc_attr($holder_classes); ?>">
    <?php foreach ($single_banner as $single_banner_item) { ?>
    <div class="mkdf-single-banner-holder">
        <div class="mkdf-banner-image">
            <?php echo wp_get_attachment_image($single_banner_item['image'], 'full'); ?>
        </div>
        <div class="mkdf-banner-text-holder">
            <div class="mkdf-banner-text-outer">
                <div class="mkdf-banner-text-inner">
                    <?php if(!empty($single_banner_item['hover_image'] )) { ?>
                    <div class="mkdf-banner-text-inner-image">
                        <?php echo wp_get_attachment_image($single_banner_item['hover_image'], 'full'); ?>
                    </div>
                    <?php } else { ?>
                        <?php if(!empty($single_banner_item['subtitle'])) { ?>
                            <h5 class="mkdf-banner-subtitle" <?php echo roam_mikado_get_inline_style($single_banner_item['subtitle_color']); ?>>
                                <?php echo esc_html($single_banner_item['subtitle']); ?>
                            </h5>
                        <?php } ?>
                        <?php if(!empty($single_banner_item['title'])) { ?>
                            <h3 class="mkdf-banner-title" <?php echo roam_mikado_get_inline_style($single_banner_item['title_color']); ?>>
                                <?php echo wp_kses($single_banner_item['title'], array('span' => array('class' => true))); ?>
                            </h3>
                        <?php } ?>
                        <?php if(!empty($single_banner_item['link']) && !empty($single_banner_item['link_text'])) { ?>
                            <a itemprop="url" href="<?php echo esc_url($single_banner_item['link']); ?>" target="<?php echo esc_attr($single_banner_item['target']); ?>" class="mkdf-banner-link-text" <?php echo roam_mikado_get_inline_style($link_styles); ?>>
                                <span class="mkdf-banner-link-original">
                                    <span class="mkdf-banner-link-icon ion-arrow-right-c"></span>
                                    <span class="mkdf-banner-link-label"><?php echo esc_html($single_banner_item['link_text']); ?></span>
                                </span>
                                <span class="mkdf-banner-link-hover">
                                    <span class="mkdf-banner-link-icon ion-arrow-right-c"></span>
                                    <span class="mkdf-banner-link-label"><?php echo esc_html($single_banner_item['link_text']); ?></span>
                                </span>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if (!empty($single_banner_item['link'])) { ?>
            <a itemprop="url" class="mkdf-banner-link" href="<?php echo esc_url($single_banner_item['link']); ?>" target="<?php echo esc_attr($single_banner_item['target']); ?>"></a>
        <?php } ?>
    </div>
    <?php } ?>
</div>