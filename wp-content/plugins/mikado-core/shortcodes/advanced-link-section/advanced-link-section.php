<?php
namespace MikadoCore\CPT\Shortcodes\AdvancedLinkSection;

use MikadoCore\Lib;

class AdvancedLinkSection implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkdf_advanced_link_section';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(array(
                'name' => esc_html__('Advanced Link Section', 'mkdf-core'),
                'base' => $this->getBase(),
                'category' => esc_html__('by MIKADO', 'mkdf-core'),
                'icon' => 'icon-wpb-advanced-link-section extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Background Image', 'mkdf-core'),
                        'param_name' => 'background_image',
                        'description' => esc_html__('Select image from media library', 'mkdf-core')
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Uncovering Effect', 'mkdf-core'),
                        'admin_label' => true,
                        'param_name' => 'uncovering_effect',
                        'value' => array(
                            esc_html__('Yes', 'mkdf-core') => 'yes',
                            esc_html__('No', 'mkdf-core') => 'no',
                        ),
                        'save_always' => true,
                        'group' => esc_html__('Behavior Options', 'mkdf-core'),
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Uncovering Color', 'mkdf-core'),
                        'admin_label' => true,
                        'param_name' => 'uncovering_color',
                        'dependency' => array('element' => 'uncovering_effect', 'value' => array('yes')),
                        'group' => esc_html__('Behavior Options', 'mkdf-core'),
                    ),
                    array(
                        'type' => 'param_group',
                        'heading' => esc_html__('Link Item', 'mkdf-core'),
                        'param_name' => 'link_items',
                        'value' => '',
                        'params' => array(
                            array(
                                'type' => 'attach_image',
                                'heading' => esc_html__('Section Background Image', 'mkdf-core'),
                                'param_name' => 'section_background_image',
                                'description' => esc_html__('Select image from media library', 'mkdf-core')
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Section Title', 'mkdf-core'),
                                'param_name' => 'section_title',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Section Subtitle', 'mkdf-core'),
                                'param_name' => 'section_subtitle',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Link Text', 'mkdf-core'),
                                'param_name' => 'link_text',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Link', 'mkdf-core'),
                                'param_name' => 'link'
                            ),
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Text Size (px)', 'mkdf-core'),
                        'param_name' => 'link_text_size',
                        'group' => esc_html__('Design Options', 'mkdf-core'),
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Text Color', 'mkdf-core'),
                        'param_name' => 'link_text_color',
                        'group' => esc_html__('Design Options', 'mkdf-core'),
                    ),
                )
            ));
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'background_image'	=> '',
            'uncovering_effect' => '',
            'uncovering_color'  => '',
            'link_items'		=> '',
            'link_text_size'	=> '',
            'link_text_color'	=> ''

        );

        $params = shortcode_atts($args, $atts);

        $params['section_classes'] = $this->getSectionClasses($params);
        $params['section_style'] = $this->getSectionStyle($params);
        $params['uncovering_style'] = $this->getUncoveringStyle($params);
        $params['link_items'] = $this->getLinkItemsParams($params);
        $params['link_text_style'] = $this->getLinkTextStyle($params);

        $html = mkdf_core_get_shortcode_module_template_part('templates/advanced-link-section-template' , 'advanced-link-section', '', $params);

        return $html;

    }


    /**
     * Return section classes
     *
     * @param $params
     * @return string
     */
    private function getSectionClasses($params) {
        $section_classes = array();

        if ($params['uncovering_effect'] == 'yes'){
            $section_classes[] = 'mkdf-als-uncovering';
        }

        return implode(' ', $section_classes);
    }


    /**
     * Return section style
     *
     * @param $params
     * @return string
     */
    private function getSectionStyle($params) {
        $style = array();

        if ($params['background_image'] !== '') {
            $image_id = $params['background_image'];
            $image_original = wp_get_attachment_image_src($image_id, 'full');

            $image_url = $image_original[0];

            $style[] = 'background-image: url('.esc_url($image_url).')';
        }

        return implode(' ', $style);
    }

    /**
     * Add wanted params for box items
     *
     * @param $params
     * @return array
     */
    private function getLinkItemsParams($params) {
        $link_items = json_decode(urldecode($params['link_items']), true);
        $new_items = array();

        foreach ($link_items as $link_item) {
            $image_id = $link_item['section_background_image'];
            $image_original = wp_get_attachment_image_src($image_id, 'full');
            $image_url = $image_original[0];
            $link_item['style'] = 'background-image: url('.esc_url($image_url).')';

            $new_items[] = $link_item;
        }

        return $new_items;

    }


    /**
     * Returns subtitle style
     *
     * @param $params
     * @return string
     */
    private function getUncoveringStyle($params){
        $uncovering_style = array();

        if ($params['uncovering_color'] !== ''){
            $uncovering_style[] = 'background-color:'.$params['uncovering_color'];
        }

        return implode('; ', $uncovering_style);
    }

    /**
     * Returns link text style
     *
     * @param $params
     * @return string
     */
    private function getLinkTextStyle($params){
        $link_text_style = array();

        if ($params['link_text_size'] !== ''){
            $link_text_style[] = 'font-size:'.roam_mikado_filter_px($params['link_text_size']).'px';
        }

        if ($params['link_text_color'] !== ''){
            $link_text_style[] = 'color:'.$params['link_text_color'];
        }

        return implode('; ', $link_text_style);
    }
}