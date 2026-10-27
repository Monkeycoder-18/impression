<?php

// ──────────────────────────────────────────────
// Enquiry forms (Contact page + service pages).
// Both post to admin-post.php with action=impression_contact_form,
// and the enquiry is emailed to the address set under Footer → Contact.
// ──────────────────────────────────────────────
add_action( 'admin_post_nopriv_impression_contact_form', 'impression_handle_contact_form' );
add_action( 'admin_post_impression_contact_form', 'impression_handle_contact_form' );

function impression_handle_contact_form() {
    $back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
    $back = remove_query_arg( 'enquiry', $back );
    $anchor = isset( $_POST['contact_anchor'] ) ? sanitize_key( $_POST['contact_anchor'] ) : '';
    $redirect = function ( $status ) use ( $back, $anchor ) {
        wp_safe_redirect( add_query_arg( 'enquiry', $status, $back ) . ( $anchor ? '#' . $anchor : '' ) );
        exit;
    };

    if ( ! isset( $_POST['impression_contact_nonce'] ) || ! wp_verify_nonce( $_POST['impression_contact_nonce'], 'impression_contact' ) ) {
        $redirect( 'error' );
    }

    // Spam trap: real visitors never see or fill this field.
    if ( ! empty( $_POST['contact_website'] ) ) {
        $redirect( 'sent' );
    }

    $name      = sanitize_text_field( wp_unslash( $_POST['contact_name'] ?? '' ) );
    $email     = sanitize_email( wp_unslash( $_POST['contact_email'] ?? '' ) );
    $phone     = sanitize_text_field( wp_unslash( $_POST['contact_phone'] ?? '' ) );
    $treatment = sanitize_text_field( wp_unslash( $_POST['contact_treatment'] ?? '' ) );
    $message   = sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ?? '' ) );
    $source    = sanitize_text_field( wp_unslash( $_POST['contact_source'] ?? '' ) );

    if ( ! $name || ! is_email( $email ) ) {
        $redirect( 'invalid' );
    }

    $lines = [
        'Name: ' . $name,
        'Email: ' . $email,
        'Phone: ' . ( $phone ? $phone : '-' ),
    ];
    if ( $treatment ) {
        $lines[] = 'Treatment: ' . $treatment;
    }
    $lines[] = 'Sent from: ' . ( $source ? $source : $back );
    if ( $message ) {
        $lines[] = '';
        $lines[] = $message;
    }

    $headers = [
        'From: Impression Beauty Website <noreply@impressionbeauty.com>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    ];

    $sent = wp_mail( impression_enquiry_email(), 'Website enquiry from ' . $name, implode( "\n", $lines ), $headers );

    $redirect( $sent ? 'sent' : 'error' );
}

// Thank-you / error notice shown above a form after it is submitted.
function impression_enquiry_notice() {
    $status = isset( $_GET['enquiry'] ) ? sanitize_key( $_GET['enquiry'] ) : '';
    $notices = [
        'sent'    => [ 'success', 'Thank you! Your enquiry has been sent and we will get back to you shortly.' ],
        'invalid' => [ 'warning', 'Please enter your name and a valid email address.' ],
        'error'   => [ 'danger', 'Sorry, your enquiry could not be sent. Please call or WhatsApp us instead.' ],
    ];
    if ( isset( $notices[ $status ] ) ) {
        printf( '<div class="alert alert-%s mb-3" role="alert">%s</div>', esc_attr( $notices[ $status ][0] ), esc_html( $notices[ $status ][1] ) );
    }
}

// Hidden fields every enquiry form needs.
function impression_enquiry_hidden_fields( $anchor ) {
    wp_nonce_field( 'impression_contact', 'impression_contact_nonce' );
    ?>
    <input type="hidden" name="action" value="impression_contact_form">
    <input type="hidden" name="contact_anchor" value="<?php echo esc_attr( $anchor ); ?>">
    <input type="hidden" name="contact_source" value="<?php echo esc_attr( get_the_title() ); ?>">
    <div class="enquiry-trap" aria-hidden="true">
        <input type="text" name="contact_website" tabindex="-1" autocomplete="off">
    </div>
    <?php
}
