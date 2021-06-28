<?php

if ( ! function_exists( 'mkdf_tours_tour_item_meta_box_functions' ) ) {
	function mkdf_tours_tour_item_meta_box_functions( $post_types ) {
		$post_types[] = 'tour-item';
		
		return $post_types;
	}
	
	add_filter( 'roam_mikado_meta_box_post_types_save', 'mkdf_tours_tour_item_meta_box_functions' );
	add_filter( 'roam_mikado_meta_box_post_types_remove', 'mkdf_tours_tour_item_meta_box_functions' );
}

if ( ! function_exists( 'mkdf_tours_tour_item_scope_meta_box_functions' ) ) {
	function mkdf_tours_tour_item_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'tour-item';
		
		return $post_types;
	}
	
	add_filter( 'roam_mikado_set_scope_for_meta_boxes', 'mkdf_tours_tour_item_scope_meta_box_functions' );
}

if ( ! function_exists( 'mkdf_tours_tour_item_enqueue_meta_box_styles' ) ) {
	function mkdf_tours_tour_item_enqueue_meta_box_styles() {
		global $post;
		
		if ( $post->post_type == 'tour-item' ) {
			wp_enqueue_style( 'mkdf-jquery-ui', get_template_directory_uri() . '/framework/admin/assets/css/jquery-ui/jquery-ui.css' );
		}
	}
	
	add_action( 'roam_mikado_enqueue_meta_box_styles', 'mkdf_tours_tour_item_enqueue_meta_box_styles' );
}

if ( ! function_exists( 'mkdf_tours_register_tour_item_cpt' ) ) {
	function mkdf_tours_register_tour_item_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'MikadoTours\CPT\Tours\ToursRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'mkdf_tours_filter_register_custom_post_types', 'mkdf_tours_register_tour_item_cpt' );
}

if ( ! function_exists( 'mkdf_tours_add_tour_item_to_search_types' ) ) {
	function mkdf_tours_add_tour_item_to_search_types( $post_types ) {
		$post_types['tour-item'] = esc_html__('Tour Item','mkdf-tours');
		
		return $post_types;
	}
	
	add_filter( 'roam_mikado_search_post_type_widget_params_post_type', 'mkdf_tours_add_tour_item_to_search_types' );
}

if(!function_exists('mkdf_tours_get_tours_categories')) {
	/**
	 * Get Tour Categories
	 * @return array
	 */
	function mkdf_tours_get_tours_categories() {
		$tour_categories = array();
		
		$cats = get_terms(array(
			'taxonomy' => 'tour-category'
		));
		
		foreach($cats as $cat) {
			$tour_categories[$cat->slug] = $cat->name;
		}

		return $tour_categories;
	}
}

if(!function_exists('mkdf_tours_get_tours_categories_vc')) {
	/**
	 * Function that returns array of tours categories formatted for Visual Composer
	 *
	 * @return array array of tours categories where key is term title and value is term slug
	 *
	 * @see mkdf_tours_get_tours_categories
	 */

	function mkdf_tours_get_tours_categories_vc() {

		return array_flip(mkdf_tours_get_tours_categories());
	}
}

if(!function_exists('mkdf_tours_get_tour_attributes')) {
	/**
	 * Return Tour Attribute Custom Post Type associative array where key is post id and value is post title.
	 *
	 * return array
	 */
	function mkdf_tours_get_tour_attributes() {
		$tour_attributes = array();
		
		$terms = get_terms(array(
			'taxonomy' => 'tour-attribute',
			'hide_empty' => false,
			)
		);

		foreach($terms as $term) {
			$tour_attributes[$term->slug] = $term->name;
		}

		return $tour_attributes;
	}
}

if(!function_exists('mkdf_tours_get_single_tour_item')) {
	/**
	 * Loads single tour-item template
	 *
	 */
	function mkdf_tours_get_single_tour_item() {
		$params = array(
			'holder_class'  => 'mkdf-tour-item-single-holder',
			'tour_sections' => mkdf_tours_check_tour_sections()
		);

		echo mkdf_tours_get_tour_module_template_part('single/holder', 'tours', 'templates', '', $params);
	}
}

if(!function_exists('mkdf_tours_get_tour_info_part')) {
	/**
	 * @param $part
	 *
	 * @return bool
	 */
	function mkdf_tours_get_tour_info_part($part) {
		if(empty($part)) {
			return false;
		}

		echo mkdf_tours_get_tour_module_template_part($part, 'tours', 'templates', '', array());
	}
}

