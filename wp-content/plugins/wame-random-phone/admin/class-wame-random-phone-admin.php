<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version and init hooks to
 * enqueue the admin-specific functionalities.
 *
 * @since      2.0.0
 * @package    WAmeRandomPhone
 * @author     Creame <hola@crea.me>
 */
class WAmeRandomPhoneAdmin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set init hook.
	 *
	 * @since    2.0.0
	 * @param    string $plugin_name       The name of this plugin.
	 * @param    string $version           The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		add_action( 'whatsappme_run_pre', array( $this, 'init' ) );

	}

	/**
	 * Initialize all hooks
	 *
	 * @since    2.0.0
	 * @param    array $whatsappme       WhatsAppMe object.
	 * @return   void
	 */
	public function init( $whatsappme ) {

		$loader = $whatsappme->get_loader();

		$loader->add_filter( 'whatsappme_extra_settings', $this, 'extra_settings' );
		$loader->add_filter( 'option_whatsappme', $this, 'fix_phones' );
		$loader->add_filter( 'whatsappme_tab_general_sections', $this, 'white_label' );
		$loader->add_filter( 'whatsappme_field_output', $this, 'fields_output', 10, 3 );
		$loader->add_filter( 'whatsappme_settings_validate', $this, 'settings_validate' );
		$loader->add_filter( 'whatsappme_metabox_output', $this, 'metabox_output', 10, 2 );
		$loader->add_filter( 'whatsappme_metabox_save', $this, 'metabox_save' );

		$loader->add_action( 'admin_enqueue_scripts', $this, 'register_assets' );

	}

	/**
	 * Add Random Phone settings defaults
	 *
	 * @since    2.0.0
	 * @param    array $extra       current settings.
	 * @return   array
	 */
	public function extra_settings( $extra ) {

		return array_merge(
			$extra, array(
				'random_phones' => array(),
				'white_label'   => 'no',
			)
		);

	}

	/**
	 * Fix previous version of WAme Random Phones
	 *
	 * Convert comma separated list of phones to one 'telephone'
	 * and 'random_phones' fields.
	 *
	 * @since    2.0.0
	 * @param    array $option       current option.
	 * @return   array
	 */
	public function fix_phones( $option ) {

		if ( strpos( $option['telephone'], ',' ) !== false ) {
			$phones                  = explode( ',', $option['telephone'] );
			$phones                  = array_map( 'trim', $phones );
			$option['telephone']     = array_shift( $phones );
			$option['random_phones'] = $phones;
		}

		return $option;

	}

	/**
	 * Add White Label setting
	 *
	 * @since    2.0.0
	 * @param    array $sections       sections and fields.
	 * @return   array
	 */
	public function white_label( $sections ) {

		$sections['chat'] = array_merge(
			$sections['chat'], array(
				'white_label' => __( 'White Label', $this->plugin_name ),
			)
		);

		return $sections;

	}

	/**
	 * Random Phones fields HTML output
	 *
	 * @since    2.0.0
	 * @param    string $output       current field output.
	 * @param    string $field_id     current field id.
	 * @param    array  $settings     current whatsappme settings.
	 * @return   string
	 */
	public function fields_output( $output, $field_id, $settings ) {

		if ( 'telephone' === $field_id ) {

			// Enqueue assets
			wp_enqueue_script( $this->plugin_name );
			wp_enqueue_style( $this->plugin_name );

			$phone  = isset( $settings['telephone'] ) ? $settings['telephone'] : '';
			$phones = isset( $settings['random_phones'] ) ? $settings['random_phones'] : array();

			$name = strpos( $output, 'data-name' ) !== false ? 'data-name' : 'name';
			// Try to disable Chrome autocomplete and autofill phone fields
			$autocomplete = 'autocomplete="off_' . substr( str_shuffle( md5( mt_rand() ) ), 0, 10 ) . '"';

			$output = '<input id="whatsappme_phone_0" ' . $name . '="whatsappme[telephone][0]" value="' . $phone . '" type="text" ' . $autocomplete . '>';

			if ( count( $phones ) ) {
				foreach ( $phones as $key => $value ) {
					$count   = $key + 1;
					$output .= "<br><input id=\"whatsappme_phone_$count\" $name=\"whatsappme[telephone][$count]\" value=\"$value\" type=\"text\" $autocomplete>";
				}
			}

			$output .= '<a id="wame-random-phome-add" href="#" class="dashicons dashicons-plus-alt" role="button" title="' . __( 'Add phone number', $this->plugin_name ) . '"></a>' .
				'<p class="description">' . __( 'Contact phone numbers <strong>(users will contact one of them randomly)</strong>', $this->plugin_name ) . '</p>';

		} elseif ( 'white_label' === $field_id ) {

			$value = isset( $settings['white_label'] ) ? $settings['white_label'] : '';

			$output = '<fieldset><legend class="screen-reader-text"><span>' . __( 'White Label', $this->plugin_name ) . '</span></legend>' .
				'<label><input id="whatsappme_white_label" name="whatsappme[white_label]" value="yes" type="checkbox"' . checked( 'yes', $value, false ) . '> ' .
				__( 'Remove "Powered by WAme" link', $this->plugin_name ) . '</label></fieldset>';

		}

		return $output;

	}

	/**
	 * Random Phone settings validation
	 *
	 * @since    2.0.0
	 * @param    array $input       form input.
	 * @return   array
	 */
	public function settings_validate( $input ) {

		$input['white_label'] = isset( $input['white_label'] ) ? 'yes' : 'no';

		if ( is_array( $input['telephone'] ) ) {
			$phones                 = array_filter( $input['telephone'] );
			$input['telephone']     = array_shift( $phones );
			$input['random_phones'] = $phones;
		}

		return $input;

	}

	/**
	 * Random Phone metabox output
	 *
	 * @since    2.1.0
	 * @param    string  $output       metabox output.
	 * @param    WP_Post $post         Current post object.
	 * @return   string
	 */
	public function metabox_output( $output, $post ) {

		// Enqueue assets
		wp_enqueue_script( $this->plugin_name );
		wp_enqueue_style( $this->plugin_name );

		$replace = '<label for="whatsappme_phone_0">' . __( 'Telephone', 'creame-whatsapp-me' ) . '</label>';

		$postmeta = get_post_meta( $post->ID, '_whatsappme', true ) ?: array();

		$phones = isset( $postmeta['telephone'] ) ? array( $postmeta['telephone'] ) : array();
		if ( isset( $postmeta['random_phones'] ) ) {
			$phones = array_merge( $phones, $postmeta['random_phones'] );
		}

		$name = strpos( $output, 'data-name' ) !== false ? 'data-name' : 'name';

		if ( count( $phones ) ) {
			foreach ( $phones as $key => $value ) {
				$replace .= "<br><input id=\"whatsappme_phone_$key\" $name=\"whatsappme_telephone[$key]\" value=\"$value\" type=\"text\" autocomplete=\"off\">";
			}
		} else {
			$replace .= "<br><input id=\"whatsappme_phone_0\" $name=\"whatsappme_telephone[0]\" value=\"\" type=\"text\" autocomplete=\"off\">";
		}

		$replace .= '<a id="wame-random-phome-add" href="#" class="dashicons dashicons-plus-alt" role="button" title="' . __( 'Add phone number', $this->plugin_name ) . '"></a>';

		// Replace phone input
		$from   = strpos( $output, '<label for="whatsappme_phone">' );
		$length = strpos( $output, '</p>', $from ) - $from;
		$output = substr_replace( $output, $replace, $from, $length );

		return $output;

	}

	/**
	 * Split telephone array in to first phone number
	 * and other number as extra random_phones
	 *
	 * @since    2.1.0
	 * @param    array $metadata         _whatsappme data to save.
	 * @return   array
	 */
	public function metabox_save( $metadata ) {

		if ( isset( $metadata['telephone'] ) && is_array( $metadata['telephone'] ) ) {
			$phones = array_filter( $metadata['telephone'] );

			if ( count( $phones ) ) {
				$metadata['telephone'] = array_shift( $phones );
			} else {
				unset( $metadata['telephone'] );
			}

			if ( count( $phones ) ) {
				$metadata['random_phones'] = $phones;
			}
		}

		return $metadata;

	}

	/**
	 * Register the stylesheets ans scripts for the admin area
	 *
	 * @since    2.0.0
	 * @return   void
	 */
	public function register_assets() {

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . "js/{$this->plugin_name}{$min}.js", array( 'whatsappme-admin' ), $this->version, true );
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . "css/{$this->plugin_name}{$min}.css", array( 'whatsappme-admin' ), $this->version, 'all' );

	}

}
