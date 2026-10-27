<?php
/*
 * Template Name: Service Page
 * Template Post Type: page
 */
get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<?php
// ──────────────────────────────────────────────
// Read ACF fields. Every value falls back to the
// original hard-coded content, so an un-edited page
// looks exactly the same as before.
// ──────────────────────────────────────────────

// 1. Hero
$hero_badge       = get_field('service_hero_badge');
$hero_subtitle    = get_field('service_hero_subtitle');
$hero_image       = get_field('service_hero_image');
$hero_float_badge = get_field('service_hero_float_badge');
$hero_btn1_text   = get_field('service_hero_btn1_text');
$hero_btn1_link   = get_field('service_hero_btn1_link');
$hero_btn2_text   = get_field('service_hero_btn2_text');
$hero_btn2_link   = get_field('service_hero_btn2_link');

// 2. Stats bar
$stats = get_field('service_stats');
if (!$stats) {
    $stats = [
        ['number' => '30+',     'label' => 'Years Experience'],
        ['number' => '6,000+',  'label' => 'Successful Cases'],
        ['number' => '100%',    'label' => 'Herbal & Natural'],
        ['number' => '5&#9733;', 'label' => 'Customer Rated'],
    ];
}

// 3. Intro
$intro_image   = get_field('service_intro_image');
$intro_badge   = get_field('service_intro_badge');
$intro_heading = get_field('service_intro_heading');
$intro_p1      = get_field('service_intro_paragraph_1');
$intro_p2      = get_field('service_intro_paragraph_2');
$intro_checks  = get_field('service_intro_checks');
if (!$intro_checks) {
    $intro_checks = [
        ['text' => 'Professional Consultants'],
        ['text' => 'Proven Results'],
        ['text' => 'Personalised Care'],
    ];
}

// 4. Who is this for
$audience_heading    = get_field('service_audience_heading');
$audience_subheading = get_field('service_audience_subheading');
$audience_cards      = get_field('service_audience_cards');
if (!$audience_cards) {
    $audience_cards = [
        ['image' => 'https://images.unsplash.com/photo-1741896136331-10375875eff4?w=600&h=700&fit=crop&q=80', 'title' => 'Dry & Sensitive Skin',    'description' => 'Restore hydration and soothe irritated skin.'],
        ['image' => 'https://images.unsplash.com/photo-1653784097013-786a8965ea3b?w=600&h=700&fit=crop&q=80', 'title' => 'Oily & Combination Skin', 'description' => 'Control excess sebum and refine large pores.'],
        ['image' => 'https://images.unsplash.com/photo-1768483018807-bd0b9ab86539?w=600&h=700&fit=crop&q=80', 'title' => 'Pigmentation & Ageing',   'description' => 'Even skin tone and reduce visible signs of ageing.'],
    ];
}

// 5. Treatments
$treatments_heading    = get_field('service_treatments_heading');
$treatments_subheading = get_field('service_treatments_subheading');
$treatments            = get_field('service_treatments');
if (!$treatments) {
    $treatments = [
        ['duration' => '90 mins', 'name' => 'Multi Fruits Energizing Treatment', 'description' => 'High minerals & vitamins content products to strengthen skin cellular and protect skin against free radical and UV lights, fighting skin ageing for a brighter, fairer look.'],
        ['duration' => '90 mins', 'name' => 'Skin RejuV Treatment',              'description' => 'Dry flaky and red skin treatment using complete Hydra Silk skin care with high silk protein that immediately replaces lost moisture. Reduces redness and anti-sensitivity.'],
        ['duration' => '60 mins', 'name' => 'RF Treatment',                       'description' => 'For mature sagging skin. Using Bio Heat to promote cell regeneration, improve blood and lymph circulation, and provide an instant lift.'],
        ['duration' => '90 mins', 'name' => 'Skin Fruition / Renewal Treatment',  'description' => 'For oily blemishes non-sensitive skin. With AHA range products to soften, smoothen, lighten uneven skin and reduce blemishes.'],
        ['duration' => '90 mins', 'name' => 'Acne Treatment',                     'description' => 'Deep cleansing with anti-septic and healing effect. Controls sebum secretion and prevents bacterial infection for oily blemish-prone skin.'],
        ['duration' => '80 mins', 'name' => 'Diamond Peel Treatment',             'description' => 'Effectively removes dead skin cells, refines large pores, smoothens scars and evens skin tone for large pore, rough & slight blemish skin.'],
    ];
}

