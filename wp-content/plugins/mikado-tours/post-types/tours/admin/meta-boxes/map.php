<?php

if(!function_exists('mkdf_tours_title_area_section_map')) {

	function mkdf_tours_title_area_section_map() {

		$single_section_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Single Tour Title', 'mkdf-tours'),
				'name'  => 'tours_single_section_meta'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_enable_full_screen_title_area_meta',
				'type'          => 'select',
				'label'         => esc_html__('Enable Full Screen Title Area', 'mkdf-tours'),
				'description'   => esc_html__('This option will enable/disable full screen title area', 'mkdf-tours'),
				'parent'        => $single_section_meta_box,
				'options'		=> array(
					''		=> '',
					'no'	=> esc_html__('No','mkdf-tours'),
					'yes'	=> esc_html__('Yes','mkdf-tours'),
				),
				'args'			=> array(
					'dependence' => true,
					'show' => array(
						'' => '',
						'no' => '',
						'yes' => '#mkdf_show_title_full_width_meta_container',
					),
					'hide' => array(
						'' => '#mkdf_show_title_full_width_meta_container',
						'no' => '#mkdf_show_title_full_width_meta_container',
						'yes' => '',
					)
				)
			)
		);

		$show_title_full_width_meta_container = roam_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'show_title_full_width_meta_container',
				'parent'          => $single_section_meta_box,
				'hidden_property' => 'mkdf_tours_enable_full_screen_title_area_meta',
				'hidden_values'   => array('','no')
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_title_skin_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__('Title Area Skin', 'mkdf-tours'),
				'description'   => esc_html__('Choose title area skin', 'mkdf-tours'),
				'parent'        => $show_title_full_width_meta_container,
				'options'       => array(
					'' => esc_html__('Default', 'mkdf-tours'),
					'dark' => esc_html__('Dark', 'mkdf-tours'),
					'light' => esc_html__('Light', 'mkdf-tours'),
				)
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_enable_custom_separator_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__('Enable Custom Separator on Title Area', 'mkdf-tours'),
				'description'   => esc_html__('This option will enable/disable custom separator on title area', 'mkdf-tours'),
				'parent'        => $show_title_full_width_meta_container,
				'options'		=> array(
					''		=> '',
					'no'	=> esc_html__('No','mkdf-tours'),
					'yes'	=> esc_html__('Yes','mkdf-tours'),
				)
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_title_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__('Backgorund Image for Title Area', 'mkdf-tours'),
				'description'   => esc_html__('If not set, featured image will be used for background on title area', 'mkdf-tours'),
				'parent'        => $show_title_full_width_meta_container,
			)
		);


	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_title_area_section_map');
}

if(!function_exists('mkdf_tours_info_section_map')) {

	function mkdf_tours_info_section_map() {
		$destinations = mkdf_tours_get_destinations(true);

		$info_section_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Info Section', 'mkdf-tours'),
				'name'  => 'tours_info_section_meta'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_info_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Info Section', 'mkdf-tours'),
				'parent'        => $info_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_info_section_container',
				)
			)
		);

		$info_section_container = roam_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'info_section_container',
			'parent'          => $info_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_info_section',
			'hidden_value'    => 'no'
		));

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_price',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Price', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_discount_price',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Discount Price', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_duration',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Duration', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_destination',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__('Destination', 'mkdf-tours'),
				'options'       => $destinations,
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_label',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Custom Label', 'mkdf-tours'),
				'description'   => esc_html__('Define custom label which will show on tour lists and tour single pages', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_info_min_years',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Minimum Years Required', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_departure',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Departure/Return Location', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_departure_time',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Departure Time', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_return_time',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Return Time', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_dress_code',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Dress Code', 'mkdf-tours'),
				'parent'        => $info_section_container
			)
		);
	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_info_section_map');
}

if(!function_exists('mkdf_tours_tour_plan_section_map')) {

	function mkdf_tours_tour_plan_section_map() {

		$tour_plan_section_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Tour Plan', 'mkdf-tours'),
				'name'  => 'tours_plan_section_meta'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_tour_plan_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Tour Plan Section', 'mkdf-tours'),
				'parent'        => $tour_plan_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_tour_plan_section_container',
				)
			)
		);

		$tour_plan_section_container = roam_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'tour_plan_section_container',
			'parent'          => $tour_plan_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_tour_plan_section',
			'hidden_value'    => 'no'
		));

		roam_mikado_add_repeater_field(array(
				'name'        => 'mkdf_tour_plan_repeater',
				'parent'      => $tour_plan_section_container,
				'button_text' => esc_html__('Add new Tour Plan Section', 'mkdf-tours'),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'mkdf_tour_plan_section_title',
						'label'       => esc_html__('Tour Plan Section Title', 'mkdf-tours'),
						'description' => esc_html__('Description', 'mkdf-tours')
					),
					array(
						'type'        => 'textareahtml',
						'name'        => 'mkdf_tour_plan_section_description',
						'label'       => esc_html__('Tour Plan Section Description', 'mkdf-tours'),
						'description' => esc_html__('Description field', 'mkdf-tours')
					)
				)
			)
		);
	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_tour_plan_section_map');
}

