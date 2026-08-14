<?php
/*
 * Template Name: Service Page
 * Template Post Type: page
 */
get_header();
?>

<!-- ═══════════════════════════════════════════
     1. SERVICE HERO
     Uses the page title & excerpt from WP editor.
     Replace placeholder image with the service hero image.
═══════════════════════════════════════════ -->
<?php while (have_posts()) : the_post(); ?>

    <section class="service-hero">
        <div class="service-hero-bg"></div>
        <div class="container position-relative">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <span class="badge-beauty mb-3 d-inline-block">
                        Impression Beauty
                    </span>
                    <h1 class="service-hero-title">
                        <?php the_title(); ?>
                    </h1>
                    <?php if (has_excerpt()) : ?>
                        <p class="service-hero-sub">
                            <?php the_excerpt(); ?>
                        </p>
                    <?php else : ?>
                        <p class="service-hero-sub">
                            Professional treatments tailored to your skin and wellness needs.
                            Trusted by thousands of satisfied customers since 1994.
                        </p>
                    <?php endif; ?>
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <a href="#treatments" class="btn btn-beauty">
                            View Treatments
                        </a>
                        <a href="#consultation" class="btn btn-outline-dark rounded-pill px-4 py-2">
                            Free Consultation
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="service-hero-img-wrap">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', ['class' => 'service-hero-img']); ?>
                        <?php else : ?>
                            <!-- <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/service-hero-placeholder.jpg'); ?>"
                                alt="<?php the_title_attribute(); ?>"
                                class="service-hero-img"> -->
                            <img src="https://images.unsplash.com/photo-1758600587391-338f5376b7ed?w=700&h=800&fit=crop&q=80"
                                alt="<?php the_title_attribute(); ?>"
                                class="service-hero-img">
                        <?php endif; ?>
                        <div class="service-hero-badge-float">
                            <span>&#10003;</span> Since 1994
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     2. TRUST STATS BAR
     Quick social-proof numbers across the top.
═══════════════════════════════════════════ -->
    <section class="stats-bar py-4">
        <div class="container">
            <div class="row g-3 text-center">

                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h3 class="stat-number">30+</h3>
                        <p class="stat-label">Years Experience</p>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h3 class="stat-number">6,000+</h3>
                        <p class="stat-label">Successful Cases</p>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h3 class="stat-number">100%</h3>
                        <p class="stat-label">Herbal &amp; Natural</p>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <h3 class="stat-number">5&#9733;</h3>
                        <p class="stat-label">Customer Rated</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     3. SERVICE INTRO (Split layout)
     Mirrors the trend-box pattern from front-page.
     Replace placeholder image with a service lifestyle shot.
═══════════════════════════════════════════ -->
    <section class="py-5 my-3">
        <div class="container">
            <div class="trend-box">
                <div class="row g-0 align-items-stretch">

                    <div class="col-lg-5">
                        <!-- ACF: <img src="<?php // echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: get_template_directory_uri() . '/assets/images/service-intro-placeholder.jpg' ); ?>" alt="Service Introduction" style="width:100%; height:100%; object-fit:cover; min-height:420px;"> -->
                        <img src="https://images.unsplash.com/photo-1763539818420-165e69b7489b?w=800&h=700&fit=crop&q=80"
                            alt="Service Introduction"
                            style="width:100%; height:100%; object-fit:cover; min-height:420px;">
                    </div>

                    <div class="col-lg-7">
                        <div class="trend-content">
                            <span class="badge-beauty">About This Service</span>
                            <h2 class="mb-4">
                                Why Choose Impression Beauty?
                            </h2>
                            <p class="text-muted mb-3">
                                <!-- PASTE: Your main service introduction paragraph here.
                                 Example: "Face Care at Impression Beauty covers Normal, Dry,
                                 Oily, Combination, and Sensitive skin types..." -->
                                Our expert consultants provide personalised beauty and wellness
                                treatments that combine cutting-edge technology with time-tested
                                natural methods. Every treatment is tailored to your unique skin type
                                and individual goals.
                            </p>
                            <p class="text-muted mb-4">
                                <!-- PASTE: Second intro paragraph here. -->
                                Whether you are looking to resolve a stubborn skin concern or simply
                                maintain a radiant complexion, our experienced team is here to guide
                                you at every step of your beauty journey.
                            </p>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="intro-check-item">
                                    <span class="intro-check">&#10003;</span> Professional Consultants
                                </div>
                                <div class="intro-check-item">
                                    <span class="intro-check">&#10003;</span> Proven Results
                                </div>
                                <div class="intro-check-item">
                                    <span class="intro-check">&#10003;</span> Personalised Care
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     4. SKIN / CONCERN TYPES
     3 category cards — mirrors the Shop By Category
     section from the front page. Edit the titles,
     descriptions, and images to match the service.
