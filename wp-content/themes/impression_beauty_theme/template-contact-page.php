<?php
/*
 * Template Name: Contact Us Page
 * Template Post Type: page
 */
get_header();
?>

<!-- CONTACT HERO -->
<section class="inner-page-hero inner-page-hero--contact">
    <div class="container text-center">
        <span class="badge-beauty">Get In Touch</span>
        <h1 class="inner-page-hero-title mt-3">
            We'd Love to <span>Hear From You</span>
        </h1>
        <p class="inner-page-hero-sub mx-auto">
            Book an appointment, ask a question, or simply say hello — our friendly team is ready to assist you.
        </p>
    </div>
</section>

<!-- CONTACT INFO CARDS -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">

            <div class="col-md-6 col-lg-3">
                <div class="contact-info-card">
                    <div class="contact-info-icon">📍</div>
                    <h6>Our Location</h6>
                    <p>6 Eu Tong Sen St #04-75,<br>Clarke Quay Central,<br>Singapore 059817</p>
                    <a href="https://maps.google.com/?q=6+Eu+Tong+Sen+St+%2304-75+Clarke+Quay+Central+Singapore+059817"
                        target="_blank" rel="noopener"
                        class="contact-info-link">
                        Get Directions →
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="contact-info-card">
                    <div class="contact-info-icon">📞</div>
                    <h6>Call Us</h6>
                    <p>
                        <a href="tel:+6563339093" class="contact-info-tel">+65 6333 9093</a><br>
                        <!-- <a href="tel:+6562551126" class="contact-info-tel">+65 6255 1126</a> -->
                    </p>
                    <a href="https://wa.me/6580102500" target="_blank" rel="noopener" class="contact-info-link">
                        WhatsApp Us →
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="contact-info-card">
                    <div class="contact-info-icon">✉️</div>
                    <h6>Email Us</h6>
                    <p>
                        <a href="mailto:imp@impressionbeauty.com.sg" class="contact-info-tel">
                            imp@impressionbeauty.com
                        </a>
                    </p>
                    <a href="mailto:imp@impressionbeauty.com.sg" class="contact-info-link">
                        Send Email →
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="contact-info-card">
                    <div class="contact-info-icon">🕐</div>
                    <h6>Opening Hours</h6>
                    <p>
                        Mon – Fri: 11:30am – 8:45pm<br>
                        Sat &amp; Sun: 10:30am – 6:30pm<br>
                        Sun & Public Holiday - Closed
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CONTACT FORM + MAP -->
<section class="contact-form-section py-5">
    <div class="container">
        <div class="row g-5 align-items-stretch">

            <!-- FORM -->
            <div class="col-lg-6">
                <div class="contact-form-wrap h-100">

                    <span class="badge-beauty mb-3 d-inline-block">Send a Message</span>
                    <h2 class="mb-2">Book an Appointment</h2>
                    <p class="text-muted mb-4" style="line-height:1.8;">
                        Fill in the form and our team will get back to you within one business day.
                    </p>

                    <?php
                    // If Contact Form 7 is active, swap the line below with your CF7 shortcode:
                    // echo do_shortcode('[contact-form-7 id="YOUR_ID" title="Contact Form"]');
                    // Otherwise the native form below is used.
                    if (shortcode_exists('contact-form-7')) :
                        // Replace YOUR_FORM_ID with your actual CF7 form ID
                        echo do_shortcode('[contact-form-7 id="5" title="Contact form 1"]');
                    else :
                    ?>
                        <form class="contact-native-form" method="post"
                            action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                            <?php wp_nonce_field('impression_contact', 'impression_contact_nonce'); ?>
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

            <!-- MAP -->
            <div class="col-lg-6">
                <div class="contact-map-wrap h-100">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8186!2d103.8453!3d1.2881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da197db7fa8f83%3A0xb92d4d455a35b8d1!2s6%20Eu%20Tong%20Sen%20St%2C%20Clarke%20Quay%20Central%2C%20Singapore%20059817!5e0!3m2!1sen!2ssg!4v1700000000000!5m2!1sen!2ssg"
                        width="100%"
                        height="100%"
                        style="border:0;min-height:450px;border-radius:24px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Impression Beauty Location">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- VISIT US CTA -->
<section class="py-5">
    <div class="container">
        <div class="consultation-banner">
            <div class="row align-items-center g-4">
                <div class="col-lg-8 text-center text-lg-start">
                    <span class="badge-beauty-light mb-3 d-inline-block">Always Be Impressed</span>
                    <h2 class="mb-2">Come Visit Us at Clarke Quay</h2>
                    <p class="opacity-75 mb-0">
                        Walk into our welcoming space at #04-75 Clarke Quay Central and experience the difference firsthand.
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="tel:+6563339093"
                        class="btn btn-light px-5 py-3 rounded-pill"
                        style="color:var(--primary);">
                        📞 Call Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>