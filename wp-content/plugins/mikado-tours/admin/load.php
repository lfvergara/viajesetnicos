<?php

require_once 'meta-boxes/tour-booking/tour-time-storage.php';

//load admin
if(!function_exists('mkdf_tours_load_admin')) {
    function mkdf_tours_load_admin() {
        require_once 'meta-boxes/tour-booking/booking-meta-box-functions.php';
    }

    add_action('roam_mikado_before_options_map', 'mkdf_tours_load_admin');
}

require_once 'functions.php';
require_once 'booking-dashboard/booking-table.php';
require_once 'booking-dashboard/booking-dashboard.php';