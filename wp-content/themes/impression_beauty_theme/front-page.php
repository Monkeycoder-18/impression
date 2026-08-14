<?php get_header(); ?>

<main id="front-page-main">
    <?php get_template_part( 'template-parts/front-page/hero' ); ?>
    <?php get_template_part( 'template-parts/front-page/services' ); ?>
    <?php //get_template_part( 'template-parts/front-page/categories' ); ?>
    <?php get_template_part( 'template-parts/front-page/trend' ); //THIS WILL SERVE AS PROMOTIONAL PAGE NEED INPUT ?> 
    <?php get_template_part( 'template-parts/front-page/news' ); ?>
    <?php get_template_part( 'template-parts/front-page/testimonials' ); ?>
    <?php get_template_part( 'template-parts/front-page/newsletter' ); ?>
</main>

<?php get_footer(); ?>
