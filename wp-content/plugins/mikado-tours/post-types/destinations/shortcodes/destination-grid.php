<?php
namespace MikadoTours\CPT\Destination\Shortcodes;

use MikadoTours\Lib\ShortcodeInterface;

class DestinationGrid implements ShortcodeInterface {
	private $base;

	/**
	 * DestinationGrid constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_destination_grid';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Destinations Grid', 'mkdf-tours'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO TOURS', 'mkdf-tours'),
			'icon'                      => 'icon-wpb-destinations-grid extended-custom-tours-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Number of Columns', 'mkdf-tours'),
					'param_name'  => 'number_of_cols',
					'value'       => array(
						esc_html__('Default','mkdf-tours') => '3',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4'
					)
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Image Proportions', 'mkdf-tours'),
					'param_name'  => 'image_size',
					'value'       => array(
						esc_html__('Default', 'mkdf-tours')   => '',
						esc_html__('Original', 'mkdf-tours')  => 'full',
						esc_html__('Square', 'mkdf-tours')    => 'square',
						esc_html__('Landscape', 'mkdf-tours') => 'landscape',
						esc_html__('Portrait', 'mkdf-tours')  => 'portrait',
						esc_html__('Custom', 'mkdf-tours')    => 'custom'
					),
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
					'param_name'  => 'title_tag',
					'heading'     => esc_html__( 'Title Tag', 'mkdf-tours' ),
					'value'       => array_flip( roam_mikado_get_title_tag( true ) ),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Order By', 'mkdf-tours'),
					'param_name'  => 'order_by',
					'value'       => array(
						esc_html__('Title', 'mkdf-tours')      => 'title',
						esc_html__('Date', 'mkdf-tours')       => 'date',
						esc_html__('Menu Order', 'mkdf-tours') => 'menu_order',
					),
					'save_always' => true,
					'group'       => esc_html__('Query Options', 'mkdf-tours')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Order', 'mkdf-tours'),
					'param_name'  => 'order',
					'value'       => array(
						esc_html__('ASC', 'mkdf-tours')  => 'ASC',
						esc_html__('DESC', 'mkdf-tours') => 'DESC',
					),
					'save_always' => true,
					'group'       => esc_html__('Query Options', 'mkdf-tours')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number of Destinations Per Page', 'mkdf-tours'),
					'param_name'  => 'number',
					'value'       => '-1',
					'description' => esc_html__('Enter -1 to show all', 'mkdf-tours'),
					'group'       => esc_html__('Query Options', 'mkdf-tours')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Show Only Destinations with Listed IDs', 'mkdf-tours'),
					'param_name'  => 'selected_destinations',
					'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'mkdf-tours'),
					'group'       => esc_html__('Query Options', 'mkdf-tours')
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'number_of_cols'		=> '3',
			'space_between_items'	=> 'normal',
			'image_size'			=> 'full',
			'custom_image_dimensions'=> '',
			'title_tag'				=> 'h3',
			'order_by'              => 'date',
			'order'                 => 'DESC',
			'number'                => '-1',
			'selected_destinations' => ''
		);

		$params = shortcode_atts($args, $atts);

		$query = $this->buildQueryObject($params);

		$params['query']  = $query;
		$params['caller'] = $this;

		$params['thumb_size'] = mkdf_tours_get_image_size_param($params);
		$params['classes'] = $this->gridClasses($params);

		return mkdf_tours_get_tour_module_template_part('templates/destination-grid-template', 'destinations', 'shortcodes', '', $params);
	}

	private function buildQueryObject($params) {
		$queryArray['post_status'] = 'published';
		$queryArray['post_type'] = 'destinations';

		if(!empty($params['order_by'])) {
			$queryArray['orderby'] = $params['order_by'];
		}

		if(!empty($params['order'])) {
			$queryArray['order'] = $params['order'];
		}

		if(!empty($params['number'])) {
			$queryArray['posts_per_page'] = $params['number'];
		}

		$toursIds = null;
		if(!empty($params['selected_destinations'])) {
			$toursIds               = explode(',', $params['selected_destinations']);
			$queryArray['post__in'] = $toursIds;
		}

		return new \WP_Query($queryArray);
	}

	private function gridClasses($params) {
		$classes = array();
		$classes[] = 'mkdf-tours-destination-holder';
		$classes[] = 'mkdf-tours-row';

		if ($params['space_between_items'] !== ''){
			$classes[] = 'mkdf-tr-'.$params['space_between_items'].'-space';
		}

		if ($params['number_of_cols'] !== '') {
			$classes[] = 'mkdf-tours-columns-'.$params['number_of_cols'];
		}

		return implode(' ', $classes);		
	}
}