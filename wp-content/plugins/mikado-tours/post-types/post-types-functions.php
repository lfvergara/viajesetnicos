<?php

if(!function_exists('mkdf_tours_include_custom_post_types_files')) {
	/**
	 * Loads all custom post types by going through all folders that are placed directly in post types folder
	 */
	function mkdf_tours_include_custom_post_types_files() {
		if(mkdf_tours_theme_installed()) {
			foreach (glob(MIKADO_TOURS_CPT_PATH . '/*/load.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action('after_setup_theme', 'mkdf_tours_include_custom_post_types_files', 1);
}

if(!function_exists('mkdf_tours_include_custom_post_types_meta_boxes')) {
	/**
	 * Loads all meta boxes functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function mkdf_tours_include_custom_post_types_meta_boxes() {
		if(mkdf_tours_theme_installed()) {
			foreach(glob(MIKADO_TOURS_CPT_PATH . '/*/admin/meta-boxes/*.php') as $meta_boxes_map) {
				include_once $meta_boxes_map;
			}
		}
	}
	
	add_action('roam_mikado_before_meta_boxes_map', 'mkdf_tours_include_custom_post_types_meta_boxes');
}

if(!function_exists('mkdf_tours_include_custom_post_types_global_options')) {
	/**
	 * Loads all global otpions functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function mkdf_tours_include_custom_post_types_global_options() {
		if(mkdf_tours_theme_installed()) {
			foreach(glob(MIKADO_TOURS_CPT_PATH . '/*/admin/options/*.php') as $global_options) {
				include_once $global_options;
			}
		}
	}
	
	add_action('roam_mikado_before_options_map', 'mkdf_tours_include_custom_post_types_global_options', 1);
}

if(!function_exists('mkdf_tours_include_custom_post_types_global_styles')) {
    /**
     * Loads all global otpions functions for custom post types by going through all folders that are placed directly in post types folder
     */
    function mkdf_tours_include_custom_post_types_global_styles() {
        if(mkdf_tours_theme_installed()) {
            foreach(glob(MIKADO_TOURS_CPT_PATH . '/*/admin/custom-styles/*.php') as $global_styles) {
                include_once $global_styles;
            }
        }
    }

    add_action('roam_mikado_before_options_map', 'mkdf_tours_include_custom_post_types_global_styles', 1);
}