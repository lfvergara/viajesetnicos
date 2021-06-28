<div class="<?php echo esc_attr($holder_class) ?>">
	<?php //echo mkdf_tours_get_tour_module_template_part('single/single-item-nav', 'tours', 'templates', '', $params); ?>
    <div class="mkdf-container" style="background-color: #282828;">
   		 <div class="mkdf-container-inner clearfix">
            <div class="mkdf-grid-medium-gutter">
                <div class="mkdf-grid-col-12">
                    <?php echo mkdf_tours_get_tour_module_template_part('single/single-item', 'tours', 'templates', '', $params); ?>
                </div>
                <!--
                <div class="mkdf-grid-col-3">
                    <aside class="mkdf-sidebar">
                        <div class="widget mkdf-tours-booking-form-holder">
                            <?php //if(mkdf_tours_is_tour_bookable()) : ?>
                                <?php //echo mkdf_tours_get_tour_module_template_part('single/booking-form', 'tours', 'templates', '', $params); ?>
                            <?php //endif; ?>
                        </div>

                        <?php //dynamic_sidebar('tour-single-sidebar'); ?>
                    </aside>
                </div>
                -->
            </div>
        </div>
    </div>
</div>