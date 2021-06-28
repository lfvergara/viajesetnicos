<?php

namespace MikadoTours\CPT\Tours\Shortcodes;

use MikadoTours\Lib\ShortcodeInterface;

class TopReviewsCarousel implements ShortcodeInterface {
	private $base;

	/**
	 * TopReviewsCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_top_reviews_carousel';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		$criteria_ratings = mkdf_tours_reviews_get_criteria();

		$criteria_ratings_vc = array();

		if(is_array($criteria_ratings) && count($criteria_ratings)) {
			foreach($criteria_ratings as $criteria_rating) {
				$criteria_ratings_vc[$criteria_rating->name] = $criteria_rating->id;
			}
		}

		vc_map(array(
			'name'                      => esc_html__('Mikado Top Reviews Carousel', 'mkdf-tours'),
			'base'                      => $this->base,
			'category'        			=> esc_html__('by MIKADO TOURS', 'mkdf-tours'),
			'icon'                      => 'icon-wpb-top-reviews-carousel extended-custom-tours-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'mkdf-tours'),
					'param_name'  => 'title',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number of Reviews', 'mkdf-tours'),
					'param_name'  => 'number_of_reviews',
					'description' => esc_html__('Leave empty for all', 'mkdf-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Order by Review Criteria', 'mkdf-tours'),
					'param_name'  => 'review_criteria',
					'value'       => $criteria_ratings_vc,
					'save_always' => true
				)
			)
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
			'title'             => '',
			'number_of_reviews' => '',
			'review_criteria'   => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['reviews'] = $this->getTopReviews($params);

		return mkdf_tours_get_tour_module_template_part('templates/top-reviews-carousel', 'tours', 'shortcodes', '', $params);
	}

	/**
	 * @param $params
	 *
	 * @return array|bool|null|object
	 */
	private function getTopReviews($params) {
		global $wpdb;

		if(empty($params['review_criteria'])) {
			return false;
		}

		$prepareArray = array();
		
		if(mkdf_tours_is_wpml_installed()) {
			$lang = ICL_LANGUAGE_CODE;
			
			$sql = "SELECT c.*, rr.rating, p.post_title
					FROM {$wpdb->prefix}comments c
					LEFT JOIN {$wpdb->prefix}review_ratings rr ON rr.comment_id = c.comment_ID
					LEFT JOIN {$wpdb->prefix}posts p ON p.ID = c.comment_post_ID
					LEFT JOIN {$wpdb->prefix}icl_translations icl_t ON icl_t.element_id = p.ID
					WHERE rr.criteria_id = %d
					AND rr.rating = 5
					AND icl_t.language_code='$lang'";
		} else {
			$sql = "SELECT c.*, rr.rating, p.post_title
					FROM {$wpdb->prefix}comments c
					LEFT JOIN {$wpdb->prefix}review_ratings rr ON rr.comment_id = c.comment_ID
					LEFT JOIN {$wpdb->prefix}posts p ON p.ID = c.comment_post_ID
					WHERE rr.criteria_id = %d
					AND rr.rating = 5";
		}

		$prepareArray[] = $params['review_criteria'];

		if(!empty($params['number_of_reviews'])) {
			$sql .= " LIMIT %d";

			$prepareArray[] = $params['number_of_reviews'];
		}

		$results = $wpdb->get_results($wpdb->prepare($sql, $prepareArray));

		if(!(is_array($results) && count($results))) {
			return false;
		}

		return $results;
	}
}