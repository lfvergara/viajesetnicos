<?php

if ( ! function_exists( 'mkdf_core_team_meta_box_functions' ) ) {
	function mkdf_core_team_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'roam_mikado_meta_box_post_types_save', 'mkdf_core_team_meta_box_functions' );
	add_filter( 'roam_mikado_meta_box_post_types_remove', 'mkdf_core_team_meta_box_functions' );
}

if ( ! function_exists( 'mkdf_core_team_scope_meta_box_functions' ) ) {
	function mkdf_core_team_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'roam_mikado_set_scope_for_meta_boxes', 'mkdf_core_team_scope_meta_box_functions' );
}

if ( ! function_exists( 'mkdf_core_team_enqueue_meta_box_styles' ) ) {
	function mkdf_core_team_enqueue_meta_box_styles() {
		global $post;
		
		if ( $post->post_type == 'team-member' ) {
			wp_enqueue_style( 'mkdf-jquery-ui', get_template_directory_uri() . '/framework/admin/assets/css/jquery-ui/jquery-ui.css' );
		}
	}
	
	add_action( 'roam_mikado_enqueue_meta_box_styles', 'mkdf_core_team_enqueue_meta_box_styles' );
}

if ( ! function_exists( 'mkdf_core_register_team_cpt' ) ) {
	function mkdf_core_register_team_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'MikadoCore\CPT\Team\TeamRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'mkdf_core_filter_register_custom_post_types', 'mkdf_core_register_team_cpt' );
}

if ( ! function_exists( 'mkdf_core_get_single_team' ) ) {
	/**
	 * Loads holder template for doctor single
	 */
	function mkdf_core_get_single_team() {
		$team_member_id = get_the_ID();
		
		$params = array(
			'sidebar_layout' => roam_mikado_sidebar_layout(),
			'position'       => get_post_meta( $team_member_id, 'mkdf_team_member_position', true ),
			'birth_date'     => get_post_meta( $team_member_id, 'mkdf_team_member_birth_date', true ),
			'email'          => get_post_meta( $team_member_id, 'mkdf_team_member_email', true ),
			'phone'          => get_post_meta( $team_member_id, 'mkdf_team_member_phone', true ),
			'address'        => get_post_meta( $team_member_id, 'mkdf_team_member_address', true ),
			'education'      => get_post_meta( $team_member_id, 'mkdf_team_member_education', true ),
			'resume'         => get_post_meta( $team_member_id, 'mkdf_team_member_resume', true ),
			'social_icons'   => mkdf_core_single_team_social_icons( $team_member_id ),
		);
		
		mkdf_core_get_cpt_single_module_template_part( 'templates/single/holder', 'team', '', $params );
	}
}

if ( ! function_exists( 'mkdf_core_single_team_social_icons' ) ) {
	function mkdf_core_single_team_social_icons( $id ) {
		$social_icons = array();
		
		for ( $i = 1; $i < 6; $i ++ ) {
			$team_icon_pack = get_post_meta( $id, 'mkdf_team_member_social_icon_pack_' . $i, true );
			if ( $team_icon_pack !== '' ) {
				$team_icon_collection = roam_mikado_icon_collections()->getIconCollection( get_post_meta( $id, 'mkdf_team_member_social_icon_pack_' . $i, true ) );
				$team_social_icon     = get_post_meta( $id, 'mkdf_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true );
				$team_social_link     = get_post_meta( $id, 'mkdf_team_member_social_icon_' . $i . '_link', true );
				$team_social_target   = get_post_meta( $id, 'mkdf_team_member_social_icon_' . $i . '_target', true );
				
				if ( $team_social_icon !== '' ) {
					$team_icon_params                                 = array();
					$team_icon_params['icon_pack']                    = $team_icon_pack;
					$team_icon_params[ $team_icon_collection->param ] = $team_social_icon;
					$team_icon_params['link']                         = ! empty( $team_social_link ) ? $team_social_link : '';
					$team_icon_params['target']                       = ! empty( $team_social_target ) ? $team_social_target : '_self';
					
					$social_icons[] = roam_mikado_execute_shortcode( 'mkdf_icon', $team_icon_params );
				}
			}
		}
		
		return $social_icons;
	}
}

if ( ! function_exists( 'mkdf_core_get_team_category_list' ) ) {
	function mkdf_core_get_team_category_list( $category = '' ) {
		$number_of_columns = 3;
		
		$params = array(
			'number_of_columns' => $number_of_columns
		);
		
		if ( ! empty( $category ) ) {
			$params['category'] = $category;
		}
		
		$html = roam_mikado_execute_shortcode( 'mkdf_team_list', $params );
		
		print $html;
	}
}

if ( ! function_exists( 'mkdf_core_add_team_to_search_types' ) ) {
	function mkdf_core_add_team_to_search_types( $post_types ) {
		$post_types['team-member'] = 'Team Member';
		
		return $post_types;
	}
	
	add_filter( 'roam_mikado_search_post_type_widget_params_post_type', 'mkdf_core_add_team_to_search_types' );
}