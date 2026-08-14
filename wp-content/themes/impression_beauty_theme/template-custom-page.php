<?php
/*
 * Template Name: Custom Inner Page
 * Template Post Type: page
 */
get_header();
?>

<main class="py-5">
    <div class="container">

        <?php while ( have_posts() ) : the_post(); ?>

            <!-- Page title block -->
            <div class="section-title mb-5">
                <h2><?php the_title(); ?></h2>
                <?php if ( has_excerpt() ) : ?>
                    <p><?php the_excerpt(); ?></p>
                <?php endif; ?>
            </div>

            <?php if ( has_post_thumbnail() ) : ?>
                <!-- Split layout: mirrors the trend-box pattern from the front page -->
                <div class="trend-box mb-5">
                    <div class="row g-0 align-items-center">

                        <div class="col-lg-6">
                            <?php the_post_thumbnail( 'large', [ 'style' => 'width:100%;height:100%;object-fit:cover' ] ); ?>
                        </div>

                        <div class="col-lg-6">
                            <div class="trend-content">
                                <div class="page-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php else : ?>
                <!-- No featured image – full-width content -->
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
