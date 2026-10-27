<?php

// Fields with field_6a4a… keys came from the "About Us Page" group that used to
// live in the database, so content saved before the move still loads.
add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'    => 'group_about',
        'title'  => 'About Us Page',
        'fields' => [

            // ── Hero ──────────────────────────────
            [
                'key'          => 'field_about_hero_tab',
                'label'        => 'Hero',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The banner at the top of the page.',
            ],
            [
                'key'          => 'field_6a4a8e84610b9',
                'label'        => 'Title',
                'name'         => 'about_hero_title',
                'type'         => 'wysiwyg',
                'tabs'         => 'all',
                'toolbar'      => 'full',
                'media_upload' => 1,
            ],
            [
                'key'   => 'field_6a4a8f19610ba',
                'label' => 'Subtitle',
                'name'  => 'about_hero_sub',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_6a4a8f3f610bb',
                'label' => 'Button text',
                'name'  => 'about_promotion_button',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_6a4a989dd1343',
                'label'        => 'Button link',
                'name'         => 'about_promotion_link',
                'type'         => 'page_link',
                'instructions' => 'The button only shows when both the text and the link are set.',
            ],
            [
                'key'           => 'field_6a4a8f6d610bc',
                'label'         => 'Image',
                'name'          => 'about_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ],
            [
                'key'          => 'field_6a4a8f89610bd',
                'label'        => 'Floating badge number',
                'name'         => 'stats_bar',
                'type'         => 'text',
                'instructions' => 'The small badge on the image. Leave empty to hide it.',
            ],
            [
                'key'   => 'field_6a4a8fa1610be',
                'label' => 'Floating badge label',
                'name'  => 'stat_label',
                'type'  => 'text',
            ],

            // ── Stats bar ─────────────────────────
            [
                'key'          => 'field_about_stats_tab',
                'label'        => 'Stats bar',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The row of numbers under the hero.',
            ],
            [
                'key'          => 'field_6a4a9a097a2f9',
                'label'        => 'Stats',
                'name'         => 'stats_items',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add a stat',
                'sub_fields'   => [
                    [
                        'key'   => 'field_6a4a9a277a2fa',
                        'label' => 'Number',
                        'name'  => 'stat_number',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_6a4a9a447a2fb',
                        'label' => 'Label',
                        'name'  => 'stat_label',
                        'type'  => 'text',
                    ],
                ],
            ],

            // ── Our story ─────────────────────────
            [
                'key'          => 'field_about_story_tab',
                'label'        => 'Our story',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The image + text block under the stats.',
            ],
            [
                'key'           => 'field_6a4a9dc9335d1',
                'label'         => 'Image',
                'name'          => 'story_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ],
            [
                'key'   => 'field_6a4a9e36335d2',
                'label' => 'Badge',
                'name'  => 'story_badge',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_6a4a9e58335d3',
                'label' => 'Heading',
                'name'  => 'story_heading',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_6a4a9e75335d4',
                'label' => 'Paragraph 1',
                'name'  => 'story_paragraph_1',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_6a4a9e90335d5',
                'label' => 'Paragraph 2',
                'name'  => 'story_paragraph_2',
                'type'  => 'textarea',
            ],
            [
                'key'          => 'field_6a4a9ea3335d6',
                'label'        => 'Check items',
                'name'         => 'story_check_items',
                'type'         => 'wysiwyg',
                'tabs'         => 'all',
                'toolbar'      => 'full',
                'media_upload' => 1,
            ],

            // ── Vision & mission ──────────────────
            [
                'key'          => 'field_about_vm_tab',
                'label'        => 'Vision & mission',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The two cards. A card only shows when its title is set.',
            ],
            [
                'key'   => 'field_about_vm_title',
                'label' => 'Section heading',
                'name'  => 'vision_mission_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_vm_subtitle',
                'label' => 'Section subheading',
                'name'  => 'vision_mission_subtitle',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_about_vision_icon',
                'label'        => 'Vision icon',
                'name'         => 'vision_icon',
                'type'         => 'text',
                'instructions' => 'An emoji, e.g. 🌟',
            ],
            [
                'key'   => 'field_6a4aa1becfa9e',
                'label' => 'Vision title',
                'name'  => 'vision_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_6a4aa1eacfa9f',
                'label' => 'Vision text',
                'name'  => 'vision_content',
                'type'  => 'textarea',
            ],
            [
                'key'          => 'field_about_mission_icon',
                'label'        => 'Mission icon',
                'name'         => 'mission_icon',
                'type'         => 'text',
                'instructions' => 'An emoji, e.g. 💫',
            ],
            [
                'key'   => 'field_6a4aa1facfaa0',
                'label' => 'Mission title',
                'name'  => 'mission_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_6a4aa20acfaa1',
                'label' => 'Mission text',
                'name'  => 'mission_content',
                'type'  => 'textarea',
            ],

            // ── Values ────────────────────────────
            [
                'key'          => 'field_about_values_tab',
                'label'        => 'Values',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The "Our Values" cards.',
            ],
            [
                'key'   => 'field_about_values_title',
                'label' => 'Heading',
                'name'  => 'values_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_values_subtitle',
                'label' => 'Subheading',
                'name'  => 'values_subtitle',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_about_values_items',
                'label'        => 'Values',
                'name'         => 'values_items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add a value',
                'sub_fields'   => [
                    [
                        'key'          => 'field_about_value_icon',
                        'label'        => 'Icon',
                        'name'         => 'value_icon',
                        'type'         => 'text',
                        'instructions' => 'An emoji, e.g. 🛡️',
                    ],
                    [
                        'key'   => 'field_about_value_heading',
                        'label' => 'Heading',
                        'name'  => 'value_heading',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_about_value_description',
                        'label' => 'Description',
                        'name'  => 'value_description',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ],
                ],
            ],

            // ── Founder ───────────────────────────
            [
                'key'          => 'field_about_founder_tab',
                'label'        => 'Founder',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'Optional. The section only shows when a name or image is set.',
            ],
            [
                'key'           => 'field_about_founder_image',
                'label'         => 'Image',
                'name'          => 'founder_image',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'   => 'field_about_founder_badge',
                'label' => 'Badge',
                'name'  => 'founder_badge',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_founder_name',
                'label' => 'Heading / name',
                'name'  => 'founder_name',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_founder_role',
                'label' => 'Role',
                'name'  => 'founder_role',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_founder_paragraph_1',
                'label' => 'Paragraph 1',
                'name'  => 'founder_paragraph_1',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'field_about_founder_paragraph_2',
                'label' => 'Paragraph 2',
                'name'  => 'founder_paragraph_2',
                'type'  => 'textarea',
            ],
            [
                'key'          => 'field_about_founder_check_items',
                'label'        => 'Check items',
                'name'         => 'founder_check_items',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add an item',
                'sub_fields'   => [
                    [
                        'key'   => 'field_about_founder_check_label',
                        'label' => 'Text',
                        'name'  => 'check_label',
                        'type'  => 'text',
                    ],
                ],
            ],

            // ── Team ──────────────────────────────
            [
                'key'          => 'field_about_team_tab',
                'label'        => 'Team',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The "Meet Our Team" cards.',
            ],
            [
                'key'   => 'field_about_team_title',
                'label' => 'Heading',
                'name'  => 'team_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_team_subtitle',
                'label' => 'Subheading',
                'name'  => 'team_subtitle',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_about_team_members',
                'label'        => 'Team members',
                'name'         => 'team_members',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add a member',
                'sub_fields'   => [
                    [
                        'key'           => 'field_about_member_photo',
                        'label'         => 'Photo',
                        'name'          => 'member_photo',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                    ],
                    [
                        'key'   => 'field_about_member_name',
                        'label' => 'Name / title',
                        'name'  => 'member_name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_about_member_role',
                        'label' => 'Role',
                        'name'  => 'member_role',
                        'type'  => 'text',
                    ],
                ],
            ],

            // ── Clinic ────────────────────────────
            [
                'key'          => 'field_about_clinic_tab',
                'label'        => 'Clinic',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The "Our Clinic" photos and details.',
            ],
            [
                'key'   => 'field_about_clinic_title',
                'label' => 'Heading',
                'name'  => 'clinic_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_clinic_subtitle',
                'label' => 'Subheading',
                'name'  => 'clinic_subtitle',
                'type'  => 'text',
            ],
            [
                'key'           => 'field_about_clinic_main_image',
                'label'         => 'Main image',
                'name'          => 'clinic_main_image',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'          => 'field_about_clinic_gallery',
                'label'        => 'Small images',
                'name'         => 'clinic_gallery',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add an image',
                'instructions' => 'Shown two per row beside the main image.',
                'sub_fields'   => [
                    [
                        'key'           => 'field_about_clinic_gallery_image',
                        'label'         => 'Image',
                        'name'          => 'gallery_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                    ],
                ],
            ],
            [
                'key'   => 'field_about_clinic_address_label',
                'label' => 'Address label',
                'name'  => 'clinic_address_label',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_clinic_address_detail',
                'label' => 'Address',
                'name'  => 'clinic_address_detail',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_clinic_hours_label',
                'label' => 'Hours label',
                'name'  => 'clinic_hours_label',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_clinic_hours_detail',
                'label' => 'Hours',
                'name'  => 'clinic_hours_detail',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_clinic_mrt_label',
                'label' => 'Transport label',
                'name'  => 'clinic_mrt_label',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_clinic_mrt_detail',
                'label' => 'Transport',
                'name'  => 'clinic_mrt_detail',
                'type'  => 'text',
            ],

            // ── Treatments ────────────────────────
            [
                'key'          => 'field_about_treatments_tab',
                'label'        => 'Treatments',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The "Our Treatments" picture cards.',
            ],
            [
                'key'   => 'field_about_treatments_title',
                'label' => 'Heading',
                'name'  => 'treatments_title',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_treatments_subtitle',
                'label' => 'Subheading',
                'name'  => 'treatments_subtitle',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_about_treatment_items',
                'label'        => 'Treatments',
                'name'         => 'treatment_items',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add a treatment',
                'sub_fields'   => [
                    [
                        'key'           => 'field_about_treatment_image',
                        'label'         => 'Image',
                        'name'          => 'treatment_image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'medium',
                    ],
                    [
                        'key'   => 'field_about_treatment_name',
                        'label' => 'Name',
                        'name'  => 'treatment_name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_about_treatment_tagline',
                        'label' => 'Tagline',
                        'name'  => 'treatment_tagline',
                        'type'  => 'text',
                    ],
                    [
                        'key'          => 'field_about_treatment_link',
                        'label'        => 'Link',
                        'name'         => 'treatment_link',
                        'type'         => 'page_link',
                        'instructions' => 'Leave empty to link to the home page.',
                    ],
                ],
            ],

            // ── Call to action ────────────────────
            [
                'key'          => 'field_about_cta_tab',
                'label'        => 'Call to action',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'Optional banner at the bottom. Only shows when a heading is set.',
            ],
            [
                'key'   => 'field_about_cta_badge',
                'label' => 'Badge',
                'name'  => 'cta_badge',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_cta_heading',
                'label' => 'Heading',
                'name'  => 'cta_heading',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_about_cta_description',
                'label' => 'Text',
                'name'  => 'cta_description',
                'type'  => 'textarea',
                'rows'  => 2,
            ],
            [
                'key'   => 'field_about_cta_button_text',
                'label' => 'Button text',
                'name'  => 'cta_button_text',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_about_cta_button_link',
                'label'        => 'Button link',
                'name'         => 'cta_button_link',
                'type'         => 'page_link',
                'instructions' => 'Leave empty to link to the Contact Us page.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'template-about-page.php',
                ],
            ],
        ],
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ] );
} );
