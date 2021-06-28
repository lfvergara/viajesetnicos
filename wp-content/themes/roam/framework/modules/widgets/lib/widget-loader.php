<?php

if ( ! function_exists( 'roam_mikado_register_widgets' ) ) {
	function roam_mikado_register_widgets() {
		$widgets = apply_filters( 'roam_mikado_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'roam_mikado_register_widgets' );
}