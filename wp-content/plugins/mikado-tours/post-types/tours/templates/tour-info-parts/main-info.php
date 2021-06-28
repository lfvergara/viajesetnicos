<?php $main_info_array = mkdf_tours_get_tour_info_table_data(get_the_ID()); ?>
<div class="mkdf-info-section-part mkdf-tour-item-main-info" style=" background-color: #FFF;">
    <ul class="mkdf-tour-main-info-holder clearfix">
        <?php
        if(count($main_info_array)) {
            foreach($main_info_array as $item) { ?>
                <?php if($item['value']) { ?>

                    <li class="clearfix <?php if(!empty($item['html_class'])) {
                        echo esc_attr($item['html_class']);
                    } ?>">
                        <h6 class="mkdf-info">
                            <?php echo esc_html($item['text']); ?>
                        </h6>
                        <div class="mkdf-value">
                            <?php if($item['value']) {
                                if(is_array($item['value']) && count($item['value'])) {
                                    foreach($item['value'] as $item) { ?>
                                        <div class="mkdf-tour-main-info-attr">
                                            <?php echo esc_html($item); ?>
                                        </div>
                                    <?php }
                                } else {
                                    echo wp_kses($item['value'], array(
	                                    'a' => array(
		                                    'href' => array(),
		                                    'target' => array(),
		                                    'title' => array()
	                                    )
                                    ));
                                }
                            }; ?>
                        </div>
                    </li>
                <?php }
            }
        }
        ?>
    </ul>
</div>
