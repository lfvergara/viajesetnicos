<?php
namespace MikadoCore\CPT\Shortcodes\Banner;

use MikadoCore\Lib;

class Banner implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_banner';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Banner', 'mkdf-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by MIKADO', 'mkdf-core' ),
					'icon'                      => 'icon-wpb-banner extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'mkdf-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'mkdf-core' )
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'number_of_columns',
                            'heading'    => esc_html__( 'Number of Columns', 'mkdf-core' ),
                            'value'      => array(
                                esc_html__( 'One', 'mkdf-core' ) => 'one-column',
                                esc_html__( 'Two', 'mkdf-core' ) => 'two-columns',
                                esc_html__( 'Three', 'mkdf-core' ) => 'three-columns',
                                esc_html__( 'Four', 'mkdf-core' ) => 'four-columns'
                            ),
                            'save_always' => true
                        ),
                        array(
                            'type' => 'param_group',
                            'heading' => esc_html__('Single Banner', 'mkdf-core'),
                            'param_name' => 'single_banner',
                            'value' => '',
                            'params' => array(
                                array(
                                    'type'        => 'attach_image',
                                    'param_name'  => 'image',
                                    'heading'     => esc_html__( 'Image', 'mkdf-core' ),
                                    'description' => esc_html__( 'Select image from media library', 'mkdf-core' )
                                ),
                                array(
                                    'type'        => 'attach_image',
                                    'param_name'  => 'hover_image',
                                    'heading'     => esc_html__( 'Hover Image', 'mkdf-core' ),
                                    'description' => esc_html__( 'Select image from media library to appear on hover over the main image', 'mkdf-core' )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'subtitle',
                                    'heading'    => esc_html__( 'Subtitle', 'mkdf-core' )
                                ),
                                array(
                                    'type'       => 'colorpicker',
                                    'param_name' => 'subtitle_color',
                                    'heading'    => esc_html__( 'Subtitle Color', 'mkdf-core' ),
                                    'dependency' => array( 'element' => 'subtitle', 'not_empty' => true )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'title',
                                    'heading'    => esc_html__( 'Title', 'mkdf-core' )
                                ),
                                array(
                                    'type'       => 'colorpicker',
                                    'param_name' => 'title_color',
                                    'heading'    => esc_html__( 'Title Color', 'mkdf-core' ),
                                    'dependency' => array( 'element' => 'title', 'not_empty' => true )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link',
                                    'heading'    => esc_html__( 'Link', 'mkdf-core' )
                                ),
                                array(
                                    'type'       => 'dropdown',
                                    'param_name' => 'target',
                                    'heading'    => esc_html__( 'Target', 'mkdf-core' ),
                                    'value'      => array_flip( roam_mikado_get_link_target_array() ),
                                    'dependency' => array( 'element' => 'link', 'not_empty' => true )
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'link_text',
                                    'heading'    => esc_html__( 'Link Text', 'mkdf-core' ),
                                    'dependency' => array( 'element' => 'link', 'not_empty' => true )
                                ),
                            )
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'         => '',
            'number_of_columns'    => 'one-column',
            'single_banner'        => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']  = $this->getHolderClasses( $params, $args );
		$params['link_styles']     = $this->getLinkStyles( $params );
        $params['single_banner'] = $this->getSingleBannerParams($params);
		
		$html = mkdf_core_get_shortcode_module_template_part( 'templates/banner', 'banner', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-banner-' . $params['number_of_columns'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getLinkStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['link_color'] ) ) {
			$styles[] = 'color: ' . $params['link_color'];
		}
		
		return implode( ';', $styles );
	}

    /**
     * Add wanted params for banner items
     *
     * @param $params
     * @return array
     */
    private function getSingleBannerParams($params) {
        $single_banner = json_decode(urldecode($params['single_banner']), true);
        $single_items = array();

        foreach ($single_banner as $single_banner_item) {

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