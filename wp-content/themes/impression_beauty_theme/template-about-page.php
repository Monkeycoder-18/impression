<?php
/* 
 * Template Name: About Us Page
 * Template Post Type: page
 */
$about_hero_title        = get_field('about_hero_title');
$about_hero_sub          = get_field('about_hero_sub');
$about_promotion_button  = get_field('about_promotion_button');
$about_promotion_link    = get_field('about_promotion_link');
$about_hero_image        = get_field('about_hero_image');
$stats_bar               = get_field('stats_bar');
$stat_label              = get_field('stat_label');

get_header();
?>

<!-- ABOUT HERO -->
<section class="about-hero">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <span class="badge-beauty">About Us</span>
                <?php if ($about_hero_title) : ?>
                    <h1 class="about-hero-title mt-3"><?php echo wp_kses_post($about_hero_title); ?></h1>
                <?php endif; ?>
                <?php if ($about_hero_sub) : ?>
                    <p class="about-hero-sub"><?php echo esc_html($about_hero_sub); ?></p>
                <?php endif; ?>
                <?php if (! empty($about_promotion_button['url'])) : ?>
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <a href="<?php echo esc_url($about_promotion_link['url'] ?? ''); ?>"
                            class="btn btn-outline-dark rounded-pill px-4 pt-2"
                            <?php echo ! empty($about_promotion_link['target']) ? 'target="' . esc_attr($about_promotion_link['target']) . '"' : ''; ?>>
                            <?php echo esc_html($about_promotion_button ?? ''); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-6">
                <div class="about-hero-img-wrap">
                    <?php if (! empty($about_hero_image)) : ?>
                        <img src="<?php echo esc_url($about_hero_image); ?>"
                            class="about-hero-img">
                    <?php endif; ?>
                    <?php if ($stats_bar) : ?>
                        <div class="about-hero-float-badge">
                            <span class="about-hero-float-icon">✨</span>
                            <div>
                                <div class="" style="font-size:.9rem;"><?php echo esc_html($stats_bar); ?></div>
                                <div style="font-size:.75rem;opacity:.7;"><?php echo esc_html($stat_label); ?></div>
                            </div>
                        </div>
                    <?php endif;  ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- STATS BAR -->
