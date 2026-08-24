<?php

$news_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

?>

<!-- NEWS -->
<section class="news-section py-5">
    <div class="container">

        <div class="section-title">
            <h2>Latest News</h2>
            <p>Stay in the loop with beauty tips, skincare insights, and the latest trends from Impression Beauty.</p>
        </div>

        <?php if ($news_query->have_posts()) : ?>
            <div class="row g-4">
                <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                    <?php
                        $categories = get_the_category();
                        $category   = !empty($categories) ? esc_html($categories[0]->name) : 'News';
                        $image_url  = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        $fallback   = get_template_directory_uri() . '/assets/images/news-placeholder.jpg';
                    ?> 
                    <div class="col-md-4">
                        <div class="news-card">
                            <div class="news-card-image">
                                <img src="<?php echo esc_url($image_url ?: $fallback); ?>" alt="<?php the_title_attribute(); ?>">
                                <span class="news-card-category"><?php echo $category; ?></span>
                            </div>
                            <div class="news-card-body">
                                <span class="news-card-date"><?php echo get_the_date('F j, Y'); ?></span>
                                <h5><?php the_title(); ?></h5>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 20, '…'); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn-service">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <p class="text-center text-muted">No news articles found.</p>
        <?php endif; ?>

        <div class="text-center mt-5">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/news')); ?>" class="btn-beauty">View All News</a>
        </div>

    </div>
</section>
 