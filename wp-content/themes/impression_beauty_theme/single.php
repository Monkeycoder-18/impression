<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- POST HERO -->
<section class="post-hero">
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-hero-img-wrap">
            <?php the_post_thumbnail( 'full', [ 'class' => 'post-hero-img', 'alt' => get_the_title() ] ); ?>
            <div class="post-hero-overlay"></div>
        </div>
    <?php else : ?>
        <div class="post-hero-img-wrap">
            <img src="https://images.unsplash.com/photo-1763539818420-165e69b7489b?w=1400&h=600&fit=crop&q=80"
                 alt="<?php echo esc_attr( get_the_title() ); ?>"
                 class="post-hero-img">
            <div class="post-hero-overlay"></div>
        </div>
    <?php endif; ?>

    <div class="post-hero-content container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">

                <?php
                $categories = get_the_category();
                if ( $categories ) :
                    $cat = $categories[0];
                ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                   class="post-category-badge">
                    <?php echo esc_html( $cat->name ); ?>
                </a>
                <?php endif; ?>

                <h1 class="post-hero-title"><?php the_title(); ?></h1>

                <div class="post-meta-bar">
                    <span class="post-meta-item">
                        📅 <?php echo get_the_date(); ?>
                    </span>
                    <?php if ( get_the_author() ) : ?>
                    <span class="post-meta-divider">·</span>
                    <span class="post-meta-item">
                        ✍️ <?php the_author(); ?>
                    </span>
                    <?php endif; ?>
                    <?php
                    $reading_time = max( 1, (int) ceil( str_word_count( strip_tags( get_the_content() ) ) / 200 ) );
                    ?>
                    <span class="post-meta-divider">·</span>
                    <span class="post-meta-item">
                        ⏱️ <?php echo $reading_time; ?> min read
                    </span>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- POST BODY -->
<section class="py-5">
    <div class="container">
        <div class="row g-5 justify-content-center">

            <!-- MAIN CONTENT -->
            <div class="col-lg-8">
                <article class="post-article">
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    $tags = get_the_tags();
                    if ( $tags ) :
                    ?>
                    <div class="post-tags mt-5">
                        <span class="post-tags-label">Tags:</span>
                        <?php foreach ( $tags as $tag ) : ?>
                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="post-tag-pill">
                                <?php echo esc_html( $tag->name ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- POST NAVIGATION -->
                    <nav class="post-nav mt-5">
                        <?php
                        $prev = get_previous_post();
                        $next = get_next_post();
                        ?>
                        <?php if ( $prev ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" class="post-nav-link post-nav-prev">
                            <span class="post-nav-dir">← Previous</span>
                            <span class="post-nav-title"><?php echo esc_html( get_the_title( $prev->ID ) ); ?></span>
                        </a>
                        <?php endif; ?>
                        <?php if ( $next ) : ?>
                        <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" class="post-nav-link post-nav-next text-end">
                            <span class="post-nav-dir">Next →</span>
                            <span class="post-nav-title"><?php echo esc_html( get_the_title( $next->ID ) ); ?></span>
                        </a>
                        <?php endif; ?>
                    </nav>

                </article>
            </div>

            <!-- SIDEBAR -->
            <div class="col-lg-4">
                <aside class="post-sidebar">

                    <!-- ABOUT WIDGET -->
                    <div class="post-widget mb-4">
                        <div class="post-widget-header">About Impression Beauty</div>
                        <div class="post-widget-body text-center">
                            <img src="https://images.unsplash.com/photo-1758600587391-338f5376b7ed?w=300&h=200&fit=crop&q=80"
                                 alt="Impression Beauty"
                                 class="w-100 rounded-3 mb-3"
                                 style="height:140px;object-fit:cover;">
                            <p class="text-muted" style="font-size:.88rem;line-height:1.75;">
                                Singapore's trusted destination for natural face &amp; body care treatments at Clarke Quay Central.
                            </p>
                            <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>"
                               class="btn btn-beauty w-100 mt-2">
                                Book Now
                            </a>
                        </div>
                    </div>

                    <!-- CATEGORIES WIDGET -->
                    <div class="post-widget mb-4">
                        <div class="post-widget-header">Categories</div>
                        <div class="post-widget-body">
                            <ul class="post-widget-list">
                                <?php
                                $cats = get_categories( [ 'hide_empty' => true ] );
                                foreach ( $cats as $cat ) :
                                ?>
                                <li>
                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                        <?php echo esc_html( $cat->name ); ?>
                                        <span class="post-widget-count"><?php echo $cat->count; ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <!-- PROMOTIONS WIDGET -->
                    <div class="post-widget post-widget--promo">
                        <div class="post-widget-body text-center">
                            <div class="post-promo-icon">🎉</div>
                            <h6 class="mb-2">Special Offers</h6>
                            <p style="font-size:.85rem;opacity:.85;margin-bottom:1rem;">
                                First-time trial promotions available. Enjoy exclusive discounts on selected treatments.
                            </p>
                            <a href="<?php echo esc_url( home_url( '/news-promotion' ) ); ?>"
                               class="btn btn-light btn-sm rounded-pill"
                               style="color:var(--primary);">
                                View Promotions
                            </a>
                        </div>
                    </div>

                </aside>
            </div>

        </div>
    </div>
</section>

<?php endwhile; ?>

<!-- RELATED POSTS -->
<?php
$current_cats = wp_get_post_categories( get_the_ID() );
if ( $current_cats ) :
    $related = new WP_Query( [
        'post__not_in'   => [ get_the_ID() ],
        'category__in'   => $current_cats,
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ] );
    if ( $related->have_posts() ) :
?>
<section class="category-section py-5">
    <div class="container">

        <div class="section-title">
            <h2>Related Articles</h2>
            <p>More beauty tips, promotions, and news from Impression Beauty.</p>
        </div>

        <div class="row g-4">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
            <div class="col-md-4">
                <a href="<?php the_permalink(); ?>" class="post-related-card">
                    <div class="post-related-img-wrap">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium_large', [ 'class' => 'post-related-img' ] ); ?>
                        <?php else : ?>
                            <img src="https://images.unsplash.com/photo-1768483018807-bd0b9ab86539?w=600&h=350&fit=crop&q=80"
                                 alt="<?php echo esc_attr( get_the_title() ); ?>"
                                 class="post-related-img">
                        <?php endif; ?>
                        <div class="post-related-overlay">
                            <span class="post-related-date"><?php echo get_the_date(); ?></span>
                        </div>
                    </div>
                    <div class="post-related-body">
                        <h6 class="post-related-title"><?php the_title(); ?></h6>
                        <p class="post-related-excerpt">
                            <?php echo wp_trim_words( get_the_excerpt(), 12, '…' ); ?>
                        </p>
                        <span class="post-related-readmore">Read More →</span>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>

    </div>
</section>
<?php endif; endif; ?>

<!-- NEWSLETTER BANNER -->
<section class="py-5">
    <div class="container">
        <?php get_template_part( 'template-parts/front-page/newsletter' ); ?>
    </div>
</section>

<?php get_footer(); ?>
