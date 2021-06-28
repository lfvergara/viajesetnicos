<?php

namespace MikadoMembership\Shortcodes\MikadoUserResetPassword;

use MikadoMembership\Lib\ShortcodeInterface;

class MikadoUserResetPassword implements ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_user_reset_password';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {}
	
	public function render( $atts, $content = null ) {
		$args = array();
		
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$html = mkdf_membership_get_shortcode_template_part( 'reset-password', 'reset-password-template', '', $params );
		
		return $html;
	}
}