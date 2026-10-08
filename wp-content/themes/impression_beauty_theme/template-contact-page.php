<?php
/*
 * Template Name: Contact Us Page
 * Template Post Type: page
 */
get_header();

$hero_badge     = get_field( 'contact_hero_badge' );
$hero_title     = get_field( 'contact_hero_title' );
$hero_highlight = get_field( 'contact_hero_highlight' );
$hero_intro     = get_field( 'contact_hero_intro' );

$details_badge = get_field( 'contact_details_badge' );
$details_line1 = get_field( 'contact_details_heading_line_1' );
$details_line2 = get_field( 'contact_details_heading_line_2' );
$details_intro = get_field( 'contact_details_intro' );
$details       = get_field( 'contact_details' );

$map_url   = get_field( 'contact_map_url' );
$map_title = get_field( 'contact_map_title' );

$visit_badge  = get_field( 'contact_visit_badge' );
$visit_heading = get_field( 'contact_visit_heading' );
$visit_text   = get_field( 'contact_visit_text' );
$visit_button = get_field( 'contact_visit_button' );
$visit_link   = get_field( 'contact_visit_button_link' );
?>

<!-- CONTACT HERO -->
<section class="inner-page-hero inner-page-hero--contact">
    <div class="container text-center">
        <?php if ( $hero_badge ) : ?>
            <span class="badge-beauty"><?php echo esc_html( $hero_badge ); ?></span>
        <?php else : ?>
            <span class="badge-beauty">Get In Touch</span>
        <?php endif; ?>
        <h1 class="inner-page-hero-title mt-3">
            <?php if ( $hero_title || $hero_highlight ) : ?>
                <?php echo esc_html( $hero_title ); ?><?php if ( $hero_highlight ) : ?> <span><?php echo esc_html( $hero_highlight ); ?></span><?php endif; ?>
            <?php else : ?>
                We'd Love to <span>Hear From You</span>
            <?php endif; ?>
        </h1>
        <?php if ( $hero_intro ) : ?>
            <div class="inner-page-hero-sub mx-auto"><?php echo wp_kses_post( $hero_intro ); ?></div>
        <?php else : ?>
            <p class="inner-page-hero-sub mx-auto">
                Book an appointment, ask a question, or simply say hello — our friendly team is ready to assist you.
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- CONTACT DETAILS + FORM -->
<section class="contact-form-section py-5">
    <div class="container">
        <div class="row g-5 align-items-start">

            <!-- DETAILS -->
            <div class="col-lg-5">
                <div class="contact-details-wrap">
                    <?php if ( $details_badge ) : ?>
                        <span class="badge-beauty mb-3 d-inline-block"><?php echo esc_html( $details_badge ); ?></span>
                    <?php else : ?>
                        <span class="badge-beauty mb-3 d-inline-block">Get In Touch</span>
                    <?php endif; ?>
                    <h2 class="mb-3">
                        <?php if ( $details_line1 || $details_line2 ) : ?>
                            <?php echo esc_html( $details_line1 ); ?>
                            <?php if ( $details_line2 ) : ?>
                                <br><?php echo esc_html( $details_line2 ); ?>
                            <?php endif; ?>
                        <?php else : ?>
                            Need to book an appointment<br>or make an enquiry?
                        <?php endif; ?>
                    </h2>

                    <div class="contact-divider" aria-hidden="true">
                        <span class="line"></span>
                        <span class="dot"></span>
                        <span class="line"></span>
                    </div>

                    <?php if ( $details_intro ) : ?>
                        <div class="text-muted mb-4" style="line-height:1.8;"><?php echo wp_kses_post( $details_intro ); ?></div>
                    <?php else : ?>
                        <p class="text-muted mb-4" style="line-height:1.8;">
                            Fill in the form and our team will attend to your request as soon as possible.
                            Alternatively, you can reach us using the contact details below.
                        </p>
                    <?php endif; ?>

                    <?php if ( $details ) : ?>
                        <?php foreach ( $details as $index => $detail ) :
                            $icon        = $detail['icon'] ?? '';
                            $title       = $detail['title'] ?? '';
                            $description = $detail['description'] ?? '';
                            $link        = $detail['link'] ?? '';
                            $link_label  = $detail['link_label'] ?? '';
                            $is_last     = $index === count( $details ) - 1;
                            ?>
                            <div class="contact-detail-item<?php echo $is_last ? ' mb-0' : ''; ?>">
                                <?php if ( $icon ) : ?>
                                    <div class="contact-detail-icon"><?php echo esc_html( $icon ); ?></div>
                                <?php endif; ?>
                                <div class="contact-detail-text">
                                    <?php if ( $title ) : ?>
                                        <h6><?php echo esc_html( $title ); ?></h6>
                                    <?php endif; ?>
                                    <?php if ( $link && ! $link_label && $description ) : ?>
                                        <p><a href="<?php echo esc_url( $link ); ?>" class="contact-info-tel"><?php echo esc_html( wp_strip_all_tags( $description ) ); ?></a></p>
                                    <?php elseif ( $description ) : ?>
                                        <?php echo wp_kses_post( $description ); ?>
                                    <?php endif; ?>
                                    <?php if ( $link && $link_label ) : ?>
                                        <a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener" class="contact-info-link">
                                            <?php echo esc_html( $link_label ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">📞</div>
                            <div class="contact-detail-text">
                                <h6>Call Us</h6>
                                <p><a href="tel:+6563339093" class="contact-info-tel">+65 6333 9093</a></p>
                            </div>
                        </div>
                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">✉️</div>
                            <div class="contact-detail-text">
                                <h6>Email Us</h6>
                                <p>
                                    <a href="mailto:imp@impressionbeauty.com.sg" class="contact-info-tel">
                                        imp@impressionbeauty.com
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="contact-detail-item">
                            <div class="contact-detail-icon">📍</div>
                            <div class="contact-detail-text">
                                <h6>Our Location</h6>
                                <p>6 Eu Tong Sen St #04-75, Clarke Quay Central, Singapore 059817</p>
                                <a href="https://maps.google.com/?q=6+Eu+Tong+Sen+St+%2304-75+Clarke+Quay+Central+Singapore+059817"
                                    target="_blank" rel="noopener"
                                    class="contact-info-link">
                                    Get Directions →
                                </a>
                            </div>
                        </div>
                        <div class="contact-detail-item mb-0">
                            <div class="contact-detail-icon">🕐</div>
                            <div class="contact-detail-text">
                                <h6>Clinic Hours</h6>
                                <p>
                                    Mon – Fri: 11:30am – 8:45pm<br>
                                    Sat &amp; Sun: 10:30am – 6:30pm<br>
                                    Sun &amp; Public Holiday - Closed
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- FORM -->
            <div class="col-lg-7">
                <div class="contact-form-wrap">
                    <?php
                    if ( shortcode_exists( 'contact-form-7' ) ) :
                        echo do_shortcode( '[contact-form-7 id="5" title="Contact form 1"]' );
                    else :
                    ?>
                        <form class="contact-native-form" method="post"
                            action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                            <?php wp_nonce_field( 'impression_contact', 'impression_contact_nonce' ); ?>
                            <input type="hidden" name="action" value="impression_contact_form">

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="contact-label">Full Name *</label>
                                    <input type="text" name="contact_name" class="contact-input form-control"
                                        placeholder="Jane Doe" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="contact-label">Phone Number</label>
                                    <input type="tel" name="contact_phone" class="contact-input form-control"
                                        placeholder="+65 9123 4567">
                                </div>
                                <div class="col-12">
                                    <label class="contact-label">Email Address *</label>
                                    <input type="email" name="contact_email" class="contact-input form-control"
                                        placeholder="you@email.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="contact-label">Treatment of Interest</label>
                                    <select name="contact_treatment" class="contact-input form-select">
                                        <option value="">Select a treatment…</option>
                                        <option value="face-care">Face Care</option>
                                        <option value="body-care">Body Care</option>
                                        <option value="eye-care">Eye Care</option>
                                        <option value="hair-removal">Hair Removal</option>
                                        <option value="mole-wart-removal">Mole &amp; Wart Removal</option>
                                        <option value="other">Other / Not Sure</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="contact-label">Message</label>
                                    <textarea name="contact_message" class="contact-input form-control"
                                        rows="4"
                                        placeholder="Tell us about your skin concern or preferred appointment time…"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-beauty w-100 py-3">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- MAP -->
<section class="contact-map-section pb-5">
    <div class="contact-map-wrap">
        <iframe
            src="<?php echo esc_url( $map_url ? $map_url : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8186!2d103.8453!3d1.2881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da197db7fa8f83%3A0xb92d4d455a35b8d1!2s6%20Eu%20Tong%20Sen%20St%2C%20Clarke%20Quay%20Central%2C%20Singapore%20059817!5e0!3m2!1sen!2ssg!4v1700000000000!5m2!1sen!2ssg' ); ?>"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="<?php echo esc_attr( $map_title ? $map_title : 'Impression Beauty Location' ); ?>">
        </iframe>
    </div>
</section>

<!-- VISIT US CTA -->
<section class="py-5">
    <div class="container">
        <div class="consultation-banner">
            <div class="row align-items-center g-4">
                <div class="col-lg-8 text-center text-lg-start">
                    <?php if ( $visit_badge ) : ?>
                        <span class="badge-beauty-light mb-3 d-inline-block"><?php echo esc_html( $visit_badge ); ?></span>
                    <?php else : ?>
                        <span class="badge-beauty-light mb-3 d-inline-block">Always Be Impressed</span>
                    <?php endif; ?>
                    <h2 class="mb-2">
                        <?php echo esc_html( $visit_heading ? $visit_heading : 'Come Visit Us at Clarke Quay' ); ?>
                    </h2>
                    <?php if ( $visit_text ) : ?>
                        <div class="opacity-75 mb-0"><?php echo wp_kses_post( $visit_text ); ?></div>
                    <?php else : ?>
                        <p class="opacity-75 mb-0">
                            Walk into our welcoming space at #04-75 Clarke Quay Central and experience the difference firsthand.
                        </p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="<?php echo esc_url( $visit_link ? $visit_link : 'tel:+6563339093' ); ?>"
                        class="btn btn-light px-5 py-3 rounded-pill"
                        style="color:var(--primary);">
                        <?php echo esc_html( $visit_button ? $visit_button : '📞 Call Now' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
