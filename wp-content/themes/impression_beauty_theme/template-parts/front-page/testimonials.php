<?php

$testimonials         = get_field('testimonials-repeater');
$testimonials_heading = get_field('home_testimonials_heading');
$testimonials_intro   = get_field('home_testimonials_intro');

?>

<!-- TESTIMONIALS -->
<section class="testimonials-section py-5 ">
    <div class="container">

        <div class="section-title">
            <h2><?php echo esc_html($testimonials_heading ? $testimonials_heading : 'Testimonials'); ?></h2>
            <p><?php echo $testimonials_intro ? wp_kses_post($testimonials_intro) : 'Know what our customers say. <br> Loved by beauty enthusiasts and skincare lovers.'; ?></p>
        </div>

        <?php if ($testimonials) : ?>
            <div class="testimonials-circles">
                <?php foreach ($testimonials as $item) :
                    $name   = $item['testimonial-name']  ?? '';
                    $quote  = $item['testimonial-quote']  ?? '';
                    $photo  = $item['testimonial-photo']  ?? '';
                    $avatar = $photo ?: get_avatar_url(0, ['size' => 140, 'default' => 'mysteryman']);
                ?>
                    <div class="testimonial-circle-item">

                        <div class="testimonial-avatar-ring">
                            <img
                                src="<?php echo esc_url($avatar); ?>"
                                alt="<?php echo esc_attr($name); ?>"
                                class="testimonial-avatar"
                            >
                        </div>

                        <div class="testimonial-bubble">
                            <span class="testimonial-quote-mark">&ldquo;</span>
                            <?php if ($quote) : ?>
                                <p class="testimonial-text"><?php echo esc_html($quote); ?></p>
                            <?php endif; ?>
                            <?php if ($name) : ?>
                                <h6 class="testimonial-name"><?php echo esc_html($name); ?></h6>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
