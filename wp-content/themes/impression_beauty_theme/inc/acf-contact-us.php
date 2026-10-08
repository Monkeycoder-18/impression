<?php

add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'    => 'group_contact_us',
        'title'  => 'Contact Us',
        'fields' => [
            [
                'key'          => 'field_contact_hero_tab',
                'label'        => 'Hero',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The banner at the top of the contact page.',
            ],
            [
                'key'   => 'field_contact_hero_badge',
                'label' => 'Hero badge',
                'name'  => 'contact_hero_badge',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_contact_hero_title',
                'label' => 'Hero title',
                'name'  => 'contact_hero_title',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_contact_hero_highlight',
                'label'        => 'Highlighted words',
                'name'         => 'contact_hero_highlight',
                'type'         => 'text',
                'instructions' => 'Shown in the accent color after the hero title.',
            ],
            [
                'key'           => 'field_contact_hero_intro',
                'label'         => 'Intro text',
                'name'          => 'contact_hero_intro',
                'type'          => 'wysiwyg',
                'tabs'          => 'visual',
                'toolbar'       => 'basic',
                'media_upload'  => 0,
            ],
            [
                'key'          => 'field_contact_details_tab',
                'label'        => 'Contact details',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The column beside the form: heading, intro, and each way to reach the clinic.',
            ],
            [
                'key'   => 'field_contact_details_badge',
                'label' => 'Details badge',
                'name'  => 'contact_details_badge',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_contact_details_heading_line_1',
                'label' => 'Details heading',
                'name'  => 'contact_details_heading_line_1',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_contact_details_heading_line_2',
                'label' => 'Details heading, second line',
                'name'  => 'contact_details_heading_line_2',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_contact_details_intro',
                'label'        => 'Details intro',
                'name'         => 'contact_details_intro',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_contact_details',
                'label'        => 'Contact details',
                'name'         => 'contact_details',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add a way to reach us',
                'instructions' => 'One row per item, in the order they appear on the page. Phone and email use the description as the link text. The map row uses a separate link label such as Get Directions.',
                'sub_fields'   => [
                    [
                        'key'   => 'field_contact_detail_icon',
                        'label' => 'Icon',
                        'name'  => 'icon',
                        'type'  => 'text',
                        'instructions' => 'The emoji shown beside this item.',
                    ],
                    [
                        'key'   => 'field_contact_detail_title',
                        'label' => 'Title',
                        'name'  => 'title',
                        'type'  => 'text',
                    ],
                    [
                        'key'          => 'field_contact_detail_description',
                        'label'        => 'Description',
                        'name'         => 'description',
                        'type'         => 'wysiwyg',
                        'tabs'         => 'visual',
                        'toolbar'      => 'basic',
                        'media_upload' => 0,
                    ],
                    [
                        'key'          => 'field_contact_detail_link',
                        'label'        => 'Link',
                        'name'         => 'link',
                        'type'         => 'text',
                        'instructions' => 'Phone (tel:), email (mailto:), or a directions URL.',
                    ],
                    [
                        'key'          => 'field_contact_detail_link_label',
                        'label'        => 'Link label',
                        'name'         => 'link_label',
                        'type'         => 'text',
                        'instructions' => 'Leave empty when the description itself is the link, such as the phone number.',
                    ],
                ],
            ],
            [
                'key'          => 'field_contact_map_tab',
                'label'        => 'Map',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The map below the form.',
            ],
            [
                'key'   => 'field_contact_map_url',
                'label' => 'Map embed link',
                'name'  => 'contact_map_url',
                'type'  => 'url',
            ],
            [
                'key'   => 'field_contact_map_title',
                'label' => 'Map title',
                'name'  => 'contact_map_title',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_contact_visit_tab',
                'label'        => 'Visit us',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The banner at the bottom of the contact page.',
            ],
            [
                'key'   => 'field_contact_visit_badge',
                'label' => 'Visit badge',
                'name'  => 'contact_visit_badge',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_contact_visit_heading',
                'label' => 'Visit heading',
                'name'  => 'contact_visit_heading',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_contact_visit_text',
                'label'        => 'Visit text',
                'name'         => 'contact_visit_text',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'   => 'field_contact_visit_button',
                'label' => 'Button text',
                'name'  => 'contact_visit_button',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_contact_visit_button_link',
                'label'        => 'Button link',
                'name'         => 'contact_visit_button_link',
                'type'         => 'text',
                'instructions' => 'A phone link such as tel:+6563339093, or a page URL.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'template-contact-page.php',
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
