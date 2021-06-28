<?php

use MikadoTours\Admin\MetaBoxes\TourBooking\TourTimeStorage;
use MikadoTours\CPT\Tours\Lib\TourPriceHelper;
use MikadoTours\CPT\Tours\Lib\TourSearch;
use MikadoTours\CPT\Tours\Lib\ToursQuery;


if(!function_exists('mkdf_tours_query')) {
	/**
	 * @return ToursQuery
	 */
	function mkdf_tours_query() {
		return ToursQuery::getInstance();
	}
}

if(!function_exists('mkdf_tours_search')) {
	/**
	 * @return TourSearch
	 */
	function mkdf_tours_search() {
		return TourSearch::getInstance();
	}
}

if(!function_exists('mkdf_tours_price_helper')) {
	/**
	 * @return TourPriceHelper
	 */
	function mkdf_tours_price_helper() {
		return TourPriceHelper::getInstance();
	}
}

if(!function_exists('mkdf_tours_register_single_sidebar')) {
	/**
	 * Register sidebar that will be used for tour single page
	 */
	function mkdf_tours_register_single_sidebar() {
		register_sidebar(array(
			'name'          => esc_html__('Tour Single Sidebar', 'mkdf-tours'),
			'id'            => 'tour-single-sidebar',
			'description'   => esc_html__('Sidebar that is displayed on tour single page', 'mkdf-tours'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5><span class="mkdf-sidearea-title">',
			'after_title'   => '</span><span class="mkdf-sidearea-line"></span></h5>'
		));
	}

	add_action('widgets_init', 'mkdf_tours_register_single_sidebar');
}

if(!function_exists('mkdf_tours_register_search_sidebar')) {
	/**
	 *
	 */
	function mkdf_tours_register_search_sidebar() {
		register_sidebar(array(
			'name'          => esc_html__('Tour Search Sidebar', 'mkdf-tours'),
			'id'            => 'tour-search-sidebar',
			'description'   => esc_html__('Sidebar that is displayed on tour search page', 'mkdf-tours'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>'
		));
	}

	add_action('widgets_init', 'mkdf_tours_register_search_sidebar');
}

if(!function_exists('mkdf_tours_get_current_user_name')) {
	/**
	 * @return string
	 */
	function mkdf_tours_get_current_user_name() {
		$current_user = wp_get_current_user();

		if(!$current_user instanceof WP_User) {
			return '';
		}

		return $current_user->display_name;
	}
}

if(!function_exists('mkdf_tours_get_current_user_email')) {
	/**
	 * @return string
	 */
	function mkdf_tours_get_current_user_email() {
		$current_user = wp_get_current_user();

		if(!$current_user instanceof WP_User) {
			return '';
		}

		return $current_user->user_email;
	}
}

if(!function_exists('mkdf_tours_string_starts_with')) {
	/**
	 * Checks if $haystack starts with $needle and returns proper bool value
	 *
	 * @param $haystack string to check
	 * @param $needle string with which $haystack needs to start
	 *
	 * @return bool
	 */
	function mkdf_tours_string_starts_with($haystack, $needle) {
		if($haystack !== '' && $needle !== '') {
			return (substr($haystack, 0, strlen($needle)) == $needle);
		}

		return true;
	}
}

if(!function_exists('mkdf_tours_string_ends_with')) {
	/**
	 * Checks if $haystack ends with $needle and returns proper bool value
	 *
	 * @param $haystack string to check
	 * @param $needle string with which $haystack needs to end
	 *
	 * @return bool
	 */
	function mkdf_tours_string_ends_with($haystack, $needle) {
		if($haystack !== '' && $needle !== '') {
			return (substr($haystack, -strlen($needle), strlen($needle)) == $needle);
		}

		return true;
	}
}

if(!function_exists('mkdf_tours_override_tour_type_url')) {
	/**
	 * Overrides default term link for terms that belong to tour-category taxonomy
	 *
	 * @param $termlink
	 * @param $term
	 *
	 * @return string
	 */
	function mkdf_tours_override_tour_type_url($termlink, $term) {
		if($term->taxonomy !== 'tour-category') {
			return $termlink;
		}

		return esc_url(add_query_arg('type[]', $term->slug, get_post_type_archive_link('tour-item')));
	}

	add_filter('term_link', 'mkdf_tours_override_tour_type_url', 10, 2);
}

if(!function_exists('mkdf_tours_is_search_tours_page')) {
	/**
	 * @return string
	 */
	function mkdf_tours_is_search_tours_page() {
        $template_name = get_page_template_slug();

	    return strstr($template_name, 'search-tour-item-template');
    }
}

if(!function_exists('mkdf_tours_search_page_title_text')) {
	/**
	 * @param $title
	 *
	 * @return string
	 */
	function mkdf_tours_search_page_title_text($title) {
	    if(is_post_type_archive('tour-item')) {
		    $title = esc_html__('Tours Search', 'mkdf-tours');
	    }

		return $title;
    }

	add_filter('roam_mikado_title_text', 'mkdf_tours_search_page_title_text');
}

if(!function_exists('mkdf_tours_is_tour_bookable')) {
	/**
	 * @param null $tour_id
	 *
	 * @return bool
	 */
	function mkdf_tours_is_tour_bookable($tour_id = null) {
		$tour_id = is_null($tour_id) ? get_the_ID() : $tour_id;

	    $tour_periods = TourTimeStorage::getInstance()->getTourDates($tour_id);

	    return is_array($tour_periods) && count($tour_periods);
    }
}