<?php

if (!function_exists('mkdf_tours_reviews_fields')) {
	function mkdf_tours_reviews_fields() {

		$tours_fields = roam_mikado_add_taxonomy_fields(
			array(
				'scope' => 'review-criteria',
				'name'  => 'review_criteria'
			)
		);

		roam_mikado_add_taxonomy_field(
			array(
				'name'        => 'criteria_order',
				'type'        => 'text',
				'label'       => esc_html__( 'Order', 'mkdf-tours' ),
				'description' => esc_html__('If there are multiple criteria, they will be displayed in an ascending order.', 'mkdf-tours'),
				'parent'      => $tours_fields
			)
		);

		roam_mikado_add_taxonomy_field(
			array(
				'name'        => 'main_criterion',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Show in Reviews', 'mkdf-tours' ),
				'description' => esc_html__('All the criteria can be rated when leaving a review, but only those marked to be shown will be displayed in the list of reviews.', 'mkdf-tours'),
				'options'	  => array(
					'no' => esc_html__('No','mkdf-tours'),
					'yes' => esc_html__('Yes','mkdf-tours'),
				),
				'parent'      => $tours_fields
			)
		);
	}
	add_action('roam_mikado_custom_taxonomy_fields', 'mkdf_tours_reviews_fields');
}

add_filter("manage_edit-review-criteria_columns", 'mkdf_tour_review_criteria_columns');
function mkdf_tour_review_criteria_columns($columns) {
	$new_columns = array(
		'cb'        => '<input type="checkbox" />',
		'name'      => esc_html__('Name', 'mkdf-tours'),
		'slug'      => esc_html__('Slug', 'mkdf-tours'),
		'criteria_order'      => esc_html__('Order', 'mkdf-tours'),
		'main_criterion' => esc_html__('Shown in Reviews', 'mkdf-tours'),
	);

	return $new_columns;
}

add_filter("manage_review-criteria_custom_column", 'mkdf_tour_review_criteria_column_values', 10, 3);
function mkdf_tour_review_criteria_column_values($out, $column_name, $term_id) {
	$term_meta = get_term_meta($term_id);
	switch($column_name) {
		case 'criteria_order':
			$out .= isset($term_meta['criteria_order'][0]) ? $term_meta['criteria_order'][0] : '-';
			break;
		case 'main_criterion':
			$out .= (isset($term_meta['main_criterion'][0]) && $term_meta['main_criterion'][0] == 'yes') ? esc_html__('Yes','mkdf-tours') : esc_html__('No','mkdf-tours');
			break;

		default:
			break;
	}

	return $out;
}
?>