═══════════════════════════════════════════ -->
    <section class="category-section py-5" id="treatments">
        <div class="container">

            <div class="section-title">
                <h2>Who Is This For?</h2>
                <p>
                    <!-- PASTE: Short sub-heading describing the audience for this service. -->
                    Treatments designed for every concern and skin type.
                </p>
            </div>

            <div class="row g-4">

                <div class="col-lg-4">
                    <div class="category-card">
                        <!-- ACF: <img src="<?php // echo esc_url( get_template_directory_uri() . '/assets/images/concern-1-placeholder.jpg' ); ?>" alt="Concern Type 1"> -->
                        <img src="https://images.unsplash.com/photo-1741896136331-10375875eff4?w=600&h=700&fit=crop&q=80"
                            alt="Skin Care">
                        <div class="category-overlay">
                            <h4>
                                <!-- PASTE: Skin/concern type label. e.g. "Dry & Sensitive Skin" -->
                                Dry &amp; Sensitive Skin
                            </h4>
                            <p>
                                <!-- PASTE: 1 line description. -->
                                Restore hydration and soothe irritated skin.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="category-card">
                        <!-- ACF: <img src="<?php // echo esc_url( get_template_directory_uri() . '/assets/images/concern-2-placeholder.jpg' ); ?>" alt="Concern Type 2"> -->
                        <img src="https://images.unsplash.com/photo-1653784097013-786a8965ea3b?w=600&h=700&fit=crop&q=80"
                            alt="Cosmetics">
                        <div class="category-overlay">
                            <h4>
                                <!-- PASTE: e.g. "Oily & Combination Skin" -->
                                Oily &amp; Combination Skin
                            </h4>
                            <p>
                                <!-- PASTE: 1 line description. -->
                                Control excess sebum and refine large pores.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="category-card">
                        <!-- ACF: <img src="<?php // echo esc_url( get_template_directory_uri() . '/assets/images/concern-3-placeholder.jpg' ); ?>" alt="Concern Type 3"> -->
                        <img src="https://images.unsplash.com/photo-1768483018807-bd0b9ab86539?w=600&h=700&fit=crop&q=80"
                            alt="Beauty Care">
                        <div class="category-overlay">
                            <h4>
                                <!-- PASTE: e.g. "Pigmentation & Ageing" -->
                                Pigmentation &amp; Ageing
                            </h4>
                            <p>
                                <!-- PASTE: 1 line description. -->
                                Even skin tone and reduce visible signs of ageing.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     5. RECOMMENDED TREATMENTS GRID
     Treatment cards. Duplicate .col-md-6 blocks
     to add more. Each card has: duration badge,
     title, and description.
