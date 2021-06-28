<?php
extract($tour_sections);
?>

<div class="mkdf-single-tour-nav-holder">
	<div class="mkdf-grid">
		<ul class="mkdf-tour-tabs-nav clearfix">
		    <?php foreach($tour_sections as $section) {

		        if($section['value'] === 'yes') { ?>

		            <li class="mkdf-tour-nav-item">

		                <a href="<?php echo esc_attr($section['id']) ?>">

		                    <span class="mkdf-tour-nav-section-icon <?php echo esc_attr($section['icon']) ?>"></span>

							<span class="mkdf-tour-nav-section-title">
								<?php echo esc_html($section['title']) ?>
							</span>

		                </a>
		            </li>

		        <?php }

		    }; ?>
		</ul>
	</div>
</div>