if(!function_exists('mkdf_tours_location_section_map')) {

	function mkdf_tours_location_section_map() {

		$location_section_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Location Section', 'mkdf-tours'),
				'name'  => 'location_section_meta'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_location_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Location Section', 'mkdf-tours'),
				'parent'        => $location_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_location_section_container',
				)
			)
		);

		$location_section_container = roam_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'location_section_container',
			'parent'          => $location_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_location_section',
			'hidden_value'    => 'no'
		));

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_excerpt',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Location Excerpt', 'mkdf-tours'),
				'parent'        => $location_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address1',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 1', 'mkdf-tours'),
				'parent'        => $location_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address2',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 2', 'mkdf-tours'),
				'parent'        => $location_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address3',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 3', 'mkdf-tours'),
				'parent'        => $location_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address4',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 4', 'mkdf-tours'),
				'parent'        => $location_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_address5',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Address 5', 'mkdf-tours'),
				'parent'        => $location_section_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_location_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => esc_html__('Location Content', 'mkdf-tours'),
				'parent'        => $location_section_container
			)
		);
	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_location_section_map');
}

if(!function_exists('mkdf_tours_gallery_section_map')) {

	function mkdf_tours_gallery_section_map() {

		$gallery_section_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Gallery Section', 'mkdf-tours'),
				'name'  => 'gallery_section_meta'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_gallery_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Gallery Section', 'mkdf-tours'),
				'parent'        => $gallery_section_meta_box,
				'default_value' => 'yes',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_gallery_section_container',
				)
			)
		);

		$gallery_section_container = roam_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'gallery_section_container',
			'parent'          => $gallery_section_meta_box,
			'hidden_property' => 'mkdf_tours_show_gallery_section',
			'hidden_value'    => 'no'
		));

        roam_mikado_add_meta_box_field(
            array(
                'name'          => 'mkdf_tours_gallery_subtitle',
                'type'          => 'text',
                'default_value' => '',
                'label'         => esc_html__('Subtitle', 'mkdf-tours'),
                'parent'        => $gallery_section_container
            )
        );

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_gallery_excerpt',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Excerpt', 'mkdf-tours'),
				'parent'        => $gallery_section_container
			)
		);

		roam_mikado_add_multiple_images_field(
			array(
				'parent'      => $gallery_section_container,
				'name'        => 'mkdf_tours_gallery_images',
				'label'       => esc_html__('Gallery Images', 'mkdf-tours'),
				'description' => esc_html__('Choose your gallery images', 'mkdf-tours')
			)
		);
	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_gallery_section_map');
}

if(!function_exists('mkdf_tours_review_section_map')) {

	function mkdf_tours_review_section_map() {

		$review_section_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Review Section', 'mkdf-tours'),
				'name'  => 'review_section_meta'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_review_section',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Review Section', 'mkdf-tours'),
				'parent'        => $review_section_meta_box,
				'default_value' => 'yes'
			)
		);
	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_review_section_map');
}

if(!function_exists('mkdf_tours_custom_section_1_map')) {

	function mkdf_tours_custom_section_1_map() {

		$custom_section_1_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Custom Section 1', 'mkdf-tours'),
				'name'  => 'custom_section_1_meta'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_custom_section_1',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Custom Section 1', 'mkdf-tours'),
				'parent'        => $custom_section_1_meta_box,
				'default_value' => 'no',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_custom_section_1_container',
				)
			)
		);

		$custom_section_1_container = roam_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'custom_section_1_container',
			'parent'          => $custom_section_1_meta_box,
			'hidden_property' => 'mkdf_tours_show_custom_section_1',
			'hidden_value'    => 'no'
		));

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section1_title',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Title', 'mkdf-tours'),
				'parent'        => $custom_section_1_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section1_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => esc_html__('Content', 'mkdf-tours'),
				'parent'        => $custom_section_1_container
			)
		);
	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_custom_section_1_map');
}

if(!function_exists('mkdf_tours_custom_section_2_map')) {

	function mkdf_tours_custom_section_2_map() {

		$custom_section_2_meta_box = roam_mikado_add_meta_box(
			array(
				'scope' => array('tour-item'),
				'title' => esc_html__('Custom Section 2', 'mkdf-tours'),
				'name'  => 'custom_section_2_meta'
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_show_custom_section_2',
				'type'          => 'yesno',
				'label'         => esc_html__('Show Custom Section 2', 'mkdf-tours'),
				'parent'        => $custom_section_2_meta_box,
				'default_value' => 'no',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_custom_section_2_container',
				)
			)
		);

		$custom_section_2_container = roam_mikado_add_admin_container_no_style(array(
			'type'            => 'container',
			'name'            => 'custom_section_2_container',
			'parent'          => $custom_section_2_meta_box,
			'hidden_property' => 'mkdf_tours_show_custom_section_2',
			'hidden_value'    => 'no'
		));

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section2_title',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__('Title', 'mkdf-tours'),
				'parent'        => $custom_section_2_container
			)
		);

		roam_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_tours_custom_section2_content',
				'type'          => 'textareahtml',
				'default_value' => '',
				'label'         => esc_html__('Content', 'mkdf-tours'),
				'parent'        => $custom_section_2_container
			)
		);
	}

	add_action('roam_mikado_meta_boxes_map', 'mkdf_tours_custom_section_2_map');
}