═══════════════════════════════════════════ -->
    <section class="py-5 my-3">
        <div class="container">

            <div class="section-title">
                <h2>Recommended Treatments</h2>
                <p>
                    <!-- PASTE: Sub-heading for the treatments grid. -->
                    Carefully curated procedures for visible, lasting results.
                </p>
            </div>

            <div class="row g-4">

                <!-- TREATMENT CARD 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="treatment-card">
                        <span class="treatment-duration">
                            <!-- PASTE: Duration. e.g. "90 mins" -->
                            90 mins
                        </span>
                        <h5>
                            <!-- PASTE: Treatment name. e.g. "Multi Fruits Energizing Treatment" -->
                            Multi Fruits Energizing Treatment
                        </h5>
                        <p>
                            <!-- PASTE: Treatment description. -->
                            High minerals &amp; vitamins content products to strengthen skin
                            cellular and protect skin against free radical and UV lights,
                            fighting skin ageing for a brighter, fairer look.
                        </p>
                    </div>
                </div>

                <!-- TREATMENT CARD 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="treatment-card">
                        <span class="treatment-duration">90 mins</span>
                        <h5>
                            <!-- PASTE: Treatment name. -->
                            Skin RejuV Treatment
                        </h5>
                        <p>
                            <!-- PASTE: Treatment description. -->
                            Dry flaky and red skin treatment using complete Hydra Silk skin
                            care with high silk protein that immediately replaces lost moisture.
                            Reduces redness and anti-sensitivity.
                        </p>
                    </div>
                </div>

                <!-- TREATMENT CARD 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="treatment-card">
                        <span class="treatment-duration">60 mins</span>
                        <h5>
                            <!-- PASTE: Treatment name. -->
                            RF Treatment
                        </h5>
                        <p>
                            <!-- PASTE: Treatment description. -->
                            For mature sagging skin. Using Bio Heat to promote cell
                            regeneration, improve blood and lymph circulation,
                            and provide an instant lift.
                        </p>
                    </div>
                </div>

                <!-- TREATMENT CARD 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="treatment-card">
                        <span class="treatment-duration">90 mins</span>
                        <h5>
                            <!-- PASTE: Treatment name. -->
                            Skin Fruition / Renewal Treatment
                        </h5>
                        <p>
                            <!-- PASTE: Treatment description. -->
                            For oily blemishes non-sensitive skin. With AHA range products
                            to soften, smoothen, lighten uneven skin and reduce blemishes.
                        </p>
                    </div>
                </div>

                <!-- TREATMENT CARD 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="treatment-card">
                        <span class="treatment-duration">90 mins</span>
                        <h5>
                            <!-- PASTE: Treatment name. -->
                            Acne Treatment
                        </h5>
                        <p>
                            <!-- PASTE: Treatment description. -->
                            Deep cleansing with anti-septic and healing effect. Controls
                            sebum secretion and prevents bacterial infection for oily
                            blemish-prone skin.
                        </p>
                    </div>
                </div>

                <!-- TREATMENT CARD 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="treatment-card">
                        <span class="treatment-duration">80 mins</span>
                        <h5>
                            <!-- PASTE: Treatment name. -->
                            Diamond Peel Treatment
                        </h5>
                        <p>
                            <!-- PASTE: Treatment description. -->
                            Effectively removes dead skin cells, refines large pores,
                            smoothens scars and evens skin tone for large pore,
                            rough &amp; slight blemish skin.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     6. HOW IT WORKS (Process Steps)
     Used for structured services like Mole & Wart
     Removal. Edit or remove this section for simpler
     service pages that don't have a defined process.
═══════════════════════════════════════════ -->
    <section class="py-5" style="background: var(--light-pink);">
        <div class="container">

            <div class="section-title">
                <h2>How It Works</h2>
                <p>
                    <!-- PASTE: Sub-heading for the process section. -->
                    A simple, comfortable process from consultation to results.
                </p>
            </div>

            <div class="row g-4 justify-content-center">

                <!-- STEP 1 -->
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">01</div>
                        <h5>
                            <!-- PASTE: Step title. e.g. "Free Consultation" -->
                            Free Consultation
                        </h5>
                        <p>
                            <!-- PASTE: Step description. -->
                            Our expert consultant analyses your skin and discusses
                            your concerns to recommend the most suitable treatment plan.
                        </p>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">02</div>
                        <h5>
                            <!-- PASTE: Step title. e.g. "Treatment Application" -->
                            Treatment Application
                        </h5>
                        <p>
                            <!-- PASTE: Step description. -->
                            Your chosen treatment is professionally administered in a
                            clean, comfortable environment. Most sessions take 45–90 mins.
                        </p>
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">03</div>
                        <h5>
                            <!-- PASTE: Step title. e.g. "Review & Follow Up" -->
                            Review &amp; Follow Up
                        </h5>
                        <p>
                            <!-- PASTE: Step description. -->
                            We schedule a follow-up to review your results and
                            adjust your treatment plan for continued improvement.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     7. TESTIMONIALS
     Reuses the .testimonial card from the front page.
     Replace placeholder avatars and quotes.
