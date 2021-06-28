<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version and init hooks to
 * enqueue the public-specific functionalities.
 *
 * @since      2.0.0
 * @package    WAmeRandomPhone
 * @author     Creame <hola@crea.me>
 */
class WAmeRandomPhonePublic {

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
	 * There is random phones.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      bool      $phones    Store if the are defined random phones.
	 */
	private $phones;

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
		$this->phones      = false;

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
		$loader->add_filter( 'whatsappme_get_settings', $this, 'get_settings', 10, 2 );

		$loader->add_action( 'wp_enqueue_scripts', $this, 'enqueue_scripts' );

	}

	/**
	 * Add Random Phone settings defaults
	 *
	 * @since    2.0.0
	 * @param    array $settings       current settings.
	 * @return   array
	 */
	public function extra_settings( $settings ) {

		$extra_settings = array(
			'random_phones' => array(),
			'white_label'   => 'no',
		);

		return array_merge( $settings, $extra_settings );

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
	 * Prepare Random Phone settings
	 *
	 * @since    2.0.0
	 * @param    array $settings       current settings.
	 * @return   array
	 */
	public function get_settings( $settings, $obj ) {

		// If there is a post custom phone, don't apply site random phones
		$post_settings = is_a( $obj, 'WP_Post' ) ? get_post_meta( $obj->ID, '_whatsappme', true ) : '';

		if ( isset( $post_settings['telephone'] ) && ! isset( $post_settings['random_phones'] ) ) {
			$settings['random_phones'] = array();
		}

		if ( count( $settings['random_phones'] ) ) {
			// Clean random phones
			foreach ( $settings['random_phones'] as $key => $phone ) {
				$settings['random_phones'][ $key ] = preg_replace( '/^0+|\D/', '', $phone );
			}

			$settings['random_phones'] = array_merge( array( $settings['telephone'] ), $settings['random_phones'] );

			// Set there are random phones
			$this->phones = true;
		} else {
			// Clear empty random phones
			unset( $settings['random_phones'] );
		}

		// Apply white label and clear setting
		if ( isset( $settings['white_label'] ) && 'yes' == $settings['white_label'] ) {
			add_filter( 'whatsappme_copy', '__return_false' );
		}
		unset( $settings['white_label'] );

		return $settings;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {

		if ( $this->phones && wp_script_is( 'whatsappme', 'enqueued' ) ) {

			$script = $this->plugin_name . ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' ) . '.js';
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/' . $script, array( 'jquery' ), $this->version, true );

		}

	}
}
