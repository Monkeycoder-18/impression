<?php get_header(); ?>

<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <?php while ( have_posts() ) : the_post(); ?>

                    <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <div class="section-title text-start mb-4">
                            <h2><?php the_title(); ?></h2>
                        </div>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="mb-4">
                                <?php the_post_thumbnail( 'large', [ 'class' => 'img-fluid', 'style' => 'border-radius:18px' ] ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>

                    </article>

                <?php endwhile; ?>

            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