═══════════════════════════════════════════ -->
    <section class="py-5 my-3">
        <div class="container">

            <div class="section-title">
                <h2>What Our Customers Say</h2>
                <p>Real results from real customers, trusted since 1994.</p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="testimonial">
                        <!-- ACF: <img src="<?php // echo esc_url( get_template_directory_uri() . '/assets/images/testimonial-1.jpg' ); ?>" alt="Imelda"> -->
                        <img src="https://images.unsplash.com/photo-1515212799670-2481411f0d64?w=100&h=100&fit=crop&q=80"
                            alt="Imelda">
                        <p>
                            <!-- PASTE: Customer quote. -->
                            "I started my beauty care journey with Impression Beauty almost
                            20 years ago. My skin looks great even without make-up at 39!
                            Thank you, Impression Beauty!"
                        </p>
                        <h6 class="mb-0">
                            <!-- PASTE: Customer name. -->
                            Imelda
                        </h6>
                        <small class="text-muted">
                            <!-- PASTE: Customer since / service used. -->
                            Customer since 2004
                        </small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial">
                        <!-- ACF: <img src="<?php // echo esc_url( get_template_directory_uri() . '/assets/images/testimonial-2.jpg' ); ?>" alt="Cynthia Lee"> -->
                        <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=100&h=100&fit=crop&q=80"
                            alt="Cynthia Lee">
                        <p>
                            <!-- PASTE: Customer quote. -->
                            "As a customer who has witnessed the birth of Impression 20 years
                            ago, the service has consistently been 1st class. I am very
                            satisfied with the results achieved."
                        </p>
                        <h6 class="mb-0">Cynthia Lee</h6>
                        <small class="text-muted">Loyal Customer</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial">
                        <!-- ACF: <img src="<?php // echo esc_url( get_template_directory_uri() . '/assets/images/testimonial-3.jpg' ); ?>" alt="Andrea"> -->
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop&q=80"
                            alt="Andrea">
                        <p>
                            <!-- PASTE: Customer quote. -->
                            "I'm 38 now but most people think I'm in my mid-20s. My skin
                            brings me confidence which starts with healthy, clean skin —
                            all thanks to the wonderful team at Impression."
                        </p>
                        <h6 class="mb-0">Andrea</h6>
                        <small class="text-muted">Customer since 2006</small>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════
     8. FREE CONSULTATION CTA
     Mirrors the newsletter gradient banner style.
     Edit the phone/WhatsApp numbers and hours.
═══════════════════════════════════════════ -->
    <section class="py-5" id="consultation">
        <div class="container">
            <div class="consultation-banner">

                <div class="row align-items-center g-5">

                    <div class="col-lg-6 text-lg-start text-center">
                        <span class="badge-beauty-light mb-3 d-inline-block">
                            Get Started Today
                        </span>
                        <h2 class="mb-3">
                            Book Your Free Consultation
                        </h2>
                        <p class="mb-4" style="opacity:0.9">
                            Our friendly staff will be happy to answer your questions.
                            Fill in the form or contact us directly — we will get back
                            to you shortly.
                        </p>
                        <div class="d-flex flex-wrap gap-3 justify-content-lg-start justify-content-center">
                            <a href="tel:+6563339093"
                                class="btn btn-light rounded-pill px-4"
                                style="color:var(--primary); font-weight:600;">
                                &#128222; +65 6333 9093
                            </a>
                            <a href="https://wa.me/6598678787"
                                target="_blank"
                                rel="noopener"
                                class="btn btn-outline-light rounded-pill px-4">
                                WhatsApp Us
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
                                Operating Hours: Mon–Fri 11:30am–9:00pm &bull;
                                Sat &amp; Sun 10:00am–6:00pm
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>