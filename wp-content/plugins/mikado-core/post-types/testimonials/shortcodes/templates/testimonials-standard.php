<div class="mkdf-testimonial-content" id="mkdf-testimonials-<?php echo esc_attr( $current_id ) ?>">
	<div class="mkdf-testimonial-text-holder">
		<?php if ( ! empty( $title ) ) { ?>
			<h3 itemprop="name" class="mkdf-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h3>
		<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
			<h5 class="mkdf-testimonial-text"><?php echo esc_html( $text ); ?></h5>
		<?php } ?>
		<?php if ( ! empty( $author ) ) { ?>
			<div class="mkdf-testimonial-author">
				<h4 class="mkdf-testimonials-author-name"><?php echo esc_html( $author ); ?>,</h4>
				<?php if ( ! empty( $position ) ) { ?>
					<span class="mkdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="mkdf-testimonial-image">
			<?php echo get_the_post_thumbnail( get_the_ID(), array( 66, 66 ) ); ?>
		</div>
	<?php } ?>
</div>