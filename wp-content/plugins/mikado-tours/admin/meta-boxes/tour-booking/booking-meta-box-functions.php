<?php

use MikadoTours\Admin\MetaBoxes\TourBooking\TourTimeStorage;

if(!function_exists('mkdf_tours_register_booking_meta_box')) {
    function mkdf_tours_register_booking_meta_box() {
        add_meta_box(
            'mkdf-tours-booking-meta-box',
            esc_html__('Mikado Tour Booking', 'mkdf-tours'),
            'mkdf_tours_register_booking_meta_box_callback',
            'tour-item',
            'advanced',
            'high'
        );
    }

    add_action('add_meta_boxes', 'mkdf_tours_register_booking_meta_box');
}

if(!function_exists('mkdf_tours_register_booking_meta_box_callback')) {
    function mkdf_tours_register_booking_meta_box_callback() {
        global $post;

        $rows = empty($post->ID) ? array() : TourTimeStorage::getInstance()->getTourDates($post->ID);

        $first_half_week = array(
            'Mon' => esc_html__('Lunes', 'mkdf-tours'),
            'Tue' => esc_html__('Martes', 'mkdf-tours'),
            'Wed' => esc_html__('Miercoles', 'mkdf-tours'),
            'Thu' => esc_html__('Jueves', 'mkdf-tours')
        );

        $second_half_week = array(
            'Fri' => esc_html__('Viernes', 'mkdf-tours'),
            'Sat' => esc_html__('Sábado', 'mkdf-tours'),
            'Sun' => esc_html__('Domingo', 'mkdf-tours')
        );
        
        include 'booking-meta-box.php';
    }
}