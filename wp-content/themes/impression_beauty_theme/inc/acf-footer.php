<?php

add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) || ! function_exists( 'acf_add_options_page' ) ) {
        return;
    }

    acf_add_options_page( [
        'page_title' => 'Footer',
        'menu_title' => 'Footer',
        'menu_slug'  => 'footer-settings',
        'capability' => 'edit_pages',
        'icon_url'   => 'dashicons-editor-insertmore',
        'position'   => 61,
        'redirect'   => false,
    ] );

    acf_add_local_field_group( [
        'key'    => 'group_footer',
        'title'  => 'Footer',
        'fields' => [
            [
                'key'          => 'field_footer_columns_tab',
                'label'        => 'Columns',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The link columns next to the logo. Drag rows to change the order.',
            ],
            [
                'key'          => 'field_footer_columns',
                'label'        => 'Columns',
                'name'         => 'footer_columns',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add a column',
                'sub_fields'   => [
                    [
                        'key'   => 'field_footer_column_heading',
                        'label' => 'Heading',
                        'name'  => 'heading',
                        'type'  => 'text',
                    ],
                    [
                        'key'          => 'field_footer_column_links',
                        'label'        => 'Links',
                        'name'         => 'links',
                        'type'         => 'repeater',
                        'layout'       => 'table',
                        'button_label' => 'Add a link',
                        'instructions' => 'Pick a page, or type a web address. A link with neither is hidden.',
                        'sub_fields'   => [
                            [
                                'key'   => 'field_footer_link_label',
                                'label' => 'Label',
                                'name'  => 'label',
                                'type'  => 'text',
                            ],
                            [
                                'key'        => 'field_footer_link_page',
                                'label'      => 'Page',
                                'name'       => 'page',
                                'type'       => 'page_link',
                                'post_type'  => [ 'page' ],
                                'allow_null' => 1,
                            ],
                            [
                                'key'          => 'field_footer_link_url',
                                'label'        => 'Or web address',
                                'name'         => 'url',
                                'type'         => 'text',
                                'instructions' => 'e.g. https://instagram.com/… or mailto:name@example.com',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'key'          => 'field_footer_contact_tab',
                'label'        => 'Contact',
                'name'         => '',
                'type'         => 'tab',
            ],
            [
                'key'          => 'field_footer_enquiry_email',
                'label'        => 'Enquiry email',
                'name'         => 'footer_enquiry_email',
                'type'         => 'email',
                'instructions' => 'Where the Contact page and service page forms are sent.',
            ],
            [
                'key'          => 'field_footer_whatsapp_number',
                'label'        => 'WhatsApp number',
                'name'         => 'footer_whatsapp_number',
                'type'         => 'text',
                'instructions' => 'Used by the floating WhatsApp button. Digits only, with country code, e.g. 6580102500.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'footer-settings',
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

// Enquiry email and WhatsApp number, with the clinic's defaults.
function impression_enquiry_email() {
    $email = function_exists( 'get_field' ) ? get_field( 'footer_enquiry_email', 'option' ) : '';
    return $email ? $email : 'imp@impressionbeauty.com';
}

function impression_whatsapp_number() {
    $number = function_exists( 'get_field' ) ? get_field( 'footer_whatsapp_number', 'option' ) : '';
    $number = preg_replace( '/\D/', '', (string) $number );
    return $number ? $number : '6580102500';
}
