<?php
/**
 * Plugin Name: Mikado Membership
 * Description: Plugin that adds social login and user dashboard page
 * Author: Mikado Themes
 * Version: 1.0.1
 */

require_once 'load.php';

if ( ! function_exists( 'mkdf_membership_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function mkdf_membership_text_domain() {
		load_plugin_textdomain( 'mkdf-membership', false, MIKADO_MEMBERSHIP_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'mkdf_membership_text_domain' );
}

if ( ! function_exists( 'mkdf_membership_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function mkdf_membership_scripts() {
		
		wp_enqueue_style( 'mkdf_membership_style', plugins_url( MIKADO_MEMBERSHIP_REL_PATH . '/assets/css/membership.min.css' ) );
		wp_enqueue_style( 'mkdf_membership_responsive_style', plugins_url( MIKADO_MEMBERSHIP_REL_PATH . '/assets/css/membership-responsive.min.css' ) );
		
		//include google+ api
		wp_enqueue_script( 'mkdf_membership_google_plus_api', 'https://apis.google.com/js/platform.js', array(), null, false );
		
		$array_deps = array(
			'underscore',
			'jquery-ui-tabs'
		);
		if ( mkdf_membership_theme_installed() ) {
			$array_deps[] = 'roam_mikado_modules';
		}
		wp_enqueue_script( 'mkdf_membership_script', plugins_url( MIKADO_MEMBERSHIP_REL_PATH . '/assets/js/membership.min.js' ), $array_deps, false, true );
	}
	
	add_action( 'wp_enqueue_scripts', 'mkdf_membership_scripts' );
}