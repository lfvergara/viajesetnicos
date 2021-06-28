<?php

if ( ! function_exists( 'roam_mikado_booking_form_general_styles' ) ) {
    /**
     * Generates general custom styles for booking form area
     */
    function roam_mikado_booking_form_general_styles() {

        $background_color   = roam_mikado_options()->getOptionValue( 'booking_form_background_color' );
        $background_pattern = roam_mikado_options()->getOptionValue( 'booking_form_background_pattern' );

        $booking_form_style = array();

        if($background_pattern !== '') {
            $booking_form_style['background-image'] = "url(".$background_pattern.")";
        }

        if($background_color !== '') {
            $booking_form_style['background-color'] = $background_color;
        }

        $booking_form_selector = array('.mkdf-tours-booking-form-holder .mkdf-boxed-widget', '.mkdf-boxed-widget.mkdf-tours-search-main-filters-holder');

        echo roam_mikado_dynamic_css( $booking_form_selector, $booking_form_style );
    }

    add_action( 'roam_mikado_style_dynamic', 'roam_mikado_booking_form_general_styles' );
}