<?php
/*
Plugin Name: Mikado Tours
Description: Plugin that adds tours post types needed by theme
Author: Mikado Themes
Version: 1.0
*/

require_once 'load.php';

define('MIKADO_TOURS_MAIN_FILE_PATH', __FILE__);

use MikadoTours\Admin\MetaBoxes\TourBooking\TourTimeStorage;
use MikadoTours\CPT;
use MikadoTours\CPT\Tours\Lib\BookingHandler;
use MikadoTours\CPT\Tours\Lib\PageTemplater;
use MikadoTours\CPT\Tours\Lib\TourSearch;
use MikadoTours\Lib;
use MikadoTours\DatabaseSetup\TablesSetup;

add_action('after_setup_theme', array(CPT\PostTypesRegister::getInstance(), 'register'));

Lib\ShortcodeLoader::getInstance()->load();
TablesSetup::getInstance()->initialize();
TourTimeStorage::getInstance()->initialize();
BookingHandler::getInstance()->initialize();
PageTemplater::getInstance()->initialize();
TourSearch::getInstance()->initialize();

if(!function_exists('mkdf_tours_activation')) {
	/**
	 * Triggers when plugin is activated. It calls flush_rewrite_rules
	 * and defines roam_mikado_tours_on_activate action
	 */
	function mkdf_tours_activation() {
		do_action('roam_mikado_tours_on_activate');

		MikadoTours\CPT\PostTypesRegister::getInstance()->register();

		flush_rewrite_rules();
	}

	register_activation_hook(__FILE__, 'mkdf_tours_activation');
}

if(!function_exists('mkdf_tours_text_domain')) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function mkdf_tours_text_domain() {
		load_plugin_textdomain('mkdf-tours', false, MIKADO_TOURS_REL_PATH.'/languages');
	}

	add_action('plugins_loaded', 'mkdf_tours_text_domain');
}

if(!function_exists('mkdf_tours_scripts')) {
	/**
	 * Loads plugin scripts
	 */
	function mkdf_tours_scripts() {
		$array_deps_js = array(
			'underscore',
			'jquery-ui-tabs',
			'jquery-ui-datepicker'
		);
		$array_deps_css = array();
		$array_deps_css_responsive = array();

		if(mkdf_tours_theme_installed()) {
			$array_deps_css[] = 'roam_mikado_modules';
			$array_deps_css_responsive[] = 'roam_mikado_modules_responsive';
			$array_deps_js[] = 'roam_mikado_modules';
		}

		wp_enqueue_style( 'mkdf_tours_style', plugins_url( MIKADO_TOURS_REL_PATH . '/assets/css/tours.min.css' ), $array_deps_css);
		wp_enqueue_style( 'mkdf_tours_responsive_style', plugins_url( MIKADO_TOURS_REL_PATH . '/assets/css/tours-responsive.min.css' ), $array_deps_css_responsive);
		wp_enqueue_script('mkdf_tours_script', plugins_url(MIKADO_TOURS_REL_PATH.'/assets/js/tours.js'), $array_deps_js, false, true);

		wp_enqueue_script('nouislider', plugins_url(MIKADO_TOURS_REL_PATH).'/assets/js/modules/plugins/nouislider.min.js', array(), false, true);
		wp_enqueue_style('nouislider', plugins_url(MIKADO_TOURS_REL_PATH).'/assets/css/nouislider.min.css');
		wp_enqueue_script('typeahead', plugins_url(MIKADO_TOURS_REL_PATH).'/assets/js/modules/plugins/typeahead.bundle.min.js', array('jquery'), false, true);
		wp_enqueue_script('bloodhound', plugins_url(MIKADO_TOURS_REL_PATH).'/assets/js/modules/plugins/bloodhound.min.js', array('jquery'), false, true);
	}

	add_action('wp_enqueue_scripts', 'mkdf_tours_scripts');
}

if(!function_exists('mkdf_tours_localize_tours_list')) {
	/**
	 * Localizes tours list for tours keyword search
	 */
	function mkdf_tours_localize_tours_list() {
		if(mkdf_tours_is_search_tours_page() || is_post_type_archive('tour-item') || shortcode_exists('mkdf_tours_slider_with_filter') || shortcode_exists('mkdf_tours_filter')) {
			
			if(mkdf_tours_is_wpml_installed()) {
				global $wpdb;
				
				$lang = ICL_LANGUAGE_CODE;
				
				$t_sql = "SELECT p.*
					FROM {$wpdb->prefix}posts p
					LEFT JOIN {$wpdb->prefix}icl_translations icl_t ON icl_t.element_id = p.ID 
					WHERE p.post_type = 'tour-item'
					AND p.post_status = 'publish'
					AND icl_t.language_code='{$lang}'";
				
				$tours_query_results = $wpdb->get_results($t_sql);
				
				if($tours_query_results) {
					global $post;
					
					foreach ($tours_query_results as $post) {
						setup_postdata($post);
						$tours_array[] = get_the_title();
					}
				}
				
				wp_reset_postdata();
				
				$d_sql = "SELECT p.*
					FROM {$wpdb->prefix}posts p
					LEFT JOIN {$wpdb->prefix}icl_translations icl_t ON icl_t.element_id = p.ID 
					WHERE p.post_type = 'destinations'
					AND p.post_status = 'publish'
					AND icl_t.language_code='{$lang}'";
				
				$destinations_query_results = $wpdb->get_results($d_sql);
				
				if($destinations_query_results) {
					global $post;
					
					foreach ($destinations_query_results as $post) {
						setup_postdata($post);
						$destination_array[] = get_the_title();
					}
				}
				
				wp_reset_postdata();
				
			} else {
				$tours_list = get_posts(array(
					'post_status'    => 'publish',
					'post_type'      => 'tour-item',
					'posts_per_page' => -1
				));
				
				$tours_array = array();
				
				if(is_array($tours_list) && count($tours_list)) {
					foreach($tours_list as $item) {
						$tours_array[] = $item->post_title;
					}
				}
				
				$destination_list = get_posts(array(
					'post_status'    => 'publish',
					'post_type'      => 'destinations',
					'posts_per_page' => -1
				));
				
				$destination_array = array();
				
				if(is_array($destination_list) && count($destination_list)) {
					foreach($destination_list as $destination) {
						$destination_array[] = $destination->post_title;
					}
				}
			}

			wp_localize_script('mkdf_tours_script', 'mkdfToursSearchData', array(
				'tours'       => $tours_array,
				'destinations' => $destination_array
			));
		}

		return false;
	}

	add_action('wp_enqueue_scripts', 'mkdf_tours_localize_tours_list', 11);
}