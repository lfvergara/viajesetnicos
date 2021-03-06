<?php
$title_array       = get_post_meta(get_the_ID(), 'mkdf_tour_plan_section_title', true);
$description_array = get_post_meta(get_the_ID(), 'mkdf_tour_plan_section_description', true);

if(is_array($title_array) && count($title_array) && is_array($description_array) && count($description_array)) {

    $max_items = count($title_array);

    for($i = 0; $i < $max_items; $i++) { ?>

        <div class="mkdf-info-section-part mkdf-tour-item-plan-part clearfix">
            <div class="mkdf-route-top-holder">
            	<div class="mkdf-route-id"><?php echo($i + 1); ?></div>
                <span class="mkdf-line-between-icons">
                    <span class="mkdf-line-between-icons-inner"></span>
                </span>
	            <h6 class="mkdf-tour-item-plan-part-title">
	                <?php echo esc_attr($title_array[$i]); ?>
	            </h6>
            </div>
            <div class="mkdf-tour-item-plan-part-description">
                <?php
                    echo do_shortcode($description_array[$i]);
                ?>
            </div>

        </div>

    <?php }

}