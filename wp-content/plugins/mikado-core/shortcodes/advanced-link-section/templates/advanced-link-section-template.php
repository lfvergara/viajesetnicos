<div class="mkdf-advanced-link-section <?php echo esc_html($section_classes); ?>">
    <div class="mkdf-als-items-holder">
        <?php foreach ($link_items as $link_items) { ?>
            <?php if (!empty($link_items['link']) && !empty($link_items['link_text'])){ ?>
                <div class="mkdf-als-item" <?php echo roam_mikado_get_inline_style($link_items['style']); ?>>
	                <div class="mkdf-als-item-inner">
	                    <?php if (!empty($link_items['section_title'])){ ?>
	                        <h3 class="mkdf-als-item-link-title" <?php echo roam_mikado_get_inline_style($link_text_style);?>><?php echo esc_html($link_items['section_title']);?></h3>
	                    <?php } ?>
	                    <?php if (!empty($link_items['section_subtitle'])){ ?>
	                        <h5 class="mkdf-als-item-link-subtitle" <?php echo roam_mikado_get_inline_style($link_text_style);?>><?php echo esc_html($link_items['section_subtitle']);?></h5>
	                    <?php } ?>
	                    <?php if (!empty($link_items['link_text']) && !empty($link_items['link'])){ ?>
	                        <a class="mkdf-als-item-link mkdf-btn mkdf-btn-large mkdf-btn-solid" href="<?php echo esc_url($link_items['link'])?>" target="_self">
	                            <span class="mkdf-als-item-link-text" <?php echo roam_mikado_get_inline_style($link_text_style);?>><?php echo esc_html($link_items['link_text']);?></span>
	                        </a>
	                    <?php } ?>
	                    <?php if ($uncovering_effect == 'yes') { ?>
	                        <span class="mkdf-als-uncovering-element" <?php echo roam_mikado_get_inline_style($uncovering_style)?>></span>
	                    <?php } ?>
	                </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="mkdf-advanced-link-section-bgrnd" <?php echo roam_mikado_get_inline_style($section_style)?>></div>
</div>