<div class="mkdf-team-single-info-holder">
	<div class="mkdf-grid-row">
		<div class="mkdf-ts-image-holder mkdf-grid-col-6">
			<?php the_post_thumbnail(); ?>
		</div>
		<div class="mkdf-ts-details-holder mkdf-grid-col-6">
			<h3 itemprop="name" class="mkdf-name entry-title"><?php the_title(); ?></h3>
			<p class="mkdf-position"><?php echo esc_html($position); ?></p>
			<div class="mkdf-ts-bio-holder">
                <?php
				//load content
				mkdf_core_get_cpt_single_module_template_part('templates/single/parts/content', 'team', '', $params);
                ?>
                <?php if(!empty($birth_date)) { ?>
                    <div class="mkdf-ts-info-row">
                        <span aria-hidden="true" class="icon_calendar mkdf-ts-bio-icon"></span>
                        <span class="mkdf-ts-bio-info"><span class="mkdf-ts-bio-info-title"><?php echo esc_html__('Born on: ', 'mkdf-core')?></span><?php echo esc_html($birth_date); ?></span>
                    </div>
                <?php } ?>
                <?php if(!empty($email)) { ?>
                    <div class="mkdf-ts-info-row">
                        <span aria-hidden="true" class="icon_mail_alt mkdf-ts-bio-icon"></span>
                        <span itemprop="email" class="mkdf-ts-bio-info"><span class="mkdf-ts-bio-info-title"><?php echo esc_html__('Email: ', 'mkdf-core')?></span><?php echo sanitize_email(esc_html($email)); ?></span>
                    </div>
                <?php } ?>
                <?php if(!empty($phone)) { ?>
                    <div class="mkdf-ts-info-row">
                        <span aria-hidden="true" class="icon_phone mkdf-ts-bio-icon"></span>
                        <span class="mkdf-ts-bio-info"><span class="mkdf-ts-bio-info-title"><?php echo esc_html__('Phone: ', 'mkdf-core')?></span><?php echo esc_html($phone); ?></span>
                    </div>
                <?php } ?>
                <?php if(!empty($address)) { ?>
                    <div class="mkdf-ts-info-row">
                        <span aria-hidden="true" class="icon_building_alt mkdf-ts-bio-icon"></span>
                        <span class="mkdf-ts-bio-info"><span class="mkdf-ts-bio-info-title"><?php echo esc_html__('Residencia: ', 'mkdf-core')?></span><?php echo esc_html($address); ?></span>
                    </div>
                <?php } ?>
                <?php if(!empty($education)) { ?>
                    <div class="mkdf-ts-info-row">
                        <span aria-hidden="true" class="icon_ribbon_alt mkdf-ts-bio-icon"></span>
                        <span class="mkdf-ts-bio-info"><span class="mkdf-ts-bio-info-title"><?php echo esc_html__('Education: ', 'mkdf-core')?></span><?php echo esc_html($education); ?></span>
                    </div>
                <?php } ?>
                <?php if(!empty($resume)) { ?>
                    <div class="mkdf-ts-info-row">
                        <span aria-hidden="true" class="icon_document_alt mkdf-ts-bio-icon"></span>
                        <a href="<?php echo esc_url($resume); ?>" download target="_blank"><span class="mkdf-ts-bio-info"><?php echo esc_html__('Download Resume', 'mkdf-core'); ?></span></a>
                    </div>
                <?php } ?>
			</div>
            <div class="mkdf-team-social">
                <?php foreach ($social_icons as $social_icon) {
                    echo wp_kses_post($social_icon);
                } ?>
            </div>
		</div>
	</div>
</div>