<?php
$stats_items = get_field('stats_items');
if ($stats_items) : ?>
    <div class="stats-bar py-4">
        <div class="container">
            <div class="row g-3 text-center">
                <?php foreach ($stats_items as $stat) : ?>
                    <div class="col-6 col-md-3 stat-item">
                        <div class="stat-number"><?php echo esc_html($stat['stat_number']); ?></div>
                        <p class="stat-label"><?php echo esc_html($stat['stat_label']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- OUR STORY -->
<?php
$story_image      = get_field('story_image');
$story_badge      = get_field('story_badge');
$story_heading    = get_field('story_heading');
$story_para_1     = get_field('story_paragraph_1');
$story_para_2     = get_field('story_paragraph_2');
$story_checks     = get_field('story_check_items');

if ($story_heading || $story_image) : ?>
    <section class="py-5 my-3">
        <div class="container">
            <div class="trend-box">
                <div class="row g-0 align-items-stretch">

                    <?php if ($story_image) : ?>
                        <div class="col-lg-6">
                            <img src="<?php echo $story_image; ?>" style="width:100%;height:100%;object-fit:cover;min-height:440px;border-radius:0;">
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-6">
                        <div class="trend-content">
                            <?php if ($story_badge) : ?>
                                <span class="badge-beauty"><?php echo esc_html($story_badge); ?></span>
                            <?php endif; ?>
                            <?php if ($story_heading) : ?>
                                <h2 class="mt-3 mb-4"><?php echo wp_kses_post($story_heading); ?></h2>
                            <?php endif; ?>
                            <?php if ($story_para_1) : ?>
                                <p class="text-muted mb-3" style="line-height:1.85;"><?php echo esc_html($story_para_1); ?></p>
                            <?php endif; ?>
                            <?php if ($story_para_2) : ?>
                                <p class="text-muted mb-4" style="line-height:1.85;"><?php echo esc_html($story_para_2); ?></p>
                            <?php endif; ?>
                            <?php if ($story_checks) : ?>
                                <div class="d-flex flex-wrap gap-3">
                                    <?php echo $story_checks ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
    </section>
<?php endif; ?>

<!-- VISION & MISSION -->
<?php
$vm_title     = get_field('vision_mission_title');
$vm_subtitle  = get_field('vision_mission_subtitle');
$vision_icon  = get_field('vision_icon');
$vision_title  = get_field('vision_title');
$vision_body  = get_field('vision_content');
$mission_icon = get_field('mission_icon');
$mission_title = get_field('mission_title');
$mission_body = get_field('mission_content');

if ($vision_title || $mission_title) : ?>
    <section class="py-5 my-3 category-section">
        <div class="container">

            <div class="section-title">
                <h2>Our Vision &amp; Mission</h2>
                <p>The purpose that drives everything we do at Impression Beauty.</p>
            </div>

            <div class="row g-4 align-items-stretch">

                <?php if ($vision_title) : ?>
                    <div class="col-md-6">
                        <div class="about-value-card h-100" style="border-top: 4px solid var(--primary);">
                            <div class="about-value-icon">🌟</div>
                            <h5 class="mb-3"><?php echo esc_html($vision_title); ?></h5>
                            <p style="line-height:1.85;"><?php echo esc_html($vision_body); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($mission_title) : ?>
                    <div class="col-md-6">
                        <div class="about-value-card h-100" style="border-top: 4px solid var(--secondary);">
                            <div class="about-value-icon">💫</div>
                            <h5 class="mb-3"><?php echo esc_html($mission_title); ?></h5>
                            <p style="line-height:1.85;"><?php echo esc_html($mission_body); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>

<!-- OUR VALUES -->
<section class="py-5 my-3">
    <div class="container">

        <div class="section-title">
            <h2>Our Values</h2>
            <p>The principles that guide every treatment, every consultation, and every interaction.</p>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-4">
                <div class="about-value-card">
                    <div class="about-value-icon">🛡️</div>
                    <h5>Safety First</h5>
                    <p>Every treatment we offer has been carefully evaluated for safety and suitability. We never compromise on the well-being of our clients — your health comes before any result.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="about-value-card">
                    <div class="about-value-icon">🤝</div>
                    <h5>Integrity</h5>
                    <p>We are honest about what we can and cannot do. We only recommend treatments that genuinely suit your needs — no upselling, no false promises, just straightforward guidance you can trust.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="about-value-card">
                    <div class="about-value-icon">🌿</div>
                    <h5>Natural Treatments</h5>
                    <p>We believe the best care comes from nature. All our preparations use 100% natural herbal ingredients — free from harsh chemicals, invasive procedures, or unnecessary additives.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="about-value-card">
                    <div class="about-value-icon">💆</div>
                    <h5>Personalised Care</h5>
                    <p>No two clients are alike. Every session begins with a thorough consultation so we can design a treatment plan tailored specifically to your skin type, concerns, and lifestyle.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="about-value-card">
                    <div class="about-value-icon">🏆</div>
                    <h5>Professional Excellence</h5>
                    <p>Our therapists are trained, certified, and continuously upskilled. We hold ourselves to the highest professional standard so every client receives a consistent, expert-level experience.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="about-value-card">
                    <div class="about-value-icon">💬</div>
                    <h5>Genuine Relationships</h5>
                    <p>We see every client as a long-term relationship, not a single appointment. We remember your journey, celebrate your progress, and are always here when you need us.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- OUR VALUES -->
<?php
$values_title    = get_field('values_title');
$values_subtitle = get_field('values_subtitle');
$values_items    = get_field('values_items');


if ($values_items) : ?>
    <section class="py-5 my-3">
        <div class="container">

            <div class="section-title">
                <h2><?php echo esc_html($values_title); ?></h2>
                <p><?php echo esc_html($values_subtitle); ?></p>
            </div>

            <div class="row g-4">
                <?php foreach ($values_items as $value) : ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="about-value-card">
                            <?php if ($value['value_icon']) : ?>
                                <div class="about-value-icon"><?php echo esc_html($value['value_icon']); ?></div>
                            <?php endif; ?>
                            <h5><?php echo esc_html($value['value_heading']); ?></h5>
                            <p><?php echo esc_html($value['value_description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
<?php endif; ?>



<!-- <section class="py-5 my-3">
    <div class="container">
        <div class="trend-box">
            <div class="row g-0 align-items-stretch flex-lg-row-reverse">

                <div class="col-lg-5">
                    <img src="https://impressionbeauty.com/wp-content/uploads/2022/04/Face-Set-Image-scaled.jpg"
                        alt="Founder of Impression Beauty"
                        style="width:100%;height:100%;object-fit:cover;min-height:420px;border-radius:0;">
                </div>

                <div class="col-lg-7">
                    <div class="trend-content">
                        <span class="badge-beauty">Meet the Founder</span>
                        <h2 class="mt-3 mb-1">A Passion for Natural Beauty</h2>
                        <p class="text-muted mb-1" style="font-size:.9rem;font-style:italic;">Founder &amp; Principal Therapist, Impression Face &amp; Body Care</p>
                        <p class="text-muted mt-3 mb-3" style="line-height:1.85;">
                            With over a decade of experience in holistic beauty therapy, our founder built Impression Beauty on one unwavering belief — that real confidence comes from caring for yourself naturally. She has personally guided thousands of clients through their skin journeys, combining traditional herbal knowledge with modern treatment techniques.
                        </p>
                        <p class="text-muted mb-4" style="line-height:1.85;">
                            Her philosophy is simple: listen first, treat with care, and never stop learning. This hands-on, heart-forward approach is woven into the culture of every therapist at Impression Beauty.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <span class="intro-check-item"><span class="intro-check">✓</span> Certified Aesthetician</span>
                            <span class="intro-check-item"><span class="intro-check">✓</span> 10+ Years Experience</span>
                            <span class="intro-check-item"><span class="intro-check">✓</span> Natural Therapy Specialist</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section> -->

<!-- MEET THE FOUNDER -->
<?php
$founder_image  = get_field('founder_image');
$founder_badge  = get_field('founder_badge');
$founder_name   = get_field('founder_name');
$founder_role   = get_field('founder_role');
$founder_para_1 = get_field('founder_paragraph_1');
$founder_para_2 = get_field('founder_paragraph_2');
$founder_checks = get_field('founder_check_items');

if ($founder_name || $founder_image) : ?>
    <section class="py-5 my-3">
        <div class="container">
            <div class="trend-box">
                <div class="row g-0 align-items-stretch flex-lg-row-reverse">

                    <?php if ($founder_image) : ?>
                        <div class="col-lg-5">
                            <img src="<?php echo esc_url($founder_image['url']); ?>"
                                alt="<?php echo esc_attr($founder_image['alt']); ?>"
                                style="width:100%;height:100%;object-fit:cover;min-height:420px;border-radius:0;">
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-7">
                        <div class="trend-content">
                            <?php if ($founder_badge) : ?>
                                <span class="badge-beauty"><?php echo esc_html($founder_badge); ?></span>
                            <?php endif; ?>
                            <?php if ($founder_name) : ?>
                                <h2 class="mt-3 mb-1"><?php echo esc_html($founder_name); ?></h2>
                            <?php endif; ?>
                            <?php if ($founder_role) : ?>
                                <p class="text-muted mb-1" style="font-size:.9rem;font-style:italic;"><?php echo esc_html($founder_role); ?></p>
                            <?php endif; ?>
                            <?php if ($founder_para_1) : ?>
                                <p class="text-muted mt-3 mb-3" style="line-height:1.85;"><?php echo esc_html($founder_para_1); ?></p>
                            <?php endif; ?>
                            <?php if ($founder_para_2) : ?>
                                <p class="text-muted mb-4" style="line-height:1.85;"><?php echo esc_html($founder_para_2); ?></p>
                            <?php endif; ?>
                            <?php if ($founder_checks) : ?>
                                <div class="d-flex flex-wrap gap-3">
                                    <?php foreach ($founder_checks as $item) : ?>
                                        <span class="intro-check-item"><span class="intro-check">✓</span> <?php echo esc_html($item['check_label']); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- MEET OUR TEAM -->
<section class="category-section py-5">
    <div class="container">

        <div class="section-title">
            <h2>Meet Our Team</h2>
            <p>Every therapist at Impression Beauty is trained, certified, and passionate about what they do.</p>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <div class="about-team-card">
                    <div class="about-team-img-wrap">
                        <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop&q=80"
                            alt="Senior Therapist">
                    </div>
                    <div class="about-team-info">
                        <h6>Senior Therapist</h6>
                        <p>Face Care Specialist</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="about-team-card">
                    <div class="about-team-img-wrap">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&q=80"
                            alt="Body Care Therapist">
                    </div>
                    <div class="about-team-info">
                        <h6>Body Care Therapist</h6>
                        <p>Massage &amp; Body Wellness</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="about-team-card">
                    <div class="about-team-img-wrap">
                        <img src="https://images.unsplash.com/photo-1614608682850-e0d6ed316d47?w=400&h=400&fit=crop&q=80"
                            alt="Skin Consultant">
                    </div>
                    <div class="about-team-info">
                        <h6>Skin Consultant</h6>
                        <p>Eye Care &amp; Skin Analysis</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="about-team-card">
                    <div class="about-team-img-wrap">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop&q=80"
                            alt="Herbal Treatment Specialist">
                    </div>
                    <div class="about-team-info">
                        <h6>Herbal Specialist</h6>
                        <p>Mole &amp; Wart Removal</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php
$team_title   = get_field('team_title');
$team_sub     = get_field('team_subtitle');
$team_members = get_field('team_members');

if ($team_members) : ?>
    <section class="category-section py-5">
        <div class="container">

            <div class="section-title">
                <h2><?php echo esc_html($team_title); ?></h2>
                <p><?php echo esc_html($team_sub); ?></p>
            </div>

            <div class="row g-4">
                <?php foreach ($team_members as $member) : ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="about-team-card">
                            <div class="about-team-img-wrap">
                                <img src="<?php echo esc_url($member['member_photo']['url']); ?>"
                                    alt="<?php echo esc_attr($member['member_photo']['alt']); ?>">
                            </div>
                            <div class="about-team-info">
                                <h6><?php echo esc_html($member['member_name']); ?></h6>
                                <p><?php echo esc_html($member['member_role']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
<?php endif; ?>

<!-- OUR CLINIC -->
<?php
$clinic_title     = get_field('clinic_title');
$clinic_sub       = get_field('clinic_subtitle');
$clinic_main_img  = get_field('clinic_main_image');
$clinic_gallery   = get_field('clinic_gallery');
$clinic_addr_lbl  = get_field('clinic_address_label');
$clinic_addr_det  = get_field('clinic_address_detail');
$clinic_hrs_lbl   = get_field('clinic_hours_label');
$clinic_hrs_det   = get_field('clinic_hours_detail');
$clinic_mrt_lbl   = get_field('clinic_mrt_label');
$clinic_mrt_det   = get_field('clinic_mrt_detail');

if ($clinic_main_img || $clinic_title) : ?>
    <section class="py-5 my-3">
        <div class="container">

            <div class="section-title">
                <h2><?php echo esc_html($clinic_title); ?></h2>
                <p><?php echo esc_html($clinic_sub); ?></p>
            </div>

            <div class="row g-3">

                <?php if ($clinic_main_img) : ?>
                    <div class="col-lg-6">
                        <div class="about-clinic-main">
                            <img src="<?php echo esc_url($clinic_main_img['url']); ?>"
                                alt="<?php echo esc_attr($clinic_main_img['alt']); ?>"
                                style="width:100%;height:380px;object-fit:cover;border-radius:16px;">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-lg-6">
                    <div class="row g-3 h-100">

                        <?php if ($clinic_gallery) :
                            foreach ($clinic_gallery as $gallery_row) :
                                $img = $gallery_row['gallery_image']; ?>
                                <div class="col-6">
                                    <img src="<?php echo esc_url($img['url']); ?>"
                                        alt="<?php echo esc_attr($img['alt']); ?>"
                                        style="width:100%;height:182px;object-fit:cover;border-radius:12px;">
                                </div>
                        <?php endforeach;
                        endif; ?>

                        <div class="col-12">
                            <div class="about-clinic-info p-4" style="background:var(--light-pink);border-radius:12px;">
                                <div class="row g-3">
                                    <div class="col-sm-4 text-center">
                                        <div style="font-size:1.5rem;">📍</div>
                                        <div class="fw-semibold mt-1" style="font-size:.85rem;"><?php echo esc_html($clinic_addr_lbl); ?></div>
                                        <div class="text-muted" style="font-size:.78rem;"><?php echo esc_html($clinic_addr_det); ?></div>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <div style="font-size:1.5rem;">🕐</div>
                                        <div class="fw-semibold mt-1" style="font-size:.85rem;"><?php echo esc_html($clinic_hrs_lbl); ?></div>
                                        <div class="text-muted" style="font-size:.78rem;"><?php echo esc_html($clinic_hrs_det); ?></div>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <div style="font-size:1.5rem;">🚇</div>
                                        <div class="fw-semibold mt-1" style="font-size:.85rem;"><?php echo esc_html($clinic_mrt_lbl); ?></div>
                                        <div class="text-muted" style="font-size:.78rem;"><?php echo esc_html($clinic_mrt_det); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
<?php endif; ?>

<!-- OUR TREATMENTS SHOWCASE -->

<section class="py-5 my-3">
    <div class="container">

        <div class="section-title">
            <h2>Our Clinic</h2>
            <p>A serene, welcoming space designed for your comfort — right in the heart of Clarke Quay Central.</p>
        </div>

        <div class="row g-3">

            <div class="col-lg-6">
                <div class="about-clinic-main">
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800&h=550&fit=crop&q=80"
                        alt="Impression Beauty Clinic Interior"
                        style="width:100%;height:380px;object-fit:cover;border-radius:16px;">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row g-3 h-100">
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=280&fit=crop&q=80"
                            alt="Treatment Room"
                            style="width:100%;height:182px;object-fit:cover;border-radius:12px;">
                    </div>
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=280&fit=crop&q=80"
                            alt="Beauty Products"
                            style="width:100%;height:182px;object-fit:cover;border-radius:12px;">
                    </div>
                    <div class="col-12">
                        <div class="about-clinic-info p-4" style="background:var(--light-pink);border-radius:12px;">
                            <div class="row g-3">
                                <div class="col-sm-4 text-center">
                                    <div style="font-size:1.5rem;">📍</div>
                                    <div class="fw-semibold mt-1" style="font-size:.85rem;">Clarke Quay Central</div>
                                    <div class="text-muted" style="font-size:.78rem;">#B1-67, 6 Eu Tong Sen St</div>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <div style="font-size:1.5rem;">🕐</div>
                                    <div class="fw-semibold mt-1" style="font-size:.85rem;">Opening Hours</div>
                                    <div class="text-muted" style="font-size:.78rem;">Mon–Sun: 11am – 8pm</div>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <div style="font-size:1.5rem;">🚇</div>
                                    <div class="fw-semibold mt-1" style="font-size:.85rem;">Easy Access</div>
                                    <div class="text-muted" style="font-size:.78rem;">Clarke Quay MRT (NE5)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php
$treatments_title = get_field('treatments_title');
$treatments_sub   = get_field('treatments_subtitle');
$treatment_items  = get_field('treatment_items');

if ($treatment_items) : ?>
    <section class="py-5 my-3">
        <div class="container">

            <div class="section-title">
                <h2><?php echo esc_html($treatments_title); ?></h2>
                <p><?php echo esc_html($treatments_sub); ?></p>
            </div>

            <div class="row g-4">
                <?php foreach ($treatment_items as $treatment) :
                    $t_img  = $treatment['treatment_image'];
                    $t_link = $treatment['treatment_link'] ?: home_url('/');
                ?>
                    <div class="col-md-6 col-lg-3">
                        <a href="<?php echo esc_url($t_link); ?>" class="about-treatment-card">
                            <img src="<?php echo esc_url($t_img['url']); ?>"
                                alt="<?php echo esc_attr($t_img['alt']); ?>">
                            <div class="about-treatment-overlay">
                                <h6><?php echo esc_html($treatment['treatment_name']); ?></h6>
                                <p><?php echo esc_html($treatment['treatment_tagline']); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
<?php endif; ?>

<!-- WP PAGE CONTENT (if any) -->
<?php while (have_posts()) : the_post(); ?>
    <?php if (trim(get_the_content())) : ?>
        <section class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endwhile; ?>

<!-- CTA BANNER -->
<section class="py-5 my-3">
    <div class="container">

        <div class="section-title">
            <h2>Our Treatments</h2>
            <p>A full range of face and body care services designed for every concern.</p>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-3">
                <a href="<?php echo esc_url(home_url('/face-care')); ?>" class="about-treatment-card">
                    <img src="https://impressionbeauty.com/wp-content/uploads/2022/04/Face-Set-Image-scaled.jpg" alt="Face Care">
                    <div class="about-treatment-overlay">
                        <h6>Face Care</h6>
                        <p>Glow &amp; rejuvenate</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="<?php echo esc_url(home_url('/body-care')); ?>" class="about-treatment-card">
                    <img src="https://impressionbeauty.com/wp-content/uploads/2022/04/Body-Set-Image-scaled.jpg" alt="Body Care">
                    <div class="about-treatment-overlay">
                        <h6>Body Care</h6>
                        <p>Relax &amp; restore</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="<?php echo esc_url(home_url('/eye-care')); ?>" class="about-treatment-card">
                    <img src="https://impressionbeauty.com/wp-content/uploads/2022/04/Eyes-Set-Image-scaled.jpg" alt="Eye Care">
                    <div class="about-treatment-overlay">
                        <h6>Eye Care</h6>
                        <p>Brighten &amp; lift</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="<?php echo esc_url(home_url('/mole-warts-removal')); ?>" class="about-treatment-card">
                    <img src="https://images.unsplash.com/photo-1741896136331-10375875eff4?w=600&h=400&fit=crop&q=80" alt="Skin Growth Removal">
                    <div class="about-treatment-overlay">
                        <h6>Mole &amp; Wart Removal</h6>
                        <p>Natural herbal method</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>
<?php
$cta_badge   = get_field('cta_badge');
$cta_heading = get_field('cta_heading');
$cta_desc    = get_field('cta_description');
$cta_btn_txt = get_field('cta_button_text');
$cta_btn_url = get_field('cta_button_link') ?: home_url('/contact-us');

if ($cta_heading) : ?>
    <section class="py-5">
        <div class="container">
            <div class="consultation-banner">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8 text-center text-lg-start">
                        <?php if ($cta_badge) : ?>
                            <span class="badge-beauty-light mb-3 d-inline-block"><?php echo esc_html($cta_badge); ?></span>
                        <?php endif; ?>
                        <h2 class="mb-2"><?php echo esc_html($cta_heading); ?></h2>
                        <?php if ($cta_desc) : ?>
                            <p class="opacity-75 mb-0"><?php echo esc_html($cta_desc); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($cta_btn_txt) : ?>
                        <div class="col-lg-4 text-center text-lg-end">
                            <a href="<?php echo esc_url($cta_btn_url); ?>"
                                class="btn btn-light px-5 py-3 rounded-pill"
                                style="color:var(--primary);">
                                <?php echo esc_html($cta_btn_txt); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>