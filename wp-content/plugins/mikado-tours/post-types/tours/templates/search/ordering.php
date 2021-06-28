<div class="mkdf-search-ordering-holder">
	<div class="mkdf-search-ordering-items-holder">
		<ul class="mkdf-search-ordering-list">
			<?php foreach($ordering as $order_key => $order_value) : ?>
				<?php
				$is_active_order_item = $current_ordering === $order_value['order_by'] && $current_order_type == $order_value['order_type'];
				$active_class = $is_active_order_item ? 'mkdf-search-ordering-item-active' : '';
				?>
				<li class="mkdf-search-ordering-item <?php echo esc_attr($active_class); ?>" data-order-by="<?php echo esc_attr($order_value['order_by']); ?>" data-order-type="<?php echo esc_attr($order_value['order_type']) ?>">
					<a href="#">
						<i class="mkdf-search-ordering-icon <?php echo esc_attr($order_value['icon']); ?>"></i>
						<span class="mkdf-search-ordering-title"><?php echo esc_html($order_value['title']); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>