// 6. How it works
$process_heading    = get_field('service_process_heading');
$process_subheading = get_field('service_process_subheading');
$process_steps      = get_field('service_process_steps');
if (!$process_steps) {
    $process_steps = [
        ['number' => '01', 'title' => 'Free Consultation',     'description' => 'Our expert consultant analyses your skin and discusses your concerns to recommend the most suitable treatment plan.'],
        ['number' => '02', 'title' => 'Treatment Application',  'description' => 'Your chosen treatment is professionally administered in a clean, comfortable environment. Most sessions take 45–90 mins.'],
        ['number' => '03', 'title' => 'Review & Follow Up',     'description' => 'We schedule a follow-up to review your results and adjust your treatment plan for continued improvement.'],
    ];
}

// 8. Consultation CTA
$cta_badge         = get_field('service_cta_badge');
$cta_heading       = get_field('service_cta_heading');
$cta_text          = get_field('service_cta_text');
$cta_phone_text    = get_field('service_cta_phone_text');
$cta_phone_link    = get_field('service_cta_phone_link');
$cta_whatsapp_text = get_field('service_cta_whatsapp_text');
$cta_whatsapp_link = get_field('service_cta_whatsapp_link');
$cta_hours         = get_field('service_cta_hours');

// Helper: pull a usable image URL from an ACF image array or a plain string.
$img_url = function ($img) {
    if (is_array($img)) {
        return $img['url'] ?? '';
    }
    return $img ? $img : '';
};
?>

<!-- ═══════════════════════════════════════════
     1. SERVICE HERO
