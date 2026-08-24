<!-- NEWSLETTER -->
<section class="py-5 section-bg-white pt-5">
    <div class="container">
        <div class="newsletter text-center">

            <h2 class="mb-3">Stay Updated With Impression Beauty</h2>
            <p class="mb-4">Get exclusive offers, skincare tips, and the latest beauty updates.</p>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <?php
                    /*
                     * If you install a newsletter plugin (e.g. Mailchimp for WP),
                     * replace the form below with its shortcode:
                     * echo do_shortcode( '[mc4wp_form id="123"]' );
                     */
                    ?>
                    <form class="input-group" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                        <input type="hidden" name="action" value="ib_newsletter_subscribe">
                        <?php wp_nonce_field( 'ib_newsletter_nonce', 'ib_nonce' ); ?>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
