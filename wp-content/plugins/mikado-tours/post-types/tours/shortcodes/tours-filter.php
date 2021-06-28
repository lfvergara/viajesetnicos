<?php

namespace MikadoTours\CPT\Tours\Shortcodes;

use MikadoTours\Lib\ShortcodeInterface;

class ToursFilter implements ShortcodeInterface {
	private $base;

	/**
	 * ToursFilter constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_tours_filter';

		add_action('vc_before_init_vc', array($this, 'vcMap'));
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Tours Filters', 'mkdf-tours'),
			'base'                      => $this->base,
			'category'       			=> esc_html__('by MIKADO TOURS', 'mkdf-tours'),
			'icon'                      => 'icon-wpb-tours-filters extended-custom-tours-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Type', 'mkdf-tours'),
					'param_name'  => 'filter_type',
					'value'       => array(
						esc_html__('Vertical', 'mkdf-tours')   => 'vertical',
						esc_html__('Horizontal', 'mkdf-tours') => 'horizontal'
					),
					'save_always' => true,
					'admin_label' => true
				),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Filter in Grid', 'mkdf-tours'),
                    'param_name'  => 'filter_in_grid',
                    'value'       => array(
                        esc_html__('Yes', 'mkdf-tours') => 'yes',
                        esc_html__('No', 'mkdf-tours')  => 'no'
                    ),
                    'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal')
                ),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Skin', 'mkdf-tours'),
					'param_name'  => 'vertical_filter_skin',
					'value'       => array(
						esc_html__('Grey', 'mkdf-tours')  => 'grey',
						esc_html__('White', 'mkdf-tours') => 'white'
					),
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Skin', 'mkdf-tours'),
					'param_name'  => 'horizontal_filter_skin',
					'value'       => array(
						esc_html__('Light', 'mkdf-tours') => 'light',
						esc_html__('Dark', 'mkdf-tours')  => 'dark'
					),
					'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal')
				),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Button Text Skin', 'mkdf-tours'),
                    'param_name'  => 'horizontal_button_skin',
                    'value'       => array(
                        esc_html__('Default', 'mkdf-tours') => 'default',
                        esc_html__('Light', 'mkdf-tours') => 'light',
                        esc_html__('Dark', 'mkdf-tours')  => 'dark'
                    ),
                    'dependency'  => array('element' => 'filter_type', 'value' => 'horizontal')
                ),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Show Tour Types Checkboxes', 'mkdf-tours'),
					'param_name'  => 'show_tour_types',
					'value'       => array(
						esc_html__('Yes', 'mkdf-tours') => 'yes',
						esc_html__('No', 'mkdf-tours')  => 'no'
					),
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number of Tour Types', 'mkdf-tours'),
					'param_name'  => 'number_of_tour_types',
					'dependency'  => array('element' => 'filter_type', 'value' => 'vertical')
				)
			)
		));
	}

	public function getBase() {
		return $this->base;
	}

	public function render($atts, $content = null) {
		$args = array(
			'filter_type'            => 'vertical',
            'filter_in_grid'         => 'yes',
			'vertical_filter_skin'   => 'grey',
			'horizontal_filter_skin' => 'light',
            'horizontal_button_skin' => 'default',
			'show_tour_types'        => 'yes',
			'number_of_tour_types'   => ''
		);

		$params = shortcode_atts($args, $atts);

		$filterClass = array(
			'mkdf-tours-filter-holder',
			'mkdf-tours-filter-'.$params['filter_type']
		);

		switch($params['filter_type']) {
			case 'vertical':
				$filterClass[] = 'mkdf-tours-filter-skin-'.$params['vertical_filter_skin'];
				break;
			case 'horizontal':
				$filterClass[] = 'mkdf-tours-filter-skin-'.$params['horizontal_filter_skin'];
				break;
		}

		if($params['horizontal_button_skin'] == 'dark') {
            $filterClass[] = 'mkdf-tours-filter-button-dark';
        }  elseif($params['horizontal_button_skin'] == 'light') {
            $filterClass[] = 'mkdf-tours-filter-button-light';
        }


		$params['show_tour_types'] = $params['show_tour_types'] === 'yes';


		$params['filter_class'] = $filterClass;

		return mkdf_tours_get_tour_module_template_part('templates/tours-filters-holder', 'tours', 'shortcodes', '', $params);
	}
}