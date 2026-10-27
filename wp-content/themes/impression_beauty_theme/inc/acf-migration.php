<?php
/**
 * TEMPORARY — remove after the live migration is done.
 *
 * Tools → ACF migration: moves the Home / About content from the old
 * database field groups to the theme-code groups (inc/acf-home.php,
 * inc/acf-about.php, inc/acf-service.php).
 *
 * "Check" only reports. "Apply" deletes the old field groups and fills
 * fields that are still empty. Filled fields are never overwritten.
 */

add_action( 'admin_menu', function () {
    add_management_page( 'ACF migration', 'ACF migration', 'manage_options', 'impression-acf-migration', 'impression_acf_migration_page' );
} );

function impression_acf_migration_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Not allowed.' );
    }

    $apply = isset( $_POST['impression_acf_apply'] ) && check_admin_referer( 'impression_acf_migration' );

    ob_start();
    impression_acf_migration_run( $apply );
    $log = ob_get_clean();
    ?>
    <div class="wrap">
        <h1>ACF migration</h1>
        <p>Moves the Home and About fields to the theme code and fills empty fields. Filled fields are never overwritten. Back up the database before applying.</p>
        <pre style="background:#fff;border:1px solid #ccd0d4;padding:12px;max-height:600px;overflow:auto;"><?php echo esc_html( $log ); ?></pre>
        <?php if ( ! $apply ) : ?>
            <form method="post">
                <?php wp_nonce_field( 'impression_acf_migration' ); ?>
                <button type="submit" name="impression_acf_apply" value="1" class="button button-primary"
                        onclick="return confirm('Delete the old field groups and fill the empty fields?');">Apply</button>
            </form>
        <?php endif; ?>
    </div>
    <?php
}

