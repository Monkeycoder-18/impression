<?php

$hero_title      = get_field('header-hero-header');
$hero_subtitle   = get_field('header-hero-content');
$hero_background = get_field('hero-image-background');
$hero_slider     = get_field('hero-repeater-image');

$bg_url    = is_array($hero_background) ? ($hero_background['url'] ?? '') : (string) $hero_background;
$bg_mime   = is_array($hero_background) ? ($hero_background['mime_type'] ?? '') : '';
$has_video = !empty($bg_url) && (
    strpos($bg_mime, 'video/') === 0 ||
    in_array(strtolower(pathinfo(parse_url($bg_url, PHP_URL_PATH), PATHINFO_EXTENSION)), ['mp4', 'webm', 'ogg', 'mov'])
);
$has_image = !empty($bg_url) && !$has_video;

?>

<style>
.hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    <?php if ($has_image && !$has_video) : ?>
    background-image:
        linear-gradient(to right, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.7)),
        url('<?php echo esc_url($bg_url); ?>');
    background-size: cover;
    background-position: center;
    <?php endif; ?>
}

.hero-video-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    z-index: 0;
}

.hero-video-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.6));
    z-index: 1;
}

.hero .container {
    position: relative;
    z-index: 2;
}
</style>

<!-- HERO -->
<section class="hero">

    <?php if ($has_video) : ?>
        <video
            class="hero-video-bg"
            src="<?php echo esc_url($bg_url); ?>"
            autoplay
            muted
            loop
            playsinline
        ></video>
        <div class="hero-video-overlay"></div>
    <?php endif; ?>

    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6 ms-auto text-end">
                <?php if ($hero_title) : ?>
                    <?php echo $hero_title; ?>
                <?php endif; ?>

                <?php if ($hero_subtitle) : ?>
                    <p><?php echo wp_kses_post($hero_subtitle); ?></p>
                <?php endif; ?>
            </div>

            <?php if ($hero_slider) : ?>
                <div class="col-lg-6">
                    <div class="hero-img">
                        <div class="hero-slider">
                            <?php foreach ($hero_slider as $index => $row) :
                                $img_url = $row['hero-slider-images'];
                                if (!$img_url) continue;
                                $active = $index === 0 ? ' active' : '';
                            ?>
                                <div class="hero-slide<?php echo $active; ?>">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="hero-dots">
                            <?php foreach ($hero_slider as $index => $row) :
                                if (!$row['hero-slider-images']) continue;
                                $active = $index === 0 ? ' active' : '';
                            ?>
                                <span class="hero-dot<?php echo $active; ?>" data-index="<?php echo $index; ?>"></span>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>