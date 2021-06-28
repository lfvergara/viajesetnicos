<?php

if(!function_exists('mkdf_core_map_team_single_meta')) {
    function mkdf_core_map_team_single_meta() {

        $meta_box = roam_mikado_add_meta_box(array(
            'scope' => 'team-member',
            'title' => esc_html__('Team Member Info', 'mkdf-core'),
            'name'  => 'team_meta'
        ));

        roam_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_team_member_position',
            'type'        => 'text',
            'label'       => esc_html__('Position', 'mkdf-core'),
            'description' => esc_html__('The members\'s role within the team', 'mkdf-core'),
            'parent'      => $meta_box
        ));

        roam_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_team_member_birth_date',
            'type'        => 'date',
            'label'       => esc_html__('Birth date', 'mkdf-core'),
            'description' => esc_html__('The members\'s birth date', 'mkdf-core'),
            'parent'      => $meta_box
        ));

        roam_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_team_member_email',
            'type'        => 'text',
            'label'       => esc_html__('Email', 'mkdf-core'),
            'description' => esc_html__('The members\'s email', 'mkdf-core'),
            'parent'      => $meta_box
        ));

        roam_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_team_member_phone',
            'type'        => 'text',
            'label'       => esc_html__('Phone', 'mkdf-core'),
            'description' => esc_html__('The members\'s phone', 'mkdf-core'),
            'parent'      => $meta_box
        ));

        roam_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_team_member_address',
            'type'        => 'text',
            'label'       => esc_html__('Address', 'mkdf-core'),
            'description' => esc_html__('The members\'s addres', 'mkdf-core'),
            'parent'      => $meta_box
        ));

        roam_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_team_member_education',
            'type'        => 'text',
            'label'       => esc_html__('Education', 'mkdf-core'),
            'description' => esc_html__('The members\'s education', 'mkdf-core'),
            'parent'      => $meta_box
        ));

        roam_mikado_add_meta_box_field(array(
            'name'        => 'mkdf_team_member_resume',
            'type'        => 'file',
            'label'       => esc_html__('Resume', 'mkdf-core'),
            'description' => esc_html__('Upload members\'s resume', 'mkdf-core'),
            'parent'      => $meta_box
        ));

        for($x = 1; $x < 6; $x++) {

            $social_icon_group = roam_mikado_add_admin_group(array(
                'name'   => 'mkdf_team_member_social_icon_group'.$x,
                'title'  => esc_html__('Social Link ', 'mkdf-core').$x,
                'parent' => $meta_box
            ));

                $social_row1 = roam_mikado_add_admin_row(array(
                    'name'   => 'mkdf_team_member_social_icon_row1'.$x,
                    'parent' => $social_icon_group
                ));

                    RoamMikadoIconCollections::get_instance()->getSocialIconsMetaBoxOrOption(array(
                        'label' => esc_html__('Icon ', 'mkdf-core').$x,
                        'parent' => $social_row1,
                        'name' => 'mkdf_team_member_social_icon_pack_'.$x,
                        'defaul_icon_pack' => '',
                        'type' => 'meta-box',
                        'field_type' => 'simple'
                    ));

                $social_row2 = roam_mikado_add_admin_row(array(
                    'name'   => 'mkdf_team_member_social_icon_row2'.$x,
                    'parent' => $social_icon_group
                ));

                    roam_mikado_add_meta_box_field(array(
                        'type'            => 'textsimple',
                        'label'           => esc_html__('Link', 'mkdf-core'),
                        'name'            => 'mkdf_team_member_social_icon_'.$x.'_link',
                        'hidden_property' => 'mkdf_team_member_social_icon_pack_'.$x,
                        'hidden_value'    => '',
                        'parent'          => $social_row2
                    ));
	
			        roam_mikado_add_meta_box_field(array(
				        'type'          => 'selectsimple',
				        'label'         => esc_html__('Target', 'mkdf-core'),
				        'name'          => 'mkdf_team_member_social_icon_'.$x.'_target',
				        'options'       => roam_mikado_get_link_target_array(),
				        'hidden_property' => 'mkdf_team_member_social_icon_'.$x.'_link',
				        'hidden_value'    => '',
				        'parent'          => $social_row2
			        ));
        }
    }

    add_action('roam_mikado_meta_boxes_map', 'mkdf_core_map_team_single_meta', 46);
}