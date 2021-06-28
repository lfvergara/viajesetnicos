<?php while($query->have_posts()) : 
	$query->the_post();
	$caller->getItemTemplate($tour_type, $item_params);
endwhile;
wp_reset_postdata(); ?>