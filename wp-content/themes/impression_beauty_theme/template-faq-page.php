<?php
/*
 * Template Name: FAQ Page
 * Template Post Type: page
 */
get_header();

$hero_badge     = get_field( 'faq_hero_badge' );
$hero_title     = get_field( 'faq_hero_title' );
$hero_highlight = get_field( 'faq_hero_highlight' );
$hero_intro     = get_field( 'faq_hero_intro' );
$tabs           = get_field( 'faq_tabs' );
$help_badge     = get_field( 'faq_help_badge' );
$help_heading   = get_field( 'faq_help_heading' );
$help_text      = get_field( 'faq_help_text' );
$help_phone     = get_field( 'faq_help_phone_text' );
$help_phone_link = get_field( 'faq_help_phone_link' );
$help_button    = get_field( 'faq_help_button_text' );
$help_link      = get_field( 'faq_help_button_link' );
?>

<!-- FAQ HERO -->
<section class="inner-page-hero inner-page-hero--faq">
    <div class="container text-center">
        <span class="badge-beauty"><?php echo esc_html( $hero_badge ? $hero_badge : 'Help Centre' ); ?></span>
        <h1 class="inner-page-hero-title mt-3">
            <?php if ( $hero_title || $hero_highlight ) : ?>
                <?php echo esc_html( $hero_title ); ?><?php if ( $hero_highlight ) : ?> <span><?php echo esc_html( $hero_highlight ); ?></span><?php endif; ?>
            <?php else : ?>
                Frequently Asked <span>Questions</span>
            <?php endif; ?>
        </h1>
        <?php if ( $hero_intro ) : ?>
            <div class="inner-page-hero-sub mx-auto"><?php echo wp_kses_post( $hero_intro ); ?></div>
        <?php else : ?>
            <p class="inner-page-hero-sub mx-auto">
                Everything you need to know about our treatments, appointments, and services.
                Can't find an answer?
                <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="inner-page-hero-link">Contact us</a>.
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- FAQ CATEGORY TABS -->
<section class="py-5">
    <div class="container">
        <?php if ( $tabs ) : ?>
            <ul class="nav faq-tabs justify-content-center mb-5 flex-wrap gap-2" id="faqTabs" role="tablist">
                <?php foreach ( $tabs as $ti => $tab ) :
                    $pane_id = 'faq-tab-' . $ti;
                    $active  = $ti === 0;
                    ?>
                    <li class="nav-item" role="presentation">
                        <button class="faq-tab-btn<?php echo $active ? ' active' : ''; ?>"
                                data-bs-toggle="tab"
                                data-bs-target="#<?php echo esc_attr( $pane_id ); ?>"
                                type="button" role="tab"
                                aria-controls="<?php echo esc_attr( $pane_id ); ?>"
                                aria-selected="<?php echo $active ? 'true' : 'false'; ?>">
                            <?php echo esc_html( $tab['name'] ?? '' ); ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="tab-content">
                <?php foreach ( $tabs as $ti => $tab ) :
                    $pane_id = 'faq-tab-' . $ti;
                    $active  = $ti === 0;
                    $image   = $tab['image'] ?? null;
                    $groups  = $tab['groups'] ?? [];
                    ?>
                    <div class="tab-pane fade<?php echo $active ? ' show active' : ''; ?>" id="<?php echo esc_attr( $pane_id ); ?>" role="tabpanel">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <?php if ( is_array( $image ) && ! empty( $image['url'] ) ) : ?>
                                    <div class="faq-tab-intro mb-4">
                                        <img src="<?php echo esc_url( $image['url'] ); ?>"
                                             alt="<?php echo esc_attr( $image['alt'] ? $image['alt'] : ( $tab['name'] ?? '' ) ); ?>"
                                             class="faq-tab-intro-img">
                                    </div>
                                <?php endif; ?>

                                <?php foreach ( $groups as $gi => $group ) :
                                    $acc_id    = 'faq-acc-' . $ti . '-' . $gi;
                                    $questions = $group['questions'] ?? [];
                                    $label     = $group['label'] ?? '';
                                    ?>
                                    <?php if ( $label ) : ?>
                                        <p class="faq-category-label<?php echo $gi > 0 ? ' mt-5' : ''; ?>"><?php echo esc_html( $label ); ?></p>
                                    <?php endif; ?>
                                    <div class="accordion faq-accordion" id="<?php echo esc_attr( $acc_id ); ?>">
                                        <?php foreach ( $questions as $qi => $item ) :
                                            $q_id = 'faq-q-' . $ti . '-' . $gi . '-' . $qi;
                                            $open = $qi === 0;
                                            ?>
                                            <div class="accordion-item faq-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button faq-btn<?php echo $open ? '' : ' collapsed'; ?>" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#<?php echo esc_attr( $q_id ); ?>"
                                                            aria-expanded="<?php echo $open ? 'true' : 'false'; ?>">
                                                        <?php echo esc_html( $item['question'] ?? '' ); ?>
                                                    </button>
                                                </h2>
                                                <div id="<?php echo esc_attr( $q_id ); ?>" class="accordion-collapse collapse<?php echo $open ? ' show' : ''; ?>" data-bs-parent="#<?php echo esc_attr( $acc_id ); ?>">
                                                    <div class="accordion-body faq-body">
                                                        <?php echo wp_kses_post( $item['answer'] ?? '' ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-center">Questions will appear here once they are added on this page in the dashboard.</p>
        <?php endif; ?>
    </div>
</section>

<!-- STILL HAVE QUESTIONS? -->
<section class="py-5">
    <div class="container">
        <div class="consultation-banner text-center">
            <span class="badge-beauty-light mb-3 d-inline-block"><?php echo esc_html( $help_badge ? $help_badge : 'Still Unsure?' ); ?></span>
            <h2 class="mb-3"><?php echo esc_html( $help_heading ? $help_heading : "We're Here to Help" ); ?></h2>
            <?php if ( $help_text ) : ?>
                <div class="mb-4 opacity-75"><?php echo wp_kses_post( $help_text ); ?></div>
            <?php else : ?>
                <p class="mb-4 opacity-75">
                    Can't find the answer you're looking for? Call us or drop by for a free skin consultation.
                </p>
            <?php endif; ?>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="<?php echo esc_url( $help_phone_link ? $help_phone_link : 'tel:+6563339093' ); ?>"
                   class="btn btn-light px-4 py-3 rounded-pill"
                   style="color:var(--primary);">
                    <?php echo esc_html( $help_phone ? $help_phone : '📞 +65 6333 9093' ); ?>
                </a>
                <a href="<?php echo esc_url( $help_link ? $help_link : home_url( '/contact-us' ) ); ?>"
                   class="btn btn-outline-light px-4 py-3 rounded-pill">
                    <?php echo esc_html( $help_button ? $help_button : 'Contact Us' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
