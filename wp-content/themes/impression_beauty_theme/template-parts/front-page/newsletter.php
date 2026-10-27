<?php
// Also used on the service pages, so always read the heading from the home page.
$front_id        = get_option('page_on_front');
$reviews_eyebrow = get_field('home_reviews_eyebrow', $front_id);
$reviews_heading = get_field('home_reviews_heading', $front_id);
$reviews_intro   = get_field('home_reviews_intro', $front_id);
?>
<!-- NEWSLETTER -->
<section class="py-5 section-bg-white pt-5">
    <div class="container">
        <div class="newsletter google-reviews-panel text-center">
            <div class="google-reviews-heading">
                <span class="google-reviews-eyebrow"><?php echo esc_html($reviews_eyebrow ? $reviews_eyebrow : 'Client Experiences'); ?></span>
                <div class="google-reviews-stars" aria-hidden="true">★★★★★</div>
                <h2><?php echo esc_html($reviews_heading ? $reviews_heading : 'What Our Clients Say on Google'); ?></h2>
                <p><?php echo esc_html($reviews_intro ? $reviews_intro : 'Real experiences from clients who trust Impression Beauty with their care.'); ?></p>
            </div>

            <div class="google-reviews-widget">
                <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
            </div>
        </div>
    </div>
</section>
