<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkdf_Tours_Slider_With_Filter extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'mkdf_tours_include_tours_shortcodes' ) ) {
	function mkdf_tours_include_tours_shortcodes() {
		include_once MIKADO_TOURS_CPT_PATH . '/tours/shortcodes/top-reviews-carousel.php';
		include_once MIKADO_TOURS_CPT_PATH . '/tours/shortcodes/tour-type-list.php';
		include_once MIKADO_TOURS_CPT_PATH . '/tours/shortcodes/tours-carousel.php';
		include_once MIKADO_TOURS_CPT_PATH . '/tours/shortcodes/tours-filter.php';
		include_once MIKADO_TOURS_CPT_PATH . '/tours/shortcodes/tours-list.php';
	}
	
	add_action( 'mkdf_tours_action_include_shortcodes_file', 'mkdf_tours_include_tours_shortcodes' );
}

if ( ! function_exists( 'mkdf_tours_add_tours_shortcodes' ) ) {
	function mkdf_tours_add_tours_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'MikadoTours\CPT\Tours\Shortcodes\TopReviewsCarousel',
			'MikadoTours\CPT\Tours\Shortcodes\TourTypeList',
			'MikadoTours\CPT\Tours\Shortcodes\ToursCarousel',
			'MikadoTours\CPT\Tours\Shortcodes\ToursFilter',
			'MikadoTours\CPT\Tours\Shortcodes\ToursList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'mkdf_tours_filter_add_vc_shortcode', 'mkdf_tours_add_tours_shortcodes' );
}

if ( ! function_exists( 'mkdf_tours_set_tours_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for tours shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_tours_set_tours_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-top-reviews-carousel';
		$shortcodes_icon_class_array[] = '.icon-wpb-tour-type-list';
		$shortcodes_icon_class_array[] = '.icon-wpb-tours-carousel';
		$shortcodes_icon_class_array[] = '.icon-wpb-tours-filters';
		$shortcodes_icon_class_array[] = '.icon-wpb-tours-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'mkdf_tours_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_tours_set_tours_icon_class_name_for_vc_shortcodes' );
}