═══════════════════════════════════════════ -->
    <section class="service-hero">
        <div class="service-hero-bg"></div>
        <div class="container position-relative">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <span class="badge-beauty mb-3 d-inline-block">
                        <?php echo esc_html($hero_badge ? $hero_badge : 'Impression Beauty'); ?>
                    </span>
                    <h1 class="service-hero-title">
                        <?php the_title(); ?>
                    </h1>
                    <?php if ($hero_subtitle) : ?>
                        <p class="service-hero-sub"><?php echo esc_html($hero_subtitle); ?></p>
                    <?php elseif (has_excerpt()) : ?>
                        <p class="service-hero-sub"><?php the_excerpt(); ?></p>
                    <?php else : ?>
                        <p class="service-hero-sub">
                            Professional treatments tailored to your skin and wellness needs.
                            Trusted by thousands of satisfied customers since 1994.
                        </p>
                    <?php endif; ?>
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <a href="<?php echo esc_url($hero_btn1_link ? $hero_btn1_link : '#treatments'); ?>" class="btn btn-beauty">
                            <?php echo esc_html($hero_btn1_text ? $hero_btn1_text : 'View Treatments'); ?>
                        </a>
                        <a href="<?php echo esc_url($hero_btn2_link ? $hero_btn2_link : '#consultation'); ?>" class="btn btn-outline-dark rounded-pill px-4 py-2">
                            <?php echo esc_html($hero_btn2_text ? $hero_btn2_text : 'Free Consultation'); ?>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="service-hero-img-wrap">
                        <?php if ($hero_image && $img_url($hero_image)) : ?>
                            <img src="<?php echo esc_url($img_url($hero_image)); ?>"
                                alt="<?php echo esc_attr(is_array($hero_image) && !empty($hero_image['alt']) ? $hero_image['alt'] : get_the_title()); ?>"
                                class="service-hero-img">
                        <?php elseif (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', ['class' => 'service-hero-img']); ?>
                        <?php else : ?>
                            <img src="https://images.unsplash.com/photo-1758600587391-338f5376b7ed?w=700&h=800&fit=crop&q=80"
                                alt="<?php the_title_attribute(); ?>"
                                class="service-hero-img">
                        <?php endif; ?>
                        <div class="service-hero-badge-float">
                            <span>&#10003;</span> <?php echo esc_html($hero_float_badge ? $hero_float_badge : 'Since 1994'); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     2. TRUST STATS BAR
═══════════════════════════════════════════ -->
    <section class="stats-bar py-4">
        <div class="container">
            <div class="row g-3 text-center">
                <?php foreach ($stats as $stat) : ?>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <h3 class="stat-number"><?php echo wp_kses_post($stat['number'] ?? ''); ?></h3>
                            <p class="stat-label"><?php echo wp_kses_post($stat['label'] ?? ''); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     3. SERVICE INTRO (Split layout)
═══════════════════════════════════════════ -->
    <section class="py-5 my-3">
        <div class="container">
            <div class="trend-box">
                <div class="row g-0 align-items-stretch">

                    <div class="col-lg-5">
                        <img src="<?php echo esc_url($intro_image && $img_url($intro_image) ? $img_url($intro_image) : 'https://images.unsplash.com/photo-1763539818420-165e69b7489b?w=800&h=700&fit=crop&q=80'); ?>"
                            alt="<?php echo esc_attr($intro_heading ? $intro_heading : 'Service Introduction'); ?>"
                            style="width:100%; height:100%; object-fit:cover; min-height:420px;">
                    </div>

                    <div class="col-lg-7">
                        <div class="trend-content">
                            <span class="badge-beauty"><?php echo esc_html($intro_badge ? $intro_badge : 'About This Service'); ?></span>
                            <h2 class="mb-4">
                                <?php echo esc_html($intro_heading ? $intro_heading : 'Why Choose Impression Beauty?'); ?>
                            </h2>
                            <p class="text-muted mb-3">
                                <?php echo esc_html($intro_p1 ? $intro_p1 : 'Our expert consultants provide personalised beauty and wellness treatments that combine cutting-edge technology with time-tested natural methods. Every treatment is tailored to your unique skin type and individual goals.'); ?>
                            </p>
                            <p class="text-muted mb-4">
                                <?php echo esc_html($intro_p2 ? $intro_p2 : 'Whether you are looking to resolve a stubborn skin concern or simply maintain a radiant complexion, our experienced team is here to guide you at every step of your beauty journey.'); ?>
                            </p>
                            <div class="d-flex gap-3 flex-wrap">
                                <?php foreach ($intro_checks as $check) : ?>
                                    <div class="intro-check-item">
                                        <span class="intro-check">&#10003;</span> <?php echo esc_html($check['text'] ?? ''); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     4. SKIN / CONCERN TYPES
═══════════════════════════════════════════ -->
    <section class="category-section py-5" id="treatments">
        <div class="container">

            <div class="section-title">
                <h2><?php echo esc_html($audience_heading ? $audience_heading : 'Who Is This For?'); ?></h2>
                <p><?php echo esc_html($audience_subheading ? $audience_subheading : 'Treatments designed for every concern and skin type.'); ?></p>
            </div>

            <div class="row g-4">
                <?php foreach ($audience_cards as $card) : ?>
                    <div class="col-lg-4">
                        <div class="category-card">
                            <?php if ($img_url($card['image'] ?? '')) : ?>
                                <img src="<?php echo esc_url($img_url($card['image'])); ?>"
                                    alt="<?php echo esc_attr($card['title'] ?? ''); ?>">
                            <?php endif; ?>
                            <div class="category-overlay">
                                <h4><?php echo esc_html($card['title'] ?? ''); ?></h4>
                                <p><?php echo esc_html($card['description'] ?? ''); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     5. RECOMMENDED TREATMENTS GRID
═══════════════════════════════════════════ -->
    <section class="py-5 my-3">
        <div class="container">

            <div class="section-title">
                <h2><?php echo esc_html($treatments_heading ? $treatments_heading : 'Recommended Treatments'); ?></h2>
                <p><?php echo esc_html($treatments_subheading ? $treatments_subheading : 'Carefully curated procedures for visible, lasting results.'); ?></p>
            </div>

            <div class="row g-4">
                <?php foreach ($treatments as $treatment) : ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="treatment-card">
                            <span class="treatment-duration"><?php echo esc_html($treatment['duration'] ?? ''); ?></span>
                            <h5><?php echo esc_html($treatment['name'] ?? ''); ?></h5>
                            <p><?php echo esc_html($treatment['description'] ?? ''); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     6. HOW IT WORKS (Process Steps)
═══════════════════════════════════════════ -->
    <section class="py-5" style="background: var(--light-pink);">
        <div class="container">

            <div class="section-title">
                <h2><?php echo esc_html($process_heading ? $process_heading : 'How It Works'); ?></h2>
                <p><?php echo esc_html($process_subheading ? $process_subheading : 'A simple, comfortable process from consultation to results.'); ?></p>
            </div>

            <div class="row g-4 justify-content-center">
                <?php foreach ($process_steps as $i => $step) :
                    $number = ($step['number'] ?? '') !== '' ? $step['number'] : str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                    ?>
                    <div class="col-md-4">
                        <div class="step-card">
                            <div class="step-number"><?php echo esc_html($number); ?></div>
                            <h5><?php echo esc_html($step['title'] ?? ''); ?></h5>
                            <p><?php echo esc_html($step['description'] ?? ''); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     7. GOOGLE REVIEWS (same block as the home page)
═══════════════════════════════════════════ -->
    <?php get_template_part('template-parts/front-page/newsletter'); ?>


    <!-- ═══════════════════════════════════════════
     8. FREE CONSULTATION CTA
═══════════════════════════════════════════ -->
    <section class="py-5" id="consultation">
        <div class="container">
            <div class="consultation-banner">

                <div class="row align-items-center g-5">

                    <div class="col-lg-6 text-lg-start text-center">
                        <span class="badge-beauty-light mb-3 d-inline-block">
                            <?php echo esc_html($cta_badge ? $cta_badge : 'Get Started Today'); ?>
                        </span>
                        <h2 class="mb-3">
                            <?php echo esc_html($cta_heading ? $cta_heading : 'Book Your Free Consultation'); ?>
                        </h2>
                        <p class="mb-4" style="opacity:0.9">
                            <?php echo esc_html($cta_text ? $cta_text : 'Our friendly staff will be happy to answer your questions. Fill in the form or contact us directly — we will get back to you shortly.'); ?>
                        </p>
                        <div class="d-flex flex-wrap gap-3 justify-content-lg-start justify-content-center">
                            <a href="<?php echo esc_url($cta_phone_link ? $cta_phone_link : 'tel:+6563339093'); ?>"
                                class="btn btn-light rounded-pill px-4"
                                style="color:var(--primary); font-weight:600;">
                                <?php echo esc_html($cta_phone_text ? $cta_phone_text : '📞 +65 6333 9093'); ?>
                            </a>
                            <a href="<?php echo esc_url($cta_whatsapp_link ? $cta_whatsapp_link : 'https://wa.me/6598678787'); ?>"
                                target="_blank"
                                rel="noopener"
                                class="btn btn-outline-light rounded-pill px-4">
                                <?php echo esc_html($cta_whatsapp_text ? $cta_whatsapp_text : 'WhatsApp Us'); ?>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="consultation-form-wrap">

                            <div class="mb-3">
                                <input type="text"
                                    class="form-control consultation-input"
                                    placeholder="Your Name">
                            </div>
                            <div class="mb-3">
                                <input type="email"
                                    class="form-control consultation-input"
                                    placeholder="Email Address">
                            </div>
                            <div class="mb-3">
                                <input type="tel"
                                    class="form-control consultation-input"
                                    placeholder="Contact Number">
                            </div>
                            <button type="button" class="btn btn-light w-100 consultation-submit">
                                Send Enquiry
                            </button>

                            <p class="mt-3 text-center" style="opacity:0.75; font-size:0.85rem;">
                                <?php echo esc_html($cta_hours ? $cta_hours : 'Operating Hours: Mon–Fri 11:30am–9:00pm • Sat & Sun 10:00am–6:00pm'); ?>
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>
