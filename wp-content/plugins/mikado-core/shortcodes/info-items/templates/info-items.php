<div class="mkdf-info-items-holder">
	<?php if ($title !== '') { ?>
		<<?php echo esc_attr($title_tag);?> class="mkdf-info-title">
			<?php echo esc_html($title);?>
		</<?php echo esc_attr($title_tag);?>>
	<?php } ?>
    <?php foreach ($single_items as $single_item) { ?>
	    <div class="mkdf-info-item-row">
			<h6 class="mkdf-info-item-title">
				<?php if (isset($single_item['item_title'])) {
					echo esc_html($single_item['item_title']);
				} ?>
			</h6>
			<div class="mkdf-info-item-description">
				<?php if (isset($single_item['item_description'])) {
					echo esc_html($single_item['item_description']);
				} ?>
			</div>
	    </div>
    <?php } ?>
</div>