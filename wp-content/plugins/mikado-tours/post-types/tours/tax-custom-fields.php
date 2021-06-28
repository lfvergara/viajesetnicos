<?php

if (!function_exists('mkdf_tours_tours_category_fields')) {
	function mkdf_tours_tours_category_fields() {

		$tours_category_fields = roam_mikado_add_taxonomy_fields(
			array(
				'scope' => 'tour-category',
				'name'  => 'tour_category'
			)
		);

		roam_mikado_add_taxonomy_field(
			array(
				'name'        => 'tours_category_icon',
				'type'        => 'icon',
				'label'       => esc_html__( 'Choose Icon', 'mkdf-tours' ),
				'description' => esc_html__('Choose icon from icon pack for category.', 'mkdf-tours'),
				'parent'      => $tours_category_fields
			)
		);

		roam_mikado_add_taxonomy_field(
			array(
				'name'        => 'tours_category_custom_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Custom Image', 'mkdf-tours' ),
				'description' => esc_html__('Choose custom image for category.', 'mkdf-tours'),
				'parent'      => $tours_category_fields
			)
		);
	}
	add_action('roam_mikado_custom_taxonomy_fields', 'mkdf_tours_tours_category_fields');
}
?>