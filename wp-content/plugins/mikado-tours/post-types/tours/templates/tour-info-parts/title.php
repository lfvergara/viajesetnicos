<?php
$title = get_the_title();
?>

<div class="mkdf-info-section-part mkdf-tour-item-title-holder">
	<?php if($title !== '') : ?>
		<h3 class="mkdf-tour-item-title" style="color: #FFF;">
			<?php echo esc_html($title) ?>
		</h3>
	<?php endif; ?>

	<!--
	<h5 class="mkdf-tour-item-price-holder">
	    <span class="mkdf-tour-item-price"><?php //esc_html_e('Desde ', 'mkdf-tours'); ?></span>
		<span class="mkdf-tour-item-price">
			<?php //echo mkdf_tours_get_tour_price_html(get_the_ID()); ?>
		</span>
	</h5>
	-->		
</div>
