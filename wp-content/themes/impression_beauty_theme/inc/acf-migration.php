<?php
/**
 * TEMPORARY — remove after the live migration is done (with the migration/ folder).
 *
 * Tools → ACF migration:
 *  - deletes the old database field groups (the theme code defines them now),
 *  - copies the content prepared on local (migration/content.json): service,
 *    FAQ, Privacy, Terms, Promotions and News pages, the news post, footer
 *    settings and their images. Those pages are replaced; missing ones are created.
 *  - fills Home / About fields that are still empty (filled ones are kept),
 *  - menu: Eye Care + Hair Removal under Services, News → the News page.
 *
 * "Check" only reports. "Apply" makes the changes.
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
        <p>Copies the content prepared on local to this site, deletes the old field groups and fills empty Home / About fields. The listed pages are <strong>replaced</strong>. Back up the database before applying.</p>
        <pre style="background:#fff;border:1px solid #ccd0d4;padding:12px;max-height:600px;overflow:auto;"><?php echo esc_html( $log ); ?></pre>
        <?php if ( ! $apply ) : ?>
            <form method="post">
                <?php wp_nonce_field( 'impression_acf_migration' ); ?>
                <button type="submit" name="impression_acf_apply" value="1" class="button button-primary"
                        onclick="return confirm('Replace the listed pages, delete the old field groups and fill the empty fields?');">Apply</button>
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
    foreach ( [ 'group_home', 'group_about', 'group_service', 'group_faq', 'group_promotion', 'group_footer' ] as $key ) {
        $g = acf_get_field_group( $key );
        if ( ! $g || ! empty( $g['ID'] ) ) {
            echo "  !!  theme group $key NOT FOUND\n\nStopping: the theme is not fully deployed.\n";
            return;
        }
        echo "  ok  theme group $key registered\n";
    }

    $data = json_decode( (string) @file_get_contents( get_template_directory() . '/migration/content.json' ), true );
    if ( ! $data ) {
        echo "  !!  migration/content.json missing or unreadable\n\nStopping.\n";
        return;
    }

    $home_id  = (int) get_option( 'page_on_front' );
    $about_id = (int) ( get_posts( [ 'post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'template-about-page.php', 'numberposts' => 1, 'fields' => 'ids' ] )[0] ?? 0 );
    $title    = fn( $id ) => html_entity_decode( get_the_title( $id ) );

    echo "\n  front page: $home_id (" . $title( $home_id ) . ")\n  about page: $about_id (" . $title( $about_id ) . ")\n";
    if ( ! $home_id || ! $about_id ) {
        echo "\nStopping: front page or About page not found.\n";
        return;
    }

    // ── 2. Saved content must point at the same field keys ──────────────
    echo "\nField key check (saved content -> field definition):\n";
    $expected = [
        $home_id  => [ 'header-hero-header' => 'field_6a466ba7a1990', 'header-hero-content' => 'field_6a46769228abe', 'hero-image-background' => 'field_6a467d42b10af', 'hero-repeater-image' => 'field_6a467d7fb10b0', 'services-repeater' => 'field_6a4687e4f3581', 'testimonials-repeater' => 'field_6a468ce595f0f', 'trend_image' => 'field_6a8e7a6a81d08', 'trend_content' => 'field_6a8e7a8181d09' ],
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
    $old_keys  = [ 'group_6a466ba725a81', 'group_6a4687e4623bb', 'group_6a468ce511f9e', 'group_6a8e7908bb1c5', 'group_6a8e7a69aea40', 'group_6a4a8e83f1207' ];
    $to_delete = [];
    echo "\nField groups stored in the database:\n";
    $db_groups = get_posts( [ 'post_type' => 'acf-field-group', 'post_status' => 'any', 'numberposts' => -1 ] );
    // Every field of a group we delete must also be defined in the theme code.
    $theme_names = [];
    foreach ( [ 'group_home', 'group_about', 'group_service' ] as $key ) {
        $theme_names = array_merge( $theme_names, array_column( acf_get_fields( $key ), 'name' ) );
    }
    foreach ( $db_groups as $p ) {
        $is_old = in_array( $p->post_name, $old_keys, true );
        echo ( $is_old ? '  del ' : '  keep' ) . " {$p->ID} {$p->post_title} ({$p->post_name})\n";
        if ( $is_old ) {
            $to_delete[] = $p->ID;
            $names = wp_list_pluck( get_posts( [ 'post_type' => 'acf-field', 'post_parent' => $p->ID, 'post_status' => 'any', 'numberposts' => -1 ] ), 'post_excerpt' );
            foreach ( array_diff( $names, $theme_names ) as $name ) {
                echo "        !!  field '$name' is not defined in the theme code\n";
                $mismatch++;
            }
        }
    }
    if ( ! $db_groups ) {
        echo "  none\n";
    }

    // ── 4. Content copied from local ────────────────────────────────────
    echo "\nContent copied from local (these pages are replaced, missing ones created):\n";
    foreach ( $data['pages'] as $slug => $p ) {
        $live = get_page_by_path( $slug );
        echo '  ' . ( $live ? "replace page {$live->ID}" : 'create page' ) . " $slug ({$p['title']})\n";
    }
    foreach ( $data['posts'] as $slug => $p ) {
        $live = get_page_by_path( $slug, OBJECT, 'post' );
        echo '  ' . ( $live ? "replace post {$live->ID}" : 'create post' ) . " $slug ({$p['title']})\n";
    }
    $have = count( array_filter( $data['media'], 'impression_acf_migration_find_media' ) );
    echo '  images: ' . count( $data['media'] ) . " ($have already in the media library, the rest are imported)\n";
    echo '  footer settings: ' . count( $data['options'] ) . " values\n";

    // ── 5. Home / About fields to fill (only where still empty) ─────────
    $plan = [ $home_id => impression_acf_migration_home(), $about_id => impression_acf_migration_about() ];
    echo "\nHome / About fields to fill (empty fields only):\n";
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

    // ── 6. Apply ────────────────────────────────────────────────────────
    if ( ! $apply ) {
        echo "\nNothing changed. Press Apply to make these changes.\n";
        return;
    }
    if ( $mismatch ) {
        echo "\nStopping: $mismatch field key mismatch(es) above. Deleting the old groups would orphan that content.\n";
        return;
    }

    @set_time_limit( 600 ); // image downloads
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    echo "\nDeleting old field groups...\n";
    foreach ( $to_delete as $gid ) {
        echo "  $gid " . ( acf_delete_field_group( $gid ) ? 'deleted' : 'FAILED' ) . "\n";
    }

    echo "\nCopying content...\n";
    $ids = impression_acf_migration_content( $data );

    echo "\nFilling Home / About fields...\n";
    foreach ( $todo as [ $pid, $key, $value ] ) {
        update_field( $key, is_callable( $value ) ? $value() : $value, $pid );
    }
    echo '  ' . count( $todo ) . " fields written.\n";

    // Home "Discover More Discount and Promotion" button -> the Promotions page.
    $trend = get_field( 'trend_content', $home_id, false );
    $fixed = preg_replace( '#<a( href="[^"]*")? class="btn btn-beauty">Discover More#', '<a href="' . esc_url( get_permalink( $ids['promotions'] ) ) . '" class="btn btn-beauty">Discover More', (string) $trend, 1 );
    if ( $fixed !== $trend ) {
        update_field( 'field_6a8e7a8181d09', $fixed, $home_id );
        echo "  home promo button now links to the Promotions page\n";
    }

    echo "\nMenu...\n";
    impression_acf_migration_menu( $ids );

    echo "\nDone. Check the site, then remove inc/acf-migration.php and the migration/ folder in the next deploy.\n";
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

// ── Content copied from local (migration/content.json) ─────────────────

// Media library ID for an exported image, or 0 when it has not been imported yet.
function impression_acf_migration_find_media( $m ) {
    $key = $m['source'] ? $m['source'] : 'bundle:' . $m['bundle'];
    $ids = get_posts( [ 'post_type' => 'attachment', 'post_status' => 'any', 'meta_key' => '_seed_source_url', 'meta_value' => $key, 'numberposts' => 1, 'fields' => 'ids' ] );
    return $ids ? (int) $ids[0] : 0;
}

// Imports an exported image once (re-runs reuse it) and returns its ID.
function impression_acf_migration_media( $m ) {
    $id = impression_acf_migration_find_media( $m );
    if ( $id ) {
        return $id;
    }
    if ( $m['source'] ) {
        $tmp = download_url( $m['source'] );
    } else {
        $tmp = wp_tempnam( $m['bundle'] );
        if ( ! copy( get_template_directory() . '/migration/media/' . $m['bundle'], $tmp ) ) {
            $tmp = new WP_Error( 'copy', 'could not copy the bundled file' );
        }
    }
    $label = $m['source'] ? $m['source'] : $m['bundle'];
    if ( is_wp_error( $tmp ) ) {
        echo "  ! image failed: $label — " . $tmp->get_error_message() . "\n";
        return 0;
    }
    $id = media_handle_sideload( [ 'name' => basename( $m['file'] ), 'tmp_name' => $tmp ], 0, $m['title'] );
    if ( is_wp_error( $id ) ) {
        @unlink( $tmp );
        echo "  ! image failed: $label — " . $id->get_error_message() . "\n";
        return 0;
    }
    update_post_meta( $id, '_seed_source_url', $m['source'] ? $m['source'] : 'bundle:' . $m['bundle'] );
    if ( $m['caption'] ) {
        wp_update_post( [ 'ID' => $id, 'post_excerpt' => wp_slash( $m['caption'] ) ] );
    }
    if ( $m['alt'] ) {
        update_post_meta( $id, '_wp_attachment_image_alt', wp_slash( $m['alt'] ) );
    }
    return (int) $id;
}

// Removes a post's ACF values, so the copied content replaces it exactly.
function impression_acf_migration_clear_acf( $post_id ) {
    foreach ( get_post_meta( $post_id ) as $key => $values ) {
        if ( $key[0] === '_' && strpos( (string) $values[0], 'field_' ) === 0 ) {
            delete_post_meta( $post_id, $key );
            delete_post_meta( $post_id, substr( $key, 1 ) );
        }
    }
}

// Copies pages, posts, footer settings and images. Returns slug => live ID.
function impression_acf_migration_content( $data ) {
    global $wpdb;

    $media = [];
    foreach ( $data['media'] as $local_id => $m ) {
        $media[ $local_id ] = impression_acf_migration_media( $m );
    }
    echo '  images: ' . count( array_filter( $media ) ) . ' of ' . count( $media ) . " ready\n";

    // Create missing pages / posts first, so links between them can be mapped.
    $ids = [];
    foreach ( $data['pages'] as $slug => $p ) {
        $live = get_page_by_path( $slug );
        $ids[ $slug ] = $live ? $live->ID : wp_insert_post( [ 'post_type' => 'page', 'post_status' => 'draft', 'post_name' => $slug, 'post_title' => wp_slash( $p['title'] ) ] );
    }
    $post_ids = [];
    foreach ( $data['posts'] as $slug => $p ) {
        $live = get_page_by_path( $slug, OBJECT, 'post' );
        $post_ids[ $slug ] = $live ? $live->ID : wp_insert_post( [ 'post_type' => 'post', 'post_status' => 'draft', 'post_name' => $slug, 'post_title' => wp_slash( $p['title'] ) ] );
    }

    // Local page ID => live page ID.
    $links = [];
    foreach ( $data['links'] as $local_id => $slug ) {
        $live = $ids[ $slug ] ?? ( ( $p = get_page_by_path( $slug ) ) ? $p->ID : 0 );
        if ( $live ) {
            $links[ $local_id ] = $live;
        }
    }

    // Swaps local URLs in text for this site's.
    $fix = function ( $value ) use ( &$fix, $links ) {
        if ( is_array( $value ) ) {
            return array_map( $fix, $value );
        }
        if ( ! is_string( $value ) || strpos( $value, 'impressionbeauty.test' ) === false ) {
            return $value;
        }
        $value = preg_replace_callback( '#https?://impressionbeauty\.test/\?page_id=(\d+)#', fn( $m ) => isset( $links[ $m[1] ] ) ? get_permalink( $links[ $m[1] ] ) : home_url( '/' ), $value );
        return str_replace( 'https://impressionbeauty.test', untrailingslashit( home_url() ), $value );
    };

    // An exported ACF value, with local image / page IDs swapped for this site's.
    $value_for = function ( $v ) use ( $media, $links, $fix ) {
        switch ( $v['type'] ) {
            case 'image':
            case 'file':
                return $v['value'] ? ( $media[ $v['value'] ] ?? '' ) : '';
            case 'gallery':
                return array_values( array_filter( array_map( fn( $id ) => $media[ $id ] ?? 0, (array) $v['value'] ) ) );
            case 'page_link':
            case 'post_object':
                return is_numeric( $v['value'] ) ? ( $links[ $v['value'] ] ?? '' ) : $fix( $v['value'] );
        }
        return $fix( $v['value'] );
    };

    $write_acf = function ( $post_id, $acf ) use ( $value_for ) {
        impression_acf_migration_clear_acf( $post_id );
        foreach ( (array) $acf as $key => $v ) {
            update_post_meta( $post_id, $key, wp_slash( $value_for( $v ) ) );
            update_post_meta( $post_id, '_' . $key, $v['ref'] );
        }
    };

    foreach ( $data['pages'] as $slug => $p ) {
        $id = $ids[ $slug ];
        wp_update_post( wp_slash( [ 'ID' => $id, 'post_title' => $p['title'], 'post_status' => $p['status'], 'post_content' => $fix( $p['content'] ), 'post_excerpt' => $p['excerpt'] ] ) );
        update_post_meta( $id, '_wp_page_template', $p['template'] ? $p['template'] : 'default' );
        $write_acf( $id, $p['acf'] );
        echo "  page $slug: $id\n";
    }

    foreach ( $data['posts'] as $slug => $p ) {
        $id   = $post_ids[ $slug ];
        $cats = [];
        foreach ( $p['categories'] as $c ) {
            $term   = term_exists( $c['slug'], 'category' );
            $cats[] = $term ? (int) $term['term_id'] : (int) wp_insert_term( $c['name'], 'category', [ 'slug' => $c['slug'] ] )['term_id'];
        }
        wp_update_post( wp_slash( [ 'ID' => $id, 'post_title' => $p['title'], 'post_status' => 'publish', 'post_content' => $fix( $p['content'] ), 'post_excerpt' => $p['excerpt'], 'post_date' => $p['date'], 'post_date_gmt' => get_gmt_from_date( $p['date'] ), 'post_category' => $cats ] ) );
        if ( ! empty( $media[ $p['thumbnail'] ] ) ) {
            set_post_thumbnail( $id, $media[ $p['thumbnail'] ] );
        }
        echo "  post $slug: $id\n";
    }

    // Footer settings (ACF options).
    $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'options\_footer%' OR option_name LIKE '\_options\_footer%'" );
    wp_cache_delete( 'alloptions', 'options' );
    foreach ( $data['options'] as $key => $v ) {
        update_option( $key, $value_for( $v ) );
        update_option( '_' . $key, $v['ref'] );
    }
    echo '  footer settings: ' . count( $data['options'] ) . " values\n";

    update_option( 'wp_page_for_privacy_policy', $ids['privacy-policy'] );
    echo "  privacy policy page: {$ids['privacy-policy']}\n";

    // The separate FAQ pages are merged into the main FAQ page.
    foreach ( [ 'faq-face-care', 'faq-body-care' ] as $slug ) {
        $p = get_page_by_path( $slug );
        if ( $p && $p->post_status === 'publish' ) {
            wp_update_post( [ 'ID' => $p->ID, 'post_status' => 'draft' ] );
            echo "  $slug set to draft\n";
        }
    }

    // imp@impressionbeauty.com.sg does not exist; the mailbox is imp@impressionbeauty.com.
    $bad  = 'imp@impressionbeauty.com.sg';
    $like = '%' . $wpdb->esc_like( $bad ) . '%';
    $n    = 0;
    foreach ( $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type <> 'revision' AND post_content LIKE %s", $like ) ) as $pid ) {
        wp_update_post( wp_slash( [ 'ID' => $pid, 'post_content' => str_replace( $bad, 'imp@impressionbeauty.com', get_post_field( 'post_content', $pid, 'raw' ) ) ] ) );
        $n++;
    }
    foreach ( $wpdb->get_results( $wpdb->prepare( "SELECT meta_id, post_id, meta_value FROM $wpdb->postmeta WHERE meta_value LIKE %s", $like ) ) as $row ) {
        $wpdb->update( $wpdb->postmeta, [ 'meta_value' => str_replace( $bad, 'imp@impressionbeauty.com', $row->meta_value ) ], [ 'meta_id' => $row->meta_id ] );
        clean_post_cache( $row->post_id );
        $n++;
    }
    echo "  $bad replaced in $n place(s)\n";

    return $ids;
}

// Eye Care + Hair Removal under Services (Face, Body, Eye, Hair, Mole), News → the News page.
function impression_acf_migration_menu( $ids ) {
    $menu_id = get_nav_menu_locations()['primary'] ?? 0;
    if ( ! $menu_id ) {
        echo "  !! no menu in the Primary location — add the pages in Appearance → Menus\n";
        return;
    }
    $items   = wp_get_nav_menu_items( $menu_id );
    $in_menu = [];
    $parent  = 0;
    foreach ( $items as $i ) {
        if ( $i->object === 'page' ) {
            $in_menu[] = (int) $i->object_id;
            if ( (int) $i->object_id === (int) $ids['face-care'] ) {
                $parent = (int) $i->menu_item_parent;
            }
        }
    }
    foreach ( [ 'eye-care' => 'Eye Care', 'hair-removal' => 'Hair Removal' ] as $slug => $label ) {
        if ( ! in_array( (int) $ids[ $slug ], $in_menu, true ) ) {
            wp_update_nav_menu_item( $menu_id, 0, [ 'menu-item-object-id' => $ids[ $slug ], 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-parent-id' => $parent, 'menu-item-status' => 'publish', 'menu-item-title' => $label ] );
            echo "  added $label\n";
        }
    }

    $news_done = false;
    foreach ( $items as $i ) {
        if ( ! (int) $i->menu_item_parent && html_entity_decode( $i->title ) === 'News' ) {
            wp_update_nav_menu_item( $menu_id, $i->ID, [ 'menu-item-title' => 'News', 'menu-item-object-id' => $ids['news'], 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish', 'menu-item-position' => $i->menu_order, 'menu-item-parent-id' => 0 ] );
            echo "  News now opens the News page\n";
            $news_done = true;
        }
    }
    if ( ! $news_done ) {
        echo "  !! no top-level News item found — add the News page in Appearance → Menus\n";
    }

    // Order: Face, Body, Eye, Hair, Mole under Services; everything else keeps its order.
    if ( ! $parent ) {
        return;
    }
    $want  = array_map( fn( $s ) => (int) $ids[ $s ], [ 'face-care', 'body-care', 'eye-care', 'hair-removal', 'mole-warts-removal' ] );
    $items = wp_get_nav_menu_items( $menu_id );
    $kids  = array_filter( $items, fn( $i ) => (int) $i->menu_item_parent === $parent );
    $pos   = function ( $i ) use ( $want ) {
        $at = array_search( (int) $i->object_id, $want, true );
        return $at === false ? 99 : $at;
    };
    usort( $kids, fn( $a, $b ) => $pos( $a ) <=> $pos( $b ) );
    $order = 1;
    foreach ( $items as $i ) {
        if ( (int) $i->menu_item_parent === $parent ) {
            continue;
        }
        wp_update_post( [ 'ID' => $i->ID, 'menu_order' => $order++ ] );
        if ( (int) $i->ID === $parent ) {
            foreach ( $kids as $k ) {
                wp_update_post( [ 'ID' => $k->ID, 'menu_order' => $order++ ] );
            }
        }
    }
    echo "  Services order: Face, Body, Eye, Hair, Mole\n";
}
