<?php
/*
 * Template Name: News Page
 * Template Post Type: page
 */
get_header();

// Lists all posts, newest first. The page's own text is shown as the intro.
$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
$news_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
]);
?>

<?php while (have_posts()) : the_post(); ?>
<!-- NEWS HERO -->
<section class="inner-page-hero">
    <div class="container text-center">
        <span class="badge-beauty">Latest Updates</span>
        <h1 class="inner-page-hero-title mt-3"><?php the_title(); ?></h1>
        <?php if (trim(get_the_content())) : ?>
            <div class="inner-page-hero-sub mx-auto"><?php the_content(); ?></div>
        <?php endif; ?>
    </div>
</section>
<?php endwhile; ?>

<!-- NEWS LIST -->
<section class="news-section py-5">
    <div class="container">

        <?php if ($news_query->have_posts()) : ?>
            <div class="row g-4">
                <?php while ($news_query->have_posts()) : $news_query->the_post();
                    $categories = get_the_category();
                    $category   = !empty($categories) ? $categories[0]->name : 'News';
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="news-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-card-image">
                                    <?php the_post_thumbnail('large', ['alt' => get_the_title()]); ?>
                                    <span class="news-card-category"><?php echo esc_html($category); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="news-card-body">
                                <span class="news-card-date"><?php echo get_the_date('F j, Y'); ?></span>
                                <h5><?php the_title(); ?></h5>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 20, '…'); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn-service">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php
            $pages = paginate_links([
                'base'      => add_query_arg('paged', '%#%'),
                'format'    => '',
                'current'   => $paged,
                'total'     => $news_query->max_num_pages,
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
            ]);
            if ($pages) :
                ?>
                <nav class="news-pagination mt-5 text-center"><?php echo $pages; ?></nav>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p class="text-center text-muted">No news yet. Please check back soon.</p>
        <?php endif; ?>

    </div>
</section>

<?php get_template_part('template-parts/front-page/newsletter'); ?>

<?php get_footer(); ?>
