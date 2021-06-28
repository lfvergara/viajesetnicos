<?php
if(!function_exists('mkdf_tours_destination_map')) {

	function mkdf_tours_destination_map() {

		$destination_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('destinations'),
				'title' => esc_html__('Destination', 'mkdf-tours'),
				'name'  => 'destination_meta_box'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_destination_short_desc',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Short Description', 'mkdf-tours'),
				'parent'        => $destination_meta_box
			)
		);

	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_destination_map');
}