function impression_acf_migration_run( $apply ) {
    echo $apply ? "MODE: APPLY\n\n" : "MODE: CHECK ONLY (nothing is changed)\n\n";

    if ( ! function_exists( 'update_field' ) ) {
        echo "ERROR: ACF is not active.\n";
        return;
    }

    // ── 1. The theme field groups must be registered ────────────────────
    foreach ( [ 'group_home', 'group_about', 'group_service' ] as $key ) {
        $g = acf_get_field_group( $key );
        if ( ! $g || ! empty( $g['ID'] ) ) {
            echo "  !!  theme group $key NOT FOUND\n\nStopping: the theme is not fully deployed.\n";
            return;
        }
        echo "  ok  theme group $key registered\n";
    }

    $home_id     = (int) get_option( 'page_on_front' );
    $about_id    = (int) ( get_posts( [ 'post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'template-about-page.php', 'numberposts' => 1, 'fields' => 'ids' ] )[0] ?? 0 );
    $service_ids = get_posts( [ 'post_type' => 'page', 'post_status' => 'publish', 'meta_key' => '_wp_page_template', 'meta_value' => 'template-service-page.php', 'numberposts' => -1, 'fields' => 'ids' ] );
    $title       = fn( $id ) => html_entity_decode( get_the_title( $id ) );

    echo "\n  front page: $home_id (" . $title( $home_id ) . ")\n  about page: $about_id (" . $title( $about_id ) . ")\n  service pages: " . implode( ', ', array_map( fn( $id ) => "$id (" . $title( $id ) . ')', $service_ids ) ) . "\n";
    if ( ! $home_id || ! $about_id ) {
        echo "\nStopping: front page or About page not found.\n";
        return;
    }

    // ── 2. Saved content must point at the same field keys ──────────────
    echo "\nField key check (saved content -> field definition):\n";
    $expected = [
        $home_id  => [ 'header-hero-header' => 'field_6a466ba7a1990', 'header-hero-content' => 'field_6a46769228abe', 'hero-image-background' => 'field_6a467d42b10af', 'hero-repeater-image' => 'field_6a467d7fb10b0', 'services-repeater' => 'field_6a4687e4f3581', 'testimonials-repeater' => 'field_6a468ce595f0f', 'trend_image' => 'field_6a8e790900017', 'trend_content' => 'field_6a8e799a00018' ],
        $about_id => [ 'about_hero_title' => 'field_6a4a8e84610b9', 'about_hero_image' => 'field_6a4a8f6d610bc', 'stats_items' => 'field_6a4a9a097a2f9', 'story_heading' => 'field_6a4a9e58335d3', 'story_check_items' => 'field_6a4a9ea3335d6', 'vision_title' => 'field_6a4aa1becfa9e', 'mission_content' => 'field_6a4aa20acfaa1' ],
    ];
    $mismatch = 0;
    foreach ( $expected as $pid => $fields ) {
        foreach ( $fields as $name => $key ) {
            $ref = get_post_meta( $pid, "_$name", true );
            if ( $ref === '' ) {
                echo "  --  page $pid $name: no saved content (fine)\n";
            } elseif ( $ref === $key ) {
                echo "  ok  page $pid $name\n";
            } else {
                echo "  !!  page $pid $name: saved with $ref, theme expects $key\n";
                $mismatch++;
            }
        }
    }

    // ── 3. Old field groups still stored in the database ────────────────
    $old_keys  = [ 'group_6a466ba725a81', 'group_6a4687e4623bb', 'group_6a468ce511f9e', 'group_6a8e7908bb1c5', 'group_6a4a8e83f1207' ];
    $to_delete = [];
    echo "\nField groups stored in the database:\n";
    $db_groups = get_posts( [ 'post_type' => 'acf-field-group', 'post_status' => 'any', 'numberposts' => -1 ] );
    foreach ( $db_groups as $p ) {
        $is_old = in_array( $p->post_name, $old_keys, true );
        echo ( $is_old ? '  del ' : '  keep' ) . " {$p->ID} {$p->post_title} ({$p->post_name})\n";
        if ( $is_old ) {
            $to_delete[] = $p->ID;
        }
    }
    if ( ! $db_groups ) {
        echo "  none\n";
    }

    // ── 4. Content to fill (only where the field is still empty) ────────
    $plan = [ $home_id => impression_acf_migration_home(), $about_id => impression_acf_migration_about() ];
    foreach ( $service_ids as $sid ) {
        $plan[ $sid ] = impression_acf_migration_service();
    }

    echo "\nFields to fill (empty fields only):\n";
    $todo = [];
    foreach ( $plan as $pid => $fields ) {
        $fill = $skip = 0;
        foreach ( $fields as $key => $value ) {
            $field = acf_get_field( $key );
            $raw   = get_post_meta( $pid, $field['name'], true );
            if ( $raw === '' || $raw === null || $raw === '0' || $raw === 0 ) {
                $todo[] = [ $pid, $key, $value ];
                $fill++;
            } else {
                $skip++;
            }
        }
        echo "  page $pid (" . $title( $pid ) . "): $fill to fill, $skip already have content\n";
    }

    // ── 5. Apply ────────────────────────────────────────────────────────
    if ( ! $apply ) {
        echo "\nNothing changed. Press Apply to make these changes.\n";
        return;
    }
    if ( $mismatch ) {
        echo "\nStopping: $mismatch field key mismatch(es) above. Deleting the old groups would orphan that content.\n";
        return;
    }

    @set_time_limit( 300 ); // image downloads
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    echo "\nDeleting old field groups...\n";
    foreach ( $to_delete as $gid ) {
        echo "  $gid " . ( acf_delete_field_group( $gid ) ? 'deleted' : 'FAILED' ) . "\n";
    }

    echo "\nFilling fields...\n";
    foreach ( $todo as [ $pid, $key, $value ] ) {
        update_field( $key, is_callable( $value ) ? $value() : $value, $pid );
    }
    echo "  " . count( $todo ) . " fields written.\n\nDone. Remove inc/acf-migration.php in the next deploy.\n";
}

// Imports an image into the media library once (re-runs reuse it).
function impression_acf_migration_image( $url ) {
    static $cache = [];
    if ( isset( $cache[ $url ] ) ) {
        return $cache[ $url ];
    }
    $existing = get_posts( [ 'post_type' => 'attachment', 'meta_key' => '_seed_source_url', 'meta_value' => $url, 'numberposts' => 1, 'fields' => 'ids' ] );
    if ( $existing ) {
        return $cache[ $url ] = (int) $existing[0];
    }
    $tmp = download_url( $url );
    if ( is_wp_error( $tmp ) ) {
        echo "  ! download failed: $url — " . $tmp->get_error_message() . "\n";
        return 0;
    }
    $name = basename( parse_url( $url, PHP_URL_PATH ) );
    if ( ! preg_match( '/\.(jpe?g|png|webp|avif)$/i', $name ) ) {
        $name = 'seed-' . substr( md5( $url ), 0, 12 ) . '.jpg';
    }
    $id = media_handle_sideload( [ 'name' => $name, 'tmp_name' => $tmp ], 0 );
    if ( is_wp_error( $id ) ) {
        @unlink( $tmp );
        echo "  ! import failed: $url — " . $id->get_error_message() . "\n";
        return 0;
    }
    update_post_meta( $id, '_seed_source_url', $url );
    return $cache[ $url ] = (int) $id;
}

function impression_acf_migration_page_id( $slug ) {
    $p = get_page_by_path( $slug );
    return $p ? $p->ID : '';
}

function impression_acf_migration_home() {
    return [
        'field_home_services_heading'     => 'Our Services',
        'field_home_services_intro'       => 'As beauty evolves, we continue to grow with the times while staying true to what matters most. We never follow trends blindly. Instead, we carefully select treatments and approaches that are <b>safe, effective and suited to your individual needs</b>. At the heart of everything we do are our core values of safety, <b>sincerity and authenticity</b>. With decades of experience, we believe true beauty is not about chasing trends, but about caring for your skin and body in a way that is thoughtful, responsible and sustainable. <b>Timeless care. Genuine expertise. Beauty you can trust.</b>',
        'field_home_news_heading'         => 'Latest Updates',
        'field_home_news_intro'           => 'Check out our latest promos, pricing changes, and other updates from Impression Beauty.',
        'field_home_testimonials_heading' => 'Testimonials',
        'field_home_testimonials_intro'   => "Know what our customers say.\nLoved by beauty enthusiasts and skincare lovers.",
        'field_home_reviews_eyebrow'      => 'Client Experiences',
        'field_home_reviews_heading'      => 'What Our Clients Say on Google',
        'field_home_reviews_intro'        => 'Real experiences from clients who trust Impression Beauty with their care.',
    ];
}

function impression_acf_migration_about() {
    $u   = 'https://images.unsplash.com/';
    $old = 'https://impressionbeauty.com/wp-content/uploads/2022/04/';
    $img = 'impression_acf_migration_image';

    // Image fields are closures so images are only downloaded when the field gets filled.
    return [
        'field_about_vm_title'     => 'Our Vision & Mission',
        'field_about_vm_subtitle'  => 'The purpose that drives everything we do at Impression Beauty.',
        'field_about_vision_icon'  => '🌟',
        'field_about_mission_icon' => '💫',
        'field_about_values_title'    => 'Our Values',
        'field_about_values_subtitle' => 'The principles that guide every treatment, every consultation, and every interaction.',
        'field_about_values_items'    => [
            [ 'value_icon' => '🛡️', 'value_heading' => 'Safety First',            'value_description' => 'Every treatment we offer has been carefully evaluated for safety and suitability. We never compromise on the well-being of our clients — your health comes before any result.' ],
            [ 'value_icon' => '🤝', 'value_heading' => 'Integrity',               'value_description' => 'We are honest about what we can and cannot do. We only recommend treatments that genuinely suit your needs — no upselling, no false promises, just straightforward guidance you can trust.' ],
            [ 'value_icon' => '🌿', 'value_heading' => 'Natural Treatments',      'value_description' => 'We believe the best care comes from nature. All our preparations use 100% natural herbal ingredients — free from harsh chemicals, invasive procedures, or unnecessary additives.' ],
            [ 'value_icon' => '💆', 'value_heading' => 'Personalised Care',       'value_description' => 'No two clients are alike. Every session begins with a thorough consultation so we can design a treatment plan tailored specifically to your skin type, concerns, and lifestyle.' ],
            [ 'value_icon' => '🏆', 'value_heading' => 'Professional Excellence', 'value_description' => 'Our therapists are trained, certified, and continuously upskilled. We hold ourselves to the highest professional standard so every client receives a consistent, expert-level experience.' ],
            [ 'value_icon' => '💬', 'value_heading' => 'Genuine Relationships',   'value_description' => 'We see every client as a long-term relationship, not a single appointment. We remember your journey, celebrate your progress, and are always here when you need us.' ],
        ],
        'field_about_team_title'    => 'Meet Our Team',
        'field_about_team_subtitle' => 'Every therapist at Impression Beauty is trained, certified, and passionate about what they do.',
        'field_about_team_members'  => fn() => [
            [ 'member_photo' => $img( $u . 'photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop&q=80' ), 'member_name' => 'Senior Therapist',    'member_role' => 'Face Care Specialist' ],
            [ 'member_photo' => $img( $u . 'photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&q=80' ),    'member_name' => 'Body Care Therapist', 'member_role' => 'Massage & Body Wellness' ],
            [ 'member_photo' => $img( $u . 'photo-1614608682850-e0d6ed316d47?w=400&h=400&fit=crop&q=80' ), 'member_name' => 'Skin Consultant',     'member_role' => 'Eye Care & Skin Analysis' ],
            [ 'member_photo' => $img( $u . 'photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop&q=80' ), 'member_name' => 'Herbal Specialist',   'member_role' => 'Mole & Wart Removal' ],
        ],
        'field_about_clinic_title'          => 'Our Clinic',
        'field_about_clinic_subtitle'       => 'A serene, welcoming space designed for your comfort — right in the heart of Clarke Quay Central.',
        'field_about_clinic_main_image'     => fn() => $img( $u . 'photo-1519494026892-80bbd2d6fd0d?w=800&h=550&fit=crop&q=80' ),
        'field_about_clinic_gallery'        => fn() => [
            [ 'gallery_image' => $img( $u . 'photo-1560472354-b33ff0c44a43?w=400&h=280&fit=crop&q=80' ) ],
            [ 'gallery_image' => $img( $u . 'photo-1522337360788-8b13dee7a37e?w=400&h=280&fit=crop&q=80' ) ],
        ],
        'field_about_clinic_address_label'  => 'Clarke Quay Central',
        'field_about_clinic_address_detail' => '#B1-67, 6 Eu Tong Sen St',
        'field_about_clinic_hours_label'    => 'Opening Hours',
        'field_about_clinic_hours_detail'   => 'Mon–Sun: 11am – 8pm',
        'field_about_clinic_mrt_label'      => 'Easy Access',
        'field_about_clinic_mrt_detail'     => 'Clarke Quay MRT (NE5)',
        'field_about_treatments_title'    => 'Our Treatments',
        'field_about_treatments_subtitle' => 'A full range of face and body care services designed for every concern.',
        'field_about_treatment_items'     => fn() => [
            [ 'treatment_image' => $img( $old . 'Face-Set-Image-scaled.jpg' ), 'treatment_name' => 'Face Care',           'treatment_tagline' => 'Glow & rejuvenate',     'treatment_link' => impression_acf_migration_page_id( 'face-care' ) ],
            [ 'treatment_image' => $img( $old . 'Body-Set-Image-scaled.jpg' ), 'treatment_name' => 'Body Care',           'treatment_tagline' => 'Relax & restore',       'treatment_link' => impression_acf_migration_page_id( 'body-care' ) ],
            [ 'treatment_image' => $img( $old . 'Eyes-Set-Image-scaled.jpg' ), 'treatment_name' => 'Eye Care',            'treatment_tagline' => 'Brighten & lift',       'treatment_link' => impression_acf_migration_page_id( 'eye-care' ) ],
            [ 'treatment_image' => $img( $u . 'photo-1741896136331-10375875eff4?w=600&h=400&fit=crop&q=80' ), 'treatment_name' => 'Mole & Wart Removal', 'treatment_tagline' => 'Natural herbal method', 'treatment_link' => impression_acf_migration_page_id( 'mole-warts-removal' ) ],
        ],
    ];
}

function impression_acf_migration_service() {
    $u   = 'https://images.unsplash.com/';
    $img = 'impression_acf_migration_image';

    return [
        'field_service_hero_badge'       => 'Impression Beauty',
        'field_service_hero_subtitle'    => 'Professional treatments tailored to your skin and wellness needs. Trusted by thousands of satisfied customers since 1994.',
        'field_service_hero_image'       => fn() => $img( $u . 'photo-1758600587391-338f5376b7ed?w=700&h=800&fit=crop&q=80' ),
        'field_service_hero_float_badge' => 'Since 1994',
        'field_service_hero_btn1_text'   => 'View Treatments',
        'field_service_hero_btn1_link'   => '#treatments',
        'field_service_hero_btn2_text'   => 'Free Consultation',
        'field_service_hero_btn2_link'   => '#consultation',
        'field_service_stats' => [
            [ 'number' => '30+',    'label' => 'Years Experience' ],
            [ 'number' => '6,000+', 'label' => 'Successful Cases' ],
            [ 'number' => '100%',   'label' => 'Herbal & Natural' ],
            [ 'number' => '5★',     'label' => 'Customer Rated' ],
        ],
        'field_service_intro_image'       => fn() => $img( $u . 'photo-1763539818420-165e69b7489b?w=800&h=700&fit=crop&q=80' ),
        'field_service_intro_badge'       => 'About This Service',
        'field_service_intro_heading'     => 'Why Choose Impression Beauty?',
        'field_service_intro_paragraph_1' => 'Our expert consultants provide personalised beauty and wellness treatments that combine cutting-edge technology with time-tested natural methods. Every treatment is tailored to your unique skin type and individual goals.',
        'field_service_intro_paragraph_2' => 'Whether you are looking to resolve a stubborn skin concern or simply maintain a radiant complexion, our experienced team is here to guide you at every step of your beauty journey.',
        'field_service_intro_checks'      => [ [ 'text' => 'Professional Consultants' ], [ 'text' => 'Proven Results' ], [ 'text' => 'Personalised Care' ] ],
        'field_service_audience_heading'    => 'Who Is This For?',
        'field_service_audience_subheading' => 'Treatments designed for every concern and skin type.',
        'field_service_audience_cards'      => fn() => [
            [ 'image' => $img( $u . 'photo-1741896136331-10375875eff4?w=600&h=700&fit=crop&q=80' ), 'title' => 'Dry & Sensitive Skin',    'description' => 'Restore hydration and soothe irritated skin.' ],
            [ 'image' => $img( $u . 'photo-1653784097013-786a8965ea3b?w=600&h=700&fit=crop&q=80' ), 'title' => 'Oily & Combination Skin', 'description' => 'Control excess sebum and refine large pores.' ],
            [ 'image' => $img( $u . 'photo-1768483018807-bd0b9ab86539?w=600&h=700&fit=crop&q=80' ), 'title' => 'Pigmentation & Ageing',   'description' => 'Even skin tone and reduce visible signs of ageing.' ],
        ],
        'field_service_treatments_heading'    => 'Recommended Treatments',
        'field_service_treatments_subheading' => 'Carefully curated procedures for visible, lasting results.',
        'field_service_treatments' => [
            [ 'duration' => '90 mins', 'name' => 'Multi Fruits Energizing Treatment', 'description' => 'High minerals & vitamins content products to strengthen skin cellular and protect skin against free radical and UV lights, fighting skin ageing for a brighter, fairer look.' ],
            [ 'duration' => '90 mins', 'name' => 'Skin RejuV Treatment',              'description' => 'Dry flaky and red skin treatment using complete Hydra Silk skin care with high silk protein that immediately replaces lost moisture. Reduces redness and anti-sensitivity.' ],
            [ 'duration' => '60 mins', 'name' => 'RF Treatment',                       'description' => 'For mature sagging skin. Using Bio Heat to promote cell regeneration, improve blood and lymph circulation, and provide an instant lift.' ],
            [ 'duration' => '90 mins', 'name' => 'Skin Fruition / Renewal Treatment',  'description' => 'For oily blemishes non-sensitive skin. With AHA range products to soften, smoothen, lighten uneven skin and reduce blemishes.' ],
            [ 'duration' => '90 mins', 'name' => 'Acne Treatment',                     'description' => 'Deep cleansing with anti-septic and healing effect. Controls sebum secretion and prevents bacterial infection for oily blemish-prone skin.' ],
            [ 'duration' => '80 mins', 'name' => 'Diamond Peel Treatment',             'description' => 'Effectively removes dead skin cells, refines large pores, smoothens scars and evens skin tone for large pore, rough & slight blemish skin.' ],
        ],
        'field_service_process_heading'    => 'How It Works',
        'field_service_process_subheading' => 'A simple, comfortable process from consultation to results.',
        'field_service_process_steps' => [
            [ 'number' => '01', 'title' => 'Free Consultation',     'description' => 'Our expert consultant analyses your skin and discusses your concerns to recommend the most suitable treatment plan.' ],
            [ 'number' => '02', 'title' => 'Treatment Application', 'description' => 'Your chosen treatment is professionally administered in a clean, comfortable environment. Most sessions take 45–90 mins.' ],
            [ 'number' => '03', 'title' => 'Review & Follow Up',    'description' => 'We schedule a follow-up to review your results and adjust your treatment plan for continued improvement.' ],
        ],
        'field_service_cta_badge'         => 'Get Started Today',
        'field_service_cta_heading'       => 'Book Your Free Consultation',
        'field_service_cta_text'          => 'Our friendly staff will be happy to answer your questions. Fill in the form or contact us directly — we will get back to you shortly.',
        'field_service_cta_phone_text'    => '📞 +65 6333 9093',
        'field_service_cta_phone_link'    => 'tel:+6563339093',
        'field_service_cta_whatsapp_text' => 'WhatsApp Us',
        'field_service_cta_whatsapp_link' => 'https://wa.me/6598678787',
        'field_service_cta_hours'         => 'Operating Hours: Mon–Fri 11:30am–9:00pm • Sat & Sun 10:00am–6:00pm',
    ];
}
