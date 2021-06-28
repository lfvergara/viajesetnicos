<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Mkdf_Item_Showcase extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'mkdf_core_add_item_showcase_shortcodes' ) ) {
	function mkdf_core_add_item_showcase_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\ItemShowcase\ItemShowcase',
			'MikadoCore\CPT\Shortcodes\ItemShowcase\ItemShowcaseItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'mkdf_core_filter_add_vc_shortcode', 'mkdf_core_add_item_showcase_shortcodes' );
}

if ( ! function_exists( 'mkdf_core_set_item_showcase_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for item showcase shortcode
	 */
	function mkdf_core_set_item_showcase_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.wpb_content_element.wpb_mkdf_item_showcase_item > .wpb_element_wrapper { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'mkdf_core_filter_add_vc_shortcodes_custom_style', 'mkdf_core_set_item_showcase_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'mkdf_core_set_item_showcase_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for item showcase shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_core_set_item_showcase_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-item-showcase';
		$shortcodes_icon_class_array[] = '.icon-wpb-item-showcase-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_core_set_item_showcase_icon_class_name_for_vc_shortcodes' );
}