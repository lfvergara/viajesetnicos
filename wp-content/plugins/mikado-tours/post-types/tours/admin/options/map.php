<?php

if(!function_exists('mkdf_tours_tour_options_map')) {

	function mkdf_tours_tour_options_map() {

		roam_mikado_add_admin_page(array(
			'slug'  => '_tours_page',
			'title' => esc_html__('Tours', 'mkdf-tours'),
			'icon'  => 'fa fa-camera-retro'
		));

		/*Tour Single panel*/
		$panel_single = roam_mikado_add_admin_panel(array(
			'title' => esc_html__('Tour Single', 'mkdf-tours'),
			'name'  => 'panel_single',
			'page'  => '_tours_page'
		));

		roam_mikado_add_admin_field(
			array(
				'name'          => 'tours_enable_full_screen_title_area',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Enable Full Screen Title Area on Tour Single Pages', 'mkdf-tours'),
				'description'   => esc_html__('This option will enable/disable full screen title area on tour single pages', 'mkdf-tours'),
				'parent'        => $panel_single,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_show_title_full_width_container"
				)
			)
		);

		$show_title_full_width_container = roam_mikado_add_admin_container(
			array(
				'parent'          => $panel_single,
				'name'            => 'show_title_full_width_container',
				'hidden_property' => 'tours_enable_full_screen_title_area',
				'hidden_value'    => 'no'
			)
		);

		roam_mikado_add_admin_field(array(
			'name'          => 'tours_title_skin',
			'type'          => 'select',
			'default_value' => '',
			'label'         => esc_html__('Title Area Skin', 'mkdf-tours'),
			'description'   => esc_html__('Choose title area skin', 'mkdf-tours'),
			'parent'        => $show_title_full_width_container,
			'options'       => array(
				'' => esc_html__('Default', 'mkdf-tours'),
				'dark' => esc_html__('Dark', 'mkdf-tours'),
				'light' => esc_html__('Light', 'mkdf-tours'),
			)
		));

		roam_mikado_add_admin_field(
			array(
				'name'          => 'tours_enable_custom_separator_title_area',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Enable Custom Separator on Title Area', 'mkdf-tours'),
				'description'   => esc_html__('This option will enable/disable custom separator on title area', 'mkdf-tours'),
				'parent'        => $show_title_full_width_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_custom_separator_container"
				)
			)
		);

		$custom_separator_container = roam_mikado_add_admin_container(
			array(
				'parent'          => $panel_single,
				'name'            => 'custom_separator_container',
				'hidden_property' => 'tours_enable_custom_separator_title_area',
				'hidden_value'    => 'no'
			)
		);

		roam_mikado_add_admin_field(
			array(
				'name'          => 'tours_single_title_separator',
				'type'          => 'image',
				'default_value' => MIKADO_TOURS_ASSETS_URL_PATH . "/img/separator.png",
				'label'         => esc_html__( 'Separator Image', 'roam' ),
				'parent'        => $custom_separator_container
			)
		);

		/*Payment panel*/
		$panel_payment = roam_mikado_add_admin_panel(array(
			'title' => esc_html__('Payment', 'mkdf-tours'),
			'name'  => 'panel_payment',
			'page'  => '_tours_page'
		));

		roam_mikado_add_admin_section_title(array(
			'parent' => $panel_payment,
			'name'   => 'paypal_section_title',
			'title'  => esc_html__('PayPal', 'mkdf-tours')
		));

		roam_mikado_add_admin_field(
			array(
				'name'          => 'tours_enable_paypal',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Enable Paypal', 'mkdf-tours'),
				'description'   => esc_html__('This option will enable/disable Paypal payment', 'mkdf-tours'),
				'parent'        => $panel_payment,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_show_paypal_container"
				)
			)
		);

		$show_paypal_container = roam_mikado_add_admin_container(
			array(
				'parent'          => $panel_payment,
				'name'            => 'show_paypal_container',
				'hidden_property' => 'tours_enable_paypal',
				'hidden_value'    => 'no'
			)
		);

		roam_mikado_add_admin_field(array(
			'name'          => 'paypal_facilitator_id',
			'type'          => 'text',
			'default_value' => '',
			'label'         => esc_html__('Account ID', 'mkdf-tours'),
			'description'   => esc_html__('Insert Business Account ID (Email)', 'mkdf-tours'),
			'parent'        => $show_paypal_container
		));

		roam_mikado_add_admin_field(array(
			'name'          => 'paypal_currency',
			'type'          => 'select',
			'default_value' => 'USD',
			'label'         => esc_html__('Currency', 'mkdf-tours'),
			'description'   => esc_html__('Payment Currency', 'mkdf-tours'),
			'parent'        => $show_paypal_container,
			'options'       => array(
				'USD' => esc_html__('U.S. Dollar', 'mkdf-tours'),
				'EUR' => esc_html__('Euro', 'mkdf-tours'),
				'GBP' => esc_html__('Pound Sterling', 'mkdf-tours'),
				'AUD' => esc_html__('Australian Dollar', 'mkdf-tours'),
				'CHF' => esc_html__('Swiss Franc', 'mkdf-tours'),
				'BRL' => esc_html__('Brazilian Real', 'mkdf-tours'),
				'CAD' => esc_html__('Canadian Dollar', 'mkdf-tours'),
				'CZK' => esc_html__('Czech Koruna', 'mkdf-tours'),
				'DKK' => esc_html__('Danish Krone', 'mkdf-tours'),
				'HKD' => esc_html__('Hong Kong Dollar', 'mkdf-tours'),
				'HUF' => esc_html__('Hungarian Forint', 'mkdf-tours'),
				'ILS' => esc_html__('Israeli New Sheqel', 'mkdf-tours'),
				'JPY' => esc_html__('Japanese Yen', 'mkdf-tours'),
				'MYR' => esc_html__('Malaysian Ringgit', 'mkdf-tours'),
				'MXN' => esc_html__('Mexican Peso', 'mkdf-tours'),
				'NOK' => esc_html__('Norwegian Krone', 'mkdf-tours'),
				'NZD' => esc_html__('New Zealand Dollar', 'mkdf-tours'),
				'PHP' => esc_html__('Philippine Peso', 'mkdf-tours'),
				'PLN' => esc_html__('Polish Zloty', 'mkdf-tours'),
				'SGD' => esc_html__('Singapore Dollar', 'mkdf-tours'),
				'SEK' => esc_html__('Swedish Krona', 'mkdf-tours'),
				'TWD' => esc_html__('Taiwan New Dollar', 'mkdf-tours'),
				'THB' => esc_html__('Thai Baht', 'mkdf-tours'),
				'TRY' => esc_html__('Turkish Lira', 'mkdf-tours')
			)
		));

		$settings_panel = roam_mikado_add_admin_panel(array(
			'title' => esc_html__('Settings', 'mkdf-tours'),
			'name'  => 'panel_settings',
			'page'  => '_tours_page'
		));
		
		$checkout_pages = mkdf_tours_get_checkout_pages(true);

		roam_mikado_add_admin_field(array(
			'name'          => 'tours_checkout_page',
			'type'          => 'select',
			'default_value' => '',
			'label'         => esc_html__('Checkout Page', 'mkdf-tours'),
			'description'   => esc_html__('Choose checkout page', 'mkdf-tours'),
			'parent'        => $settings_panel,
			'options'       => $checkout_pages,
			'args'          => array(
				'col_width' => 3
			)
		));

		roam_mikado_add_admin_field(array(
			'name'          => 'tours_currency_symbol',
			'type'          => 'text',
			'default_value' => '',
			'label'         => esc_html__('Price Currency', 'mkdf-tours'),
			'description'   => esc_html__('Insert currency for tour prices', 'mkdf-tours'),
			'parent'        => $settings_panel,
			'args'          => array(
				'col_width' => '3'
			)
		));

		roam_mikado_add_admin_field(array(
			'name'          => 'tours_currency_symbol_position',
			'type'          => 'select',
			'default_value' => 'left',
			'label'         => esc_html__('Price Currency Position', 'mkdf-tours'),
			'description'   => esc_html__('Choose position for your currency symbol', 'mkdf-tours'),
			'parent'        => $settings_panel,
			'options'       => array(
				'left'  => esc_html__('Left', 'mkdf-tours'),
				'right' => esc_html__('Right', 'mkdf-tours')
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		$search_pages = mkdf_tours_get_search_pages(true);

		$search_panel = roam_mikado_add_admin_panel(array(
			'title' => esc_html__('Search Page', 'mkdf-tours'),
			'name'  => 'panel_search',
			'page'  => '_tours_page'
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_main_page',
			'default_value' => '',
			'label'         => esc_html__('Main Search Page', 'mkdf-tours'),
			'description'   => esc_html__('Choose main search page. Defaults to tour item archive page', 'mkdf-tours'),
			'options'       => $search_pages,
			'args'          => array(
				'col_width' => 3
			)
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'text',
			'name'          => 'tours_per_page',
			'default_value' => 12,
			'label'         => esc_html__('Items per Page', 'mkdf-tours'),
			'description'   => esc_html__('Choose number of tour items per page', 'mkdf-tours'),
			'args'          => array(
				'col_width' => 3
			)
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_default_view_type',
			'default_value' => 'list',
			'label'         => esc_html__('Default Tour View Type', 'mkdf-tours'),
			'description'   => esc_html__('Choose default tour view type', 'mkdf-tours'),
			'options'       => array(
				'list'     => esc_html__('List', 'mkdf-tours'),
				'standard' => esc_html__('Standard', 'mkdf-tours'),
				'gallery'  => esc_html__('Gallery', 'mkdf-tours'),
				'revealing'  => esc_html__('Revealing Info', 'mkdf-tours'),
				'gallery-simple'  => esc_html__('Gallery Simple', 'mkdf-tours')
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_panel,
			'type'          => 'select',
			'name'          => 'tours_search_default_ordering',
			'default_value' => 'date',
			'label'         => esc_html__('Default Tour Ordering', 'mkdf-tours'),
			'description'   => esc_html__('Choose default tour ordering', 'mkdf-tours'),
			'options'       => array(
				'date'       => esc_html__('Date', 'mkdf-tours'),
				'price_low'  => esc_html__('Price Low to High', 'mkdf-tours'),
				'price_high' => esc_html__('Price High to Low', 'mkdf-tours'),
				'name'       => esc_html__('Name', 'mkdf-tours')
			),
			'args'          => array(
				'col_width' => 3
			)
		));

		/*Standard Item Style*/
		$search_standard_group = roam_mikado_add_admin_group(
			array(
				'name'        => 'search_standard_group',
				'title'       => esc_html__( 'Standard Style', 'roam' ),
				'description' => esc_html__( 'Define styles for standard item type', 'roam' ),
				'parent'      => $search_panel
			)
		);
		
		$search_standard_row = roam_mikado_add_admin_row(
			array(
				'name'   => 'search_standard_row',
				'parent' => $search_standard_group
			)
		);

		roam_mikado_add_admin_field(array(
			'parent'        => $search_standard_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_standard_title_tag',
			'default_value' => 'h4',
			'label'         => esc_html__('Title Tag', 'mkdf-tours'),
			'options'       => roam_mikado_get_title_tag()
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_standard_row,
			'type'          => 'textsimple',
			'name'          => 'tours_standard_text_length',
			'default_value' => 55,
			'label'         => esc_html__('Item Text Length', 'mkdf-tours')
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_standard_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_standard_thumb_size',
			'default_value' => 'full',
			'label'         => esc_html__('Thumbnail Size', 'mkdf-tours'),
			'options'       => array(
				'full'               => esc_html__('Full', 'mkdf-tours'),
				'roam_mikado_landscape' => esc_html__('Landscape', 'mkdf-tours'),
				'roam_mikado_portrait'  => esc_html__('Portrait', 'mkdf-tours'),
				'roam_mikado_square'    => esc_html__('Square', 'mkdf-tours')
			),
			'args'          => array(
				'col_width' => 3
			)
		));


		/*Gallery Item Style*/
		$search_gallery_group = roam_mikado_add_admin_group(
			array(
				'name'        => 'search_gallery_group',
				'title'       => esc_html__( 'Gallery Style', 'roam' ),
				'description' => esc_html__( 'Define styles for gallery item type', 'roam' ),
				'parent'      => $search_panel
			)
		);
		
		$search_gallery_row = roam_mikado_add_admin_row(
			array(
				'name'   => 'search_gallery_row',
				'parent' => $search_gallery_group
			)
		);

		roam_mikado_add_admin_field(array(
			'parent'        => $search_gallery_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_gallery_title_tag',
			'default_value' => 'h4',
			'label'         => esc_html__('Title Tag', 'mkdf-tours'),
			'options'       => roam_mikado_get_title_tag()
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_gallery_row,
			'type'          => 'textsimple',
			'name'          => 'tours_gallery_text_length',
			'default_value' => 55,
			'label'         => esc_html__('Item Text Length', 'mkdf-tours')
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_gallery_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_gallery_thumb_size',
			'default_value' => 'full',
			'options'       => array(
				'full'               => esc_html__('Full', 'mkdf-tours'),
				'roam_mikado_landscape' => esc_html__('Landscape', 'mkdf-tours'),
				'roam_mikado_portrait'  => esc_html__('Portrait', 'mkdf-tours'),
				'roam_mikado_square'    => esc_html__('Square', 'mkdf-tours')
			),
			'label'         => esc_html__('Thumbnail Size', 'mkdf-tours')
		));


		/*Gallery Simple Item Style*/
		$search_gallery_simple_group = roam_mikado_add_admin_group(
			array(
				'name'        => 'search_gallery_simple_group',
				'title'       => esc_html__( 'Gallery Simple Style', 'roam' ),
				'description' => esc_html__( 'Define styles for gallery simple item type', 'roam' ),
				'parent'      => $search_panel
			)
		);
		
		$search_gallery_simple_row = roam_mikado_add_admin_row(
			array(
				'name'   => 'search_gallery_simple_row',
				'parent' => $search_gallery_simple_group
			)
		);

		roam_mikado_add_admin_field(array(
			'parent'        => $search_gallery_simple_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_gallery_simple_title_tag',
			'default_value' => 'h4',
			'label'         => esc_html__('Title Tag', 'mkdf-tours'),
			'options'       => roam_mikado_get_title_tag()
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_gallery_simple_row,
			'type'          => 'textsimple',
			'name'          => 'tours_gallery_simple_text_length',
			'default_value' => 55,
			'label'         => esc_html__('Item Text Length', 'mkdf-tours')
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_gallery_simple_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_gallery_simple_thumb_size',
			'default_value' => 'full',
			'options'       => array(
				'full'               => esc_html__('Full', 'mkdf-tours'),
				'roam_mikado_landscape' => esc_html__('Landscape', 'mkdf-tours'),
				'roam_mikado_portrait'  => esc_html__('Portrait', 'mkdf-tours'),
				'roam_mikado_square'    => esc_html__('Square', 'mkdf-tours')
			),
			'label'         => esc_html__('Thumbnail Size', 'mkdf-tours')
		));


		/*Revealing Info Item Style*/
		$search_revealing_group = roam_mikado_add_admin_group(
			array(
				'name'        => 'search_revealing_group',
				'title'       => esc_html__( 'Revealing Info Style', 'roam' ),
				'description' => esc_html__( 'Define styles for revealing info item type', 'roam' ),
				'parent'      => $search_panel
			)
		);
		
		$search_revealing_row = roam_mikado_add_admin_row(
			array(
				'name'   => 'search_revealing_row',
				'parent' => $search_revealing_group
			)
		);

		roam_mikado_add_admin_field(array(
			'parent'        => $search_revealing_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_revealing_title_tag',
			'default_value' => 'h4',
			'label'         => esc_html__('Title Tag', 'mkdf-tours'),
			'options'       => roam_mikado_get_title_tag()
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_revealing_row,
			'type'          => 'textsimple',
			'name'          => 'tours_revealing_text_length',
			'default_value' => 55,
			'label'         => esc_html__('Item Text Length', 'mkdf-tours')
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_revealing_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_revealing_thumb_size',
			'default_value' => 'full',
			'options'       => array(
				'full'               => esc_html__('Full', 'mkdf-tours'),
				'roam_mikado_landscape' => esc_html__('Landscape', 'mkdf-tours'),
				'roam_mikado_portrait'  => esc_html__('Portrait', 'mkdf-tours'),
				'roam_mikado_square'    => esc_html__('Square', 'mkdf-tours')
			),
			'label'         => esc_html__('Thumbnail Size', 'mkdf-tours')
		));


		/*List Item Style*/
		$search_list_group = roam_mikado_add_admin_group(
			array(
				'name'        => 'search_list_group',
				'title'       => esc_html__( 'List Style', 'roam' ),
				'description' => esc_html__( 'Define styles for list item type', 'roam' ),
				'parent'      => $search_panel
			)
		);
		
		$search_list_row = roam_mikado_add_admin_row(
			array(
				'name'   => 'search_list_row',
				'parent' => $search_list_group
			)
		);

		roam_mikado_add_admin_field(array(
			'parent'        => $search_list_row,
			'type'          => 'selectsimple',
			'name'          => 'tours_list_title_tag',
			'default_value' => 'h4',
			'label'         => esc_html__('Title Tag', 'mkdf-tours'),
			'options'       => roam_mikado_get_title_tag()
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $search_list_row,
			'type'          => 'textsimple',
			'name'          => 'tours_list_text_length',
			'default_value' => 55,
			'label'         => esc_html__('Item Text Length', 'mkdf-tours')
		));

		$reviews_panel = roam_mikado_add_admin_panel(array(
			'title' => esc_html__('Reviews', 'mkdf-tours'),
			'name'  => 'panel_reviews',
			'page'  => '_tours_page'
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $reviews_panel,
			'type'          => 'text',
			'name'          => 'reviews_section_title',
			'default_value' => '',
			'label'         => esc_html__('Reviews Section Title', 'mkdf-tours'),
			'description'   => esc_html__('Enter title that you want to show before average rating for each tour', 'mkdf-tours'),
		));

		roam_mikado_add_admin_field(array(
			'parent'        => $reviews_panel,
			'type'          => 'text',
			'name'          => 'reviews_section_subtitle',
			'default_value' => '',
			'label'         => esc_html__('Reviews Section Subtitle', 'mkdf-tours'),
			'description'   => esc_html__('Enter subtitle that you want to show before average rating for each tour', 'mkdf-tours'),
		));

        roam_mikado_add_admin_field(array(
            'parent'        => $reviews_panel,
            'type'          => 'textarea',
            'name'          => 'reviews_section_excerpt',
            'default_value' => '',
            'label'         => esc_html__('Reviews Section Excerpt', 'mkdf-tours'),
            'description'   => esc_html__('Enter excerpt that you want to show before average rating for each tour', 'mkdf-tours'),
        ));
		
		$panel_admin_email = roam_mikado_add_admin_panel(array(
			'title' => esc_html__('Admin Booking Email', 'mkdf-tours'),
			'name'  => 'admin_email',
			'page'  => '_tours_page'
		));
		
		roam_mikado_add_admin_field(array(
			'parent'        => $panel_admin_email,
			'type'          => 'yesno',
			'name'          => 'enable_admin_booking_email',
			'default_value' => 'yes',
			'label'         => esc_html__('Should Admin Receive Booking Emails?', 'mkdf-tours'),
			'description'   => esc_html__('Enabling this option will forward all booking emails to the site administrator’s inbox', 'mkdf-tours'),
			'args'          => array(
				"dependence"             => true,
				"dependence_hide_on_yes" => "",
				"dependence_show_on_yes" => "#mkdf_show_admin_email_container"
			)
		));
		
		$show_admin_email_container = roam_mikado_add_admin_container(
			array(
				'parent'          => $panel_admin_email,
				'name'            => 'show_admin_email_container',
				'hidden_property' => 'admin_email_enable',
				'hidden_value'    => 'no'
			)
		);
		
		roam_mikado_add_admin_field(array(
			'name'          => 'admin_email',
			'type'          => 'text',
			'default_value' => '',
			'label'         => esc_html__('Admin Email', 'mkdf-tours'),
			'description'   => esc_html__('Input the site administrator’s email address. If you leave this field empty, booking emails will be sent to the default admin’s email address', 'mkdf-tours'),
			'parent'        => $show_admin_email_container
		));

        $booking_form_pattern_panel = roam_mikado_add_admin_panel(array(
            'title' => esc_html__('Booking Form', 'mkdf-tours'),
            'name'  => 'panel_booking_form_pattern',
            'page'  => '_tours_page'
        ));

        roam_mikado_add_admin_field(array(
            'parent'        => $booking_form_pattern_panel,
            'type'          => 'image',
            'name'          => 'booking_form_background_pattern',
            'default_value' => '',
            'label'         => esc_html__('Background Pattern Image', 'mkdf-tours'),
            'description'   => esc_html__('Choose background pattern image for booking forms', 'mkdf-tours'),
        ));

        roam_mikado_add_admin_field(array(
            'parent'        => $booking_form_pattern_panel,
            'type'          => 'color',
            'name'          => 'booking_form_background_color',
            'default_value' => '',
            'label'         => esc_html__('Background Color', 'mkdf-tours'),
            'description'   => esc_html__('Choose background color for booking forms', 'mkdf-tours'),
        ));
	}

	add_action('roam_mikado_options_map', 'mkdf_tours_tour_options_map', 11);
}