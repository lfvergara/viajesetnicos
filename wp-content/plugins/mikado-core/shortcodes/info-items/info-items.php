<?php
namespace MikadoCore\CPT\Shortcodes\InfoItems;

use MikadoCore\Lib;

class InfoItems implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_info_items';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Info Items', 'mkdf-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by MIKADO', 'mkdf-core' ),
					'icon'                      => 'icon-wpb-info-items extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'mkdf-core' ),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'mkdf-core' ),
							'value'       => array_flip( roam_mikado_get_title_tag( true ) ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
                        array(
                            'type' => 'param_group',
                            'heading' => esc_html__('Info Item', 'mkdf-core'),
                            'param_name' => 'info_item',
                            'params' => array(
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'item_title',
                                    'heading'    => esc_html__( 'Item Title', 'mkdf-core' )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'item_description',
                                    'heading'    => esc_html__( 'Item Description', 'mkdf-core' )
                                )
                            )
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'title'         => '',
			'title_tag'     => 'h3',
            'info_item'     => ''
		);
		$params = shortcode_atts( $args, $atts );
	
        $params['single_items'] = json_decode(urldecode($params['info_item']), true);
		
		$html = mkdf_core_get_shortcode_module_template_part( 'templates/info-items', 'info-items', '', $params );
		
		return $html;
	}

    /**
     * Add wanted params for banner items
     *
     * @param $params
     * @return array
     */
    private function getSingleItemParams($params) {
        $single_info_items = json_decode(urldecode($params['info_item']), true);
        $single_items = array();

        foreach ($single_info_items as $single_info_item) {

            if(!empty($single_banner_item['title_color'])) {
                $single_banner_item['title_color'] = 'color:'.$single_banner_item['title_color'];
            } else {
                $single_banner_item['title_color'] = '';
            }
            if(!empty($single_banner_item['subtitle_color'])) {
                $single_banner_item['subtitle_color'] = 'color:'.$single_banner_item['subtitle_color'];
            } else {
                $single_banner_item['subtitle_color'] = '';
            }


            $single_items[] = $single_banner_item;
        }

        return $single_items;

    }
}