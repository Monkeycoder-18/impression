<?php
/*
 * Template Name: Promotion Page
 * Template Post Type: page
 */
get_header();

$promo_badge   = get_field('promo_badge');
$promo_heading = get_field('promo_heading');
$promo_intro   = get_field('promo_intro');
$promotions    = get_field('promotions');
?>

<!-- PROMOTIONS HERO -->
<section class="inner-page-hero">
    <div class="container text-center">
        <span class="badge-beauty"><?php echo esc_html($promo_badge ? $promo_badge : 'Limited Time Offers'); ?></span>
        <h1 class="inner-page-hero-title mt-3"><?php echo esc_html($promo_heading ? $promo_heading : get_the_title()); ?></h1>
        <?php if ($promo_intro) : ?>
            <p class="inner-page-hero-sub mx-auto"><?php echo esc_html($promo_intro); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- PROMOTIONS -->
<?php if ($promotions) : ?>
    <?php foreach ($promotions as $pi => $promo) :
        $p_image = $promo['image'] ?? null;
        ?>
        <section class="py-4">
            <div class="container">
                <div class="trend-box">
                    <div class="row g-0 align-items-stretch<?php echo $pi % 2 ? ' flex-lg-row-reverse' : ''; ?>">

                        <?php if ($p_image) : ?>
                            <div class="col-lg-5">
                                <img src="<?php echo esc_url($p_image['url']); ?>"
                                    alt="<?php echo esc_attr($p_image['alt'] ? $p_image['alt'] : ($promo['title'] ?? '')); ?>"
                                    style="width:100%; height:100%; object-fit:cover; min-height:340px;">
                            </div>
                        <?php endif; ?>

                        <div class="<?php echo $p_image ? 'col-lg-7' : 'col-12'; ?>">
                            <div class="trend-content">
                                <?php if (!empty($promo['subtitle'])) : ?>
                                    <span class="badge-beauty"><?php echo esc_html($promo['subtitle']); ?></span>
                                <?php endif; ?>
                                <h2 class="mt-3 mb-3"><?php echo esc_html($promo['title'] ?? ''); ?></h2>
                                <div class="page-content"><?php echo wp_kses_post($promo['description'] ?? ''); ?></div>
                                <?php if (!empty($promo['price'])) : ?>
                                    <p class="promo-price"><?php echo esc_html($promo['price']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($promo['terms'])) : ?>
                                    <div class="promo-terms"><?php echo wp_kses_post($promo['terms']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
<?php else : ?>
    <section class="py-5">
        <div class="container">
            <p class="text-center text-muted">There are no promotions at the moment. Please check back soon.</p>
        </div>
    </section>
<?php endif; ?>

<?php get_template_part('template-parts/front-page/newsletter'); ?>

<?php get_footer(); ?>
