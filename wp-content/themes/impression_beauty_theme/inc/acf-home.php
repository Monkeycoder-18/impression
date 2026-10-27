<?php

// Field keys and names below match the field groups that used to live in the
// database (template-frontpage-hero, template-our-service, template-trend,
// template-testimonials), so content saved before the move still loads.
add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'    => 'group_home',
        'title'  => 'Home Page',
        'fields' => [

            // ── Hero ──────────────────────────────
            [
                'key'          => 'field_home_hero_tab',
                'label'        => 'Hero',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The banner at the top of the home page.',
            ],
            [
                'key'          => 'field_6a466ba7a1990',
                'label'        => 'Heading',
                'name'         => 'header-hero-header',
                'type'         => 'wysiwyg',
                'tabs'         => 'all',
                'toolbar'      => 'full',
                'media_upload' => 1,
            ],
            [
                'key'          => 'field_6a46769228abe',
                'label'        => 'Intro text',
                'name'         => 'header-hero-content',
                'type'         => 'wysiwyg',
                'tabs'         => 'all',
                'toolbar'      => 'full',
                'media_upload' => 1,
            ],
            [
                'key'           => 'field_6a467d42b10af',
                'label'         => 'Background',
                'name'          => 'hero-image-background',
                'type'          => 'file',
                'return_format' => 'array',
                'instructions'  => 'An image or a video (mp4, webm).',
            ],
            [
                'key'          => 'field_6a467d7fb10b0',
                'label'        => 'Slider images',
                'name'         => 'hero-repeater-image',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add an image',
                'sub_fields'   => [
                    [
                        'key'           => 'field_6a467d9fb10b1',
                        'label'         => 'Image',
                        'name'          => 'hero-slider-images',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                    ],
                ],
            ],

            // ── Services ──────────────────────────
            [
                'key'          => 'field_home_services_tab',
                'label'        => 'Services',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The "Our Services" cards.',
            ],
            [
                'key'   => 'field_home_services_heading',
                'label' => 'Heading',
                'name'  => 'home_services_heading',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_home_services_intro',
                'label'        => 'Intro text',
                'name'         => 'home_services_intro',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual',
                'toolbar'      => 'basic',
                'media_upload' => 0,
            ],
            [
                'key'          => 'field_6a4687e4f3581',
                'label'        => 'Services',
                'name'         => 'services-repeater',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add a service',
                'sub_fields'   => [
                    [
                        'key'   => 'field_6a4688553f871',
                        'label' => 'Title',
                        'name'  => 'service-title',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_6a46883c3f870',
                        'label' => 'Description',
                        'name'  => 'service-description',
                        'type'  => 'textarea',
                    ],
                    [
                        'key'           => 'field_6a4688293f86f',
                        'label'         => 'Image',
                        'name'          => 'service-image',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'medium',
                    ],
                    [
                        'key'   => 'field_6a468a6b0ddf5',
                        'label' => 'Link',
                        'name'  => 'service-link',
                        'type'  => 'page_link',
                    ],
                ],
            ],

            // ── Promotion ─────────────────────────
            [
                'key'          => 'field_home_trend_tab',
                'label'        => 'Promotion',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The bundle deals / promotion box.',
            ],
            [
                'key'           => 'field_6a8e790900017',
                'label'         => 'Image',
                'name'          => 'trend_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ],
            [
                'key'          => 'field_6a8e799a00018',
                'label'        => 'Content',
                'name'         => 'trend_content',
                'type'         => 'wysiwyg',
                'tabs'         => 'all',
                'toolbar'      => 'full',
                'media_upload' => 1,
            ],

            // ── Latest updates ────────────────────
            [
                'key'          => 'field_home_news_tab',
                'label'        => 'Latest updates',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The heading above the latest blog posts. The posts themselves come from Posts.',
            ],
            [
                'key'   => 'field_home_news_heading',
                'label' => 'Heading',
                'name'  => 'home_news_heading',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_home_news_intro',
                'label' => 'Intro text',
                'name'  => 'home_news_intro',
                'type'  => 'textarea',
                'rows'  => 2,
            ],

            // ── Testimonials ──────────────────────
            [
                'key'          => 'field_home_testimonials_tab',
                'label'        => 'Testimonials',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'Customer quotes.',
            ],
            [
                'key'   => 'field_home_testimonials_heading',
                'label' => 'Heading',
                'name'  => 'home_testimonials_heading',
                'type'  => 'text',
            ],
            [
                'key'          => 'field_home_testimonials_intro',
                'label'        => 'Intro text',
                'name'         => 'home_testimonials_intro',
                'type'         => 'textarea',
                'rows'         => 2,
                'new_lines'    => 'br',
            ],
            [
                'key'          => 'field_6a468ce595f0f',
                'label'        => 'Testimonials',
                'name'         => 'testimonials-repeater',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add a testimonial',
                'sub_fields'   => [
                    [
                        'key'   => 'field_6a468d0c95f10',
                        'label' => 'Name',
                        'name'  => 'testimonial-name',
                        'type'  => 'text',
                    ],
                    [
                        'key'   => 'field_6a468d1b95f11',
                        'label' => 'Quote',
                        'name'  => 'testimonial-quote',
                        'type'  => 'text',
                    ],
                    [
                        'key'           => 'field_6a468d2695f12',
                        'label'         => 'Photo',
                        'name'          => 'testimonial-photo',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'thumbnail',
                    ],
                ],
            ],

            // ── Google reviews ────────────────────
            [
                'key'          => 'field_home_reviews_tab',
                'label'        => 'Google reviews',
                'name'         => '',
                'type'         => 'tab',
                'instructions' => 'The heading above the Google reviews. Also used on the service pages. The reviews come from the Trustindex plugin.',
            ],
            [
                'key'   => 'field_home_reviews_eyebrow',
                'label' => 'Small label',
                'name'  => 'home_reviews_eyebrow',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_home_reviews_heading',
                'label' => 'Heading',
                'name'  => 'home_reviews_heading',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_home_reviews_intro',
                'label' => 'Intro text',
                'name'  => 'home_reviews_intro',
                'type'  => 'textarea',
                'rows'  => 2,
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
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
