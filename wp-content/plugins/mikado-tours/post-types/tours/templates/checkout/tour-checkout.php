<?php get_header(); ?>
<?php roam_mikado_get_title(); ?>
<div class="mkdf-container">
	<div class="mkdf-container-inner clearfix">
		<div class="mkdf-tours-checkout-page-holder">
			<?php if(have_posts()) : while(have_posts()) :  the_post(); ?>
				<div class="mkdf-tours-checkout-page-content">
					<?php the_content(); ?>
				</div>

				<?php echo mkdf_tours_get_checkout_page_content(); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
