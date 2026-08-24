<?php

$services = get_field('services-repeater');
?>

<!-- SERVICES -->
<section class="py-5 section-bg-white">
    <div class="container">

        <div class="section-title">
            <h2>Our Services</h2>
            <p>While we continue to grow with the times, we never follow trends blindly. We stay true to what’ s right — putting safety, sincerity, and authenticity at the heart of everything we do.</p>
        </div>

        <?php if ($services) : ?>
            <div class="row g-4">
                <?php foreach ($services as $service) :
                    $title       = $service['service-title'] ?? '';
                    $description = $service['service-description'] ?? '';
                    $image       = $service['service-image'] ?? '';
                    $link        = $service['service-link'] ?? '';
                ?>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <?php if ($image) : ?>
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                            <?php endif; ?>
                            <div class="feature-card-body">
                                <?php if ($title) : ?>
                                    <h5><?php echo esc_html($title); ?></h5>
                                <?php endif; ?>
                                <?php if ($description) : ?>
                                    <p><?php echo wp_kses_post($description); ?></p>
                                <?php endif; ?>
                                <?php if ($link) : ?>
                                    <a href="<?php echo esc_url($link); ?>" class="btn-service">Learn More</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>