<?php get_header(); ?>

<main class="py-5">
    <div class="container">

        <div class="section-title">
            <h2><?php wp_title( '' ); ?></h2>
        </div>

        <div class="row g-4">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium', [ 'class' => 'img-fluid' ] ); ?>
                            <?php endif; ?>
                            <h5><?php the_title(); ?></h5>
                            <p><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-beauty btn-sm mt-2">
                                Read More
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="col-12 d-flex justify-content-center mt-4">
                    <?php the_posts_pagination(); ?>
                </div>

            <?php else : ?>
                <div class="col-12">
                    <p><?php esc_html_e( 'No posts found.', 'impression_beauty_theme' ); ?></p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php get_footer(); ?>
