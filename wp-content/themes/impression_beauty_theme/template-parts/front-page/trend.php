<?php
$trend_image   = get_field('trend_image');
$trend_content = get_field('trend_content');
?>
<!-- PROMOTIONAL & PRICING -->
<section class="py-5 section-bg-white">
    <div class="container">
        <div class="trend-box">
            <div class="row g-0 align-items-center" style="padding-left: 35px">

                <div class="col-lg-6 trend-img-col">
                    <?php if ($trend_image) : ?>
                        <img src="<?php echo esc_url($trend_image); ?>"
                            alt="Promotional Beauty Bundle">
                    <?php endif; ?>
                </div>

                <div class="col-lg-6">
                    <div class="trend-content">
                        <?php if ($trend_content) : ?>
                            <?php echo wp_kses_post($trend_content); ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>