if(!function_exists('mkdf_tours_check_tour_sections')) {
	/**
	 * check if tour item sections are enabled
	 *
	 */
	function mkdf_tours_check_tour_sections() {

		$sections_array = array(
			'mkdf_tours_show_info_section',
			'mkdf_tours_show_tour_plan_section',
			'mkdf_tours_show_location_section',
			'mkdf_tours_show_gallery_section',
			'mkdf_tours_show_review_section',
			'mkdf_tours_show_custom_section_1',
			'mkdf_tours_show_custom_section_2',
		);
		$return_array   = array();

		foreach($sections_array as $section) {
			$section_key                         = str_replace('mkdf_tours_', '', $section);
			$return_array[$section_key]['value'] = get_post_meta(get_the_ID(), $section, true);

			switch($section_key) {
				case 'show_info_section' :
					$return_array[$section_key]['icon']  = 'dripicons-suitcase';
					$return_array[$section_key]['title'] = esc_html__('El viaje','mkdf-tours');
					$return_array[$section_key]['id']    = 'tour-item-info-id';
					break;
				case 'show_tour_plan_section' :
					$return_array[$section_key]['icon']  = 'dripicons-view-list';
					$return_array[$section_key]['title'] = esc_html__('Detalles','mkdf-tours');
					$return_array[$section_key]['id']    = 'tour-item-plan-id';
					break;
				case 'show_location_section' :
					$return_array[$section_key]['icon']  = 'dripicons-map';
					$return_array[$section_key]['title'] = esc_html__('Itinerario','mkdf-tours');
					$return_array[$section_key]['id']    = 'tour-item-location-id';
					break;
				case 'show_gallery_section' :
					$return_array[$section_key]['icon']  = 'dripicons-document';
					$return_array[$section_key]['title'] = esc_html__('Galería','mkdf-tours');
					$return_array[$section_key]['id']    = 'tour-item-gallery-id';
					break;
				case 'show_review_section' :
					$return_array[$section_key]['icon']  = 'dripicons-user-group';
					$return_array[$section_key]['title'] = esc_html__('Comentarios','mkdf-tours');
					$return_array[$section_key]['id']    = 'tour-item-review-id';
					break;
				case 'show_custom_section_1' :

					$custom_section1_title = (get_post_meta(get_the_ID(), 'mkdf_tours_custom_section1_title', true) != '') ? get_post_meta(get_the_ID(), 'mkdf_tours_custom_section1_title', true) : esc_html__('A tener en cuenta', 'mkdf-tours');
					$return_array[$section_key]['icon']  = 'dripicons-clipboard';
					$return_array[$section_key]['title'] = $custom_section1_title;
					$return_array[$section_key]['id']    = 'tour-item-custom1-id';
					break;
				case 'show_custom_section_2' :
					$custom_section2_title = (get_post_meta(get_the_ID(), 'mkdf_tours_custom_section2_title', true) != '') ? get_post_meta(get_the_ID(), 'mkdf_tours_custom_section2_title', true) : esc_html__('PDF', 'mkdf-tours');
					$return_array[$section_key]['icon']  = 'dripicons-document-edit';
					$return_array[$section_key]['title'] =  $custom_section2_title;
					$return_array[$section_key]['id']    = 'tour-item-custom2-id';
					break;
			}
		}

		return $return_array;
	}
}


if ( ! function_exists( 'mkdf_tours_add_image_gallery_attachment_custom_field' ) ) {
	function mkdf_tours_add_image_gallery_attachment_custom_field( $form_fields, $post = null ) {
		if ( wp_attachment_is_image( $post->ID ) ) {
			$field_value = get_post_meta( $post->ID, 'tours_gallery_masonry_image_size', true );
			
			$form_fields['tours_gallery_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'mkdf-tours' ),
				'helps' => esc_html__( 'Choose image size for Tours Single Gallery', 'mkdf-tours' )
			);
			
			$form_fields['tours_gallery_masonry_image_size']['html'] = "<select name='attachments[{$post->ID}][tours_gallery_masonry_image_size]'>";
			$form_fields['tours_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-default-masonry-item', false ) . ' value="mkdf-default-masonry-item">' . esc_html__( 'Default Size', 'mkdf-tours' ) . '</option>';
			$form_fields['tours_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-large-width-masonry-item', false ) . ' value="mkdf-large-width-masonry-item">' . esc_html__( 'Large Width', 'mkdf-tours' ) . '</option>';
			$form_fields['tours_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-large-height-masonry-item', false ) . ' value="mkdf-large-height-masonry-item">' . esc_html__( 'Large Height', 'mkdf-tours' ) . '</option>';
			$form_fields['tours_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'mkdf-large-width-height-masonry-item', false ) . ' value="mkdf-large-width-height-masonry-item">' . esc_html__( 'Large Width and Height', 'mkdf-tours' ) . '</option>';
			$form_fields['tours_gallery_masonry_image_size']['html'] .= '</select>';
		}
		
		return $form_fields;
	}
	
	add_filter( 'attachment_fields_to_edit', 'mkdf_tours_add_image_gallery_attachment_custom_field', 15, 2 );
}

if ( ! function_exists( 'mkdf_tours_save_image_gallery_attachment_fields' ) ) {
	/**
	 * @param array $post
	 * @param array $attachment
	 *
	 * @return array
	 */
	function mkdf_tours_save_image_gallery_attachment_fields( $post, $attachment ) {
		
		if ( isset( $attachment['tours_gallery_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'tours_gallery_masonry_image_size', $attachment['tours_gallery_masonry_image_size'] );
		}
		
		return $post;
	}
	
	add_filter( 'attachment_fields_to_save', 'mkdf_tours_save_image_gallery_attachment_fields', 15, 2 );
}