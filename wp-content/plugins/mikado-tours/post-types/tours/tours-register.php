<?php
namespace MikadoTours\CPT\Tours;

use MikadoTours\Lib;

/**
 * Class ToursRegister
 * @package MikadoTours\CPT\Tours
 */
class ToursRegister implements Lib\PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    /**
     * @var string
     */
    private $taxBase;

    public function __construct() {
        $this->base    = 'tour-item';
        $this->taxBase = 'tour-category';
        add_filter('single_template', array($this, 'registerSingleTemplate'));

        add_action('admin_menu', array($this, 'removeReviewCriteriaMetaBox'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
    }

    /**
     * Registers listing-item single template if one does'nt exists in theme.
     * Hooked to single_template filter
     *
     * @param $single string current template
     *
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if($post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-tour-item.php')) {
                return MIKADO_TOURS_CPT_PATH.'/tours/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {
        global $roam_mikado_Framework;

        $menuPosition = 11;
        $menuIcon     = 'dashicons-palmtree';
	    
		if (mkdf_tours_theme_installed()) {
			$menuIcon = $roam_mikado_Framework->getSkin()->getSkinURI().'/assets/img/admin-logo-icon.png';
		}
		
        $slug = $this->base;

        register_post_type($this->base,
            array(
                'labels'        => array(
                    'name'          => esc_html__('Nuestros viajes', 'mkdf-tours'),
                    'menu_name'     => esc_html__('Nuestros Viajes', 'mkdf-tours'),
                    'all_items'     => esc_html__('Listado de viajes', 'mkdf-tours'),
                    'add_new'       => esc_html__('Añadir nuevo viaje', 'mkdf-tours'),
                    'singular_name' => esc_html__('Tour Item', 'mkdf-tours'),
                    'add_item'      => esc_html__('New Tour Item', 'mkdf-tours'),
                    'add_new_item'  => esc_html__('Añadir nuevo viaje', 'mkdf-tours'),
                    'edit_item'     => esc_html__('Edit Tour Item', 'mkdf-tours')
                ),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug),
                'menu_position' => $menuPosition,
                'show_ui'       => true,
                'show_in_menu'  => true,
                'supports'      => array(
                    'author',
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'page-attributes',
                    'comments'
                ),
                'menu_icon'     => $menuIcon
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'              => esc_html__('Categorias de viajes', 'mkdf-tours'),
            'singular_name'     => esc_html__('Tour Category', 'mkdf-tours'),
            'search_items'      => esc_html__('Search Tours Categories', 'mkdf-tours'),
            'all_items'         => esc_html__('All Tours Categories', 'mkdf-tours'),
            'parent_item'       => esc_html__('Parent Tour Category', 'mkdf-tours'),
            'parent_item_colon' => esc_html__('Parent Tour Category:', 'mkdf-tours'),
            'edit_item'         => esc_html__('Edit Tour Category', 'mkdf-tours'),
            'update_item'       => esc_html__('Update Tour Category', 'mkdf-tours'),
            'add_new_item'      => esc_html__('Añadir nueva categoria de viaje', 'mkdf-tours'),
            'new_item_name'     => esc_html__('New Tour Category Name', 'mkdf-tours'),
            'menu_name'         => esc_html__('Categoria de viajes', 'mkdf-tours'),
        );

        register_taxonomy($this->taxBase, array($this->base), array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => 'tour-category'),
        ));

        register_taxonomy('review-criteria', array($this->base), array(
            'hierarchical'      => true,
            'show_ui'           => true,
            'labels'            => array(
                'name'              => esc_html__('Criterios de revisión', 'mkdf-tours'),
                'singular_name'     => esc_html__('Review Criterion', 'mkdf-tours'),
                'search_items'      => esc_html__('Search Review Criteria', 'mkdf-tours'),
                'all_items'         => esc_html__('All Review Criteria', 'mkdf-tours'),
                'parent_item'       => esc_html__('Parent Review Criterion', 'mkdf-tours'),
                'parent_item_colon' => esc_html__('Parent Review Criterion:', 'mkdf-tours'),
                'edit_item'         => esc_html__('Edit Review Criterion', 'mkdf-tours'),
                'update_item'       => esc_html__('Update Review Criterion', 'mkdf-tours'),
                'add_new_item'      => esc_html__('Añadir nuevo criterio de revisión', 'mkdf-tours'),
                'new_item_name'     => esc_html__('New Review Criterion Name', 'mkdf-tours'),
                'menu_name'         => esc_html__('Criterios de revisión', 'mkdf-tours'),
            ),
            'query_var'         => true,
            'show_admin_column' => false,
        ));

        $attributes_labels = array(
            'name'              => esc_html__('Atributos de los viajes', 'mkdf-tours'),
            'singular_name'     => esc_html__('Tour Attribute', 'mkdf-tours'),
            'search_items'      => esc_html__('Search Tours Attributes', 'mkdf-tours'),
            'all_items'         => esc_html__('All Tours Attributes', 'mkdf-tours'),
            'parent_item'       => esc_html__('Parent Tour Attribute', 'mkdf-tours'),
            'parent_item_colon' => esc_html__('Parent Tour Attribute:', 'mkdf-tours'),
            'edit_item'         => esc_html__('Edit Tour Attribute', 'mkdf-tours'),
            'update_item'       => esc_html__('Update Tour Attribute', 'mkdf-tours'),
            'add_new_item'      => esc_html__('Add New Tour Attribute', 'mkdf-tours'),
            'new_item_name'     => esc_html__('New Tour Attribute Name', 'mkdf-tours'),
            'menu_name'         => esc_html__('Atributos de los viajes', 'mkdf-tours'),
        );

        register_taxonomy('tour-attribute', array($this->base), array(
            'hierarchical'      => true,
            'show_ui'           => true,
            'labels'            => $attributes_labels,
            'query_var'         => true,
            'show_admin_column' => false,
        ));
    }

    public function removeReviewCriteriaMetaBox() {
        //remove review criteria meta box from tour single page,
        //because we don't want user to check review criteria for each tour
        remove_meta_box('review-criteriadiv', $this->base, 'side');
    }
}