<div class="mkdf-container">
	<div class="mkdf-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if(post_password_required()) {
				echo get_the_password_form();
			} else { ?>
				<div class="mkdf-team-single-holder">
					<div class="mkdf-grid-row">
						<div <?php echo roam_mikado_get_content_sidebar_class(); ?>>
							<div class="mkdf-team-single-outer">
								<?php
								//load team info
								mkdf_core_get_cpt_single_module_template_part('templates/single/parts/info', 'team', '', $params);
								?>
							</div>
						</div>
						<?php if($sidebar_layout !== 'no-sidebar') { ?>
							<div <?php echo roam_mikado_get_sidebar_holder_class(); ?>>
								<?php get_sidebar(); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		<?php endwhile;	endif; ?>
	</div>
</div>