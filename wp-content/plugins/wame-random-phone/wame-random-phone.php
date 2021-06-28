<?php
/*
Plugin Name: WAme Random Phone
Plugin URI: https://wame.chat/en/addons/random-phone-addon/
Description: Links <a href="https://wordpress.org/plugins/creame-whatsapp-me/">WAme chat</a> to a random phone from a list of phone numbers.
Version: 2.1.0
Author: Creame
Author URI: https://crea.me
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

defined( 'WPINC' ) || exit;


add_action( 'plugins_loaded', 'wame_random_phone_load_plugin' );

/**
 * Initialize plugin
 *
 * Load text domain, check dependencies and start admin or public functionalities
 *
 * @since    2.0.0
 * @return   void
 */
function wame_random_phone_load_plugin() {

	$plugin_name           = 'wame-random-phone';
	$plugin_version        = '2.1.0';
	$wame_version_required = '3.0.1';

	// Load plugin translations
	load_plugin_textdomain( $plugin_name, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	if ( ! defined( 'WHATSAPPME_VERSION' ) ) {

		add_action( 'admin_notices', 'wame_random_phone_wame_required' );

	} elseif ( ! version_compare( WHATSAPPME_VERSION, $wame_version_required, '>=' ) ) {

		add_action( 'admin_notices', 'wame_random_phone_wame_out_of_date' );

	} else {

		require plugin_dir_path( __FILE__ ) . 'admin/class-wame-random-phone-admin.php';
		require plugin_dir_path( __FILE__ ) . 'public/class-wame-random-phone-public.php';

		if ( is_admin() ) {
			new WAmeRandomPhoneAdmin( $plugin_name, $plugin_version );
		} else {
			new WAmeRandomPhonePublic( $plugin_name, $plugin_version );
		}
	}

}

/**
 * WAme required admin notice
 *
 * @since    2.0.0
 * @return   void
 */
function wame_random_phone_wame_required() {
	echo '<div class="error"><p>' . __( 'You need to install and activate <strong>WAme chat</strong> in order to use <strong>WAme Random Phone</strong>', 'wame-random-phone' ) . '</p></div>';
}

/**
 * WAme outdated admin notice
 *
 * @since    2.0.0
 * @return   void
 */
function wame_random_phone_wame_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'creame-whatsapp-me/whatsappme.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message      = '<p>' . __( '<strong>WAme Random Phone</strong> require a newer version of <strong>WAme chat</strong>.', 'wame-random-phone' ) .
	sprintf( ' <a href="%s">%s</a>', $upgrade_link, __( 'Update now', 'wame-random-phone' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}
