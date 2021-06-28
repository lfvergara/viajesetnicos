<div class="mkdf-team mkdf-item-space <?php echo esc_attr($team_member_layout) ?>">
	<div class="mkdf-team-inner">
		<?php if (get_the_post_thumbnail($member_id) !== '') { ?>
			<div class="mkdf-team-image">
                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>">
                    <?php echo get_the_post_thumbnail($member_id, 'full'); ?>
                </a>
			</div>
		<?php } ?>
		<div class="mkdf-team-info">
            <div class="mkdf-team-title-holder">
                <h4 itemprop="name" class="mkdf-team-name entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                </h4>

                <?php if (!empty($position) && ($show_position == 'yes')) { ?>
                    <h6 class="mkdf-team-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
			<?php if (!empty($excerpt)) { ?>
				<div class="mkdf-team-text">
					<div class="mkdf-team-text-inner">
						<div class="mkdf-team-description">
							<p itemprop="description" class="mkdf-team-excerpt"><?php echo esc_html($excerpt); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="mkdf-team-social-holder-between">
				<div class="mkdf-team-social">
					<div class="mkdf-team-social-inner">
						<div class="mkdf-team-social-wrapp">
							<?php foreach ($team_social_icons as $team_social_icon) {
								echo wp_kses_post($team_social_icon);
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>