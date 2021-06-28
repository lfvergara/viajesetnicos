<?php
namespace MikadoTours\CPT\Tours\Shortcodes;

use MikadoTours\CPT\Tours\Lib\ToursQuery;
use MikadoTours\Lib\ShortcodeInterface;

class ToursCarousel implements ShortcodeInterface {
	private $base;

	/**
	 * ToursCarousel constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_carousel';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Tours Carousel', 'mkdf-tours'),
			'base'                      => $this->base,
			'category'       			=> esc_html__('by MIKADO TOURS', 'mkdf-tours'),
			'icon'                      => 'icon-wpb-tours-carousel extended-custom-tours-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Tours List Type', 'mkdf-tours'),
						'param_name'  => 'tour_type',
						'value'       => array(
							esc_html__('Standard', 'mkdf-tours') => 'standard',
							esc_html__('Dharma', 'mkdf-tours')  => 'dharma',
							esc_html__('Dharma FWhite', 'mkdf-tours')  => 'dharma_fwhite',
							esc_html__('Gallery', 'mkdf-tours')  => 'gallery',
							esc_html__('Revealing Info', 'mkdf-tours')  => 'revealing',
							esc_html__('Gallery Simple', 'mkdf-tours')  => 'gallery-simple'
						),
						'admin_label' => true,
						'description' => esc_html__('Default value is Standard', 'mkdf-tours'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Number of Columns', 'mkdf-tours'),
						'param_name'  => 'number_of_columns',
						'value'       => array(
							'1' => '1',
							'3' => '3',
							'4' => '4',
                            '5' => '5'
						)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Image Proportions', 'mkdf-tours'),
						'param_name'  => 'image_size',
						'value'       => array(
							esc_html__('Original', 'mkdf-tours')  => 'full',
							esc_html__('Square', 'mkdf-tours')    => 'square',
							esc_html__('Landscape', 'mkdf-tours') => 'landscape',
							esc_html__('Portrait', 'mkdf-tours')  => 'portrait',
							esc_html__('Custom', 'mkdf-tours')    => 'custom'
						)
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Image Dimensions', 'mkdf-tours'),
						'param_name'  => 'custom_image_dimensions',
						'description' => esc_html__('Enter custom image dimensions. Enter image size in pixels: 200x100 (Width x Height)', 'mkdf-tours'),
						'dependency'  => array('element' => 'image_size', 'value' => 'custom')
					),
					array(
			            'type' => 'dropdown',
			            'heading' => esc_html__('Space Between Items','mkdf-tours'),
			            'param_name' => 'space_between_items',
			            'value' => array(
			                esc_html__('Medium', 'mkdf-tours') => 'normal',
			                esc_html__('Small', 'mkdf-tours') => 'small',
			                esc_html__('Tiny', 'mkdf-tours') => 'tiny',
			                esc_html__('None', 'mkdf-tours') => 'no',
			            )
		            ),
		            array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Enable Overlay', 'mkdf-tours'),
						'param_name'  => 'enable_overlay',
			            'value' => array(
			                esc_html__('', 'mkdf-tours') => '',
			                esc_html__('Yes', 'mkdf-tours') => 'yes',
			                esc_html__('No', 'mkdf-tours') => 'no',
			            ),
						'dependency'  => array('element' => 'tour_type', 'value' => array('gallery'))
	            	),
		            array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Display Label', 'mkdf-tours'),
						'param_name'  => 'display_label',
			            'value' => array(
			                '' => '',
			                esc_html__('Yes', 'mkdf-tours') => 'yes',
			                esc_html__('No', 'mkdf-tours') => 'no',
			            )
	            	),
		            array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Content Background Color', 'mkdf-tours'),
						'param_name'  => 'content_background_color',
						'dependency'  => array('element' => 'tour_type', 'value' => array('standard','revealing'))
	            	),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'title_tag',
						'heading'     => esc_html__( 'Title Tag', 'mkdf-tours' ),
						'value'       => array_flip( roam_mikado_get_title_tag( true ) ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Text Length', 'mkdf-tours'),
						'param_name'  => 'text_length',
						'description' => esc_html__('Number of words', 'mkdf-tours')
					),
		            array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Display Navigation', 'mkdf-tours'),
						'param_name'  => 'display_navigation',
			            'value' => array(
			                '' => '',
			                esc_html__('Yes', 'mkdf-tours') => 'yes',
			                esc_html__('No', 'mkdf-tours') => 'no',
			            )
	            	),
				),
				mkdf_tours_query()->queryVCParams()
			) //close array_merge
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
			'tour_type'                     => 'standard',
			'number_of_columns'				=> '3',
			'image_size'                    => 'full',
			'custom_image_dimensions'       => '',
			'space_between_items'			=> 'normal',
			'enable_overlay'				=> '',
			'display_label'					=> 'yes',
			'content_background_color'		=> '',
			'title_tag'                     => 'h4',
			'text_length'                   => '90',
			'display_navigation'			=> ''
		);

		$args   = array_merge($args, mkdf_tours_query()->getShortcodeAtts());
		$params = shortcode_atts($args, $atts);
		
		if(!empty($params['destination'])) {
			$destination_query = new \WP_Query(array('post_status' => 'published', 'post_type' => 'destinations', 'name' => esc_attr(strtolower($params['destination']))));
			wp_reset_postdata();
			$destination_id = $destination_query->posts[0]->ID;
			
			$query = mkdf_tours_query()->buildQueryObject($params, array(
				'meta_key' => 'mkdf_tours_destination',
				'meta_value' => esc_attr($destination_id)
			));
		} else {
			$query  = mkdf_tours_query()->buildQueryObject($params);
		}

		$params['query']  = $query;
		$params['caller'] = $this;

		$params['carousel_data'] = $this->getSliderData($params);
		$params['list_classes'] = $this->getListClasses($params);
		$params['item_params'] = $this->getItemParams($params);

		return mkdf_tours_get_tour_module_template_part('templates/tours-carousel-holder', 'tours', 'shortcodes', '', $params);
	}

	public function getItemTemplate($tour_type = 'standard', $params = array()) {
		echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$tour_type, 'tours', '', '', $params);
	}

	private function getSliderData($params) {
		$slider_data = array();

		$slider_data['data-enable-loop']            = 'yes';
		$slider_data['data-enable-pagination']      = 'no';

		if ($params['number_of_columns'] !== ''){
			$slider_data['data-number-of-items']        = $params['number_of_columns'];
		}

		if ($params['display_navigation'] !== '') {
			$slider_data['data-enable-navigation'] = $params['display_navigation'];
		} else {
			$slider_data['data-enable-navigation'] = 'yes';
		}
		
		return $slider_data;
	}

	private function getListClasses($params) {
		$list_classes = array();
		$list_classes[] = 'mkdf-tours-row';

		if ($params['space_between_items'] !== ''){
			$list_classes[] = 'mkdf-tr-'.$params['space_between_items'].'-space';
		}
		
		if ($params['display_label'] !== 'no'){
			$list_classes[] = 'mkdf-has-label';
		}

		return implode(' ', $list_classes);
	}

	/*
	* Function sets parameters for item
	*/
	private function getItemParams($params) {
		$item_params = array();
		$item_params['custom_class'] = '';

		$item_params['thumb_size'] = mkdf_tours_get_image_size_param($params);

		if ($params['title_tag'] !== ''){
			$item_params['title_tag'] = $params['title_tag'];
		}

		$item_params['text_length'] = $params['text_length'];
		$item_params['display_label'] = $params['display_label'];
		$item_params['content_style'] = '';
		
		if ($params['content_background_color'] !== ''){
			$item_params['content_style'] = 'background-color: ' .$params['content_background_color'];
		}

		if ($params['enable_overlay'] == 'yes') {
			$item_params['custom_class'] = 'mkdf-tours-enable-overlay';
		}

		return $item_params;
	}
}