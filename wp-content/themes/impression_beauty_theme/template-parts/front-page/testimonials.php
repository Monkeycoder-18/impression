<?php

$testimonials = get_field('testimonials-repeater');

?>

<!-- TESTIMONIALS -->
<section class="py-5">
    <div class="container">

        <div class="section-title">
            <h2>Testimonials</h2>
            <p>Know what our customer say. <br> Loved by beauty enthusiasts and skincare lovers.</p>
        </div>

        <?php if ($testimonials) : ?>
            <div class="row g-4">
                <?php foreach ($testimonials as $item) :
                    $name    = $item['testimonial-name'] ?? '';
                    $quote   = $item['testimonial-quote'] ?? '';
                    $photo   = $item['testimonial-photo'] ?? '';
                ?>
                    <div class="col-md-4">
                        <div class="testimonial">
                            <?php
                            $avatar = $photo ?: get_avatar_url(0, ['size' => 70, 'default' => 'mysteryman']);
                            ?>
                            <img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($name); ?>">
                            <?php if ($quote) : ?>
                                <p>"<?php echo esc_html($quote); ?>"</p>
                            <?php endif; ?>
                            <?php if ($name) : ?>
                                <h6 class="mb-0"><?php echo esc_html($name); ?></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
