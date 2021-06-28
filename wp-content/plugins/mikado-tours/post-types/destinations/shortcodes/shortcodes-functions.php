<?php

if ( ! function_exists( 'mkdf_tours_include_destinations_shortcodes' ) ) {
	function mkdf_tours_include_destinations_shortcodes() {
		include_once MIKADO_TOURS_CPT_PATH . '/destinations/shortcodes/destination-grid.php';
		include_once MIKADO_TOURS_CPT_PATH . '/destinations/shortcodes/destination-masonry-carousel.php';
	}
	
	add_action( 'mkdf_tours_action_include_shortcodes_file', 'mkdf_tours_include_destinations_shortcodes' );
}

if ( ! function_exists( 'mkdf_tours_add_destinations_shortcodes' ) ) {
	function mkdf_tours_add_destinations_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'MikadoTours\CPT\Destination\Shortcodes\DestinationGrid',
			'MikadoTours\CPT\Destination\Shortcodes\DestinationMasonryCarousel'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'mkdf_tours_filter_add_vc_shortcode', 'mkdf_tours_add_destinations_shortcodes' );
}

if ( ! function_exists( 'mkdf_tours_set_destinations_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for destinations shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_tours_set_destinations_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-destinations-grid';
		$shortcodes_icon_class_array[] = '.icon-wpb-destinations-masonry-carousel';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'mkdf_tours_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_tours_set_destinations_icon_class_name_for_vc_shortcodes' );
}